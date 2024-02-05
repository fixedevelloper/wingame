@extends('backend.backend')
@section('title') Looto resultats @endsection
@section('content')
    <h3 class="account__head mb__30">
        Grille de match  {{$lotto->title}} du {{\Carbon\Carbon::parse($lotto->end_time)->format("d/m/Y")}}
    </h3>

    <div class="card card_dark mt-3">
        <div class="card-body">
            <table class="table text-white">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Team home</th>
                    <th>Team away</th>
                    <th>Score</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list_items as $item)
                    @php
                        $fixture=\App\Helpers\Helpers::getFixture($item->fixture_id);

                         $team_home=\App\Helpers\Helpers::getTeamByID($fixture->team_home_id);
                         $team_away=\App\Helpers\Helpers::getTeamByID($fixture->team_away_id);
                    @endphp
                    <tr>
                        <td>{{\Illuminate\Support\Carbon::parse($fixture->date)}}</td>
                        <td>
                            <h6>
                                <img height="40" width="40"
                                     src="{{$team_home['logo']}}">
                                {{$team_home['name']}}
                            </h6>
                        </td>
                        <td>
                            <h6>
                                <img height="40" width="40"
                                     src="{{$team_away['logo']}}">
                                {{$team_away['name']}}
                            </h6>
                        </td>
                        <td>
                            {{$fixture->score_ft_home}}-
                            {{$fixture->score_ft_away}}
                        </td>
                        <td>
                            @if($fixture->st_short !="NS")
                                @if($fixture->score_ft_home>$fixture->score_ft_away)
                                    1
                                @elseif($fixture->score_ft_home<$fixture->score_ft_away)
                                    2
                                @else
                                    3
                                @endif
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="card card_dark mt-3 text-white">
        <div class="card-header">
            <h3>List winners</h3>
        </div>
        <div class="card-body">
            <table class="table text-white" id="table_conbinaison">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Address</th>
                    <th>Match win</th>
                    <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach($winners as $winner)
                    <tr>
                        <td>{{$winner['user']}}</td>
                        <td>{{$winner['phone']}}</td>
                        <td>{{$winner['count']}} / {{sizeof($list_items)}}</td>
                        <td><a class="btn btn-success btn-sm" href="{{route("admin.winner_detail",['id'=>$winner['game_id']])}}">voir</a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
        <div class="card-footer">
            <div class="d-grid gap-2">
                <a class="btn btn-success" href="{{route('admin.payment',['id'=>$lotto->id])}}">Payement <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
@endsection

