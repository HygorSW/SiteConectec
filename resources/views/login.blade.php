<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{url('assets/css/login.css')}}">
</head>
<body>

    <div class="main">
        <div class="loginCont" id="step1">
            <form method="POST" action="{{url('login')}}" enctype="multipart/form-data" id="loginForm">
                @csrf

                <div class="logo">
                    <div class="headerLogo">
                        <i class="fa-brands fa-cloudversify"></i>
                        <h2>Conectec</h2>
                    </div>
                    <button class="botaoLoginNav">Login</button>
                </div>

                @if(session()->has('success'))

                    {{ session()->get('success')}}
                @endif

                <div class="tituloCadastro">
                    <h1>Entre na sua conta</h1>
                    <p>Bem-vindo de volta, acesse  conta para continuar.</p>                   
                </div>

                @error('error')
                    <span>{{ $message }} </span>
                @enderror

                <div class="grupo-inputs">
                    <div class="inputForm">
                        <label for="email">E-mail</label>
                        <div class="inputText">
                            <input type="email" id="emailUser" name="email" placeholder="Ex: nome@gmail.com">
                        </div>
                    </div>

                    <div class="inputForm">
                        <label for="password">Senha</label>
                        <div class="inputText">
                            <input type="password" id="senha" name="password" placeholder="Ex: 1234567">
                        </div>
                    </div>
                    <button class="botaoContinuar" type="submit">Entrar</button>
                </form>
            </div>

           

    <!-- Carregar jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Carregar o Bootstrap corretamente -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

   <!-- <script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault(); // Impede o envio padrão do formulário

            // Coletar os dados do formulário
            var formData = {
                emailUser: $('#email').val(),
                senha: $('#password').val(),
                _token: $('input[name="_token"]').val() // CSRF token
            };

            // Fazer a requisição AJAX
            $.ajax({
                url: '/login', // Substitua pela rota correta do Laravel
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = '/home'; // Redirecionar para a home (ou outra página)
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        $('#errorMessage').text('Senha ou email incorreto.');
                        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    } else {
                        $('#errorMessage').text('Ocorreu um erro. Tente novamente.');
                        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    }
                }
            });
        });
    });
   </script> -->
</body>
</html>