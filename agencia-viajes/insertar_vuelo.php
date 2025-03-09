<?php
require_once 'bd.php';
global $conexion;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origen = trim($_POST["origen"]);
    $destino = trim($_POST["destino"]);
    $fecha = $_POST["fecha"];
    $plazas = (int)$_POST["plazas"];
    $precio = (float)$_POST["precio"];

    if ($plazas <=0 || $precio <= 0) {
        die("Error: Plazas y Precio deben ser valores mayores a cero.");
    }

    try {
        $sql = "INSERT INTO vuelo (origen, destino, fecha, plazas, precio) VALUE (:origen, :destino, :fecha, :plazas, :precio)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":origen", $origen, PDO::PARAM_STR);
        $stmt->bindParam(":destino", $destino, PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
        $stmt->bindParam(":plazas", $plazas, PDO::PARAM_INT);
        $stmt->bindParam(":precio", $precio, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "El vuelo a sido agregado de forma exitosa.";
        } else {
            echo "Error en el ingreso del vuelo";
        }
    } catch (PDOException $e) {
        echo "Error en la inserción: " . $e->getMessage();
    }
}
?>

