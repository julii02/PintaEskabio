<?php
// Configurar credenciales de Mercado Pago
$mp_access_token = 'TEST-4946848203049053-061522-d3acf38a8fdeddb8cd8c2adb269a05dd-693009205'; // Reemplaza con tu access token de Mercado Pago

// URL de la API de Mercado Pago para crear preferencias de pago (sandbox)
$mp_url = 'https://api.mercadopago.com/checkout/preferences';

// Datos recibidos del frontend (en este caso, esperamos un JSON)
$body = json_decode(file_get_contents('php://input'), true);

// Crear array de items a partir de los datos recibidos
$items = $body['items'];

// Generar un `external_reference` único para esta venta
session_start();
$external_reference = uniqid('venta_', true);
$_SESSION['external_reference'] = $external_reference;

// Estructura de datos para enviar a Mercado Pago
$data = [
    'items' => $items,
    'notification_url' => 'https://0694-2802-8010-993c-9901-71f2-682d-154a-458f.ngrok-free.app/notificacion_ipn.php', // URL de notificación IPN
    'external_reference' => $external_reference,
    'back_urls' => [
        'success' => 'http://localhost/PintaEsKbio/PintaEskabio/catalogo_log.php?status=approved&external_reference=' . $external_reference,
        'failure' => 'http://localhost/PintaEsKbio/PintaEskabio/catalogo_log.php?status=failure',
        'pending' => 'http://localhost/PintaEsKbio/PintaEskabio/catalogo_log.php?status=pending'
    ],
    'auto_return' => 'approved'
];

$options = [
    'http' => [
        'method' => 'POST',
        'header' => "Content-Type: application/json\r\n".
                    "Authorization: Bearer $mp_access_token\r\n",
        'content' => json_encode($data),
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($mp_url, false, $context);

if ($result === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al crear la preferencia en Mercado Pago']);
    exit;
}

// Decodificar la respuesta de Mercado Pago
$response = json_decode($result, true);

// Incluir el `external_reference` en la respuesta
$response['external_reference'] = $external_reference;

// Devolver la respuesta completa con la preferencia generada
echo json_encode($response);
?>