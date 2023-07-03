<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto navbar-right">
        <!-- Messages Dropdown Menu -->
     
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown nav-list">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ asset('img/user.png') }}" />
            </a>
        </li>
        <li class="nav-item">
            <a href="#">
                <h2>{{ Auth::user()->name }}</h2>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ asset('img/vector.png') }}" />
            </a>
            <div class="dropdown-menu log_out dropdown-menu-lg dropdown-menu-right">
            <a class="dropdown-item" href="{{url('/editProfile')}}/{{Auth::user()->id}}" >
                    {{ __('Edit Profile') }}
                </a>

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
                                
        </li>
    </ul>
</nav>
<!-- /.navbar -->
