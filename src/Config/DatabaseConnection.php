<?php

namespace Jhonattan\CleanArchiteture\Config;

class DatabaseConnection
{
    public static function getConnection(): \PDO
    {
        $pdo = new \PDO('sqlite:db.sqlite');

        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        return $pdo;
    }
}
