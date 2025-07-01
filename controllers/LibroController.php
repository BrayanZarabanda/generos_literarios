<?php
require_once __DIR__ . '/../models/LibroDao.php';

$dao = new LibroDao();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_libro'])) {
    $titulo = $_POST['titulo'] ?? '';
    $anio = $_POST['anio'] ?? null;
    $autorId = $_POST['autor_id'] ?? null;

    if (trim($titulo) !== '' && $autorId) {
        try {
            $dao->crear($titulo, $anio, $autorId);
            header('Location: ../index.php?vista=libros');
            exit();
        } catch (Exception $e) {
            echo "Error al guardar libro: " . $e->getMessage();
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_libro'])) {
    $id = (int) $_POST['id'];
    $titulo = $_POST['titulo'] ?? '';
    $anio = $_POST['anio'] ?? null;
    $autorId = $_POST['autor_id'] ?? null;

    if (trim($titulo) !== '' && $autorId) {
        try {
            $dao->actualizar($id, $titulo, $anio, $autorId);
            header('Location: ../index.php?vista=libros');
            exit();
        } catch (Exception $e) {
            echo "Error al actualizar libro: " . $e->getMessage();
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['eliminar'])) {
    $id = (int) $_GET['eliminar'];
    try {
        $dao->eliminar($id);
        header('Location: ../index.php?vista=libros');
        exit();
    } catch (Exception $e) {
        echo "Error al eliminar libro: " . $e->getMessage();
    }
}

?>