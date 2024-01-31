<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once('../templates/header.php');
include_once('../../models/conexao.php');

if (isset($_GET['id'])) {
    $id_filme = $_GET['id'];

    $stmt = $mysqli->prepare("SELECT * FROM filmes WHERE Id_filme = ?");
    $stmt->bind_param("i", $id_filme);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $filme = $result->fetch_assoc();
    }
}

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
                <h3>Editar Filme</h3>
            </div>
            <div class="card-body">
                <form method="post" id="formulario" action="../../controller/editar-filmes.php">
                    <!-- Campos preenchidos com os dados do filme -->
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite o título do filme" value="<?= $filme['titulo'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="sinopse">Sinopse:</label>
                        <textarea class="form-control" id="sinopse" rows="4" name="sinopse" placeholder="Digite a sinopse do filme" required><?= $filme['sinopse'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="diretor">Diretor:</label>
                        <input type="text" class="form-control" id="diretor" name="diretor" placeholder="Digite o diretor do filme" value="<?= $filme['diretor'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="elenco">Elenco:</label>
                        <textarea class="form-control" id="elenco" name="elenco" rows="4" placeholder="Digite o elenco do filme" required><?= $filme['elenco'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="lancamento">Ano:</label>
                        <input type="text" onblur="validarAno()" name="lancamento" class="form-control" id="ano" placeholder="Digite o ano de lançamento do filme" value="<?= $filme['ano'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="genero">Selecione um gênero:</label>
                        <select multiple class="form-control" id="genero" name="genero">
                            <option value="Ação e Aventura" <?= in_array('Ação e Aventura', explode(", ", $filme['genero'])) ? 'selected' : '' ?>>Ação e Aventura</option>
                            <option value="Comédia" <?= in_array('Comédia', explode(", ", $filme['genero'])) ? 'selected' : '' ?>>Comédia</option>
                            <option value="Drama" <?= in_array('Drama', explode(", ", $filme['genero'])) ? 'selected' : '' ?>>Drama</option>
                            <option value="Comédia Romântica" <?= in_array('Comédia Romântica', explode(", ", $filme['genero'])) ? 'selected' : '' ?>>Comédia Romântica</option>
                            <option value="Ficção Científica" <?= in_array('Ficção Científica', explode(", ", $filme['genero'])) ? 'selected' : '' ?>>Ficção Científica</option>
                            <option value="Terror" <?= in_array('Terror', explode(", ", $filme['genero'])) ? 'selected' : '' ?>>Terror</option>
                            <option value="Animação" <?= in_array('Animação', explode(", ", $filme['genero'])) ? 'selected' : '' ?>>Animação</option>
                            <option value="Musical" <?= in_array('Musical', explode(", ", $filme['genero'])) ? 'selected' : '' ?>>Musical</option>
                            <option value="Suspense" <?= in_array('Suspense', explode(", ", $filme['genero'])) ? 'selected' : '' ?>>Suspense</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?= $id_filme ?>">
                    <button type="submit" class="btn btn-dark btn-block">Concluir Edição</button>
                </form>
            </div>
        </div>
    </div>
</body>