<?php
$host = getenv("AIVEN_HOST");
$port = getenv("AIVEN_PORT");
$dbname = getenv("AIVEN_DB");
$user = getenv("AIVEN_USER");
$password = getenv("AIVEN_PASSWORD");
$ssl_ca = getenv("AIVEN_CA_PATH");

$options = [
    PDO::MYSQL_ATTR_SSL_CA => $ssl_ca,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {
    $conexion = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $user,
        $password,
        $options
    );
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>
