@if ($errors->any())
    <div class='alert alert-danger'>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('alert'))
    <div class='alert alert-danger'>
        {{ session('alert') }}
    </div>
@endif
@if (session('erro'))
    <div class='alert alert-danger'>
        {{ session('erro') }}
    </div>
@endif
@if (session('success'))
    <div class='alert alert-success'>
        {{ session('success') }}
    </div>
@endif
