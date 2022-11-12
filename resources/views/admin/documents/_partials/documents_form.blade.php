<div class='form-row'>
    <div class='col-md-4'>
        <label>Cliente_id</label>
        <input type='text' name='cliente_id' value='{{ $documents->cliente_id ?? old("cliente_id")  }}' class='form-control'>
    </div>
    <div class='col-md-4'>
        <label>Tipo</label>
        <input type='text' name='tipo' value='{{ $documents->tipo ?? old("tipo")  }}' class='form-control'>
    </div>
    <div class='col-md-4'>
        <label>Arquivo</label>
        <input type='text' name='arquivo' value='{{ $documents->arquivo ?? old("arquivo")  }}' class='form-control'>
    </div>
    <div class='col-md-4'>
        <label>Status</label>
        <input type='text' name='status' value='{{ $documents->status ?? old("status")  }}' class='form-control'>
    </div>

</div>
<div class='form-row'>
    <div class='col-md-2'>
        <label>&nbsp;</label>
        <button type='submit' class='btn btn-primary form-control'>
            Salvar
        </button>
    </div>
</div>