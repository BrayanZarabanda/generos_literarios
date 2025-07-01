<?php
require_once __DIR__ . '/../models/BiografiaDao.php';
require_once __DIR__ . '/../models/AutorDao.php';

$dao = new BiografiaDao();
$autorDao = new AutorDao();

$biografias = $dao->obtenerTodas();
$autores = $autorDao->obtenerTodos();

$modoEdicion = isset($_GET['editar']) && is_numeric($_GET['editar']);
$autorId = $modoEdicion ? (int) $_GET['editar'] : null;
$biografia = $modoEdicion ? $dao->obtenerPorAutor($autorId) : null;
?>

<h2><?= $modoEdicion ? 'Editar biografía' : 'Registrar biografía' ?></h2>

<form action="controllers/BiografiaController.php" method="POST">
    <label for="autor_id">Autor:</label><br>
    <select name="autor_id" required <?= $modoEdicion ? 'readonly disabled' : '' ?>>
        <option value="">-- Selecciona autor --</option>
        <?php foreach ($autores as $autor): ?>
            <?php
                $seleccionado = ($modoEdicion && $autor['id'] == $autorId) ? 'selected' : '';
                $tieneBio = $dao->obtenerPorAutor($autor['id']);
                if (!$modoEdicion && $tieneBio) continue;
            ?>
            <option value="<?= $autor['id'] ?>" <?= $seleccionado ?>>
                <?= htmlspecialchars($autor['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="contenido">Contenido:</label><br>
    <textarea name="contenido" rows="5" required><?= $biografia['contenido'] ?? '' ?></textarea><br><br>

    <input type="submit" name="<?= $modoEdicion ? 'actualizar_biografia' : 'crear_biografia' ?>" value="<?= $modoEdicion ? 'Actualizar' : 'Guardar' ?>">
</form>

<hr>

<h2> Biografías registradas</h2>

<?php if (empty($biografias)): ?>
    <p>No hay biografías aún.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Autor</th>
                <th>Contenido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($biografias as $bio): ?>
                <tr>
                    <td><?= htmlspecialchars($bio['autor']) ?></td>
                    <td><?= nl2br(htmlspecialchars($bio['contenido'])) ?></td>
                    <td>
                        <a href="index.php?vista=biografias&editar=<?= $bio['autor_id'] ?>">✏️ Editar</a> |
                        <a href="controllers/BiografiaController.php?eliminar=<?= $bio['autor_id'] ?>" onclick="return confirm('¿Eliminar biografía?')">🗑️ Eliminar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif; 
?>
