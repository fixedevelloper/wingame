@extends('over.base_over')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Tickets</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {!! sizeof($tickets) !!} Tickets.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a class="btn btn-outline-dark" href="#"  data-bs-toggle="modal" data-bs-target="#modalDefault"><span>Add New</span></a>
                    </li>
                </ul>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="title">All Tickets</h5>
                        </div>
                        <div class="card-tools me-n1">
                            <ul class="btn-toolbar">
                                <li>
                                    <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                </li><!-- li -->
                                <li class="btn-toolbar-sep"></li><!-- li -->

                            </ul><!-- .btn-toolbar -->
                        </div><!-- card-tools -->
                        <div class="card-search search-wrap" data-search="search">
                            <div class="search-content">
                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                <input type="text" class="form-control form-control-sm border-transparent form-focus-none" placeholder="Quick search by order id">
                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                            </div>
                        </div><!-- card-search -->
                    </div><!-- .card-title-group -->
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <table class="table table-orders">
                        <thead class="tb-odr-head">
                        <tr class="tb-odr-item">
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Code coupon</span>
                                <span class="tb-odr-date d-none d-md-inline-block">Date</span>
                            </th>
                            <th class="tb-odr-amount">
                                <span class="tb-odr-total">Image</span>
                            </th>
                            <th class="tb-odr-amount">
                                <span class="tb-odr-total">Image Result</span>
                            </th>
                            <th class="tb-odr-action">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody class="tb-odr-body">
                        @foreach($tickets as $ticket)
                        <tr class="tb-odr-item">
                            <td class="tb-odr-info">
                                <span class="tb-odr-id"><a href="#">{!! $ticket->numero !!}</a></span>
                                <span class="tb-odr-date">{!! $ticket->date !!}</span>
                            </td>
                            <td class="tb-odr-amount">
                              <a href="{!! asset('storage/'.$ticket->image) !!}" target="_blank">
                                  <img height="50" src="{!! asset('storage/'.$ticket->image) !!}">
                              </a>
                            </td>
                            <td class="tb-odr-amount">
                                <a href="{!! asset('storage/'.$ticket->image_result) !!}" target="_blank">
                                    <img height="50" src="{!! asset('storage/'.$ticket->image_result) !!}">
                                </a>
                            </td>
                            <td class="tb-odr-action">
                                <a href="{!! route('admin.updatetikets',['id'=>$ticket->id]) !!}" class="btn btn-outline-success">Add result</a>
                            </td>
                        </tr><!-- .tb-odr-item -->
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- .card-inner -->
                <div class="card-inner">
                    <ul class="pagination justify-content-center justify-content-md-start">
                        <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul><!-- .pagination -->
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

