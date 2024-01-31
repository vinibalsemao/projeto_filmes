<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once('../models/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['titulo'], $_POST['sinopse'], $_POST['diretor'], $_POST['elenco'], $_POST['lancamento'], $_POST['genero'])) {
        $id_filme = $_POST['id'];
        $titulo = $_POST['titulo'];
        $sinopse = $_POST['sinopse'];
        $diretor = $_POST['diretor'];
        $elenco = $_POST['elenco'];
        $ano = $_POST['lancamento'];
        $genero = $_POST['genero'];

        $stmt = $mysqli->prepare("UPDATE filmes SET titulo=?, sinopse=?, diretor=?, elenco=?, ano=?, genero=? WHERE Id_filme=?");
        $stmt->bind_param("ssssssi", $titulo, $sinopse, $diretor, $elenco, $ano, $genero, $id_filme);

        if ($stmt->execute()) {
            header("Location: ../views/pages/lista-filmes.php?id=" . $id_filme);
            exit();
        } else {
            echo "Erro ao atualizar o filme: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Campos obrigatórios ausentes.";
    }
} else {
    exit();
}
