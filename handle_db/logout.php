<?php
// Inicia la sesión (si no está iniciada ya)
session_start();

// Destruye la sesión
session_destroy();

// Redirige al usuario a la página de inicio de sesión
header("Location: /index.php"); // Asegúrate de poner la ruta correcta a tu página de inicio de sesión
exit();
?>