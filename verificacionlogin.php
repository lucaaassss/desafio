<?php
include 'conexion.php';
session_start();

$email = $_POST['email'];
$contraseña = $_POST['contraseña'];

$stmt = $conexion->prepare("SELECT id_usuario, contraseña, rol, id_tribu FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($id_usuario, $password, $rol, $id_tribu);

if ($stmt->fetch()) {
    if ($contraseña == $password) {
        $_SESSION["user"] = true;
        $_SESSION["rol"] = $rol;
        $_SESSION["email"] = $email;
        $_SESSION["id_usuario"] = $id_usuario;
        $_SESSION["id_tribu"] = $id_tribu;
        header("Location: index.php");
        exit;
    } else {
        echo "<script type='text/javascript'>alert('Email y o contraseña incorrectos');
        window.location.href = 'login.php';</script>";
    }
}

$stmt->close();
$conexion->close();
?>