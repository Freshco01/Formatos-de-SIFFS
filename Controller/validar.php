<?php
session_start();


$credenciales = include '../Conf/credenciales.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'];
    $contrasena = $_POST['password'];

    if ($usuario === $credenciales['usuario'] && password_verify($contrasena, $credenciales['hash'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../Views/principal.php");
        exit();
    } else {
        // Error para usuario
        header("Location: ../index.php?error=1");
        exit();
    }
}
?>
