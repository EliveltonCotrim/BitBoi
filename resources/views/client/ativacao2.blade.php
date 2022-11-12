@extends('client.index_client')
@section('title','Validação de Documentos')
@section('ativacao','open')


@section('content')

<div class="card">
    <div class="card-header">
        Ativação
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover">
                    <tbody>

                        <tr>
                            <td>Documento de Identidade</td>
                            <td><?php echo $doc_frente->status ?? 'pendente' ?></td>
                            @if(isset($doc_frente->status) && ($doc_frente->status == 'enviado' || $doc_frente->status == 'aceito'))
                            <td>{{ $doc_frente->status }}</td>
                            @else
                            <td>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" required name="doc" class='form-contro'>
                                    <input type="hidden" value="doc_frente" name="tipo" class='btn btn-primary'>
                                    <input type="submit" class='btn btn-success'>
                                </form>
                            </td>
                            @endif
                        </tr>

                        <tr>
                            <td>Selfie com Documento de Identidade</td>
                            <td><?php echo $doc_selfie->status ?? 'pendente' ?></td>
                            @if(isset($doc_selfie->status) && ($doc_selfie->status == 'enviado' || $doc_selfie->status == 'aceito'))
                            <td>{{ $doc_selfie->status }}</td>
                            @else
                            <td>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" required name="doc" class='form-contro'>
                                    <input type="hidden" value="doc_selfie" name="tipo" class='btn btn-primary'>
                                    <input type="submit" class='btn btn-success'>
                                </form>
                            </td>
                            @endif
                        </tr>

                        <tr>
                            <td>Comprovante de Residência</td>
                            <td><?php echo $doc_endereco->status ?? 'pendente' ?></td>
                            @if(isset($doc_endereco->status) && ($doc_endereco->status == 'enviado' || $doc_endereco->status == 'aceito'))
                            <td>{{ $doc_endereco->status }}</td>
                            @else
                            <td>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" required name="doc" class='form-contro'>
                                    <input type="hidden" value="doc_endereco" name="tipo" class='btn btn-primary'>
                                    <input type="submit" class='btn btn-success'>
                                </form>
                            </td>
                            @endif
                        </tr>




                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection