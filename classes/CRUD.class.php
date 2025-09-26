<?php
abstract class CRUD
{
    protected $tabela;
    protected $db;
    protected $campos = [];

    public function __construct($tabela)
    {
        $this->tabela = $tabela;
        $this->db = Database::getInstance()->getConnection();
    }

    public function add($dados)
    {
        $campos = implode(", ", array_keys($dados));
        $placeholders = implode(", ", array_map(fn($k) => ":$k", array_keys($dados)));

        $sql = "INSERT INTO {$this->tabela} ({$campos}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);

        foreach ($dados as $campo => $valor) {
            $stmt->bindValue(":$campo", $valor);
        }

        return $stmt->execute();
    }

    public function update($colunaId, $id)
    {
        $set = [];
        foreach ($this->campos as $coluna => $valor) {
            $set[] = "$coluna = :$coluna";
        }
        $sql = "UPDATE {$this->tabela} SET " . implode(", ", $set) . " WHERE $colunaId = :id";
        $stmt = $this->db->prepare($sql);

        $this->campos['id'] = $id;
        return $stmt->execute($this->campos);
    }

    public function delete($colunaId, $id)
    {
        $sql = "DELETE FROM {$this->tabela} WHERE $colunaId = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function search($colunaId, $id)
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE $colunaId = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result ?: []; 
    }

    public function listAll()
    {
        $sql = "SELECT * FROM {$this->tabela}";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function iniciarTransacao()
    {
        $this->db->beginTransaction();
    }
    public function confirmarTransacao()
    {
        $this->db->commit();
    }
    public function cancelarTransacao()
    {
        $this->db->rollBack();
    }
}
