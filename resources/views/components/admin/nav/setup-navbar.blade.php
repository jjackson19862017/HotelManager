<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" id="setupDropdown" href="#" role="button" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog fa-fw mr-1"></i></a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="setupDropdown">
        @if(auth()->user()->userHasRole('super')||auth()->user()->userHasRole('admin')||auth()->user()->userHasRole('owner'))
            <a class="dropdown-item" href="{{route('user.index')}}"><i class="fas fa-user mr-1"></i> Users</a>
        @endif
        @if(auth()->user()->userHasRole('super')||auth()->user()->userHasRole('admin'))
            @if(!$deletedUsers == 0)<a class="dropdown-item" href="{{route('trashed.user.index')}}"><i
                    class="fas fa-trash mr-1"></i> Deleted Users</a>@endif
        @endif
        <div class="dropdown-divider"></div>
        @if(auth()->user()->userHasRole('super')||auth()->user()->userHasRole('admin')||auth()->user()->userHasRole('owner'))

            <a class="dropdown-item" href="{{route('hotel.index')}}"><i class="fas fa-hotel mr-1"></i> Hotel</a>
        @endif
        @if(auth()->user()->userHasRole('super')||auth()->user()->userHasRole('admin'))
            @if(!$deletedHotels == 0)<a class="dropdown-item" href="{{route('trashed.hotel.index')}}"><i
                    class="fas fa-trash mr-1"></i> Deleted Hotels</a>@endif
        @endif

        @if(auth()->user()->userHasRole('super')||auth()->user()->userHasRole('admin'))
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('role.index')}}"><i class="fas fa-user-tag mr-1"></i> Role</a>
            <a class="dropdown-item" href="{{route('permission.index')}}"><i class="fas fa-tasks mr-1"></i> Permission</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('position.index')}}"><i class="fas fa-chess-board mr-1"></i> Staff Positions</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('placement.index')}}"><i class="fas fa-map-pin mr-1"></i> Rota Placements</a>

        @endif
            @if(auth()->user()->userHasRole('super')||auth()->user()->userHasRole('admin')||auth()->user()->userHasRole('owner'))
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{route('staff.wages')}}"><i class="fas fa-user-friends mr-1"></i> All Staff</a>
                <a class="dropdown-item" href="{{route('eventlocation.index')}}"><i class="fas fa-user-friends mr-1"></i> Event Locations</a>
            @endif
    </div>
</li>
