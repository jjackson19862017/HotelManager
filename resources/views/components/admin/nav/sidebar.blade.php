<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{route('admin.index')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    @if(auth()->user()->userHasRole('owner')||auth()->user()->userHasRole('admin')||auth()->user()->userHasRole('super'))
                    <div class="sb-sidenav-menu-heading">Personnel</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStaff"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Staff Members
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseStaff" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('staff.index')}}">View All Staff Members</a>
                            <a class="nav-link" href="{{route('holiday.index')}}">View Holidays</a>
                        </nav>
                    </div>
                    @endif
                    <div class="sb-sidenav-menu-heading">Hotel</div>
                    @foreach($hotels as $hotel)
                        @if(auth()->user()->userHasRole($hotel->slug)||auth()->user()->userHasRole('owner')||auth()->user()->userHasRole('admin')||auth()->user()->userHasRole('super'))
                            <a class="nav-link collapsed" href="#" data-toggle="collapse"
                               data-target="#collapse{{$hotel->slug}}"
                               aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-hotel"></i></div>
                                {{$hotel->name}}
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapse{{$hotel->slug}}" aria-labelledby="headingOne"
                                 data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    @if(auth()->user()->userHasRole($hotel->slug. ".manager")||auth()->user()->userHasRole('owner')||auth()->user()->userHasRole('admin')||auth()->user()->userHasRole('super'))
                                    <a class="nav-link" href="{{route('hotel.staff.index',$hotel->id)}}"><i
                                            class="fas fa-user-tie mr-2"></i> Staff Members</a>
                                    @endif
                                    <a class="nav-link" href="{{route('endofday.create')}}"><i
                                            class="fas fa-cash-register mr-2"></i> End Of Day</a>

                                        <hr class="border border-white w-50 my-1">
                                        <div class="sb-sidenav-menu-heading">Rota</div>
                                        <a class="nav-link" href="{{route('rota.index',['hotel'=>$hotel->id,'rota' => $rota0,'rk'=>0])}}"><i class="fas fa-user-clock mr-2"></i>This Week</a>
                                        <a class="nav-link" href="{{route('rota.index',['hotel'=>$hotel->id,'rota' => $rota1,'rk'=>1])}}"><i class="fas fa-user-clock mr-2"></i>{{date('jS F',strtotime($rota1))}}</a>
                                        <a class="nav-link" href="{{route('rota.index',['hotel'=>$hotel->id,'rota' => $rota2,'rk'=>2])}}"><i class="fas fa-user-clock mr-2"></i>{{date('jS F',strtotime($rota2))}}</a>
                                        <a class="nav-link" href="{{route('rota.index',['hotel'=>$hotel->id,'rota' => $rota3,'rk'=>3])}}"><i class="fas fa-user-clock mr-2"></i>{{date('jS F',strtotime($rota3))}}</a>
                                        <a class="nav-link" href="{{route('rota.index',['hotel'=>$hotel->id,'rota' => $rota4,'rk'=>4])}}"><i class="fas fa-user-clock mr-2"></i>{{date('jS F',strtotime($rota4))}}</a>

                                        @if(auth()->user()->userHasRole('owner')||auth()->user()->userHasRole('admin')||auth()->user()->userHasRole('super'))
                                            <hr class="border border-white w-50 my-1">
                                            <a class="nav-link" href="{{route('hotel.occupancy',$hotel->id)}}"><i class="fas fa-hotel mr-2"></i> Occupancy
                                                Report</a>
                                            <a class="nav-link" href="{{route('hotel.dailysales.index',$hotel->id)}}"><i class="fas fa-calendar-day mr-2"></i> Daily
                                                Sales</a>
                                            <a class="nav-link" href="{{route('hotel.prevsales.index',$hotel->id)}}"><i class="fas fa-calendar-alt mr-2"></i> Monthly
                                                Sales</a>
                                            <a class="nav-link" href="{{route('hotel.prevsales.weekly',$hotel->id)}}"><i class="fas fa-calendar-week mr-2"></i> Weekly
                                                Sales</a>
                                        @endif
                                </nav>
                            </div>
                        @else
                        @endif
                    @endforeach
                    <div class="sb-sidenav-menu-heading">Events</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvents"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Events
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseEvents" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('customers.index')}}">Customers</a>
                        </nav>
                    </div>


                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Layouts
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="layout-static.html">Static Navigation</a>
                            <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                       aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Pages
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse"
                               data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                Authentication
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                 data-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="login.html">Login</a>
                                    <a class="nav-link" href="register.html">Register</a>
                                    <a class="nav-link" href="password.html">Forgot Password</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse"
                               data-target="#pagesCollapseError" aria-expanded="false"
                               aria-controls="pagesCollapseError">
                                Error
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                 data-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="401.html">401 Page</a>
                                    <a class="nav-link" href="404.html">404 Page</a>
                                    <a class="nav-link" href="500.html">500 Page</a>
                                </nav>
                            </div>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Charts
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{auth()->user()->username}}
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">

