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
    {{Session::get('error_code')}}
    <script type="text/javascript">
        $(function() {
            $('#addIndividualsModal').modal('show');
            //$('.error_div').show();
        });
    </script>
    @endif

    @if(!empty(Session::get('error_code')) && Session::get('error_code') == "edit")
    <script type="text/javascript">
        $(function() {
            $('#editIndividualsModal').modal('show');
            //$('.error_div1').show();
        });
    </script>
    @endif
  
    <!-- Content Header (Page header) -->
    <div class="content-header pd-left-side">
        <div class="container-fluid p-0">
            <div class="d-flex bg-white header-row-1">
                <!-- <button> -->
                    <span><img src="{{ asset('img/users.png') }}" alt=""></span>
                    Individuals    
                <!-- </button> -->
                <ul class="ml-auto">
                    <li>Home /</li>
                    <li> Individuals</li>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <style>
       
    </style>
    <!-- Main content -->
    <section class="content pd-left-side">
        <div class="container-fluid p-0">
            <!-- small box -->
            <div class="service-record-section">
                <div class="small-box bg-white custom-records">
                    <div>
                        <h2>Individual List</h2>
                    </div>
                    <form class="record-form ml-auto">

                    </form>
                    <!-- <a href="#">Filters<img src="{{ asset('img/chevron-down.svg') }}"></a> -->
                    <button type="button" class="add-employee-link" data-toggle="modal" data-target="#addIndividualsModal" id="addIndividualsForm">
                        <img src="{{ asset('img/plus-circle.svg') }}" width="20">
                        <h5>Add Individual</h5>
                    </button>
                </div>

                <!-- /.card -->

                <div class="table-section-records">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-section">
                            <div class="table-responsive table-header-border">
                                <table id="example2" class="table-striped table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Mobile No</th>
                                            <th>Shop/Office/Field</th>
                                            <th>Location</th>
                                            <th>Job Title</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach($all_individuals as $individuals)
                                        <tr>
                                            <td>{{$i}}</td>
                                           
                                            <td>{{ $individuals->name }}</td>
                                            <td>{{ $individuals->email }}</td>
                                            <td>{{ $individuals->phone }}</td>
                                            <td>{{ $individuals->caption }}</td>
                                         
                                            <td>
                                                <a class="view-job" href="javascript:;" data-href="{{ route('viewIndividualJobList', $individuals->id) }}"> <img src="{{ asset('img/eye.svg') }}" width="16" height="16"> view</a>
                                            </td>
                                            
                                            <td>{{ $individuals->group_name }}</td>


                                            <td class="d-flex table-data table-share">
                                                <!-- <span><img src="{{ asset('img/share.png') }}" width="18" height="18">Share</span>
                                                                <span><img src="{{ asset('img/eye.svg') }}" width="16" height="16">view</span> -->
                                                <span>
                                                    <a class="conf_edit" href="javascript:;" data-href="{{ url('individuals/viewIndividual/') }}/{{$individuals->id}}"> <img src="{{ asset('img/edit.svg') }}" width="16" height="16" />edit</a>
                                                </span>
                                                <span>
                                                    <a onclick="return confirm('Are you sure?')" href="{{ url('individuals/deleteIndividual/') }}/{{$individuals->id}}"><img src="{{ asset('img/trash-2.svg') }}" width="16" height="16" />delete</a>
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

                <!--modal popup  -->
                <!--Add Individuals popup  -->
                <div class="modal fade employee-modal-popup" id="addIndividualsModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Individuals</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addIndividualsForm" role="form" method="post" action="{{ route('saveIndividual') }}" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" id="indi_name" name="indi_name" value="{{ old('indi_name') }}" class="form-control @error('indi_name') is-invalid @enderror" placeholder="Individuals Full Name" minlength="3" />
                                        @error('indi_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="email" id="indi_email" placeholder="E-Mail address" name="indi_email" value="{{ old('indi_email') }}" class="form-control @error('indi_email') is-invalid @enderror" />
                                        @error('indi_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="number" id="indi_phone" placeholder="Mobile Phone" name="indi_phone" value="{{ old('indi_phone') }}" class="form-control @error('indi_phone') is-invalid @enderror" />
                                        @error('indi_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group caption_option">
                                        <select type="text" id="caption" name="caption" value="{{ old('caption') }}" class="form-control @error('caption') is-invalid @enderror caption-list caption">
                                            <option value="" selected disabled hidden>Shop / Office / Field</option>
                                            <option value="Shop">Shop</option>
                                            <option value="Office">Office</option>
                                            <option value="Field">Field</option>
                                        </select>

                                        @error('indi_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group create_location">
                                        <select placeholder="Location" name="location[]" class="form-control @error('location') is-invalid @enderror location" multiple id="set-location">
                                            @foreach($all_locations as $location)
                                            <option {{ old('location') == $location? 'selected' : '' }} value="{{$location}}"> {{$location}} </option>
                                            @endforeach
                                            <option value="others">Others</option>
                                        </select>
                                    </div>

                                    <div class="form-group addLocationTextModal" style="display:none">
                                        <input type="text" name="location[]" value="" class="form-control @error('location') is-invalid @enderror location_text" placeholder="Location" minlength="3" id="location_text" />
                                        @error('location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group change_group">
                                        <select id="job_group" placeholder="Job Title" name="job_group" class="form-control @error('job_group') is-invalid @enderror groupList">
                                            <option value="" selected disabled hidden>Job Title</option>
                                            @foreach($job_group as $type)
                                            <option value="{{$type['caption']}}">{{$type['caption']}}</option>
                                            @endforeach
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group addGroupTextModal" style="display:none">
                                        <input type="text" name="job_group" value="" class="form-control @error('group') is-invalid @enderror group_text" placeholder="Group name" minlength="3" id="group_text" />
                                        @error('group')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="justify-content-center d-flex">
                                        <input type="hidden" id="indi_id" name="indi_id" value="0" />
                                        <button type="submit" class="btn-popup">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <!--Edit Individuals popup  -->
                <div class="modal fade employee-modal-popup" id="editIndividualsModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Individuals</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editIndividualsForm" role="form" method="post" action="{{ route('saveIndividual') }}" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="indi_name" value="{{ old('indi_name') }}" class="form-control @error('indi_name') is-invalid @enderror indi_name" placeholder="Individuals name" minlength="3" />
                                        @error('indi_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="email" placeholder="E-Mail address" name="indi_email" value="{{ old('indi_email') }}" class="form-control @error('indi_email') is-invalid @enderror indi_email" />
                                        @error('indi_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <input type="number" placeholder="Mobile Number" name="phone" value="{{ old('indi_email') }}" class="form-control @error('phone') is-invalid @enderror phone" />
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group create_option">
                                        <select type="text" id="edit-caption" placeholder="Shop / Office / Field" name="caption" value="{{ old('caption') }}" class="form-control @error('caption') is-invalid @enderror caption-list caption">
                                            <option value="" disabled selected hidden>Shop / Office / Field</option>
                                            <option value="Shop">Shop</option>
                                            <option value="Office">Office</option>
                                            <option value="Field">Field</option>
                                        </select>

                                        @error('indi_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group create_location">
                                        <select placeholder="Location" name="location[]" class="form-control @error('location') is-invalid @enderror location" multiple id="update-location">
                                            @foreach($all_locations as $location)
                                            <option {{ old('location') == $location ? 'selected' : '' }} value="{{$location}}"> {{$location}} </option>
                                            @endforeach
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group addLocationTextModal" style="display:none">
                                        <input type="text" name="location[]" value="" class="form-control @error('location') is-invalid @enderror location_text" placeholder="Location" minlength="3" id="edit_location_text" />
                                        @error('location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group change_group">
                                        <select placeholder="Job Title" name="job_group" class="form-control @error('job_group') is-invalid @enderror groupList" id="job_group2">                                        
                                            @foreach($job_group as $type)
                                            <option {{ old('job_group') == $type['caption'] ? 'selected' : '' }} value="{{$type['caption']}}" >{{$type['caption']}}</option>
                                            @endforeach
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group addGroupTextModal" style="display:none">
                                        <input type="text" value="" class="form-control @error('group') is-invalid @enderror group_text" placeholder="Group name" minlength="3" id="group_text" />
                                        @error('group')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="d-flex justify-content-center">
                                        <input type="hidden" class="group_id" id="grop-id" name="group_id" value="" />
                                        <input type="hidden" class="indi_id" name="indi_id" value="0" />
                                        <button type="submit" class="btn-popup">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--modal popup  -->
                <div class="modal fade employee-modal-popup" id="view_job_list" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">List of Locations</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            <div class="modal-body">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>


<script>
    $(document).ready(function() {

        $('.caption_option #caption').on('change',function(){
         var Array = ['Shop','Office','Field'];
         var value = $(this).val();
            if (jQuery.inArray(value, Array) >= 0){
                $('.caption-list').css('color','#000000')
            }

        })

        $('.create_option #edit-caption').on('change',function(){
         var Array = ['Shop','Office','Field'];         
         var value = $(this).val();
            if (jQuery.inArray(value, Array) >= 0){
                $('.caption-list').css('color','#000000')
            }

        })

        $('#job_group').select2({
                placeholder: "Job Title",
                allowClear: true,
            })
        $('#job_group2').select2({
            placeholder: "Job Title",
            allowClear: true,
        })
        $('.location').select2({
            placeholder: "Location",
            allowClear: false,
        });

        
        $('#addIndividualsForm').on('click',function(){
            $('#addIndividualsModal .create_location  #set-location option').prop("selected", false).trigger('change')
            $('#addIndividualsModal #indi_name').val("")
            $('#addIndividualsModal #indi_email').val("")
            $('#addIndividualsModal #indi_phone').val("")
            $('#addIndividualsModal .caption-list').val("")
           
        });

        // Add "Select All" option
        var $selectAllOption = $('<option>').val('all').text('Select All').attr('id', 'select_all');
        $('.location').prepend($selectAllOption);

        // Handle "Select All" option
        $('.location').on('select2:select', function(e) {
            if (e.params.data.id === 'all') {
                $('.location option').prop('selected', true);
                var wanted_option = $('.location option[value="all"]');
                wanted_option.prop('selected', false);
                var other_option = $('.location option[value="others"]');
                other_option.prop('selected', false);
                $('.location').trigger('change');
            }

            if (e.params.data.id == 'others') {
                $('.addLocationTextModal').show();
                $(".location_text").prop('required', true);
                $(".location_text").attr("name", "location[]");
            }

        });

        $('.location').on('select2:unselect', function(e) {
            if (e.params.data.id === 'all') {
                $('.location option').prop('selected', false);
                $('.location').trigger('change');
            }
            if (e.params.data.id == 'others') {
                $('.addLocationTextModal').hide();
                $(".location_text").prop('required', false);
                $(".location_text").removeAttr("name");
            }
        });
        
        $('body').on('click', '.view-job', function() {
            var editUrl = $(this);

            $.get("" + editUrl.data("href"), function(data) {
                $('#view_job_list').modal('show');
                $('#view_job_list .modal-body').html('');
                var user_length = data.length;
                if(user_length >= 0){
                    for (var i = 0; i < user_length; i++) {
                        $('#view_job_list .modal-body').append('<b style="font-weight:900;">' + [i + 1] + '.</b>  ' + data[i] + '<br>');
                    }
                }
                if(user_length == 0){
                    $('#view_job_list .modal-body').append('Locations are not found');
                }                
            });
        });

        $('.groupList').on('select2:select', function(e) {
            if (e.params.data.id === 'Other') {
                $('.addGroupTextModal').show();
                $(".group_text").prop('required', true);
                $(".groupList").removeAttr("style");
                $(".group_text").attr("name", "job_group");
                $('.groupList').removeAttr("name");
            } else {
                $('.addGroupTextModal').hide();
                $(".group_text").prop('required', false);
                $(".group_text").removeAttr("name");
            }
        });

    })

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
            $('#editIndividualsModal').modal('show');
            $('#editIndividualsModal .indi_name').val(data['user_details'].name);
            $('#editIndividualsModal .indi_email').val(data['user_details'].email);
            $('#editIndividualsModal .indi_id').val(data['user_details'].id);
            $('#editIndividualsModal .caption').val(data['user_details'].caption);
            $('#editIndividualsModal .phone').val(data['user_details'].phone);
            $('#editIndividualsModal #grop-id').val(data['user_details'].group_id);


            if(data['location'].length == 0){         
                $('#editIndividualsModal .create_location  #update-location option').prop("selected", false).trigger('change')
            }else{
                
                var options = $('#editIndividualsModal .create_location #update-location option');
                var values = $.map(options, function(option) {
                    return option.value;
                });
                var myarray = [];
                myarray.push(values);

                for (index = 0; index < data['location'].length; index++) {
               
                    if (data['location'][index] != null) {
                        if (jQuery.inArray(data['location'][index], myarray[0]) >= 0) {
                            $('#editIndividualsModal .create_location #update-location').val(data['location']).prop("selected", true).trigger('change');
                        } else {
                            $('#editIndividualsModal .create_location #update-location').append('<option value="' + data['location'][index] + '">' + data['location'][index] + '</option>')
                            $('#editIndividualsModal .create_location #update-location').val(data['location']).prop("selected", true).trigger('change');
                        }
                    }
                }

            }

            var groupoptions = $('#editIndividualsModal .change_group #job_group2 option');
            var groupvalues = $.map(groupoptions, function(groupoptions) {
                return groupoptions.value;
            });
            var mygrouparray = [];
            mygrouparray.push(groupvalues);

            if (jQuery.inArray(data['user_details'].group_name, mygrouparray[0]) >= 0) {
                $('#editIndividualsModal #job_group2').val(data['user_details'].group_name).attr("selected", "selected").trigger('change');
            } else {
                $('#editIndividualsModal .change_group #job_group2').append('<option value="' + data['user_details'].group_name + '">' + data['user_details'].group_name + '</option>')
                $('#editIndividualsModal #job_group2').val(data['user_details'].group_name).attr("selected", "selected").trigger('change');
            }


        });
    });
</script>
@endsection