@foreach($notes as $note)
    <div class="col-xxl-3 col-md-6 col-xl-4">
        <div class="single_note active"
             @if($note->appearance_type == 'color')
                 style="background: {{ $note->color_name }}"
             @else
                 style="background-image: url({{ asset($note->image_path) }})"
            @endif>
        <a class="single_note_check" href="#"><i class="far fa-check"></i></a>
            <div class="single_note_content"   data-modal="modal_{{ $note->id }}">
                <h2>{{ $note->title }}</h2>
                <p>{{ Str::limit($note->content, 50) }}</p>
            </div>

            <div class="ions_area">
                <ul>
                    <li>
                        <a class="modal_drop_theme"><i class="far fa-palette"></i></a>
                        <div class="theme_area">
                            <ul class="theme_color">
                                <li><a class="white active" href="#"><i class="far fa-tint-slash"></i></a>
                                </li>
                                @foreach( config('appearance.colors') as $color )
                                    <li class="appearance" data-color="{{ $color }}" data-type="color" data-id="{{ $note->id }}"><a class="red" style="background: {{ $color }}" href="javascript:;"></a></li>
                                @endforeach
                            </ul>
                            <ul class="theme_img">
                                <li><a class="img_1 close active" href="#"></a></li>
                                @foreach( config('appearance.images') as $image)
                                    <li class="appearance" data-image="{{ $image }}" data-type="image" data-id="{{ $note->id }}"><a style="background: url('{{ asset($image) }}')" class="img_2" href="#"></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('notes.archive', $note->id) }}"><i class="far fa-box-alt"></i></a>
                    </li>
                    <li>
                        <a class="modal_drop_list"><i class="far fa-ellipsis-v"></i></a>
                        <ul class="drop_list">
                            @if( $bin == true )
                                <li><a href=" {{ route('notes.restore', $note->id) }}">restore note</a></li>
                            @endif
                            <li><a href="javascript:;" onclick="$('.delete-note-{{ $note->id }}').submit()">delete note</a></li>
                        </ul>
                        <form class="delete-note-{{ $note->id }}" action="{{ route('notes.destroy', $note->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="permanent_delete" value="{{ $bin ? 1 : 0 }}">
                        </form>
                    </li>
                </ul>
                <!-- <a class="cancel_modal" href="#">cancel</a> -->
            </div>
        </div>
    </div>

    <div class="custom_modal_area" data-modal="modal_{{ $note->id }}">
        <div class="custom_modal_content"
             @if($note->appearance_type == 'color')
                 style="background: {{ $note->color_name }}"
             @else
                 style="background-image: url({{ asset($note->image_path) }})"
            @endif>>
            <div class="pin_icon">
                <img src="{{ asset('assets/images/pin_icons.png') }}" alt="pin" class="img-fluid">
            </div>
            <form action="{{ route('notes.update', $note->id) }}" method="POST" class="update-note-{{ $note->id }}">
                @csrf
                @method('PUT')
                <input type="text" placeholder="Title" name="title" value="{{ $note->title }}">
                <textarea rows="4" placeholder="Note" id="editorjs" name="content">{!! $note->content !!}</textarea>
            </form>
            <div class="ions_area">
                <ul>
                    <li>
                        <a class="modal_drop_theme"><i class="far fa-palette"></i></a>
                        <div class="theme_area">
                            <ul class="theme_color">
                                <li><a class="white active" href="#"><i class="far fa-tint-slash"></i></a></li>
                                @foreach( config('appearance.colors') as $color )
                                    <li class="appearance" data-color="{{ $color }}" data-type="color" data-id="{{ $note->id }}"><a class="red" style="background: {{ $color }}" href="javascript:;"></a></li>
                                @endforeach
                            </ul>
                            <ul class="theme_img">
                                <li><a class="img_1 close active" href="#"></a></li>
                                @foreach( config('appearance.images') as $image)
                                    <li class="appearance" data-image="{{ $image }}" data-type="image" data-id="{{ $note->id }}"><a style="background: url('{{ asset($image) }}')" class="img_2" href="#"></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#"><i class="far fa-box-alt"></i></a>
                    </li>
                </ul>
                <a class="" href="javascript:;" onclick="$('.update-note-{{ $note->id }}').submit()">Update</a>
            </div>
        </div>
    </div>

@endforeach
