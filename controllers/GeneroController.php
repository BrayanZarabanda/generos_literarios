<?php
require_once __DIR__ . '/../models/GeneroDao.php';

$dao = new GeneroDao();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_genero'])) {
    $nombre = $_POST['nombre'] ?? '';
    if (trim($nombre) !== '') {
        $dao->crearGenero($nombre);
        header('Location: /PHP/Actividad_final/index.php?vista=generos');
        exit;
    } else {
        die("El nombre del género es obligatorio.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['asignar_genero'])) {
    $autorId = (int) $_POST['autor_id'];
    $generoId = (int) $_POST['genero_id'];
    if ($autorId && $generoId) {
        $dao->asignarGenero($autorId, $generoId);
        header('Location: /PHP/Actividad_final/index.php?vista=generos');
        exit;
    }
}

if (isset($_GET['eliminar']) && is_numeric($_GET['eliminar'])) {
    $dao->eliminar((int) $_GET['eliminar']);
    header('Location: /PHP/Actividad_final/index.php?vista=generos');
    exit;
}
