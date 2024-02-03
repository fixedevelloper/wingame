<div class="col-xxl-3 col-xl-3 col-lg-4">
    <div class="dashboard__side__bar">
        <ul class="account__menu">
          {{--  <li>
                <a>
                    <span>Cagnote: <span id="cagnote"></span></span>
                </a>
            </li>--}}
            <li>
                <a href="{{route("dashboard")}}"  @if($route=="dashboard") class="active" @endif>
                                    <span class="icons">
                                        <i class="icon-pcontact"></i>
                                    </span>
                    <span>
                                       Dashboard
                                    </span>
                </a>
            </li>
            <li>
                <a href="{{route("settings")}}" @if($route=="settings") class="active" @endif>
                                    <span class="icons">
                                        <i class="icon-user"></i>
                                    </span>
                    <span>
                                        Account Settings
                                    </span>
                </a>
            </li>
            <li>
                <a href="{{route("mygame")}}" @if($route=="mygame") class="active" @endif>
                                    <span class="icons">
                                        <i class="icon-casino"></i>
                                    </span>
                    <span>
                                      My Game
                                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('deposit')}}" @if($route=="deposit") class="active" @endif>
                                    <span class="icons">
                                        <i class="icon-deposit"></i>
                                    </span>
                    <span>
                                       Deposit
                                    </span>
                </a>
            </li>
            <li>
                <a href="{{route("withdraw")}}" @if($route=="withdraw") class="active" @endif>
                                    <span class="icons">
                                        <i class="icon-withdraw"></i>
                                    </span>
                    <span>
                                       Withdraw
                                    </span>
                </a>
            </li>
            <li>
                <a href="{{route("transaction")}}" @if($route=="transaction") class="active" @endif>
                                    <span class="icons">
                                        <i class="icon-history"></i>
                                    </span>
                    <span>
                                       Transction History
                                    </span>
                </a>
            </li>
            <li>
                <a href="{{route("bonus")}}" @if($route=="bonus") class="active" @endif>
                                    <span class="icons">
                                        <i class="icon-bonus"></i>
                                    </span>
                    <span>
                                       Bonuses
                                    </span>
                </a>
            </li>
            <li>
                <a href="{{route("logout")}}">
                                    <span class="icons">
                                        <i class="icon-logout"></i>
                                    </span>
                    <span>
                                       Logout
                                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
