@extends('over.base_over')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')

    <div class="row container">
        <h4> Fixtures Over 6.5</h4>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card card_dark">
                <div class="card-body game">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Team H</th>
                            <th>Team A</th>
                            <th>Over</th>
                            <th>Score</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fixtures as $lotto_fixture)
                            @php
                                $fixture=\App\Helpers\Helpers::getFixture($lotto_fixture->fixture_id)
                            @endphp
                            <tr>
                                <td></td>
                                <td>
                                    {!! $fixture->team_home_name !!}
                                </td>
                                <td>
                                    {!! $fixture->team_away_name !!}
                                </td>
                                <td>
                                    {!! $lotto_fixture->value !!}
                                </td>
                                <td>
                                    {!! $fixture->score_ft_home !!} -  {!! $fixture->score_ft_away !!}
                                </td>
                                <td></td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>


                    {{--   <div class="height__table">
                           <div class="main__table">
                               <div class="table__wrap">
                               <div class="table__items b__bottom">
                                   <div class="t__items">
                                       <div class="t__items__left text-end">
                                           <h6>
                                               <img height="40"
                                                    src="{{asset("images/ballon-football-enveloppe-flammes-bleues-fumee-noire.jpg")}}">
                                               Real madrid
                                           </h6>
                                       </div>

                                   </div>
                                   <div class="mart__point__items">
                                       <a href="javascript:void(0);" class="point__box">
                                           <input type="checkbox" name="fixure" value="1" id="check1">
                                           <label for="check1">
                                               <span class="break">1</span>
                                               <div><i class="fa fa-check"></i></div>
                                           </label>

                                       </a>
                                       <a href="javascript:void(0);" class="point__box">
                                           <input type="checkbox" name="fixure" value="3" id="check3">
                                           <label for="check3">
                                               <span class="break">x</span>
                                               <div>   <i class="fa fa-check"></i></div>
                                           </label>

                                       </a>
                                       <a href="javascript:void(0);" class="point__box">
                                           <input type="checkbox" name="fixure" value="2" id="check2">
                                           <label for="check2">
                                               <span class="break">2</span>
                                               <div><i class="fa fa-check"></i></div>
                                           </label>

                                       </a>
                                   </div>
                                   <div class="t__items">
                                       <div class="t__items__left">
                                           <h6>
                                               <img height="40"
                                                    src="{{asset("images/ballon-football-enveloppe-flammes-bleues-fumee-noire.jpg")}}">
                                               Real madrid
                                           </h6>
                                       </div>

                                   </div>
                               </div>
                               </div>
                           </div>

                       </div>
                       <div class="d-grid gap-2 mt-3">
                           <a class="btn btn-outline-success btn-lg btn-block"> Valider</a>
                       </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push("script")
    <script>
        jQuery(window).on('load',function () {
            'use strict';
            lotto.getBalance();
        });
    </script>
@endpush
