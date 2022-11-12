@extends('cliente/index_cliente')
@section('title','Depositar')
@section('depositos_menu','open')


@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="box">
            <header class="panel_header">
                <div class="actions panel_actions pull-right">
                    <a href="{{ url('cliente/deposits') }}" class="btn btn-primary p-2">
                        <span class="fa fa-arrow-left"></span>
                        Voltar
                    </a>
                </div>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive" data-pattern="priority-columns">

                            <div class="col-lg-4">
                                <section class="box has-border-left-3">
                                    <header class="panel_header">
                                        <h2 class="title pull-left">Depositar R$</h2>
                                        <div class="actions panel_actions pull-right">
                                        </div>
                                    </header>
                                    <div class="content-body">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="no-mt no-mb">
                                                    <div class="transfer-wraper">
                                                        <div class="crypto-icon">
                                                            <span class="fa fa-money" style="font-size: 30px;"></span>
                                                        </div>
                                                        <form action="" method="POST">
                                                            @csrf
                                                            <hr>
                                                            <div class='row'>
                                                                <div class='col-md-6'>
                                                                    <label for="">Valor</label>
                                                                    <input required name="value" type="text" class="form-control moeda" placeholder="R$ 0,00">
                                                                </div>
                                                            </div>

                                                            <div class='row'>
                                                                <div class='col-md-4'>

                                                                    <label for="">&nbsp;</label>
                                                                    <button type="submit" class="btn btn-primary btn-lg mt-20 has-gradient-to-right-bottom" style="width:100%">
                                                                        Confirmar
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="form-group  no-mb">

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="<?php echo asset('assets'); ?>/js/jquery.mask.js"></script>
<script>
    $('.moeda').mask("#.##0,00", {
        reverse: true
    });
</script>
@endsection