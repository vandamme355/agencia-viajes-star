<?php
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host       = $_ENV['DB_HOST'];
$port       = $_ENV['DB_PORT'];
$dbname     = $_ENV['DB_NAME'];
$clave      = $_ENV['DB_PASS'];
$usuario    = $_ENV['DB_USER'];
$charset    = 'utf8mb4';

$dsn        = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
try {
    $opciones = [
        PDO:: ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION, // Manejamos los errores con excepciones.
        PDO:: ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC, // Resultados de array asociativo.
        PDO:: ATTR_EMULATE_PREPARES     => false // Esta es la prevención en contra de SQL Injection.
    ];
    // Crear conexión PDO
    $conexion = new PDO($dsn, $usuario, $clave, $opciones);
    global $conexion; // hacemos que la conexión sea accesible en otros archivos.
    echo "Conexión exitosa a la base de datos.";
    } catch (PDOException $e) {
        echo "Conexión Fallida: " . $e->getMessage();
    }

?>

