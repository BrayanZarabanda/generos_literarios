<?php
require_once __DIR__ . '/../config/Conexion.php';

class GeneroDao {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Conexion::getConexion();
    }

    public function crearGenero(string $nombre): int {
        $sql = "INSERT INTO generos (nombre) VALUES (:nombre)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nombre' => $nombre]);
        return (int) $this->pdo->lastInsertId();
    }

    public function obtenerTodos(): array {
        $sql = "SELECT * FROM generos";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function eliminar(int $id): bool {
        $sql = "DELETE FROM generos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function asignarGenero(int $autorId, int $generoId): bool {
        $sql = "INSERT IGNORE INTO autor_genero (autor_id, genero_id)
                VALUES (:autor_id, :genero_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'autor_id' => $autorId,
            'genero_id' => $generoId
        ]);
    }

    public function eliminarRelacion(int $autorId, int $generoId): bool {
        $sql = "DELETE FROM autor_genero WHERE autor_id = :autor_id AND genero_id = :genero_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'autor_id' => $autorId,
            'genero_id' => $generoId
        ]);
    }

    public function obtenerGenerosPorAutor(int $autorId): array {
        $sql = "SELECT g.id, g.nombre
                FROM generos g
                JOIN autor_genero ag ON g.id = ag.genero_id
                WHERE ag.autor_id = :autor_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['autor_id' => $autorId]);
        return $stmt->fetchAll();
    }
}
