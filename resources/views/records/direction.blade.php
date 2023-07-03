<div class="secblk">
    <h4>Direction</h4>
    <div class="row">


        <div class="col-lg-4 add-record-form">
            <div class="form-group add-records-first-form">
                <label class="col-form-label" for="olName">From:</label>
                @if (!empty($direction) && (isset($direction['from_location']) && $direction['from_location'] != ''))
                <input type="text" name="olFrom" class="form-control @error('olFrom') is-invalid @enderror" id="olFrom" placeholder="Starting Point - City or Highway(s)" value="{{ $direction['from_location'] }}" />
                @else
                <input type="text" name="olFrom" class="form-control @error('olFrom') is-invalid @enderror" id="olFrom" placeholder="Starting Point - City or Highway(s)" value="{{ old('olFrom') }}" />
                @endif
                @error('olFrom')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 gps-coordinate">
    <label class="col-form-label" for="">GPS Coordinates:</label>
    <div class="row">
        
        <div class="col-lg-4 add-record-form">
            <div class="form-group add-records-first-form">
                <label class="col-form-label" for="latitude">Latitude</label>
                <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror" id="latitude" placeholder="Example: 32.037796" value="@if($direction && $direction['latitude']){{ $direction['latitude'] }}@else{{ old('latitude') }}@endif" />
                @error('latitude')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4 add-record-form">
            <div class="form-group add-records-first-form">
                <label class="col-form-label" for="olLangitude">Longitude</label>
                <input type="text" name="olLangitude" class="form-control @error('olLangitude') is-invalid @enderror" id="olLangitude" placeholder="Example: -102.000632" value="@if($direction && $direction['langitude']){{ $direction['langitude'] }}@else{{ old('olLangitude') }}@endif"  />
                @error('olLangitude')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    </div>
    
    <div class="row">
        <div class="col-lg-4 add-record-form">
            <div class="form-group add-records-first-form">
                <label class="col-form-label" for="olRigName">Drilling Rig Name</label>
                <input type="text" name="olRigName" class="form-control @error('olRigName') is-invalid @enderror" id="olRigName" placeholder="Enter Rig Name" value="@if($direction && $direction['drilling_rig_name']){{ $direction['drilling_rig_name'] }}@else{{ old('olRigName') }}@endif" />
                @error('olRigName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4 add-record-form">
            <div class="form-group add-records-first-form">
                <label class="col-form-label" for="olRigNo">Drilling Rig #</label>
                <input type="text" name="olRigNo" class="form-control @error('olRigNo') is-invalid @enderror" id="olRigNo" placeholder="Enter Rig Number" value="@if($direction && $direction['drilling_rig_no']){{ $direction['drilling_rig_no'] }}@else{{ old('olRigNo') }}@endif"  />
                @error('olRigNo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">


        <div class="col-lg-4 add-record-form">
            <div class="form-group add-records-first-form">
                <label class="col-form-label" for="olName">Old Location Name </label>
                @if (!empty($direction) && (isset($direction['old_location']) && $direction['old_location'] != ''))
                <input type="text" name="olName" class="form-control @error('olName') is-invalid @enderror" id="olName" placeholder="Typically Enter Old Well Name" value="{{ $direction['old_location'] }}" />
                @else
                <input type="text" name="olName" class="form-control @error('olName') is-invalid @enderror" id="olName" placeholder="Typically Enter Old Well Name" value="{{ old('olName') }}" />
                @endif
                @error('olName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-4 add-record-form">
            <div class="form-group add-records-first-form">
                <label class="col-form-label" for="newLocName">New Location Name </label>
                @if (!empty($direction) && (isset($direction['add_new_location']) && $direction['add_new_location'] != ''))
                <input type="text" name="addNewLocation" class="form-control @error('addNewLocation') is-invalid @enderror" id="addNewLocation" placeholder="Typically Enter New Well Name" value="{{ $direction['add_new_location'] }}" />
                @else
                <input type="text" name="addNewLocation" class="form-control @error('addNewLocation') is-invalid @enderror" id="addNewLocation" placeholder="Typically Enter New Well Name" value="{{ old('addNewLocation') }}" />
                @endif
                @error('addNewLocation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
    </div>
</div>




@foreach ($direction_routes as $index => $route)

<div class="col-lg-12 begin-direction" id="row{{ $index }}">

    <div class="row">
        <div class="col-lg-12 add-records-text-box">
            <div class="form-group">
                @if(in_array($route->label,['Directions to Old Location','Directions from Old Location to New Location','Directions to New Location']))
                @php
                $strings = preg_split ('/ /', $route->label, 3);
                $second=array_slice($strings, 2);
                $first=implode(" ", $second);
                @endphp
                @else
                @php
                $strings = preg_split ('/ /', $route->label, 4);
                $second=array_slice($strings, 3);
                $first=implode(" ", $second);
                @endphp

                @endif

                <label>{{$route->label}} </label>
                <input type="text" hidden name="dynamicLabel[]" placeholder='' value="{{$route->label}}" class="form-control" />
                <button type="button" name="remove" id="{{ $index }}" class="btn btn-danger btn_direction"><i class="fa-solid fa-trash"></i></button>
                <div class="col-lg-12">
                    <input type="text" name="labelName[]" required placeholder="@if($route->label == 'Directions to Old Location' || $route->label == 'Directions to New Location' || $route->label == 'Directions from Old Location to New Location') Please Fill in Location Name(s) above @else {{$route->label}} @endif" value="{{$route->labelName}}" class="form-control col-lg-4 @if($route->label == 'Directions to Old Location') old-direction @elseif($route->label == 'Directions to New Location') new-direction @elseif($route->label == 'Directions from Old Location to New Location') old-new-direction @endif" maxlength="100" />
                </div>
                <label></label>
                <textarea class="form-control @error('direction_new_location[]') is-invalid @enderror tinyeditor" name="direction_new_location[]" rows="3" placeholder="Enter direction" selectionStart>
                {{ $route->new_location }}
                </textarea>
            </div>

            @error('direction_new_location[]')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <!-- fields -->
    <!-- <div class="row">
        <div class="col-lg-3">
            <div class="form-group add-records-first-form">
                <label class="col-form-label" for="direction_cattle_guard">#Cattle
                    guards:</label> 
                @if(isset($route->cattle_guards))
                <select name="direction_cattle_guard[]" class="form-control col-lg-8 @error('direction_cattle_guard[]') is-invalid @enderror">
                    <option value="">Select Cattle guards</option>
                    @php
                    $i=0
                    @endphp
                    @while($i<=100) @if($i==$route->cattle_guards)
                        <option selected value="{{$i}}">{{$i}}</option>
                        @else
                        <option value="{{$i}}">{{$i}}</option>
                        @endif
                        @php
                        $i++
                        @endphp
                        @endwhile

                </select>
                @else
                <select name="direction_cattle_guard[]" class="form-control @error('direction_cattle_guard[]') is-invalid @enderror">
                    <option value="" selected>Select Cattle guards</option>
                    @php
                    $i = 0
                    @endphp
                    @for ($i=0; $i<=100; $i++) <option value="{{$i}}">{{$i}}</option>
                        @endfor
                </select>
                @endif
                @error('direction_cattle_guard[]')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group add-records-first-form">
                <label class="col-form-label" for="direction_powerline"> #Power
                    line:</label>
                    @if(isset($route->power_line))
                <select name="direction_powerline[]" class="form-control col-lg-8 @error('direction_powerline[]') is-invalid @enderror">
                    <option value="">Select Power Line</option>
                    @php
                    $i=0
                    @endphp
                    @while($i<=100) @if($i==$route->power_line)
                        <option selected value="{{$i}}">{{$i}}</option>
                        @else
                        <option value="{{$i}}">{{$i}}</option>
                        @endif
                        @php
                        $i++
                        @endphp
                        @endwhile

                </select>
                @else
                <select name="direction_powerline[]" class="form-control @error('direction_powerline[]') is-invalid @enderror">
                    <option value="" selected>Select Power Line</option>
                    @php
                    $i = 0
                    @endphp
                    @for ($i=0; $i<=100; $i++) <option value="{{$i}}">{{$i}}</option>
                        @endfor
                </select>
                @endif
                @error('direction_powerline[]')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group add-records-first-form">
                <label class="col-form-label submit-before-label" for="direction_other">#
                    Other:</label>

                @if(isset($route->other))
                <select name="direction_other[]" class="form-control col-lg-8 @error('direction_other[]') is-invalid @enderror">
                    <option value="">Select Other</option>
                    @php
                    $i=0
                    @endphp
                    @while($i<=100) @if($i==$route->other)
                        <option selected value="{{$i}}">{{$i}}</option>
                        @else
                        <option value="{{$i}}">{{$i}}</option>
                        @endif
                        @php
                        $i++
                        @endphp
                        @endwhile

                </select>
                @else
                <select name="direction_other[]" class="form-control @error('direction_other[]') is-invalid @enderror">
                    <option value="" selected>Select Other</option>
                    @php
                    $i = 0
                    @endphp
                    @for ($i=0; $i<=100; $i++) <option value="{{$i}}">{{$i}}</option>
                        @endfor
                </select>
                @endif
                @error('direction_other[]')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror



            </div>
        </div>
    </div> -->
</div>
@endforeach

<div>
    <p class="direction-text"></p>
</div>

<div class="col-lg-3 add-field-button pt-2 add-records-first-form-end form-group">
    <!-- <button type="button" class="add-employee-link direction-dropdown-option"> -->
    <div class="dropdown">
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

<!-- Modal -->
<div class="modal fade" id="preventModal" tabindex="-1" role="dialog" aria-labelledby="preventModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            
            <div class="modal-body">
                <p>Do you want to remove the content from the direction record? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary reset-direction-popup">Close</button>
                <button type="button" class="btn btn-danger popup-remove">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- print_r{{env('APP_URL').'/img/stright-left.svg'}}; --}}

<!-- Custome field block -->
@if (!empty($direction) && isset($direction['customFields']) && count($direction['customFields']) > 0)
<div class="custom-field-form">
    <div class="row">
        @php $key = 0; @endphp
        @foreach ($direction['customFields'] as $custom_field)
        @if ($custom_field['input_type'] == 1)
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
<div class="custom_field_block direction" hidden>
    <div class="row">
    </div>
</div>
<!-- Add Custome field block -->

<!-- Add Custome Field -->
<div class="user-record-form-end custom_field_form direction">
    <p class="">Create Custom Field:</p>
    <div class="row align-items-end">
        <div class="col-lg-3 add-record-form pt-2">
            <div class="form-group add-records-first-form">
                <label class="col-form-label submit-before-label" for="customInputType">Choose Field Type:</label>
                <select name="customInputType" class="form-control @error('customInputType') is-invalid @enderror customInputType" value="{{ old('customInputType') }}">
                    <option value="">Select</option>
                    @foreach ($input_array as $input)
                    @if ($input['id'] != 4 && $input['id'] != 5)
                    <option value="{{ $input['id'] }}">{{ $input['type_name'] }}</option>
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
        <div class="col-lg-3 pt-2">
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
            <button type="button" class="user-record-addfield" onclick="add_custom_field('direction')">
                <h5>Add Field</h5>
            </button>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- Add Custome Field -->


</div>

<script>
    $(document).ready(function() {
        $('.old-direction, .new-direction, .old-new-direction').prop('readonly',true);

        $(window).keydown(function (event) {
      if (event.keyCode == 13 && $(event.target).hasClass('custom-name')) {
        event.preventDefault();
        return false;
      }
    });



        var direction = 1;
        var directions = 1;


        //         $(document).ready(function(){
        //     $('.dropdown a').on('click', function(){
        //      alert('sdsd');
        //     });  
        //   })

        var oldLocationText = '';
        var newLocationText = '';

        $(document).on('keyup', '#olName', function() {
            $('.old-direction').val('');
            $('.old-new-direction').val('');
            $('.old-direction').removeClass('placeholder-error')
            $('.old-new-direction').removeClass('placeholder-error')
            $('#olName').removeClass('placeholder-error')
            oldLocationText = $(this).val();
            newLocationText = $('#addNewLocation').val();
            if(oldLocationText){
                $('.old-direction').val(oldLocationText);
            } else {
                $('.old-direction').addClass('placeholder-error')
                if($('.old-direction').length || $('.old-new-direction').length){
                    $('#olName').addClass('placeholder-error')
                }
            }
            if(oldLocationText){
                $('.old-new-direction').val(oldLocationText+' to '+newLocationText);
            } else {
                $('.old-new-direction').val('');
                $('.old-new-direction').addClass('placeholder-error')
            }
        });
        
        $(document).on('keyup', '#addNewLocation', function() {
            oldLocationText = $('#olName').val();
            newLocationText = $(this).val();
            $('.new-direction').val('');
            $('.old-new-direction').val('');
            $('.new-direction').removeClass('placeholder-error')
            $('.old-new-direction').removeClass('placeholder-error')
            $('#addNewLocation').removeClass('placeholder-error')
            if(newLocationText){
                $('.new-direction').val(newLocationText);
            } else {
                $('.new-direction').addClass('placeholder-error')
                if($('.new-direction').length || $('.old-new-direction').length){
                    $('#addNewLocation').addClass('placeholder-error')
                }
            }
            if(newLocationText){
                $('.old-new-direction').val(oldLocationText+' to '+newLocationText);
            } else {
                $('.old-new-direction').val('');
                $('.old-new-direction').addClass('placeholder-error')
            }
        });

        $(document).on('click', '.btn_direction', function() {
            var directions_id = $(this).attr("id");
            // alert('#row'+directions_id)
            //  $('#row' + directions_id).remove();
        });

        $(document).on('click', '.btn_remove_direction,.btn_direction', function() {
            var direction_button_id = $(this).attr("id");
            $('.popup-remove').attr("data-delete-id", direction_button_id);
            $('#preventModal').modal('show');
        });

        $(document).on('click', '.popup-remove', function() {
            var directionButtonId = $(this).attr("data-delete-id");
            $(this).removeAttr('data-delete-id');

            let result = directionButtonId.includes("_") ? "Yes" : null;
            if (result) {
                $('#rows' + directionButtonId).remove();
            } else {
                $('#row' + directionButtonId).remove();
            }

            $('#preventModal').modal('hide');
            if(!$('.old-direction').length && !$('.old-new-direction').length) {
                $('#olName').removeClass('placeholder-error');
            }
            if(!$('.new-direction').length && !$('.old-new-direction').length) {
                $('#addNewLocation').removeClass('placeholder-error');
            }
        });

        $(document).on('click', '.reset-direction-popup', function() {
            var nextChildElement = $(this).next();
            nextChildElement.removeAttr('data-delete-id');
            $('#preventModal').modal('hide');
        });



        $(".dropdown a").click(function() {

            // var customValue = $("input[name='custom']").val();
            var customValue = $(this).text();
            var splittedCustomValue = '';
            var value = '';
            var newClass ='';
            var placeholder = 'Please Fill in Location Name(s) above';
            var placeholderClass = '';
            var readonly = 'readonly';

            if (customValue == 'Directions from Old Location to New Location') {
                newClass = "old-new-direction"
                splittedCustomValue = customValue.split('Directions from ')[1];
                
                oldval = $("input[name='olName']").val();
                newval = $("input[name='addNewLocation']").val();
                value = oldval +' to '+ newval;
                if (oldval=='' || newval=='') {
                    value = '';
                    if(oldval=='') {
                        $("input[name='olName']").addClass('placeholder-error');
                    }
                    if(newval=='') {
                        $("input[name='addNewLocation']").addClass('placeholder-error');
                    }
                }
                if(value == '') {
                    placeholderClass = 'placeholder-error'
                }
            } else {
                splittedCustomValue = customValue.split('Directions to ')[1];
                if(splittedCustomValue == "Old Location") {
                    newClass = 'old-direction';
                    value = $("input[name='olName']").val();
                    if(value ==''){
                        $("input[name='olName']").addClass('placeholder-error');
                    }
                } else if(splittedCustomValue == "New Location") {
                    newClass = 'new-direction';
                    value = $("input[name='addNewLocation']").val();
                    if(value ==''){
                        $("input[name='addNewLocation']").addClass('placeholder-error');
                    }
                }
                if(value == '') {
                    placeholderClass = 'placeholder-error'
                }
            }

            if (!customValue) {
                value = '';
                customValue = 'Directions to Others ' + $("input[name='custom']").val();
                splittedCustomValue = customValue.split('Directions to Others ')[1];
                newClass = ''
                placeholder = 'Direction to '+ splittedCustomValue;
                placeholderClass = ''
                readonly = ''
            }



            //  $(".direction-text").append('<div id="rows' + direction + '_direction_text" class="col-lg-12 begin-direction"><div class="row"><input type="text" hidden name="dynamicLabel[]" value="' + customValue + '" required /><div class="row main"><label class="col-form-label" for="dateTime">' + customValue + ' * ' + '</label><button type="button" name="remove" id="' + direction + '_direction_text" class="btn btn-danger btn_remove_direction" data-toggle="modal" data-target="#preventModal"><i class="fa-solid fa-trash"></i></button><div class="col-lg-12"><input type="text" name="labelName[]" placeholder="Enter the ' + splittedCustomValue + '" class="form-control col-lg-4" maxlength="100" required /></div></div><div class="col-lg-12 add-records-text-box"><div class="form-group"><textarea  class="form-control tinyeditor" name="direction_new_location[]" rows="3" placeholder="Enter direction"></textarea></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group add-records-first-form"><label class="col-form-label submit-before-label" for="direction_cattle_guard">#Cattle guards:</label><select  id="'+ direction +'_cattle-guard-drop-down" name="direction_cattle_guard[]" placeholder="Cattle guards"  class="form-control"><option value="" >Select Cattle guard</option></select></div></div><div class="col-lg-3"><div class="form-group add-records-first-form"><label class="col-form-label" for="direction_powerline">#Power line:</label><select  id="'+ direction + '_direction-power-line" name="direction_powerline[]" placeholder="Power line:" class="form-control" ><option value="" >Select Power Line</option></select></div></div><div class="col-lg-3"><div class="form-group add-records-first-form"><label class="col-form-label submit-before-label" for="direction_other">#Other:</label><select  id="'+ direction + '_other-drop-down" name="direction_other[]" placeholder="Other:"  class="form-control"> <option value="" >Select Other</option></select></div></div><div class="col-lg-3"><div class="form-group add-records-first-form"></div></div></div></div>');

            $(".direction-text").append('<div id="rows' + direction + '_direction_text" class="col-lg-12 begin-direction"><div class="row"><input type="text" hidden name="dynamicLabel[]" value="' + customValue + '" required /><div class="row main"><label class="col-form-label" for="dateTime">' + customValue + ' ' + '</label><button type="button" name="remove" id="' + direction + '_direction_text" class="btn btn-danger btn_remove_direction" data-toggle="modal" data-target="#preventModal"><i class="fa-solid fa-trash"></i></button><div class="col-lg-12"><input type="input" name="labelName[]" placeholder="' + placeholder + '" class="form-control col-lg-4 '+ newClass +' '+ placeholderClass +'" '+ readonly +' maxlength="100" value="'+value+'"  /></div></div><div class="col-lg-12 add-records-text-box"><div class="form-group"><textarea  class="form-control tinyeditor" name="direction_new_location[]" rows="3" placeholder="Enter direction"></textarea></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group add-records-first-form"></div></div></div></div>');


                // const subDetails= ['_cattle-guard-drop-down','_direction-power-line','_other-drop-down'];
                // $.each(subDetails , function(id, val) { 
                //     var data = direction+val;
                //     dropdownOption(data);
                // });

            jQuery(".tinyeditor").each(function() {

                tinymce.init({
                    height: 150,
                    menubar: false,
                    relative_urls: false,
                    remove_script_host: false,
                    convert_urls: false,
                    force_br_newlines: true,
                    forced_root_block: false,
                    force_p_newlines: false,
                    contextmenu: false,
                    selector: '.tinyeditor',
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount',
                        'autoresize'
                    ],
                    autoresize_bottom_margin: 30,
                    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help|customInsertButton|customRightButton|customButton|customMergeButton|customkeepleftButton|customkeeprightButton|custommilesButton|custompowerlineButton|customfeetButton|customcattleguardButton|custominputBox|menuDateButton|direction',


                    setup: (editor) => {

                        editor.ui.registry.addButton('customInsertButton', {
                            text: "<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/left-arrow.png'>",
                            onAction: (_) => editor.insertContent(
                                `<img  style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/left-arrow.png'> TL`
                            )
                        });
                        editor.ui.registry.addButton('customRightButton', {
                            text: "<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/right-arrow.png'>",
                            onAction: (_) => editor.insertContent(
                                `<img  style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/right-arrow.png'> TR`
                            )
                        });
                        editor.ui.registry.addButton('customButton', {
                            text: "<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/up-arrow.png'>",
                            onAction: (_) => editor.insertContent(
                                `<img  style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/up-arrow.png'> Go Straight`
                            )
                        });
                        editor.ui.registry.addButton('customMergeButton', {
                            text: "<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/arrow.png'>",
                            onAction: (_) => editor.insertContent(
                                `<img  style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/arrow.png'>  Merge`
                            )
                        });
                        editor.ui.registry.addButton('customkeepleftButton', {
                            text: "<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/image_2022_08_05T07_40_44_868Z.png'>",
                            onAction: (_) => editor.insertContent(
                                `<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/image_2022_08_05T07_40_44_868Z.png'> SR`
                            )
                        });
                        editor.ui.registry.addButton('customkeeprightButton', {
                            text: "<img style='height:20px;width:20px;'src='{{ env('APP_URL') }}/img/image_2022_08_05T07_25_00_150Z.png'>",
                            onAction: (_) => editor.insertContent(
                                `<img style='height:20px;width:20px;'src='{{ env('APP_URL') }}/img/image_2022_08_05T07_25_00_150Z.png'> SL`
                            )
                        });

                        editor.ui.registry.addMenuButton('menuDateButton', {
                text: 'Select Units',
                fetch: function(callback) {
                    var items = [{
                            type: 'menuitem',
                            text: 'Miles',
                            onAction: function(_) {
                                var text = "Miles";
                                $('#unit-footer').html('<a href="javascript:void(0);" id="unit-submit-btn" class="btn btn-primary">Submit</a>');
                                
                                $('#getUnitModal .modal-header h4').html(text);
                                $('#unitValue').val('');
                                $('#unitValue').attr('placeholder', 'Enter the '+text);
                                $('#unitToggleBtn').click();
                                $("#getUnitModal").on('shown.bs.modal', function(){
                                    $(this).find('input[type="text"]').focus();
                                });
                                $('#unit-submit-btn').on('click', function(){
                                    $('#unit-footer').empty();
                                    editor.insertContent(   
                                        $('#unitValue').val()+' Miles _________________________________________________________<br><br><br>'
                                    );
                                    $('#unitToggleBtn').click();
                                });
                            }
                        },
                        {
                            type: 'menuitem',
                            text: 'Yards',
                            onAction: function(_) {
                                var text = "Yards";
                                $('#unit-footer').html('<a href="javascript:void(0);" id="unit-submit-btn" class="btn btn-primary">Submit</a>');
                                
                                $('#getUnitModal .modal-header h4').html(text);
                                $('#unitValue').val('');
                                $('#unitValue').attr('placeholder', 'Enter the '+text);
                                $('#unitToggleBtn').click();
                                $("#getUnitModal").on('shown.bs.modal', function(){
                                    $(this).find('input[type="text"]').focus();
                                });
                                $('#unit-submit-btn').on('click', function(){
                                    $('#unit-footer').empty();
                                    editor.insertContent(   
                                        $('#unitValue').val()+' Yards _________________________________________________________<br><br><br>'
                                    );
                                    $('#unitToggleBtn').click();
                                });
                            }
                        },
                        {
                            type: 'menuitem',
                            text: 'Feet',
                            
                            onAction: function(_) {
                                var text = "Feet";
                                $('#unit-footer').html('<a href="javascript:void(0);" id="unit-submit-btn" class="btn btn-primary">Submit</a>');
                                
                                $('#getUnitModal .modal-header h4').html(text);
                                $('#unitValue').val('');
                                $('#unitValue').attr('placeholder', 'Enter the '+text);
                                $('#unitToggleBtn').click();
                                $("#getUnitModal").on('shown.bs.modal', function(){
                                    $(this).find('input[type="text"]').focus();
                                });
                                $('#unit-submit-btn').on('click', function(){
                                    $('#unit-footer').empty();
                                    editor.insertContent(   
                                        $('#unitValue').val()+' Feet _________________________________________________________<br><br><br>'
                                    );
                                    $('#unitToggleBtn').click();
                                });
                            }
                        }
                    ];
                    callback(items);
                }
            });

                        editor.ui.registry.addMenuButton('direction', {
                            fetch: function(callback) {
                                var items = [{
                                        type: 'menuitem',
                                        text: 'North',
                                        onAction: function(_) {
                                            editor.insertContent(
                                                ' North '
                                            );
                                        }
                                    },
                                    {
                                        type: 'menuitem',
                                        text: 'South',
                                        onAction: function(_) {
                                            editor.insertContent(
                                                ' South '
                                            );
                                        }
                                    },
                                    {
                                        type: 'menuitem',
                                        text: 'East',
                                        onAction: function(_) {
                                            editor.insertContent(
                                                ' East '
                                            );
                                        }
                                    },
                                    {
                                        type: 'menuitem',
                                        text: 'west',
                                        onAction: function(_) {
                                            editor.insertContent(
                                                ' West '
                                            );
                                        }
                                    },
                                ];
                                callback(items);
                            }
                        });

                    }

                });

            });
            direction++;
            $("input[name='custom']").val('');
        });


        function dropdownOption(fieldId) 
               {
                var min = 0,
                max = 100,
                select = document.getElementById(fieldId);

                for (var i = min; i<=max; i++){
                    var opt = document.createElement('option');
                    opt.value = i;
                    opt.innerHTML = i;
                    select.append(opt);
                }
              }
    });



</script>
