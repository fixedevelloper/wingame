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
        <div class="col-md-10 mt-5">
            <div class="card card_dark">
                <div class="card-body game">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Team H</th>
                            <th>Team A</th>
                            <th>Score</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fixtures as $lotto_fixture)
                            @php
                              //  $fixture=\App\Helpers\Helpers::getFixture($lotto_fixture->fixture_id)
                            @endphp
                            <tr>
                                <td></td>
                                <td>
                                    <img width="50" height="20" src="{!! $lotto_fixture->team_home_logo !!}"
                                    >
                                    {!! $lotto_fixture->team_home_name !!}
                                </td>
                                <td>
                                    <img width="50" height="50" src="{!! $lotto_fixture->team_away_logo !!}"
                                    >
                                    {!! $lotto_fixture->team_away_name !!}
                                </td>
                                <td>
                                    {!! $lotto_fixture->score_ft_home !!} -  {!! $lotto_fixture->score_ft_away !!}
                                </td>
                                <td>
                                    <a class="btn btn-outline-dark" href="{!! route('detail_fixture',['id'=>$lotto_fixture->id]) !!}"> Detail</a>
                                </td>
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
    <script>
        jQuery(window).on('load',function () {
            'use strict';
            lotto.getBalance();
        });
    </script>
@endpush
