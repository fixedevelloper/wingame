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
                    <table class="table table-orders" id="table_scrape">
                        <thead class="tb-odr-head">
                        <tr class="tb-odr-item">
                            <th class="">
                                <span class="tb-odr-id"></span>
                            </th>
                            <th class="">
                                <span class="tb-odr-total">MrLogique</span>
                            </th>
                            <th class="">
                                <span class="">Mr surprises</span>
                            </th>
                            <th class="">
                                <span class="tb-odr-total">Mr Domicile</span>
                            </th>
                            <th class="">
                                <span class="tb-odr-total">Mr nul</span>
                            </th>
                            <th class="">
                                <span class="tb-odr-total">Mr Exterieur</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="tb-odr-body">
                        @for($i=0;$i<sizeof($lines);$i++)
                            <tr>
                                <td>{{$lines[$i]['home']}}-{{$lines[$i]['away']}}</td>
                                <td>
                                    <select>
                                        <option>1</option>
                                        <option>N</option>
                                        <option>2</option>
                                        <option>12</option>
                                    </select>
                                </td>
                                <td> <select>
                                        <option>1</option>
                                        <option>N</option>
                                        <option>2</option>
                                        <option>12</option>
                                    </select>
                                </td>
                                <td> <select>
                                        <option>1</option>
                                        <option>N</option>
                                        <option>2</option>
                                        <option>12</option>
                                    </select>
                                </td>
                                <td>
                                    <select>
                                        <option>1</option>
                                        <option>N</option>
                                        <option>2</option>
                                        <option>12</option>
                                    </select>
                                </td>
                                <td> <select>
                                        <option>1</option>
                                        <option>N</option>
                                        <option>2</option>
                                        <option>12</option>
                                    </select>
                                </td>

                            </tr>
                        @endfor

                        </tbody>
                    </table>
                </div><!-- .card-inner -->
                <div class="card-footer">
                    <input class="form-control" id="date" type="date">
                    <button class="btn btn-primary mt-3" id="save_scrape">save</button>
                </div>
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
    <!-- Modal Content Code -->
@endsection
@push('js')
    <script>
        $(function () {
            $("#save_scrape").click(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                jsonObj = [];
                $("#table_scrape>tbody>tr").each(function () {
                    var row = $(this).closest('tr')[0];
                    var home= row.cells[0].innerText;
                    var away= row.cells[2].children[0].value;
                    var logique= row.cells[1].children[0].value;
                    var suprise= row.cells[2].children[0].value;
                    var domicile= row.cells[3].children[0].value;
                    var nul= row.cells[4].children[0].value;
                    var exterieur= row.cells[5].children[0].value;
                    item = {};
                    item['date'] = "";
                    item['home'] =home;
                      item['away'] = away;
                      item['logique'] = logique;
                    item['suprise'] = suprise;
                    item['domicile'] = domicile;
                    item['nul'] = nul;
                    item['exterieur'] = exterieur;
                    jsonObj.push(item)
                });
                console.log(JSON.stringify({data: jsonObj}))
                $.ajax({
                    url: "{{ route('scrapper_save') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: JSON.stringify({
                        ob: jsonObj, }),
                    success: function (data) {
                        toastr.success('Operation executed successfully', 'Success')
                        window.location.reload()
                    },
                    error: function (err) {
                        toastr.error('An error has occurred' + JSON.stringify((err)),'Error')

                        setTimeout(function () {
                            $("#overlay").fadeOut(300);
                        }, 500);
                    }
                });
            })
        });
    </script>
@endpush

