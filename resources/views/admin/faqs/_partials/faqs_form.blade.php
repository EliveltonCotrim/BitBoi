<div class='form-row'>
    <div class='col-md-8'>
        <label>Pergunta</label>
        <textarea name='pergunta' style="height: 200px;" required class='form-control'>{{ $faqs->pergunta ?? old("pergunta")  }}</textarea>
    </div>
</div>
<div class='form-row'>
    <div class='col-md-8'>
        <label>Resposta</label>
        <textarea name='resposta' style="height: 200px;" required class='form-control'>{{ $faqs->resposta ?? old("resposta")  }}</textarea>
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