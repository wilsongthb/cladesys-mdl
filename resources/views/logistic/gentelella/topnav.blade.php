<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav">
                {{--  <li>
                    <a href="">AREA: @{{Locations.list[Locations.get()].name}}</a>
                </li>  --}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('/bower_components/gentelella/production/images/user.png') }}" alt="">{{Auth::user()->name}}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;"> Profile</a></li>
                        <li>
                            <a href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li><a href="javascript:;">Help</a></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out pull-right"></i> Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">6</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li>
                            <a>
                                <span class="image"><img src="{{ asset('/bower_components/gentelella/production/images/img.jpg') }}" alt="Profile Image" /></span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a>
                                <span class="image"><img src="{{ asset('/bower_components/gentelella/production/images/img.jpg') }}" alt="Profile Image" /></span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="{{ asset('/bower_components/gentelella/production/images/img.jpg') }}" alt="Profile Image" /></span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="{{ asset('/bower_components/gentelella/production/images/img.jpg') }}" alt="Profile Image" /></span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                            </a>
                        </li>
                        <li>
                            <div class="text-center">
                                <a>
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                {{--  <li role="presentation" class="dropdown" title="Seleccionar un area">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-hospital-o"></i>
                        <!-- <span class="badge bg-green">6</span> -->
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li ng-repeat="l in Locations.list track by l.id" ng-class="{ active: l.id == Locations.get() }" ng-click="Locations.set(l.id)" ng-if="l">
                            <a>
                                <h5>@{{l.name}}</h5>
                            </a>
                        </li>
                        <li>
                            <a class="text-center" href="{{url('logistic/locations')}} ">
                                <strong>Ver Areas</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>  --}}
                {{--  <li role="presentation" class="dropdown" title="Seleccionar un area">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        @{{Locations.list[Locations.get()].name}}
                        <span class=" fa fa-angle-down"></span>
                        <!-- <span class="badge bg-green">6</span> -->
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li ng-repeat="l in Locations.list track by l.id" ng-class="{ active: l.id == Locations.get() }" ng-click="Locations.set(l.id)" ng-if="l">
                            <a>
                                <h5>@{{l.name}}</h5>
                            </a>
                        </li>
                        <li>
                            <a class="text-center" href="{{url('logistic/locations')}} ">
                                <strong>Ver Areas</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>  --}}
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span ng-bind="Locations.list[Locations.get()].name"></span>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li ng-repeat="l in Locations.list track by l.id" ng-class="{ active: l.id == Locations.get() }" ng-click="Locations.set(l.id)" ng-if="l">
                            <a href="javascript:;"><span ng-bind="l.name"></span> </a>
                        </li>
                        <li>
                            <a class="text-center" href="{{ $appUrl }}/locations">
                                <strong>Ver Areas</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                        {{--                          
                        <li>
                            <a href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li><a href="javascript:;">Help</a></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out pull-right"></i> Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>  --}}
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->