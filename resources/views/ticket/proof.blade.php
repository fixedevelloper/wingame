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
                        <h4 class="nk-block-title">UPLOAD PROOF OF PAYMENT</h4>
                        <div class="nk-block-des">
                            <p>Secure and rapid.</p>
                        </div>
                    </div>
                </div>
            <div class="card-inner-group">
                <div class="card-inner">


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

