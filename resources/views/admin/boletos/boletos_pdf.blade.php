<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="">

    <style>
        table {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 2px;
        }

        thead th {
            width: 25%;
        }
    </style>

    <div class='card'>
        <div class='card-body'>

            <h2 style="text-align: center;">
                Vendas

                <br>
                {{ Carbon\Carbon::parse($filters['start'])->format('d/m/Y') .' a '. Carbon\Carbon::parse($filters['end'])->format('d/m/Y') }}
            </h2>

            <hr>

            <div class='row'>
                <div class='col-md-3'>
                    <div class="card p-2">
                        Valor Total:
                        @money($valor_total)
                    </div>
                </div>


                <div class='col-md-3'>
                    <div class="card p-2">
                        Quantidade:
                        {{ $boletos->count() }}
                    </div>
                </div>
            </div>

            <hr>

            <table class="table-auto">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th>TX ID</th>
                        <th>Meio</th>
                        <th>Data de <br> Confirmação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($boletos as $key => $dado) {
                    ?>
                        <tr>
                            <td><?php echo $dado->user->name; ?></td>
                            <td>@money($dado->valor)</td>
                            <td><?php echo $dado->transaction_id; ?></td>
                            <td><?php echo $dado->meioPagamento; ?></td>
                            <td><?php echo $dado->dataConfirmacao; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>