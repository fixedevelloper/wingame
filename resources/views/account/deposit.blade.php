@extends('account.layout')

@section('content')
    <div class="dashboard__body__wrap p-5">
        <h3 class="account__head2 mb__30">
            Deposit <h3 class="float-end balance">Balance:{{$user->sold}}</h3>
        </h3>
        <div class="payment__cart__check">
            <div class="row g-4">
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <div class="card card_d">
                        <div class="card-body card_body_dark">
                            <div class="payment__cart__items">
                                <input class="form-check-input" name="deposit" type="radio" id="deposit1">
                                <label class="form-check-label" for="deposit1">
                                 Mtn
                                </label>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <div class="card card_d">
                        <div class="card-body card_body_dark">
                            <div class="payment__cart__items">
                                <input class="form-check-input" name="deposit" type="radio" id="deposit1">
                                <label class="form-check-label" for="deposit1">
                                    Airtel
                                </label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="deposit__complate">
            <h3>
                Add Deposit
            </h3>
            <div class="row">
                <dl class="text-white text-start">
                    <dt>Phone number</dt>
                    <dd>+242XXXXXXXXXXXXXXXXXXXXXXXXX</dd>
                    <dt>Name</dt>
                    <dd>MR DONALD EBVOUNDI</dd>
                </dl>
            </div>
            <p class="mb-3 text-white">Enter ID of transaction</p>
            <form method="POST">
                @csrf
                <div class="single-input mb__20">
                    <input type="text" id="dAmount" placeholder="ID of transaction" value="20.00" autocomplete="off">
                </div>
                <div class="btn-area">
                    <button type="submit" class="cmn--btn">
                        <span>Deposit</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
