<?php

namespace AulaThiagotas\DAO;

use AulaThiagotas\Model\Login;

/**
 * As classes DAO (Data Access Object) são responsáveis por executar os
 * SQL junto ao banco de dados.
 */
final class LoginDAO extends DAO
{
    public function autenticar(Login $model) : ?Login
    {
        $sql = "SELECT * FROM usuario WHERE email=? AND senha=? ";

        $stmt = parent::$conexao->prepare($sql);  
        $stmt->bindValue(1, $model->Email);
        $stmt->bindValue(2, $model->Senha);
        $stmt->execute();

        $model = $stmt->fetchObject("AulaThiagotas\Model\Login");

        return is_object($model) ? $model : null;
    }
}