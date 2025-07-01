<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../models/LibroDao.php';

$libroDao = new LibroDao();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion   = $_POST['accion'] ?? '';
    $titulo   = $_POST['titulo'] ?? '';
    $anio     = $_POST['anio'] ?? '';
    $autor_id = $_POST['autor_id'] ?? '';

    if ($accion === 'crear') {
        $libroDao->crear($titulo, $anio, $autor_id);
    }
    header('Location: ../index.php?vista=libros');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $accion = $_GET['accion'] ?? '';
    $id     = $_GET['id'] ?? null;

    if ($accion === 'eliminar' && $id !== null) {
        $libroDao->eliminar($id);
        header('Location: ../index.php?vista=libros');
        exit;
    }
}
