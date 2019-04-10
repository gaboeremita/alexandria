@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <h3 class="header red-text text-lighten-3">Register</h3>
            <form class="col s12" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" type="text" class="validate" name="name" value="{{ old('name') }}" required
                               autofocus>
                        <label for="name">Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
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

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">

                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
