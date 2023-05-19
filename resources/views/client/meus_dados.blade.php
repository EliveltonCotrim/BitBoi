@extends('client.index_client')
@section('title', 'Meus Dados')

@section('menu_dados', 'active')

@section('content')

    <div class="user-profile-page">
        <div class="card radius-15">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-7 border-right">
                        <div class="d-md-flex align-items-center">
                            <div class="mb-md-0 mb-3">
                                <img src="{{ asset('assets') }}/img/moeda.png" class=" shadow" width="180" class=""
                                    alt="">
                            </div>
                            <div class="ml-md-4 flex-grow-1">
                                <div class="d-flex align-items-center mb-1">
                                    <h4 class="mb-0">{{ $client->name }}</h4>
                                    <p class="mb-0 ml-auto"></p>
                                </div>
                                <p class="mb-0">{{ $client->user }}</p>
                                <p><i class="bx bx-buildings"></i> {{ $client->email }}</p>
                                <a href="{{ url('client/edit') }}" class="btn btn-light">Editar</a>
                                <a href="{{ url('client/password') }}" class="btn btn-light ml-2">Alterar Senha</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5 table-responsive">

                        <div class="mb-3 mb-lg-0">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card radius-15 p-3">
            <div class="col-md-6 border-right">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">Dados Bancários</h4>
                    </div>
                    <div class="form-body">
                        <div class="col-md-12">
                            @if (isset($banks))
                                @foreach ($banks as $bank)
                                    <div class="card shadow-none border mb-4 mt-1 mb-md-0">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="media-body ml-2">

                                                    <div class='row'>
                                                        <div class="col-md-6">
                                                            <h6 class="mb-0">Pix: </h6>
                                                            <h6 class="mb-0">Banco:</h6>
                                                            <h6 class="mb-0">Agência: </h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="mb-0">Nº Conta: </h6>
                                                            <h6 class="mb-0">CPF: </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <!-- <a href="javascript:;" class="text-white">REMOVE</a> -->
                                        </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form action="{{ route('banks.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-10">
                            <label>PIX</label>
                            <input name="pix" type="text" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <label>Banco</label>
                            <input name="banco" type="text" value="" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label>Agência</label>
                            <input name="agencia" type="text" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <label>Nº Conta</label>
                            <input name="conta" type="text" value="" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label>CPF Titular</label>
                            <input name="cpf" p type="text" value="" class="form-control cpf">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <label>&nbsp;</label>
                            <input type="submit" value="Cadastrar" class="form-control btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div> --}}
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="Experience">
                <div class="card shadow-none border mb-0 radius-15">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center mb-3">
                            <h4 class="mb-0">Dados Bancários</h4>
                        </div>
                        <div class='row'>
                            <div class="col-md-5 border-right">
                                <div class="row">
                                    @if (isset($banks))
                                        @foreach ($banks as $bank)
                                            <div class="col-md-12">
                                                <div class="card shadow-none border mb-4 mt-1 mb-md-0">
                                                    <div class="card-body">
                                                        <div class="media align-items-center">
                                                            <div class="media-body ml-2">

                                                                <div class='row'>
                                                                    <div class="col-md-6">
                                                                        <ul style="list-style: none" class="p-0">
                                                                            <li class="mb-1"><strong>Pix:
                                                                                </strong>{{ $bank['pix'] }}
                                                                            </li>
                                                                            <li class="mb-1"><strong>Carteira Metamesk:
                                                                                </strong>{{ $bank['metamesk'] }}
                                                                            </li>
                                                                            <li><strong>CPF:
                                                                                </strong>{{ $bank['cpf'] }}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <ul style="list-style: none" class="p-0">
                                                                            <li class="mb-1"><strong>Nº Conta:
                                                                                </strong>{{ $bank['conta'] }}
                                                                            </li>
                                                                            <li class="mb-1"><strong>Banco:
                                                                                </strong>{{ $bank['banco'] }}
                                                                            </li>
                                                                            <li><strong>Agência:
                                                                                </strong>{{ $bank['agencia'] }}
                                                                            </li>
                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-right">
                                                        <!-- <a href="javascript:;" class="text-white">REMOVE</a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5">
                                <form action="{{ url('client/banks/store') }}" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-10">
                                            <label>PIX</label>
                                            <input name="pix" type="text" value="{{ old('pix') ?? '' }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-10">
                                            <label>Carteira Metamesk</label>
                                            <input name="metamesk" type="text" value="{{ old('metamesk') ?? '' }}"
                                                placeholder="Chave Pública" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-5">
                                            <label>Banco</label>
                                            <input name="banco" type="text" value="{{ old('banco') ?? '' }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-5">
                                            <label>Agência</label>
                                            <input name="agencia" type="text" value="{{ old('agencia') ?? '' }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-5">
                                            <label>Nº Conta</label>
                                            <input name="conta" type="text" value="{{ old('conta') ?? '' }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-5">
                                            <label>CPF Titular</label>
                                            <input name="cpf" type="text" value="{{ old('cpf') ?? '' }}"
                                                class="form-control cpf">
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <label>&nbsp;</label>
                                            <input type="submit" value="Cadastrar" class="form-control btn btn-success">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="herdeiro">
                <div class="card shadow-none border mb-0 radius-15">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center mb-3">
                            @if ($client->parent_nome != '')
                                <div class="col-md-12">
                                    <h4 class="mb-0">Herdeiro virtual</h4>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>Nome</label>
                                            <input value="{{ $client->parent_nome }}" readonly name="parent_nome"
                                                required type="text" value="" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>CPF</label>
                                            <input value="{{ $client->parent_cpf }}" readonly name="parent_cpf" required
                                                type="text" value="" class="form-control cpf">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>RG</label>
                                            <input value="{{ $client->parent_rg }}" readonly name="parent_rg" required
                                                type="text" value="" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>E-mail</label>
                                            <input value="{{ $client->parent_email }}" readonly name="parent_email"
                                                required type="text" value="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>Grau de Parentesco</label>
                                            <input value="{{ $client->parent_parentesco }}" readonly
                                                name="parent_parentesco" required type="text" value=""
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Data Nascimento</label>
                                            <input value="{{ $client->parent_nascimento }}" readonly
                                                name="parent_nascimento" required type="text" value=""
                                                class="form-control data">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>Telefone</label>
                                            <input value="{{ $client->parent_phone }}" readonly name="parent_phone"
                                                required type="text" value="" class="form-control fone">
                                        </div>
                                    </div>
                                </div>
                            @else
                                <form action="{{ url('client/herdeito/store') }}" method="post">
                                    @csrf
                                    <div class="col-md-12">
                                        <h4 class="mb-0">Herdeiro virtual</h4>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>Nome</label>
                                                <input value="{{ $client->parent_nome }}" name="parent_nome" required
                                                    type="text" value="" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>CPF</label>
                                                <input name="parent_cpf" required type="text" value=""
                                                    class="form-control cpf">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>RG</label>
                                                <input name="parent_rg" required type="text" value=""
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>E-mail</label>
                                                <input name="parent_email" required type="text" value=""
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>Grau de Parentesco</label>
                                                <input name="parent_parentesco" required type="text" value=""
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Data Nascimento</label>
                                                <input name="parent_nascimento" required type="text" value=""
                                                    class="form-control data">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>Telefone</label>
                                                <input name="parent_phone" required type="text" value=""
                                                    class="form-control fone">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label>&nbsp;</label>
                                                <input type="submit" value="Cadastrar"
                                                    class="form-control btn btn-primary">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
