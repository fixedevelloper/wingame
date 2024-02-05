<!--Header Here-->
<header class="header-section
 @if(!auth()->check()) dashboard__header @endif">
    <div class="container-fluid p-0">
        <div class="header-wrapper">
            <div class="menu__left__wrap">
                <div class="logo-menu px-1">
                    <a href="{{route('home')}}" class="logo">
                        <img src="{{asset('images/logo.png')}}" alt="logo">
                    </a>
                </div>

         {{--       <div class="lang d-flex align-items-center px-2">
                    <div class=" d-lg-none mr-1">

                    </div>
                    <div class="header-bar d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>--}}
                <ul class="main-menu">
                    <li>
                        <a href="{{route('home')}}">
                            <span>Live</span>
                        </a>
                    </li>

                    @if(!auth()->check())
                        <li class="d-lg-none">   <a href="{{route("sign_in")}}" id="login_id" class="cmn--btn">
                                <span>Se connecter</span>
                            </a>
                        </li>
                            <li class="d-lg-none">
                            <a href="{{route("nextregister")}}" class="cmn--btn2">
                                <span class="rela">S'inscrire</span>
                            </a>
                            </li>
                        @endif

                </ul>
            </div>
            <div class="d-flex d-lg-block d-md-block d-sm-none">
            </div>
            @if(auth()->check())
                <div class="dashboar__wrap">
                    <div class="items dashboar__social">

                        <div class="custom-dropdown">
                            <div class="custom-dropdown__user" data-set="custom-dropdown">
                                <a href="{{route("dashboard")}}" class="icons">
                                    <i class="icon-user text-white"></i>
                                </a>
                            </div>
                            <div class="custom-dropdown__content">
                                <div class="custom-dropdown__body">
                                    <ul class="custom-dropdown__list">
                                        <li>
                                            <a href="dashboard.html" class="custom-dropdown__body-link">
                                      <span class="custom-dropdown__body-icon">
                                        <i class="fas fa-layer-group"></i>
                                      </span>
                                                <span class="custom-dropdown__body-text">
                                        Dashboard
                                      </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route("logout")}}" class="custom-dropdown__body-link">
                                      <span class="custom-dropdown__body-icon">
                                        <i class="fas fa-sign-out-alt"></i>
                                      </span>
                                                <span class="custom-dropdown__body-text">
                                        Logout
                                      </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(!auth()->check())
            <div class="mneu-btn-grp">

                <a href="{{route("sign_in")}}"  id="login_id" class="cmn--btn">
                    <span>Sign In</span>
                </a>
                <a href="{{route("nextregister")}}" class="cmn--btn2">
                    <span class="rela">Sign Up</span>
                </a>
            </div>
            @endif
            <div class="lang d-flex align-items-center px-2 d-lg-none">
                <div class="header-bar d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

    </div>
</header>
<!--Header End-->
