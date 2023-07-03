@extends('layouts.dashboard')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <!-- <a href="#" class="d-flex pt-3 pl-4 header-row-1"> -->
                    <div class="d-flex pt-3 pl-4 header-row-1">
                    <span><img src="{{ asset('img/grid1.png') }}" alt="" /></span>
                <span>Dashboard</span>
                    </div>
                <!-- </a> -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        @if(auth()->user()->user_role == 2)
            @include('dashboard.userdashboard')
        @else
            @include('dashboard.admindashboard')
        @endif
        
    </div>
@endsection