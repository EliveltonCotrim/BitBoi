@extends('admin.index_admin')
@section('title', 'Vendas')

@section('actions')
    <!-- <a href='<?php echo url('admin/boletos/create'); ?>' class='btn btn-primary'>
                        Cadastrar
                    </a> -->
@endsection

@section('content')

    <div class='card'>
        <div class='card-body'>

            <div class='row'>
                <div class='col-md-12'>
                    <form action="" method='get'>
                        @csrf
                        <div class='form-row mt-2'>
                            <div class='col-md-2'>
                                <label>Data Inicial</label>
                                <input type='date' name='start' value="{{ $filters['start'] ?? '' }}"
                                    class='form-control'>
                            </div>

                            <div class='col-md-2'>
                                <label>Data Final</label>
                                <input type='date' name='end' value="{{ $filters['end'] ?? '' }}"
                                    class='form-control'>
                            </div>
                            <div class='col-md-2'>
                                <label>&nbsp;</label>
                                <input type='submit' value='Pesquisar' class='form-control btn btn-light'>
                            </div>
                            {{-- <div class='col-md-2'>
                                <label>&nbsp;</label>
                                <a href="{{ url('admin/boletos/pdf?' . http_build_query($filters)) }}"
                                    class='form-control btn btn-light' target="_blanck">
                                    <span class="bx bxs-file-pdf"></span>
                                    PDF
                                </a>
                            </div> --}}
                            <div class='col-md-2'>
                                <label>&nbsp;</label>
                                <a href="{{ route('export.boletos') }}"
                                    class='form-control btn btn-light' target="_blanck">
                                    <span class="bx bxs-file-pdf"></span>
                                    EXCEL
                                </a>
                            </div>
                            <div class='col-md-3'>
                                <label>&nbsp;</label>

                                {{-- <input type='submit' value='Pesquisar' class='form-control btn btn-light'> --}}
                                <a class='form-control btn btn-primary' href="{{ route('lancar.investimentos') }}">Lançar
                                    Rendimentos</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>

            <div class='row'>
                <div class="col-12 col-lg-3 col-xl-3">
                    <div class="card radius-15">
                        <div class="card-body">
                            <h6 class="card-title text-white">Total de Vendas</h6>
                            <h6 class="card-subtitle mb-2 text-white"> {{ $boletos->total() }}</h6>
                            {{-- <a href="#" class="card-link text-white">Another link</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-xl-3">
                    <div class="card radius-15">
                        <div class="card-body">
                            <h6 class="card-title text-white">Valor Investido</h6>
                            <h6 class="card-subtitle mb-2 text-white">@money($valorTotalInvestido)</h6>
                            {{-- <a href="#" class="card-link text-white">Another link</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-xl-3">
                    <div class="card radius-15">
                        <div class="card-body">
                            <h6 class="card-title text-white">Rendimentos Previsto</h6>
                            <h6 class="card-subtitle mb-2 text-white">@money($rendimentoPrevisto)</h6>
                            {{-- <a href="#" class="card-link text-white">Another link</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-xl-3">
                    <a href="{{ route('payment.day') }}">
                        <div class="card radius-15">
                            <div class="card-body">
                                <h6 class="card-title text-white">Rendimentos do Dia</h6>
                                <h6 class="card-subtitle mb-2 text-white">@money($pagamentoDia)
                                </h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <table class='table table-bordered table-hover'>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th>TX ID</th>
                        <th>Status</th>
                        <th>Meio</th>
                        <th>Data de <br> Confirmação</th>
                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody>
                    <?php
                foreach ($boletos as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->user->name; ?></td>
                        <td>@money($dado->valor)</td>
                        <td><?php echo $dado->transaction_id; ?></td>
                        <td><?php echo $dado->status; ?></td>
                        <td><?php echo $dado->meioPagamento; ?></td>
                        <td><?php echo $dado->dataConfirmacao; ?></td>
                        {{-- <td>
                            <a href='{{ url('admin/boletos/confirm/' . $dado->id)}}' class='btn btn-light btn-sm'>
                                <span class='bx bx-edit'></span> Editar
                            </a>
                        </td> --}}
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            {{ $boletos->appends($filters)->links() }}
        </div>
    </div>

@endsection
