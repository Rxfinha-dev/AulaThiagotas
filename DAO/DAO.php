<?php

namespace AulaThiagotas\DAO;

use PDO;

/**
 * A classes abstratas não podem ser instanciadas. Isso é útil quando temos uma classe
 * que não tem um papel definido na aplicação, ou seja, não representa diretamente uma
 * entidade. Neste caso DAO é abstrata porque existe apenas para encapsular a funcionalidade
 * de configurar a conexão e conectar-se ao MySQL, além de estenter da classe PDO.
 * Leia mais sobre classes abstratas: https://www.php.net/manual/pt_BR/language.oop5.abstract.php
 */
abstract class DAO extends PDO
{
    /**
     * Atributo (ou Propriedade) da classe destinado a armazenar o link (vínculo aberto)
     * de conexão com o banco de dados.
     */
    protected static $conexao = null;

    /**
     * Neste caso, assim que é instânciado, abre uma conexão com o MySQL (Banco de dados)
     * A conexão é aberta via PDO (PHP Data Object) que é um recurso da linguagem para
     * acesso a diversos SGBDs.
     */
    public function __construct()
    {
        /**
         * DSN (Data Source Name) onde o servidor MySQL será encontrado
         * (host) em qual porta o MySQL está operado e qual o nome do banco pretendido
         * Mais informações sobre DSN: 
         * https://www.php.net/manual/pt_BR/ref.pdo-mysql.connection.php
         * 
         */
        $dsn = "mysql:host=" . $_ENV['db']['host'] . ";dbname=" . $_ENV['db']['database'];

        /**
         * Aqui estamos verificando se o atributo $conexao é nulo. Se for, então uma nova
         * conexão será criada, caso contrário, a mesma conexão já aberta será usada.
         * Esse ponto será muito útil ao trabalhar com transações ACID.
         */
        if (self::$conexao == null) 
        {
            /**
             * Criando a conexão e armazenado na propriedade definida para tal.
             * Veja o que é PDO: https://www.php.net/manual/pt_BR/intro.pdo.php
             */ 
            self::$conexao = new PDO(
                $dsn,
                $_ENV['db']['user'],
                $_ENV['db']['pass'],
                [
                    PDO::ATTR_PERSISTENT => true,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
                ]
            ); // Fecha construtor da classe PDO
        } // Fecha if
    } // Fecha construtor da classe DAO
} // Fec