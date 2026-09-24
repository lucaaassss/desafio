<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cssprincipal.css" />
    <title>Document</title>
</head>
<body>

    <?php
        include 'conexion.php';

        if ($_SESSION['user'] != true) {
            echo "<script type='text/javascript'>window.location.href = 'login.php';</script>";
        }

        if ($_SESSION['user'] == true && $_SESSION['rol'] == 'admin') {
    ?>
        <h1>Sistema de votacion de caciques intertribus ITLF</h1>
        <div class="botones">
            <a href="usuarios.php">
                <button>Usuarios</button>
            </a>
            <a href="crear_votacion.php">
                <button>Votaciones</button>
            </a>
            <a href="login.php">
                <button>Cerrar sesion</button>
            </a>
        </div>
    <?php
        }

        if ($_SESSION['user'] == true && $_SESSION['rol'] == 'alumno') {

            $id_usuario = $_SESSION['id_usuario'];
            $id_tribu = $_SESSION['id_tribu'];

            // Buscamos la votación abierta
            $votacion = $conexion->query("SELECT id_votacion FROM votaciones WHERE estado = 'abierta' LIMIT 1")->fetch_assoc();

            if (!$votacion) {
                die("No hay ninguna votación abierta en este momento.");
            }

            $id_votacion = $votacion['id_votacion'];

            // Chequeamos si el alumno ya votó en esta votación
            $stmt = $conexion->prepare("SELECT id FROM usuarios_votaron WHERE id_votacion = ? AND id_usuario = ?");
            $stmt->bind_param("ii", $id_votacion, $id_usuario);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                die("Ya emitiste tu voto en esta votación.");
            }
            $stmt->close();

            // Traemos los candidatos de la tribu del alumno, para esta votación
            $sql = "SELECT c.id_candidato, u.nombre, u.apellido
                    FROM candidatos c
                    JOIN usuarios u ON c.id_usuario = u.id_usuario
                    WHERE c.id_votacion = ? AND u.id_tribu = ?";

            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ii", $id_votacion, $id_tribu);
            $stmt->execute();
            $resultado = $stmt->get_result();
    ?>
        <h1>Elegí tu cacique</h1>
        <form action="registrar_voto.php" method="POST">
            <input type="hidden" name="id_votacion" value="<?php echo $id_votacion; ?>" />

            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <p>
                    <input type="radio" name="id_candidato" value="<?php echo $fila['id_candidato']; ?>" required />
                    <?php echo htmlspecialchars($fila['nombre'] . ' ' . $fila['apellido']); ?>
                </p>
            <?php } ?>

            <br>
            <input type="submit" value="Votar" class="button" />
        </form>
    <?php
        }
    ?>
</body>
</html>