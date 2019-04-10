@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <h3 class="header red-text text-lighten-3">Login</h3>
            <form class="col s12" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" name="email" type="email" class="validate" value="{{ old('email') }}" required autofocus>
                        <label for="email">Email</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" name="password" type="password" class="validate" required>
                        <label for="password">Password</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">

                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            Login
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
