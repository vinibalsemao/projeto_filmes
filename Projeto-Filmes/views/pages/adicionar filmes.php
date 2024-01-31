<?php  
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

if(!isset($_SESSION['nome'])){
    header("Location: ../pages/login.php");
    exit();
}

include_once('../templates/header.php');
?>

<style>
    .container-body {
        max-width: 600px;
        margin: 50px auto;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        color: #fff;
        text-align: center;
    }

    .custom-file-label {
        overflow: hidden;
        white-space: nowrap;
    }

    .custom-file-input::-webkit-file-upload-button {
        visibility: hidden;
    }

    .custom-file-input::before {
        content: 'Escolher Imagem';
        display: inline-block;
        background: linear-gradient(top, #f9f9f9, #e3e3e3);
        border: 1px solid #999;
        border-radius: 3px;
        padding: 5px 8px;
        outline: none;
        white-space: nowrap;
        cursor: pointer;
        text-shadow: 1px 1px #fff;
        font-weight: 700;
        font-size: 10pt;
    }

    .custom-file-input:hover::before {
        border-color: black;
    }

    .custom-file-input:active::before {
        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
    }
</style>

<script>
    function validarAno() {
        var anoInput = document.getElementById('ano');
        var ano = parseInt(anoInput.value);

        var anoAtual = new Date().getFullYear();

        var anoMinimo = 1900;

        if (isNaN(ano) || ano < anoMinimo || ano > anoAtual) {
            alert('Por favor, insira um ano válido.');
            anoInput.value = '';
        }
    }
</script>

<body>
    <div class="container-body">
        <div class="card">
            <div class="card-header bg-dark">
                <h3>Adicionar Filme</h3>
            </div>
            <div class="card-body">
                <form method="post" id="formulario" action="../../controller/adicionar-filmes.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite o título do filme" required>
                    </div>
                    <div class="form-group">
                        <label for="sinopse">Sinopse:</label>
                        <textarea class="form-control" id="sinopse" rows="4" name="sinopse" placeholder="Digite a sinopse do filme" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="diretor">Diretor:</label>
                        <input type="text" class="form-control" id="diretor" name="diretor" placeholder="Digite o diretor do filme" required>
                    </div>
                    <div class="form-group">
                        <label for="elenco">Elenco:</label>
                        <textarea class="form-control" id="elenco" name="elenco" rows="4" placeholder="Digite o elenco do filme" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="diretor">Ano:</label>
                        <input type="text" onblur="validarAno()" name="lancamento" class="form-control" id="ano" placeholder="Digite o ano de lançamento do filme" required>
                    </div>
                    <div class="form-group">
                        <label for="genero">Selecione um gênero:</label>
                        <select multiple class="form-control" id="genero" name="genero">
                            <option value="Ação e Aventura">Ação e Aventura</option>
                            <option value="Comédia">Comédia</option>
                            <option value="Drama">Drama</option>
                            <option value="Comédia Romântica">Comédia Romântica</option>
                            <option value="Ficção Científica">Ficção Científica</option>
                            <option value="Terror">Terror</option>
                            <option value="Animação">Animação</option>
                            <option value="Musical">Musical</option>
                            <option value="Suspense">Suspense</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Imagem do Filme:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imagem" name="imagem" accept="image/*" required>
                            <label class="custom-file-label" for="imagem">Escolher arquivo</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block">Adicionar Filme</button>
                </form>
            </div>
        </div>
    </div>
</body>