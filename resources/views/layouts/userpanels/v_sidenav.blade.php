<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand"
                    href=""><span class="brand-logo">  <!-- route('userPanels.dashboard') }} -->
                        <img src="{{ asset('public/assets/logo/vp_logo.svg') }}" alt="VPP Manager Logo">
                       </span>
                    <h2 class="brand-text">VPP Manager</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('userPanels.dashboard') }}"><i
                        data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboard">Dashboard</span></a>
            </li>

            {{-- @if (auth()->user()->type == 'Admin') --}}
                <li class=" navigation-header"><span data-i18n="Data Employee">Data Employee</span><i
                        data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span
                            class="menu-title text-truncate" data-i18n="Employee">Employee</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="">
                            {{-- {{ route('m.emp') }} --}}
                                <i data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="List Manage">List Manage</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="">
                            {{-- {{ route('m.emp.roles') }} --}}
                            <i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Role Manage">Role Manage</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="book-open"></i><span
                            class="menu-title text-truncate" data-i18n="Employee">Attendance</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="">
                            {{-- {{ route('m.absen') }} --}}
                            <i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Info Manage">Info Manage</span></a>
                        </li>
                    </ul>
                </li>

                <li class=" navigation-header"><span data-i18n="Data Accounts">Data Accounts</span><i
                        data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                            data-feather="users"></i><span class="menu-title text-truncate"
                            data-i18n="Users">Accounts</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="">
                            {{-- {{ route('m.user') }} --}}
                            <i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="User List">User List</span></a>
                        </li>

                    </ul>
                </li>
            {{-- @endif --}}


            {{-- @if (auth()->user()->type == 'Admin' ||
                    auth()->user()->type == 'Karyawan' ||
                    auth()->user()->type == 'Guest' ||
                    auth()->user()->type == '') --}}
                <li class="navigation-header">
                    <span data-i18n="Help &amp; Supports">Help &amp; Supports</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather="package"></i>
                        <span class="menu-title text-truncate" data-i18n="Help">Help</span>
                    </a>
                    <ul class="menu-content">
                        <li onclick="openModal('#contactUsModal')">
                            <a class="d-flex align-items-center" id="contactUsLink">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="ContactUS">ContactUS</span>
                            </a>
                        </li>
                        <li onclick="openModal('#aboutUsModal')">
                            <a class="d-flex align-items-center" id="aboutUsLink">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="AboutUs">AboutUs</span>
                            </a>
                        </li>

                    </ul>
                </li>
            {{-- @endif --}}



        </ul>
    </div>
</div>
<!-- END: Main Menu-->

