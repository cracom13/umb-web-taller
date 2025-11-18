<?php
// api/login.php
session_start();
header("Content-Type: application/json; charset=utf-8");

$input = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($input['usuario'])) {
    $_SESSION['usuario'] = $input['usuario'];
    echo json_encode(['mensaje' => 'Sesión iniciada', 'usuario' => $_SESSION['usuario']]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    session_destroy();
    echo json_encode(['mensaje' => 'Sesión cerrada']);
    exit;
}

echo json_encode(['sesion' => $_SESSION ?? null]);
