<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
                <a href="{{ url('/') }} " class="site_title"><i class="fa fa-book"></i> <span>{{ config('app.name') }} </span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset('/bower_components/gentelella/production/images/user.png') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>{{Auth::user()->name}} </h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Logistica</h3>
                <!-- <pre>{{ print_r($menu) }} </pre> -->
                <ul class="nav side-menu">
                    <li><a href="{{ url('/logistic') }} "><i class="fa fa-home"></i> Principal</a></li>
                    @foreach ($menu['categories'] as $title => $record)
                        @if($record['show'])
                        <li><a>{!!$record['icon']!!} {{ $record['title'] }} <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                @foreach ($record['modules'] as $module)
                                    @if (isset($modules[$module]))
                                        <li>
                                            <a href="{{ $appUrl }}/{{ $module }} " title="{{$modules[$module]['description']}} ">
                                                {{$modules[$module]['title']}} 
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings" href="{{url('logistic/components')}} ">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>