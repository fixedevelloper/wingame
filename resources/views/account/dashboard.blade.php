@extends('account.layout')

@section('content')
    <h3 class="account__head mb__30">
        Dashboard
    </h3>
    <div class="card text-white">
        <div class="card_body_dark card-body">
            <h3>My Link: <a href="{{route("nextregister",["txd"=>$id])}}" target="_blank">{{route("nextregister",["txd"=>$id])}}</a></h3>
        </div>
    </div>
@endsection
