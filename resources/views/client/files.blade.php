@extends('client.index_client')
@section('title', 'Arquivos/Contratos')

@section('content')

<div class='card'>
    <div class='card-body'>



        <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th>Arquivo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($files as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->name; ?></td>
                        <td>
                            <span class="bx bxs-file-pdf btn btn-default"></span>

                        </td>
                        <td>
                            <a href='<?php echo url('client/files/open/' . $dado->id) ?>' class='btn btn-success btn-sm' target="_blanck">
                                <span class='bx bx-download'></span>
                                Baixar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>
</div>

@endsection