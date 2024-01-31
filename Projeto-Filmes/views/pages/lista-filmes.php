<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once('../templates/header-index.php');
include_once('../../models/conexao.php');
?>

<style>
    .container-body {
        margin: 50px;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .card-img-top {
        max-height: 300px;
        object-fit: cover;
    }
</style>

<script>
    function redirecionarPara(acao, id) {
        if (acao === 'editar') {
            window.location.href = '../pages/editar-filmes.php?id=' + id;
        } else if (acao === 'excluir') {
            window.location.href = '../../controller/excluir-filme.php?id=' + id;
        }
    }
</script>

<body>

    <div class="container-body">
        <h2 class="text-center mb-4">Todos os Filmes</h2>

        <div class="row">

            <?php
            $result = $mysqli->query("SELECT * FROM filmes");

            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="col-lg-4">
                    <div class="card">
                        <img src="data:image/jpeg;base64,<?= $row['imagem'] ?>" class="card-img-top" alt="Imagem do Filme">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['titulo'] ?> (<?= $row['nota'] ?>)</h5>
                            <p class="card-text m-0"><b>Diretor:</b> <?= $row['diretor'] ?></p>
                            <p class="card-text m-0"><b>Ano:</b> <?= $row['ano'] ?></p>
                            <p class="card-text m-0"><b>Gênero:</b> <?= $row['genero'] ?></p>
                            <p class="card-text m-0"><b>Elenco:</b> <?= $row['elenco'] ?></p>
                            
                            <hr class="dropdown-divider">

                            <p class="card-text m-0"><b>Sinopse:</b> <?= $row['sinopse'] ?></p>

                            <hr class="dropdown-divider">

                            <a href="../pages/avaliar-filmes.php?id=<?= $row['Id_filme'] ?>">Avaliar filme</a>
                            <div class="btn-group" role="group" aria-label="Ações">
                                <button type="button" class="btn" onclick="redirecionarPara('editar', <?= $row['Id_filme'] ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button type="button" class="btn" onclick="redirecionarPara('excluir', <?= $row['Id_filme'] ?>)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</body>