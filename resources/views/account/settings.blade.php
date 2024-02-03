@extends('account.layout')

@section('content')
    <h3 class="account__head mb__30">
        Settings
    </h3>
    <div class="card text-white">
        <div class="card-body card_body_dark">
            <form>
                <div>
                    <label class="form-label">Name</label>
                    <input class="form-control">
                </div>
                <div>
                    <label class="form-label">Address</label>
                    <input class="form-control" value="{{$address}}" readonly>
                </div>
                <div class="mt-3">
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
