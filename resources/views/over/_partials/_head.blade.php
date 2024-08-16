<div class="nk-header nk-header-fluid is-theme">
    <div class="container-xl wide-xl">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger me-sm-2 d-lg-none">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand">
                <a href="{!! route('home') !!}" class="logo-link">
                    <img class="logo-light logo-img" src="{!! asset('images/logo.png') !!}" alt="logo">
                    <img class="logo-dark logo-img" src="{!! asset('images/logo.png') !!}"  alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu" data-content="headerNav">
                <div class="nk-header-mobile">
                    <div class="nk-header-brand">
                        <a href="{!! route('home') !!}" class="logo-link">
                            <img class="logo-light logo-img" src="{!! asset('images/logo.png') !!}" alt="logo">
                            <img class="logo-dark logo-img" src="{!! asset('images/logo.png') !!}" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
                <ul class="nk-menu nk-menu-main ui-s2">
                    <li class="nk-menu-item">
                        <a href="{!! route('home') !!}" class="nk-menu-link">
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{!! route('fixture_lost') !!}" class="nk-menu-link">
                            <span class="nk-menu-text">Match lost home</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{!! route('fixture_lost_away') !!}" class="nk-menu-link">
                            <span class="nk-menu-text">Match lost away</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-text">Over</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{!! route('over5_5') !!}" class="nk-menu-link"><span class="nk-menu-text">Over 5.5</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{!! route('over6_5') !!}" class="nk-menu-link"><span class="nk-menu-text">Over 6.5</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{!! route('over7_5') !!}" class="nk-menu-link"><span class="nk-menu-text">Over 7.5</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{!! route('over8_5') !!}" class="nk-menu-link"><span class="nk-menu-text">Over 8.5</span></a>
                            </li>

                        </ul><!-- .nk-menu-sub -->
                    </li>
                    <li class="nk-menu-item">
                        <a href="{!! route('exactscore') !!}" class="nk-menu-link">
                            <span class="nk-menu-text">Score exactes</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{!! route('lastFixture_defeats') !!}" class="nk-menu-link">
                            <span class="nk-menu-text">Equipes sans defaites</span>
                        </a>
                    </li>
                </ul><!-- .nk-menu -->
            </div><!-- .nk-header-menu -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown order-sm-first">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                <div class="user-info d-none d-xl-block">
                                    <div class="user-status">Administrator</div>
                                    <div class="user-name dropdown-indicator">Rodrigue Mbah</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>MR</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">Mbah Rodrigue</span>
                                        <span class="sub-text">rodrigue@gmail.com</span>
                                    </div>
                                    <div class="user-action">
                                        <a class="btn btn-icon me-n2" href="{!! route('home') !!}"><em class="icon ni ni-setting"></em></a>
                                    </div>
                                </div>
                            </div>
                         {{--   <div class="dropdown-inner user-account-info">
                                <h6 class="overline-title-alt">Account Balance</h6>
                                <div class="user-balance">1,494.23 <small class="currency currency-usd">USD</small></div>
                                <div class="user-balance-sub">Locked <span>15,495.39 <span class="currency currency-usd">USD</span></span></div>
                                <a href="#" class="link"><span>Withdraw Balance</span> <em class="icon ni ni-wallet-out"></em></a>
                            </div>--}}
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="#"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
