@extends('layouts.dashboard')

@section('content')

<div class="content-wrapper">
    @if(session()->get('success'))
    <div class="successmessage">
        <div class="alert alert-success" role="alert">
            <strong>{{ session()->get('success') }}</strong>
        </div>
        <script type="text/javascript">
            $(".successmessage").show().delay(5000).fadeOut();
        </script>
    </div><br />
    @elseif(session()->get('error'))
    <div class="errormessage">
        <div class="alert alert-danger mb-0" role="alert">
            <strong>{{ session()->get('error') }}</strong>
        </div>
        <script type="text/javascript">
            $(".errormessage").show().delay(5000).fadeOut();
        </script>
    </div><br />
    @endif

    @if(!empty(Session::get('error_code')) && Session::get('error_code') == "add")
    <script type="text/javascript">
        $(function() {
            $('#addEmployeeModal').modal('show');
            //$('.error_div').show();
        });
    </script>
    @endif

    @if(!empty(Session::get('error_code')) && Session::get('error_code') == "edit")
    <script type="text/javascript">
        $(function() {
            $('#editEmployeeModal').modal('show');
            //$('.error_div1').show();
        });
    </script>
    @endif
    <!-- Content Header (Page header) -->
    <div class="content-header pd-left-side">
        <div class="container-fluid p-0">
            <div class="d-flex bg-white header-row-1">

                <span><img src="{{ asset('img/users.png') }}" alt=""></span>
                Employees

                <ul class="ml-auto">
                    <li>Home /</li>
                    <li> Employees</li>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content pd-left-side">
        <div class="container-fluid p-0">
            <!-- small box -->
            <div class="service-record-section">
                <div class="small-box bg-white custom-records">
                    <div>
                        <h2>Employees List</h2>
                    </div>
                    <form class="record-form ml-auto">
                        
                    </form>
                    <!-- <a href="#">Filters<img src="{{ asset('img/chevron-down.svg') }}"></a> -->
                    <button type="button" class="add-employee-link" data-toggle="modal" data-target="#addEmployeeModal">
                        <img src="{{ asset('img/plus-circle.svg') }}" width="20">
                        <h5>Add Employee</h5>
                    </button>
                </div>
                <div class="table-section-records">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-section">
                            <div class="table-responsive table-header-border">
                                <table id="example2" class="table-striped table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Employee Code</th>
                                            <th>Employee Name</th>
                                            <th>E-Mail</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach($all_employees as $employee)

                                        <tr>
                                            <td>{{$i}}</td>
                                            @if(isset($employee['userEmployeeDetails']['emp_id']) && $employee['userEmployeeDetails']['emp_id'] != NULL)
                                            <td>{{$employee['userEmployeeDetails']['emp_id']}}</td>
                                            @else
                                            <td></td>
                                            @endif
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->email }}</td>
                                           
                                       
                                            <td class="d-flex table-data table-share">
                                                <!-- <span><img src="{{ asset('img/share.png') }}" width="18" height="18">Share</span>
                                                                <span><img src="{{ asset('img/eye.svg') }}" width="16" height="16">view</span> -->
                                                <span>
                                                    <a class="conf_edit" href="javascript:;" data-href="{{ url('employee/viewEmployee/') }}/{{$employee->id}}"> <img src="{{ asset('img/edit.svg') }}" width="16" height="16" />edit</a>
                                                </span>
                                                <span>
                                                    <a onclick="return confirm('Are you sure?')" href="{{ url('employee/deleteEmployee/') }}/{{$employee->id}}"><img src="{{ asset('img/trash-2.svg') }}" width="16" height="16" />delete</a>
                                                </span>
                                            </td>
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.card -->

                <!--modal popup  -->
                <!--Add Employee popup  -->
                <div class="modal fade employee-modal-popup" id="addEmployeeModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Employee</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addEmployeeForm" role="form" method="post" action="{{ route('saveEmployee') }}" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" id="emp_name" name="emp_name" value="{{ old('emp_name') }}" class="form-control @error('emp_name') is-invalid @enderror" placeholder="Employee name" minlength="3" />
                                        @error('emp_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="emp_no" name="emp_no" placeholder="Employee ID" value="" class="form-control @error('emp_no') is-invalid @enderror" minlength="1" />
                                        @error('emp_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="email" id="emp_email" placeholder="E-Mail address" name="emp_email" value="" class="form-control @error('emp_email') is-invalid @enderror" />
                                        @error('emp_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <select id="region" name="region" class="form-control @error('region') is-invalid @enderror">
                                            <option value="">Region</option>
                                            @foreach($regions as $type)
                                            <option value="{{$type['id']}}">{{$type['caption']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" id="phoneno" name="phoneno" placeholder="xxx xxx xxxx" class="form-control @error('phoneno') is-invalid @enderror" minlength="12" />
                                        @error('phoneno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <select id="titleposition" name="titleposition" class="form-control @error('titleposition') is-invalid @enderror">
                                            <option value="" disabled selected hidden>Title/position</option>
                                            @foreach($titlepositions as $type)
                                            <option value="{{$type['id']}}">{{$type['caption']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select id="jobgroup" name="jobgroup" value="{{$type['id']}}" class="form-control @error('jobgroup') is-invalid @enderror">
                                            <option value="" disabled selected hidden>Jobgroup</option>
                                            @foreach($jobgroups as $type)
                                            <option value="{{$type['id']}}">{{$type['caption']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="emp_password" placeholder="Password" name="emp_password" value="{{ old('emp_password') }}" class="form-control @error('emp_password') is-invalid @enderror" />
                                        @error('emp_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="justify-content-center d-flex">
                                        <input type="hidden" id="emp_id" name="emp_id" value="0" />
                                        <button type="submit" class="btn-popup">Add Employee</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <!--Edit Employee popup  -->
                <div class="modal fade employee-modal-popup" id="editEmployeeModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Employee</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editEmployeeForm" role="form" method="post" action="{{ route('saveEmployee') }}" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="emp_name" value="{{ old('emp_name') }}" class="form-control @error('emp_name') is-invalid @enderror emp_name" placeholder="Employee name" minlength="3" />
                                        @error('emp_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="emp_no" placeholder="Employee ID" value="{{ old('emp_no') }}" class="form-control @error('emp_no') is-invalid @enderror emp_no" minlength="1" />
                                        @error('emp_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="email" placeholder="E-Mail address" name="emp_email" value="{{ old('emp_email') }}" class="form-control @error('emp_email') is-invalid @enderror emp_email" readonly />
                                        @error('emp_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="phoneno" placeholder="Phone" class="form-control @error('phoneno') is-invalid @enderror phoneno" minlength="12" />
                                        @error('phoneno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <select name="region" class="form-control @error('region') is-invalid @enderror region">
                                            <option value="" disabled selected hidden >Region</option>
                                            @foreach($regions as $type)
                                            <option value="{{$type['id']}}">{{$type['caption']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select  name="titleposition" class=" titleposition form-control @error('titleposition') is-invalid @enderror">
                                            <option value="" disabled selected hidden>Title/position</option>
                                            @foreach($titlepositions as $type)
                                            <option value="{{$type['id']}}">{{$type['caption']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="jobgroup" value="{{$type['id']}}" class="form-control @error('jobgroup') is-invalid @enderror jobgroup ">
                                            <option value="" disabled selected hidden>Jobgroup</option>
                                            @foreach($jobgroups as $type)
                                            <option value="{{$type['id']}}">{{$type['caption']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input type="hidden" class="emp_id" name="emp_id" value="0" />
                                        <button type="submit" class="btn-popup">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--modal popup  -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>


<script>
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    $('body').on('click', '.conf_edit', function() {
        var editUrl = $(this);
        $.get("" + editUrl.data("href"), function(data) {
            $('#editEmployeeModal').modal('show');
            $('#editEmployeeModal .emp_name').val(data.name);
            $('#editEmployeeModal .emp_email').val(data.email);
            $('#editEmployeeModal .phoneno').val(data.phone);
            // console.log(data.user_employee_details.jobgroup_id);
            $('#editEmployeeModal .region').val(data.user_employee_details.region_id);
            $('#editEmployeeModal .titleposition').val(data.user_employee_details.titleposition_id);
             $('#editEmployeeModal .jobgroup').val(data.user_employee_details.jobgroup_id);
            $('#editEmployeeModal .emp_id').val(data.id);
            $('#editEmployeeModal .emp_no').val(data.user_employee_details.emp_id);
        });
    });
</script>
@endsection