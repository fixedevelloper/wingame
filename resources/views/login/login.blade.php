
@extends('base')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="mt-3">
                <div class="custom_card">
                    <h2 class="text-white">Sign In</h2>
                    @include("_partials.errors-and-messages")
                    <div class="form__tabs__wrap mt-3">
                        <form action="{{route("login")}}">
                            @csrf

                            <div class="text-white">
                                <label class="form-label" for="email35">Phone</label>
                                <input class="form-control" type="text" id="email35" name="phone" placeholder="">
                            </div>
                            <div class="text-white">
                                <label class="form-label" for="toggle-password10">Password</label>
                                <input class="form-control" name="password" id="toggle-password10" type="password" placeholder="Your Password">
                            </div>

                            <div class="create__btn mt-3">
                                <button class="cmn--btn">
                                    <span>Sign In</span>
                                </button>
                            </div>
                            <p>
                                you not have an account? <a href="{{route('nextregister')}}">Register</a>
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('script')

@endpush
