@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <h3 class="header red-text text-lighten-3">
                Reset Password
            </h3>
            @if (session('status'))
                <div class="card red lighten-3">
                    <div class="card-content white-text">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <form class="col s12" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" name="email" type="email" class="validate" value="{{ $email or old('email') }}" required
                               autofocus>
                        <label for="email">Email</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">

                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            Send Password Reset Link
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
