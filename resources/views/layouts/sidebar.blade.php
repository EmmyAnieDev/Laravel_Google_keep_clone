<aside class="sidebar">
    <ul>
        <li>
            <a class="{{ request()->routeIs('notes.index') ? 'active' : '' }}" href="{{ route('notes.index') }}">
                <i class="far fa-lightbulb"></i> <span>Notes</span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('reminder.route.name') ? 'active' : '' }}" href="#">
                <i class="far fa-bell"></i> <span>Reminder</span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('edit.label.route.name') ? 'active' : '' }}" href="#">
                <i class="far fa-pen"></i> <span>Edit Label</span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('notes.archived') ? 'active' : '' }}" href="{{ route('notes.archived') }}">
                <i class="far fa-box-alt"></i> <span>Archive</span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('bin.route.name') ? 'active' : '' }}" href="#">
                <i class="far fa-trash-alt"></i> <span>Bin</span>
            </a>
        </li>
    </ul>
</aside>
