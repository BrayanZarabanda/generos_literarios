<?php
require_once __DIR__ . '/../models/BiografiaDao.php';

$dao = new BiografiaDao();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_biografia'])) {
    $contenido = $_POST['contenido'] ?? '';
    $autorId = (int) ($_POST['autor_id'] ?? 0);

    if (trim($contenido) !== '' && $autorId > 0) {
        try {
            $dao->crear($contenido, $autorId);
            header('Location: /PHP/Actividad_final/index.php?vista=biografias');
            exit;
        } catch (Exception $e) {
            die('Error al guardar biografía: ' . $e->getMessage());
        }
    } else {
        die('Todos los campos son obligatorios.');
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_biografia'])) {
    $contenido = $_POST['contenido'] ?? '';
    $autorId = (int) ($_POST['autor_id'] ?? 0);

    if (trim($contenido) !== '' && $autorId > 0) {
        try {
            $dao->actualizar($autorId, $contenido);
            header('Location: /PHP/Actividad_final/index.php?vista=biografias');
            exit;
        } catch (Exception $e) {
            die('Error al actualizar biografía: ' . $e->getMessage());
        }
    } else {
        die('Todos los campos son obligatorios.');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['eliminar'])) {
    $autorId = (int) $_GET['eliminar'];
    try {
        $dao->eliminarPorAutor($autorId);
        header('Location: /PHP/Actividad_final/index.php?vista=biografias');
        exit;
    } catch (Exception $e) {
        die('Error al eliminar biografía: ' . $e->getMessage());
    }
}
?>