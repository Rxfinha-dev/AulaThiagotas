<?php 


namespace AulaThiagotas\Model;

use AulaThiagotas\DAO\CategoriaDAO;

use Exception;

final class Categoria extends Model
{
    public ?int $Id = null;

    public ?string $Nome
    {
        set{
            if(strlen($value)<4)
                throw new Exception("Nome deve ter no mínimo 4 caracteres.");
            $this->Nome = $value;
        }
        
        get => $this->Nome ?? null;
    }

    function save() : Categoria {

        return new CategoriaDAO()->save($this);;
        
    }

    function getById(int $id) : ?Categoria
    {
        return new CategoriaDAO()->selectById($id);
    }

    function getAllRows(): array
    {
        $this->rows = new CategoriaDAO()->select();

        return $this->rows;
    }

    function delete(int $id) : bool {

        return new CategoriaDAO()->delete($id);
        
    }
}