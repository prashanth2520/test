@extends('layouts.app')
@section('content')
<div>
    <table class="table table-bordered table-striped cdrtable" id="count_datatable">
        <thead>
            <tr>  
                <th>S.No</th>
                <th>Prefix</th>
                <th>Controller</th>
                <th>Method</th>
                <th>Admin</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($all_routes as $route)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$route['prefix']}}</td>
                    <td>{{$route['controller']}}</td>
                    <td>{{$route['method']}}</td>
                    @php
                        $admin_check = $route['has_admin_access'] > 0 ? 'checked' : '';
                        $user_check = $route['has_user_access'] > 0 ? 'checked' : '';
                    @endphp
                    <td><input type="checkbox" class="permission" name="amdin_permission[]" data-permission_id="{{$route['permission_id']}}" data-prefix="{{$route['prefix']}}" data-controller="{{$route['controller']}}" data-method="{{$route['method']}}" data-user_role="1" class="amdin_permission" {{ $admin_check }}></td>
                    <td><input type="checkbox" class="permission" name="user_permission[]" data-permission_id="{{$route['permission_id']}}" data-prefix="{{$route['prefix']}}" data-controller="{{ $route['controller'] }}" data-method="{{$route['method']}}" data-user_role="2" class="user_permission" {{ $user_check }}></td>
                </tr>
                @php $i++; @endphp
            @endforeach
        </tbody>
    </table>
</div>
<script>

    

    $('body').on('click', '.permission', function (){
        var obj = $(this);
        var permission_id = $(obj).data('permission_id');
        var user_role = $(obj).data('user_role');
        if( user_role > 0 ){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            
            jQuery.ajax({
                url: "{{ url('/permission/save_permission') }}",
                method: 'POST',
                data: {
                    permission_id: permission_id, user_role: user_role,
                },
                success: function(result){
                    console.log(result);
                }
            });
        }
    });
    
</script>
@endsection
