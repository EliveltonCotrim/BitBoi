@extends('client.index_client')
@section('title', 'Solicitar Saque de Rendimentos')
@section('saques', 'mm-active')

@section('actions')
    <a href='{{ route('solicitar.saques.rendimentos') }}' class='btn btn-success rounded'>
        Voltar
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class='row'>
                <div class="col-md-6">
                    <div class='form'>
                        <form action="" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-8">
                                    @if (count($bancos) > 0)
                                        <label for="">Conta para Saque</label>
                                        <x-select name='conta' :options="$bancos" required='true' />
                                    @else
                                        <label for="">Conta para Saque</label>
                                        <br>
                                        <a href="{{ url('client/meus_dados') }}" class="btn btn-success rounded">
                                            Cadastrar
                                        </a>
                                        <hr>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-8">
                                    <label for="">Valor a Solicitar*</label>
                                    <input class="form-control moeda shadow" type="text" name="valor" required
                                        placeholder="0,00">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="">&nbsp;</label>
                                    <input type="hidden" name="valueDisponivel" value="{{  Crypt::encrypt($totalDiponivelSaque) }}">
                                    <input value="Solicitar" class="form-contro btn btn-primary rounded" type="submit">
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="col-md-8">
                        <div class="card bg-info">
                            <div class="card-body">
                                <div class="d-flex mb-2">
                                    <div>
                                        <p class="mb-0 font-weight-bold text-white">Disponível para Saques</p>
                                        <h2 class="mb-0 text-white">@money2($totalDiponivelSaque)</h2>
                                    </div>
                                    <div class="ml-auto align-self-end">
                                    </div>
                                </div>
                                <div id="chart2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card bg-info">
                            <div class="card-body">
                                <div class="d-flex mb-2">
                                    <div>
                                        <p class="mb-0 font-weight-bold text-white">Saque Pendente</p>
                                        <h2 class="mb-0 text-white">@money2($balances['saque_pendente'])</h2>
                                    </div>
                                    <div class="ml-auto align-self-end">
                                    </div>
                                </div>
                                <div id="chart2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
