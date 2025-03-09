<?php 
require_once 'bd.php';
global $conexion;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $ubicacion = trim($_POST["ubicacion"]);
    $habitaciones = (int)$_POST["habitaciones"];
    $tarifa = (float)$_POST["tarifa"];

    if ($habitaciones <= 0 || $tarifa <= 0) {
        die("Error: Habitaciones y Tarfifas tienes que ser valores positivos y mayores a 0.");
    }

    try {
        $sql = "INSERT INTO hotel (nombre, ubicacion, habitaciones_disponibles, tarifa_noche) VALUES(:nombre, :ubicacion, :habitaciones, :tarifa)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":ubicacion", $ubicacion, PDO::PARAM_STR);
        $stmt->bindParam(":habitaciones", $habitaciones, PDO::PARAM_INT);
        $stmt->bindPARAM(":tarifa", $tarifa, PDO::PARAM_STR);

        if ($stmt ->execute()) {
            echo "Hotel agregado de forma exitosa.";
        } else {
            echo "Error al agregar el Hotel";
        }
    } catch (PDOException $e) {
        echo "Error al intertar el hotel: " . $e->getMessage();
    }
}
?>

