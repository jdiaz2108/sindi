<div>
    <keep-alive>
    <l-leftpanel :user="{{$user}}"></l-leftpanel>
</keep-alive>
{{--      <nav class="leftpanelnavbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ request()->is('/') ? 'active' : '' }}">
                        <a href="/"><i class="menu-icon fa fa-laptop"></i>Inicio </a>
                    </li>
@if(Auth::user()->level >= 355)
                    <li class="menu-title">Gestión Usuarios</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown {{ request()->is('U/*') ? 'active' : '' }} {{ request()->is('U') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-address-book"></i>Usuarios</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-address-book"></i><a href="/U">Listar Usuarios</a></li>
                            <li><i class="fa fa-address-book"></i><a href="/U/create">Nuevo Usuario</a></li>
                        </ul>
                    </li>
@endif

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-handshake-o"></i>Paz y Salvo</a>
                        <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-handshake-o"></i><a href="/pysEstado">Estado Paz y Salvo</a></li>
                            @if(Auth::user()->level >= 355)
                                <li><i class="fa fa-handshake-o"></i><a href="/pys">Procesos Activos</a></li>
                            @endif
                            @if(Auth::user()->level == 992)
                            
                            <li><i class="fa fa-handshake-o"></i><a href="/pys/{{Auth::user()->slug}}">Buttons</a></li>
                            <li><i class="fa fa-handshake-o"></i><a href="ui-badges.html">Badges</a></li>
                            @endif
                        </ul>
                    </li>
@if(Auth::user()->level == 992)

                    <li class="menu-title">Icons</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Icons</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="font-fontawesome.html">Font Awesome</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Themefy Icons</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="widgets.html"> <i class="menu-icon ti-email"></i>Widgets </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Charts</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="charts-chartjs.html">Chart JS</a></li>
                            <li><i class="menu-icon fa fa-area-chart"></i><a href="charts-flot.html">Flot Chart</a></li>
                            <li><i class="menu-icon fa fa-pie-chart"></i><a href="charts-peity.html">Peity Chart</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Maps</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-map-o"></i><a href="maps-gmap.html">Google Maps</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i><a href="maps-vector.html">Vector Maps</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">Extras</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Pages</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="page-login.html">Login</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="page-register.html">Register</a></li>
                            <li><i class="menu-icon fa fa-paper-plane"></i><a href="pages-forget.html">Forget Pass</a></li>
                        </ul>
                    </li>
@endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>  --}}
</div>

