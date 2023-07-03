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

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Content Header (Page header) -->
    <div class="content-header pd-left-side">
        <div class="container-fluid p-0">
            <div class="d-flex bg-white header-row-1">

                <span><img src="{{ asset('img/settings.png') }}" alt=""></span>
                Settings

                <ul class="ml-auto">
                    <li>Home /</li>
                    <li> Settings</li>
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
                        <h2>Change Password</h2>
                    </div>
                    <form class="record-form ml-auto">

                    </form>

                    <button type="button" class="add-employee-link" onclick="openForm()" data-toggle="modal" data-target="#addRecordModal">
                        <img src="{{ asset('img/plus-circle.svg') }}" width="20">
                        <h5>Change Password</h5>
                    </button>
                </div>
                <div class="form-popup employee-modal-popup" id="myForm">
                    <form action="{{ route('changePassword') }}" class="form-container" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="Password"><b>Password *</b></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" name="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword"><b>Confirm Password *</b></label>
                            <input type="password" class="form-control @error('confirmpassword') is-invalid @enderror" placeholder="Confirm Password" name="confirmpassword">
                            @error('confirmpassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn resetpass-btn mr-2">Reset Password</button>
                            <button type="button" class="btn close-btn ml-2" onclick="closeForm()">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>

    @endsection