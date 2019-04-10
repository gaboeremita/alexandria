@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12 l6">
            <div class="card">
                <div class="card-image">
                    <img src="/img/profile-camera.jpg">
                    <span class="card-title">{{ $user->name }}</span>
                </div>
                <div class="card-content">
                    <p>
                        Email:
                        {{ $user->email }}
                    </p>
                </div>
                <div class="card-action">
                    <span>Member since {{ $user->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
        <div class="col s12 l6 container">
            <h4 class="header red-text">
                My borrowed books
            </h4>
            @if(count($user->borrowed))
            <table class="responsive-table highlight striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Return book</th>
                </tr>
                </thead>

                <tbody>
                @foreach($user->borrowed as $book)
                    <tr>
                        <td>
                            {{ $book->title }}
                        </td>
                        <td>
                            {{ $book->category->name }}
                        </td>
                        <td>
                            <form method="post" action="/users/return/{{ $book->slug }}">
                                {{ csrf_field() }}
                                <div class="input-field left">
                                    <button type="submit" class="btn modal-trigger waves-effect waves-light">
                                        Return it!
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                You don't have any books borrowed. <a href="/home">Go get some!</a>
            @endif
        </div>
    </div>
@endsection
@if(session('message'))
    @push('scripts')
        <script>

            M.toast({html: "{{ session('message') }}", classes: 'rounded'});

        </script>
    @endpush
@endif
