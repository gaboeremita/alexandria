@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <h3 class="header red-text text-lighten-3">
                Reset Password
            </h3>
            <form class="col s12" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" name="name" type="email" class="validate" value="{{ $email or old('email') }}" required
                               autofocus>
                        <label for="email">Email</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" name="password" type="password" class="validate" required>
                        <label for="password">Password</label>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <input name="password_confirmation" id="password-confirm" type="password" class="validate"
                               required>
                        <label for="password-confirm">Confirm password</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            Reset Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
