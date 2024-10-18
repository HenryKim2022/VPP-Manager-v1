@php
    $page = Session::get('page');
    $page_title = $page['page_title'];
    $cust_date_format = 'ddd, DD MMM YYYY';
    $cust_time_format = 'hh:mm:ss A';

    $prjmondws = $loadDaftarMonDWSFromDB;
    // $authenticated_user_data = Session::get('authenticated_user_data');
@endphp

@extends('layouts.userpanels.v_main')

@section('header_page_cssjs')
    <style>
        .media .mr-25.p-1.rounded {
            background-color: #30334e;
            border: 1px solid rgba(20, 21, 33, 0.175);
        }

        .dark-layout .media.mr-25.p-1.rounded {
            background-color: #ffffff;
            border: 1px solid rgba(20, 21, 33, 0.175);
        }

        .light-layout .media.mr-25.p-1.rounded {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(20, 21, 33, 0.175);
        }
    </style>

    <style>
        /* Custom CSS for Engineer Text */
        .engineer-text {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: inherit;
            /* padding: 10px; */
            border: none;
            z-index: 2;
        }

        .engineer-text:hover {
            color: var(--primary) !important;
        }
    </style>
    <style>
        /* Custom CSS for setting max-width on the image */
        @media (max-width: 924) {
            .max-width-lg {
                max-width: 24%;
            }
        }

        @media (max-width: 800px) {
            .max-width-sm {
                max-width: 12%;
            }
        }

        @media (max-width: 768px) {
            .max-width-md {
                max-width: 12%;
            }
        }
    </style>
@endsection


