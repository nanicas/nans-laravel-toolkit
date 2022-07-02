@if (!empty($messages))
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif