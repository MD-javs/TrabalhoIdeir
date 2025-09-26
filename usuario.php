<?php
spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});

$usuario = new Usuario();
$lista = $usuario->listAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/baseSite.css">
    <title>Usuários</title>
</head>

<body class="container mt-4">
    <h3>Usuários Cadastrados</h3>
    <a href="gerUsuario.php" class="btn btn-primary mb-3">Novo Usuário</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Foto</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $u): ?>
                <tr>
                    <td><?php echo $u['id_usuario']; ?></td>
                    <td><?php echo $u['nome']; ?></td>
                    <td><?php echo $u['email']; ?></td>
                    <td>
                        <?php if (!empty($u['foto'])): ?>
                            <img src="uploads/<?php echo $u['foto']; ?>" width="60" class="rounded">
                        <?php endif; ?>
                    </td>
                    <td>
                        
                        <a href="dbUsuario.php?del=<?php echo $u['id_usuario']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Deseja excluir este usuário?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>