@if(count($errors))
    <div class="card red lighten-2">
        <div class="card-content white-text">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
