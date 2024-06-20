@extends('over.base_over')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')

    <div class="row container">
       <div class="col-md-6">

           {!! $fixture->team_home_name !!}
           <img width="80"  src="{!! $fixture->team_home_logo !!}"
           >
       </div>
        <div class="col-md-6">
            <img width="80" src="{!! $fixture->team_away_logo !!}"
            >
            {!! $fixture->team_away_name !!}
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 mt-5">
            <div class="card card_dark">
                <div class="card-header">
                    <h4>Statitisques</h4>
                </div>
                <div class="card-body game">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>V.{!! $fixture->team_home_name !!}</th>
                            <th>Match null</th>
                            <th>V.{!! $fixture->team_away_name !!}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{!! $v_h !!}</td>
                            <td>{!! $other !!}</td>
                            <td>{!! $v_a !!}</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Over 0.5</th>
                            <th>Over 1.5</th>
                            <th>Over 2.5</th>
                            <th>Over 3.5</th>
                            <th>Over 4.5</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{!! $over_05 !!}</td>
                            <td>{!! $over_15 !!}</td>
                            <td>{!! $over_25 !!}</td>
                            <td>{!! $over_35 !!}</td>
                            <td>{!! $over_45 !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card card_dark">
                <div class="card-header">
                    <h4>Confrontations</h4>
                </div>
                <div class="card-body game">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Team Home</th>
                            <th>Team Away</th>
                            <th>Score</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i = 0; $i < sizeof($response); $i++)
                        <tr>
                            <td>{!! \Carbon\Carbon::parse($response[$i]->fixture->date)->format("Y-m-d") !!}</td>
                            <td><img src="{!! $response[$i]->teams->home->logo !!}" width="50" height="40"> {!! $response[$i]->teams->home->name !!}</td>
                            <td><img src="{!! $response[$i]->teams->away->logo !!}" width="50" height="40">{!! $response[$i]->teams->away->name !!}</td>
                            <td>{!!  $response[$i]->score->fulltime->home !!} - {!!  $response[$i]->score->fulltime->away !!} </td>
                        </tr>
                        @endfor
                        </tbody>
                    </table>

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
