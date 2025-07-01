<?php

require_once __DIR__ . '/../database/database.php';

class Conexion {
    private static $pdo = null;

    public static function getConexion() {
        if (self::$pdo === null) {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

            try {
                self::$pdo = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                die("Error al conectar a la base de datos: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
