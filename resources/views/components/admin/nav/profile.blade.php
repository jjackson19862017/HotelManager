<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{route('user.profile.show',Auth::user()->id)}}">Profile</a>
        @if(auth()->user()->userHasRole('super')||auth()->user()->userHasRole('admin')||auth()->user()->userHasRole('owner'))
        <a class="dropdown-item" href="{{route('audit.index')}}">Activity Log</a>
        @endif
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Logout</a>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>
