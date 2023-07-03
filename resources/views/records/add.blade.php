@extends('layouts.dashboard')

@section('content')

    <div class="content-wrapper add-route-direction">
        @if (session()->get('success'))
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


        <!-- Content Header (Page header) -->
        <div class="content-header pd-left-side">
            <div class="container-fluid p-0">
                <div class="d-flex bg-white header-row-1">

                    <span><img src="{{ asset('img/plus-square.svg') }}" alt=""></span>
                    @if(isset($record) && isset($record['record_type']))
                     @if($record['record_type']==1)
                     {{'Add Direction'}}
                      @elseif($record['record_type']==2)
                      {{'Add Route Assessment'}}
                      @else
                      {{'Add Route Assessment and Add Direction'}}
                    @endif
                    @endif
                    <ul class="ml-auto">
                        <li>Home /</li>
                        <li>Route</li>
                    </ul>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <!-- Main content -->
        <section class="content pd-left-side">
            <form name="add-record" id="some-form" action="{{ route('saveFormRecords') }}" method="POST" autocomplete="off"
                enctype="multipart/form-data">
                <div class="container-fluid p-0">
                    <div class="user-add-record">

                        @csrf

                        <div class="secblk">
                            <h4>Routes</h4>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="rigName">Rig Name:</label>
                                        @if (!empty($record) && (isset($record['rig_name']) && $record['rig_name'] != ''))
                                            <input type="text" name="rigName"
                                                class="form-control @error('rigName') is-invalid @enderror" id="rigName"
                                                placeholder="Rig name" value="{{ $record['rig_name'] }}" />
                                        @else
                                            <input type="text" name="rigName"
                                                class="form-control @error('rigName') is-invalid @enderror" id="rigName"
                                                placeholder="Rig name" value="{{ old('customerName') }}" />
                                        @endif @error('rigName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="col-form-label" for="rigNo">Rig Number:</label>
                                    @if (!empty($record) && (isset($record['rig_no']) && $record['rig_no'] != ''))
                                        <input type="number" name="rigNo"
                                            class="form-control @error('rigNo') is-invalid @enderror" id="rigNo"
                                            placeholder="Enter rignumber" value="{{ $record['rig_no'] }}" />
                                    @else
                                        <input type="number" name="rigNo"
                                            class="form-control @error('rigNo') is-invalid @enderror" id="rigNo"
                                            placeholder="Enter rignumber" value="{{ old('rigNo') }}" />
                                    @endif @error('rigNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="col-form-label" for="jobNo">Job Number</label>
                                @if (!empty($record) && (isset($record['job_no']) && $record['job_no'] != ''))
                                    <input type="number" name="jobNo"
                                        class="form-control @error('jobNo') is-invalid @enderror" id="jobNo"
                                        placeholder="Enter job no" value="{{ $record['job_no'] }}" />
                                @else
                                    <input type="number" name="jobNo"
                                        class="form-control @error('jobNo') is-invalid @enderror" id="jobNo"
                                        placeholder="Enter job no" value="{{ old('jobNo') }}" />
                                @endif @error('jobNo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                            <div class="form-group">
                                <label class="col-form-label" for="recordUser">User</label>
                                @if (!empty($record) && (isset($record->userDetails->name) && $record->userDetails->name != ''))
                                    <input type="text" disabled name="recordUser"
                                        class="form-control @error('recordUser') is-invalid @enderror" id="recordUser"
                                        placeholder="" value="{{ $record->userDetails->name }}" />
                                @else
                                    <input type="text"  disabled name="recordUser"
                                        class="form-control @error('recordUser') is-invalid @enderror" id="recordUser"
                                        placeholder="" value="{{ old('recordUser') }}" />
                                @endif @error('recordUser')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            @if (isset($record['record_type']))
                @if ($record['record_type'] == 1 || $record['record_type'] == 3)
                    @include('records.direction', [$direction])
                @endif
                @if ($record['record_type'] == 2 || $record['record_type'] == 3)
                    @include('records.route_assessment', [$route_assessment,$getRigType,$getMoveType,$temperature,$selectedTemperatureOptionValues,$hazardList,$measurementList])
                @endif
            @endif
            <div class="add-records-submit">
                @if (isset($record['id']) && $record['id'] != '')
                    <input type="hidden" name="rec_id" class="rec_id" id="rec_id"
                        value="{{ $record['id'] }}" />
                    <input type="hidden" name="rec_type" class="rec_type" id="rec_type"
                        value="{{ $record['record_type'] }}" />
                @endif
                <input type="hidden" name="custom_field_count_route" class="custom_field_count"
                    id="custom_field_count_route" value="0" />
                <input type="hidden" name="custom_field_count_direction" class="custom_field_count"
                    id="custom_field_count_direction" value="0" />
                <button type="submit" class="add-record-submit-button">
                    <h5>Submit Form</h5>
                </button>
            </div>

        </div><!-- /.container-fluid -->
</form>
</section>

</div>
<!-- /.content -->
</div>
<button data-toggle="modal" data-target="#getUnitModal" id="unitToggleBtn" class="btn btn-new-game" hidden></button>
<div class="modal fade unit-modal-popup" id="getUnitModal">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Unit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="unitValue" name="unitValue" required class="form-control" placeholder="Unit name" autocomplete="off" autofocus />
                    @error('unitValue')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="justify-content-center d-flex" id="unit-footer">
                    <button type="submit" id="unit-submit-btn" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
        var form = $('#some-form'),
            original = form.serialize()

        form.submit(function() {
            window.onbeforeunload = null
            var success = true;
            if($('.placeholder-error').length) {
                $('.placeholder-error:first').focus();
                success = false;
            }

            if (!success) {
                return false;
            }
        })

        window.onbeforeunload = function() {
            if (form.serialize() != original)
                return 'Are you sure you want to leave?'
        }
    })
    $('textarea.tinyeditor').tinymce({
        height: 150,
        relative_urls: false,
        remove_script_host: false,
        convert_urls: false,
        force_br_newlines: false,
        force_span_newlines: false,
        forced_root_block: false,
        contextmenu: false,

        selector: 'textarea#custom-toolbar-button',
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount',
            'autoresize'
        ],
        autoresize_bottom_margin: 30,
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help|customInsertButton|customRightButton|customButton|customMergeButton|customkeepleftButton|customkeeprightButton|menuDateButton|direction',

        setup: (editor) => {

            editor.ui.registry.addButton('customInsertButton', {
                text: "<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/left-arrow.png'>",
                onAction: (_) => editor.insertContent(
                    `<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/left-arrow.png'> TL`
                )
            });
            editor.ui.registry.addButton('customRightButton', {
                text: "<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/right-arrow.png'>",
                onAction: (_) => editor.insertContent(
                    `<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/right-arrow.png'> TR`
                )
            });
            editor.ui.registry.addButton('customButton', {
                text: "<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/up-arrow.png'>",
                onAction: (_) => editor.insertContent(
                    `<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/up-arrow.png'> Go Straight`
                )
            });
            editor.ui.registry.addButton('customMergeButton', {
                text: "<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/arrow.png'>",
                onAction: (_) => editor.insertContent(
                    `<img style='height:20px;width:20px;' src='{{ env('APP_URL') }}/img/arrow.png'> Merge`
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

            // directions
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


    function add_custom_field(sec) {
        $(".custom_field_block."+sec).prop("hidden", false);
        var input_type = $('.custom_field_form.' + sec + ' .customInputType').val();
        var input_label = $('.custom_field_form.' + sec + ' .customLabelName').val();
        var input_for = sec;
        var html = '';
        if (input_type != '' && input_label != '') {
            html = add_field_html(parseInt(input_type), input_label, input_for);
            $('.custom_field_block.' + sec + ' .row').append(html);
        } else {
            alert('Invalid format');
        }
    }

    function add_field_html(input_type, input_label, input_for) {
        var html = '';
        var inner_html = '';
        var custom_field_count = parseInt($('#custom_field_count_' + input_for).val());


        switch (input_type) {
            case 1:
                inner_html = '<input type="text" name="customField[' + input_for + '][' + custom_field_count +
                    '][value]" class="form-control" value="">';
                break;
            case 2:
                inner_html = '<input type="number" name="customField[' + input_for + '][' + custom_field_count +
                    '][value]" class="form-control" value="">';
                break;
            case 3:
                inner_html = '<textarea name="customField[' + input_for + '][' + custom_field_count +
                    '][value]" class="form-control" ></textarea>';
                break;
            case 4:
                //alert('select');
                break;
            case 5:
                //alert('multiselect');
                break;
            default:
                alert('default');
        }

        html =
            '<div class="col-lg-3 customField_col"><div class="form-group"><label class="col-form-label submit-before-label" for="customField">' +
            input_label + '</label> <a href="javascript:;" onclick="del_custom_field(this)" data-for="' + input_for +
            '">Delete</a>' + inner_html + ' <input type="hidden" name="customField[' + input_for + '][' +
            custom_field_count + '][type]" value="' + input_type + '"><input type="hidden" name="customField[' +
            input_for + '][' + custom_field_count + '][label]" value="' + input_label + '"></div></div>';
        var new_custom_field_count = ++custom_field_count;
        $('#custom_field_count_' + input_for).val(new_custom_field_count);
        return html;
    }

    function del_custom_field(obj) {
        var delete_for = $(obj).data('for');
        var custom_field_count = parseInt($('#custom_field_count_' + delete_for).val());
        var new_custom_field_count = --custom_field_count;
        $('#custom_field_count_' + delete_for).val(new_custom_field_count);
        $(obj).parent().parent().remove();
    }


</script>

@endsection
