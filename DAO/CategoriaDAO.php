<?php

namespace AulaThiagotas\DAO;

use AulaThiagotas\DAO\DAO;
use AulaThiagotas\Model\Categoria;

final class CategoriaDAO extends DAO{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Categoria $model) : Categoria
    {
        return ($model->Id == null) ? $this->insert($model): 
        $this->update($model);
    }

    public function insert(Categoria $model) : Categoria
    {
        $sql = "INSERT INTO categoria(nome) VALUES (?)";

        $stmt = parent::$conexao->prepare($sql);
        $stmt -> bindValue(1, $model->Nome);
        $stmt->execute();

        $model->Id = parent::$conexao->lastInsertId();
        return $model;
    }

    public function update(Categoria $model) : Categoria
    {
        $sql = "UPDATE categoria SET nome=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->execute();

        return $model;
    }

    public function selectById(int $id) : ?Categoria
    {
        $sql = "SELECT * FROM categoria WHERE id=?";

        $stmt=parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject('AulaThiagotas\Model\Categoria');
    }

    public function select() : array
    {
        $sql = "SELECT * FROM categoria";

        $stmt=parent::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "AulaThiagotas\Model\Categoria");

    }
    
    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM categoria WHERE  id=?";

        $stmt=parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}