<?php
require_once __DIR__ . '/../models/AutorDao.php';

$dao = new AutorDao();


$modoEdicion = isset($_GET['editar']) && is_numeric($_GET['editar']);
$autorAEditar = null;

if ($modoEdicion) {
    $autorId = (int) $_GET['editar'];
    $autorAEditar = $dao->obtenerPorId($autorId);

    if (!$autorAEditar) {
        echo "<p>Autor no encontrado.</p>";
        $modoEdicion = false;
    }
}

$autores = $dao->obtenerTodos();
?>

<h2><?= $modoEdicion ? 'Editar Autor' : 'Registrar Autor' ?></h2>

<form action="controllers/AutorController.php" method="POST">
    <input type="hidden" name="id" value="<?= $autorAEditar['id'] ?? '' ?>">

    <label for="nombre">Nombre:</label><br>
    <input type="text" name="nombre" id="nombre" required value="<?= $autorAEditar['nombre'] ?? '' ?>"><br><br>

    <label for="nacionalidad">Nacionalidad:</label><br>
    <input type="text" name="nacionalidad" id="nacionalidad" value="<?= $autorAEditar['nacionalidad'] ?? '' ?>"><br><br>

    <label for="fecha_nacimiento">Fecha de nacimiento:</label><br>
    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= $autorAEditar['fecha_nacimiento'] ?? '' ?>"><br><br>

    <input type="submit" name="<?= $modoEdicion ? 'actualizar_autor' : 'crear_autor' ?>" value="<?= $modoEdicion ? 'Actualizar autor' : 'Guardar autor' ?>">
</form>

<hr>

<h2>Autores Registrados</h2>

<?php if (empty($autores)): ?>
    <p>No hay autores aún.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Nacionalidad</th>
                <th>Fecha de nacimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($autores as $autor): ?>
                <tr>
                    <td><?= $autor['id'] ?></td>
                    <td><?= htmlspecialchars($autor['nombre']) ?></td>
                    <td><?= htmlspecialchars($autor['nacionalidad']) ?></td>
                    <td><?= $autor['fecha_nacimiento'] ?></td>
                    <td>
                        <a href="index.php?vista=autores&editar=<?= $autor['id'] ?>"> Editar</a> |
                        <a href="controllers/AutorController.php?eliminar=<?= $autor['id'] ?>" onclick="return confirm('¿Eliminar autor?')"> Eliminar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif; ?>
