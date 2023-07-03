<style>
    a.center {
  word-break: break-all;
}
    h6.large {
    font-size: smaller;
}
  </style>
 <!-- Main content -->
 <section class="content pd-left-side">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 p-0">
                <!-- small box -->
                <div class="small-box bg-white user-dashboard-card">
                    <div class="inner">
                        <div class="user-left-page">
                            <div><img src="{{ asset('img/Ellipse 2.svg') }}" width="80" /></div>
                            <div class="user-left-content">
                                <a href="#">
                                    <h2>{{ Auth::user()->name }}</h2>
                                </a>
                                <p>Chief Supervisor / Exploration</p>
                            </div>
                        </div>
                    </div>
                    <div class="inner inner-card">
                        <div class="user-total-records">
                            <div class="card1">
                                <span class="color1"><img src="{{ asset('img/book1.png') }}" /></span>
                            </div>
                            <div class="records-head">
                                <h3>Total Routes</h3>
                                <p>{{ $dsa->count()}}</p>
                            </div>
                            <a href="/records">View Your Routes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row head">
            <div class="col-lg-6 card-section p-0">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <img src="{{ asset('img/book.png') }}" />
                            Recent Routes
                        </h3>
                    </div>
                    <div class="card-body">
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
                        <a href="/records"  class="navbar group"><h4>View All Routes</h4></a>
                    </div>
                </div>
            </div>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <div class="col-lg-6">
                <div class="card user-dashboard-card1">
                    <button type="button" class="add-employee-link dash" data-toggle="modal" data-target="#modal-default">
                        <img src="{{ asset('img/plus-circle.svg') }}" width="20" />
                        <a href="/records"><h5>Add New Route</h5></a>
                    </button>
                </div>
            </div>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div>
</section>
<!-- /.content -->