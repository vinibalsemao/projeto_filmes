<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../models/conexao.php';

if ((isset($_POST['nome'])) && (isset($_POST['email'])) && (isset($_POST['senha']))) {
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    $sql_code = "INSERT INTO usuarios (nome, email, senha) VALUES ('{$nome}', '{$email}', '{$senha}')";
    $sql_code = $mysqli->query($sql_code) or die($mysqli->error);

    if ($sql_code) {
        header("Location: ../views/pages/login.php");
    } else {
        header("Location: ../views/pages/cadastro.php");
    }
}
