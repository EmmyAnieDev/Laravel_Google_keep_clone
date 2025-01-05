<x-app-layout>

    <x-notes.search-input :route="route('notes.archived')" />

    <div class="create_note">
        <i class="far fa-plus"></i>
    </div>

    <x-notes.create-modal />

    <div class="row">
        <x-notes.note-card :notes="$notes" />
    </div>
</x-app-layout>
