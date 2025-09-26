<?php
spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});

$usuario = new Usuario();
$dados = null;

// Se for edição, busca o usuário
if (filter_has_var(INPUT_GET, "id")) {
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    $dados = $usuario->search("id_usuario", $id);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gerenciar Usuário</title>
</head>
<body class="container mt-4">
    <h3>Gerenciar Usuário</h3>
    <form method="post" action="dbUsuario.php" enctype="multipart/form-data" class="row g-3">
        <input type="hidden" name="idUsuario" value="<?php echo $dados['id_usuario'] ?? ''; ?>">

        <div class="col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" 
                value="<?php echo $dados['nome'] ?? ''; ?>" required>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" 
                value="<?php echo $dados['email'] ?? ''; ?>" required>
        </div>

        <div class="col-md-6">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control" accept=".jpg,.jpeg,.png" required>
            <?php if (!empty($dados['foto'])): ?>
                <img src="uploads/<?php echo $dados['foto']; ?>" width="100" class="mt-2 rounded">
            <?php endif; ?>
        </div>

        <div class="col-12">
            <button type="submit" name="btnGravar" class="btn btn-success">Salvar</button>
            <a href="usuario.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</body>
</html>
