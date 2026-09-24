<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cssprincipal.css" />
</head>
<body>
    <a href="index.php"><button>Volver a inicio</button></a>
    <h1>Usuarios</h1>
    <a href="agregarusuarios.php"><button>Agregar usuario</button></a>

    <div class="listausuarios">
        <?php
        include 'conexion.php';
        
            $stmt = $conexion->prepare("SELECT nombre, apellido, curso, rol,tribu FROM usuarios INNER JOIN cursos on cursos.id_curso=usuarios.id_curso INNER JOIN tribus on tribus.id_tribu=usuarios.id_tribu");
            $stmt->execute();
            $stmt->bind_result($nombre, $apellido, $curso, $rol,$tribu);

            while ($stmt->fetch()) {
                echo "<div class='usuario'>";
                echo "<p><strong>Nombre:</strong> " . htmlspecialchars($nombre) . "</p>";
                echo "<p><strong>Apellido:</strong> " . htmlspecialchars($apellido) . "</p>";
                echo "<p><strong>Curso:</strong> " . htmlspecialchars($curso) . "</p>";
                echo "<p><strong>Rol:</strong> " . htmlspecialchars($rol) . "</p>";
                echo "<p><strong>Tribu:</strong> " . htmlspecialchars($tribu) . "</p>";
                echo "</div>";
}

            $stmt->close();
        ?>
    </div>
</body>
</html>