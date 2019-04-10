@extends('layouts.app')

@section('content')
    <div class="row">
        <h3 class="header red-text text-lighten-3">
            New Book
        </h3>
        <form class="col s12" method="POST" action="/books" >

            {{ csrf_field() }}

            <div class="row">
                <div class="input-field col s6">
                    <input id="title" name="title" type="text" class="validate" value="{{ old('title') }}">
                    <label for="title">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <textarea name="description" id="description" class="materialize-textarea" cols="30" rows="10">
                        {{ old('description') }}
                    </textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <span>Author</span>
                    <select id="author_id" name="author_id">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ $author->id === old('author_id') ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="hidden" id="category_id" name="category_id" value="{{ old('category_id') }}">
                            <input type="text" name="category_name" id="autocomplete-category" class="autocomplete" value="{{ old('category_name') }}">
                            <label for="autocomplete-category">Category</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="published" name="published" type="text" class="datepicker" value="{{ old('published') }}">
                    <label>Published on</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <button class="btn waves-effect waves-light" type="submit" name="action">
                        Create
                    </button>

                    <a class="waves-effect waves-red btn-flat" href="/books">
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
            var elems = document.querySelector('#published');
            var instances = M.Datepicker.init(elems);
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