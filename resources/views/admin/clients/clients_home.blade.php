@extends('admin.clients.clients_panel')
@section('tab_home','active')

@section('content_client')

<br>
<div class='row'>
    <div class='col-md-4'>
        <label for="">Status do Cadastro do Cliente</label>
        <input type="text" disabled name="" class="form-control" id="" value="{{ $client->status }}">
    </div>
    <div class='col-md-4'>
        <label for="">Data Cadastro</label>
        <input type="text" disabled name="" class="form-control" id="" value="{{ $client->created_at }}">
    </div>
</div>


<div class='row'>
    <div class='col-md-12'>
        <div class='row'>

            <div class='col-md-2'>
                <form action="{{ url('admin/documents/active', $client->id) }}" method='post'>
                    @csrf
                    <div class='row'>
                        <div class='col-md-12'>
                            <label for="">&nbsp;</label>
                            <input type="hidden" value="pendente" name="status" id="">
                            <input type="submit" name="" id="" value="Pendente" class="form-control btn btn-warning">
                        </div>
                    </div>
                </form>

            </div>
            <div class='col-md-2'>
                <form action="{{ url('admin/documents/active', $client->id) }}" method='post'>
                    @csrf
                    <div class='row'>
                        <div class='col-md-12'>
                            <label for="">&nbsp;</label>
                            <input type="hidden" value="ativo" name="status" id="">
                            <input type="submit" name="" id="" value="Ativar" class="form-control btn btn-success">
                        </div>
                    </div>
                </form>

            </div>
            <div class='col-md-2'>

                <form action="{{ url('admin/documents/active', $client->id) }}" method='post'>
                    @csrf
                    <div class='row'>
                        <div class='col-md-12'>
                            <label for="">&nbsp;</label>
                            <input type="hidden" value="bloqueado" name="status" id="">
                            <input type="submit" name="" id="" value="Bloquear" class="form-control btn btn-danger">
                        </div>
                    </div>
                </form>
            </div>
        </div>






    </div>
</div>


@endsection