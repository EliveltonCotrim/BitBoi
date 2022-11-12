@extends('admin.clients.clients_panel')

@section('content_client')

<div class='table-responsive'>
    <table class='table table-bordered table-striped table-sm'>
        <thead>
            <tr>
                <th>ID</th>
                <th>D/C</th>
                <th>Operação</th>
                <th>Moeda</th>
                <th>Valor</th>
                <th>Obs</th>
                <th>Data</th>
            </tr>
        </thead>
        @foreach($extracts as $extract)
        <tr>
            <td>{{ $extract->id }}</td>
            <td>{{ $extract->operation }}</td>
            <td>{{ $extract->reference }}</td>
            <td>{{ $extract->coin }}</td>
            <td>@money($extract->value)</td>
            <td>{{ $extract->observation }}</td>
            <td>{{ $extract->created_at->format('d/m/Y H:s:i') }}</td>
        </tr>
        @endforeach
    </table>
</div>

@endsection