<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Navigation</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ url('orders') }}"><i class='fa fa-shopping-cart'></i> <span>Orders</span></a></li>
            @role(['super-admin', 'admin'])
              <li><a href="{{ url('/admin')}}"><i class='fa fa-gear'></i> <span>Administrator</span></a></li>
            @endrole
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
