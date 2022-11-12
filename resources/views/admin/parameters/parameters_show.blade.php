@extends('admin.index_admin')
@section('title', 'parameters')

@section('actions')
   <a href='<?php echo url('/admin/parameters'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>



        <div class='form-row'>
            <div class='col-md-4'>
   <label >Title</label>
   <input type='text' readonly value='{{ $parameters->title }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Logo</label>
   <input type='text' readonly value='{{ $parameters->logo }}' class='form-control'>
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
        