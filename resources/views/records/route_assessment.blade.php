<div class="secblk">


    <h4>Route Assessment</h4>
    <div class="row">
        <div class="col-lg-4 add-record-form">
            <div class="form-group add-records-first-form">
                <label class="col-form-label" for="dateTime">Date and time *</label>
                @if(!empty($route_assessment) && (isset($route_assessment['date_time']) && $route_assessment['date_time'] != ''))
                <input type="dateTime-local" name="dateTime" class="form-control @error('dateTime') is-invalid @enderror" id="dateTime" placeholder="Choose data & time" value="{{ $route_assessment['date_time'] }}" />
                @else
                <input type="dateTime-local" name="dateTime" class="form-control @error('dateTime') is-invalid @enderror" id="dateTime" placeholder="Choose data & time" value="{{ old('dateTime') }}" />
                @endif
                @error('dateTime')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>






        <div class="col-lg-4">
            <div class="form-group">
                <label class="col-form-label" for="temperature">Temperature:</label>
                @if(isset($selectedTemperatureOptionValues))
                <select id="temperature" name="temperature[]" class="form-control js-example-basic-multiple @error('temperature') is-invalid @enderror " multiple="multiple">
                    <option value="" disabled>Select Temperature</option>
                    @foreach($temperature as $type)
                    <option @if(in_array($type['id'],$selectedTemperatureOptionValues)) selected @endif value="{{$type['id']}}">{{$type['name']}}</option>
                    @endforeach
                </select>

                @else

                <select id="temperature" name="temperature[]" class="form-control js-example-basic-multiple @error('temperature') is-invalid @enderror " multiple="multiple">
                    <option value="" disabled>Select Temperature</option>
                    @foreach($temperature as $type)
                    <option value="{{$type['id']}}">{{$type['name']}}</option>
                    @endforeach
                </select>
                @endif @error('temperature')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="col-form-label" for="routeAssessment">Company Performing Route Assessment:</label>
                @if(!empty($route_assessment) && (isset($route_assessment['route_assessment']) && $route_assessment['route_assessment'] != ''))
                <input type="text" name="routeAssessment" class="form-control @error('routeAssessment') is-invalid @enderror" id="routeAssessment" placeholder="Enter Company Name" value="{{ $route_assessment['route_assessment'] }}" />
                @else
                <input type="text" name="routeAssessment" class="form-control @error('routeAssessment') is-invalid @enderror" id="routeAssessment" placeholder="Enter Company Name" value="{{ old('routeAssessment') }}" />
                @endif @error('routeAssessment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4 goal-post">
            <label class="col-form-label" for="oldLocgps">Goal Post Height</label>
            <div class="row form-control ">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group add-records-first-form">
                        <label class="col-form-label col-lg-4" for="oldLocgps"> Feet</label>


                        @if(!empty($route_assessment) && (isset($route_assessment['goal_post_feet']) && $route_assessment['goal_post_feet'] !== ''))

                        <select id="goalPostFeet" name="goalPostFeet" class="form-control col-lg-8 @error('goalPostFeet') is-invalid @enderror">
                            <option value="">Feet</option>
                            @php
                            $i=0
                            @endphp
                            @while($i<=100) @if($i==$route_assessment['goal_post_feet']) <option selected value="{{$i}}">{{$i}}</option>
                                @else
                                <option value="{{$i}}">{{$i}}</option>
                                @endif
                                @php
                                $i++
                                @endphp
                                @endwhile

                        </select>
                        @else
                        <select id="goalPostFeet" name="goalPostFeet" class="form-control @error('goalPostFeet') is-invalid @enderror">
                            <option value="" selected>Select Feet</option>
                            @php
                            $i = 0
                            @endphp
                            @for ($i=0; $i<=100; $i++) <option value="{{$i}}">{{$i}}</option>
                                @endfor
                        </select>
                        @endif
                        @error('goalPostFeet')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group add-records-first-form">
                        <label class="col-form-label col-lg-4" for="oldLocgps">Inches</label>
                        @if(!empty($route_assessment) && (isset($route_assessment['goal_post_inches']) && $route_assessment['goal_post_inches'] !== ''))

                        <select id="goalPostInches" name="goalPostInches" class="form-control col-lg-8 @error('goalPostInche') is-invalid @enderror">
                            <option value="">Inches</option>
                            @php
                            $i = 0
                            @endphp
                            @while($i<=11) @if($i==$route_assessment['goal_post_inches']) <option selected value="{{$i}}">{{$i}}</option>
                                @else
                                <option value="{{$i}}">{{$i}}</option>
                                @endif
                                @php
                                $i++
                                @endphp
                                @endwhile

                        </select>
                        @else
                        <select id="goalPostInches" name="goalPostInches" class="form-control @error('goalPostInches') is-invalid @enderror">
                            <option value="" selected> Select Inches</option>
                            @php
                            $i = 0
                            @endphp
                            @for ($i=0; $i<=11; $i++) <option value="{{$i}}">{{$i}}</option>
                                @endfor
                        </select>
                        @endif
                        @error('goalPostInches')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="col-form-label" for="aef">AFE #</label>
                @if(!empty($route_assessment) && (isset($route_assessment['afe_no']) && $route_assessment['afe_no'] != ''))
                <input type="text" name="aef" class="form-control @error('aef') is-invalid @enderror" id="aef" placeholder="Enter AFE #" value="{{ $route_assessment['afe_no'] }}" />
                @else
                <input type="text" name="aef" class="form-control @error('aef') is-invalid @enderror" id="aef" placeholder="Enter AFE #" value="{{ old('aef') }}" />
                @endif @error('aef')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="col-form-label" for="rigType">Rig Type</label>
                @if(!empty($route_assessment) && (isset($route_assessment['rig_type_id']) && $route_assessment['rig_type_id'] != ''))
                <select id="rigType" name="rigType" class="form-control @error('rigType') is-invalid @enderror">
                    <option value="">Select Rig Type</option>
                    @foreach($getRigType as $type)

                    @if($type['id']==$route_assessment['rig_type_id'])
                    <option selected value="{{$type->id}}">{{$type['name']}}</option>
                    @else
                    <option value="{{$type['id']}}">{{$type['name']}}</option>
                    @endif
                    @endforeach
                </select>
                @else
                <select id="rigType" name="rigType" class="form-control @error('rigType') is-invalid @enderror">
                    <option value="" selected>Select Rig Type</option>
                    @foreach($getRigType as $type)
                    <option value="{{$type['id']}}">{{$type['name']}}</option>
                    @endforeach
                </select>
                @endif @error('rigType')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-7">
                    <div class="form-group">
                        <label class="col-form-label" for="moveType">Move Type</label>

                        @if(!empty($route_assessment) && (isset($route_assessment['move_type_id']) && $route_assessment['move_type_id'] != ''))
                        <select id="moveType" name="moveType" class="form-control @error('moveType') is-invalid @enderror">
                            <option value="">Select Move Type</option>
                            @foreach($getMoveType as $type)

                            @if($type['id']==$route_assessment['move_type_id'])
                            <option selected value="{{$type->id}}">{{$type['name']}}</option>
                            @else
                            <option value="{{$type['id']}}">{{$type['name']}}</option>
                            @endif
                            @endforeach
                        </select>
                        @else
                        <select id="moveType" name="moveType" class="form-control @error('moveType') is-invalid @enderror">
                            <option value="" selected>Select Move Type</option>
                            @foreach($getMoveType as $type)
                            <option value="{{$type['id']}}">{{$type['name']}}</option>
                            @endforeach
                        </select>
                        @endif @error('moveType')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="col-form-label" for="estMiles">Est. Miles to Move</label>
                        @if(!empty($route_assessment) && (isset($route_assessment['est_miles']) && $route_assessment['est_miles'] != ''))
                        <input type="number" name="estMiles" min="1" class="form-control @error('estMiles') is-invalid @enderror" id="estMiles" placeholder="Enter miles" value="{{ $route_assessment['est_miles'] }}" />
                        @else
                        <input type="number" name="estMiles" min="1" class="form-control @error('estMiles') is-invalid @enderror" id="estMiles" placeholder="Enter miles" value="{{ old('estMiles') }}" />

                        @endif @error('estMiles')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="col-form-label" for="operator">Operator </label>
                @if(!empty($route_assessment) && (isset($route_assessment['operator']) && $route_assessment['operator'] != ''))
                <input type="text" name="operator" class="form-control @error('operator') is-invalid @enderror" id="operator" placeholder="Operator / Company Man" value="{{ $route_assessment['operator'] }}" />
                @else
                <input type="text" name="operator" class="form-control @error('operator') is-invalid @enderror" id="operator" placeholder="Operator / Company Man" value="{{ old('operator') }}" />
                @endif @error('operator')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="col-form-label" for="operatorEmail">Operator / Company Man Email </label>
                @if(!empty($route_assessment) && (isset($route_assessment['operator_email']) && $route_assessment['operator_email'] != ''))
                <input type="text" name="operatorEmail" class="form-control @error('operatorEmail') is-invalid @enderror" id="operatorEmail" placeholder="Operator / Company Man Email" value="{{ $route_assessment['operator_email'] }}" />
                @else
                <input type="text" name="operatorEmail" class="form-control @error('operatorEmail') is-invalid @enderror" id="operatorEmail" placeholder="Operator / Company Man Email" value="{{ old('operatorEmail') }}" />
                @endif @error('operatorEmail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group add-records-first-form">
                <label class="col-form-label" for="oldLocgps">Rig Status</label>

                @if(!empty($route_assessment) && (isset($route_assessment['rig_status_id']) && $route_assessment['rig_status_id'] != ''))
                <select id="rigStatus" name="rigStatus" class="form-control @error('rigStatus') is-invalid @enderror">
                    <option value="">Select Select Rig Status</option>
                    @foreach($getRigStatus as $type)

                    @if($type['id']==$route_assessment['rig_status_id'])
                    <option selected value="{{$type->id}}">{{$type['name']}}</option>
                    @else
                    <option value="{{$type['id']}}">{{$type['name']}}</option>
                    @endif
                    @endforeach
                </select>
                @else
                <select id="rigStatus" name="rigStatus" class="form-control @error('rigStatus') is-invalid @enderror">
                    <option value="" selected>Select Rig Status</option>
                    @foreach($getRigStatus as $type)
                    <option value="{{$type['id']}}">{{$type['name']}}</option>
                    @endforeach
                </select>
                @endif
                @error('rigStatus')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <!-- <div class="col-lg-4">
            <div class="form-group">
                <label class="col-form-label" for="operatorDsm">Operator DSM (Drill Site Manager)</label>
                @if(!empty($route_assessment) && (isset($route_assessment['operator_dms']) && $route_assessment['operator_dms'] != ''))
                <input type="text" name="operatorDsm" class="form-control @error('operatorDsm') is-invalid @enderror" id="operatorDsm" placeholder="Operator DSM" value="{{ $route_assessment['operator_dms'] }}" />
                @else
                <input type="text" name="operatorDsm" class="form-control @error('operatorDsm') is-invalid @enderror" id="operatorDsm" placeholder="Operator DSM" value="{{ old('operatorDsm') }}" />
                @endif @error('operatorDsm')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div> -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="col-form-label" for="rigManager">Rig Manager / Tool Pusher</label>
                @if(!empty($route_assessment) && (isset($route_assessment['rig_manager']) && $route_assessment['rig_manager'] != ''))
                <input type="text" name="rigManager" class="form-control @error('rigManager') is-invalid @enderror" id="rigManager" placeholder="Rig Manager / Tool Pusher" value="{{ $route_assessment['rig_manager'] }}" />
                @else
                <input type="text" name="rigManager" class="form-control @error('rigManager') is-invalid @enderror" id="rigManager" placeholder="Rig Manager / Tool Pusher" value="{{ old('rigManager') }}" />
                @endif @error('rigManager')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="col-form-label" for="rigEmail">Rig Email *</label>
                @if(!empty($route_assessment) && (isset($route_assessment['rig_email']) && $route_assessment['rig_email'] != ''))
                <input type="text" name="rigEmail" class="form-control @error('rigEmail') is-invalid @enderror" id="rigEmail" placeholder="Rig e-mail" value="{{ $route_assessment['rig_email'] }}" />
                @else
                <input type="text" name="rigEmail" class="form-control @error('rigEmail') is-invalid @enderror" id="rigEmail" placeholder="Rig e-mail" value="{{ old('rigEmail') }}" />
                @endif @error('rigEmail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="col-form-label" for="rigPhone">Rig Phone Number</label>
                @if(!empty($route_assessment) && (isset($route_assessment['rig_phone']) && $route_assessment['rig_phone'] != ''))
                <input type="text" name="rigPhone" class="form-control @error('rigPhone') is-invalid @enderror" id="rigPhone" placeholder="Rig Phone Number" value="{{ $route_assessment['rig_phone'] }}" />
                @else
                <input type="text" name="rigPhone" class="form-control @error('rigPhone') is-invalid @enderror" id="rigPhone" placeholder="Rig Phone Number" value="{{ old('rigPhone') }}" />
                @endif @error('rigPhone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="user-record-form">
        <div class="row">
            <div class="col-lg-4 add-record-form">
                <div class="form-group add-records-first-form">
                    <label class="col-form-label" for="oldLoc">Well Name - Old Location </label>

                    @if(!empty($route_assessment) && (isset($route_assessment['old_location']) && $route_assessment['old_location'] != ''))
                    <input type="text" name="oldLoc" class="form-control @error('oldLoc') is-invalid @enderror" id="oldLoc" placeholder="Old location Well Name" value="{{ $route_assessment['old_location'] }}" />
                    @else
                    <input type="text" name="oldLoc" class="form-control @error('oldLoc') is-invalid @enderror" id="oldLoc" placeholder="Old location Well Name" value="{{ old('oldLoc') }}" />
                    @endif

                    <span class="add-record-form-image"><img src="{{ asset('img/map-pin.svg') }}" alt="" width="20" /> </span>
                    @error('oldLoc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-8">
                <div class="form-group add-records-first-form">
                    <label class="col-form-label" for="oldLocgps">GPS Coordinates - Old Location *</label>
                    <div class="row gps-coordinate">
                        <div class="col-lg-5 add-record-form">
                            <div class="form-group add-records-first-form">
                                <label class="col-form-label" for="olLatitude">Latitude</label>
                                <input type="text" name="olLatitude" class="form-control @error('olLatitude') is-invalid @enderror" id="olLatitude" placeholder="Example: 32.037796" value="@if($route_assessment && $route_assessment['old_location_latitude']){{ $route_assessment['old_location_latitude'] }}@else{{ old('olLatitude') }}@endif" />
                                @error('olLatitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-5 add-record-form">
                            <div class="form-group add-records-first-form">
                                <label class="col-form-label" for="olLongitude">Longitude</label>
                                <input type="text" name="olLongitude" class="form-control @error('olLongitude') is-invalid @enderror" id="olLongitude" placeholder="Example: -102.000632" value="@if($route_assessment && $route_assessment['old_location_longitude']){{ $route_assessment['old_location_longitude'] }}@else{{ old('olLongitude') }}@endif"  />
                                @error('olLongitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- @if(!empty($route_assessment) && (isset($route_assessment['old_gps_coordinates']) && $route_assessment['old_gps_coordinates'] != ''))
                    <input type="text" name="oldLocgps" class="form-control @error('oldLocgps') is-invalid @enderror" id="oldLocgps" placeholder="GPS Coordinate (ALT 0176 to enter degrees)" value="{{ $route_assessment['old_gps_coordinates'] }}" />
                    @else
                    <input type="text" name="oldLocgps" class="form-control @error('oldLocgps') is-invalid @enderror" id="oldLocgps" placeholder="GPS Coordinate (ALT 0176 to enter degrees)" value="{{ old('oldLocgps') }}" />
                    @endif

                    <span class="add-record-compass-image"><img src="{{ asset('img/compass.svg') }}" alt="" width="20" /> </span>
                    @error('oldLocgps')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror -->
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-4 ">
                <div class="form-group add-records-first-form">
                    <label class="col-form-label" for="newLoc">Well Name - New Location  </label>

                    @if(!empty($route_assessment) && (isset($route_assessment['new_location']) && $route_assessment['new_location'] != ''))
                    <input type="text" name="newLoc" class="form-control @error('newLoc') is-invalid @enderror" id="newLoc" placeholder="New location Well Name" value="{{  $route_assessment['new_location'] }}" />
                    @else
                    <input type="text" name="newLoc" class="form-control @error('newLoc') is-invalid @enderror" id="newLoc" placeholder="New location Well Name" value="{{ old('newLoc') }}" />
                    @endif

                    <span class="add-record-form-image"><img src="{{ asset('img/map-pin.svg') }}" alt="" width="20" /> </span>
                    @error('newLoc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-8">
                <div class="form-group add-records-first-form">
                    <label class="col-form-label" for="newLocgps">GPS Coordinates - New Location * </label>

                    <!-- @if(!empty($route_assessment) && (isset($route_assessment['new_gps_coordinates']) && $route_assessment['new_gps_coordinates'] != ''))
                    <input type="text" name="newLocgps" class="form-control @error('newLocgps') is-invalid @enderror" id="newLocgps" placeholder="GPS Coordinate (ALT 0176 to enter degrees)" value="{{ $route_assessment['new_gps_coordinates'] }}" />
                    @else
                    <input type="text" name="newLocgps" class="form-control @error('newLocgps') is-invalid @enderror" id="newLocgps" placeholder="GPS Coordinate (ALT 0176 to enter degrees)" value="{{ old('newLocgps') }}" />
                    @endif

                    <span class="add-record-compass-image"><img src="{{ asset('img/compass.svg') }}" alt="" width="20" /> </span>
                    @error('newLocgps')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror -->
                    <div class="row gps-coordinate">
                        <div class="col-lg-5 add-record-form">
                            <div class="form-group add-records-first-form">
                                <label class="col-form-label" for="newLatitude">Latitude</label>
                                <input type="text" name="newLatitude" class="form-control @error('newLatitude') is-invalid @enderror" id="newLatitude" placeholder="Example: 32.037796" value="@if($route_assessment && $route_assessment['new_location_latitude']){{ $route_assessment['new_location_latitude'] }}@else{{ old('newLatitude') }}@endif" />
                                @error('newLatitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-5 add-record-form">
                            <div class="form-group add-records-first-form">
                                <label class="col-form-label" for="newLongitude">Longitude</label>
                                <input type="text" name="newLongitude" class="form-control @error('newLongitude') is-invalid @enderror" id="newLongitude" placeholder="Example: -102.000632" value="@if($route_assessment && $route_assessment['new_location_longitude']){{ $route_assessment['new_location_longitude'] }}@else{{ old('newLongitude') }}@endif"  />
                                @error('newLongitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->

    </div>
    <div class="user-record-form">

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4 add-record-form">
                <div class="form-group add-records-first-form">
                    <label class="col-form-label col-form-label" for="oldLoccer">Closest police/Sheriff's office</label>

                    @if(!empty($route_assessment) && (isset($route_assessment['old_closest_emergency_room']) && $route_assessment['old_closest_emergency_room'] != ''))
                    <input type="text" name="oldLoccer" class="form-control @error('oldLoccer') is-invalid @enderror" id="oldLoccer" placeholder="Enter closest Police/Sheriff's office" value="{{ $route_assessment['old_closest_emergency_room'] }}" />
                    @else
                    <input type="text" name="oldLoccer" class="form-control @error('oldLoccer') is-invalid @enderror" id="oldLoccer" placeholder="Enter closest Police/Sheriff's office" value="{{ old('oldLoccer') }}" />
                    @endif

                    <span class="add-record-form-image"><img src="{{ asset('img/map-pin.svg') }}" alt="" width="20" /> </span>
                    @error('oldLoccer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group add-records-first-form">
                    <label class="col-form-label col-form-label" for="oldLocEc">Emergency Contact:</label>

                    @if(!empty($route_assessment) && (isset($route_assessment['old_emergency']) && $route_assessment['old_emergency'] != ''))
                    <input type="text" name="oldLocEc" class="form-control @error('oldLocEc') is-invalid @enderror" id="oldLocEc" placeholder="Enter emergency contact number" value="{{ $route_assessment['old_emergency'] }}" />
                    @else
                    <input type="text" name="oldLocEc" class="form-control @error('oldLocEc') is-invalid @enderror" id="oldLocEc" placeholder="Enter emergency contact number" value="{{ old('oldLocEc') }}" />
                    @endif @error('oldLocEc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4 add-record-form">
                <div class="form-group add-records-first-form">
                    <label class="col-form-label col-form-label" for="newLoccer">Closest Emergency room</label>

                    @if(!empty($route_assessment) && (isset($route_assessment['new_closest_emergency_room']) && $route_assessment['new_closest_emergency_room'] != ''))
                    <input type="text" name="newLoccer" class="form-control @error('newLoccer') is-invalid @enderror" id="newLoccer" placeholder="Enter closest emergency room" value="{{ $route_assessment['new_closest_emergency_room'] }}" />
                    @else
                    <input type="text" name="newLoccer" class="form-control @error('newLoccer') is-invalid @enderror" id="newLoccer" placeholder="Enter closest emergency room" value="{{ old('newLoccer') }}" />
                    @endif

                    <span class="add-record-form-image"><img src="{{ asset('img/map-pin.svg') }}" alt="" width="20" /> </span>
                    @error('newLoccer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group add-records-first-form">
                    <label class="col-form-label col-form-label" for="newLocEc">Emergency Contact:</label>

                    @if(!empty($route_assessment) && (isset($route_assessment['new_emergency']) && $route_assessment['new_emergency'] != ''))
                    <input type="text" name="newLocEc" class="form-control @error('newLocEc') is-invalid @enderror" id="newLocEc" placeholder="Enter emergency contact number" value="{{ $route_assessment['new_emergency'] }}" />
                    @else
                    <input type="text" name="newLocEc" class="form-control @error('newLocEc') is-invalid @enderror" id="newLocEc" placeholder="Enter emergency contact number" value="{{ old('newLocEc') }}" />
                    @endif @error('newLocEc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
        <!-- /.row -->
    </div>
    @php
    $dynamicLabel = '';
    $lableName = '';
    $directionToLocation = '';
    foreach ($assessment_routes as $direction) {
        if (!$direction->hazard_id) {
            $dynamicLabel = $direction->label;
            $lableName = $direction->labelName;
            $directionToLocation = $direction->new_location;
        }
    }
    @endphp
    <div class="col-lg-12 begin-direction" id="direction-div" @if(!$directionToLocation) hidden @endif>
        <div class="user-record-form">
            <div class="row">
                <div class="col-lg-12 add-records-text-box">
                    <div class="form-group">
                        <label id="directionLabel">{{$dynamicLabel}}</label>
                        <input type="text" hidden name="routeDynamicLabel[]" id="dynamicLabel" value="{{$dynamicLabel}}" class="form-control" />
                        <button type="button" data-toggle="modal" id="direction-del-btn" data-target="#deleteDir" class="btn btn-danger del_btn_direction btn_remove_assessment"><i class="fa-solid fa-trash"></i></button>
                        <div class="col-lg-12">
                            <input type="text" name="routeLabelName[]" id="direction-input" class="form-control col-lg-4" maxlength="100" value="{{$lableName}}" placeholder="@if($dynamicLabel == 'Directions to Old Location' || $dynamicLabel == 'Directions to New Location' || $dynamicLabel == 'Directions from Old Location to New Location') Please Fill in Location Name(s) above @else {{$dynamicLabel}} @endif" @if($dynamicLabel == 'Directions to Old Location' || $dynamicLabel == 'Directions to New Location' || $dynamicLabel == 'Directions from Old Location to New Location') readonly @endif />
                        </div>
                        <label ></label>
                        <textarea class="form-control tinyeditor" id="direction_route_new_location" name="direction_route_new_location[]" rows="3" placeholder="Enter direction">{{$directionToLocation}}</textarea>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
    </div>
    

    <div class="col-lg-3 add-field-button pt-2 add-records-first-form-end form-group" id="add-direction-btn" @if($directionToLocation) hidden @endif>
        <div class="" id="route_dropdown">
            <button class="btn btn-primary dropdown-toggle add-travel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('img/plus-circle.svg') }}" width="20">Add Travel Directions
            </button>
            <div class="dropdown-menu travel-direction" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item direction-dropdown-option" type="button">Directions to Old Location</a>
                <a class="dropdown-item direction-dropdown-option" type="button">Directions from Old Location to New Location</a>
                <a class="dropdown-item direction-dropdown-option" type="button">Directions to New Location</a>
                <p><span>Directions to Other: </span>
                    <input type="text" name="custom" class="direction-dropdown-option form-control custom-name" placeholder="Custom Header"></input>
                    <a></a>
                </p>
            </div>
        </div>
    </div>
    @foreach ($assessment_routes as $index => $route)
    @if($route->hazard_id)


    <div class="col-lg-12 begin-direction parent" id="rows{{$index}}-assessment-text">
        <label>Hazard</label>
        <button type="button" name="remove" id="{{$index}}-assessment-text" class="btn btn-danger btn_remove_assessment"><i class="fa-solid fa-trash"></i></button>
        <div class="user-record-form">
            <div class="col-lg-12 add-hazard-text-box">
                <div class="col-lg-6">
                    <input type="text" placeholder="Enter Header" name="hazardHeader[]"  value="{{$route->labelName}}" class="form-control" />
                </div>
                <div class="col-lg-12 hazard-middle">
                    <div class="form-group row add-hazard">
                    <div class="col-lg-3 col-md-3 distance-measurement">
                            <div class="row">
                            
                                <div class="col-lg-6 col-md-6">
                                    <input type="text" placeholder="Distance" name="hazardDistance[]" value="{{$route->distance}}" class="form-control" />
                                </div>
                                <div class="col-lg-6 col-md-6"> 
                                    @if($route->measurement_id)
                                    <select id="'+ assessment + '_measurement" name="hazardMeasurement[]" class="form-control" >
                                        <option value="">Select Units </option>
                                    @foreach ($measurementList as $measurementValues) 
                                        @if($measurementValues->id== $route->measurement_id)
                                        <option selected value="{{$measurementValues->id}}">{{$measurementValues->name}}</option>
                                        @else
                                        <option  value="{{$measurementValues->id}}">{{$measurementValues->name}}</option>
                                        @endif
                                    @endforeach                                           
                                    </select>
                                    @else
                                    <select id="'+ assessment + '_measurement" name="hazardMeasurement[]" class="form-control" >
                                        <option value="">Select Units</option>
                                        @foreach ($measurementList as $measurementValues)
                                        <option  value="{{$measurementValues->id}}">{{$measurementValues->name}}</option>      
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                            </div>

                        </div>
                       
                            
                        
                        
                        <div class="col-lg-3 col-md-3"> 
                            @if($route->hazard_id)
                            <select id="'+ assessment + '_menu" name="hazardMenu[]" class="form-control" >
                                <option value="">Select Hazard</option>
                               @foreach ($hazardList as $hazardValues) 
                                @if($hazardValues->id== $route->hazard_id)
                                <option selected value="{{$hazardValues->id}}">{{$hazardValues->name}}</option>
                                @else
                                <option  value="{{$hazardValues->id}}">{{$hazardValues->name}}</option>
                                @endif
                               @endforeach                                           
                            </select>
                            @else
                            <select id="'+ assessment + '_menu" name="hazardMenu[]" class="form-control" >
                                <option value="">Select Hazard</option>
                                @foreach ($hazardList as $hazardValues)
                                <option  value="{{$hazardValues->id}}">{{$hazardValues->name}}</option>      
                                @endforeach
                            </select>
                            @endif

                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <select name="hazardFeet[]" class="form-control" id="feet{{$index}}">
                                        <option value="">Feet</option>
                                        @php
                                        $i=0
                                        @endphp
                                        @while($i<=100) 
                                        <option value="{{$i}}" @if($i==$route->feet) selected @endif>{{$i}}</option>
                                        @php
                                        $i++
                                        @endphp
                                        @endwhile
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <select name="hazardInches[]" class="form-control" id="inches{{$index}}">
                                        <option value="">Inches</option>
                                        @php
                                        $i=0
                                        @endphp
                                        @while($i<=11) 
                                        <option value="{{$i}}" @if($i==$route->inches) selected @endif>{{$i}}</option>
                                        @php
                                        $i++
                                        @endphp
                                        @endwhile
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <input type="text" placeholder="Hazard Instruction" name="hazardInstruction[]" value="{{$route->instruction}}" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <textarea class="form-control" name="hazardNote[]" rows="3" placeholder="Enter Notes">{{$route->note}}</textarea>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
        <p class="assessment-text"></p>
        <!-- modal -->
        <div class="modal fade" id="preventAssessmentModal" tabindex="-1" role="dialog" aria-labelledby="preventAssessmentModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <p>Do you want to remove the content from the Hazard List? </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary reset-assessment-popup">Close</button>
                        <button type="button" class="btn btn-danger assessment-popup-remove">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end-modal -->
        <div class="col-lg-3 add-field-button pt-2 add-records-first-form-end form-group">
            <button type="button" class="add-employee-link" id="add-assessment-box">
                <img src="{{ asset('img/plus-circle.svg') }}" width="20">
                <h5>Add Hazard</h5>
            </button>
        </div>

        <div class="user-record-form">
            <div class="row">
                <div class="col-lg-3 add-record-form">
                    <div class="form-group add-records-first-form">
                        <label class="col-form-label submit-before-label" for="totalMiles">Total miles </label>

                        @if(!empty($route_assessment) && (isset($route_assessment['total_miles']) && $route_assessment['total_miles'] != ''))
                        <input type="text" name="totalMiles" class="form-control @error('totalMiles') is-invalid @enderror" id="totalMiles" placeholder="Total miles" value="{{ $route_assessment['total_miles'] }}" />
                        @else
                        <input type="text" name="totalMiles" class="form-control @error('totalMiles') is-invalid @enderror" id="totalMiles" placeholder="Total miles" value="{{ old('totalMiles') }}" />
                        @endif @error('totalMiles')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group add-records-first-form">
                        <label class="col-form-label submit-before-label" for="totalCattGuard">Total Power Lines:</label>
                        <select name="totalCattGuard" class="form-control @error('totalCattGuard') is-invalid @enderror totalCattGuard" @if(isset($route_assessment)) value="{{ $route_assessment['total_cattle_gaurds'] }}" @endif>
                            <option @if(isset($route_assessment)) value="{{ $route_assessment->total_cattle_gaurds }}" @endif> @if(isset($route_assessment)){{ $route_assessment['total_cattle_gaurds'] }}@endif</option>
                            @for($i=0;$i<=100;$i++) <option value="{{$i}}">{{$i}}</option>
                                @endfor
                        </select>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group add-records-first-form">
                        <label class="col-form-label" for="totalOverHazard">Total overhead hazards bridges, traffic lights, guide wire:</label>
                        <select name="totalOverHazard" class="form-control @error('totalOverHazard') is-invalid @enderror totalOverHazard" @if(isset($route_assessment)) value="{{ $route_assessment['total_overhead_harzards'] }}" @endif>
                            <option @if(isset($route_assessment)) value="{{ $route_assessment['total_overhead_harzards'] }}" @endif> @if(isset($route_assessment)){{ $route_assessment['total_overhead_harzards'] }}@endif</option>
                            @for($i=0;$i<=100;$i++) <option value="{{$i}}">{{$i}}</option>
                                @endfor
                        </select>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group add-records-first-form">
                        <label class="col-form-label submit-before-label" for="lowestOverHazard">Lowest overhead Hazard:</label>

                        @if(!empty($route_assessment) && (isset($route_assessment['lowest_overhead_harzards']) && $route_assessment['lowest_overhead_harzards'] != ''))
                        <input type="text" name="lowestOverHazard" class="form-control @error('lowestOverHazard') is-invalid @enderror" id="lowestOverHazard" placeholder="Lowest overhead hazard" value="{{ $route_assessment['lowest_overhead_harzards'] }}" />
                        @else
                        <input type="text" name="lowestOverHazard" class="form-control @error('lowestOverHazard') is-invalid @enderror" id="lowestOverHazard" placeholder="Lowest overhead hazard" value="{{ old('lowestOverHazard') }}" />
                        @endif @error('lowestOverHazard')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-5 goal-post">
                    <div class="row form-control form-group">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group add-records-first-form">
                                <label class="col-form-label col-lg-4" for="lowestOverHazardFeet"> Feet</label>
                                <select name="lowestOverHazardFeet" id="lowestOverHazardFeet" class="form-control col-lg-8">
                                <option value="">Select Feet</option>
                                    @php
                                    $i=0
                                    @endphp
                                    @while($i<=100) 
                                        <option value="{{$i}}" @if(!empty($route_assessment) && $route_assessment['lowest_overhead_harzards_feet'] && $i==$route_assessment['lowest_overhead_harzards_feet']) selected @endif>{{$i}}</option>
                                        @php
                                        $i++
                                        @endphp
                                        @endwhile
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group add-records-first-form">
                                <label class="col-form-label col-lg-4" for="lowestOverHazardInches"> Inches</label>
                                <select name="lowestOverHazardInches" id="lowestOverHazardInches" class="form-control col-lg-8">
                                <option value="">Select Inches</option>
                                    @php
                                    $i=0
                                    @endphp
                                    @while($i<=11) 
                                        <option value="{{$i}}" @if(!empty($route_assessment) && $route_assessment['lowest_overhead_harzards_inches'] && $i==$route_assessment['lowest_overhead_harzards_inches']) selected @endif>{{$i}}</option>
                                        @php
                                        $i++
                                        @endphp
                                        @endwhile
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group add-records-first-form">
                        <label class="col-form-label submit-before-label" for="lowestPowerLine">Lowest power Line:</label>

                        @if(!empty($route_assessment) && (isset($route_assessment['lowest_power_line']) && $route_assessment['lowest_power_line'] != ''))
                        <input type="text" name="lowestPowerLine" class="form-control @error('lowestPowerLine') is-invalid @enderror" id="lowestPowerLine" placeholder="Lowest power line" value="{{ $route_assessment['lowest_power_line'] }}" />
                        @else
                        <input type="text" name="lowestPowerLine" class="form-control @error('lowestPowerLine') is-invalid @enderror" id="lowestPowerLine" placeholder="Lowest power line" value="{{ old('lowestPowerLine') }}" />
                        @endif @error('lowestOverHazard')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-5 goal-post">
                    <div class="row form-control form-group">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group add-records-first-form">
                                <label class="col-form-label col-lg-4" for="lowestPowerLineFeet"> Feet</label>
                                <select name="lowestPowerLineFeet" id="lowestPowerLineFeet" class="form-control col-lg-8">
                                <option value="">Select Feet</option>
                                    @php
                                    $i=0
                                    @endphp
                                    @while($i<=100) 
                                        <option value="{{$i}}" @if(!empty($route_assessment) && $route_assessment['lowest_power_line_feet'] && $i==$route_assessment['lowest_power_line_feet']) selected @endif>{{$i}}</option>
                                        @php
                                        $i++
                                        @endphp
                                        @endwhile
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group add-records-first-form">
                                <label class="col-form-label col-lg-4" for="lowestPowerLineInches"> Inches</label>
                                <select name="lowestPowerLineInches" id="lowestPowerLineInches" class="form-control col-lg-8">
                                <option value="">Select Inches</option>
                                    @php
                                    $i=0
                                    @endphp
                                    @while($i<=11) 
                                        <option value="{{$i}}" @if(!empty($route_assessment) && $route_assessment['lowest_power_line_inches'] && $i==$route_assessment['lowest_power_line_inches']) selected @endif>{{$i}}</option>
                                        @php
                                        $i++
                                        @endphp
                                        @endwhile
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group add-records-first-form">
                        <label class="col-form-label submit-before-label" for="routeAssessorsName">Route Assessment completedby:</label>

                        @if(!empty($route_assessment) && (isset($route_assessment['route_assessor_name']) && $route_assessment['route_assessor_name'] != ''))
                        <input type="text" name="routeAssessorsName" class="form-control @error('routeAssessorsName') is-invalid @enderror" id="routeAssessorsName" placeholder="Route assessors name" value="{{ $route_assessment['route_assessor_name'] }}" />
                        @else
                        <input type="text" name="routeAssessorsName" class="form-control @error('routeAssessorsName') is-invalid @enderror" id="routeAssessorsName" placeholder="Route assessors name" value="{{ old('routeAssessorsName') }}" />
                        @endif @error('routeAssessorsName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group add-records-first-form">

                        <label class="col-form-label submit-before-label" for="routeAssessorsEmail">Route Assessor Email:</label>

                        @if(!empty($route_assessment) && (isset($route_assessment['route_assessor_email']) && $route_assessment['route_assessor_email'] != ''))
                        <input type="text" name="routeAssessorsEmail" class="form-control @error('routeAssessorsEmail') is-invalid @enderror" id="routeAssessorsEmail" placeholder="Route Assessor Email" value="{{ $route_assessment['route_assessor_email'] }}" />
                        @else
                        <input type="text" name="routeAssessorsEmail" class="form-control @error('routeAssessorsEmail') is-invalid @enderror" id="routeAssessorsEmail" placeholder="Route assessor Email" value="{{ old('routeAssessorsEmail') }}" />
                        @endif @error('routeAssessorsEmail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group add-records-first-form">
                        <label class="col-form-label submit-before-label" for="routeAssessorPhone">Route Assessor Phone:</label>

                        @if(!empty($route_assessment) && (isset($route_assessment['route_assessor_phone']) && $route_assessment['route_assessor_phone'] != ''))
                        <input type="text" name="routeAssessorPhone" class="form-control @error('routeAssessorPhone') is-invalid @enderror" id="routeAssessorPhone" placeholder="Route assessor phone" value="{{ $route_assessment['route_assessor_phone'] }}" />
                        @else
                        <input type="text" name="routeAssessorPhone" class="form-control @error('routeAssessorPhone') is-invalid @enderror" id="routeAssessorPhone" placeholder="Route assessor phone" value="{{ old('routeAssessorPhone') }}" />
                        @endif @error('routeAssessorPhone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>

        <!-- Custome field block -->
        @if(!empty($route_assessment) && isset($route_assessment['customFields']) && count($route_assessment['customFields']) > 0)
        <div class="custom-field-form">
            <div class="row">
                @php $key = 0; @endphp
                @foreach($route_assessment['customFields'] as $custom_field)

                @if($custom_field['input_type'] == 1)
                @include('records.inputtext', [$custom_field, $key])
                @elseif($custom_field['input_type'] == 2)
                @include('records.inputnumber', [$custom_field, $key])
                @elseif($custom_field['input_type'] == 3)
                @include('records.inputtextarea', [$custom_field, $key])
                @endif
                @php $key++; @endphp
                @endforeach
            </div>
        </div>
        @endif
        <!-- Custome field block -->

        <!-- Add Custome field block -->
        <div class="custom_field_block route">
            <div class="row">
            </div>
        </div>
        <!-- Add Custome field block -->

        <!-- Add Custome Field -->
        <div class="user-record-form-end custom-field-form custom_field_form route">
            <p class="">Create Custom Field:</p>
            <div class="row align-items-end">
                <div class="col-lg-3 add-record-form pt-2 ">
                    <div class="form-group add-records-first-form">
                        <label class="col-form-label submit-before-label" for="customInputType">Choose Field Type:</label>
                        <select name="customInputType" class="form-control @error('customInputType') is-invalid @enderror customInputType" value="{{ old('customInputType') }}">
                            <option value="">Select</option>
                            @foreach($input_array as $input)
                            @if($input['id'] != 4 && $input['id'] != 5)
                            <option value="{{$input['id']}}">{{$input['type_name']}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('customInputType')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-3 add-record-form pt-2 ">
                    <div class="form-group add-records-first-form-end">
                        <label class="col-form-label submit-before-label" for="customLabelName">Enter Field Name:</label>
                        <input type="text" name="customLabelName" class="form-control @error('customLabelName') is-invalid @enderror customLabelName" placeholder="Custom field name" value="{{ old('customLabelName') }}" />
                        @error('customLabelName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3 add-field-button pt-2 add-records-first-form-end form-group">
                    <button type="button" class="user-record-addfield" onclick="add_custom_field('route')">
                        <h5>Add Field</h5>
                    </button>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- Modal -->
        <div class="modal fade" id="deleteDir" tabindex="-1" role="dialog" aria-labelledby="deleteDirLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body">
                        <p>Do you want to remove the content from the direction record? </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary reset-direction-popup" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="popup-remove">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            var assessment = 1;

            // $(document).on('click', '.btn_remove_assessment', function() {
            //     var assessment_button_id = $(this).attr("id");
            //     $('#row' + assessment_button_id).remove();
            // });

            $(document).on('click', '.btn_remove_assessment', function() {
                var assessment_button_id = $(this).attr("id");
                $('.assessment-popup-remove').attr("data-delete-id", assessment_button_id);
                $('#preventAssessmentModal').modal('show');
            });

            $(document).on('click', '.assessment-popup-remove', function() {
                var assessmentButtonId = $(this).attr("data-delete-id");
                $(this).removeAttr('data-delete-id');

                let result = assessmentButtonId.includes("-") ? "Yes" : null;
                if (result) {
                    $('#rows' + assessmentButtonId).remove();
                } else {
                    $('#row' + assessmentButtonId).remove();
                }
                // $('#row' + assessmentButtonId).remove();

                $('#preventAssessmentModal').modal('hide');
            });

            $(document).on('click', '.reset-assessment-popup', function() {
                var nextChildElement = $(this).next();
                nextChildElement.removeAttr('data-delete-id');
                $('#preventAssessmentModal').modal('hide');
            });


            $(document).on('keyup', '#oldLoc', function() {
                $('.old-route-direction').val('');
                $('.old-new-route-direction').val('');
                $('.old-route-direction').removeClass('placeholder-error')
                $('.old-new-route-direction').removeClass('placeholder-error')
                $('#oldLoc').removeClass('placeholder-error')
                oldLocationText = $(this).val();
                newLocationText = $('#newLoc').val();
                if(oldLocationText){
                    $('.old-route-direction').val(oldLocationText);  
                } else {
                    $('.old-route-direction').addClass('placeholder-error')
                    if($('.old-route-direction').length || $('.old-new-route-direction').length) {
                        $('#oldLoc').addClass('placeholder-error')
                    }
                }
                if(oldLocationText){
                    $('.old-new-route-direction').val(oldLocationText+' to '+newLocationText);
                } else {
                    $('.old-new-route-direction').val('');
                    $('.old-new-route-direction').addClass('placeholder-error')
                }
            });
            
            $(document).on('keyup', '#newLoc', function() {
                oldLocationText = $('#oldLoc').val();
                newLocationText = $(this).val();
                $('.new-route-direction').val('');
                $('.old-new-route-direction').val('');
                $('.new-route-direction').removeClass('placeholder-error')
                $('.old-new-route-direction').removeClass('placeholder-error')
                $('#newLoc').removeClass('placeholder-error')
                if(newLocationText){
                    $('.new-route-direction').val(newLocationText);
                } else {
                    $('.new-route-direction').addClass('placeholder-error')
                    if($('.new-route-direction').length || $('.old-new-route-direction').length) {
                        $('#newLoc').addClass('placeholder-error')
                    }
                }
                if(newLocationText){
                    $('.old-new-route-direction').val(oldLocationText+' to '+newLocationText);
                } else {
                    $('.old-new-route-direction').val('');
                    $('.old-new-route-direction').addClass('placeholder-error')
                }
            });

            $("#add-assessment-box").click(function() {
                <?php
                    $i=0;
                    $j=0;
                ?>

                $(".assessment-text").append('<div id="row' + assessment + '_assessment_text" class="col-lg-12 begin-direction parent"><label>Hazard</label><button type="button" name="remove" id="' + assessment + '_assessment_text" class="btn btn-danger btn_remove_assessment"><i class="fa-solid fa-trash"></i></button><div class="user-record-form"><div class="col-lg-12 add-hazard-text-box"><div class="col-lg-6"><input type="text" placeholder="Enter Header"name="hazardHeader[]" class="form-control"/></div><div class="col-lg-12 hazard-middle"><div class="form-group row add-hazard"> <div class="col-lg-3 distance-measurement"><div class="row"><div class="col-lg-6"><input type="text" placeholder="Distance" name="hazardDistance[]" class="form-control"/></div><div class="col-lg-6"> <select  id="' + assessment + '_measurement" name="hazardMeasurement[]" class="form-control" ><option value="" >Select Units</option><?php foreach ($measurementList as $measurementValues) {echo "<option value=$measurementValues->id> $measurementValues->name </option>";} ?></select></div></div></div><div class="col-lg-3"> <select  id="' + assessment + '_menu" name="hazardMenu[]" class="form-control" ><option value="" >Select Hazard</option><?php foreach ($hazardList as $hazardValues) {echo "<option value=$hazardValues->id> $hazardValues->name </option>";} ?></select></div><div class="col-lg-2"><div class="row"><div class="col-lg-6"><select id ="feet' + assessment + '" class="form-control" name="hazardFeet[]"><option value="">Feet</option><?php while ($i <= 100) {echo "<option value=$i> $i </option>"; $i++;} ?></select></div><div class="col-lg-6"><select id ="inches' + assessment + '" class="form-control" name="hazardInches[]"><option value="">Inches</option><?php while ($j <= 11) {echo "<option value=$j> $j </option>"; $j++;} ?></select></div></div></div><div class="col-lg-4"><input type="text" placeholder="Hazard Instruction" name="hazardInstruction[]" class="form-control"/></div></div></div><div class="col-lg-12"><textarea class="form-control"  name="hazardNote[]" rows="3" placeholder="Enter Notes"></textarea></div></div></div></div>');

                // const subDetails= ['_cattle-guard-drop-down','_direction-power-line','_other-drop-down'];
                //     $.each(subDetails , function(id, val) { 
                //         var data = direction+val;
                //         dropdownOption(data);
                //     });


                assessment++;


            });






            // $(document).on('click', '.mis-field-add', function (e) {
            //   var baseUrl = "{{ url('')}}";
            //   var content = $(this).attr('data-append-content');
            //   var type = $(this).attr('data-field-type');
            //   var mis = $(this);
            //   if (type == 'dropdown-option') {
            //     var parent_tr = $(this).parent().parent();
            //   }
            //   $.ajax({
            //     type: 'get',
            //     url: baseUrl + '/records/hazard-field/' + type,
            //     success: function (data) {
            //       if (type != 'dropdown-option') {
            //         $('.mis-field-append-' + content).append('' + data + '');
            //       }
            //       $('img.mis-field-add').attr('src', "{{env('DOMAIN_URL')}}/img/plus-into-red-add-icon.png");
            //       if (type == 'dropdown') {
            //         var ttl = mis.attr('data-count');
            //         var new_ttl = Number(ttl) + Number(1);
            //         mis.attr('data-count', new_ttl);
            //         console.log(new_ttl);
            //         var drop = $('.mis-field-append-' + content).find('.mis-definition:last');
            //         console.log(drop);
            //         drop.find('img.mis-field-add').attr('data-list-no', new_ttl);
            //         drop.attr('data-list-no', new_ttl);
            //         drop.find('input[type="radio"]').attr('name', 'temp_name_' + new_ttl);
            //       }
            //       if (type == 'dropdown-option') {
            //         var list_no = mis.attr('data-list-no');
            //         console.log(list_no);
            //         $('.mis-definition[data-list-no="' + list_no + '"]')
            //           .find('.mis-field-append-' + content)
            //           .append('' + data + '');
            //         $('.mis-definition[data-list-no="' + list_no + '"]')
            //           .find('input[type="radio"]')
            //           .last()
            //           .attr('name', 'temp_name_' + list_no);
            //         if (parent_tr.find('.delete-left-char').css("visibility") === "hidden") {
            //           parent_tr.find('.delete-left-char').css("visibility", "visible");
            //         }
            //       }
            //     }
            //   });
            // });

            // $(document).on('click', '.mis-field-close', function () {
            //   if ($(this).hasClass('remove-mis-definition')) {
            //     $(this).parents('.mis-definition').remove();
            //   } else {
            //     var parent_tr = $(this).parent().parent();
            //     if (parent_tr.find('.mis-dropdown-option-list').length != 1) {
            //       $(this).parent().remove();
            //     }
            //     if (parent_tr.find('.mis-dropdown-option-list').length == 1) {
            //       parent_tr.find('.mis-field-close').find('.delete-left-char').css("visibility", "hidden");
            //     }
            //   }

            // });

            $('.js-example-basic-multiple').select2();




        });


        //     $(document).ready(function(){ 

        //     function feetValueQuotes()
        //         {
        //               let current= $(this);

        //             console.log(parent_id);
        // //   var x = document.getElementById("1");
        //   console.log(x);
        // //  x.value = x.value.toUpperCase();
        //         }
        //     });
        $(document).on('focus', '.feet-assessment', function() {

            let currentId = $(this).attr('id');
                var x = document.getElementById(currentId);
            // var x = document.getElementsByClass(currentId);
            let withoutQuotes = x.value.includes("\'");

            if(withoutQuotes){
               x.value = x.value.split('\'')[0];
            }
        });

        $(document).on('blur', '.feet-assessment', function() {

            let currentId = $(this).attr('id');
            let x = document.getElementById(currentId);
            if(x.value!==""){
                x.value = x.value + '\'';
            }
            
        });

        $(document).on('focus', '.inches-assessment', function() {

            let currentId = $(this).attr('id');
            var x = document.getElementById(currentId);
            let withoutQuotes = x.value.includes("\"");

            if(withoutQuotes){
            x.value = x.value.split('\"')[0];
            }
        });


        $(document).on('blur', '.inches-assessment', function() {

            let currentId = $(this).attr('id');
            let x = document.getElementById(currentId);
            if(x.value!==""){
                x.value = x.value + '\"';
            }
        });

        $(document).on('click', '#popup-remove', function () {
            
            tinymce.activeEditor.setContent('');
            $('#direction-input').val('');
            $('#direction_route_new_location').html('');
            $('.tinyeditor').html('');
            $('#direction-div').prop('hidden', true);
            $('#direction-div').removeClass('extra-direction');
            $('#direction-input').removeClass('old-route-direction');
            $('#direction-input').removeClass('new-route-direction');
            $('#direction-input').removeClass('old-new-route-direction');
            $('#direction-input').removeClass('placeholder-error');
            $("input[name='oldLoc']").removeClass('placeholder-error');
            $("input[name='newLoc']").removeClass('placeholder-error');
            $('#add-direction-btn').prop('hidden', false);
            $('#direction-del-btn').click();
        })
        if($('.extra-direction').length) {
            $('#add-direction-btn').prop('hidden', true);
        }

        $("#route_dropdown a").click(function() {

            $('#direction-input').prop('readonly', false);
            $('#direction-input').removeClass('placeholder-error');
            $("input[name='oldLoc']").removeClass('placeholder-error');
            $("input[name='newLoc']").removeClass('placeholder-error');
            var customValue = $(this).text();
            var splittedCustomValue = 'Please Fill in Location Name(s) above';
            var placeholderClass = "";
            var value = '';
            var newClass ='';
            var oldval='';
            var newval='';
            var readonly = true;
            if (customValue == 'Directions from Old Location to New Location') {
                newClass = "old-new-route-direction"
                oldval = $("input[name='oldLoc']").val();
                newval = $("input[name='newLoc']").val();
                value = oldval +' to '+ newval;
                if (oldval=='' || newval=='') {
                    value = '';
                    if(oldval=='') {
                        $("input[name='oldLoc']").addClass('placeholder-error');
                    } if(newval=='') {
                        $("input[name='newLoc']").addClass('placeholder-error');
                    }
                }
            } else {
                splittedCustomValue = customValue.split('Directions to ')[1];
                if(splittedCustomValue == "Old Location") {
                    newClass = 'old-route-direction';
                    value = $("input[name='oldLoc']").val();
                    if(value ==''){
                        $("input[name='oldLoc']").addClass('placeholder-error');
                    }
                } else if(splittedCustomValue == "New Location") {
                    newClass = 'new-route-direction';
                    value = $("input[name='newLoc']").val();
                    if(value ==''){
                        $("input[name='newLoc']").addClass('placeholder-error');
                    }
                }
                splittedCustomValue = 'Please Fill in Location Name(s) above';
            }

            if (!customValue) {
                value = '';
                customValue = 'Directions to Others ' + $("input[name='custom']").val();
                splittedCustomValue = 'Directions to '+ customValue.split('Directions to Others ')[1];
                readonly = false;
                newClass = ''
                placeholderClass = ""
            } else {
                if(value == ''){
                    placeholderClass = "placeholder-error";
                }
            }


            $('#directionLabel').html(customValue);
            $("#dynamicLabel").val(customValue);
            $('#direction-input').attr('placeholder', splittedCustomValue);
            $('#direction-input').val(value);
            $('#direction-input').addClass(placeholderClass);
            $('#direction-input').addClass(newClass);
            $('#direction-input').prop('readonly', readonly);
            $('#direction-div').prop('hidden', false);
            $('#direction-div').addClass('extra-direction');
            $('#add-direction-btn').prop('hidden', true);
            
            $("input[name='custom']").val('');
        });


        
    </script>