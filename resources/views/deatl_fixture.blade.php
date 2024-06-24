@extends('over.base_over')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')

    <div class="row container">
       <div class="col-md-5 text-end">
           <div class="text-center">
               <img width="80"  src="{!! $fixture->team_home_logo !!}"
               >
               <h5 class="mt-1">  {!! $fixture->team_home_name !!}</h5>
           </div>


       </div>
        <div class="col-md-2 text-center">
            <p class="h5 text-danger mb-3">{!! \Carbon\Carbon::parse($fixture->date)->format("D , d,M,Y") !!}</p>
          <p class="h4">
              <span class="badge badge-circle bg-danger"><span class="h5 text-white">{!! $fixture->score_ft_home !!}</span></span> - <span class="badge badge-circle bg-danger"><span class="h5 text-white">{!! $fixture->score_ft_away !!}</span></span>
          </p>
        </div>
        <div class="col-md-5">
            <div class="text-center">
            <img width="80" src="{!! $fixture->team_away_logo !!}"
            >
           <h5 class="mt-1"> {!! $fixture->team_away_name !!}</h5>
            </div>
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
                            <th>V. Exterieur</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @if(sizeof($response)==0)
                                <td colspan="3" class="text-center"> No data</td>
                            @else
                            <td>{!! $v_h !!} ({!! round(($v_h/sizeof($response))*100,2) !!} %)</td>
                            <td>{!! $other !!} ({!! round(($other/sizeof($response))*100,2) !!} %)</td>
                            <td>{!! $v_a !!} ({!! round(($v_a/sizeof($response))*100,2) !!} %)</td>
                            @endif
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
                    <h4>Confrontations a domicile</h4>
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
                        @foreach($response as  $item)
                        <tr>
                            <td>{!! \Carbon\Carbon::parse($item->date)->format("Y-m-d") !!}</td>
                            <td><img src="{!! $item->team_home_logo !!}" width="50" height="40"> {!! $item->team_home_name !!}</td>
                            <td><img src="{!! $item->team_away_logo !!}" width="50" height="40">{!! $item->team_away_name !!}</td>
                            <td>{!!  $item->score_ft_home !!} - {!!  $item->score_ft_away !!} </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card card_dark">
                <div class="card-header">
                    <h4>Deniers Matchs de l'equipe a domicile</h4>
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
                        @foreach($fixure_last_home as  $item)
                            <tr>
                                <td>{!! \Carbon\Carbon::parse($item->date)->format("Y-m-d") !!}</td>
                                <td><img src="{!! $item->team_home_logo !!}" width="50" height="40"> {!! $item->team_home_name !!}</td>
                                <td><img src="{!! $item->team_away_logo !!}" width="50" height="40">{!! $item->team_away_name !!}</td>
                                <td>{!!  $item->score_ft_home !!} - {!!  $item->score_ft_away !!} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card card_dark">
                <div class="card-header">
                    <h4>Deniers matchs de l'equipe exterieur</h4>
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
                        @foreach($fixure_last_away as  $item)
                            <tr>
                                <td>{!! \Carbon\Carbon::parse($item->date)->format("Y-m-d") !!}</td>
                                <td><img src="{!! $item->team_home_logo !!}" width="50" height="40"> {!! $item->team_home_name !!}</td>
                                <td><img src="{!! $item->team_away_logo !!}" width="50" height="40">{!! $item->team_away_name !!}</td>
                                <td>{!!  $item->score_ft_home !!} - {!!  $item->score_ft_away !!} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

