@extends('admin.index_admin')
@section('title', 'faqs')

@section('actions')
   <a href='<?php echo url('/admin/faqs'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>



        <div class='form-row'>
            <div class='col-md-4'>
   <label >Pergunta</label>
   <input type='text' readonly value='{{ $faqs->pergunta }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Resposta</label>
   <input type='text' readonly value='{{ $faqs->resposta }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Status</label>
   <input type='text' readonly value='{{ $faqs->status }}' class='form-control'>
</div>

        </div>
        <div class='form-row'>
            <div class='col-md-2'>
                <label >Excluir?</label>
                <button type='submit' class='btn btn-primary form-control'>
                    Excluir
                </button>
            </div>
        </div>
        
               </div>
    </div>
</div>
</div>
</div>
@endsection
        