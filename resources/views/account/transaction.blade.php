@extends('account.layout')

@section('content')
    <h3 class="account__head mb__30">
        My Transactions
    </h3>
    <div class="">
        <div class="custom_card">
            <div class="cainoform__wrap">
                <div class="row g-4">
                    <div class="col-xl-6">
                        <div class="casino__date">
                            <h4 class="f__title">
                                From
                            </h4>
                            <div class="calender-bar">
                                <input type="text" class="datepicker" placeholder="2023-2-2">
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
                                <input type="text" class="datepicker" placeholder="2023-2-2">
                                <i class="icon-calender"></i>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <tr>
                        <td>Deposit</td>
                        <td>MTN Mobile</td>
                        <td>5,591 USD</td>
                        <td class="cancel">Cancel</td>
                        <td>8.55</td>
                        <td class="bold">...</td>
                    </tr>
                    <tr>
                        <td>Withdraw</td>
                        <td>Credit Card</td>
                        <td>4,591 USD</td>
                        <td class="pending">Pending</td>
                        <td>2.70</td>
                        <td class="bold">...</td>
                    </tr>
                    <tr>
                        <td>Withdraw</td>
                        <td>Credit Card</td>
                        <td>4,591 USD</td>
                        <td class="complate">Complete</td>
                        <td>2.70</td>
                        <td class="bold">...</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
@endsection
