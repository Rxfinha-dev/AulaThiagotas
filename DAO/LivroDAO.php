<?php

namespace AulaThiagotas\DAO;

use AulaThiagotas\Model\Livro;

/**
 * As classes DAO (Data Access Object) são responsáveis por executar os
 * SQL junto ao banco de dados.
 */
final class LivroDAO extends DAO
{
     /**
     * Método construtor, sempre chamado na classe quando a classe é instanciada.
     * Exemplo de instanciar classe (criar objeto da classe):
     * $dao = new AlunoDAO();
     */
    public function __construct()
    {
        /**
         * Chamando o construtor da classe DAO, isto é, toda vez que chamos o consturo da classe DAO
         * estamos fazendo a conexão com o banco de dados.
         */
        parent::__construct();
    }

    public function save(Livro $model) : Livro
    {
        /**
         * Uso do operador ternário para verificar se trata-se de uma inserção
         * ou de uma exclusão. Tem o mesmo efeito de um if...else, porém mais compacto.
         */
        return ($model->Id == null) ? $this->insert($model) : $this->update($model);
    }


    /**
     * Método que recebe um model e extrai os dados do model para realizar o insert
     * na tabela correspondente ao model. Note o tipo do parâmetro declarado.
     */
    public function insert(Livro $model) : Livro
    {
        parent::$conexao->beginTransaction();
        
        $sql = "INSERT INTO livro (id_categoria, titulo, ano, editora, isbn) VALUES (?, ?, ?, ?, ?) ";      
        $stmt = parent::$conexao->prepare($sql);    
        $stmt->bindValue(1, $model->Id_Categoria);
        $stmt->bindValue(2, $model->Titulo);
        $stmt->bindValue(3, $model->Ano);
        $stmt->bindValue(4, $model->Editora);
        $stmt->bindValue(5, $model->Isbn);
        $stmt->execute();
        $model->Id = parent::$conexao->lastInsertId();

        foreach($model->Id_Autores as $item)
        {
            $sql = "INSERT INTO livro_autor_assoc (id_livro, id_autor) VALUES (?, ?) ";      
            $stmt = parent::$conexao->prepare($sql);    
            $stmt->bindValue(1, $model->Id);
            $stmt->bindValue(2, $item);
            $stmt->execute();
        }

        parent::$conexao->commit();
        
        return $model;
    }



    public function update(Livro $model) : Livro
    {
        parent::$conexao->beginTransaction();

        $sql = "UPDATE livro 
                SET id_categoria=?, titulo=?, ano=?, editora=?, isbn=?
                WHERE id=? ";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Id_Categoria);
        $stmt->bindValue(2, $model->Titulo);
        $stmt->bindValue(3, $model->Ano);
        $stmt->bindValue(4, $model->Editora);
        $stmt->bindValue(5, $model->Isbn);
        $stmt->bindValue(6, $model->Id);
        $stmt->execute();

        $sql = "DELETE FROM livro_autor_assoc WHERE id_livro = ? ";      
        $stmt = parent::$conexao->prepare($sql);    
        $stmt->bindValue(1, $model->Id);
        $stmt->execute();

        foreach($model->Id_Autores as $item)
        {
            $sql = "INSERT INTO livro_autor_assoc (id_livro, id_autor) VALUES (?, ?) ";      
            $stmt = parent::$conexao->prepare($sql);    
            $stmt->bindValue(1, $model->Id);
            $stmt->bindValue(2, $item);
            $stmt->execute();
        }

        parent::$conexao->commit();
        
        return $model;
    }


    /**
     * Retorna um registro específico da tabela pessoa do banco de dados.
     * Note que o método exige um parâmetro $id do tipo inteiro.
     */
    public function selectById(int $id) : ?Livro
    {
        $sql = "SELECT * FROM livro WHERE id=? ";

        $stmt = parent::$conexao->prepare($sql);  
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $model = $stmt->fetchObject("AulaThiagotas\Model\Livro");

        /**
         * Obtendo a lista de autores
         */
        $sql = "SELECT * FROM livro_autor_assoc WHERE id_livro=? ";
        $stmt = parent::$conexao->prepare($sql);  
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $livro_autores_assoc = $stmt->fetchAll(DAO::FETCH_CLASS);

        foreach($livro_autores_assoc as $item)
            $model->Id_Autores[] = $item->Id_Autor;

        return $model;
    }


   
    public function select() : array
    {
        $sql = "SELECT * FROM livro ";

        $stmt = parent::$conexao->prepare($sql);  
        $stmt->execute();

        // Retorna um array com as linhas retornadas da consulta. Observe que
        // o array é um array de objetos. Os objetos são do tipo stdClass e 
        // foram criados automaticamente pelo método fetchAll do PDO.
        return $stmt->fetchAll(DAO::FETCH_CLASS, "AulaThiagotas\Model\Livro");
    }

   
    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM livro WHERE id=? ";

        $stmt = parent::$conexao->prepare($sql);  
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}