<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>BitBoi</title>
    <link rel="icon" href="{{ asset('assets') }}/painel/images/favicon-32x32.png" type="image/png" />
    <link href="{{ asset('assets') }}/painel/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('assets') }}/painel/js/pace.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets') }}/painel/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/painel/css/icons.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/painel/css/app.css" />
    <script src="{{ asset('assets') }}/painel/js/jquery.min.js"></script>
</head>

<body class="bg-theme bg-theme7">
    <div class="wrapper">
        <div class="section-authentication-register d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="card radius-15">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->
    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>

    <script src="<?php echo asset('assets'); ?>/js/jquery.mask.js"></script>
    <script>
        $('.moeda').mask("#.##0,00", {
            reverse: true
        });
        $('.data').mask("00/00/0000");
        $('.fone').mask("(99) 9 9999-9999", {
            clearIfNotMatch: true
        });
        $('.cpf').mask("000.000.000-00", {
            clearIfNotMatch: true
        });
    </script>

</body>

</html>