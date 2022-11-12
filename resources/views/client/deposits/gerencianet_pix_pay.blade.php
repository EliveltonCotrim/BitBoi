<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagamento PIX</title>
    <meta name="author" content="">
    <meta name="description" content="">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <script src="{{ asset('assets') }}/painel/js/vendor/jquery-3.6.0.min.js"></script>
</head>

<body class="" style="font-family:'Lato',sans-serif;">
    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-sky-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div class="divide-y divide-gray-200">
                        <div class="py-1 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7 ">

                            <p class="text-center text-4xl">Depósito PIX</p>
                            <p class="text-center text-2xl">Valor: @money($deposit->valor)</p>

                            <section class="hero container max-w-screen-lg mx-auto pb-10">
                                <img class="mx-auto" src="https://quickchart.io/qr?text=<?php echo $qrcode  ?>" alt="" style="width: 60%;">
                            </section>

                            <p>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                    PIX Copia e Cola
                                </label>
                                <input value="<?php echo $qrcode ?>" readonly class="js-copytextarea shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                                <button class="js-textareacopybtn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                                    Copiar Pix
                                </button>
                            </p>

                        </div>
                        <div class="pt-6 text-base leading-6 font-bold sm:text-lg sm:leading-7">
                            <p>
                                <a href="<?php echo url('client/depositos') ?>" class="text-cyan-600 hover:text-cyan-700">
                                    Voltar
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form method="post" id="myForm" action="someURL">
        @csrf
    </form>

    <script>
        $(function() {

            setInterval(function() {
                loop()
            }, 7000);

            function loop() {

                $.ajax({
                    type: 'POST',
                    url: "<?php echo url('client/gerencianet/pix/consult'); ?>",
                    data: {
                        compra: "{{ Crypt::encrypt($deposit->id) }}",
                        "_token": "{{ csrf_token() }}",
                    },
                    beforeSend: function(d) {
                        $('#tituloModal').html("Consultando");
                    },
                    success: function(msg) {
                        if (msg == 'pago') {
                            alert('Pagamento Confirmado');
                            window.location.href = "{{ url('client/depositos') }}";
                        }
                    },
                    error: function(result) {
                        console.log(result);
                        $("#div_result").html(
                            "erro"
                        );
                    },
                    fail: (function(status) {
                        $("#div_result").html('Fail: ' + status);
                        $('#myModal').modal('hide');
                    }),
                });

            }

        });


        var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

        copyTextareaBtn.addEventListener('click', function(event) {
            var copyTextarea = document.querySelector('.js-copytextarea');
            copyTextarea.focus();
            copyTextarea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
            } catch (err) {
                console.log('Oops, unable to copy');
            }
        });
    </script>



</body>

</html>