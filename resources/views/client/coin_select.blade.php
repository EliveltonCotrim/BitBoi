@extends('client.index_client')
@section('title', 'Selecione a moeda Desejada')
@section('actions')
    <a href='{{ url('client/compras') }}' class='btn btn-primary'>
        Voltar
    </a>
@endsection
@section('content')
    <div class="row">
        @foreach ($coins as $coin)
            <div class="col-12 col-lg-3 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-0">{{ $coin->name }}</h4>
                        <p class="mb-0">R$ @money2($coin->latestCotacao->value)</p>
                        <hr />
                        <span class="card-title mb-0">Pecentual Rendimento</span>
                        <p class="mb-0"> {{ $coin->profit_percentage }}%</p>
                        <span class="card-title mb-0">Tempo</span>
                        <p class="mb-0">{{ $coin->time_pri }} (mês)</p>

                        <hr />
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="coin" value="{{ Crypt::encrypt($coin->id) }}">
                            <div class="form-row justify-content-center">
                                <div class="btn-group col-md-8 m-1" role="group" aria-label="Basic example">
                                    <input class="form-control" type="number" placeholder="Quantidade" name="quantity_coin"
                                        id="num">
                                </div>
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
    </div>
@endsection
@section('scripts')
    <script>
        numero = 0;

        function less() {
            numero--;
            setValue(numero);
        }

        function more() {
            numero++;
            setValue(numero);
        }

        function setValue(value) {
            document.getElementById('num').value = value;
        }

        setValue(numero);
    </script>

@endsection
