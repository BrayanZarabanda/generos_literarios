<?php
$vista = $_GET['vista'] ?? 'inicio';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestión Literaria</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <header>
        <h1>Obras Literarias</h1>

        <nav>
            <ul>
                <li><a href="index.php?vista=inicio">Inicio</a></li>
                <li><a href="index.php?vista=autores">Autores</a></li>
                <li><a href="index.php?vista=biografias">Biografías</a></li>
                <li><a href="index.php?vista=generos">Géneros</a></li>
                <li><a href="index.php?vista=libros">Libros</a></li>
            </ul>        
        </nav>
    </header>
<main>
<?php
switch ($vista) {
    case 'autores':
        require_once __DIR__ . '/views/autores.php';
        break;

    case 'inicio':
    default:
        echo "<h2>Bienvenido</h2>";
        echo "<p>Usa el menú de navegación para gestionar autores, libros, biografías y más.</p>";
        break;
    case 'libros':
        require_once __DIR__ . '/views/libros.php';
        break;
    case 'biografias':
        require_once __DIR__ . '/views/biografias.php';
        break;
    case 'generos':
        require_once __DIR__ . '/views/generos.php';
        break;  
}
?>
</main>

</body>
</html>
