<?php
session_start();

$response = array('status' => 'error', 'message' => 'No se pudo guardar el carrito.');

try {
    $body = json_decode(file_get_contents('php://input'), true);

    if (isset($body['carrito'])) {
        $_SESSION['carrito'] = $body['carrito'];
        $response['status'] = 'success';
        $response['message'] = 'Carrito guardado con éxito.';
    } else {
        $response['message'] = 'No se recibieron datos del carrito.';
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>