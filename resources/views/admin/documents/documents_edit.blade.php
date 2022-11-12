@extends('admin.index_admin')
@section('title', 'Documents')

@section('actions')
<a href='<?php echo url('admin/documents'); ?>' class='btn btn-primary'>
    Voltar
</a>
@endsection

@section('content')

<div class='card'>
    <div class='card-body'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='table-responsive'>
                    <table class='table table-bordered table-striped table-sm'>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Documento</th>
                                <th>Data de Envio</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($documents as $document)
                        <tr>
                            <td>{{ $document->client->name }}</td>
                            <td>{{ $document->tipo }}</td>
                            <td>{{ $document->created_at }}</td>
                            <td>{{ $document->status }}</td>
                            <td>
                                <a href="{{ url('admin/documents/download/'.$document->id) }}" class="btn btn-info btn-sm" target="_blanck">
                                    <span class="bx bx-download"></span>
                                </a>
                            </td>
                            <td>
                                @if($document->status =='enviado')
                                <form action="{{ url('admin/documents/status') }}" method='post'>
                                    @csrf
                                    <input type="hidden" value="aceito" name="status" id="">
                                    <input type="hidden" value="{{ $client->id }}" name="client_id" id="">
                                    <input type="hidden" value="{{ $document->id }}" name="doc_id" id="">
                                    <input type="submit" id="" value="Aceitar" class="btn btn-success btn-sm">
                                </form>
                                @endif
                            </td>
                            <td>
                                @if($document->status =='enviado')
                                <form action="{{ url('admin/documents/status') }}" method='post'>
                                    @csrf
                                    <input type="hidden" value="rejeitado" name="status" id="">
                                    <input type="hidden" value="{{ $client->id }}" name="client_id" id="">
                                    <input type="hidden" value="{{ $document->id }}" name="doc_id" id="">
                                    <input type="submit" id="" value="Rejeitar" class="btn btn-danger btn-sm">
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <div class='form-horizontal'>
            <form action="{{ url('admin/documents/active',$client_id) }}" method='post'>
                @csrf
                <div class='row'>
                    <div class='col-md-4'>
                        <label for="">Cliente</label>
                        <input type="text" name="" id="" value="{{ $client->name }}" class="form-control">
                    </div>
                    <div class='col-md-3'>
                        <label for="">Cliente</label>
                        <input type="text" name="" id="" value="{{ $client->status }}" class="form-control">
                    </div>
                    <div class='col-md-2'>
                        <label for="">&nbsp;</label>
                        <input type="hidden" value="ativar" name="ativar" id="">
                        <input type="submit" name="" id="" value="Ativar" class="form-control btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection