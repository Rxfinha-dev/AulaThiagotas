<?php

namespace AulaThiagotas\Model;

use AulaThiagotas\DAO\AlunoDAO;
use Exception;


 #[\AllowDynamicProperties]
final class Aluno extends Model
{
   
    public ?int $Id = null;

    public ?string $Nome
    {
        set
        {
            if(strlen($value) < 3)
                throw new Exception("Nome deve ter no mínimo 3 caracteres.");

            $this->Nome = $value;
        }

        get => $this->Nome ?? null;
    }


    public ?string $RA
    {
        set
        {
            if(empty($value))
                throw new Exception("Preencha o RA");

            $this->RA = $value;
        }

        get => $this->RA ?? null;
    }


    public ?string $Curso
    {
        set
        {
            if(strlen($value) < 3)
                throw new Exception("Curso deve ter no mínimo 3 caracteres.");

            $this->Curso = $value;
        }

        get => $this->Curso ?? null;
    }



    
    /**
     * Declaração do método save que chamará a DAO para gravar no banco de dados
     * o model preenchido.
     */
    function save() : Aluno
    {
        /**
         * Note que os objetos da classe AlunoDAO estão sendo criados de forma anônima.
         * Fazemos isso quando podemos descartar o objeto logo apos o uso, ou seja,
         * não sendo necessário armazenar o objeto em uma variável.
         * Leia sobre: https://www.php.net/manual/pt_BR/language.oop5.anonymous.php
         */
        return new AlunoDAO()->save($this);
    }


    /**
     * Método que encapsula o acesso ao método selectById da camada DAO
     * O método recebe um parâmetro do tipo inteiro que é o id do registro
     * a ser recuperado do MySQL, via camada DAO.
     */
    function getById(int $id) : ?Aluno
    {
        return new AlunoDAO()->selectById($id);
    }


    /**
     * Método que encapsula a chamada a DAO e que abastecerá a propriedade rows;
     * Esse método é importante pois como a model é "vista" na View a propriedade
     * $rows será acessada e possibilitará listar os registros vindos do banco de dados
     */
    function getAllRows() : array
    {
        $this->rows = new AlunoDAO()->select();

        return $this->rows;
    }


  
    function delete(int $id) : bool
    {
        return new AlunoDAO()->delete($id);
    }
}