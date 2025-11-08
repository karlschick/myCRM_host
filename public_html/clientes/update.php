<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

// Sanitizar helper
function clean($v) {
    return isset($v) ? trim($v) : null;
}

$documentoCliente = clean($_POST['id'] ?? '');
$idCliente = clean($_POST['idCliente'] ?? '');

if (!$documentoCliente && !$idCliente) {
    die("Error: ID de cliente no recibido.");
}

// ------------------ CAMPOS CLIENTE ------------------
// Recoger campos del POST y sanitizar
$campos = [
    // IDENTIFICACIÓN
    'tipoDocumento' => clean($_POST['tipoDocumento'] ?? ''),
    'documentoCliente' => clean($_POST['documentoCliente'] ?? ''),
    'tipoCliente' => clean($_POST['tipoCliente'] ?? ''),
    'nombreCliente' => clean($_POST['nombreCliente'] ?? ''),
    'apellidoCliente' => clean($_POST['apellidoCliente'] ?? ''), // ⭐ AGREGADO
    
    // CONTACTO
    'telefonoCliente' => clean($_POST['telefonoCliente'] ?? ''),
    'correoCliente' => clean($_POST['correoCliente'] ?? ''),
    'correoFacturacion' => clean($_POST['correoFacturacion'] ?? ''),
    
    // UBICACIÓN
    'pais' => clean($_POST['pais'] ?? ''),
    'ciudadCliente' => clean($_POST['ciudadCliente'] ?? ''),
    'departamentoCliente' => clean($_POST['departamentoCliente'] ?? ''),
    'direccion' => clean($_POST['direccion'] ?? ''),
    'barrioCliente' => clean($_POST['barrioCliente'] ?? ''),
    'estrato' => clean($_POST['estrato'] ?? '') ?: null,
    'codigoPostalCliente' => clean($_POST['codigoPostalCliente'] ?? ''),
    'coordenadasGPS' => clean($_POST['coordenadasGPS'] ?? ''),
    'referenciaUbicacion' => clean($_POST['referenciaUbicacion'] ?? ''),
    'zonaCobertura' => clean($_POST['zonaCobertura'] ?? ''),
    'sucursal' => clean($_POST['sucursal'] ?? ''),
    'ciudadDian' => clean($_POST['ciudadDian'] ?? ''),
    
    // ESTADO Y SERVICIO
    'estadoCliente' => clean($_POST['estadoCliente'] ?? ''),
    'motivoSuspension' => clean($_POST['motivoSuspension'] ?? ''),
    'plan_idPlan' => clean($_POST['plan_idPlan'] ?? '') ?: null,
    'meses_gracia' => clean($_POST['meses_gracia'] ?? '0'),
    'valorInstalacion' => clean($_POST['valorInstalacion'] ?? '') ?: null,
    'valorAPagar' => clean($_POST['valorAPagar'] ?? '') ?: null,
    
    // TÉCNICO
    'tipologiaRed' => clean($_POST['tipologiaRed'] ?? ''),
    'nodoConexion' => clean($_POST['nodoConexion'] ?? ''),
    'puertoSwitch' => clean($_POST['puertoSwitch'] ?? ''),
    'promedioVelocidad' => clean($_POST['promedioVelocidad'] ?? '') ?: null,
    'calidadServicio' => clean($_POST['calidadServicio'] ?? '5'),
    'cantidadSoportesMes' => clean($_POST['cantidadSoportesMes'] ?? '0'),
    'ultimoSoporte' => clean($_POST['ultimoSoporte'] ?? '') ?: null,
    'tecnicoAsignado_idUsuario' => clean($_POST['tecnicoAsignado_idUsuario'] ?? '') ?: null,
    
    // COMERCIAL
    'vendedor_idUsuario' => clean($_POST['vendedor_idUsuario'] ?? '') ?: null,
    'referenciadoPor_idCliente' => clean($_POST['referenciadoPor_idCliente'] ?? '') ?: null,
    'tieneReferidos' => clean($_POST['tieneReferidos'] ?? '0'),
    'origenCliente' => clean($_POST['origenCliente'] ?? ''),
    'categoriaCliente' => clean($_POST['categoriaCliente'] ?? ''),
    
    // FECHAS
    'creado' => clean($_POST['creado'] ?? '') ?: null,
    'fechaInstalacion' => clean($_POST['fechaInstalacion'] ?? '') ?: null,
    'fechaActivacion' => clean($_POST['fechaActivacion'] ?? '') ?: null,
    'ultimaActualizacion' => date('Y-m-d'),
    'fechaSuspension' => clean($_POST['fechaSuspension'] ?? '') ?: null,
    'fechaCorte' => clean($_POST['fechaCorte'] ?? '') ?: null,
    'fechaContrato' => clean($_POST['fechaContrato'] ?? '') ?: null,
    
    // CONTRATO
    'clausulaMeses' => clean($_POST['clausulaMeses'] ?? '') ?: null,
    'mesFin' => clean($_POST['mesFin'] ?? '') ?: null,
    'mesesParaFinalizar' => clean($_POST['mesesParaFinalizar'] ?? '') ?: null,
    
    // OBSERVACIONES
    'observaciones' => clean($_POST['observaciones'] ?? ''),
    'notas' => clean($_POST['notas'] ?? ''),
    
    // AUDITORÍA
    'eliminado' => isset($_POST['eliminado']) ? 1 : 0,
    'creadoPor' => clean($_POST['creadoPor'] ?? '') ?: null,
    'actualizadoPor' => $_SESSION['idUsuario'] ?? null
];

