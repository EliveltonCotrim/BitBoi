@extends('admin.clients.clients_panel')

@section('content_client')
<div class='form'>
    <form action="" method="post">
        @csrf

        <div class="form-row">
            <div class="col-md-2">
                <label for="">Valor*</label>
                <input class="form-control moeda" type="text" name="valor" required>
            </div>
            <div class="col-md-4">
                <label for="">Observação*</label>
                <input class="form-control" type="text" name="obs" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-2">
                <label for="">&nbsp;</label>
                <input value="Adicionar" class="form-control btn btn-primary" type="submit">
            </div>
        </div>

    </form>
</div>
@endsection