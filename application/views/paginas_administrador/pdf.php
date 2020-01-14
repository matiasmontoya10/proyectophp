<?php

require('fpdf/fpdf.php');

// RECUPERANDO VARIABLES AJAX

$data = $this->session->flashdata('data');

// CONEXION BD
$mysqli = new mysqli("localhost", "root", "", "santa_ana_sa");

$query = ("select * from caf join folio
            on caf.id_caf = folio.id_folio
            join factura on factura.id_folio = folio.id_folio
            join empresa on empresa.id_empresa = factura.id_empresa where id_factura = " . $data[2]);

$caf_folio_factura_empresa = array();

if ($result = $mysqli->query($query)) {

    while ($row = $result->fetch_assoc()) {

        array_push($caf_folio_factura_empresa, $row);
    }
}

//////////////////////////// SEGUNDA QUERY /////////////////////////////////

$query_dos = ("select * from producto join detalle_producto_pedido on
            producto.id_producto = detalle_producto_pedido.id_producto
            join pedido on pedido.id_pedido = detalle_producto_pedido.id_pedido join
            usuario on usuario.rut_usuario = pedido.rut_usuario join detalle_pedido_factura
            on pedido.id_pedido = detalle_pedido_factura.id_pedido join factura on factura.id_factura = 
            detalle_pedido_factura.id_factura join persona on persona.rut_persona = 
            usuario.rut_usuario where usuario.rut_usuario = " . $data[0] . " and factura.id_factura = " .$data[2]);

$cliente_pedido_producto = array();

if ($result_dos = $mysqli->query($query_dos)) {

    while ($row_dos = $result_dos->fetch_assoc()) {

        array_push($cliente_pedido_producto, $row_dos);
    }
}

$result->free();
$result_dos->free();

$mysqli->close();

//TERMINO BUSQUEDA BD PARA LA OBTENCION DE DATOS
//------------------------------------  DATOS EMPRESA

for ($i = 0; $i < count($caf_folio_factura_empresa); $i++) {

    //IDENTIFICAR VARIABLES
    $rut_empresa = $caf_folio_factura_empresa[$i]['rut_empresa'];
    $nombre_empresa = $caf_folio_factura_empresa[$i]['nombre_empresa'];
    $giro_comercial_empresa = $caf_folio_factura_empresa[$i]['giro_comercial_empresa'];
    $fecha_elaboracion_factura = ($caf_folio_factura_empresa[$i]['fecha_elaboracion_factura']);
    $tipo_documento = ($caf_folio_factura_empresa[$i]['tipo_documento']);
    $id_folio = ($caf_folio_factura_empresa[$i]['id_folio']);
    $fecha_vigencia_folio = ($caf_folio_factura_empresa[$i]['fecha_vigencia_folio']);
    $id_factura = ($caf_folio_factura_empresa[$i]['id_factura']);
}

// ----------------------------------- DATOS CLIENTE

$rut_cliente_receptor = $cliente_pedido_producto[0]['rut_persona'];
$nombre_cliente_receptor = $cliente_pedido_producto[0]['nombre_persona'];
$apellido_cliente_receptor = $cliente_pedido_producto[0]['apellido_persona'];
$direccion_cliente_receptor = $cliente_pedido_producto[0]['direccion_persona'];
$telefono_cliente_receptor = $cliente_pedido_producto[0]['telefono_persona'];
$correo_cliente_receptor = $cliente_pedido_producto[0]['correo_persona'];

// ESQUEMA PDF FACTURA

$fpdf = new FPDF();

$fpdf->AddPage('PORTRAIT', 'letter');

$fpdf->Image('logoPan.png', 5, 5, 40, 40, 'png');

//$fpdf->Cell(30, 5, $data[0]);
//$fpdf->Cell(30, 5, $data[1]);
//$fpdf->Cell(30, 5, $data[2]);
//ESQUEMA PARA EL DETALLE DEL PEDIDO
$fpdf->Rect(135, 5, 70, 37, 'T');
$fpdf->SetFont('Arial', '', 10);
$fpdf->Cell(95, 5, utf8_decode('SANTA ANA S.A.'), 0, 0, 'C', FALSE);
$fpdf->SetFont('Arial', 'B', 12);
$fpdf->SetTextColor(255, 0, 0);
$fpdf->Cell(132, 5, utf8_decode('RUT: 76.124.546-7'), 0, 0, 'C', FALSE);
$fpdf->Ln();
$fpdf->SetFont('Arial', '', 10);
$fpdf->SetTextColor(0, 0, 0);
$fpdf->Cell(95, 5, utf8_decode('Giro Comercial: ' . $giro_comercial_empresa), 0, 0, 'R', FALSE);
$fpdf->Ln();
$fpdf->Cell(119.5, 5, utf8_decode('Dirección: Calle 6 Sur #1348, Talca, Región del Maule'), 0, 0, 'R', FALSE);
$fpdf->SetFont('Arial', 'B', 12);
$fpdf->SetTextColor(255, 0, 0);
$fpdf->Cell(69, 5, utf8_decode('FACTURA ELECTRONICA'), 0, 0, 'R', FALSE);
$fpdf->Ln();
$fpdf->SetFont('Arial', '', 10);
$fpdf->SetTextColor(0, 0, 0);
$fpdf->Cell(97, 5, utf8_decode('Fono: 71 2 244179'), 0, 0, 'C', FALSE);
$fpdf->Ln();
$fpdf->Cell(94, 5, utf8_decode('Web: www.nuestropandecadadia.com'), 0, 0, 'R', FALSE);
$fpdf->SetFont('Arial', 'B', 12);
$fpdf->SetTextColor(255, 0, 0);
$fpdf->Cell(72, 5, utf8_decode('N°: ' . $id_factura), 0, 0, 'R', FALSE);
$fpdf->Ln(15);
$fpdf->SetFont('Arial', 'B', 12);
$fpdf->SetTextColor(255, 0, 0);
$fpdf->Cell(175, 5, 'S.I.I. - TALCA', 0, 0, 'R', FALSE);

// PARA FACTURA:

$fpdf->SetFont('Arial', '', 10);
$fpdf->SetTextColor(0, 0, 0);

$fpdf->Ln(10);
$fpdf->Cell(95, 5, utf8_decode('Fecha Emisión Factura: ' . $fecha_elaboracion_factura), 1, 0, 'C', FALSE);
$fpdf->Cell(100, 5, utf8_decode('Condición de Pago: Contado'), 1, 0, 'C', FALSE);
$fpdf->Ln(10);
$fpdf->Cell(5, 5);
$fpdf->Cell(70, 5, 'Cliente: ' . $nombre_cliente_receptor . ' ' . $apellido_cliente_receptor, 0, 0, 'L', FALSE);
$fpdf->Cell(80, 5, utf8_decode('Dirección: ' . $direccion_cliente_receptor), 0, 0, 'L', FALSE);
$fpdf->Cell(85, 5, utf8_decode('RUT: ' . $rut_cliente_receptor), 0, 0, 'L', FALSE);
$fpdf->Ln(7);
$fpdf->Cell(5, 5);
$fpdf->Cell(70, 1, utf8_decode('Telefono: ' . $telefono_cliente_receptor), 0, 0, 'L', FALSE);
$fpdf->Cell(80, 1, utf8_decode('Correo: ' . $correo_cliente_receptor), 0, 0, 'L', FALSE);
$fpdf->Cell(85, 1, utf8_decode('Comuna: Talca'), 0, 0, 'L', FALSE);

$fpdf->Ln(10);
$fpdf->Rect(10, 55, 195, 140, 'T');
$fpdf->Cell(50, 5, 'PRODUCTO', 1, 0, 'C', FALSE);
$fpdf->Cell(45, 5, 'KILOS', 1, 0, 'C', FALSE);
$fpdf->Cell(45, 5, 'PRECIO', 1, 0, 'C', FALSE);
$fpdf->Cell(55, 5, 'TOTAL', 1, 0, 'C', FALSE);

// ----------------------------------- DATOS PEDIDO Y TOTALES

$montoItemSumatoria = 0;

for ($i = 0; $i < count($cliente_pedido_producto); $i++) {

    //IDENTIFICAR VARIABLES
    $nroLinDet = $cliente_pedido_producto[$i]['id_pedido'];
    $tpoCodigo = $cliente_pedido_producto[$i]['id_producto'];
    $nmbItem = $cliente_pedido_producto[$i]['tipo_producto'];
    $qtyItem = $cliente_pedido_producto[$i]['cantidad_pedido'];
    $prcItem = $cliente_pedido_producto[$i]['precio_cliente_pedido'];
    $montoItem = $cliente_pedido_producto[$i]['total_pedido'];

    //PARA SACAR TOTALES

    $montoItemSumatoria += $montoItem;

    $fpdf->Ln(5);
    $fpdf->Cell(50, 5, $nmbItem, 0, 0, 'C', FALSE);
    $fpdf->Cell(45, 5, $qtyItem, 0, 0, 'C', FALSE);
    $fpdf->Cell(45, 5, '$' . $prcItem, 0, 0, 'C', FALSE);
    $fpdf->Cell(55, 5, '$' . $montoItem, 0, 0, 'C', FALSE);
}

$fpdf->Ln(108);

$fpdf->SetY(190);
$fpdf->Cell(130, 5, utf8_decode('Descripción sobre el detalle de la compra'), 1, 0, 'L', FALSE);
$fpdf->Cell(65, 5, utf8_decode('SubTotal:                 $') . $montoItemSumatoria, 1, 0, 'L', FALSE);
$fpdf->Ln(5);
$fpdf->Image('framework/imagenes/timbre.jpg', 17.5, 200, 75, 37.5, 'jpg');
$fpdf->Rect(140, 200, 65, 36.7, 'T');
$fpdf->Ln(10);
$fpdf->Cell(130, 5);
$fpdf->SetTextColor(255, 0, 0);
$fpdf->SetFont('Arial', 'B', 12);
$fpdf->Cell(80, 5, utf8_decode('Neto:                  $' . $montoItemSumatoria), 0, 0, 'L', FALSE);
$fpdf->Ln(10);
$fpdf->Cell(130, 5);
$fpdf->Cell(80, 5, utf8_decode('IVA 19%:            $' . ($montoItemSumatoria * 0.19)), 0, 0, 'L', FALSE);
$ivaNeto = ($montoItemSumatoria * 0.19);
$fpdf->Ln(10);
$fpdf->Cell(130, 5);
$fpdf->Cell(80, 5, utf8_decode('Total:                 $' . ($montoItemSumatoria + $ivaNeto)), 0, 0, 'L', FALSE);

//PIE DE PAGINA
$fpdf->SetFont('Arial', '', 10);
$fpdf->SetTextColor(0, 0, 0);
$fpdf->Rect(10, 240, 100, 35, 'T');
$fpdf->Ln(15);
$fpdf->Cell(50, 7, utf8_decode('Fec. Entrega:'), 1, 0, 'L', FALSE);
$fpdf->Cell(50, 7, utf8_decode('Recinto:'), 1, 0, 'L', FALSE);
$fpdf->Ln();
$fpdf->Cell(50, 7, utf8_decode('RUT:'), 1, 0, 'L', FALSE);
$fpdf->Cell(50, 7, utf8_decode('Firma:'), 1, 0, 'L', FALSE);
$fpdf->Ln(9);
$fpdf->Cell(1, 1, utf8_decode('Nombre:'), 0, 0, 'L', FALSE);
$fpdf->Image('art.JPG', 138, 238, 70, 40, 'JPG');


//$fpdf->Cell(30, 20, $prcItem, 1, 0, 'C', FALSE);
//$fpdf->Cell(30, 20, $montoItemSumatoria, 1, 0, 'C', FALSE);
//$fpdf->Cell(30, 20, $apellido_cliente_receptor, 1, 0, 'C', FALSE);
//$fpdf->Cell(30, 20, $rut_empresa, 1, 0, 'C', FALSE);
//FIN ESQUEMA DE PEDIDO

$fpdf->Output();


