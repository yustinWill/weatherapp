<div id="kt_header" class="header flex-column header-fixed">
    <div class="header-top">
        <div class="container">
            <div class="d-none d-lg-flex align-items-center mr-3">
                <!-- <a href="{{ route("home") }}" class="mr-20">
                    <img alt="Logo" src="{{ asset('logo.jpeg') }}" class="max-h-30px" />
                </a> -->
                <ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
                    <li class="nav-item">
                        <a href="{{ route("home") }}" class="nav-link py-4 px-6 {{ request()->is('home') ? 'active' : '' }}" data-target="#kt_header_tab_1" role="tab">Home</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="{{ route("weather_log_view") }}" class="nav-link py-4 px-6 {{ request()->is('weather_log/*') ? 'active' : '' }}" data-target="#kt_header_tab_2" role="tab">Weather Log</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="{{ route("master_user_view") }}" class="nav-link py-4 px-6 {{ request()->is('master_user/*') ? 'active' : '' }}" data-target="#kt_header_tab_2" role="tab">Master User</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="{{ route("master_admin_view") }}" class="nav-link py-4 px-6 {{ request()->is('master_admin/*') ? 'active' : '' }}" data-target="#kt_header_tab_3" role="tab">Master Admin</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="{{ route("master_location_view") }}" class="nav-link py-4 px-6 {{ request()->is('master_location/*') ? 'active' : '' }}" data-target="#kt_header_tab_4" role="tab">Master Location</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="{{ route("weather_config_view") }}" class="nav-link py-4 px-6 {{ request()->is('weather_config/*') ? 'active' : '' }}" data-target="#kt_header_tab_5" role="tab">Weather Config</a>
                    </li>
                </ul>
            </div>
            <div class="topbar bg-primary">
                <div class="topbar-item">
                    <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                        <div class="d-flex flex-column text-right pr-3">
                            <!-- <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline">Handoko</span> -->
                            <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline">{{ session('user_name') }}</span>
                            <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                                @if (session('user_role') == 1)
                                Super Admin
                                @elseif (session('user_role') == 2)
                                Admin
                                @endif
                            </span>
                        </div>
                        <span class="symbol symbol-35">
                            <span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30">{{ session('user_initial_name') }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>