<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "pintaeskabio");

if ($conexion->connect_error) {
    die(json_encode(['status' => 'error', 'message' => "Conexión fallida: " . $conexion->connect_error]));
}

$response = array('status' => 'error', 'message' => 'No se pudo procesar la compra.');

try {
    $body = json_decode(file_get_contents('php://input'), true);

    if (isset($body['external_reference'])) {
        $external_reference = $body['external_reference'];

        // Verificar que la venta ya no haya sido procesada
        $query_check = "SELECT COUNT(*) AS count FROM venta WHERE external_reference = ?";
        $stmt_check = $conexion->prepare($query_check);
        $stmt_check->bind_param("s", $external_reference);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();

        if ($row_check['count'] == 0) {
            // Obtener el carrito de la sesión
            $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();

            if (!empty($carrito)) {
                $cliente_id = $_SESSION['usuario']; // Obtener el ID del usuario desde la sesión

                // Comienza una transacción para garantizar la integridad de los datos
                $conexion->begin_transaction();

                try {
                    // Insertar venta
                    $query_venta = "INSERT INTO venta (Fecha, ID_Usuario, external_reference) VALUES (NOW(), ?, ?)";
                    $stmt_venta = $conexion->prepare($query_venta);
                    $stmt_venta->bind_param("is", $cliente_id, $external_reference);
                    if (!$stmt_venta->execute()) {
                        throw new Exception("Error: " . $query_venta . "<br>" . $stmt_venta->error);
                    }

                    $venta_id = $conexion->insert_id;

                    // Insertar detalles de venta y actualizar stock
                    foreach ($carrito as $producto) {
                        $producto_id = $producto['id'];
                        $nombre = $producto['nombre'];
                        $precio_unitario = $producto['precio'];
                        $cantidad = $producto['cantidad'];

                        // Verificar stock disponible
                        $query_stock_check = "SELECT Stock FROM producto WHERE id = ?";
                        $stmt_stock_check = $conexion->prepare($query_stock_check);
                        $stmt_stock_check->bind_param("i", $producto_id);
                        $stmt_stock_check->execute();
                        $result_stock_check = $stmt_stock_check->get_result();
                        $row_stock_check = $result_stock_check->fetch_assoc();
                        $stock_disponible = $row_stock_check['Stock'];

                        if ($stock_disponible < $cantidad) {
                            throw new Exception("Error. No hay stock disponible para el producto: $nombre");
                        }

                        // Insertar detalle de venta
                        $query_detalle = "INSERT INTO detalle_venta (ID_Venta, ID_Producto, Cantidad, Precio) VALUES (?, ?, ?, ?)";
                        $stmt_detalle = $conexion->prepare($query_detalle);
                        $stmt_detalle->bind_param("iiid", $venta_id, $producto_id, $cantidad, $precio_unitario);
                        if (!$stmt_detalle->execute()) {
                            throw new Exception("Error: " . $query_detalle . "<br>" . $stmt_detalle->error);
                        }

                        // Actualizar stock del producto
                        $query_stock_update = "UPDATE producto SET Stock = Stock - ? WHERE id = ?";
                        $stmt_stock_update = $conexion->prepare($query_stock_update);
                        $stmt_stock_update->bind_param("ii", $cantidad, $producto_id);
                        if (!$stmt_stock_update->execute()) {
                            throw new Exception("Error: " . $query_stock_update . "<br>" . $stmt_stock_update->error);
                        }
                    }

                    // Confirmar la transacción
                    $conexion->commit();

                    // Configurar respuesta exitosa
                    $response['status'] = 'success';
                    $response['message'] = 'Tu compra se realizó con éxito.';
                } catch (Exception $e) {
                    $response['message'] = $e->getMessage();
                    $conexion->rollback(); // Revertir la transacción en caso de error
                }
            } else {
                $response['message'] = 'El carrito está vacío.';
            }
        } else {
            $response['message'] = 'La venta ya ha sido procesada anteriormente.';
        }
    } else {
        $response['message'] = 'Referencia externa no válida.';
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

$conexion->close();
echo json_encode($response);
?>