@section('page-content')
    {{-- @if (auth()->user()->type == 'Superuser' || auth()->user()->type == 'Supervisor')
        <h1>HI MIN :)</h1>
    @endif

    @if (auth()->user()->type == 'Engineer')
        <h1>HI WAN :)</h1>
    @endif --}}

    {{-- {{ dd($authenticated_user_data) }} --}}

    @auth
        <section id="dashboard-ecommerce">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0 d-lg-none d-md-none">{{ $page_title }}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('userPanels.dashboard') }}">UserPanels</a>
                                    </li>
                                    <li class="breadcrumb-item active"> {{ $page_title }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row match-height">
                <!-- QRCodeCheck-out Card -->
                <div class="col-lg-4 col-md-6 col-12">
                </div>
                <!--/ QRCodeCheck-out Card -->

                <!-- TableAbsen Card -->
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="card card-developer-meetup">
                        <div class="card-body p-1">
                            <div class="">
                                <a class="text-center">
                                    <h2 class="mt-2 cursor-default">PROGRESS PROJECT MONITORING</h2>
                                </a>
                                <div class="row match-height">

                                    <!--  Check $data as array -->
                                    <div class="col-xl-12 col-md-12 col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <pre style="color: white">{{ print_r($prjmondws->toArray(), true) }}</pre>
                                                <br>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Left Card -->
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="card mb-0 mb-0">
                                            <div class="card-body">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Project-No</strong></td>
                                                            <td class="pl-2">: </td>
                                                            <td>{{ $prjmondws->id_project }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Project Name</strong></td>
                                                            <td class="pl-2">: </td>
                                                            <td>{{ $prjmondws->na_project }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Customer</strong></td>
                                                            <td class="pl-2">: </td>
                                                            <td>{{ $prjmondws->client->na_client }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Left Card -->

                                    <!-- Right Card -->
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <a class="text-end">
                                                    <h6><strong>PT. VERTECH PERDANA</strong></h6>
                                                </a>
                                                <table>
                                                    <tbody>
                                                        {{-- <tr>
                                                            <td colspan="3">
                                                                <h6>
                                                                    <strong>PT. VERTECH PERDANA</strong>
                                                                </h6>
                                                            </td>
                                                        </tr> --}}
                                                        <tr>
                                                            <td colspan="3"><strong>Engineer Team</strong></td>
                                                            <td class="pl-2">: </td>
                                                            <td>{{ $prjmondws->team->na_team }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"><strong>Project Coordinator</strong></td>
                                                            <td class="pl-2">: </td>
                                                            <td>{{ $prjmondws->pcoordinator->na_karyawan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"><strong>Date</strong></td>
                                                            <td class="pl-2">: </td>
                                                            <td>
                                                                @if ($prjmondws->created_at)
                                                                    {{ \Carbon\Carbon::parse($prjmondws->created_at)->isoFormat($cust_date_format) }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Right Card -->

                                </div>

                            </div>

                            <div>
                                <div class="divider">
                                    <div class="divider-text">
                                        <div class="divider-icon">
                                            <i class="fas fa-wifi-1"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table id="daftarMonitoringTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">No</th>
                                        <th rowspan="2" class="text-center">Act</th>
                                        <th rowspan="2" class="text-center">Category</th>
                                        <th colspan="2" class="text-center">Date</th>
                                        <th rowspan="2" class="text-center">Qty<br>(100%)</th>
                                        <th colspan="2" class="text-center">Progress%</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Start</th>
                                        <th class="text-center">End</th>
                                        <th class="text-center">Update</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @if ($prjmondws->monitor)
                                        @foreach ($prjmondws->monitor as $mon)
                                            <tr>
                                                <td class="text-center align-middle">{{ $no++ }}</td>
                                                <td>
                                                    <div class="dropdown d-lg-block d-sm-block d-md-block">
                                                        <button class="btn btn-icon navbar-toggler pt-0" type="button"
                                                            id="tableActionDropdown" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i data-feather="align-justify" class="font-medium-5"></i>
                                                        </button>
                                                        <!-- dropdown menu -->
                                                        <div class="dropdown-menu dropdown-menu-end"
                                                            aria-labelledby="tableActionDropdown">
                                                            <a class="edit-record dropdown-item d-flex align-items-center"
                                                                edit_karyawan_id_value = "{{ $mon->id_monitor ?: 0 }}"
                                                                {{-- onclick="openModal('{{ $modalData['modal_edit'] }}')" --}}>
                                                                <i data-feather="edit" class="mr-1"
                                                                    style="color: #28c76f;"></i>
                                                                Edit
                                                            </a>
                                                            <a class="delete-record dropdown-item d-flex align-items-center"
                                                                del_karyawan_id_value = "{{ $mon->id_monitor ?: 0 }}"
                                                                {{-- onclick="openModal('{{ $modalData['modal_delete'] }}')" --}}>
                                                                <i data-feather="trash" class="mr-1"
                                                                    style="color: #ea5455;"></i>
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--/ dropdown menu -->
                                                    </div>
                                                </td>
                                                <td>{{ $mon->category ?: '-' }}</td>
                                                <td class="text-center align-middle">
                                                    @if ($mon->start_date)
                                                        {{ \Carbon\Carbon::parse($mon->start_date)->isoFormat($cust_date_format) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if ($mon->end_date)
                                                        {{ \Carbon\Carbon::parse($mon->end_date)->isoFormat($cust_date_format) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td></td>
                                                <td class="text-center align-middle">{{ $mon->qty . '%' ?: '-' }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        -
                                    @endif


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!--/ TableAbsen Card -->
            </div>


            <style>
                .overflow-x-scroll {
                    overflow-x: auto;
                    white-space: nowrap;
                    /* Prevent wrapping of content */
                }

                .overflow-y-scroll {
                    overflow-y: auto;
                }

                .card-developer-meetup {
                    overflow: hidden;
                    /* Prevent card content from overflowing */
                }
            </style>



            <!-- ############################################################################################################################ -->
            <!-- ############################################################################################################################ -->
            <!-- ############################################################################################################################ -->
            <!-- ############################################################################################################################ -->


            <div class="row match-height">
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <pre style="color: white">{{ print_r($prjmondws->worksheet->toArray(), true) }}</pre>
                            <br>
                        </div>
                    </div>
                </div>
                <!-- TableAbsen Card -->
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="card card-developer-meetup">
                        <div class="card-body p-1">
                            <div class="overflow-x-scroll overflow-y-scroll">
                                <button class="btn btn-primary engineer-text">
                                    <a class="mt-0 mb-0 pr-xl-0 pr-md-0 pr-sm-0 pr-0 cursor-default text-end"></i>ENGINEER</a>
                                </button>
                            </div>

                            <div class="row match-height">
                                <!-- Left Card 1st -->
                                <div class="col-xl-3 col-md-6 col-12 d-flex align-items-center d-none">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <span class="brand-logo">
                                                <img src="{{ asset('public/assets/logo/dws_header_vplogo.svg') }}"
                                                    class="img-fluid max-width-sm max-width-md max-width-lg" alt="VPLogo">
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!--/ Left Card 1st -->

                                <!-- Right Card 1st -->
                                <div class="col-xl-6 col-md-6 col-12">
                                    <div class="card mb-0">
                                        <div
                                            class="card-body pt-lg-0 pb-lg-0 pt-sm-0 pt-md-0 pb-sm-0 pb-md-0 d-flex align-items-center justify-content-center">
                                            <a class="text-center">
                                                <strong>
                                                    <h3 class="mt-0 mb-0 underline-text">WORKSHEET LIST<br>( DAFTAR LEMBAR KERJA )</h3>
                                                </strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Right Card 1st -->

                                <!-- Left Card 2nd -->
                                <div class="col-xl-8 col-md-8 col-12 d-none">
                                    <div class="card mb-0">
                                        <div class="card-body pt-0">
                                            <table class="bordered-layout border-accent-1">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>DESCRIPTION</strong></td>
                                                        <td class="pl-2">: </td>
                                                        <td>{{ $prjmondws->id_project }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>CLIENT'S NAME</strong></td>
                                                        <td class="pl-2">: </td>
                                                        <td>
                                                            {{-- {{ $clientData->na_client }} --}}
                                                            {{ $prjmondws->na_client }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>DATE</strong></td>
                                                        <td class="pl-2">: </td>
                                                        <td>{{ \Carbon\Carbon::parse($prjmondws->created_at)->isoFormat($cust_date_format) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Left Card 2nd -->
                                <!-- Right Card 2nd -->
                                <div class="col-xl-4 col-md-4 col-12 d-none">
                                    <div class="card mb-0">
                                        <div class="card-body pt-0">
                                            <table class="bordered-layout border-accent-1">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>ARRIVAL TIME</strong></td>
                                                        <td class="pl-2">: </td>
                                                        {{-- <td>{{ \Carbon\Carbon::parse($loadDataDailyWS->arrival_time_dws)->isoFormat($cust_time_format) }}
                                                        </td> --}}
                                                    </tr>
                                                    <tr>
                                                        <td><strong>FINISH TIME</strong></td>
                                                        <td class="pl-2">: </td>
                                                        {{-- <td>{{ \Carbon\Carbon::parse($loadDataDailyWS->finish_time_dws)->isoFormat($cust_time_format) }}
                                                        </td> --}}
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Right Card 2nd -->
                            </div>
                            <div>
                                <div class="divider">
                                    <div class="divider-text">
                                        <div class="divider-icon">
                                            <i class="fas fa-wifi-1"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="daftarDWSTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="cell-fit text-center">Act</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Arrival</th>
                                        <th class="text-center">Finish</th>
                                        <th class="text-center">Executed by</th>
                                        <th class="cell-fit text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($prjmondws->worksheet)
                                        @foreach ($prjmondws->worksheet as $ws)
                                            <tr>
                                                <td>
                                                    <div class="dropdown d-lg-block d-sm-block d-md-block">
                                                        <button class="btn btn-icon navbar-toggler pt-0" type="button"
                                                            id="tableActionDropdown" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i data-feather="align-justify" class="font-medium-5"></i>
                                                        </button>
                                                        <!-- dropdown menu -->
                                                        <div class="dropdown-menu dropdown-menu-end"
                                                            aria-labelledby="tableActionDropdown">
                                                            <a class="open-project-ws dropdown-item d-flex align-items-center"
                                                            projectws_id_value = "{{ $project->id_project }}"
                                                            client_id_value = "{{ $project->client !== null ? $project->client->id_client : 0 }}"
                                                            href="{{ route('m.projects.getprjmondws') . "?projectID=" . $project->id_project }}">
                                                            <i data-feather="navigation" class="mr-1"
                                                                style="color: #288cc7;"></i>
                                                            Navigate
                                                        </a>
                                                            <a class="edit-record dropdown-item d-flex align-items-center"
                                                                edit_ws_id_value = "{{ $ws->id_ws ?: 0 }}"
                                                                {{-- onclick="openModal('{{ $modalData['modal_edit'] }}')" --}}>
                                                                <i data-feather="edit" class="mr-1"
                                                                    style="color: #28c76f;"></i>
                                                                Edit
                                                            </a>
                                                            <a class="delete-record dropdown-item d-flex align-items-center"
                                                                del_ws_id_value = "{{ $ws->id_ws ?: 0 }}"
                                                                {{-- onclick="openModal('{{ $modalData['modal_delete'] }}')" --}}>
                                                                <i data-feather="trash" class="mr-1"
                                                                    style="color: #ea5455;"></i>
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--/ dropdown menu -->
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-placement="bottom" data-original-title="Click to navigate!"
                                                    class="pull-up">
                                                    <a class="open-project-ws"
                                                    projectws_id_value = "{{ $ws->id_ws }}"
                                                    href="{{ route('m.ws') . "?projectID=" . $ws->id_project . "&wsID=" . $ws->id_ws . "&wsDate=" . $ws->working_date_ws }}">
                                                            {{ \Carbon\Carbon::parse($ws->working_date_ws)->isoFormat($cust_date_format) }}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">{{ \Carbon\Carbon::parse($ws->arrival_time_ws)->isoFormat($cust_time_format) }}</td>
                                                <td class="text-center align-middle">{{ \Carbon\Carbon::parse($ws->finish_time_ws)->isoFormat($cust_time_format) }}</td>
                                                <td class="text-center align-middle">{{ $ws->executedby->na_karyawan }}</td>
                                                <td class="text-center align-middle">
                                                    @if ($ws->status_ws == "OPEN")
                                                        <span class="bg-success text-white rounded small" style="padding: 0.4rem"><i class="fas fa-lock-open me-1 fa-sm"></i></span>
                                                    @else
                                                        <span class="bg-danger text-white rounded small" style="padding: 0.4rem"><i class="fas fa-lock me-1 fa-sm"></i></span>

                                                    @endif
                                                </td>
                                                {{-- <td>{{ $ws->monitoring->task }}</td>
                                                <td>{{ $ws->descb_dws }}</td>
                                                <td class="text-center align-middle">{{ $ws->progress_actual_dws }}%</td>
                                                <td class="text-center align-middle">{{ $ws->progress_current_dws }}%</td> --}}
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>

                        </div>

                    </div>


                </div>
            </div>
            </div>
            <!--/ TableAbsen Card -->


            </div>
        </section>
        {{--


        <!-- BEGIN: AdKkaryawanModal--> @include('v_res.m_modals.userpanels.m_daftarkaryawan.v_add_karyawanModal') <!-- END: AddKaryawanModal-->
        <!-- BEGIN: EditKaryawanModal--> @include('v_res.m_modals.userpanels.m_daftarkaryawan.v_edit_karyawanModal') <!-- END: EditKaryawanModal-->
        <!-- BEGIN: DelKaryawanModal--> @include('v_res.m_modals.userpanels.m_daftarkaryawan.v_del_karyawanModal') <!-- END: DelKaryawanModal-->
        <!-- BEGIN: ResetKaryawanModal--> @include('v_res.m_modals.userpanels.m_daftarkaryawan.v_reset_karyawanModal') <!-- END: ResetKaryawanModal--> --}}




    @endauth
@endsection


@section('footer_page_js')
    <script src="{{ asset('public/theme/vuexy/app-assets/js/scripts/components/components-modals.js') }}"></script>



    <script>
        $(document).ready(function() {
            $('#daftarMonitoringTable').DataTable({
                lengthMenu: [5, 10, 15, 20, 25, 50, 100, 150, 200, 250],
                pageLength: 10,
                responsive: false,
                ordering: true,
                searching: true,
                language: {
                    lengthMenu: 'Display _MENU_ records per page',
                    info: 'Showing page _PAGE_ of _PAGES_',
                    search: 'Search',
                    paginate: {
                        first: 'First',
                        last: 'Last',
                        next: '&rarr;',
                        previous: '&larr;'
                    }
                },
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('#daftarDWSTable').DataTable({
                lengthMenu: [5, 10, 15, 20, 25, 50, 100, 150, 200, 250],
                pageLength: 10,
                responsive: true,
                ordering: true,
                searching: true,
                language: {
                    lengthMenu: 'Display _MENU_ records per page',
                    info: 'Showing page _PAGE_ of _PAGES_',
                    search: 'Search',
                    paginate: {
                        first: 'First',
                        last: 'Last',
                        next: '&rarr;',
                        previous: '&larr;'
                    }
                },
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                $('.open-project-ws').on('click', function() {
                    var wsID = $(this).attr('projectws_id_value');
                    console.log("Navigate to ProjectWS-ID: " + wsID);
                });
            }, 200);
        });
    </script>




    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalId = 'edit_karyawanModal';
            const modalSelector = document.getElementById(modalId);
            const modalToShow = new bootstrap.Modal(modalSelector);
            const targetedModalForm = document.querySelector('#' + modalId + ' #edit_karyawanModalFORM');

            $(document).on('click', '.edit-record', function(event) {
                var karyawanID = $(this).attr('edit_karyawan_id_value');
                console.log('Edit button clicked for karyawan_id:', karyawanID);
                setTimeout(() => {
                    $.ajax({
                        url: '{{ route('m.emp.getemp') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Update the CSRF token here
                        },
                        data: {
                            karyawanID: karyawanID
                        },
                        success: function(response) {
                            console.log(response);
                            $('#edit_karyawan_id').val(response.id_karyawan);
                            $('#edit-emp-name').val(response.na_karyawan);
                            $('#edit-emp-addr').val(response.addr_karyawan);
                            $('#edit-emp-telp').val(response.telp_karyawan);
                            $('#edit-emp-bday-place').val(response.bplace_karyawan);
                            $('#edit-emp-birth-date').val(response.bdate_karyawan
                                .substr(0, 10));

                            setAvatar(response);
                            setReligion(response);
                            console.log('SHOWING MODAL');
                            modalToShow.show();
                        },
                        error: function(error) {
                            console.log("Err [JS]:\n");
                            console.log(error);
                        }
                    });
                }); // <-- Closing parenthesis for setTimeout
            });

            function setAvatar(response) {
                const uploadedAvatar = document.getElementById('avatar-upload-img-2');
                const imgFromDB = '{{ asset('public/avatar/uploads') }}/' + response.ava_karyawan;
                if (response.ava_karyawan) {
                    const img = new Image();
                    img.onload = function() {
                        uploadedAvatar.src = img.src;
                    };
                    img.src = imgFromDB;
                } else {
                    uploadedAvatar.src = '{{ asset(env('APP_NOIMAGE')) }}';
                }

                const uploadInput = document.getElementById('edit-avatar-upload');
                var resetButton = document.querySelector('.acc-avatar-reset-edit');
                resetButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    uploadInput.value = null;
                    uploadedAvatar.src = imgFromDB;
                });
            }

            function setReligion(response) {
                var empReligionSelect = $('#' + modalId + ' select[name="edit-emp-religion"]');
                empReligionSelect.empty(); // Clear existing options
                var receivedReligion = response.reli_karyawan;
                var religionList = [{
                        // value: '',
                        text: 'Select Religion',
                        selected: receivedReligion === ''
                    },
                    {
                        value: 'Islam',
                        text: 'Islam',
                        selected: receivedReligion === 'Islam'
                    },
                    {
                        value: 'Kristen',
                        text: 'Kristen',
                        selected: receivedReligion === 'Kristen'
                    },
                    {
                        value: 'Hindu',
                        text: 'Hindu',
                        selected: receivedReligion === 'Hindu'
                    },
                    {
                        value: 'Buddha',
                        text: 'Buddha',
                        selected: receivedReligion === 'Buddha'
                    },
                    {
                        value: 'Konghucu',
                        text: 'Konghucu',
                        selected: receivedReligion === 'Konghucu'
                    }
                ];

                $.each(religionList, function(index, empReligionOption) {
                    var option;
                    if (index === 0) {
                        option = $('<option disabled>');
                        option.attr('value', empReligionOption.value);
                        option.text(`${empReligionOption.text}`);
                    } else {
                        option = $('<option>');
                        option.attr('value', empReligionOption.value);
                        option.text(`${empReligionOption.text}`);
                    }

                    if (empReligionOption.selected) {
                        option.attr('selected', 'selected');
                    }

                    empReligionSelect.append(option);
                });
            }




            const saveRecordBtn = document.querySelector('#' + modalId + ' #confirmSave');
            if (saveRecordBtn) {
                saveRecordBtn.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default button behavior
                    targetedModalForm.submit(); // Submit the form if validation passes
                });
            }
        });
    </script> --}}


    {{--
    <script>
        $(document).ready(function() {
            $('.toggle-password').click(function() {
                var passwordInput = $('#Password');
                var passwordFieldType = passwordInput.attr('type');
                var passwordIcon = $('.password-icon');

                if (passwordFieldType === 'password') {
                    passwordInput.attr('type', 'text');
                    passwordIcon.attr('data-feather', 'eye-off');
                } else {
                    passwordInput.attr('type', 'password');
                    passwordIcon.attr('data-feather', 'eye');
                }

                feather.replace(); // Refresh the Feather icons after changing the icon attribute
            });
        });
    </script> --}}




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            whichModal = "delete_karyawanModal";
            const modalSelector = document.querySelector('#' + whichModal);

            if (modalSelector) {
                const modalToShow = new bootstrap.Modal(modalSelector);

                setTimeout(() => {
                    $('.delete-record').on('click', function() {
                        var karyawanID = $(this).attr('del_karyawan_id_value');
                        $('#' + whichModal + ' #del_karyawan_id').val(karyawanID);
                        modalToShow.show();
                    });
                }, 800);
            }
        });
    </script>
@endsection
