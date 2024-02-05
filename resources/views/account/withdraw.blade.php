@extends('account.layout')

@section('content')
    <h3 class="account__head mb__30">
        Withdraw
    </h3>
    <div class="custom_card">

            <div class="payment__cart__check">
                <h3 class="balance">
                    Balance:  {{$user->sold}} FCFA
                </h3>
                <div class="row g-4 text-white">
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <div class="payment__cart__items">
                            <input class="form-check-input" type="checkbox" id="deposit1">
                            <label class="form-check-label" for="deposit1">
                                <img src="assets/img/profile/visa.png" alt="MTN">
                            </label>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <div class="payment__cart__items">
                            <input class="form-check-input" type="checkbox" id="deposit2">
                            <label class="form-check-label" for="deposit2">
                                <img src="assets/img/profile/visa.png" alt="Visa">
                            </label>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <div class="payment__cart__items">
                            <input class="form-check-input" type="checkbox" id="deposit3">
                            <label class="form-check-label" for="3">
                                <img src="assets/img/profile/visa.png" alt="Airtel">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="deposit__complate">
                <h3>
                    Complete Your Withdraw
                </h3>
                <div class="deposit__wallet">
                    <div class="deopsit__wallet__items">
                        <p>
                            Deposit to Wallet
                        </p>
                        <div class="usd__chacnge">
                            <span>USD</span>
                            <div class="icons" id="profile-picture">
                                <i class="fas fa-pen"></i>
                            </div>
                        </div>
                    </div>
                    <div class="deopsit__wallet__items">
                        <p>
                            Payment Provider
                        </p>
                        <div class="usd__chacnge">
                            <span><img src="assets/img/profile/bvisa.png" alt="vissa"></span>
                            <div class="icons" id="profile-picture2">
                                <i class="fas fa-pen"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="promo__code">
                                <span class="promo">
                                    Promo Code
                                </span>
                    <a href="#0">
                        <span>Enter Code</span>
                        <span><i class="fas fa-plus"></i></span>
                    </a>
                </div>
                <a href="#0" class="visa__card">
                    <img src="assets/img/profile/visap.png" alt="visa">
                </a>
                <ul class="quick-value">
                    <li><h5 class="active">20</h5></li>
                    <li><h5>30</h5></li>
                    <li><h5>100</h5></li>
                    <li>
                        <a href="#0">
                            Custom
                        </a>
                    </li>
                </ul>
                <form action="#">
                    <div class="single-input mb__20">
                        <input type="text" id="dAmount" placeholder="Enter Amount" value="$20.00" autocomplete="off">
                    </div>
                    <div class="single-input">
                        <input type="text" id="eemail" placeholder="Email" autocomplete="off">
                    </div>
                    <div class="total__amount">
                        <div class="items">
                            <span>Amount Fee</span>
                            <span>$20</span>
                        </div>
                        <div class="items">
                            <span>Total</span>
                            <span>$20</span>
                        </div>
                    </div>
                    <div class="btn-area">
                        <button class="cmn--btn">
                            <span>Withdraw</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection
