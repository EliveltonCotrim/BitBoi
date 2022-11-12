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
                Clientes

                <hr>


                <div class='card'>
                    <div class='card-body'>


                        <table class='table table-bordered table-hover table-striped table-xs table-condensed'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Nick</th>
                                    <th>Email</th>
                                    <th>Expiração do Plano</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($clients as $key => $dado) {
                                ?>
                                    <tr>
                                        <td><?php echo $dado->id; ?></td>
                                        <td><?php echo $dado->name; ?></td>
                                        <td><?php echo $dado->user; ?></td>
                                        <td><?php echo $dado->email; ?></td>
                                        <td>
                                            {{ $dado->plan->expiration }}
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</body>

</html>