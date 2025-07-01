<?php
require_once __DIR__ . '/../config/Conexion.php';

class BiografiaDao {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Conexion::getConexion();
    }

    public function crear(string $contenido, int $autorId): int {
        $sql = "INSERT INTO biografias (contenido, autor_id)
                VALUES (:contenido, :autor_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'contenido' => $contenido,
            'autor_id' => $autorId
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    public function obtenerPorAutor(int $autorId): ?array {
        $sql = "SELECT * FROM biografias WHERE autor_id = :autor_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['autor_id' => $autorId]);
        $bio = $stmt->fetch();
        return $bio ?: null;
    }

    public function actualizar(int $autorId, string $contenido): bool {
        $sql = "UPDATE biografias
                SET contenido = :contenido
                WHERE autor_id = :autor_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'contenido' => $contenido,
            'autor_id' => $autorId
        ]);
    }

    public function eliminarPorAutor(int $autorId): bool {
        $sql = "DELETE FROM biografias WHERE autor_id = :autor_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['autor_id' => $autorId]);
    }

    public function obtenerTodas(): array {
        $sql = "SELECT b.id, b.contenido, a.nombre AS autor, a.id AS autor_id
                FROM biografias b
                JOIN autores a ON b.autor_id = a.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}

?>