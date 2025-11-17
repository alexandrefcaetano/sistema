<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <script src="{{ asset('assets/vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/general/wnumb/wNumb.js')}}" type="text/javascript"></script>
</head>
<body>
<h2>Login</h2>

@if ($errors->any())
    <div style="color: red;">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('login.post') }}">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Senha:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Entrar</button>
</form>
</body>
</html>

    <script>
        $(document).ready(function() {
            // Preencher inputs de texto
            $('input[name="password"]').val('BRB@2025');
            $('input[name="email"]').val('eudora02@example.net');

        });
    </script>

