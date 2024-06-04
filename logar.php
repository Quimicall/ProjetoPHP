<?php

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){
    
    require 'conexao2.php';
    require 'Usuario.class.php';

    $u = new Usuario();

    $login = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if($u->login($login, $senha) == true){
        if(isset($_SESSION['idUser'])){

            header("Location: index.php");

        }else{

            header("Location: login.php");

        }
    }else{

        header("Location: login.php");

    };

}else{

    header("Location: login.php");

}





?>
