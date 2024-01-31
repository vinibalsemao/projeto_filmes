<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once('../models/conexao.php');

if (isset($_GET['id'])) {
    $id_filme = $_GET['id'];

    $consulta = $mysqli->query("SELECT * FROM filmes WHERE Id_filme = $id_filme");
    $filme = $consulta->fetch_assoc();

    $mysqli->query("DELETE FROM filmes WHERE Id_filme = $id_filme");

    header("Location: ../views/pages/lista-filmes.php");
    exit();
} else {
    header("Location: ../views/pages/lista-filmes.php");
    exit();
}
