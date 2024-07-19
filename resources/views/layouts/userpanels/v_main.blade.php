@php
    $page = Session::get('page');
    $page_title = $page['page_title'];
    $authenticated_user_data = Session::get('authenticated_user_data');
    $avatar_src = $authenticated_user_data && $authenticated_user_data->foto_karyawan ? asset('public/avatar/uploads/' . $authenticated_user_data->foto_karyawan) : env('APP_DEFAULT_AVATAR');

    $loadDataWorksheetFromDB = Session::get('loadDataWorksheetFromDB');

@endphp



<!DOCTYPE html>
<html class="light-layout loaded" lang="en" data-layout="" data-textdirection="ltr">
<!-- BEGIN: Head--> @include('layouts.userpanels.v_header') <!-- END: Head-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">
    <!-- BEGIN: Nav-head--> @include('layouts.userpanels.v_topnav') <!-- END: Nav-head-->
    <!-- BEGIN: Nav-side--> @include('layouts.userpanels.v_sidenav') <!-- END: Nav-side-->
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div id="image-popup"
                class="modal-dialog-centered-cust modal-lg modal-dialog-scrollable col-8 col-sm-6 col-md-4 p-2">
                <span class="close-btn btn btn-sm btn-text-primary rounded-pill btn-icon"><i
                        class="mdi mdi-close"></i></span>
                <img src="" alt="Large Image" style="max-height: 85vh" />
            </div>
            <div id="qr-popup" class="modal-dialog-centered-cust col-8 col-sm-6 col-md-4 p-2">
                <span class="close-btn btn btn-sm btn-text-primary rounded-pill btn-icon"><i
                        class="mdi mdi-close"></i></span>
                <img src="" alt="Large Image" style="max-height: 85vh" />
            </div>

            @yield('page-content')
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Footer--> @include('layouts.userpanels.v_footer') <!-- END: Footer-->

    <!-- BEGIN: Footer JS Bundle's--> @include('v_res.userpanels.v_footer_js_bundle') <!-- END: Footer JS Bundle's-->
    <!-- BEGIN: Toast CustomJS Bundle's--> @include('v_res.toasts.v_toast_js_bundle') <!-- END: Toast CustomJS Bundle's-->
    <!-- BEGIN: FYI Modals--> @include('v_res.modals.p_fyi_modals') <!-- END: FYI Modals-->

    <!-- BEGIN: PAGE JS's--> @yield('footer_page_js') <!-- END: PAGE JS's-->


</body>
</html>
