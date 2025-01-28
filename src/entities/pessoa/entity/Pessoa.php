<?php

class Pessoa {
    private $conn;
    private $table = "Pessoa";

    public $idPessoa;
    public $nome;
    public $cpf;
    public $idade;
    public $profissao;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById($idPessoa) {
        $query = "SELECT * FROM " . $this->table . " WHERE idPessoa = :idPessoa";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":idPessoa", $idPessoa);
        $stmt->execute();
    
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (nome, cpf, idade, profissao) VALUES (:nome, :cpf, :idade, :profissao)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":idade", $this->idade);
        $stmt->bindParam(":profissao", $this->profissao);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET nome = :nome, cpf = :cpf, idade = :idade, profissao = :profissao WHERE idPessoa = :idPessoa";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":idPessoa", $this->idPessoa);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":idade", $this->idade);
        $stmt->bindParam(":profissao", $this->profissao);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE idPessoa = :idPessoa";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":idPessoa", $this->idPessoa);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
