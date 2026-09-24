<?php
    include 'conexion.php';

    $nombre = $_POST['nombre'];

    
    $conexion->query("UPDATE votaciones SET estado = 'cerrada' WHERE estado = 'abierta'");

    $stmt = $conexion->prepare("INSERT INTO votaciones (nombre, estado) VALUES (?, 'abierta')");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();

    $id_votacion = $conexion->insert_id;

    $stmt->close();

    header("Location: seleccionar_candidatos.php?id_votacion=" . $id_votacion);
    exit();
?>