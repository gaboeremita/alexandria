@extends('layouts.app')

@section('content')
    <div id="modal-borrow" class="modal">
        <div class="modal-content">
            <h4>You sure you want to borrow {{ $book->title }}?</h4>
            <p>Borrowing a book is a great responsibility</p>
        </div>
        <div class="modal-footer">
            <form method="POST" action="{{ $book->path() }}/borrow">
                {{ csrf_field() }}
                <button class="btn waves-effect waves-light" type="submit" name="action">
                    Of course!
                </button>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Nevermind</a>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="card large hoverable">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="{{ asset('img/book-placeholder.png') }}" alt="Cover">
            </div>
            <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">
                {{ $book->title }}<i class="material-icons right">more_vert</i>
            </span>
                <div>
                    Published on {{ $book->published }}
                </div>
                <div class="chip">
                    {{ $book->category->name }}
                </div>
                <div class="row">
                    <div class="input-field left">
                        <button data-target="modal-borrow" class="btn modal-trigger waves-effect waves-light {{ isset($book->borrowedBy) ? 'disabled' : '' }}">
                            Borrow
                        </button>
                    </div>
                    <a class="right btn-floating btn-large waves-effect waves-light red" href="{{ $book->path() }}/edit">
                        <i class="material-icons">mode_edit</i>
                    </a>
                </div>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">{{ $book->title }}
                    <i class="material-icons right">
                        close
                    </i>
                </span>
                <p>{{ $book->description }}</p>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elem = document.querySelector('#modal-borrow');
            var instances = M.Modal.init(elem);
        });
    </script>
@endpush