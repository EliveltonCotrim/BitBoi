@extends('admin.index_admin')
@section('title', 'Parameters')

@section('actions')
<a href='<?php echo url('/admin/parameters'); ?>' class='btn btn-primary'>
    Voltar
</a>@endsection

@section('content')

<div class='card'>
    <div class='card-body'>

        <div class='col-md-12'>
            <div class='form-horizontal'>
                @include('commons/alerts')
                <form action="{{ route('parameters.update',$parameters->id) }}" method='post' enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class='form-row'>
                        <div class='col-md-3'>
                            <label>Taxa Saque(%)</label>
                            <input type='text' name='taxa_saque' value='{{ $parameters->taxa_saque ? App\Src\Utils\Utils::moeda3($parameters->taxa_saque)  : old("taxa_saque")  }}' class='form-control moeda'>
                        </div>

                        <div class='col-md-3'>
                            <label>Usa Indicação</label>
                            <br>
                            <label for="sim">
                                <input {{  $parameters->usa_indicacao =='sim'? 'checked':''  }} value="sim" id="sim" type='radio' name='usa_indicacao' class='form-contro'>
                                Sim
                            </label>

                            <label for="nao">
                                <input {{  $parameters->usa_indicacao =='nao'? 'checked':''  }} value="nao" id="nao" type='radio' name='usa_indicacao' class='form-contro'>
                                Não
                            </label>
                        </div>

                        <div class='col-md-3'>
                            <label>Porcent Indicação</label>
                            <input type='text' name='percent_indicacao' value='<?php echo isset($parameters) ? $parameters->percent_indicacao : old('percent_indicacao') ?>' class='form-control'>
                        </div>
                    </div>
                    <hr>
                    <div class='form-row'>
                        <div class='col-md-3'>
                            <label>assas_token</label>
                            <input type='text' name='assas_token' value='<?php echo isset($parameters) ? $parameters->assas_token : old('assas_token') ?>' class='form-control'>
                        </div>
                        <div class='col-md-3'>
                            <label>assas_url</label>
                            <input type='text' name='assas_url' value='<?php echo isset($parameters) ? $parameters->assas_url : old('assas_url') ?>' class='form-control'>
                        </div>

                    </div>



                    <hr>
                    <div class='form-row'>
                        <div class='col-md-3'>
                            <label>pix_client_id</label>
                            <input type='text' name='pix_client_id' value='<?php echo isset($parameters) ? $parameters->pix_client_id : old('token_simbolo') ?>' class='form-control'>
                        </div>
                        <div class='col-md-3'>
                            <label>pix_client_secret</label>
                            <input type='text' name='pix_client_secret' value='<?php echo isset($parameters) ? $parameters->pix_client_secret : old('token_simbolo') ?>' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label>pix_url_gerencianet</label>
                            <input type='text' name='pix_url_gerencianet' value='<?php echo isset($parameters) ? $parameters->pix_url_gerencianet : old('pix_url_gerencianet') ?>' class='form-control'>
                        </div>

                        <div class='col-md-4'>
                            <label>gerencianet_chave_pix</label>
                            <input type='text' name='gerencianet_chave_pix' value='<?php echo isset($parameters) ? $parameters->gerencianet_chave_pix : old('gerencianet_chave_pix') ?>' class='form-control'>
                        </div>
                    </div>
                    <br>

                    <div class='form-row'>
                        <div class='col-md-5'>
                            <label>pix_key_file</label>
                            <input type='file' name='pix_key_file' value='' class='form-control'>
                        </div>
                        <div class='col-md-5'>
                            <label>pix_crt_file</label>
                            <input type='file' name='pix_crt_file' value='' class='form-control'>
                        </div>
                    </div>


                    <div class='form-row'>
                        <div class='col-md-2'>
                            <label>&nbsp;</label>
                            <button type='submit' class='btn btn-primary form-control'>
                                Salvar
                            </button>
                        </div>
                        <a href="{{ url('admin/payments') }}">
                            Meios de Pagamento
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection