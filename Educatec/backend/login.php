<?php

    require_once("config.php");

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $aluno = new Usuario();

    $aluno->login($email, $senha);

?>