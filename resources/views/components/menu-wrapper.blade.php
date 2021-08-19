<div class="sidebar" data-color="{{ $color }}" data-active-color="{{ $active }}">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="white | black"
    -->
    
    <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-normal mx-5">
            <div class="logo-image-big">
                <img src="{{ asset('images/utm.png') }}">
            </div>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <ul class="nav">
            <x.menu-item active="active-grant.*" route="active-grant.index"></x.menu-item>
            {{ $slot }}
        </ul>
    </div>
</div>