@extends('backend.backend')

@section('content')
    <h3 class="account__head mb__30">
        List Users
    </h3>
    <div class="card text-white">
        <div class="card-body card_body_dark">
            <table class="table text-white">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$loop->index}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->address}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
