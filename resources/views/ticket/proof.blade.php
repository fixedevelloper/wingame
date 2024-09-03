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
                        <h4 class="nk-block-title text-uppercase">Confirm Your PAYMENT</h4>
                        <div class="nk-block-des">
                            <p>Secure and rapid.</p>
                        </div>
                    </div>
                </div>
            <div class="card-inner-group">
                <form method="POST">
                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <div class="form-control-wrap">
                            <select name="country" class="form-select js-select2">
                                <option value="Congo">Congo</option>
                                <option value="DRC">RDC</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Carrier</label>
                        <div class="form-control-wrap">
                            <select name="carrier" class="form-select js-select2">
                                <option value="NONE">Choose carrier</option>
                                <option value="MTN">MTN</option>
                                <option value="Orange">ORANGE</option>
                                <option value="Airtel">Airtel</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Phone</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" id="default-01" name="phone">
                        </div>
                    </div>
                {{--    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Amount(FCFA)</label>
                        </div>
                        <div class="form-control-wrap">
                            <input value="{{env('PRICE_GAME')}}" type="text" class="form-control form-control-lg" id="default-01" name="amount" readonly>
                        </div>
                    </div>--}}
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">SendPayment</button>
                    </div>
                    @csrf
                </form>
{{--                <div class="card-inner">


                    <p>Effectuer un depot de Au numero <span class="h6">+242 06 444 9019</span></p>
                    <div class="text-center pt-4 pb-3">
                        <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                    </div>
                    <p>Executer le code ci dessous</p>
                    <div class="text-center pt-4 pb-3">
                    <img src="{{ asset('images/momo.jpg') }}">
                    </div>


                </div>
                <div class="card-inner">
                    <p>Telecharger la capture ici</p>
                    <form method="GET" action="{!! route('upload_proof') !!}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input required  name="proof" type="file" class="form-control form-control-lg" id="outlined" placeholder="Proof">

                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark btn-block  btn-lg mt-3">Save</button>
                    </form>

                </div>--}}
            </div>
        </div>
    </div>

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

