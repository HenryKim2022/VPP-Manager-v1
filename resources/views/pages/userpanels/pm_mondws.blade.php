@php
    $page = Session::get('page');
    $page_title = $page['page_title'];
    $cust_date_format = 'ddd, DD MMM YYYY';

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

    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/js.tree@3.2.1/style.min.css') }}">
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
                                        <div class="card mb-0">
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
                                        <div class="card">
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

                            <table id="daftarLoginKaryawanTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Act</th>
                                        <th>Category</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Qty (100%)</th>
                                        <th>Update Progress (0-100%)</th>
                                        <th>Total Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @if ($prjmondws->monitor)
                                        @foreach ($prjmondws->monitor as $mon)
                                            <tr>
                                                <td>{{ $no++ }}</td>
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
                                                <td>{{ $mon->task ?: '-' }}</td>
                                                <td>
                                                    @if ($mon->start_date)
                                                        {{ \Carbon\Carbon::parse($mon->start_date)->isoFormat($cust_date_format) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($mon->end_date)
                                                        {{ \Carbon\Carbon::parse($mon->end_date)->isoFormat($cust_date_format) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $mon->qty . '%' ?: '-' }}</td>
                                                <td></td>
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


            <div class="row match-height">
                <!-- QRCodeCheck-out Card -->
                <div class="col-lg-4 col-md-6 col-12">
                </div>
                <!--/ QRCodeCheck-out Card -->
                <!-- TableAbsen Card -->
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="card card-developer-meetup">
                        <div class="card-body p-1">

                            <!-- JSTree Card v1 -->
                            {{-- <input type="text" id="jstree-search-input" placeholder="Search..." /> --}}
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="jstree-search-input" placeholder="Search...">
                            </div>
                            <div id="jstree_demo" class="jstree"></div>

                        </div>








                        {{--
                            <!-- JS Card v0 -->
                            <style>
                                .tree-list {
                                    list-style: none;
                                    padding-left: 0;
                                }

                                .tree-list li {
                                    margin-bottom: 5px;
                                }

                                .tree-list>li {
                                    padding-left: 20px;
                                }

                                .tree-list li i {
                                    margin-right: 5px;
                                }

                                .tree-list ul {
                                    padding-left: 20px;
                                    /* Initially hide all sub-lists */
                                    display: none;
                                    /* This is crucial */
                                }

                                .tree-list li.open>ul {
                                    /* Be more specific to avoid conflicts */
                                    display: block;
                                }

                                .tree-list li i.arrow {
                                    margin-right: 5px;
                                    cursor: pointer;
                                    /* Indicate it's clickable */
                                    transition: transform 0.3s ease;
                                }

                                .tree-list li.open i.arrow {
                                    transform: rotate(90deg);
                                }

                                /* Add this to ensure visibility during search */
                                .tree-list li[style*="display: block"] ul {
                                    display: block;
                                    /* Show sub-lists if parent is visible due to search */
                                }

                                .tree-list li {
                                    cursor: pointer;
                                    list-style: none;
                                    /* Make the entire list item clickable */
                                }
                            </style>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                            </div>
                            <h3 class="text-center">Daily Worksheet: {{ $project->na_project }}</h3>
                            <ul class="tree-list" id="treeView">
                                @if ($tree)
                                    @foreach ($tree as $monitoringId => $monitoringData)
                                        <li data-search-term="{{ strtolower($monitoringData['title'] . ' ' . ($monitoringData['subtitle'] ?? '')) }}"
                                            class="{{ $loop->first ? 'open' : '' }}">
                                            <i class="arrow fas fa-chevron-right" onclick="toggleList(this)"></i>
                                            <i class="fas fa-folder"></i> {{ $monitoringData['title'] }}
                                            @if (isset($monitoringData['subtitle']))
                                                <span class="subtitle">{{ $monitoringData['subtitle'] }}</span>
                                            @endif
                                            <ul>
                                                @foreach ($monitoringData['dws'] as $dwsData)
                                                    <li
                                                        data-search-term="{{ strtolower($dwsData['descb_dws'] . ' ' . ($dwsData['subtitle'] ?? '')) }}">
                                                        <i class="fas fa-file"></i> {{ $dwsData['descb_dws'] }}
                                                        @if (isset($dwsData['subtitle']))
                                                            <span class="subtitle">{{ $dwsData['subtitle'] }}</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-center">No data available in tree.</li>
                                @endif
                            </ul> --}}
                    </div>
                </div>
            </div>
            <!--/ TableAbsen Card -->

            {{-- <script>
                    function toggleList(element) {
                        const parentLi = element.closest('li');
                        parentLi.classList.toggle('open');
                        const children = parentLi.querySelector('ul');
                        if (children) {
                            children.style.display = parentLi.classList.contains('open') ? 'block' : 'none';
                        }
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        const searchInput = document.getElementById('searchInput');
                        const listItems = document.querySelectorAll('#treeView li');
                        let originalTreeState = {};

                        listItems.forEach(item => {
                            originalTreeState[item.id] = item.classList.contains('open');
                        });

                        searchInput.addEventListener('input', function() {
                            const searchTerms = this.value.trim().toLowerCase().split(/[;,]/); // Split by ; or ,
                            listItems.forEach(item => {
                                const searchTermInItem = item.dataset.searchTerm.trim().toLowerCase();
                                let match = true;

                                searchTerms.forEach(term => {
                                    if (term.trim() !== "" && !searchTermInItem.includes(term.trim())) {
                                        match = false;
                                    }
                                });

                                item.style.display = match ? 'block' : 'none';

                                let parent = item.parentElement.parentElement;
                                if (parent && match) {
                                    parent.style.display = 'block';
                                }
                            });

                            if (this.value.trim() === "") {
                                for (const itemId in originalTreeState) {
                                    const item = document.getElementById(itemId);
                                    if (item) {
                                        item.classList.toggle('open', originalTreeState[itemId]);
                                        const children = item.querySelector('ul');
                                        if (children) {
                                            children.style.display = originalTreeState[itemId] ? 'block' : 'none';
                                        }
                                        item.style.display = 'block';
                                    }
                                }
                            }
                        });

                        // Attach event listeners to both the arrow and the title
                        document.querySelectorAll('#treeView li').forEach(item => {
                            item.addEventListener('click', function(event) {
                                if (event.target.tagName === 'LI' || event.target.classList.contains('arrow')) {
                                    toggleList(event.target);
                                }
                            });
                        });
                    });
                </script> --}}





            </div>
            {{--
            <script>
                const rootProjects = @json($rootProjects); // Pass the data from the controller

                function renderTree(projects, parentId = null) {
                  const ul = document.createElement('ul');
                  projects.forEach(project => {
                    if (project.parent_project_id === parentId) {
                      const li = document.createElement('li');
                      li.textContent = project.na_project;
                      li.appendChild(renderTree(projects, project.id_project)); // Recursive call
                      ul.appendChild(li);
                    }
                  });
                  return ul;
                }

                document.getElementById('project-tree').appendChild(renderTree(rootProjects));
            </script> --}}



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




    {{--
    <script>
        $(function() {
            $('#jstree_demo').jstree({
                'core': {
                    // 'data': [{
                    //         'text': 'Root node 1',
                    //         'children': [{
                    //                 'text': 'Child node 1'
                    //             },
                    //             {
                    //                 'text': 'Child node 2'
                    //             }
                    //         ]
                    //     },
                    //     {
                    //         'text': 'Root node 2',
                    //         'children': [{
                    //                 'text': 'Child node 3'
                    //             },
                    //             {
                    //                 'text': 'Child node 4'
                    //             }
                    //         ]
                    //     }
                    // ]
                },
                "plugins": ["contextmenu", "search"], // Add the search plugin
                "contextmenu": {
                    "items": function(node) {
                        let items = {
                            "create": {
                                "label": "Create",
                                "action": function(obj) {
                                    this.create_node(obj.reference, {
                                        "text": "New node"
                                    }, "last", function(new_node) {
                                        setTimeout(function() {
                                            $('#jstree_demo').jstree(
                                                "select_node", new_node);
                                        }, 0);
                                    });
                                }
                            },
                            "rename": {
                                "label": "Rename",
                                "action": function(obj) {
                                    this.rename(obj.reference);
                                }
                            },
                            "remove": {
                                "label": "Delete",
                                "action": function(obj) {
                                    this.delete_node(obj.reference);
                                }
                            },
                            "sep1": "---------",
                            "ccp": {
                                "label": "Copy/Paste",
                                "action": false,
                                "submenu": {
                                    "cut": {
                                        "label": "Cut",
                                        "action": function(obj) {
                                            this.cut(obj.reference);
                                        }
                                    },
                                    "copy": {
                                        "label": "Copy",
                                        "action": function(obj) {
                                            this.copy(obj.reference);
                                        }
                                    },
                                    "paste": {
                                        "label": "Paste",
                                        "action": function(obj) {
                                            this.paste(obj.reference);
                                        }
                                    }
                                }
                            }
                        };

                        if (node.id === '#') {
                            delete items.remove;
                        }
                        return items;
                    }
                }
            });

            var to = false;
            $('#jstree-search-input').keyup(function() {
                if (to) {
                    clearTimeout(to);
                }
                to = setTimeout(function() {
                    var v = $('#jstree-search-input').val();
                    $('#jstree_demo').jstree(true).search(v);
                }, 250);
            });
        });
    </script> --}}



    <script>
        $(function() {
            const treeData = @json($tree);

            // Note:
            // treeData hold these value:
            // 0: {
            //     text: 'Finishing pekerjaan pengelasan',
            //     children: {
            //         0 : {text: '- A', id: 1, url: 'http://100.100.100.58/dailyws/1'}
            //         1 : {text: '- B', id: 2, url: 'http://100.100.100.58/dailyws/2'}
            //     }
            // },

            // how to apply the url into the related childern ?? ?


            console.log(treeData);
            // if (!treeData || treeData.length === 0) {
            //     console.error("Error: Tree data is empty or invalid.");
            //     $('#jstree_demo').html('<p>Error loading tree data.</p>');
            //     return;
            // }


            // Restructure the treeData to be an array of objects
            const restructuredData = treeData.map(item => {
                return {
                    text: item.text,
                    children: Object.values(item.children ||
                        {}) // Handle cases where children might be missing
                };
            });


            console.log("Restructured Data:", restructuredData); // Check the new structure

            if (!restructuredData || restructuredData.length === 0) {
                console.error("Error: Tree data is empty or invalid.");
                $('#jstree_demo').html('<p>Error loading tree data.</p>');
                return;
            }


            $('#jstree_demo').jstree({
                'core': {
                    // 'data': treeData,
                    'data': restructuredData,
                    'themes': {
                        'name': 'default',
                        'responsive': true // Add responsive theme
                    }
                },
                "plugins": ["contextmenu", "search", "types"], // Added types plugin
                "types": {
                    "#": {
                        "icon": "fas fa-folder" // Icon for root nodes
                    },
                    "default": {
                        "icon": "fas fa-file" // Icon for default nodes
                    }

                },
                "contextmenu": {
                    "items": function(node) {
                        let items = {
                            "create": {
                                "label": "Create",
                                "action": function(obj) {
                                    let newNodeText = prompt("Enter new node name:",
                                        "New Node");
                                    if (newNodeText) {
                                        this.create_node(obj.reference, {
                                            "text": newNodeText
                                        }, "last", function(new_node) {
                                            setTimeout(function() {
                                                $('#jstree_demo').jstree(
                                                    "select_node", new_node);
                                            }, 0);
                                        });
                                    }
                                }
                            },
                            "rename": {
                                "label": "Rename",
                                "action": function(obj) {
                                    this.rename(obj.reference);
                                }
                            },
                            "remove": {
                                "label": "Delete",
                                "action": function(obj) {
                                    this.delete_node(obj.reference);
                                }
                            },
                            "sep1": "---------",
                            "ccp": {
                                "label": "Copy/Paste",
                                "action": false,
                                "submenu": {
                                    "cut": {
                                        "label": "Cut",
                                        "action": function(obj) {
                                            this.cut(obj.reference);
                                        }
                                    },
                                    "copy": {
                                        "label": "Copy",
                                        "action": function(obj) {
                                            this.copy(obj.reference);
                                        }
                                    },
                                    "paste": {
                                        "label": "Paste",
                                        "action": function(obj) {
                                            this.paste(obj.reference);
                                        }
                                    }
                                }
                            }
                        };

                        if (node.id === '#') {
                            delete items.remove;
                        }
                        return items;
                    }
                }
            }).on('ready.jstree', function() {
                console.log("jstree ready");
            }).on('error.jstree', function(e, data) {
                console.error("jstree error:", data);
            });


            var to = false;
            $('#jstree-search-input').keyup(function() {
                if (to) {
                    clearTimeout(to);
                }
                to = setTimeout(function() {
                    var v = $('#jstree-search-input').val();
                    $('#jstree_demo').jstree(true).search(v);
                }, 250);
            });

            $('#jstree_demo').on('select_node.jstree', function(e, data) {
                var node = data.node;
                if (node.original.url) {
                    window.location.href = node.original.url;
                }
            });
        });
    </script>
@endsection
