@extends('client.index_client')
@section('title','Meus Diretos')

@section('content')
<div class="card">
    <div class="card-body">


        <div class='table-responsive'>
            <table class='table table-bordered table-striped table-sm'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nick</th>
                        <th>Nível</th>
                        <th>Patrocinador</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                @foreach($rede as $k => $red)

                <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{ $red['user'] }}</td>
                    <td>{{ $red['nivel'] }}</td>
                    <td>{{ $red['patrocinador'] }}</td>
                    <td>{{ $red['patrocinador_telefone'] }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection