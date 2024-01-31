<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (!isset($_SESSION['nome'])) {
    header("Location: ../pages/login.php?message=login_required");
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
</style>

<body>
    <div class="container-body">
        <?php
        include_once('../../models/conexao.php');

        if (isset($_GET['id'])) {
            $id_filme = $_GET['id'];

            $stmt = $mysqli->prepare("SELECT * FROM filmes WHERE Id_filme = ?");
            $stmt->bind_param("i", $id_filme);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $stmt->close();

            if ($filme = $resultado->fetch_assoc()) {
        ?>
                <div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="card-title"><?= $filme['titulo'] ?></h5>
                    </div>
                    <img src="data:image/jpeg;base64,<?= $filme['imagem'] ?>" class="card-img-top" alt="Imagem do Filme">

                    <div class="card-body">
                        <form method="post" id="formulario" action="../../controller/avaliar-filme.php?id=<?= $id_filme ?>">
                            <div class="form-group">
                                <label for="nota">Nota:</label>
                                <input type="number" class="form-control" id="nota" name="nota" min="1" max="10" placeholder="Digite a nota que você dá pro filme (1 até 10)" required>
                            </div>
                            <div class="form-group">
                                <label for="avaliacao">Avaliação:</label>
                                <textarea class="form-control" id="avaliacao" rows="4" name="avaliacao" placeholder="Digite a sua opinião sobre o filme" required></textarea>
                            </div>

                            <input type="hidden" name="id_filme" value="<?= $id_filme ?>">
                            <button type="submit" class="btn btn-dark btn-block">Registrar Avaliação</button>
                        </form>
                    </div>
                </div>
        <?php
            } else {
                echo "<p>Filme não encontrado.</p>";
            }
        } else {
            echo "<p>ID do filme não fornecido.</p>";
        }
        ?>
    </div>
</body>