<?php
// public_html/dashboard/api/dashboard_data.php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../functions/dashboard_functions.php';

$tablas = [
    'Clientes'    => 'cliente',
    'Usuarios'    => 'usuario',
    'Planes'      => 'plan',
    'Facturas'    => 'factura',
    'Productos'   => 'producto',
    'PQRs'        => 'pqr2',
    'Visitas'     => 'visitas',
    'Solicitudes' => 'solicitudes'
];

$data = obtenerConteos($tablas);

echo json_encode($data);
