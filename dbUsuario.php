<?php
spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});

$usuario = new Usuario();

if (filter_has_var(INPUT_POST, "btnGravar")) {
    $nome  = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    $fotoNome = null;
    if (!empty($_FILES['foto']['name'])) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $fotoNome = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $fotoNome);
    }

    $usuario->add([
        "nome"  => $nome,
        "email" => $email,
        "senha" => $senha,
        "foto"  => $fotoNome
    ]);

    header("location: usuario.php");
    exit;
}

if (filter_has_var(INPUT_GET, "del")) {
    $id = filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT);

    $dadosUsuario = $usuario->search("id_usuario", $id);
    if (!empty($dadosUsuario)) {
        $foto = $dadosUsuario[0]->foto; 

        if ($foto && file_exists("uploads/" . $foto)) {
            unlink("uploads/" . $foto);
        }
    }

    $usuario->delete("id_usuario", $id);

    header("location: usuario.php");
    exit;
}
