<?php
require_once __DIR__ . '/../models/GeneroDao.php';
require_once __DIR__ . '/../models/AutorDao.php';

$dao = new GeneroDao();
$autorDao = new AutorDao();

$generos = $dao->obtenerTodos();
$autores = $autorDao->obtenerTodos();
?>

<h2> Crear Género</h2>
<form method="POST" action="controllers/GeneroController.php">
    <input type="text" name="nombre" placeholder="Nombre del género" required>
    <input type="submit" name="crear_genero" value="Guardar">
</form>

<hr>

<h2> Asignar Género a Autor</h2>
<form method="POST" action="controllers/GeneroController.php">
    <select name="autor_id" required>
        <option value=""> Selecciona Autor</option>
        <?php foreach ($autores as $autor): ?>
            <option value="<?= $autor['id'] ?>"><?= htmlspecialchars($autor['nombre']) ?></option>
        <?php endforeach; ?>
    </select>

    <select name="genero_id" required>
        <option value=""> Selecciona Género</option>
        <?php foreach ($generos as $genero): ?>
            <option value="<?= $genero['id'] ?>"><?= htmlspecialchars($genero['nombre']) ?></option>
        <?php endforeach; ?>
    </select>

    <input type="submit" name="asignar_genero" value="Asignar">
</form>

<hr>

<h2> Lista de Géneros</h2>
<?php if (empty($generos)): ?>
    <p>No hay géneros aún.</p>
<?php else: ?>
    <ul>
        <?php foreach ($generos as $genero): ?>
            <li>
                <?= htmlspecialchars($genero['nombre']) ?>
                <a href="controllers/GeneroController.php?eliminar=<?= $genero['id'] ?>" onclick="return confirm('¿Eliminar género?')"> Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
