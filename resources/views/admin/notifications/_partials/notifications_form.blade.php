<div class='form-row'>
    <div class='col-md-6'>
        <label>Título</label>
        <input type='text' required name='title' value='{{ $notifications->title ?? old("title")  }}' class='form-control'>
    </div>
</div>
<br>
<div class='form-row'>
    <div class='col-md-6'>
        <label>Texto</label>
        <textarea id="mytextarea" name='text' class='form-control' name="mytextarea">{{ $notifications->text ?? old("text")  }}</textarea>
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

<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
</script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>