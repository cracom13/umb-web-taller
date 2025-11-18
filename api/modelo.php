<?php
// api/modelo.php
require_once 'db.php';

function crearTarea($titulo) {
    global $pdo;
    $sql = "INSERT INTO tareas (titulo) VALUES (:titulo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['titulo' => htmlspecialchars($titulo)]);
    return $pdo->lastInsertId();
}

function obtenerTareas() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM tareas ORDER BY id DESC");
    return $stmt->fetchAll();
}

function actualizarTarea($id, $titulo, $completada) {
    global $pdo;
    $sql = "UPDATE tareas SET titulo = :titulo, completada = :completada WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'titulo' => htmlspecialchars($titulo),
        'completada' => $completada ? 1 : 0,
        'id' => (int)$id
    ]);
}

function borrarTarea($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM tareas WHERE id = :id");
    return $stmt->execute(['id' => (int)$id]);
}
