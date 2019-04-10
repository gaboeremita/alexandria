@extends('layouts.app')

@section('content')

    <div id="app">
        <books></books>
    </div>

    <div class="fixed-action-btn">
        <a href="/books/create" class="btn-floating btn-large waves-effect waves-light red">
            <i class="large material-icons">
                add
            </i>
        </a>
    </div>
@endsection
@if(session('message'))
    @push('scripts')
        <script>

            M.toast({html: "{{ session('message') }}", classes: 'rounded'});

        </script>
    @endpush
@endif
