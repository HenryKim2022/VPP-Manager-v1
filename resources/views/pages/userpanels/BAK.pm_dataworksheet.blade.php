@php
    $page = Session::get('page');
    $page_title = $page['page_title'];
    $cust_date_format = 'ddd, DD MMM YYYY';
    $cust_time_format = 'hh:mm:ss A';
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


                <!--  Check $data as array -->
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <pre style="color: white">{{ print_r($loadDataDailyWS->toArray(), true) }}</pre>
                            <br>
                            <pre style="color: white">{{ print_r($clientData->toArray(), true) }}</pre>
                            <br>
                            <pre style="color: white">{{ print_r($loadRelatedDailyWS->toArray(), true) }}</pre>
                        </div>
                    </div>
                </div>


                <!-- TableAbsen Card -->
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="card card-developer-meetup">
                        <div class="card-body p-1">

                            <div class="engineer-text">
                                {{-- <a class="text-right"> --}}
                                <h3 class="mt-2 mb-0 pr-xl-4 pr-md-3 pr-sm-1 pr-1 cursor-default text-end">ENGINEER</h3>
                                {{-- </a> --}}
                            </div>

                            <div class="row match-height">
                                <!-- Left Card 1st -->
                                <div class="col-xl-3 col-md-6 col-12 d-flex align-items-center">
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
                                                    <h3 class="mt-0 mb-0 underline-text">PROJECT DAILY
                                                        WORKSHEET<br>( LEMBAR KERJA HARIAN )</h3>
                                                </strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Right Card 1st -->

                                <!-- Left Card 2nd -->
                                <div class="col-xl-8 col-md-8 col-12">
                                    <div class="card mb-0">
                                        <div class="card-body pt-0">
                                            <table class="bordered-layout border-accent-1">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>DESCRIPTION</strong></td>
                                                        <td class="pl-2">: </td>
                                                        <td>
                                                            {{ $loadDataDailyWS->id_project }}
                                                            {{-- <form class="row g-2 needs-validation mt-1" method="POST"
                                                                action="{{ route('m.emp.edit') }}" id="edit_projectID_dwsFORM"
                                                                enctype="multipart/form-data" novalidate>
                                                                @csrf
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <select class="select2 form-control form-control-lg"
                                                                            edit_dws_id={{ $loadDataDailyWS->id_project }}
                                                                            name="edit-mondws-prjID" id="edit-mondws-prjID">
                                                                            <option value="">PRJ-24-000000</option>
                                                                            <option value="">PRJ-24-000001</option>
                                                                            <option value="">PRJ-24-000002</option>
                                                                            <option value="">PRJ-24-000003</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </form> --}}

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>CLIENT'S NAME</strong></td>
                                                        <td class="pl-2">: </td>
                                                        <td>
                                                            {{ $clientData->na_client }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>DATE</strong></td>
                                                        <td class="pl-2">: </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($loadDataDailyWS->created_at)->isoFormat($cust_date_format) }}
                                                            {{-- <form class="row g-2 needs-validation mt-1" method="POST"
                                                                action="{{ route('m.emp.edit') }}" id="edit_workDate_dwsFORM"
                                                                enctype="multipart/form-data" novalidate>
                                                                @csrf
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <input type="date" class="form-control"
                                                                            id="edit-mondws-WorkDate"
                                                                            name="edit-mondws-WorkDate"
                                                                            placeholder="Working Date" value="1999-01-01" />
                                                                    </div>
                                                                </div>

                                                            </form> --}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Left Card 2nd -->
                                <!-- Right Card 2nd -->
                                <div class="col-xl-4 col-md-4 col-12">
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
                                                        <td>{{ \Carbon\Carbon::parse($loadDataDailyWS->arrival_time_dws)->isoFormat($cust_time_format) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>FINISH TIME</strong></td>
                                                        <td class="pl-2">: </td>
                                                        <td>{{ \Carbon\Carbon::parse($loadDataDailyWS->finish_time_dws)->isoFormat($cust_time_format) }}
                                                        </td>
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
                            <table id="daftarLoginKaryawanTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="cell-fit text-center">Act</th>
                                        <th rowspan="2" class="text-center">Time</th>
                                        <th rowspan="2" class="text-center">Task</th>
                                        <th rowspan="2" class="text-center">Description</th>
                                        <th colspan="2" class="text-center">Progress</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Actual</th>
                                        <th class="text-center">Current</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loadRelatedDailyWS['dailyws'] as $relDWS)
                                        <tr>
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
                                                            edit_dws_id_value = "{{ $relDWS->id_dws ?: 0 }}"
                                                            {{-- onclick="openModal('{{ $modalData['modal_edit'] }}')" --}}>
                                                            <i data-feather="edit" class="mr-1"
                                                                style="color: #28c76f;"></i>
                                                            Edit
                                                        </a>
                                                        <a class="delete-record dropdown-item d-flex align-items-center"
                                                            del_dws_id_value = "{{ $relDWS->id_dws ?: 0 }}"
                                                            {{-- onclick="openModal('{{ $modalData['modal_delete'] }}')" --}}>
                                                            <i data-feather="trash" class="mr-1"
                                                                style="color: #ea5455;"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                    <!--/ dropdown menu -->
                                                </div>
                                            </td>
                                            <td>
                                                {{ $relDWS->working_time_dws }}
                                            </td>
                                            <td>
                                                {{ $loadRelatedDailyWS->task }}
                                                {{-- <form class="row g-2 needs-validation mt-1" method="POST"
                                                    action="{{ route('m.emp.edit') }}" id="edit_task_dwsFORM"
                                                    enctype="multipart/form-data" novalidate>
                                                    @csrf
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <select class="select2 form-control form-control-lg"
                                                                edit_dws_id={{ $loadDataDailyWS->id_project }}
                                                                name="edit-mondws-prjID" id="edit-mondws-prjID">
                                                                <option value="">Meng-aaa</option>
                                                                <option value="">Meng-bbbbbbbb</option>
                                                                <option value="">Meng-cccccc</option>
                                                                <option value="">Meng-ddddddddddd</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form> --}}
                                            </td>
                                            <td>
                                                {{ $relDWS->descb_dws }}
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ $relDWS->progress_actual_dws }}%
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ $relDWS->progress_current_dws }}%
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!--/ TableAbsen Card -->



            </div>



        </section>



        <!-- BEGIN: AdKkaryawanModal--> @include('v_res.m_modals.userpanels.m_daftarkaryawan.v_add_karyawanModal') <!-- END: AddKaryawanModal-->
        <!-- BEGIN: EditKaryawanModal--> @include('v_res.m_modals.userpanels.m_daftarkaryawan.v_edit_karyawanModal') <!-- END: EditKaryawanModal-->
        <!-- BEGIN: DelKaryawanModal--> @include('v_res.m_modals.userpanels.m_daftarkaryawan.v_del_karyawanModal') <!-- END: DelKaryawanModal-->
        <!-- BEGIN: ResetKaryawanModal--> @include('v_res.m_modals.userpanels.m_daftarkaryawan.v_reset_karyawanModal') <!-- END: ResetKaryawanModal-->




    @endauth
@endsection


@section('footer_page_js')
    <script src="{{ asset('public/theme/vuexy/app-assets/js/scripts/components/components-modals.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#daftarLoginKaryawanTable').DataTable({
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
    </script>



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
    </script>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            whichModal = "delete_karyawanModal";
            const modalSelector = document.querySelector('#' + whichModal);
            const modalToShow = new bootstrap.Modal(modalSelector);

            setTimeout(() => {
                $('.delete-record').on('click', function() {
                    var karyawanID = $(this).attr('del_karyawan_id_value');
                    $('#' + whichModal + ' #del_karyawan_id').val(karyawanID);
                    modalToShow.show();
                });
            }, 800);
        });
    </script>
@endsection
