<header>
    <div class="header_left d-flex flex-wrap align-items-center">
        <div class="header_icon"><i class="fal fa-bars"></i></div>
        <a href="#"><img src="{{ asset('assets/images/logo.jpg') }}" alt="logo" class="img-fluid"></a>
    </div>
    <ul class="header_right d-flex flex-wrap align-items-center">
        <li class="setting_area">
            <a class="setting"><i class="fal fa-cog"></i></a>
            <ul class="drop_menu drop_menu_setting">
                <li><a href="{{ route('profile.edit') }}">profile</a></li>
                <li><a CLASS="text-danger" href="javascript:;" onclick="$('.logout').submit()">logout</a></li>
            </ul>
        </li>
        <li class="user_area">
            <div class="user">
                <img src="{{ asset('assets/images/user_icon.png') }}" alt="user" class="img-fluid">
            </div>
        </li>

        <form action="{{ route('logout') }}" method="POST" class="logout">
            @csrf
        </form>
    </ul>
</header>
