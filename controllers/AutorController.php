<?php
require_once __DIR__ . '/../models/AutorDao.php';

$dao = new AutorDao();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_autor'])) {
    $nombre = $_POST['nombre'] ?? '';
    $nacionalidad = $_POST['nacionalidad'] ?? null;
    $fechaNacimiento = $_POST['fecha_nacimiento'] ?? null;

    if (trim($nombre) !== '') {
        try {
            $dao->crear($nombre, $nacionalidad, $fechaNacimiento);
            header('Location: /PHP/Actividad_final/index.php?vista=autores');
            exit;
        } catch (Exception $e) {
            die('Error al guardar autor: ' . $e->getMessage());
        }
    } else {
        die('El campo nombre es obligatorio.');
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_autor'])) {
    $id = (int) $_POST['id'];
    $nombre = $_POST['nombre'] ?? '';
    $nacionalidad = $_POST['nacionalidad'] ?? null;
    $fechaNacimiento = $_POST['fecha_nacimiento'] ?? null;

    if (trim($nombre) !== '') {
        try {
            $dao->actualizar($id, $nombre, $nacionalidad, $fechaNacimiento);
            header('Location: /PHP/Actividad_final/index.php?vista=autores');
            exit;
        } catch (Exception $e) {
            die('Error al actualizar autor: ' . $e->getMessage());
        }
    } else {
        die('El campo nombre es obligatorio.');
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['eliminar'])) {
    $id = (int) $_GET['eliminar'];
    try {
        $dao->eliminar($id);
        header('Location: /PHP/Actividad_final/index.php?vista=autores');
        exit;
    } catch (Exception $e) {
        die('Error al eliminar autor: ' . $e->getMessage());
    }
}

?>
