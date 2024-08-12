@extends('over.base_over')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')

    <div class="row container">
        <h4> Match du Jours</h4>
        <div class="col-3 float-end">
            <form id="form_grille">
                <input name="date" type="date" value="{{$date}}" class="form-control m-2" id="grille_date">
            </form>
        </div>
    </div>
    <div class="row justify-content-center" id="card_league">
        @foreach($leagues as $league)
            @php
                $leag=\App\Helpers\Helpers::getLeague($league->league_id);
            @endphp
            <div class="card card-inner">
                <div class="card-header" id="{!! $league->league_id !!}">
                    <img width="50" height="50" src="{!! $leag->logo !!}"
                    >{!! $leag->name !!}
                </div>
                <div class="card-body" data-id="{{ $league->league_id }}" data-league="{{ $league->day_timestamp }}" id="card{{ $league->league_id }}">

               {{--         <div class="row">
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
                        </div>--}}

                </div>
            </div>
        @endforeach
    {{--    @foreach($leagues as $league)
            @php
                $leag=\App\Helpers\Helpers::getLeague($league->league_id);
                    $fixtures=\App\Helpers\Helpers::getFixtureByLeague($league->league_id,$date)
            //$fixtures=[];
            @endphp
            <div class="card card-inner">
                <div class="card-header" id="{!! $league->league_id !!}">
                    <img width="50" height="50" src="{!! $leag->logo !!}"
                    >{!! $leag->name !!}
                </div>
                <div class="card-body">
                    @foreach($fixtures as $lotto_fixture)
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
        @endforeach--}}
        <div class="mt-4">
           {{$leagues->links()}}
        </div>

    </div>
@endsection
@push("js")
    <script>
        jQuery(window).on('load',function () {
            'use strict';

            $(".card-body").each(function () {
                var currentEl=$(this)
                var id_card='#card'+$(this).data('id')
                $.ajax({
                    url: configs.routes.getgame_ajax,
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        id: $(this).data('id'),timestamp: $(this).data('league')}
                    ,
                    success: function (data) {
                        console.log(data)
                        $.each(data,function (index,value) {
                            var fixture_id=value.fixture_id;
                            var url = "{{ route('detail_fixture', ['id' => ':id']) }}";
                            url = url.replace(':id', fixture_id);
                           // url = url.replace(':slug', slug);

                            $(id_card).append('<div class="row"><div class="col-md-9">' +
                                '<div class="row">' +
                                ' <div class="col-md-9"><img width="50" height="20" src="'+value.team_home_logo+'">'+value.team_home_name+'</div>' +
                                '<div class="col-md-3">' +value.score_ft_home+'</div>' +
                                '</div>' +
                                '                                <div class="row">' +
                                '                                    <div class="col-md-9">' +
                                '                                        <img width="50" height="20" src="'+value.team_away_logo+'">'+value.team_away_name+'</div>' +
                                '                                    <div class="col-md-3">'+value.score_ft_away+'</div>' +
                                '                                </div>' +
                                '                            </div>' +
                                '                            <div class="col-md-3">' +
                                '                                <a class="btn btn-outline-dark" href='+url+'> Detail</a>' +
                                '                            </div>' +
                                '                        </div><hr>')
                        })
                                     },
                    error: function (err) {
                        alert("An error ocurred while loading data ...");

                    }
                });
            })
        });
    </script>
@endpush
