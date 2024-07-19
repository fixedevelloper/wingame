@extends('over.base_over')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add result ticket N° coupon {!! $ticket->numero !!}</h3>
                <div class="nk-block-des text-soft">
                    <p>{!! $ticket->date !!}</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                </ul>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{!! asset('storage/'.$ticket->image) !!}" target="_blank">
                            <img  src="{!! asset('storage/'.$ticket->image) !!}">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <form method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label class="form-label" for="customFileLabel">Image Result</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" class="form-file-input" id="customFile" name="image">
                                        <label class="form-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer bg-light">
                                <a href="{!! route('admin.tikets') !!}"  class="btn btn-outline-warning float-start">Cancel</a>
                                <button  class="btn btn-outline-primary">Save</button>
                            </div>
                            @csrf
                        </form>
                        <a href="{!! asset('storage/'.$ticket->image_result) !!}" target="_blank">
                            <img  src="{!! asset('storage/'.$ticket->image_result) !!}">
                        </a>

                    </div>
                </div>
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->



@endsection

