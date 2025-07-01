<?php
require_once __DIR__ . '/../config/Conexion.php';

class AutorDao
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::getConexion();
    }


    public function crear(string $nombre, ?string $nacionalidad = null, ?string $fechaNacimiento = null): int
    {
        $sql = "INSERT INTO autores (nombre, nacionalidad, fecha_nacimiento)
                VALUES (:nombre, :nacionalidad, :fecha)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre'       => $nombre,
            ':nacionalidad' => $nacionalidad,
            ':fecha'        => $fechaNacimiento
        ]);
        return (int) $this->pdo->lastInsertId();
    }


    public function obtenerPorId(int $id): ?array
    {
        $sql = "SELECT * FROM autores WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $autor = $stmt->fetch();
        return $autor ?: null;  
    }

    public function obtenerTodos(): array
    {
        $sql = "SELECT * FROM autores ORDER BY nombre";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(); 
    }

    public function actualizar(int $id, string $nombre, ?string $nacionalidad = null, ?string $fechaNacimiento = null): bool
    {
        $sql = "UPDATE autores
                SET nombre = :nombre,
                    nacionalidad = :nacionalidad,
                    fecha_nacimiento = :fecha
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id'           => $id,
            ':nombre'       => $nombre,
            ':nacionalidad' => $nacionalidad,
            ':fecha'        => $fechaNacimiento
        ]);
    }


    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM autores WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>

