<x-app-layout>

    <x-notes.search-input :route="route('notes.bin')" />

    <div class="row">
        <x-notes.note-card :notes="$notes" :bin="true" />
    </div>
</x-app-layout>
