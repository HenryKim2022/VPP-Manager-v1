@php
    $page = Session::get('page');
    $page_title = $page['page_title'];
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
@endsection


@section('page-content')
    {{-- @if (auth()->user()->type == 'Super Admin' || auth()->user()->type == 'Admin')
        <h1>HI MIN :)</h1>
    @endif

    @if (auth()->user()->type == 'Karyawan')
        <h1>HI WAN :)</h1>
    @endif --}}

    {{-- {{ dd($authenticated_user_data) }} --}}

    @auth
        <section id="dashboard-ecommerce">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{ $page_title }}</h2>
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
                            <table id="daftarLoginKaryawanTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Act</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>No. Telp</th>
                                        <th>Photo</th>
                                        <th>Birth-Place</th>
                                        <th>DOB</th>
                                        <th>Religion</th>
                                        <th>Created</th>
                                        <th>Last-Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{dd($loadDaftarKaryawanFromDB->toArray());}} --}}
                                    @foreach ($loadDaftarKaryawanFromDB as $karyawan)
                                        <tr>
                                            <td>{{ $karyawan->id_karyawan ?: '-' }}</td>
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
                                                            edit_karyawan_id_value = "{{ $karyawan->id_karyawan ?: 0 }}"
                                                            onclick="openModal('{{ $modalData['modal_edit'] }}')">
                                                            <i data-feather="edit" class="mr-1" style="color: #28c76f;"></i>
                                                            Edit
                                                        </a>
                                                        <a class="delete-record dropdown-item d-flex align-items-center"
                                                            del_karyawan_id_value = "{{ $karyawan->id_karyawan ?: 0 }}"
                                                            onclick="openModal('{{ $modalData['modal_delete'] }}')">
                                                            <i data-feather="trash" class="mr-1" style="color: #ea5455;"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                    <!--/ dropdown menu -->
                                                </div>
                                            </td>
                                            <td>{{ $karyawan->na_karyawan ?: '-' }}</td>

                                            <td>{{ $karyawan->alamat_karyawan ?: '-' }}</td>
                                            <td>{{ $karyawan->notelp_karyawan ?: '-' }}</td>
                                            <td>
                                                @if ($karyawan->foto_karyawan !== null)
                                                    <div class="d-flex align-items-center justify-content-around">
                                                        <img src="{{ 'public/avatar/uploads/' . $karyawan->foto_karyawan }}"
                                                            alt="Proof 0" style="height: 24px; width: 24px;"
                                                            class="hover-qr-image">
                                                    </div>
                                                @else
                                                    <div class="d-flex align-items-center justify-content-around">
                                                        -
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $karyawan->tlah_karyawan ?: '-' }}</td>
                                            <td>
                                                @if ($karyawan->tglah_karyawan)
                                                    {{ \Carbon\Carbon::parse($karyawan->tglah_karyawan)->isoFormat('DD MMMM YYYY') }}
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td>{{ $karyawan->agama_karyawan ?: '-' }}</td>

                                            <td>
                                                @if ($karyawan->created_at)
                                                    {{ \Carbon\Carbon::parse($karyawan->created_at)->isoFormat('dddd, DD MMMM YYYY, h:mm:ss A') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($karyawan->updated_at)
                                                    {{ \Carbon\Carbon::parse($karyawan->updated_at)->isoFormat('dddd, DD MMMM YYYY, h:mm:ss A') }}
                                                @else
                                                    -
                                                @endif
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
