@extends('base')
@section('title')  @endsection
@section('content')
    <span id="address" hidden>{{$address}}</span>
    <span id="lotto_fixture_id" hidden>{{$lotto->id}}</span>
    <div class="row mt-3">
        <div class="card card_dark text-white">
            <div class="card-body text-center">
       <h2 class="text-white text-center">Lotto N°{{$lotto->id}}
           @if($is_then==1)
               <span class="text-danger text-opacity-100">closed</span>
           @endif</h2>

                <h2 class="text-white text-center text-uppercase">{{$lotto->title}} of {{\Carbon\Carbon::parse($lotto->end_time)->format("d/m/Y")}}</h2>
                <h6>End of validation : <span>{{$lotto->end_time }}</span></h6>
                <div class="mt-3">
                    @if($is_then==1)
                        <a class="btn btn-outline-danger btn-lg btn-block" href="{{route("resultat",['id'=>$lotto->id])}}"> Results</a>
                   @endif
                </div>
                {{--<h6>Fin de validation dans : <span  class="wrap-countdown mercado-countdown" data-expire="{{ Carbon\Carbon::parse($lotto->end_time)->format('Y/m/d h:i:s') }}"></span></h6>--}}
            </div>
        </div>
</div>
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card card_dark">
                <div class="card-body">
                    <div class="height__table">
                        <div class="main__table">
                            <div class="table-responsive">
                                <table class="table table__wrap text-white" id="table_game">
                                    <tbody>
                                    @foreach($fixtures as $item)
                                        @php
                                            $fixture=\App\Helpers\Helpers::getFixture($item->fixture_id);

                                             $team_home=\App\Helpers\Helpers::getTeamByID($fixture->team_home_id);
                                             $team_away=\App\Helpers\Helpers::getTeamByID($fixture->team_away_id);
                                        @endphp
                                        <tr class="table__items b__bottom">
                                            <td width="30%">
                                                <span hidden>{{$item->id}}</span>
                                                <span hidden>{{$fixture->fixture_id}}</span>
                                                <h6>
                                                    <img height="40" width="60"
                                                         src="{{$team_home['logo']}}">
                                                    {{$team_home['name']}}
                                                </h6>
                                            </td>
                                            <td width="40%">
                                                <div class="mart__point__items">
                                                    <a href="javascript:void(0);" class="point__box">
                                                        <input type="radio" name="{{$fixture->fixture_id}}" value="1" id="check1{{$item->id}}">
                                                        <label for="check1{{$item->id}}">
                                                            <span class="break">1</span>
                                                            <div><i class="fa fa-check"></i></div>
                                                        </label>

                                                    </a>
                                                    <a href="javascript:void(0);" class="point__box">
                                                        <input type="radio" name="{{$fixture->fixture_id}}" value="3" id="check3{{$item->id}}">
                                                        <label for="check3{{$item->id}}">
                                                            <span class="break">x</span>
                                                            <div>   <i class="fa fa-check"></i></div>
                                                        </label>

                                                    </a>
                                                    <a href="javascript:void(0);" class="point__box">
                                                        <input type="radio" name="{{$fixture->fixture_id}}" value="2" id="check2{{$item->id}}">
                                                        <label for="check2{{$item->id}}">
                                                            <span class="break">2</span>
                                                            <div><i class="fa fa-check"></i></div>
                                                        </label>

                                                    </a>
                                                </div>
                                            </td>
                                            <td  width="30%">
                                                <h6>
                                                    <img height="40"
                                                         src="{{$team_away['logo']}}">
                                                    {{$team_away['name']}}
                                                </h6>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                    <div class="d-grid gap-2 mt-3">
                        @if($is_then==1)
                            <a class="btn btn-outline-primary btn-lg btn-block" href="{{route("resultat",['id'=>$lotto->id])}}"> Results</a>
                        @else
                            <a class="btn btn-outline-success btn-lg btn-block" id="send_conbinaiso" onclick="lotto.sendLottery()"><i class="fa fa-spinner fa-spin" id="spinner_send"></i> Send</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("script")

    <script>

        $("#send_conbinaison").click(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            jsonObj = [];
            $("#table_game>tbody>tr").each(function () {
                var row = $(this).closest('tr')[0];
                var id = row.cells[0].children[0].innerText;
                var id_ = row.cells[0].children[1].innerText;
                var value1= row.cells[1].children[0].children[0].children[0].checked;
                var value2= row.cells[1].children[0].children[1].children[0].checked;
                var value3= row.cells[1].children[0].children[2].children[0].checked;
                item = {};
                item['id'] = id;
                item['value'] = $('input[name="'+id_+'"]:checked').val();
              /*  item['value2'] = value2;
                item['value3'] = value3;*/
                jsonObj.push(item)
            });
            console.log(JSON.stringify({data: jsonObj}))
            $.ajax({
                url: "{{ route('postGame') }}",
                type: "POST",
                dataType: "JSON",
                data: JSON.stringify({
                    ob: jsonObj, address: $('#address').text(),lotto_fixture_id:$('#lotto_fixture_id').text()}),
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
    </script>
@endpush
