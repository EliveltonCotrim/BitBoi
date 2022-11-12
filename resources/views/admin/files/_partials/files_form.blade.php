<div class='form-row'>
    <div class='col-md-4'>
        <label>Name</label>
        <input type='text' required name='name' value='{{ $files->name ?? old("name")  }}' class='form-control'>
    </div>
    <div class='col-md-4'>
        <label>File</label>
        <input type='file' required name='file' value='{{ $files->file ?? old("file")  }}' class='form-control'>
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