<div class='form-row'>
    <div class='col-md-4'>
        <label>Taxa Saque(%)</label>
        <input type='text' name='taxa_saque' value='{{ $parameters->taxa_saque ? App\Src\Utils\Utils::moeda3($parameters->taxa_saque)  : old("taxa_saque")  }}' class='form-control moeda'>
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