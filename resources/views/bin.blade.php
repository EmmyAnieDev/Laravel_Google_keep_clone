<x-app-layout>
    <div class="search_area">
        <input type="text" placeholder="Search...">
        <i class="far fa-search"></i>
    </div>

    <div class="row">
        <x-notes.note-card :notes="$notes" :bin="true" />
    </div>
</x-app-layout>
