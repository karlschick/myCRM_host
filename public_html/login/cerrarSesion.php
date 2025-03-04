<?php
session_start(); // Iniciar sesión para manipularla

// Destruir toda la sesión
session_destroy();

// Redirigir al usuario a la página de inicio después de cerrar sesión
header("Location: ../index.php"); // Redirigir a index.php
exit; // Finalizar el script para evitar que se ejecute más código
?>