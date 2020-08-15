<?php
namespace App\Core;

use PDO;

class Database
{
    private static $db = null;

    private function __construct() {
    }

    public static function getDb() {
        if(is_null(self::$db)) {
            self::$db = new PDO(
                "mysql:host=${$_ENV['DB_HOST']};dbname=${$_ENV['DB_NAME']}",
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD']);
        }
        return self::$db;
    }
}