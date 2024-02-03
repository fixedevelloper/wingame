@extends('base')

@section('content')
    <div class="container-fluid">
        <div class="card card_dark mt-3 text-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <form>
                            <input name="date" hidden type="date" value="{{$date}}" class="form-control m-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="">
                                        <label class="form-label"></label>
                                        <select name="filter" class="form-select">
                                            <option value="ratio_for">Ratio for</option>
                                            <option value="ratio_against">Ratio Against</option>
                                            <option value="ratio_a_b_for">Ratio A-B For</option>
                                            <option value="ratio_a_b_against">Ratio A-B Against</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input name="percent" class="form-control" id="percent" placeholder="0.2">
                                        <button type="submit" class="input-group-text bg-gradient">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form id="form_ontheday">
                            <input name="date" id="date_ontheday" type="date" value="{{$date}}"
                                   class="form-control m-2">
                        </form>
                    </div>
                </div>
            </div>
            <div class="card card_dark mt-3 text-white">
                <div class="card-body">
                    <table class="table table-bordered text-white">
                        <thead>
                        <tr>
                            <th>TeamA</th>
                            <th>MP</th>
                            <th>B</th>
                            <th>Ratio For</th>
                            <th>Ratio Against</th>
                            <th>Score Fixture</th>
                            <th>TeamB</th>
                            <th>MP</th>
                            <th>B</th>
                            <th>Ratio For</th>
                            <th>Ratio Against</th>
                            <th>A-B (Ratio For)</th>
                            <th>A-B (Ratio Against)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fixtures as $fixture)

                            @php
                                $standing_home=\App\Helpers\Helpers::rankTeam($fixture);
                                $standing_away=\App\Helpers\Helpers::rankTeamAway($fixture);
                                $team_home=\App\Helpers\Helpers::getTeamByID($fixture->team_home_id);
                                $team_away=\App\Helpers\Helpers::getTeamByID($fixture->team_away_id);
                                $ratio=App\Helpers\Helpers::calculRatio($fixture);
                                $mp_b=0;
                                $mp_a=0;
                                $ratio_a_b_for=0;
                                $ratio_a_b_against=0;
                                $ratio_f_a=0;
                                 $ratio_f_b=0;
                                 $ratio_ag_a=0;
                                 $ratio_ag_b=0;
                                if ($standing_home){
                                    $last_home_="";
                                if (strlen($standing_home->form)>0){
                                    $last_home=str_split($standing_home->form);
                                    $last_home_=$last_home[0];
                                }
                                $mp_a=$standing_home['home_played'] + $standing_home['away_played'];
                                $ratio_f_a=round(($standing_home['goal_home_for'] + $standing_home['goal_away_for']) / ($mp_a),2);
                                $ratio_ag_a=round(($standing_home['goal_home_against'] + $standing_home['goal_away_against']) / ($mp_a),2);
                                }
                                if ($standing_away){
                                    $last_away_="";
                                    if (strlen($standing_away->form)>0){
                                    $last_away=str_split($standing_away->form);
                                    $last_away_=$last_away[0];
                                }
                                     $mp_b=$standing_away['home_played'] + $standing_away['away_played'];
                                     $ratio_f_b=round(($standing_away['goal_home_for'] + $standing_away['goal_away_for']) / ($mp_b),2);
                                     $ratio_ag_b=round(($standing_away['goal_home_against'] + $standing_away['goal_away_against']) / ($mp_b),2);

                                }
                                $ratio_a_b_for=$ratio_f_a-$ratio_f_b;
                                $ratio_a_b_against=$ratio_ag_a-$ratio_ag_b;
                            @endphp
                            <tr>
                                <td><img height="20" src=" {{$team_home['logo']}}"><span>{{$team_home['name']}}</span>
                                </td>
                                <td>{{ is_null($standing_home)?'-':($standing_home['home_played'] + $standing_home['away_played'])}}</td>
                                <td>{{is_null($standing_home)?'-':($standing_home['goal_home_for'] + $standing_home['goal_away_for'])}}
                                    :{{is_null($standing_home)?'-':($standing_home['goal_home_against'] + $standing_home['goal_away_against'])}}</td>
                                <td>{{$ratio['ratio_a_for']}}</td>
                                <td>{{$ratio['ratio_a_against']}}</td>
                                <td class="text-center">{{$fixture->goal_home}}- {{$fixture->goal_away}}</td>
                                <td>
                                    <img height="20" src=" {{$team_away['logo']}}" alt=""><span> {{$team_away['name']}}
                    </span>
                                </td>
                                <td>{{is_null($standing_away)?'-':($standing_away['home_played'] + $standing_away['away_played'])}}</td>
                                <td>{{is_null($standing_away)?'-':($standing_away['goal_home_for'] + $standing_away['goal_away_for'])}}
                                    :{{is_null($standing_away)?'-':($standing_away['goal_home_against'] + $standing_away['goal_away_against'])}}</td>
                                <td>{{$ratio['ratio_b_for']}}</td>
                                <td>{{$ratio['ratio_b_against']}}</td>
                                <td class="@if($ratio['ratio_a_b_for']>0) bg-success @else bg-danger @endif">
                                    <span>{{$ratio['ratio_a_b_for']}}</span></td>
                                <td class="@if($ratio['ratio_a_b_against']>0) bg-success @else bg-danger @endif">
                                    <span>{{$ratio['ratio_a_b_against']}}</span></td>
                             {{--   <td>{{$fixture->league_id}}</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card-footer">
                    {!! $fixtures->links() !!}
                </div>
            </div>
        </div>

@endsection
