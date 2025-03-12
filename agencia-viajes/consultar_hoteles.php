<?php
require_once 'bd.php'; // Incluye el archivo 'bd.php' que contiene la conexión a la base de datos.
global $conexion; // Declara la variable global $conexion para usar la conexión establecida en 'bd.php'.

try {
    $sql = "SELECT h.id_hotel, h.nombre, COUNT(r.id_reserva) AS total_reservas
            FROM hotel h
            JOIN reserva r ON h.id_hotel = r.id_hotel
            GROUP BY h.id_hotel, h.nombre
            HAVING COUNT(r.id_reserva) > 2";
    // Consulta SQL que selecciona los hoteles con más de 2 reservas:
    // - Obtiene el ID del hotel, su nombre y la cantidad total de reservas.
    // - Usa JOIN para combinar las tablas 'hotel' y 'reserva' en base a 'id_hotel'.
    // - Agrupa los resultados por ID y nombre del hotel.
    // - Filtra solo los hoteles con más de 2 reservas usando HAVING COUNT(r.id_reserva) > 2.

    $stmt = $conexion->prepare($sql); // Prepara la consulta SQL en la base de datos.
    $stmt->execute(); // Ejecuta la consulta.
    $hoteles = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtiene los resultados en un array asociativo.

    if (!empty($hoteles)) { // Verifica si hay resultados en la consulta.
        echo "<h2>Hoteles con más de 2 reservas:</h2>"; // Muestra un título.
        echo "<table border='1'>
                <tr>
                    <th>ID Hotel</th>
                    <th>Nombre</th>
                    <th>Total de reservas</th>
                </tr>";
        // Crea una tabla con encabezados: ID del hotel, nombre y total de reservas.

        foreach ($hoteles as $hotel) { // Recorre cada hotel obtenido en la consulta.
            echo "<tr>
                    <td>" . htmlspecialchars($hotel['id_hotel']) . "</td>
                    <td>" . htmlspecialchars($hotel['nombre']) . "</td>
                    <td>" . htmlspecialchars($hotel['total_reservas']) . "</td>
                </tr>";
        }
        echo "</table>"; // Cierra la tabla HTML.
    } else {
        echo "<p>No hay hoteles con más de 2 reservas.</p>"; // Mensaje si no hay hoteles que cumplan la condición.
    }

} catch (PDOException $e) { // Captura cualquier error relacionado con la base de datos.
    echo "<p>Error en la consulta: " . htmlspecialchars($e->getMessage()) . "</p>"; // Muestra el mensaje de error.
}
?>
