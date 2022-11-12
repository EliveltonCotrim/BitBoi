@extends('client.index_client')
@section('title','Pagamento')

@section('content')

<div class='card'>
    <div class='card-body'>
        <div class='row'>
            <div class="col-md-12">
                <h2 class="text-center">
                    1° - Deposite
                    <span class="text-success"> <b> @money($boleto->valor) </b> </span>
                    em uma das contas a baixo
                </h2>
            </div>
        </div>

        <div class='row'>
            <div class="col-md-2">
            </div>
            <div class="col-md-4 text-center">
                <div class="card shadow p-5">

                </div>

            </div>
            <div class="col-md-4 text-center">
                <div class="card shadow p-5">


                </div>
            </div>
        </div>
        <hr>
        <div class='row'>
            <div class="col-md-12">
                <h2 class="text-center">
                    2° - Envie o comprovante
                </h2>
            </div>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <div class='row text-center'>
                <div class="col-md-12 mt-4 text-center">
                    <input type="file" class="form-control" required name="comprovante">
                </div>
                <div class="col-md-12 mt-4">
                    <div class="col-md-12 mt-4">
                        @csrf
                        <button type="submit" class="btn btn-primary m-1 px-5 radius-30">
                            Enviar Comprovante
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection