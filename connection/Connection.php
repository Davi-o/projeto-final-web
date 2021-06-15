<?php
namespace Database;

use PDO;
use PDOException;

class Connection extends PDO
{
    private static ?Connection $instance = null;

    public function __construct(
        string $dsn,
        string $user,
        string $pass
    )
    {
        parent:: __construct($dsn, $user, $pass);
    }

    public static function getInstance(): Connection
    {
        if (! isset(self::$instance)) {
            try {
                self::$instance = new Connection(
                    "mysql:dbname=agenda;host=localhost",
                    "root",
                    ""
                );

            } catch (PDOexception $e) {
                var_dump($e);
            }
        }
        return self::$instance;
    }
}