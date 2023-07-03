<div class="col-lg-3 customField-col">
    <div class="form-group">
        <label class="col-form-label" for="totalMiles">{{$custom_field['label']}}:</label>
        <a href="javascript:;" onclick="del_custom_field(this)" data-for="">Delete</a>
        <input type="number" name="customFieldEdit[{{$key}}][value]" class="form-control " id="custom_e_field_{{$custom_field['id']}}" placeholder="Total miles" value="{{$custom_field['value']}}">
        <input type="hidden" name="customFieldEdit[{{$key}}][id]" value="{{$custom_field['id']}}">
    </div>
</div>