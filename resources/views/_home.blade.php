@extends('over.base_over')
@section('title')  @endsection
@push("scripts")
    <style>
        .game ol {
            list-style: none;
            counter-reset: list;
            padding: 0 1rem;
        }

        .game li {
            --stop: calc(100% / var(--length) * var(--i));
            --l: 62%;
            --l2: 88%;
            --h: calc((var(--i) - 1) * (180 / var(--length)));
            --c1: hsl(var(--h), 71%, var(--l));
            --c2: hsl(var(--h), 71%, var(--l2));

            position: relative;
            counter-increment: list;
            max-width: 45rem;
            margin: 0.5rem auto;
            padding: 1rem 1rem 1rem;
            box-shadow: 0.1rem 0.1rem 1.5rem rgba(0, 0, 0, 0.3);
            border-radius: 0.25rem;
            overflow: hidden;
            background-color: white;
        }

        .game li::before {
            content: '';
            display: block;
            width: 100%;
            height: 1rem;
            position: absolute;
            top: 0;
            left: 0;
            background: linear-gradient(to right, var(--c1) var(--stop), var(--c2) var(--stop));
        }

        .game h3 {
            display: flex;
            align-items: baseline;
            margin: 0 0 1rem;
            color: rgb(70 70 70);
        }

        .game h3::before {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 0 0 auto;
            margin-right: 1rem;
            width: 2rem;
            height: 2rem;
            content: counter(list);
            padding: 1rem;
            border-radius: 50%;
            background-color: var(--c1);
            color: white;
        }

        @media (min-width: 40em) {
            .game li {
                margin: 1rem auto;
                padding: 2rem 1rem 1rem;
            }

            .game h3 {
                font-size: 1.25rem;
                margin: 0 0 2rem;
            }

            .game h3::before {
                margin-right: 1.5rem;
            }
        }
    </style>
@endpush
@section('content')

    <div class="row container">

</div>
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card card_dark">
                <div class="card-body game">

                        <ol style="--length: {{sizeof($lotto_fixtures)}}" role="list">
                        @foreach($lotto_fixtures as $lotto_fixture)

                                <a href="{{route('game',["id"=>$lotto_fixture->id])}}">
                                    <li style="--i: {{$loop->index}}">
                                    <h3>{{$lotto_fixture->title}} of {{\Carbon\Carbon::parse($lotto_fixture->end_time)->format("d/m/Y")}}</h3>
                                    <p class="text-black-50">End of validation : {{$lotto_fixture->end_time}}</p>
                                    </li>
                                </a>
                            @endforeach
                        </ol>

                 {{--   <div class="height__table">
                        <div class="main__table">
                            <div class="table__wrap">
                            <div class="table__items b__bottom">
                                <div class="t__items">
                                    <div class="t__items__left text-end">
                                        <h6>
                                            <img height="40"
                                                 src="{{asset("images/ballon-football-enveloppe-flammes-bleues-fumee-noire.jpg")}}">
                                            Real madrid
                                        </h6>
                                    </div>

                                </div>
                                <div class="mart__point__items">
                                    <a href="javascript:void(0);" class="point__box">
                                        <input type="checkbox" name="fixure" value="1" id="check1">
                                        <label for="check1">
                                            <span class="break">1</span>
                                            <div><i class="fa fa-check"></i></div>
                                        </label>

                                    </a>
                                    <a href="javascript:void(0);" class="point__box">
                                        <input type="checkbox" name="fixure" value="3" id="check3">
                                        <label for="check3">
                                            <span class="break">x</span>
                                            <div>   <i class="fa fa-check"></i></div>
                                        </label>

                                    </a>
                                    <a href="javascript:void(0);" class="point__box">
                                        <input type="checkbox" name="fixure" value="2" id="check2">
                                        <label for="check2">
                                            <span class="break">2</span>
                                            <div><i class="fa fa-check"></i></div>
                                        </label>

                                    </a>
                                </div>
                                <div class="t__items">
                                    <div class="t__items__left">
                                        <h6>
                                            <img height="40"
                                                 src="{{asset("images/ballon-football-enveloppe-flammes-bleues-fumee-noire.jpg")}}">
                                            Real madrid
                                        </h6>
                                    </div>

                                </div>
                            </div>
                            </div>
                        </div>

                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <a class="btn btn-outline-success btn-lg btn-block"> Valider</a>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push("script")

@endpush
