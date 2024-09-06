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
                <div class="card-body" data-id="{{ $league->league_id }}" data-league="{{ $league->day_timestamp }}"
                     id="card{{ $league->league_id }}">

                    <div class="ph-item" id="ph{{ $league->league_id }}">
                            <div class="ph-row">
                                <div class="ph-col-7 big">
                                    <div class="ph-row">
                                        <div class="ph-col-9">
                                            <div class="ph-col-2">
                                                <div class="ph-picture"></div>
                                            </div>
                                            <div class="ph-col-10 big"></div>
                                        </div>
                                        <div class="ph-col-3"></div>
                                    </div>
                                </div>
                                <div class="ph-col-2 empty big"></div>
                                <div class="ph-col-2 big"></div>
                            </div>
                        <div class="ph-col-12">
                            <div class="ph-picture"></div>
                            <div class="ph-row">
                                <div class="ph-col-6 big"></div>
                                <div class="ph-col-4 empty big"></div>
                                <div class="ph-col-2 big"></div>
                                <div class="ph-col-4"></div>
                                <div class="ph-col-8 empty"></div>
                                <div class="ph-col-6"></div>
                                <div class="ph-col-6 empty"></div>
                                <div class="ph-col-12"></div>
                            </div>
                        </div>
                        </div>

                </div>
            </div>
        @endforeach
        <div class="mt-4">
            {{$leagues->links()}}
        </div>

    </div>
@endsection
@push("js")
    <script>
        jQuery(window).on('load', function () {
            'use strict';

            $(".card-body").each(function () {
                var currentEl = $(this)
                var id_card = '#card' + $(this).data('id')
                var id_ph = '#ph' + $(this).data('id')
                $.ajax({
                    url: configs.routes.getgame_ajax,
                    async: true,
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        id: $(this).data('id'), timestamp: $(this).data('league')
                    }
                    ,
                    success: function (data) {
                        console.log(data)
                        $(id_ph).hide()
                        $.each(data, function (index, value) {
                            var fixture_id = value.id;
                            var url = "{{ route('detail_fixture', ['id' => ':id']) }}";
                            url = url.replace(':id', fixture_id);
                            var sfH = value.score_ft_home == null ? '-' : value.score_ft_home;
                            var sfA = value.score_ft_away == null ? '-' : value.score_ft_away;
                            var variation_span=value.variation_home_st>0?'<i class="icon ni ni-arrow-up"></i>':value.variation_home_st<0?'<i class="icon ni ni-arrow-down"></i>':'<i class="icon ni ni-arrow-right"></i>'
                            var variation_span_draw=value.variation_draw_st>0?'<i class="icon ni ni-arrow-up"></i>':value.variation_draw_st<0?'<i class="icon ni ni-arrow-down"></i>':'<i class="icon ni ni-arrow-right"></i>'
                            var variation_span_away=value.variation_away_st>0?'<i class="icon ni ni-arrow-up"></i>':value.variation_away_st<0?'<i class="icon ni ni-arrow-down"></i>':'<i class="icon ni ni-arrow-right"></i>'

                            $(id_card).append('<div class="row">' +
                                '<div class="col-md-5">' +
                                '<div class="row">' +
                                ' <div class="col-md-9"><img width="50" height="20" src="' + value.team_home_logo + '">' + value.team_home_name + '</div>' +
                                '<div class="col-md-3">' + sfH + '</div>' +
                                '</div>' +
                                '                                <div class="row">' +
                                '                                    <div class="col-md-9">' +
                                '                                        <img width="50" height="20" src="' + value.team_away_logo + '">' + value.team_away_name + '</div>' +
                                '                                    <div class="col-md-3">' + sfA + '</div>' +
                                '                                </div>' +
                                '                            </div>' +
                                '                            <div class="col-md-4">' +
                                '                              <span class="badge  bg-success">'+value.variation_home+variation_span+'</span> <span class="btn btn-success">'+value.odd_home+'</span> '+
                                ' <span class="badge  bg-dark">'+value.variation_draw+variation_span_draw+'</span> <span class="btn btn-danger"> '+value.odd_draw+'</span> '+' <span class="badge  bg-success">'+value.variation_away+variation_span_away+'</span> <span class="btn btn-success">'+value.odd_away+'</span> '+
                                '                            </div>' +
                                '<div class="col-md-3">' +
                                '                                <a class="btn btn-outline-dark" href=' + url + '> Detail</a>' +
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
