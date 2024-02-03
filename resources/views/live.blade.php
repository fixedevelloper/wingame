@extends('base')
@section('sub_header')
    @include('_partials._sub_header')
@endsection
@section('content')
    <!--Global Main Body-->
    <section class="main__body__area">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-10 col-xl-9 col-lg-9">
                    <div class="left__site__section">
                        <div class="tab-content" id="myTabContentmain">
                            <!--Global Main Body-->
                            <div class="popular__events__body">
                                <div class="container-fluid p-0">
                                    <div class="row g-0">
                                        <div class="col-xxl-2 col-xl-3 col-lg-3">
                                            <div class="popular__events__left display991">
                                                <div class="popular__events__head">
                                                    <h5>
                                                        Popular events
                                                    </h5>
                                                    <ul>
                                                        @foreach($leagues as $league)
                                                            <li>
                                                            <span><img height="40" src="{{$league->logo}}"
                                                                       alt="img"></span>
                                                                <span>Eorld Cup 2022</span>
                                                            </li>
                                                        @endforeach


                                                    </ul>
                                                </div>
                                                <div class="star__wrap">
                                                    <span><img src="{{asset('img/leftmenu/start.png')}}" alt="img"></span>
                                                    <span>Favorites</span>
                                                </div>
                                                <div class="prematch__wrap">
                                                    <div class="nav" id="nav-tabpre" role="tablist">
                                                        <button class="nav-link active" id="nav-home-tabpre"
                                                                data-bs-toggle="tab" data-bs-target="#nav-homepre"
                                                                type="button" role="tab" aria-controls="nav-homepre"
                                                                aria-selected="true">Live
                                                        </button>
                                                        <button class="nav-link " id="nav-profile-tabpre"
                                                                data-bs-toggle="tab" data-bs-target="#nav-profilepre"
                                                                type="button" role="tab" aria-controls="nav-profilepre"
                                                                aria-selected="false">Prematch
                                                        </button>
                                                    </div>
                                                    <div class="tab-content" id="nav-tabContentpre">
                                                        <div class="tab-pane fade text-white show active"
                                                             id="nav-homepre" role="tabpanel"
                                                             aria-labelledby="nav-home-tabpre" tabindex="0">
                                                            <div class="prematch__scopre">
                                                                <a href="#pre" class="prescore__items">
                                                                    <div class="prescore__left">
                                                                        <span><i class="icon-football"></i></span>
                                                                        <span class="score">
                                                                            Soccer
                                                                        </span>
                                                                    </div>
                                                                    <div class="prescore__right">
                                                                        <span>2</span>
                                                                        <span><i
                                                                                class="fa-solid fa-angle-down"></i></span>
                                                                    </div>
                                                                </a>
                                                                <a href="#pre" class="prescore__items">
                                                                    <div class="prescore__left">
                                                                        <span><i class="icon-tennis"></i></span>
                                                                        <span class="score">
                                                                            Tennis
                                                                        </span>
                                                                    </div>
                                                                    <div class="prescore__right">
                                                                        <span>4</span>
                                                                        <span><i
                                                                                class="fa-solid fa-angle-down"></i></span>
                                                                    </div>
                                                                </a>
                                                                <a href="#pre" class="prescore__items">
                                                                    <div class="prescore__left">
                                                                        <span><i class="icon-basketball"></i></span>
                                                                        <span class="score">
                                                                            Basketball
                                                                        </span>
                                                                    </div>
                                                                    <div class="prescore__right">
                                                                        <span>4</span>
                                                                        <span><i
                                                                                class="fa-solid fa-angle-down"></i></span>
                                                                    </div>
                                                                </a>
                                                                <a href="#pre" class="prescore__items">
                                                                    <div class="prescore__left">
                                                                        <span><i class="icon-ttennis"></i></span>
                                                                        <span class="score">
                                                                            Table Tennis
                                                                        </span>
                                                                    </div>
                                                                    <div class="prescore__right">
                                                                        <span>8</span>
                                                                        <span><i
                                                                                class="fa-solid fa-angle-down"></i></span>
                                                                    </div>
                                                                </a>
                                                                <a href="#pre" class="prescore__items">
                                                                    <div class="prescore__left">
                                                                        <span><i class="icon-volly"></i></span>
                                                                        <span class="score">
                                                                            Volleyball
                                                                        </span>
                                                                    </div>
                                                                    <div class="prescore__right">
                                                                        <span>2</span>
                                                                        <span><i
                                                                                class="fa-solid fa-angle-down"></i></span>
                                                                    </div>
                                                                </a>
                                                                <a href="#pre" class="prescore__items">
                                                                    <div class="prescore__left">
                                                                        <span><i class="icon-handball"></i></span>
                                                                        <span class="score">
                                                                            Handball
                                                                        </span>
                                                                    </div>
                                                                    <div class="prescore__right">
                                                                        <span>1</span>
                                                                        <span><i
                                                                                class="fa-solid fa-angle-down"></i></span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade text-white " id="nav-profilepre"
                                                             role="tabpanel" aria-labelledby="nav-profile-tabpre"
                                                             tabindex="0">
                                                            <div class="multiple__components">
                                                                <div class="prematch__scopre">
                                                                    <a href="#pre" class="prescore__items">
                                                                        <div class="prescore__left">
                                                                            <span><i class="icon-football"></i></span>
                                                                            <span class="score">
                                                                                    Soccer
                                                                                </span>
                                                                        </div>
                                                                        <div class="prescore__right">
                                                                            <span>2</span>
                                                                            <span><i class="fa-solid fa-angle-down"></i></span>
                                                                        </div>
                                                                    </a>
                                                                    <a href="#pre" class="prescore__items">
                                                                        <div class="prescore__left">
                                                                            <span><i class="icon-tennis"></i></span>
                                                                            <span class="score">
                                                                                    Tennis
                                                                                </span>
                                                                        </div>
                                                                        <div class="prescore__right">
                                                                            <span>4</span>
                                                                            <span><i class="fa-solid fa-angle-down"></i></span>
                                                                        </div>
                                                                    </a>
                                                                    <a href="#pre" class="prescore__items">
                                                                        <div class="prescore__left">
                                                                            <span><i class="icon-basketball"></i></span>
                                                                            <span class="score">
                                                                                    Basketball
                                                                                </span>
                                                                        </div>
                                                                        <div class="prescore__right">
                                                                            <span>4</span>
                                                                            <span><i class="fa-solid fa-angle-down"></i></span>
                                                                        </div>
                                                                    </a>
                                                                    <a href="#pre" class="prescore__items">
                                                                        <div class="prescore__left">
                                                                            <span><i class="icon-ttennis"></i></span>
                                                                            <span class="score">
                                                                                    Table Tennis
                                                                                </span>
                                                                        </div>
                                                                        <div class="prescore__right">
                                                                            <span>8</span>
                                                                            <span><i class="fa-solid fa-angle-down"></i></span>
                                                                        </div>
                                                                    </a>
                                                                    <a href="#pre" class="prescore__items">
                                                                        <div class="prescore__left">
                                                                            <span><i class="icon-volly"></i></span>
                                                                            <span class="score">
                                                                                    Volleyball
                                                                                </span>
                                                                        </div>
                                                                        <div class="prescore__right">
                                                                            <span>2</span>
                                                                            <span><i class="fa-solid fa-angle-down"></i></span>
                                                                        </div>
                                                                    </a>
                                                                    <a href="#pre" class="prescore__items">
                                                                        <div class="prescore__left">
                                                                            <span><i class="icon-handball"></i></span>
                                                                            <span class="score">
                                                                                    Handball
                                                                                </span>
                                                                        </div>
                                                                        <div class="prescore__right">
                                                                            <span>1</span>
                                                                            <span><i class="fa-solid fa-angle-down"></i></span>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-10 col-xl-9 col-lg-9">
                                            <!--Home Page Tabs Here-->
                                        @include('_tabs_home.home_tab')
                                        <!--Home Page Tabs Here-->

                                            <!--Live Page Tabs Here-->
                                        @include("_tabs_home.live")
                                        <!--Live Page Tabs End-->

                                            <!--Today Page Tabs Here-->
                                        @include("_tabs_home.today")
                                        <!--Today Page Tabs End-->

                                            <!--Football Page Tabs Here-->
                                        @include("_tabs_home.football")
                                        <!--Football Page Tabs End-->

                                            <!--Tennis Page Tabs Here-->
                                            <!--Tennis Page Tabs End-->

                                            <!--Basketball Page Tabs Here-->
                                            <!--Basketball Page Tabs End-->

                                            <!--IceHockey Page Tabs Here-->
                                            <!--IceHockey Page Tabs End-->

                                            <!--Handball Page Tabs Here-->
                                            <!--Handball Page Tabs End-->

                                            <!--American Page Tabs Here-->
                                            <!--American Page Tabs End-->

                                            <!--Baseball Page Tabs Here-->
                                            <!--Baseball Page Tabs End-->

                                            <!--Horse Racing Page Tabs Here-->
                                            <!--Horse Racing Page Tabs End-->

                                            <!--Virtual Page Tabs Here-->
                                            <!--Virtual Page Tabs End-->

                                            <!--Fovatires Page Tabs Here-->
                                            <!--Fovatires Page Tabs End-->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Global Main Body-->
                        </div>
                    </div>
                </div>
                <div class="col-xxl-2 col-xl-3 col-lg-3">
                    <div class="right__site__section display991">
                        <div class="betslip__wrap">
                            <h5 class="betslip__title">
                                Betslip
                            </h5>
                            <div class="nav" id="nav-taboo" role="tablist">
                                <button class="nav-link " id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Single
                                </button>
                                <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Multiple
                                </button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-contact" type="button" role="tab" aria-selected="false">
                                    System
                                </button>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade text-white " id="nav-home" role="tabpanel"
                                     aria-labelledby="nav-home-tab" tabindex="0">
                                    <div class="multiple__components">
                                        <div class="multiple__items">
                                            <div class="multiple__head">
                                                <div class="multiple__left">
                                                    <span class="icons">
                                                        <i class="icon-football"></i>
                                                    </span>
                                                    <span>
                                                        Real Kashmir vs Trau FC
                                                    </span>
                                                </div>
                                                <a href="#0" class="cros">
                                                    <i class="icon-cross"></i>
                                                </a>
                                            </div>
                                            <div class="multiple__point">
                                                <span class="pbox">
                                                    50.2
                                                </span>
                                                <span class="rightname">
                                                    <span class="fc">
                                                        Trau FC
                                                    </span>
                                                    <span class="point">
                                                        1x2
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="total__odds">
                                            <div class="total__head">
                                                <h6 class="odd">
                                                    Total Odds
                                                </h6>
                                                <span>
                                                    25
                                                </span>
                                            </div>
                                            <div class="wrapper">
                                                <div class="result">
                                                    <span>Stake amount, $</span>
                                                    <span class="result">0.00 $</span>
                                                </div>
                                                <div class="buttons">
                                                    <button type="button">5</button>
                                                    <button type="button">10</button>
                                                    <button type="button">50</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="possible__pay">
                                            <span>Possible Payout</span>
                                            <span>0.00$</span>
                                        </div>
                                        <a href="#0" class="cmn--btn2">
                                            <span>Sign In & Bet</span>
                                        </a>
                                    </div>
                                    <div class="setting__area">
                                        <div class="tab-content" id="nav-tabContentsetting">
                                            <div class="tab-pane fade text-white" id="nav-homesett" role="tabpanel"
                                                 aria-labelledby="nav-home-tabsetting" tabindex="0">
                                                <div class="sign__bets__wrap">
                                                    <h5 class="betslip__title">
                                                        Betslip
                                                    </h5>
                                                    <div class="sign__boxes">
                                                        <div class="content">
                                                            <h6>
                                                                Erase Betslip
                                                            </h6>
                                                            <p>
                                                                Are you sure you want to erase Betslip?
                                                            </p>
                                                            <div class="btn__grp">
                                                                <a href="#0" class="cmn--btn">
                                                                    <span>No</span>
                                                                </a>
                                                                <a href="#0" class="cmn--btn2">
                                                                    <span>Accept</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade text-white" id="nav-homeett2" role="tabpanel"
                                                 aria-labelledby="nav-home-tabsetting2" tabindex="0">
                                                <div class="sign__bets__wrap">
                                                    <h5 class="betslip__title">
                                                        Betslip
                                                    </h5>
                                                    <div class="setting__boxes">
                                                        <div class="setting__boxes__head">
                                                            <span>Accept Changes automatically?</span>
                                                            <a href="#0">
                                                                <i class="icon-cross"></i>
                                                            </a>
                                                        </div>
                                                        <div class="check__wrap">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="check1a">
                                                                <label class="form-check-label" for="check1a">
                                                                    Accept any odds changes
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="check2o">
                                                                <label class="form-check-label" for="check2o">
                                                                    Only accept increased odds
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="check3">
                                                                <label class="form-check-label" for="check3">
                                                                    Always ask
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nav" id="nav-tabseting" role="tablist">
                                            <button class="nav-link" id="nav-home-tabsetting" data-bs-toggle="tab"
                                                    data-bs-target="#nav-homesett" type="button" role="tab"
                                                    aria-controls="nav-home" aria-selected="true">
                                                <span class="icons"><i class="icon-trush"></i></span>
                                                <span class="text">
                                                    Sign IN & Bet
                                                </span>
                                            </button>
                                            <button class="nav-link" id="nav-home-tabsetting2" data-bs-toggle="tab"
                                                    data-bs-target="#nav-homeett2" type="button" role="tab"
                                                    aria-controls="nav-profile" aria-selected="false">
                                                <span class="icons"><i class="icon-setting"></i></span>
                                                <span class="text">
                                                    Settings
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade text-white show active" id="nav-profile" role="tabpanel"
                                     aria-labelledby="nav-profile-tab" tabindex="0">
                                    <div class="multiple__components">
                                        <div class="multiple__items">
                                            <div class="multiple__head">
                                                <div class="multiple__left">
                                                    <span class="icons">
                                                        <i class="icon-football"></i>
                                                    </span>
                                                    <span>
                                                        Real Kashmir vs Trau FC
                                                    </span>
                                                </div>
                                                <a href="#0" class="cros">
                                                    <i class="icon-cross"></i>
                                                </a>
                                            </div>
                                            <div class="multiple__point">
                                                <span class="pbox">
                                                    50.2
                                                </span>
                                                <span class="rightname">
                                                    <span class="fc">
                                                        Trau FC
                                                    </span>
                                                    <span class="point">
                                                        1x2
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="multiple__items">
                                            <div class="multiple__head">
                                                <div class="multiple__left">
                                                    <span class="icons">
                                                        <i class="icon-football"></i>
                                                    </span>
                                                    <span>
                                                        Stodder, Timo vs Kopriva, Vit
                                                    </span>
                                                </div>
                                                <a href="#0" class="cros">
                                                    <i class="icon-cross"></i>
                                                </a>
                                            </div>
                                            <div class="multiple__point">
                                                <span class="pbox">
                                                   3.66
                                                </span>
                                                <span class="rightname">
                                                    <span class="fc">
                                                        Stodder, Timo
                                                    </span>
                                                    <span class="point">
                                                       Winner
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="total__odds">
                                            <div class="total__head">
                                                <h6 class="odd">
                                                    Total Odds
                                                </h6>
                                                <span>
                                                    25
                                                </span>
                                            </div>
                                            <div class="wrapper">
                                                <div class="result">
                                                    <span>Stake amount, $</span>
                                                    <span class="result">0.00 $</span>
                                                </div>
                                                <div class="buttons">
                                                    <button type="button">5</button>
                                                    <button type="button">10</button>
                                                    <button type="button">50</button>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#0" class="cmn--btn2">
                                            <span>Sign In & Bet</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="tab-pane fade text-white" id="nav-contact" role="tabpanel"
                                     aria-labelledby="nav-contact-tab" tabindex="0">
                                    <div class="multiple__components">
                                        <div class="multiple__items">
                                            <div class="multiple__head">
                                                <div class="multiple__left">
                                                    <span class="icons">
                                                        <i class="icon-football"></i>
                                                    </span>
                                                    <span>
                                                        Real Kashmir vs Trau FC
                                                    </span>
                                                </div>
                                                <a href="#0" class="cros">
                                                    <i class="icon-cross"></i>
                                                </a>
                                            </div>
                                            <div class="multiple__point">
                                                <span class="pbox">
                                                    50.2
                                                </span>
                                                <span class="rightname">
                                                    <span class="fc">
                                                        Trau FC
                                                    </span>
                                                    <span class="point">
                                                        1x2
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="multiple__items">
                                            <div class="multiple__head">
                                                <div class="multiple__left">
                                                    <span class="icons">
                                                        <i class="icon-football"></i>
                                                    </span>
                                                    <span>
                                                        Stodder, Timo vs Kopriva, Vit
                                                    </span>
                                                </div>
                                                <a href="#0" class="cros">
                                                    <i class="icon-cross"></i>
                                                </a>
                                            </div>
                                            <div class="multiple__point">
                                                <span class="pbox">
                                                   3.66
                                                </span>
                                                <span class="rightname">
                                                    <span class="fc">
                                                        Stodder, Timo
                                                    </span>
                                                    <span class="point">
                                                       Winner
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="total__odds">
                                            <div class="total__head">
                                                <h6 class="odd">
                                                    Total Odds
                                                </h6>
                                                <span>
                                                    25
                                                </span>
                                            </div>
                                            <div class="wrapper">
                                                <div class="result">
                                                    <span>Stake amount, $</span>
                                                    <span class="result">0.00 $</span>
                                                </div>
                                                <div class="buttons">
                                                    <button type="button">5</button>
                                                    <button type="button">10</button>
                                                    <button type="button">50</button>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#0" class="cmn--btn2">
                                            <span>Sign In & Bet</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--footer Bottom Menu-->
        <ul class="footer__menu d-lg-none">
            <li>
                <a href="sportsbetting.html" class="d-grid justify-content-center">
                    <span><i class="fas fa-table-tennis"></i></span>
                    <span class="texta">Sports</span>
                </a>
            </li>
            <li>
                <a href="#0" class="d-grid justify-content-center" data-bs-toggle="modal" data-bs-target="#eventsp">
                    <span><i class="fa-solid fa-gift"></i></span>
                    <span class="texta">Events</span>
                </a>
            </li>
            <li class="header-bartwo d-lg-none">
                <span class="bars"><i class="fas fa-bars"></i></span>
                <span class="cros"> <i class="fa-solid fa-xmark"></i></span>
            </li>
            <li>
                <a href="#0" class="d-grid justify-content-center" data-bs-toggle="modal" data-bs-target="#betsp">
                    <span> <i class="fas fa-ticket-alt"></i></span>
                    <span class="texta">My Bet</span>
                </a>
            </li>
            <li>
                <a href="dashboard.html" class="d-grid justify-content-center">
                    <span> <i class="far fa-user-circle"></i></span>
                    <span class="texta"> Account</span>
                </a>
            </li>
        </ul>
        <!--footer Bottom Menu-->
    </section>
    <!--Global Main Body-->
@endsection
