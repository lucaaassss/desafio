<?php
    include 'conexion.php';

    $id_votacion = intval($_GET['id_votacion']);

    // Traemos todos los alumnos de 7mo (ids de curso 19, 20, 21) con su tribu
    $sql = "SELECT u.id_usuario, u.nombre, u.apellido, t.tribu
            FROM usuarios u
            JOIN tribus t ON u.id_tribu = t.id_tribu
            WHERE u.rol = 'alumno' AND u.id_curso IN (19, 20, 21)
            ORDER BY t.tribu, u.apellido";

    $resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Elegir candidatos</title>
    <link rel="stylesheet" href="formularios.css" />
</head>
<body>
    <h1>Elegir candidatos</h1>
    <form action="guardar_candidatos.php" method="POST">
        <input type="hidden" name="id_votacion" value="<?php echo $id_votacion; ?>" />

        <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <p>
                <input type="checkbox" name="candidatos[]" value="<?php echo $fila['id_usuario']; ?>" />
                <?php echo htmlspecialchars($fila['nombre'] . ' ' . $fila['apellido'] . ' - Tribu ' . $fila['tribu']); ?>
            </p>
        <?php } ?>

        <br>
        <input type="submit" value="Guardar candidatos" class="button" />
    </form>
</body>
</html>