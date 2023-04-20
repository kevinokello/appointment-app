    <!--Menu Start-->
    <div id="strickymenu" class="menu-area"
        style="position: sticky;
    top: 0px;
    box-shadow: rgb(204, 204, 204) 0px 2px 2px;
    background-color: rgb(255, 255, 255);
    z-index: 1020;
    margin-top: -16px;
    padding-top: 16px;">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="logo flex">
                        <a href="{{ route('home') }}"><img src="" alt="Logo"></a>
                    </div>
                </div>
                <div class="col-md-9 col-6">
                    <div class="main-menu">
                        <ul class="nav-menu">
                            <li><a href="{{ url('/') }}">Home</a>
                            </li>

                            <li><a href="{{ url('experts') }}">Browse Doctors</a>
                            </li>
                            @auth
                                <li>
                                    <a href="{{ route('user.dashboard') }}">@changeLang('Dashboard')</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('user.login') }}">@changeLang('Login')</a> 
                                </li>
                                <li>
                         <a
                                        href="{{ route('user.register') }}">@changeLang('Register')</a>
                                </li>
                            @endauth


                        </ul>
                    </div>


                    <!--Mobile Menu Icon Start-->
                    <div class="mobile-menuicon">
                        <span class="menu-bar" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i></span>
                    </div>
                    <!--Mobile Menu Icon End-->
                </div>
            </div>
        </div>
    </div>

    <!--Mobile Menu Start-->
    <div class="mobile-menu">
        <div id="mySidenav" class="sidenav">
            <a href="{{ route('home') }}"><img src="" alt="Logo"></a>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

            <ul>
            
                @auth
                    <li><a href="{{ route('user.dashboard') }}">@changeLang('Dashboard')</a></li>
                @else
                    <li><a href="{{ route('user.login') }}">@changeLang('Login')</a></li>
                    <li><a href="{{ route('user.register') }}">@changeLang('Register')</a></li>
                @endauth
            </ul>


        </div>
    </div>
    <!--Mobile Menu End-->

    <!--Menu End-->
