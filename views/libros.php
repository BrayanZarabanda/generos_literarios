<?php
require_once __DIR__ . '/../models/LibroDao.php';
require_once __DIR__ . '/../models/AutorDao.php';

$libroDao  = new LibroDao();
$autorDao  = new AutorDao();

$libros  = $libroDao->obtenerTodos();
$autores = $autorDao->obtenerTodos();
?>

<div class="contenedor-libros">

  <div class="formulario">
    <h2>Registrar libro</h2>

    <form action="controllers/LibroController.php" method="post">
      <label for="titulo">Título:</label>
      <input type="text" id="titulo" name="titulo" required>

      <label for="anio">Año de publicación:</label>
      <input type="number" id="anio" name="anio" required>

      <label for="autor_id">Autor:</label>
      <select id="autor_id" name="autor_id" required>
        <option value="">-- Selecciona autor --</option>
        <?php foreach ($autores as $autor): ?>
          <option value="<?= $autor['id'] ?>"><?= htmlspecialchars($autor['nombre']) ?></option>
        <?php endforeach; ?>
      </select>

      <input type="hidden" name="accion" value="crear">
      <input type="submit" value="Guardar libro">
    </form>
  </div>

  <div class="tabla">
    <h2>Libros registrados</h2>

    <?php if (empty($libros)): ?>
      <p>No hay libros registrados aún.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Año</th>
            <th>Autor</th>
            <th>Géneros</th>
            <th>Biografía</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($libros as $libro): ?>
            <tr>
              <td><?= $libro['id'] ?></td>
              <td><?= htmlspecialchars($libro['titulo']) ?></td>
              <td><?= $libro['anio_publicacion'] ?></td>
              <td><?= htmlspecialchars($libro['nombre_autor']) ?></td>
              <td><?= htmlspecialchars($libro['generos'] ?: '—') ?></td>
              <td style="max-width:250px;">
                  <?= nl2br(htmlspecialchars($libro['bio_autor'] ?: 'Sin biografía')) ?>
              </td>
              <td>
                <a href="controllers/LibroController.php?accion=editar&id=<?= $libro['id'] ?>">Editar</a> |
                <a href="controllers/LibroController.php?accion=eliminar&id=<?= $libro['id'] ?>"
                   onclick="return confirm('¿Eliminar libro?')">Eliminar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

</div>
