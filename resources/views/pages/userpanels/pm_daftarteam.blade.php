@php
    $page = Session::get('page');
    $page_title = $page['page_title'];
    // $authenticated_user_data = Session::get('authenticated_user_data');

    // dd($authenticated_user_data);
@endphp

@extends('layouts.userpanels.v_main')

@section('header_page_cssjs')
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
                            <table id="daftarTeamTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Act</th>
                                        <th>Team Name</th>
                                        <th>Assigned to </th>
                                        <th>Created</th>
                                        <th>Last-Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{dd($loadDaftarTeamFromDB->toArray());}} --}}
                                    @foreach ($loadDaftarTeamFromDB as $team)
                                        <tr>
                                            <td>
                                                <div class="dropdown d-lg-block d-sm-block d-md-block">
                                                    <button class="btn btn-icon navbar-toggler" type="button"
                                                        id="tableActionDropdown" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i data-feather="align-justify" class="font-medium-5"></i>
                                                    </button>
                                                    <!-- dropdown menu -->
                                                    <div class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="tableActionDropdown">
                                                        <a class="edit-record dropdown-item d-flex align-items-center"
                                                            team_id_value = "{{ $team->id_team }}"
                                                            karyawan_id_value = "{{ $team->karyawan !== null ? $team->karyawan->id_karyawan : 0 }}"
                                                            onclick="openModal('{{ $modalData['modal_edit'] }}')">
                                                            <i data-feather="edit" class="mr-1" style="color: #28c76f;"></i>
                                                            Edit
                                                        </a>
                                                        <a class="delete-record dropdown-item d-flex align-items-center"
                                                            team_id_value = "{{ $team->id_team }}"
                                                            onclick="openModal('{{ $modalData['modal_delete'] }}')">
                                                            <i data-feather="trash" class="mr-1" style="color: #ea5455;"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                    <!--/ dropdown menu -->
                                                </div>
                                            </td>
                                            <td>{{ $team->na_team ?: '-' }}</td>
                                            <td>{{ $team->karyawan !== null ? $team->karyawan->na_karyawan : '-' }}</td>
                                            <td>
                                                @if ($team->created_at)
                                                    {{ \Carbon\Carbon::parse($team->created_at)->isoFormat('dddd, DD MMMM YYYY, h:mm:ss A') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($team->updated_at)
                                                    {{ \Carbon\Carbon::parse($team->updated_at)->isoFormat('dddd, DD MMMM YYYY, h:mm:ss A') }}
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



        <!-- BEGIN: AddTimModal--> @include('v_res.m_modals.userpanels.m_daftartim.v_add_timModal') <!-- END: AddTimModal-->
        <!-- BEGIN: EditTimModal--> @include('v_res.m_modals.userpanels.m_daftartim.v_edit_timModal') <!-- END: EditTimModal-->
        <!-- BEGIN: DelTimModal--> @include('v_res.m_modals.userpanels.m_daftartim.v_del_timModal') <!-- END: DelTimModal-->
        <!-- BEGIN: ResetTimModal--> @include('v_res.m_modals.userpanels.m_daftartim.v_reset_timModal') <!-- END: ResetTimModal-->




    @endauth
@endsection


@section('footer_page_js')
    <script src="{{ asset('public/theme/vuexy/app-assets/js/scripts/components/components-modals.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#daftarTeamTable').DataTable({
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
            const modalId = 'edit_roleModal';
            const modalSelector = document.getElementById(modalId);
            const modalToShow = new bootstrap.Modal(modalSelector);
            const targetedModalForm = document.querySelector('#' + modalId + ' #edit_roleModalFORM');

            $(document).on('click', '.edit-record', function(event) {
                var jabID = $(this).attr('team_id_value');
                var karyawanID = $(this).attr('karyawan_id_value');
                console.log('Edit button clicked for team_id:', jabID);

                setTimeout(() => {
                    $.ajax({
                        url: '{{ route('m.emp.roles.getrole') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Update the CSRF token here
                        },
                        data: {
                            jabatanID: jabID,
                            karyawanID: karyawanID
                        },
                        success: function(response) {
                            console.log(response);
                            $('#team_id').val(response.id_jabatan);
                            $('#karyawan_id').val(response.id_karyawan);
                            $('#role_name').val(response.na_jabatan);
                            setEmpList(response);

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




            function setEmpList(response) {
                var empSelect = $('#' + modalId +
                    ' #edit-team-karyawan-id');
                empSelect.empty(); // Clear existing options
                empSelect.append($('<option>', {
                    value: "",
                    text: "Select Employee"
                }));
                $.each(response.employeeList, function(index,
                    empOption) {
                    var option = $('<option>', {
                        value: empOption.value,
                        text: `[${empOption.value}] ${empOption.text}`
                    });
                    if (empOption.selected) {
                        option.attr('selected',
                            'selected'); // Select the option
                    }
                    empSelect.append(option);
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
            whichModal = "delete_teamModal";
            const modalSelector = document.querySelector('#' + whichModal);
            const modalToShow = new bootstrap.Modal(modalSelector);

            setTimeout(() => {
                $('.delete-record').on('click', function() {
                    var teamID = $(this).attr('team_id_value');
                    $('#' + whichModal + ' #team_id').val(teamID);
                    modalToShow.show();
                });
            }, 200);

        });
    </script>
@endsection
