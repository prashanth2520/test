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
    <style>
        .titleposition .selection{
            height: 100%;
            display: flex;
        }
        .select_location .selection{
            height: 100%;
            display: flex;
        }
        
        .select_location .select2-container--default .select2-search--inline .select2-search__field {
            width: initial !important;
            font-size: 130%;
        }
    </style>

    <!-- Content Header (Page header) -->
    <div class="content-header pd-left-side">
        <div class="container-fluid p-0">
            <div class="d-flex bg-white header-row-1">

                <span><img src="{{ asset('img/settings.png') }}" alt=""></span>
                Settings
                <ul class="ml-auto">
                    <li>Home /</li>
                    <li> Edit Profile</li>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <div class="content pd-left-side">
        <div class="container-fluid p-0">
            <div class="service-record-section">
                <div class="small-box custom-records">
                    <div>
                        <h2>Edit Profile</h2>
                    </div>
                </div>
         

                <div class="form-popup employee-modal-popup" id="myForm">
                    <form action="{{ route('updateProfile') }}" id="editUserProfileForm" class="form-container" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name"><b>Name</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" name="name" value="{{$getUser->name}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email"><b>Email</b></label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" name="email" value="{{$getUser->email}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="phoneno"><b>Phone Number</b></label>
                            <input type="number" name="phoneno" placeholder="Phone" class="form-control @error('phoneno') is-invalid @enderror phoneno" minlength="12" value="{{$getUser->phone}}" />
                            @error('phoneno')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address"><b>Address</b></label>
                            <input type="text" name="address" value="{{$getUser->address}}" class="form-control @error('address') is-invalid @enderror" placeholder="Address" minlength="3" id="group_text" />
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        {{--
                        <div class="form-group select_location">
                            <label for="location"><b>Location</b></label>
                            <select placeholder="Location" name="location[]" class="form-control @error('location') is-invalid @enderror location" multiple id="set-location">
                                @if(!empty($user_location))
                                @foreach($user_location as $areaList)
                                <option value="{{$areaList}}" selected=""> {{$areaList}} </option>
                                @endforeach
                                @endif
                                @foreach($location as $area)
                                <option {{ old('location') == $area ? 'selected' : '' }} value="{{$area}}"> {{$area}} </option>
                                @endforeach
                               
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="titleposition"><b>Job Title</b></label>                           
                            <select name="titleposition" class="form-control @error('titleposition') is-invalid @enderror titleposition" > 
                                @foreach($titlepositions as $type)                                
                                    <option @if(isset($getUser->job_title)&& ($getUser->job_title==$type)) selected @endif value="{{$type}}" >{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
              
                        <div class="form-group">
                            <label for="group"><b>Group</b></label>                           
                            <select name="group" class="form-control @error('group') is-invalid @enderror groupList">
                                <option value="" selected disabled hidden> Groups </option>
                                
                                @if(isset($group->group_name) && !in_array($group->group_name,$listOfGroup))                                   
                                    <option selected value="{{$group->group_name}}">{{$group->group_name}}</option>
                                @endif                                
                                <option @if(isset($group->group_name)&&$group->group_name=="Crane Operator")) selected @endif value="Crane Operator">Crane Operator</option>
                                <option @if(isset($group->group_name)&&$group->group_name=="Driver")) selected @endif value="Driver">Driver</option>
                                <option @if(isset($group->group_name)&&$group->group_name=="Fork Lift")) selected @endif value="Fork Lift">Fork Lift</option>
                                <option @if(isset($group->group_name)&&$group->group_name=="Opertator")) selected @endif value="Opertator">Operator</option>
                                <option @if(isset($group->group_name)&&$group->group_name=="HSE")) selected @endif value="HSE">HSE</option>
                                <option @if(isset($group->group_name)&&$group->group_name=="Manager")) selected @endif value="Manager">Manager</option>
                                <option @if(isset($group->group_name)&&$group->group_name=="Swamper")) selected @endif value="Swamper">Swamper</option>
                                <option @if(isset($group->group_name)&&$group->group_name=="Rigger")) selected @endif value="Rigger">Rigger</option>
                                <option @if(isset($group->group_name)&&$group->group_name=="Safety")) selected @endif value="Safety">Safety</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group addGroupTextModal" style="display:none">
                            <input type="text" value="" class="form-control @error('group') is-invalid @enderror" placeholder="Group name" minlength="3" id="group_name" />
                            @error('group')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                         @if(isset($group->id)) 
                            <input type="hidden" name="group_id" value="{{$group->id}}">
                        @else
                            <input type="hidden" name="group_id" value="">
                        @endif
                        --}}
                        <input type="hidden" name="user_id" value="{{$getUser->id}}">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn resetpass-btn mr-2">Update</button>
                            <button type="button" class="btn close-btn ml-2" onclick="closeForm()">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script>
        function closeForm() {
            window.location.href = "{{ asset('/home') }}"
        }

      /*  $(document).ready(function() {
            $('.titleposition').select2({
                placeholder: "Job Title",
                allowClear: false,
            })
            $('.location').select2({
                placeholder: "Location",
                allowClear: false,
                style: 'font-size: 14px;'
            });

            // Add "Select All" option
            var $selectAllOption = $('<option>').val('all').text('Select All');
            $('.location').prepend($selectAllOption);

            // Handle "Select All" option
            $('.location').on('select2:select', function(e) {
                if (e.params.data.id === 'all') {
                    $('.location option').prop('selected', true);
                    var wanted_option = $('.location option[value="all"]');
                    wanted_option.prop('selected', false);
                    $('.location').trigger('change');
                }
            });

            $('.location').on('select2:unselect', function(e) {
                if (e.params.data.id === 'all') {
                    $('.location option').prop('selected', false);
                    $('.location').trigger('change');
                }
            });
        });

        $('.groupList').change(function() {
            if ($(this).val() == 'Other') {
                $('.addGroupTextModal').show();
                $("#group_name").prop('required', true);
                $(".groupList").removeAttr("style");
                $("#group_name").attr("name", "group");
            } else {
                $('.addGroupTextModal').hide();
                $("#group_name").prop('required', false);
                $("#group_name").removeAttr("name");
            }
        })*/

        
    </script>
</div>
@endsection