<?php
require_once __DIR__ . '/../config/Conexion.php';

class LibroDao
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::getConexion();
    }

    public function crear(string $titulo, int $anio, int $autorId): int
    {
        $sql = "INSERT INTO libros (titulo, anio_publicacion, autor_id)
                VALUES (:titulo, :anio, :autor_id)";
        $this->pdo->prepare($sql)->execute([
            'titulo'   => $titulo,
            'anio'     => $anio,
            'autor_id' => $autorId
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function obtenerPorId(int $id): ?array
    {
        $sql = "SELECT * FROM libros WHERE id = :id";
        $stm = $this->pdo->prepare($sql);
        $stm->execute(['id' => $id]);
        return $stm->fetch() ?: null;
    }
    public function obtenerTodos(): array
    {
        $sql = "
            SELECT  l.id,
                    l.titulo,
                    l.anio_publicacion,
                    a.nombre                           AS nombre_autor,
                    COALESCE(b.contenido, '')          AS bio_autor,
                    GROUP_CONCAT(DISTINCT g.nombre
                                 ORDER BY g.nombre SEPARATOR ', ') AS generos
            FROM libros l
            JOIN autores a              ON a.id = l.autor_id
            LEFT JOIN biografias b      ON b.autor_id = a.id
            LEFT JOIN autor_genero ag   ON ag.autor_id = a.id
            LEFT JOIN generos g         ON g.id = ag.genero_id
            GROUP BY l.id
            ORDER BY l.id DESC
        ";
        return $this->pdo->query($sql)->fetchAll();
    }

    /** Actualizar libro */
    public function actualizar(int $id, string $titulo, int $anio, int $autorId): bool
    {
        $sql = "UPDATE libros
                   SET titulo = :titulo,
                       anio_publicacion = :anio,
                       autor_id = :autor_id
                 WHERE id = :id";
        return $this->pdo->prepare($sql)->execute([
            'id'       => $id,
            'titulo'   => $titulo,
            'anio'     => $anio,
            'autor_id' => $autorId
        ]);
    }

    /** Eliminar libro */
    public function eliminar(int $id): bool
    {
        return $this->pdo->prepare("DELETE FROM libros WHERE id = :id")
                         ->execute(['id' => $id]);
    }
}
