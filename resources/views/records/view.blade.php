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
            </div><br/>
            {{ session()->forget('success') }}
        @elseif(session()->get('error'))
            <div class="errormessage">
                <div class="alert alert-danger mb-0" role="alert">
                    <strong>{{ session()->get('error') }}</strong>
                </div>
                <script type="text/javascript">
                    $(".errormessage").show().delay(5000).fadeOut();
                </script>     
            </div><br/>
            {{ session()->forget('error') }}
        @endif

        @if(!empty(Session::get('error_code')) && Session::get('error_code') == "add")
            <script type="text/javascript">
                $(function() {
                    $('#addRecordModal').modal('show');
                });
            </script>
        @endif

        <!-- Content Header (Page header) -->
        <div class="content-header pd-left-side">
            <div class="container-fluid p-0">
                <div class="d-flex bg-white header-row-1">
                <!-- <button> -->
                    <span><img src="{{ asset('img/book.png') }}" alt=""></span>
                    Routes      
                <!-- </button> -->
                <ul class="ml-auto">
                    <li>Home /</li>
                    <li>Routes</li>
                </ul>
                </div>    
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content pd-left-side">
            <div class="container-fluid p-0">
                @if(auth()->user()->user_role == 2)
                    @include('records.userview', [$get_all_records])
                @else
                    @include('records.adminview')
                @endif
            </div>
            <!-- /.container-fluid -->
        </section>

         <!--modal popup  -->
        <!--Add Record popup  -->
        <div class="modal fade employee-modal-popup" id="addRecordModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Route</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addRecordForm" role="form" method="post" action="{{ route('saveRecord') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <input type="text" id="record_name" name="record_name" value="{{ old('record_name') }}" class="form-control @error('record_name') is-invalid @enderror" placeholder="Route name" />
                                @error('record_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" id="rig_name" name="rig_name" value="{{ old('rig_name') }}" class="form-control @error('rig_name') is-invalid @enderror" placeholder="Rig name" />
                                @error('rig_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="number" id="rig_no" name="rig_no" value="{{ old('rig_no') }}" class="form-control @error('rig_no') is-invalid @enderror" placeholder="Rig number" />
                                @error('rig_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="number" id="job_no" name="job_no" value="{{ old('job_no') }}" class="form-control @error('job_no') is-invalid @enderror" placeholder="Job number" />
                                @error('job_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <select id="record_type" name="record_type" class="form-control @error('record_type') is-invalid @enderror">
                                    <option value="">Select Type</option>
                                    @foreach($record_type as $type)
                                        <option value="{{$type['id']}}">{{$type['record_type']}}</option>
                                    @endforeach
                                </select>
                                @error('record_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="justify-content-center d-flex">
                                <input type="hidden" id="emp_id" name="emp_id" value="0" />
                                <button type="submit" class="btn-popup">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!--Share Record popup -->
        <div class="modal fade share-modal-popup" id="shareModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Share</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" method="post" action="{{ route('sharePdf') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <br>
                        <div class="form-group">
                            <select class="form-control" id="share-option" name="share-option">
                                <option>SHARE WITH</option>
                                <option value="individuals" selected>Individuals</option>
                                <option value="group">Group</option>
                            </select>
                        </div>
                        <div id="list-items">
                            <h3 id="share-heading">Individuals</h3>
                            <div class="form-group list-member-items"></div>
                        </div>
                        <input type="hidden" name="shareid" id="get-rec" value="">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </div>

    <script>
        $(function () {
            $('#records_table').DataTable({
                "paging": true,
                "lengthChange": false,
            "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        var row_id;
    
        $('.share-button').click(function() {
            var share_option =$("#share-option option:selected").val();
            $(".list-member-items").empty();
            row_id = $(this).attr("data-id");
            $('#get-rec').val(row_id);
            if (share_option == 'individuals') {
                getIndividuals();
            } else if ( share_option == 'group') {
                getGroups();
            }
        });

        $('#share-option').change(function(){
            var share_option =$("#share-option option:selected").val();
            $(".list-member-items").empty();
            $("#share-heading").text($("#share-option option:selected").text());
            if (share_option == 'individuals') {
                getIndividuals();
            } else if ( share_option == 'group') {
                getGroups();
            }
        });

        function getIndividuals() {
            $.get("groups/getIndividuals", function(data) {
                for (let member = 0; member < data.length; member++) {
                    $(".list-member-items").append('<div class="form-check"><input name="ids[]" class="form-check-input" type="checkbox" value="' + data[member].id + '"><label class="form-check-label">' + data[member].name + ' (' + data[member].email + ')</label></div>');
                }
            });
        }

        function getGroups() {
            $.get("groups/getGroups", function(data) {
                console.log(data);
                for (let member = 0; member < data.length; member++) {
                    $(".list-member-items").append('<div class="form-check"><input name="ids[]" class="form-check-input" type="checkbox" value="' + data[member].id + '"><label class="form-check-label">' + data[member].group_name + ' </label></div>');
                }
            });
        }
    </script>

@endsection