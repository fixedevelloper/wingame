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
           {{-- <div class="card card_dark">
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
            </div>--}}
            <div class="card card_dark">
                <div class="card-header">
                    <h4>Confrontations a domicile</h4>
                </div>
                <div class="card-body game">
                    <div class="card-inner">
                        <ul class="nav nav-tabs mt-n3">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Matchs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Statistiques</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabItem1">
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
                            <div class="tab-pane" id="tabItem2">
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
                    </div>

                </div>
            </div>
            <div class="card card_dark">
                <div class="card-header">
                    <h4>Deniers Matchs de l'equipe a domicile</h4>
                </div>
                <div class="card-body game">
                    <div class="card-inner">
                    <ul class="nav nav-tabs mt-n3">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tabAway1">Matchs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabAway2">Statistiques</a>
                        </li>

                    </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabAway1">
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
                            <div class="tab-pane" id="tabAway2">
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
                                        @if(sizeof($fixure_last_home)==0)
                                            <td colspan="3" class="text-center"> No data</td>
                                        @else
                                            <td>{!! $v_h_l !!} ({!! round(($v_h_l/sizeof($fixure_last_home))*100,2) !!} %)</td>
                                            <td>{!! $other_l !!} ({!! round(($other_l/sizeof($fixure_last_home))*100,2) !!} %)</td>
                                            <td>{!! $v_a_l !!} ({!! round(($v_a_l/sizeof($fixure_last_home))*100,2) !!} %)</td>
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
                                        <td>{!! $over_05_l !!}</td>
                                        <td>{!! $over_15_l !!}</td>
                                        <td>{!! $over_25_l !!}</td>
                                        <td>{!! $over_35_l !!}</td>
                                        <td>{!! $over_45_l !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card card_dark">
                <div class="card-header">
                    <h4>Deniers matchs de l'equipe exterieur</h4>
                </div>
                <div class="card-body game">
                    <div class="card-inner">
                        <ul class="nav nav-tabs mt-n3">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tabLast1">Matchs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabLast2">Statistiques</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabLast1">
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
                            <div class="tab-pane" id="tabLast2">
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
                                        @if(sizeof($fixure_last_away)==0)
                                            <td colspan="3" class="text-center"> No data</td>
                                        @else
                                            <td>{!! $v_h_a !!} ({!! round(($v_h_a/sizeof($fixure_last_away))*100,2) !!} %)</td>
                                            <td>{!! $other_a !!} ({!! round(($other_a/sizeof($fixure_last_away))*100,2) !!} %)</td>
                                            <td>{!! $v_a_a !!} ({!! round(($v_a_a/sizeof($fixure_last_away))*100,2) !!} %)</td>
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
                                        <td>{!! $over_05_a !!}</td>
                                        <td>{!! $over_15_a !!}</td>
                                        <td>{!! $over_25_a !!}</td>
                                        <td>{!! $over_35_a !!}</td>
                                        <td>{!! $over_45_a !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

