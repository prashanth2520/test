<div class="service-record-section">
    <div class="small-box custom-records">
        <div>
            <h2>Your Routes</h2>
        </div>
        <div class="record-form ml-auto">
          
        </div>
       
        <button type="button" class="add-employee-link new-rules" data-toggle="modal" data-target="#addRecordModal">
            <img src="{{ asset('img/plus-circle.svg') }}" width="20">
            <h5>Add New Route</h5>
        </button>
    </div>
    <div class="table-section-records ">
        <div class="card">
        <!-- /.card-header -->
        <div class="card-body table-section">
            <div class="table-responsive table-header-border">
            <table id="records_table" class="table-striped table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Route Name</th>
                        <th>Rig Name</th>
                        <th>Rig Number</th>
                        <th>Job Number</th>
                        <th>Direction</th>
                        <th>Route Assessment</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp 
                    @foreach($get_all_records as $record)
                    @if(isset($record['directionForm']['pdf_path']) && $record['directionForm']['pdf_path'] != '' || isset($record['routeAssessmentForm']['pdf_path']) && $record['routeAssessmentForm']['pdf_path'] != '' )
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$record['form_name']}}</td>
                            <td>{{$record['rig_name']}}</td>
                            <td>{{$record['rig_no']}}</td>
                            <td>{{$record['job_no']}}</td>
                            @if(isset($record['directionForm']['pdf_path']) &&  $record['directionForm']['pdf_path'] != '')
                                <td><a href="{{$record['directionForm']['pdf_path']}}" target="_blank">
                                        <h6>Direction Document</h6>
                                    </a></td>
                            @else
                                <td></td>
                            @endif

                            @if(isset($record['routeAssessmentForm']['pdf_path']) &&  $record['routeAssessmentForm']['pdf_path'] != '')
                                <td><a href="{{$record['routeAssessmentForm']['pdf_path']}}" target="_blank">
                                        <h6>Route Document</h6>
                                    </a></td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$record['created_at']}}</td>
                            <td class="d-flex table-data table-share">
                                @if(isset($record['directionForm']['pdf_path']) &&  $record['directionForm']['pdf_path'] != null || isset($record['routeAssessmentForm']['pdf_path']) &&  $record['routeAssessmentForm']['pdf_path'] != null   )
                                    <span data-toggle="modal" data-target="#shareModal" class="share-button" data-id="{{$record->id}}"><img src="{{ asset('img/share.png') }}" width="18" height="18">Share</span>
                                @endif
                                <span><a href="{{ url('records/edit/') }}/{{ $record['id'] }}"><img src="{{ asset('img/edit.svg') }}" width="16" height="16" />edit</a></span>
                                <span><a onclick="return confirm('Are you sure?')" href="{{ url('records/delete/') }}/{{ $record['id'] }}" ><img src="{{ asset('img/trash-2.svg') }}" width="16" height="16" />delete</a></span>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            </div>
        </div>
        <!-- /.card-body -->
        </div>
    </div>
    
</div>