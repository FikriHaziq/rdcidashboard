<div class="-intro-x breadcrumb me-auto d-none d-sm-flex">
    <a href="{{ $moduleLink != null ? route($moduleLink) : '' }}">{{ $module }}</a>

    @if ($submodule != null)
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="{{ $submoduleLink != null ? route($submoduleLink) : '' }}" class="{{ $submoduleLink != null ? active($submoduleLink, '') : '' }}">{{ $submodule }}</a>
    @endif

    @if ($trimodule != null)
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="{{ $trimoduleLink != null ? route($trimoduleLink) : '' }}" class="{{ $trimoduleLink != null ? active($trimoduleLink, 'breadcrumb--active') : '' }}">{{ $trimodule }}</a>
    @endif
</div>