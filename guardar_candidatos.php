<?php
    include 'conexion.php';

    $id_votacion = intval($_POST['id_votacion']);
    $candidatos = $_POST['candidatos']; // array de id_usuario tildados

    $stmt = $conexion->prepare("INSERT INTO candidatos (id_votacion, id_usuario) VALUES (?, ?)");

    foreach ($candidatos as $id_usuario) {
        $id_usuario = intval($id_usuario);
        $stmt->bind_param("ii", $id_votacion, $id_usuario);
        $stmt->execute();
    }

    $stmt->close();

    header("Location: crear_votacion.php");
    exit();
?>