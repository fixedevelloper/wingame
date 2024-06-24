@extends('over.base_over')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')

    <div class="row container">
        <h4> Score exactes</h4>
        <div class="col-3 float-end">
            <form id="form_grille">
                <input name="date"  type="date" value="{{$date}}" class="form-control m-2" id="grille_date">
            </form>
        </div>
    </div>
    <div class="row justify-content-center">

        @foreach($leagues as $league)
            @php
                $leag=\App\Helpers\Helpers::getLeague($league->league_id);
                    $fixtures=\App\Helpers\Helpers::getFixtureByLeague($league->league_id,$date)
            @endphp
            <div class="card card-inner">
                <div class="card-header" id="{!! $league->league_id !!}">
                    <img width="50" height="50" src="{!! $leag->logo !!}"
                    >{!! $leag->name !!}
                </div>
                <div class="card-body">
                    @foreach($fixtures as $lotto_fixture)
                        @php
                            $fixture=\App\Helpers\Helpers::getFixture($lotto_fixture->fixture_id)
                        @endphp
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-9">
                                    <div>
                                        <img width="50" height="20" src="{!! $lotto_fixture->team_home_logo !!}"
                                        >
                                        {!! $lotto_fixture->team_home_name !!}
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    {!! $lotto_fixture->score_ft_home !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <img width="50" height="20" src="{!! $lotto_fixture->team_away_logo !!}"
                                    >
                                    {!! $lotto_fixture->team_away_name !!}
                                </div>
                                <div class="col-md-3">
                                    {!! $lotto_fixture->score_ft_away !!}
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-outline-dark" href="{!! route('detail_fixture',['id'=>$lotto_fixture->id]) !!}"> Detail</a>
                        </div>
                    </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        @endforeach
        <div class="mt-4">
           {{-- {{$leagues->links()}}--}}
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