// ------------------ MANEJO ESPECIAL PARA documentosAdjuntos (JSON) ------------------
$documentosAdjuntos = clean($_POST['documentosAdjuntos'] ?? '');
if (!empty($documentosAdjuntos)) {
    // Intentar validar si es JSON válido
    $jsonTest = json_decode($documentosAdjuntos);
    if (json_last_error() === JSON_ERROR_NONE) {
        // Es JSON válido, guardarlo tal cual
        $campos['documentosAdjuntos'] = $documentosAdjuntos;
    } else {
        // No es JSON válido, convertirlo a JSON simple
        $campos['documentosAdjuntos'] = json_encode(['texto' => $documentosAdjuntos]);
    }
} else {
    // Campo vacío, usar NULL
    $campos['documentosAdjuntos'] = null;
}

// ------------------ ACTUALIZAR CLIENTE ------------------
$sets = [];
$valores = [];
$tipos = '';

// Campos numéricos enteros
$camposInt = [
    'estrato', 'cantidadSoportesMes', 'calidadServicio', 'meses_gracia', 
    'tieneReferidos', 'eliminado', 'clausulaMeses', 'mesesParaFinalizar', 
    'vendedor_idUsuario', 'tecnicoAsignado_idUsuario', 'referenciadoPor_idCliente', 
    'creadoPor', 'actualizadoPor', 'plan_idPlan'
];

// Campos numéricos decimales
$camposDecimal = ['promedioVelocidad', 'valorAPagar', 'valorInstalacion'];

foreach ($campos as $col => $valor) {
    $sets[] = "$col = ?";
    $valores[] = $valor;
    
    // Determinar tipo según el valor
    if (is_null($valor)) {
        $tipos .= 's'; // NULL como string
    } elseif (in_array($col, $camposInt)) {
        $tipos .= 'i'; // integer
    } elseif (in_array($col, $camposDecimal)) {
        $tipos .= 'd'; // double/decimal
    } else {
        $tipos .= 's'; // string
    }
}

$sql = "UPDATE cliente SET " . implode(", ", $sets) . " WHERE idCliente = ?";
$valores[] = $idCliente;
$tipos .= 'i';

$stmt = $con->prepare($sql);
if (!$stmt) {
    die("Error en prepare: " . $con->error);
}

$stmt->bind_param($tipos, ...$valores);

// Ejecutar actualización del cliente
$clienteActualizado = false;
if ($stmt->execute()) {
    $clienteActualizado = true;
} else {
    die("Error al actualizar cliente: " . $stmt->error);
}

$stmt->close();

// ------------------ ACTUALIZAR FACTURA (si viene información) ------------------
$fechaFactura = clean($_POST['fechaFactura'] ?? '');
$fechaVencimiento = clean($_POST['fechaVencimiento'] ?? '');
$fechaSuspencion = clean($_POST['fechaSuspencion'] ?? '');
$estadoFactura = clean($_POST['estadoFactura'] ?? '');

if ($fechaFactura && $fechaVencimiento && $estadoFactura) {
    // Buscar la última factura del cliente
    $sqlFactura = "SELECT idFactura FROM factura WHERE cliente_idCliente = ? ORDER BY idFactura DESC LIMIT 1";
    $stmtFactura = $con->prepare($sqlFactura);
    $stmtFactura->bind_param("i", $idCliente);
    $stmtFactura->execute();
    $resultFactura = $stmtFactura->get_result();
    
    if ($resultFactura && $resultFactura->num_rows > 0) {
        $factura = $resultFactura->fetch_assoc();
        $idFactura = $factura['idFactura'];
        
        // Actualizar la factura existente
        $sqlUpdateFactura = "UPDATE factura SET 
                             fechaFactura = ?,
                             fechaVencimiento = ?,
                             fechaSuspencion = ?,
                             estadoFactura = ?
                             WHERE idFactura = ?";
        
        $stmtUpdateFactura = $con->prepare($sqlUpdateFactura);
        $stmtUpdateFactura->bind_param("ssssi", 
            $fechaFactura, 
            $fechaVencimiento, 
            $fechaSuspencion, 
            $estadoFactura, 
            $idFactura
        );
        
        $stmtUpdateFactura->execute();
        $stmtUpdateFactura->close();
    }
    
    $stmtFactura->close();
}

