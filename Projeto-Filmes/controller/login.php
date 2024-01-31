<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../models/conexao.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
    if (strlen($_POST['email']) == 0) {
        header("Location: ../views/pages/login.php");
    } else if (strlen($_POST['senha']) == 0) {
        header("Location: ../views/pages/login.php");
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_code = $mysqli->query($sql_code) or die($mysqli->error);

        $qtd = $sql_code->num_rows;

        if ($qtd == 1) {
            $usuario = $sql_code->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: ../views/pages/index.php");
        } else {
            $_SESSION['erro'] = "Erro ao logar!";
            header("Location: ../views/pages/login.php");
        }
    }
}
