<?php
declare(strict_types=1);

class Database {
    private static ?PDO $conn = null;

    public static function getConnection(): PDO {
        if (self::$conn === null) {
            self::$conn = new PDO(
                "sqlite:" . __DIR__ . "/database.sqlite"
            );

            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$conn;
    }
}