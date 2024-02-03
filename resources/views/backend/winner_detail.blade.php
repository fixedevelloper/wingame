@extends('backend.backend')
@section('title') detail winner @endsection
@section('content')
    <h3 class="account__head mb__30">
        Detail winner
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
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($list_items as $item)
                    @php
                        $fixture=\App\Helpers\Helpers::getFixture($item->lotto_fixture_item->fixture_id);

                         $team_home=\App\Helpers\Helpers::getTeamByID($fixture->team_home_id);
                         $team_away=\App\Helpers\Helpers::getTeamByID($fixture->team_away_id);
                          if ($fixture->score_ft_home<$fixture->score_ft_away){
                              $result=2;
                          }elseif ($fixture->score_ft_home>$fixture->score_ft_away){
                               $result=1;
                          }else{
                               $result=3;
                          }
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
                            {{$item->value}}
                        </td>
                        <td>
                            @if($result==$item->value)
                                <button class="btn btn-sm btn-success"><i class="fa fa-check-square"></i></button>
                            @else
                                <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

