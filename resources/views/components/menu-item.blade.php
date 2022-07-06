<li>
    @if ($type == 'sub')
        <a href="javascript:;" class="side-menu {{ $active != null ? active($active, 'side-menu--active side-menu--open') : '' }}">
            @if ($icon != null) <div class="side-menu__icon"> <i data-feather="{{ $icon }}"></i> </div> @endif
            <div class="side-menu__title">
                {{ $parent }} 
                <div class="side-menu__sub-icon"> <i data-feather="chevron-down"></i> </div>
            </div>
        </a>
        <ul class="{{ $active != null ? active($active, 'side-menu__sub-open') : '' }}">
            {{ $slot }}
        </ul>
    @else 
        <a href="{{ $route != null ? route($route) : '' }}"  class="side-menu {{ $active != null ? active($active, 'side-menu--active') : '' }}">
            @if ($icon != null) <div class="side-menu__icon"> <i data-feather="{{ $icon }}"></i> </div> @endif
            <div class="side-menu__title">{{ $slot }}</div>
        </a>
    @endif
</li>