@extends('layouts.dashboard')

@section('content')

<style>
    .select2div{
        display: none;
    }
</style>

<div class="content-wrapper">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    @if(session()->get('success'))
        <div class="successmessage">
            <div class="alert alert-success" role="alert">
                <strong>{{ session()->get('success') }}</strong>
            </div>
            <script type="text/javascript">
            $(".successmessage").show().delay(5000).fadeOut();
            </script>     
        </div><br/>
    @elseif(session()->get('error'))
        <div class="errormessage">
            <div class="alert alert-danger mb-0" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            </div>
            <script type="text/javascript">
            $(".errormessage").show().delay(5000).fadeOut();
            </script>     
        </div><br/>
    @endif

    @if(!empty(Session::get('error_code')) && Session::get('error_code') == "add")
        <script type="text/javascript">
            $(function() {
                $('#addGroupModal').modal('show');
            });
        </script>
    @endif
    
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == "edit")
        <script type="text/javascript">
            $(function() {
                $('#editGroupModal').modal('show');
            });
        </script>
    @endif

    <!-- Content Header (Page header) -->
    <div class="content-header pd-left-side">
        <div class="container-fluid p-0">
            <div class="d-flex bg-white header-row-1">
          
                <span><img src="{{ asset('img/group.svg') }}" alt=""></span>
                Groups       
           
            <ul class="ml-auto">
                <li>Home /</li>
                <li> Groups</li>
            </ul>
            </div>    
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content pd-left-side">
        <div class="container-fluid p-0">
            <!-- small box -->
            <div class="service-record-section">
                <div class="small-box bg-white custom-records">
                    <div>
                        <h2>Group list</h2>
                    </div>
                    <form class="record-form ml-auto">

                    </form>
                    <!-- <a href="#">Filters<img src="{{ asset('img/chevron-down.svg') }}"></a> -->
                    <button type="button" class="add-employee-link" data-toggle="modal"  id="getGroupModel" data-target="#addGroupModal">
                        <img src="{{ asset('img/plus-circle.svg') }}" width="20">
                        <h5>Add Groups</h5>
                    </button>

                </div>

                <div class="table-section-records">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body Individuals-table">
                            <div class="table-responsive table-header-border">
                                <table id="example2" class="table-striped table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Group Name</th>
                                            <th>Member Count</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach($all_groups as $group)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{ $group['group_name'] }}</td>
                                            <td>{{ $group->groupMembers->count()}}</td>
                                            <td class="d-flex table-data table-share">
                                                <span>
                                                    <a data-href="{{url('/groups/viewGroup/'.$group->id)}}" class="edit-group" data-id="{{$group->id}}" data-toggle="modal" data-target="#userShowModal"> <img src="{{ asset('img/edit.svg') }}" width="16" height="16" />edit</a>
                                                </span>
                                                <span>
                                                    <a onclick="return confirm('Are you sure?')" href="{{ url('/groups/delete', ['group_id' => $group->id]) }}"><img src="{{ asset('img/trash-2.svg') }}" width="16" height="16" />delete</a>
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


                <div class="modal fade employee-modal-popup" id="addGroupModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Group</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addEmployeeForm" role="form" method="post" action="{{ route('saveGroup') }}" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <select name="group_name" class="form-control @error('group') is-invalid @enderror listOfGroups">
                                            <option value="">Groups</option>
                                            <option @if(old('group_name')=='Crane Operator' ) selected @endif value="Crane Operator">Crane Operator</option>
                                            <option @if(old('group_name')=='Driver' ) selected @endif value="Driver">Driver</option>
                                            <option @if(old('group_name')=='Fork Lift' ) selected @endif value="Fork Lift">Fork Lift</option>
                                            <option @if(old('group_name')=='Opertator' ) selected @endif value="Opertator">Opertator</option>
                                            <option @if(old('group_name')=='HSE' ) selected @endif value="HSE">HSE</option>
                                            <option @if(old('group_name')=='Manager' ) selected @endif value="Manager">Manager</option>
                                            <option @if(old('group_name')=='Swamper' ) selected @endif value="Swamper">Swamper</option>
                                            <option @if(old('group_name')=='Rigger' ) selected @endif value="Rigger">Rigger</option>
                                            <option @if(old('group_name')=='Safety' ) selected @endif value="Safety">Safety</option>
                                            <option value="Other">Other</option>
                                        </select>

                                    </div>
                                    <div class="form-group addGroupTextModal" style="display:none">
                                        <input type="text" value="" class="form-control @error('group_name') is-invalid @enderror" placeholder="Group name" minlength="3" id="group_text" />
                                        @error('group_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <input type="hidden" name="group_id" value="0" id="group_id1">
                                    </div>

                                <div class="justify-content-center d-flex">                                   
                                    <button type="submit" class="btn-popup">Submit</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <!-- Edit Group popup -->

              <div class="modal fade employee-modal-popup" id="userShowModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Group</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editGroupForm" role="form" method="post" action="{{ route('updateGroup') }}" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    @method('put')
                                    <div class="group-name-edit px-2">
                                        <label>GroupName</label>
                                        <select name="group_name" class="form-control @error('group') is-invalid @enderror listOfGroups">
                                            <option value="">Groups</option>
                                            <option @if(old('group_name')=='Crane Operator' ) selected @endif value="Crane Operator">Crane Operator</option>
                                            <option @if(old('group_name')=='Driver' ) selected @endif value="Driver">Driver</option>
                                            <option @if(old('group_name')=='Fork Lift' ) selected @endif value="Fork Lift">Fork Lift</option>
                                            <option @if(old('group_name')=='Opertator' ) selected @endif value="Opertator">Opertator</option>
                                            <option @if(old('group_name')=='HSE' ) selected @endif value="HSE">HSE</option>
                                            <option @if(old('group_name')=='Manager' ) selected @endif value="Manager">Manager</option>
                                            <option @if(old('group_name')=='Swamper' ) selected @endif value="Swamper">Swamper</option>
                                            <option @if(old('group_name')=='Rigger' ) selected @endif value="Rigger">Rigger</option>
                                            <option @if(old('group_name')=='Safety' ) selected @endif value="Safety">Safety</option>
                                            <option value="Other">Other</option>
                                        </select>

                                        <br>
                                        <div class="form-group addGroupTextModal" style="display:none">
                                            <input  type="text" value="" class="form-control @error('group_name') is-invalid @enderror" placeholder="Group name" minlength="3" id="group_text" />
                                            @error('group_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="group_id" id="edit_group_id" value="" />
                                        <br>
                                        <button type="button" class="add-employee-link">
                                            <img src="{{ asset('img/plus-circle.svg') }}" width="20">
                                            <h5 id="add-member">Add Members</h5>
                                        </button>
                                        <br>
                                        <div class="form-group select2div">
                                            <select class="select2" name="individuals[]" id="individual-list" multiple="multiple" data-placeholder="Select Members" style="width: 100%">
                                                    
                                            </select>
                                        </div>
                                        <br>
                                        <ul class="group-name-listing">
                                            
                                        </ul>


                                        <div class="modal-group-edit-footer">
                                            <button type="submit" class="btn-popup">Save</button>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        </div>

      </div><!-- /.container-fluid -->
    </section>


    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $(function () {
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

    $('#getGroupModel').on('click',function(){
        $('.listOfGroups option').prop("selected", false).trigger('change')
        
        $('#group_text').val("");
    })
    $('.listOfGroups').change(function() {
      
        if ($(this).val() == 'Other') {
            $('.addGroupTextModal').show();
            $(".addGroupTextModal #group_text").prop('required', true);
            $(".listOfGroups").removeAttr("style");
            $(".addGroupTextModal #group_text").attr("name", "group_name");
        } else {
            $('.addGroupTextModal').hide();
            $(".addGroupTextModal #group_text").prop('required', false);
            $(".addGroupTextModal #group_text").removeAttr("name");
            $(".listOfGroups").attr("name", "group_name");
        }
    })


    $('body').on('click', '.edit-group', function() {        
        var editUrl = $(this);     
        $.get("" + editUrl.data("href"), function(data) {
            var options = $('.listOfGroups option');
            var values = $.map(options, function(option) {
                return option.value;
            });
            var myarray = [];
            myarray.push(values);
            if (jQuery.inArray(data[0].group_name, myarray[0]) >= 0) {
                $('.listOfGroups').val(data[0].group_name).attr('selected','selected')
            }else{
                $('.listOfGroups').append('<option value="'+data[0].group_name+'">'+data[0].group_name+'</option>')
                $('.listOfGroups').val(data[0].group_name).attr('selected','selected')
            }
            
        })

        var row_id = $(this).attr("data-id");
        $(".select2div").hide();
        $('#edit_group_id').val(row_id);
        getGroupMembers(row_id);
    });

        $('body').on('click', '.delete-member',function(){
            var row_id = $(this).attr("data-id");
            var group_member_id = $(this).attr("data-groupmember");
            $.get("groups/removeMember/"+group_member_id, function (data){
                getGroupMembers(row_id);
                getIndividuals();
            });
        });

    function getGroupMembers(row_id) {
        $.get("groups/viewGroup/" + row_id, function(data) {
           
            $("#group_name").val(data[0].group_name);
            $(".group-name-listing").empty();
            
            if (data[0].group_members.length == 0) {
                $(".group-name-listing").append('<li class="py-2">No team members available !!!</li>');
            }else{
                $('.group-name-listing').show();
                for (let i = 0; i < data[0].group_members.length; i++) {
                    $(".group-name-listing").append('<li class="delete-member" class="py-2" data-id="' + data[0].id + '" data-groupmember="' + data[0].group_members[i].id + '">' + data[0].group_members[i].individuals.name + '<span><img src="img/trash-2.svg" class="pl-2" /></span></li>');
                }
                $(".group-name-listing li").removeAttr("name");            }
        });
        
    }
  

    $('.select2').select2();

    $('body').on('click', '#add-member', function() {
        $(".select2div").show();
        getIndividuals();
    });

    $('.select2div #individual-list').on('change',function(){
        $('.group-name-listing').hide();
    })


        function getIndividuals(){
            $.get("groups/getIndividuals", function (data){
                $("#individual-list").empty();
                for(let i=0;i<data.length;i++){
                    $("#individual-list").append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                }
            });
        }
        
    </script>
   
    
@endsection
