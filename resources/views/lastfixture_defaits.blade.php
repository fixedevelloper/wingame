@extends('over.base_over')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')

    <div class="row container">
        <h4> Match des equipes n'ayant pas perdu </h4>
        <div class="col-3 float-end">
            <form id="form_grille">
                <input name="date"  type="date" value="{{$date}}" class="form-control m-2" id="grille_date">
            </form>
        </div>
    </div>
    <div class="row justify-content-center">

            <div class="card card-inner">

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Team</th>
                            <th>Country</th>
                            <th>Fixture</th>
                            <th>Stats</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teams as $item)
                            @php
                                $team=App\Helpers\Helpers::getTeamByID($item->team_id)
                            @endphp
                            <tr>
                                <td> <img width="50" height="50" src="{!! $team['logo'] !!}"
                                    >{{ $team['name'] }}</td>
                                <td>{{ $team['country'] }}</td>
                                <td><a class="btn btn-primary" href="{{ route('detail_fixture',['id'=>$item->fixture_id]) }}">Detail</a></td>
                                <td></td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>
                    <div class="mt-4">
                        {{$teams->links()}}
                    </div>
                </div>
            </div>


    </div>
@endsection

