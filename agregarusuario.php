<?php
    include 'conexion.php';

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $rol = $_POST['rol'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    $id_curso = null;
    $id_tribu = null;

    if ($rol === 'alumno') {
        if (!empty($_POST['curso'])) {
            $id_curso = intval($_POST['curso']);
        } else {
            $id_curso = null;
        }

        if (!empty($_POST['tribu'])) {
            $id_tribu = intval($_POST['tribu']);
        } else {
            $id_tribu = null;
        }
    }

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, contraseña, email, id_curso, id_tribu, rol) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiis", $nombre, $apellido, $contraseña, $email, $id_curso, $id_tribu, $rol);

    if ($stmt->execute()) {
        header("Location: Usuarios.php");
        exit();
    } else {
        echo "Error al agregar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
?>