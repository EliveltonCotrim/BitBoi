@extends('admin.index_admin')
@section('title', 'files')

@section('actions')
   <a href='<?php echo url('/admin/files'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>



        <div class='form-row'>
            <div class='col-md-4'>
   <label >Name</label>
   <input type='text' readonly value='{{ $files->name }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >File</label>
   <input type='text' readonly value='{{ $files->file }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Status</label>
   <input type='text' readonly value='{{ $files->status }}' class='form-control'>
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
        