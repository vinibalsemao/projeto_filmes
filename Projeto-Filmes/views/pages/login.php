<?php
include_once('../templates/header.php');
?>
<style>
    .container-body {
        max-width: 400px;
        margin: 100px auto;
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
        <div class="card">
            <div class="card-header bg-dark">
                <h3>Login no CineOpiniões</h3>
            </div>
            <div class="card-body">
                <form method="post" id="formulario" novalidate action="../../controller/login.php">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block">Entrar</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <p>Ainda não tem uma conta? <a href="../pages/cadastro.php">Cadastre-se aqui</a></p>
            </div>
        </div>
    </div>
</body>