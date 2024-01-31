<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../models/conexao.php';

if((isset($_POST['titulo'])) && (isset($_POST['sinopse'])) && (isset($_POST['diretor'])) && (isset($_POST['elenco'])) && (isset($_POST['lancamento'])) && (isset($_POST['genero']))){
    $titulo = $mysqli->real_escape_string($_POST['titulo']);
    $sinopse = $mysqli->real_escape_string($_POST['sinopse']);
    $diretor = $mysqli->real_escape_string($_POST['diretor']);
    $elenco = $mysqli->real_escape_string($_POST['elenco']);
    $lancamento = $mysqli->real_escape_string($_POST['lancamento']);
    $genero = $mysqli->real_escape_string($_POST['genero']);
    $imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
    $imagem = base64_encode($imagem);

    $sql_code = "INSERT INTO filmes (titulo, sinopse, diretor, elenco, ano, genero, imagem) VALUES ('{$titulo}', '{$sinopse}', '{$diretor}', '{$elenco}', '{$lancamento}', '{$genero}', '{$imagem}')";
    $sql_code = $mysqli->query($sql_code) or die($mysqli->error);
    
    if($sql_code){
        header("Location: ../views/pages/lista-filmes.php");
    } else {
        header("Location: ../views/pages/adicionar-filmes.php");
    }
}