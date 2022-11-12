@extends('admin.index_admin')
@section('title','Estratégia')

@section('menu_about','active')

@section('content')
<div class='row m-auto text-center' style="height: 30vh ;">
    <div class='col-md-12 m-auto'>
        <a href="javascript:window.open('{{ url('admin/estrategia/pc') }}','mypopuptitle','width=900,height=580')" class="btn btn-light m-1 radius-30 p-10" style="width: 40%;">
            <i class="lni lni-write"></i>
            <br>
            Abrir Estratégia
        </a>

    </div>
</div>
@endsection