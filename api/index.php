<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/modelo.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    echo json_encode(obtenerTareas());
    exit;
}

$input = json_decode(file_get_contents('php://input'), true) ?? [];

switch ($method) {
    case 'POST':
        if (empty($input['titulo'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Titulo requerido']);
            exit;
        }
        $id = crearTarea($input['titulo']);
        echo json_encode(['mensaje' => 'Tarea creada', 'id' => $id]);
        break;

    case 'PUT':
        if (empty($input['id'])) {
            http_response_code(400);
            echo json_encode(['error'=>'id requerido']);
            exit;
        }
        actualizarTarea(
            $input['id'],
            $input['titulo'] ?? '',
            $input['completada'] ?? 0
        );
        echo json_encode(['mensaje'=>'Actualizado']);
        break;

    case 'DELETE':
        parse_str(file_get_contents('php://input'), $deldata);
        $id = $deldata['id'] ?? ($_GET['id'] ?? null);
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error'=>'id requerido']);
            exit;
        }
        borrarTarea($id);
        echo json_encode(['mensaje'=>'Borrado']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Metodo no permitido']);
}
