{{-- Header --}}
<div id="kt_header" class="header {{ Metronic::printClasses('header', false) }} bg-danger" {{ Metronic::printAttrs('header') }}>

    {{-- Container --}}
    <div class="container-fluid d-flex align-items-center justify-content-between">
        @if (config('layout.header.self.display'))

            @php
                $kt_logo_image = 'logo-tacyon.jpg';
            @endphp

            @if (config('layout.header.self.theme') === 'light')
                @php $kt_logo_image = 'logo-tacyon.jpg' @endphp
            @elseif (config('layout.header.self.theme') === 'dark')
                @php $kt_logo_image = 'logo-tacyon.jpg' @endphp
            @endif

            {{-- Header Menu --}}
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                @if(config('layout.aside.self.display') == false)
                    <div class="header-logo">
                        <a href="{{ url('/') }}">
                            <img alt="Logo" src="{{ asset('media/logos/'.$kt_logo_image) }}"/>
                        </a>
                    </div>
                @endif
            </div>

        @else
            <div></div>
        @endif

        @include('layout.partials.extras._topbar')
    </div>
</div>
