@php
    $page = Session::get('page');
    $page_title = $page['page_title'];
    $cust_date_format = $page['custom_date_format'];
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
                            <table id="daftarProjectTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Act</th>
                                        <th>Project-No</th>
                                        <th>Project Name</th>
                                        <th>Linked Customer Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{dd($loadDaftarProjectsFromDB->toArray());}} --}}
                                    @foreach ($loadDaftarProjectsFromDB as $project)
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
                                                        <a class="open-project-mw dropdown-item d-flex align-items-center"
                                                            project_id_value = "{{ $project->id_project }}"
                                                            client_id_value = "{{ $project->client !== null ? $project->client->id_client : 0 }}"
                                                            href="{{ route('m.projects.getprjmondws') . "?projectID=" . $project->id_project }}">
                                                            <i data-feather="navigation" class="mr-1"
                                                                style="color: #288cc7;"></i>
                                                            Navigate
                                                        </a>
                                                        <a class="edit-record dropdown-item d-flex align-items-center"
                                                            project_id_value = "{{ $project->id_project }}"
                                                            client_id_value = "{{ $project->client !== null ? $project->client->id_client : 0 }}"
                                                            onclick="openModal('{{ $modalData['modal_edit'] }}')">
                                                            <i data-feather="edit" class="mr-1" style="color: #28c76f;"></i>
                                                            Edit
                                                        </a>
                                                        <a class="delete-record dropdown-item d-flex align-items-center"
                                                            project_id_value = "{{ $project->id_project }}"
                                                            onclick="openModal('{{ $modalData['modal_delete'] }}')">
                                                            <i data-feather="trash" class="mr-1" style="color: #ea5455;"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                    <!--/ dropdown menu -->
                                                </div>
                                            </td>

                                            <td>
                                                @if ($project->id_project)
                                                    <div data-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-placement="bottom" data-original-title="Click to navigate!"
                                                        class="pull-up">
                                                        <a class="open-project-mw"
                                                            project_id_value = "{{ $project->id_project }}"
                                                            href="{{ route('m.projects.getprjmondws') . "?projectID=" . $project->id_project }}">
                                                            {{ $project->id_project ?: '-' }}
                                                        </a>
                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td>{{ $project->na_project ?: '-' }}</td>
                                            <td>
                                                {{ $project->client !== null ? $project->client->na_client : '-' }}
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



        <!-- BEGIN: AddPrjModal--> @include('v_res.m_modals.userpanels.m_daftarproject.v_add_prjModal') <!-- END: AddPrjModal-->
        <!-- BEGIN: EditPrjModal--> @include('v_res.m_modals.userpanels.m_daftarproject.v_edit_prjModal') <!-- END: EditPrjModal-->
        <!-- BEGIN: DelPrjModal--> @include('v_res.m_modals.userpanels.m_daftarproject.v_del_prjModal') <!-- END: DelPrjModal-->
        <!-- BEGIN: ResetPrjModal--> @include('v_res.m_modals.userpanels.m_daftarproject.v_reset_prjModal') <!-- END: ResetPrjModal-->




    @endauth
@endsection


@section('footer_page_js')
    <script src="{{ asset('public/theme/vuexy/app-assets/js/scripts/components/components-modals.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#daftarProjectTable').DataTable({
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
                $('.open-project-mw').on('click', function() {
                    var projectID = $(this).attr('project_id_value');
                    console.log("Navigate to Project-ID: " + projectID);
                });
            }, 200);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalId = 'edit_projectModal';
            const modalSelector = document.getElementById(modalId);
            const modalToShow = new bootstrap.Modal(modalSelector);
            const targetedModalForm = document.querySelector('#' + modalId + ' #edit_projectModalFORM');

            $(document).on('click', '.edit-record', function(event) {
                var prjID = $(this).attr('project_id_value');
                var prjName = $(this).attr('project_id_value');
                var clientID = $(this).attr('client_id_value');
                console.log('Edit button clicked for project_id:', prjID);

                setTimeout(() => {
                    $.ajax({
                        url: '{{ route('m.projects.getprj') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Update the CSRF token here
                        },
                        data: {
                            prjID: prjID,
                            prjName: prjName,
                            clientID: clientID
                        },
                        success: function(response) {
                            console.log(response);
                            $('#e-client-id').val(response.id_client);
                            $('#e-project-id').val(response.id_project);
                            $('#edit-project-id').val(response.id_project);
                            $('#edit-project-name').val(response.na_project);
                            setClientList(response);

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


            function setClientList(response) {
                var clientSelect = $('#' + modalId +
                    ' #edit-client-id');
                clientSelect.empty(); // Clear existing options
                clientSelect.append($('<option>', {
                    value: "",
                    text: "Select Customer"
                }));
                $.each(response.clientList, function(index,
                    clientOption) {
                    var option = $('<option>', {
                        value: clientOption.value,
                        text: `[${clientOption.value}] ${clientOption.text}`
                    });
                    if (clientOption.selected) {
                        option.attr('selected',
                            'selected'); // Select the option
                    }
                    clientSelect.append(option);
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
        document.addEventListener('DOMContentLoaded', function() {
            whichModal = "delete_projectModal";
            const modalSelector = document.querySelector('#' + whichModal);
            const modalToShow = new bootstrap.Modal(modalSelector);

            setTimeout(() => {
                $('.delete-record').on('click', function() {
                    var projectID = $(this).attr('project_id_value');
                    $('#' + whichModal + ' #project_id').val(projectID);
                    modalToShow.show();
                });
            }, 200);

        });
    </script>
@endsection
