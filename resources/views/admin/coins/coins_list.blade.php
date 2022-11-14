@extends('admin.index_admin')
@section('title', 'Moedas')

@section('actions')
    <a href='{{ route('coins.create') }}' class='btn btn-primary'>
        Cadastrar
    </a>
@endsection

@section('content')

    <div class='card'>
        <div class='card-body'>
            <div class='row'>
                <div class='col-md-12'>
                    <form action="{{ route('coins.index') }}" method='get'>
                        @csrf
                        <div class='form-row'>
                            <div class='col-md-2'>
                                <label>name</label>
                                <input type='text' name='name' value="{{ $filters['name'] ?? '' }}"
                                    class='form-control'>
                            </div>
                            <div class='col-md-2'>
                                <label>&nbsp;</label>
                                <input type='submit' name="search" value='Pesquisar' class='form-control btn btn-primary'>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <table class='table table-bordered table-hover'>
                <thead>
                    <tr>
                        <th>Moeda</th>
                        <th>Valor</th>
                        <th>Descrição</th>
                        <th>Percentual de Lucro(%)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($coins as $key => $coin)
                        <tr>
                            <td>{{ $coin->name }}</td>
                            <td>@money2($coin->latestCotacao->value)</td>
                            <td>{{ $coin->description }}</td>
                            <td>{{ $coin->profit_percentage }}</td>
                            <td>{{ $coin->status }}</td>
                            <td>
                                <a href='{{ route('coin.edit', $coin->id) }}' class='btn btn-primary btn-sm'>
                                    <span class='bx bx-edit'></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- {{ $coins->appends($filters)->links() }} --}}
        </div>
    </div>

@endsection
