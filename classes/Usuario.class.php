<?php
class Usuario extends CRUD
{
    public function __construct()
    {
        parent::__construct("usuario");
    }

    public function setNome($nome)
    {
        $this->campos['nome'] = $nome;
    }
    public function setEmail($email)
    {
        $this->campos['email'] = $email;
    }
    public function setSenha($senha)
    {
        $this->campos['senha'] = $senha;
    }
    public function setNivel($nivel)
    {
        $this->campos['nivel'] = $nivel;
    }

    public function getNome()
    {
        return $this->campos['nome'] ?? null;
    }
    public function getEmail()
    {
        return $this->campos['email'] ?? null;
    }

    public function login()
    {
        $sql = "SELECT * FROM usuario WHERE nome = :nome";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nome' => $this->campos['nome']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->campos['senha'], $user['senha'])) {
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['user_name'] = $user['nome'];
            return "Login realizado com sucesso!";
        }
        return "Usuário ou senha inválidos.";
    }

    public function alterarSenha($senhaAtual)
    {
        $sql = "SELECT senha FROM usuario WHERE nome = :nome";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nome' => $this->campos['nome']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senhaAtual, $user['senha'])) {
            $sql = "UPDATE usuario SET senha = :senha WHERE nome = :nome";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':senha' => password_hash($this->campos['senha'], PASSWORD_DEFAULT),
                ':nome' => $this->campos['nome']
            ]);
        }
        return false;
    }

    public function atualiza_email()
    {
        $sql = "UPDATE usuario SET email = :email WHERE nome = :nome";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':email' => $this->campos['email'],
            ':nome' => $this->campos['nome']
        ]);
    }
}
