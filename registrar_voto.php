<?php
    session_start();
    include 'conexion.php';

    $id_usuario = $_SESSION['id_usuario'];
    $id_votacion = intval($_POST['id_votacion']);
    $id_candidato = intval($_POST['id_candidato']);

    // Chequeamos de nuevo si ya votó, antes de insertar nada
    $stmt = $conexion->prepare("SELECT id FROM usuarios_votaron WHERE id_votacion = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id_votacion, $id_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Ya emitiste tu voto en esta votación.");
    }
    $stmt->close();

    // Guardamos el voto (sin ningún dato de quién lo emitió)
    $stmt = $conexion->prepare("INSERT INTO votos (id_votacion, id_candidato) VALUES (?, ?)");
    $stmt->bind_param("ii", $id_votacion, $id_candidato);
    $stmt->execute();
    $stmt->close();

    // Marcamos que este usuario ya votó (en una tabla separada, sin relación con el voto)
    $stmt = $conexion->prepare("INSERT INTO usuarios_votaron (id_votacion, id_usuario) VALUES (?, ?)");
    $stmt->bind_param("ii", $id_votacion, $id_usuario);
    $stmt->execute();
    $stmt->close();

    echo "¡Gracias por votar!";
?>