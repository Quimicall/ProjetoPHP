<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de acesso</title>


    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/login.css">

</head>
<body>
    
    <form class="form-signin" action="logar.php" method="POST">
        <div class="card">
            <div class="card-top">
                <img class="imgLogin" src="images/userPadron.png" alt="">
                <h2 class="title">Acesso ao sistema</h2>
                <p>Seja Bem-vindo</p>
            </div>

            <div class="card-group">

                <label>Email</label>
                <input type="email" name="email" placeholder="Digite seu email" required>

            </div>

            <div class="card-group">

                <label>Senha</label>
                <input type="password" name="senha" placeholder="Digite sua senha" required>

            </div>

            <div class="card-group">

                <label><input type="checkbox">Lembre-me</label>

            </div>

            <div class="card-group btn">

                <button type="submit">ACESSAR</button>

            </div>

        </div>
        
    </form>
    