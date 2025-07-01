<?php
require_once __DIR__ . '/../config/Conexion.php';

class LibroDao {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Conexion::getConexion();
    }

    public function crear(string $titulo, ?int $anio, int $autorId): int {
        $sql = "INSERT INTO libros (titulo, anio_publicacion, autor_id)
                VALUES (:titulo, :anio, :autor_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'titulo' => $titulo,
            'anio' => $anio,
            'autor_id' => $autorId
        ]);
        return (int) $this->pdo->lastInsertId();
    }


    public function obtenerPorId(int $id): ?array {
        $sql = "SELECT * FROM libros WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $libro = $stmt->fetch();
        return $libro ?: null;
    }


    public function obtenerTodos(): array {
        $sql = "SELECT libros.*, autores.nombre AS autor
                FROM libros
                INNER JOIN autores ON libros.autor_id = autores.id
                ORDER BY libros.id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }


    public function actualizar(int $id, string $titulo, ?int $anio, int $autorId): bool {
        $sql = "UPDATE libros 
                SET titulo = :titulo, anio_publicacion = :anio, autor_id = :autor_id
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'titulo' => $titulo,
            'anio' => $anio,
            'autor_id' => $autorId
        ]);
    }

    public function eliminar(int $id): bool {
        $sql = "DELETE FROM libros WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>