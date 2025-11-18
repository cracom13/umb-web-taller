<?php
$host = getenv("DB_HOST");
$user = getenv("DB_USER");
$pass = getenv("DB_PASS");
$db   = getenv("DB_NAME");

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_errno) {
    http_response_code(500);
    die("Error de conexión: " . $conexion->connect_error);
}
?>
