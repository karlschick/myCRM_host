<?php
require_once __DIR__ . '/../../config/db.php';

$idPlan = $_GET['idPlan'] ?? 0;

if (!$idPlan) {
    echo json_encode(["error" => "ID de plan inválido"]);
    exit;
}

// Traer datos del plan
$sql = "SELECT idPlan, codigoPlan, tipoPlan, velocidad, nombrePlan, precioPlan, desPlan, estadoPlan
        FROM plan
        WHERE idPlan = ? LIMIT 1";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $idPlan);
$stmt->execute();
$result = $stmt->get_result();

if ($plan = $result->fetch_assoc()) {
    // Calculamos impuestos y totales según precioPlan
    $subTotal = floatval($plan['precioPlan']);
    $impuesto = $subTotal * 0.19; // ejemplo 19%
    $total    = $subTotal + $impuesto;

    echo json_encode([
        "idPlan"     => $plan['idPlan'],
        "codigoPlan" => $plan['codigoPlan'],
        "tipoPlan"   => $plan['tipoPlan'],
        "velocidad"  => $plan['velocidad'],
        "nombrePlan" => $plan['nombrePlan'],
        "precioPlan" => $plan['precioPlan'],
        "desPlan"    => $plan['desPlan'],
        "estadoPlan" => $plan['estadoPlan'],
        "subTotal"   => number_format($subTotal, 2, '.', ''),
        "impuesto"   => number_format($impuesto, 2, '.', ''),
        "total"      => number_format($total, 2, '.', '')
    ]);
} else {
    echo json_encode(["error" => "Plan no encontrado"]);
}
