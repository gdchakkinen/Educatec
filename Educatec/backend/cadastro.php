<?php

    require_once("config.php");

    echo $nome = $_POST["nome"];
    echo $sobrenome = $_POST["sobrenome"];
    echo $email = $_POST["email"];
    echo $senha = $_POST["senha"];
    echo $endereco = $_POST["endereco"];
    echo $numero = $_POST["numero"];
    echo $cidade = $_POST["cidade"];
    echo $estado = $_POST["estado"];

    $sql = new Sql();
    $aluno = new Usuario();
    $result = $aluno->insert($email, $nome, $sobrenome, $senha, $endereco, $numero, $cidade, $estado);

?>