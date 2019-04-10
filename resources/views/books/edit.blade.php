@extends('layouts.app')

@section('content')
    <div id="delete-modal" class="modal">
        <div class="modal-content">
            <h5>Hey, you sure about this?</h5>
        </div>
        <div class="modal-footer">
            <form method="POST" action="{{ $book->path() }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button class="btn waves-effect waves-light" type="submit" name="action">
                    Yup
                </button>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Nevermind</a>
            </form>
        </div>
    </div>
    <div class="row">
        <h3 class="header red-text text-lighten-3">
            Edit Book
        </h3>
        <form class="col s12" method="POST" action="{{ $book->path() }}" >

            {{ csrf_field() }}
            {{ method_field('put') }}

            <div class="row">
                <div class="input-field col s6">
                    <input id="title" name="title" type="text" class="validate" value="{{ $book->title }}">
                    <label for="title">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <textarea name="description" id="description" class="materialize-textarea" cols="30" rows="10">{{ $book->description }}</textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <select id="author_id" name="author_id">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ $author->id === $book->author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                    <label>Author</label>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="hidden" id="category_id" name="category_id" value="{{ $book->category->id }}">
                            <input type="text" name="category_name" id="autocomplete-category" class="autocomplete" value="{{ $book->category->name }}">
                            <label for="autocomplete-category">Category</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="published" name="published" type="text" class="datepicker" value="{{ $book->published }}">
                    <label>Published on</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <button class="btn waves-effect waves-light" type="submit" name="action">
                        Save changes
                    </button>

                    <button data-target="delete-modal" class="btn modal-trigger red {{ isset($book->borrowedBy) ? 'disabled' : '' }}">
                        Delete
                    </button>

                    <a class="waves-effect waves-red btn-flat" href="{{ $book->path() }}">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            let elems = document.querySelectorAll('select');
            let instances = M.FormSelect.init(elems);
        });


        document.addEventListener('DOMContentLoaded', function() {
            let elems = document.querySelector('#published');
            let instances = M.Datepicker.init(elems);
        });
        document.addEventListener('DOMContentLoaded', function() {
            let elem = document.querySelector('#delete-modal');
            let instances = M.Modal.init(elem);
        });

        const options = {
            data :  {!! $categoriesJSONPlucked !!},

            onAutocomplete : function() {

                let allCategories = {!! $categoriesJSON !!},
                    inputCategoryId = document.querySelector('#category_id'),
                    categoryName = this.el.value;

                allCategories.forEach(function(item) {

                    if(item['name'] === categoryName) {

                        inputCategoryId.value = item['id'];

                    }

                });

            }

        };

        document.addEventListener('DOMContentLoaded', function() {
            let elems = document.querySelectorAll('.autocomplete');
            let instances = M.Autocomplete.init(elems, options);

        });

    </script>
@endpush