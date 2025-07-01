<?php
require_once __DIR__ . '/../models/LibroDao.php';
require_once __DIR__ . '/../models/AutorDao.php';

$libroDao = new LibroDao();
$autorDao = new AutorDao();

$modoEdicion = isset($_GET['editar']) && is_numeric($_GET['editar']);
$libro = null;

if ($modoEdicion) {
    $libro = $libroDao->obtenerPorId((int)$_GET['editar']);
    if (!$libro) {
        $modoEdicion = false;
    }
}

$libros = $libroDao->obtenerTodos();
$autores = $autorDao->obtenerTodos();
?>

<h2><?= $modoEdicion ? 'Editar libro' : 'Registrar libro' ?></h2>

<form action="controllers/LibroController.php" method="POST">
    <?php if ($modoEdicion): ?>
        <input type="hidden" name="id" value="<?= $libro['id'] ?>">
    <?php endif; ?>

    <label for="titulo">Título:</label><br>
    <input type="text" name="titulo" required value="<?= $libro['titulo'] ?? '' ?>"><br><br>

    <label for="anio">Año de publicación:</label><br>
    <input type="number" name="anio" value="<?= $libro['anio_publicacion'] ?? '' ?>"><br><br>

    <label for="autor_id">Autor:</label><br>
    <select name="autor_id" required>
        <option value="">-- Selecciona autor --</option>
        <?php foreach ($autores as $autor): ?>
            <option value="<?= $autor['id'] ?>" <?= (isset($libro['autor_id']) && $libro['autor_id'] == $autor['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($autor['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" name="<?= $modoEdicion ? 'actualizar_libro' : 'crear_libro' ?>" value="<?= $modoEdicion ? 'Actualizar libro' : 'Guardar libro' ?>">
</form>

<hr>

<h2> Libros registrados</h2>

<?php if (empty($libros)): ?>
    <p>No hay libros aún.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Año</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?= $libro['id'] ?></td>
                    <td><?= htmlspecialchars($libro['titulo']) ?></td>
                    <td><?= $libro['anio_publicacion'] ?></td>
                    <td><?= htmlspecialchars($libro['autor']) ?></td>
                    <td>
                        <a href="index.php?vista=libros&editar=<?= $libro['id'] ?>"> Editar</a> |
                        <a href="controllers/LibroController.php?eliminar=<?= $libro['id'] ?>" onclick="return confirm('¿Eliminar libro?')"> Eliminar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif; ?>
