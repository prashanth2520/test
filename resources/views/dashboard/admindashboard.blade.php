<style>
a.center {
  word-break: break-all;
}
div.boxx{
    padding: 10px;
}
h6.large{
    font-size: smaller;
}
  </style>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white custom-box1">
                    <div class="inner inner-card">
                        <div class="card1">
                            <span><img src="{{ asset('img/book1.png') }}" /></span>
                        </div>
                        <div>
                            <h2>Total Routes</h2>
                            <p>Total number of user routes</p>
                        </div>
                    </div>
                    <a href="#" class="small-box-footer"><h3>{{ $record->count()}}</h3></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white custom-box1">
                    <div class="inner inner-card">
                        <div class="card1">
                            <span class="color1"><img src="{{ asset('img/users1.png') }}" /></span>
                        </div>
                        <div>
                            <h2>Total Employees</h2>
                            <p>Total number of employees</p>
                        </div>
                    </div>
                    
                    <a href="#" class="small-box-footer"><h3>{{ $users->count()}}</h3></a>
                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white custom-box1">
                    <div class="inner inner-card">
                        <div class="card1">
                            <span class="color2"><img src="{{ asset('img/umbrella1.png') }}" /></span>
                        </div>
                        <div>
                            <h2>Individual Members</h2>
                            <p>Total number of individuals</p>
                        </div>
                    </div>
                    <a href="#" class="small-box-footer"><h3>{{ $individual->count()}}</h3></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white custom-box1">
                    <div class="inner inner-card">
                        <div class="card1">
                            <span class="color3"><img src="{{ asset('img/users1.png') }}" /></span>
                        </div>
                        <div>
                            <h2>Groups</h2>
                            <p>Total number of groups</p>
                        </div>
                    </div>
                    <a href="#" class="small-box-footer"><h3>{{ $group->count()}}</h3></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <!-- /.row -->
        <!-- Main row -->
        <div class="row head">
            <!-- Left col -->
            <section class="col-lg-6">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card rec-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <img src="{{ asset('img/book.png') }}" />
                            Recent Routes
                        </h3>
                    </div>
             
                    <div class="row card2">
                        <!-- Left col -->
                        @php $i=0; @endphp
                        @foreach($get_all_records as $record)
                        @if(isset($record['directionForm']['pdf_path']) && $record['directionForm']['pdf_path'] != '' || isset($record['routeAssessmentForm']['pdf_path']) && $record['routeAssessmentForm']['pdf_path'] != '' )
                        <div class="col-lg-4 card-title1">
                            <div class="card2-inner">
                                <img src="{{ asset('img/pdf 2.svg') }}" />
                            </div>
                            @if(isset($record['directionForm']['pdf_path']) && $record['directionForm']['pdf_path'] != '')
                            <a href="{{$record['directionForm']['pdf_path']}}" target="_blank">
                                <h6>Direction-{{$record['form_name']}}</h6>
                            </a>
                            @endif
                            @if(isset($record['routeAssessmentForm']['pdf_path']) && $record['routeAssessmentForm']['pdf_path'] != '')
                            <a href="{{$record['routeAssessmentForm']['pdf_path']}}" target="_blank">
                                <h6>Routes-{{$record['form_name']}}</h6>
                            </a>
                            @endif 
              
                        </div>
                        @php $i++; if($i>2){break;} @endphp
                        @endif
                        @endforeach
                    </div>
         
                    <a href="/records"><h4>View All Routes</h4></a>
                </div>
            </section>

            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6">
                <div class="card rec-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <img src="{{ asset('img/users.png') }}" />
                            Employees
                        </h3>
                        <div class="main-right-card">
                        <button type="button" class="add-employee-link stud-dash" data-toggle="modal" data-target="#addEmployeeModal">
                        <!-- <a href=""class="add-employee-link" data-toggle="modal" data-target="#addEmployeeModal"> -->
                                <img src="{{ asset('img/plus-circle.svg') }}" />
                                <h5>Add Employee</h5>
                        </div>
                    </div>
                    <div class="row custom-card-box">
                        <!-- Left col -->
                        @php $i=0; @endphp
                        @foreach($users as $user)
                            <div class="col-md-6 right-card1">
                                <div class="small-box card-wrap bg-white boxx">
                                    <div class="custom-right-card">
                                        <span><img  class="img-fluid" height="50px" width="50px" src="{{ asset('img/R.png') }}" /></span>
                                    </div>
                                    <div>
                                        <h2>{{$user['name']}}</h2>
                                        <p>{{$user['created_at']}}</p>
                                    </div>
                                </div>
                            </div>
                            @php $i++; if($i>3){break;} @endphp
                        @endforeach
                        <div class="col-md-12 right-card1">
                            <a href="/employee"><h4>View All Employees</h4></a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
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
                                <form id="addEmployeeForm" role="form" method="post" action="{{ route('saveEmployeedashboard') }}" enctype="multipart/form-data" autocomplete="off">
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
                                        <input type="number" id="phoneno" name="phoneno" placeholder="Phone" class="form-control @error('phoneno') is-invalid @enderror" minlength="12" />
                                        @error('phoneno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <select id="titleposition" name="titleposition" class="form-control @error('titleposition') is-invalid @enderror">
                                            <option value="">Title/position</option>
                                            @foreach($titlepositions as $type)
                                            <option value="{{$type['id']}}">{{$type['caption']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select id="jobgroup" name="jobgroup" value="{{$type['id']}}" class="form-control @error('jobgroup') is-invalid @enderror">
                                            <option value="">Jobgroup</option>
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
@if(!empty(Session::get('error_code')) && Session::get('error_code') == "add")
<script type="text/javascript">
    $(function() {
        $('#addEmployeeModal').modal('show');
    });
</script>
@endif