// ------------------ ACTUALIZAR TELÉFONO PRINCIPAL ------------------
$telefonoCliente = clean($_POST['telefonoCliente'] ?? '');
if ($telefonoCliente) {
    // Verificar si existe un teléfono principal
    $sqlTelCheck = "SELECT idTelefono FROM cliente_telefono WHERE cliente_idCliente = ? AND esPrincipal = 1 LIMIT 1";
    $stmtTelCheck = $con->prepare($sqlTelCheck);
    $stmtTelCheck->bind_param("i", $idCliente);
    $stmtTelCheck->execute();
    $resultTel = $stmtTelCheck->get_result();
    
    if ($resultTel && $resultTel->num_rows > 0) {
        // Actualizar teléfono existente
        $tel = $resultTel->fetch_assoc();
        $sqlUpdateTel = "UPDATE cliente_telefono SET numeroTelefono = ? WHERE idTelefono = ?";
        $stmtUpdateTel = $con->prepare($sqlUpdateTel);
        $stmtUpdateTel->bind_param("si", $telefonoCliente, $tel['idTelefono']);
        $stmtUpdateTel->execute();
        $stmtUpdateTel->close();
    } else {
        // Insertar nuevo teléfono principal
        $sqlInsertTel = "INSERT INTO cliente_telefono (cliente_idCliente, tipoTelefono, numeroTelefono, esPrincipal, activo) 
                         VALUES (?, 'Principal', ?, 1, 1)";
        $stmtInsertTel = $con->prepare($sqlInsertTel);
        $stmtInsertTel->bind_param("is", $idCliente, $telefonoCliente);
        $stmtInsertTel->execute();
        $stmtInsertTel->close();
    }
    
    $stmtTelCheck->close();
}

// ------------------ ACTUALIZAR SERVICIO PRINCIPAL (si cambió el plan) ------------------
$plan_idPlan = clean($_POST['plan_idPlan'] ?? '');
if ($plan_idPlan) {
    // Buscar el servicio principal del cliente
    $sqlServicio = "SELECT cs.idClienteServicio, cs.servicio_idServicio 
                    FROM cliente_servicio cs 
                    WHERE cs.cliente_idCliente = ? AND cs.esPrincipal = 1 
                    LIMIT 1";
    $stmtServicio = $con->prepare($sqlServicio);
    $stmtServicio->bind_param("i", $idCliente);
    $stmtServicio->execute();
    $resultServicio = $stmtServicio->get_result();
    
    if ($resultServicio && $resultServicio->num_rows > 0) {
        $servicio = $resultServicio->fetch_assoc();
        
        // Obtener el precio del nuevo plan
        $sqlPlan = "SELECT precioPlan FROM plan WHERE idPlan = ?";
        $stmtPlan = $con->prepare($sqlPlan);
        $stmtPlan->bind_param("i", $plan_idPlan);
        $stmtPlan->execute();
        $resultPlan = $stmtPlan->get_result();
        
        if ($resultPlan && $resultPlan->num_rows > 0) {
            $planData = $resultPlan->fetch_assoc();
            $precioPlan = $planData['precioPlan'];
            
            // Actualizar el valor del servicio
            $sqlUpdateServicio = "UPDATE cliente_servicio SET 
                                  codigoPlan = ?,
                                  valorServicio = ?
                                  WHERE idClienteServicio = ?";
            $stmtUpdateServicio = $con->prepare($sqlUpdateServicio);
            $stmtUpdateServicio->bind_param("sdi", $plan_idPlan, $precioPlan, $servicio['idClienteServicio']);
            $stmtUpdateServicio->execute();
            $stmtUpdateServicio->close();
        }
        
        $stmtPlan->close();
    }
    
    $stmtServicio->close();
}

// ------------------ RESPUESTA FINAL ------------------
if ($clienteActualizado) {
    echo '<script>alert("Cliente actualizado correctamente."); window.location.href="tablas.php";</script>';
} else {
    echo '<script>alert("Error al actualizar el cliente."); window.history.back();</script>';
}

$con->close();
?>