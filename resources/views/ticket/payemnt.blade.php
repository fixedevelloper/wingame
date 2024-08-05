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
                    <form method="POST">
                        @csrf
                        <input name="type" value="mobil" hidden>
                        <button title="Congo" class="btn btn-dark btn-block btn-lg mt-3">MOBIL MONEY</button>
                    </form>
                    <form method="POST">
                        @csrf
                        <input name="type" value="paydunya" hidden>
                    <button title="Afrique de l'ouest" class="btn btn-dark btn-block btn-lg mt-3">PAYDUNYA</button>
                    </form>
                    <form method="POST">
                        @csrf
                        <input name="type" value="stripe" hidden>
                        <button type="submit" class="btn btn-dark btn-block  btn-lg mt-3">STRIPE</button>
                    </form>

                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
    <!-- Modal Content Code -->
    <div class="modal fade" tabindex="-1" id="modalDefault">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un ticket</h5>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input name="numero" type="text" class="form-control form-control-outlined" id="outlined" placeholder="N°ticket">
                                <label class="form-label-outlined" for="outlined">Code du coupon</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="customFileLabel">Image</label>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" class="form-file-input" id="customFile" name="image">
                                    <label class="form-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button  class="btn btn-outline-primary">Save</button>
                    </div>
                    @csrf
                </form>

            </div>
        </div>
    </div>
@endsection

