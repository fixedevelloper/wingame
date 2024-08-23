@extends('over.base_over')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Scrappingresults</h3>
                <div class="nk-block-des text-soft">
                    <p>.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <!-- .nk-block-head-content -->
        </div>
        <div class="nk-block-head-content">
            <div class="search-content">
                <form method="POST">
                    @csrf
                    <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                    <input type="text" name="search" class="form-control form-control-sm border-transparent form-focus-none" placeholder="Url search by pronos">
                    <button type="submit" class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                </form>

            </div>
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card-inner-group">
        </div><!-- .card-inner-group -->
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="title">Fixtures</h5>
                        </div>
                    </div><!-- .card-title-group -->
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <table class="table table-orders">
                        <thead class="tb-odr-head">
                        <tr class="tb-odr-item">
                            <th class="tb-odr-info">
                                <span class="tb-odr-id"></span>
                            </th>
                            <th class="tb-odr-amount">
                                <span class="tb-odr-total">MrLogique</span>
                            </th>
                            <th class="tb-odr-amount">
                                <span class="tb-odr-total">Mr surprises</span>
                            </th>
                            <th class="tb-odr-amount">
                                <span class="tb-odr-total">Mr Domicile</span>
                            </th>
                            <th class="tb-odr-amount">
                                <span class="tb-odr-total">Mr nul</span>
                            </th>
                            <th class="tb-odr-amount">
                                <span class="tb-odr-total">Mr Exterieur</span>
                            </th>

                            <th class="tb-odr-action">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody class="tb-odr-body">
                        @for($i=0;$i<sizeof($lines);$i++)
                            <tr>
                                <td>{{$lines[$i]['home']}}-{{$lines[$i]['away']}}</td>
                                <td>{{$lines[$i]['logique']}}</td>
                                <td>{{$lines[$i]['surprises']}}</td>
                                <td>{{$lines[$i]['domicile']}}</td>
                                <td>{{$lines[$i]['nul']}}</td>
                                <td>{{$lines[$i]['exterieur']}}</td>

                            </tr>
                        @endfor

                        </tbody>
                    </table>
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
    <!-- Modal Content Code -->
@endsection

