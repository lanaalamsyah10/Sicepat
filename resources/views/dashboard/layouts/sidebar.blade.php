<div class="sidebar-inner slimscrollleft">

    <div id="sidebar-menu">
        <ul>
            <li class="menu-title">Main</li>
            <li>
                <a href="{{ url('dashboard') }}" class="waves-effect {{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="mdi mdi-airplay"></i>
                    <span> Dashboard <span class="badge badge-pill badge-primary float-right"></span></span>
                </a>
            </li>
            @if (Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('dashboard.kelola-pengurus.index') }}" class="waves-effect"><i
                            class="mdi mdi-account-multiple"></i><span>
                            Kelola Driver </span></a>
                </li>
            @endif
            <li>
                <a href="{{ route('dashboard.onhold.index') }}" class="waves-effect"><i
                        class="mdi mdi-timetable"></i><span>
                        On hold </span></a>
            </li>
            <li>
                <a href="{{ route('dashboard.cancel.index') }}" class="waves-effect"><i
                        class="mdi mdi-close-octagon"></i><span>
                        Cancel</span></a>
            </li>
            <li>
                <a href="{{ route('dashboard.saran.index') }}" class="waves-effect"><i class="mdi mdi-email"></i><span>
                        Komentar </span></a>
            <li class="menu-title mt-3">Menu</li>
            <li>
                <a href="{{ route('logout') }}" class="waves-effect"><i class="mdi mdi-logout"></i><span>
                        Keluar </span></a>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div> <!-- end sidebarinner -->
