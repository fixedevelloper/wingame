@extends('over.base_auth')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">MAKE YOUR PAYMENT</h4>
                        <div class="nk-block-des">
                            <p>Secure and rapid.</p>
                        </div>
                    </div>
                </div>
            <div class="card-inner-group">
                <div class="card-inner">

                    <form method="GET" action="{!! route('finish_payment',['user_id'=>$user_id]) !!}">
                        <input name="user_id" value="{!! $user_id !!}" hidden>
                        <p>Pay coupon on day</p>
                        @csrf
                      {{--  <div class="form-group">
                            <label class="form-label">Pay by</label>
                            <div class="form-control-wrap">
                                <select id="pay_type" name="pay_type" class="form-select js-select2">
                                    <option value="day">Day</option>
                                    <option value="month">Month</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input required name="number_type" type="number" class="form-control form-control-outlined form-control-lg" id="number_type" placeholder="1">
                                <label class="form-label-outlined" for="number_type">Enter number <span id="type_k"></span></label>
                            </div>
                        </div>--}}
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <label class="form-label" for="outlined">Amount($)</label>
                                <input required readonly name="amount" type="number" value="{{$amount}}" class="form-control form-control-lg" id="outlined" placeholder="Amount">

                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark btn-block  btn-lg mt-3">Continue</button>
                    </form>

                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->

@endsection
@push('js')
            <script>
                $('#pay_type').change(function () {
                    $('#type_k').text($('#pay_type').val());
                    $('#number_type').val('')
                    $('#outlined').val('')
                });
                $('#number_type').keyup(function () {

                    $.ajax({
                        url: configs.routes.calculprice,
                        type: "GET",
                        dataType: "JSON",
                        data: {
                            'number_type': $(this).val(),
                            'pay_type': $('#pay_type').val(),
                        },
                        success: function (data) {
                            $('#outlined').val(data.amount)

                        },
                        error: function (err) {
                            alert("An error ocurred while loading data ...");
                        }
                    })
                })
            </script>
@endpush

