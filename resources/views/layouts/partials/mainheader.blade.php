<!-- Main Header -->
<header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <div class="navbar-header">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="navbar-brand">
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Fouries</b>Orders </span>
        </a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
        </button>
      </div>
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="{{ url('orders') }}"><i class='fa fa-shopping-cart'></i> <span>Orders</span></a></li>
            @role(['super-admin'])
              <li><a href="{{ url('/admin')}}"><i class='fa fa-gear'></i> <span>Administrator</span></a></li>
            @endrole
        </ul>
      </div>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                {{-- <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div> --}}
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Control Sidebar Toggle Button -->
                <li>
                </li>
            </ul>
        </div>
    </nav>
</header>
