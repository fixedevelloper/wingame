@extends('account.layout')

@section('content')
    <h3 class="account__head mb__30">
        My Transactions
    </h3>
    <div class="">
        <div class="custom_card">
            <div class="cainoform__wrap">
                <form id="mygame_form">
                    <div class="row g-4">
                        <div class="col-xl-6">
                            <div class="casino__date">
                                <h4 class="f__title">
                                    From
                                </h4>
                                <div class="calender-bar">
                                    <input name="date_begin" value="{{$begin_date}}" type="text" class="datepicker" placeholder="2023-2-2">
                                    <i class="icon-calender"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="casino__date">
                                <h4 class="f__title">
                                    Until
                                </h4>
                                <div class="calender-bar">
                                    <input name="date_end" value="{{$end_date}}" type="text" class="datepicker" id="myform_game_input" placeholder="2023-2-2">
                                    <i class="icon-calender"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="casinoform__tabe">
                <table>
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Payment Methods</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Ratio</th>
                        <th>More</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                        <td>{{strtoupper($transaction->type)}}</td>
                        <td>{{strtoupper($transaction->method)}}</td>
                        <td>{{$transaction->amount}} USD</td>
                        <td class="@if($transaction->status=='pending') pending @elseif($transaction->status=='cancel')cancel @else complate @endif">{{$transaction->status}}</td>
                        <td></td>
                        <td class="bold">...</td>
                    </tr>
                    @endforeach
            {{--        <tr>
                        <td>Withdraw</td>
                        <td>Credit Card</td>
                        <td>4,591 USD</td>
                        <td class="pending">Pending</td>
                        <td>2.70</td>
                        <td class="bold">...</td>
                    </tr>--}}
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
@endsection
