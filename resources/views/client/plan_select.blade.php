@extends('client.index_client')
@section('title', 'Selecione o Pacote ou Moeda Desejada')
@section('compras', 'mm-active')

@section('actions')
    <a href='{{ url('client/compras') }}' class='btn btn-primary'>
        Voltar
    </a>
@endsection
@section('content')
    <div class="row">
        @foreach ($coins as $key => $coin)
            <div class="col-12 col-lg-3 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-0">{{ $coin->name }}</h4>
                        <hr />
                        <p class="mb-0">Valor</p>
                        <p>R$ @money2($coin->latestCotacao->value)</p>
                        <span class="card-title mb-0">Rendimento</span>
                        <p>{{ $coin->profit_percentage }}%</p>
                        <span class="card-title">Tempo</span>
                        <p class="mb-0">{{ $coin->time_pri }} (mês)</p>
                        <hr />
                        <form action="{{ route('coin_select_store') }}" method="post">
                            @csrf
                            <input type="hidden" name="coin" value="{{ Crypt::encrypt($coin->id) }}">
                            <div class="form-row justify-content-center">

                                {{-- <a class="btn btn-danger mr-1" data-increase="[name='a{{ $key }}']">-</a>
                                <input name="quantity_coin" class="form-control" type=number min=1 max=50>
                                <a class="btn btn-success ml-1" data-decrease="[name='a[{{ $key }}]']">+</a> --}}
                                <livewire:counter />

                            </div>
                            <button class="btn btn-primary rounded btn-md lis-rounded-circle-50 px-4 mt-3" data-abc="true">
                                <i class="fa fa-shopping-cart pl-2"></i>
                                Comprar
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        @foreach ($pacotes as $pacote)
            <div class="col-12 col-lg-3 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-0">{{ $pacote->name }}</h4>
                        <hr />
                        <p class="mb-0">Valor</p>
                        <p>R$ @money2($pacote->value)</p>
                        <span class="card-title mb-0">Rendimento</span>
                        <p class="mb-2"> {{ $pacote->coin->profit_percentage }}%</p>
                        <span class="card-title mb-0">Tempo</span>
                        <p class="mb-0">{{ $pacote->time_pri }} (mês)</p>
                        <hr />
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="pacote" value="{{ Crypt::encrypt($pacote->id) }}">
                            <button class="btn btn-primary rounded btn-md lis-rounded-circle-50 px-4" data-abc="true">
                                <i class="fa fa-shopping-cart pl-2"></i>
                                Comprar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
