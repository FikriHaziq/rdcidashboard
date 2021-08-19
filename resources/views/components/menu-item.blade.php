<li class="{{ $active != null ? active($active, 'active') : '' }}">
    <a href="{{ $route != null ? route($route) : '' }}">
        <b><p>{{ $slot }}</p></b>
    </a>
</li>