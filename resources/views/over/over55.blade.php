@extends('over.base_over')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')

    <div class="row container">
<h4> Fixtures Over 5.5</h4>
        <i class="icon ni ni-arrow-up"></i>
        <div class="col-3 float-end">
            <form id="form_grille">
                <input name="date"  type="date" value="{{$date}}" class="form-control m-2" id="grille_date">
            </form>
        </div>
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
                                <img width="50" height="20" src="{!! $fixture->team_home_logo !!}"
                                >
                                {!! $fixture->team_home_name !!}
                            </td>
                            <td>
                                <img width="50" height="50" src="{!! $fixture->team_away_logo !!}"
                                >
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
                    {{$fixtures->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push("script")

@endpush
