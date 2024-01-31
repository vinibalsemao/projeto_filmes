<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once('../models/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nota'], $_POST['avaliacao'])) {
        if (isset($_GET['id'])) {
            $id_filme = $_GET['id'];
        } else {
            echo "ID do filme não fornecido.";
            exit();
        }

        $nota = $_POST['nota'];
        $avaliacao = $_POST['avaliacao'];

        $stmt = $mysqli->prepare("UPDATE filmes SET nota=?, avaliacao=?, avaliado='Sim' WHERE Id_filme=?");
        $stmt->bind_param("iss", $nota, $avaliacao, $id_filme);

        if ($stmt->execute()) {
            header("Location: ../views/pages/lista-filmes.php?id=" . $id_filme);
            exit();
        } else {
            echo "Erro ao avaliar o filme: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Campos obrigatórios ausentes.";
    }
} else {
    exit();
}
