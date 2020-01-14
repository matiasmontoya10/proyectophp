<?php
//PARA OBTENER RUT DE LA ULTIMA FACTURA. VALIDADOR PARA QUE NO SE REPITA.

$mysqli_factura = new mysqli("localhost", "root", "", "santa_ana_sa");

$query_factura = ("select *, concat(persona.nombre_persona,' ',persona.apellido_persona) as nombre_apellido from producto join detalle_producto_pedido on
            producto.id_producto = detalle_producto_pedido.id_producto
            join pedido on pedido.id_pedido = detalle_producto_pedido.id_pedido join
            usuario on usuario.rut_usuario = pedido.rut_usuario join detalle_pedido_factura
            on pedido.id_pedido = detalle_pedido_factura.id_pedido join factura on factura.id_factura = 
            detalle_pedido_factura.id_factura join persona on persona.rut_persona = 
            usuario.rut_usuario join folio on folio.id_folio = factura.id_folio 
            join caf on caf.id_caf = folio.id_folio order by factura.id_factura desc limit 1");

$factura_values = array();


if ($result = $mysqli_factura->query($query_factura)) {

    while ($row = $result->fetch_assoc()) {

        array_push($factura_values, $row);
    }
}

$rut_usuario_validador = $factura_values[0]['rut_usuario'];
$id_factura_validador = $factura_values[0]['id_factura'];

$result->free();
$mysqli_factura->close();

//ACCIONES PARA XML Y FACTURA

if (isset($_POST["boton_xml_enviar"])) {

    $rut_usuario_xml = $_POST["rut_usuario_e"];
    $id_pedido_xml = $_POST["id_pedido_e"];
    $id_factura_xml = $_POST["id_factura_e"];

    //BOTON    
    $mysqli = new mysqli("localhost", "root", "", "santa_ana_sa");

    if ($mysqli->connect_errno) {
        echo "Conexion Rechazada" . $mysqli->connect_error;
        exit();
    }

    $query = ("select * from caf join folio
            on caf.id_caf = folio.id_folio
            join factura on factura.id_folio = folio.id_folio
            join empresa on empresa.id_empresa = factura.id_empresa where id_factura = " . $id_factura_xml);

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
            usuario.rut_usuario where usuario.rut_usuario = " . $rut_usuario_xml);

    $cliente_pedido_producto = array();

    if ($result_dos = $mysqli->query($query_dos)) {

        while ($row_dos = $result_dos->fetch_assoc()) {

            array_push($cliente_pedido_producto, $row_dos);
        }
    }

    if (count($caf_folio_factura_empresa) || count($cliente_pedido_producto)) {

        createXMLfile($caf_folio_factura_empresa, $cliente_pedido_producto);
    }

    $result->free();
    $result_dos->free();

    $mysqli->close();
}

function createXMLfile($caf_folio_factura_empresa, $cliente_pedido_producto) {

    //CREACION PARA EL GUARDADO DE DOCUMENTO
    $fecha = date('d-m-Y H:i:s');
    $fecha_modificada = str_replace(":", "'", $fecha);
    $filePath = 'xml/xml_test ' . $fecha_modificada . '.xml';

    //CREACION DE ESQUEMA XML
    $dom = new DOMDocument('1.0', 'utf-8');
    $setDte = $dom->createElement('setDTE');

    //RECORRER PRIMERA CONSULTA   
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

        //CABECERA PRINCIPAL PRIMERA QUERY
        $id_factura_cabecera = $dom->createElement('Envio');
        $id_factura_cabecera->setAttribute("DTE", $id_factura);
        $id_factura_salida = $id_factura_cabecera;

        //CREAR CABECERA
        $caratula = $dom->createElement('CaratulaVersion');

        //ESQUEMA DE DIBUJO INICIO
        $rut_empresa_salida = $dom->createElement('RutEmisor', $rut_empresa);
        $caratula->appendChild($rut_empresa_salida);

        $fecha_elaboracion_factura_caratula = $dom->createElement('FchResol', $fecha_elaboracion_factura);
        $caratula->appendChild($fecha_elaboracion_factura_caratula);

        //NUEVA CARATULA
        $sub_caratula = $dom->createElement('SubTotDTE');
        $tipo_documento_salida = $dom->createElement('TipoDTE', $tipo_documento);
        $sub_caratula->appendChild($tipo_documento_salida);
        $id_folio_salida = $dom->createElement('NroDte', $id_folio);

        //CIERRE
        $sub_caratula->appendChild($id_folio_salida);
        $caratula->appendChild($sub_caratula);

        //INICIO
        $encabezado = $dom->createElement('Encabezado');
        //
        $id_doc = $dom->createElement('idDoc');
        //
        $tipo_documento_encabezado = $dom->createElement('TipoDTE', $tipo_documento);
        $id_doc->appendChild($tipo_documento_encabezado);
        $fecha_vigencia_folio_salida = $dom->createElement('FchEmis', $fecha_vigencia_folio);
        $id_doc->appendChild($fecha_vigencia_folio_salida);
        $encabezado->appendChild($id_doc);
        //
        $emisor = $dom->createElement('Emisor');
        //
        $rut_empresa_salida_emisor = $dom->createElement('RutEmisor', $rut_empresa);
        $emisor->appendChild($rut_empresa_salida_emisor);

        $nombre_empresa_salida = $dom->createElement('RznSoc', $nombre_empresa);
        $emisor->appendChild($nombre_empresa_salida);

        $giro_comercial_empresa_salida = $dom->createElement('GiroEmis', $giro_comercial_empresa);
        $emisor->appendChild($giro_comercial_empresa_salida);

        //PARA CAF        
        $id_caf = $caf_folio_factura_empresa[$i]['id_caf'];
        $encriptacion_caf = $caf_folio_factura_empresa[$i]['encriptacion_caf'];

        $cafVersion = $dom->createElement('CafVersion');

        $fecha_factura_caf = $dom->createElement('FA', $fecha_elaboracion_factura);
        $cafVersion->appendChild($fecha_factura_caf);

        $id_caf_caf = $dom->createElement('RNG', $id_caf);
        $cafVersion->appendChild($id_caf_caf);

        $encriptacion_caf_caf = $dom->createElement('FRMA', $encriptacion_caf);
        $cafVersion->appendChild($encriptacion_caf_caf);

        //TERMINO DE DIBUJO
        $encabezado->appendChild($emisor);
        $id_factura_cabecera->appendChild($caratula);
        $id_factura_cabecera->appendChild($caratula);
        $id_factura_cabecera->appendChild($encabezado);
        $id_factura_cabecera->appendChild($cafVersion);
        $setDte->appendChild($id_factura_salida);
    }

    ////////////////////////////INICIO SEGUNDA QUERY////////////////////////////

    $rut_cliente_receptor = $cliente_pedido_producto[0]['rut_persona'];
    $nombre_cliente_receptor = $cliente_pedido_producto[0]['nombre_persona'];
    $apellido_cliente_receptor = $cliente_pedido_producto[0]['apellido_persona'];
    $direccion_cliente_receptor = $cliente_pedido_producto[0]['direccion_persona'];

    $receptor = $dom->createElement('Receptor');
    //
    $rut_cliente_salida = $dom->createElement('RUTRecep', $rut_cliente_receptor);
    $receptor->appendChild($rut_cliente_salida);
    //
    $nombre_cliente_salida = $dom->createElement('NomRecep', $nombre_cliente_receptor);
    $receptor->appendChild($nombre_cliente_salida);
    //
    $apellido_cliente_salida = $dom->createElement('ApeRecep', $apellido_cliente_receptor);
    $receptor->appendChild($apellido_cliente_salida);
    //
    $direccion_cliente_salida = $dom->createElement('DirRecep', $direccion_cliente_receptor);
    $receptor->appendChild($direccion_cliente_salida);

    $encabezado->appendChild($receptor);

    ////////////////////////////////////////////////////////////////////////////
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
        //
        $detalle = $dom->createElement('Detalle');
        $NroLinDet_salida = $dom->createElement('NroLinDet', $nroLinDet);
        $detalle->appendChild($NroLinDet_salida);
        $tpoCodigo_salida = $dom->createElement('TpoCodigo', $tpoCodigo);
        $detalle->appendChild($tpoCodigo_salida);
        $nmbItem_salida = $dom->createElement('NmbItem', $nmbItem);
        $detalle->appendChild($nmbItem_salida);
        $qtyItem_salida = $dom->createElement('QtyItem', $qtyItem);
        $detalle->appendChild($qtyItem_salida);
        $prcItem_salida = $dom->createElement('PrcItem', $prcItem);
        $detalle->appendChild($prcItem_salida);
        $montoItem_salida = $dom->createElement('MontoItem', $montoItem);
        $detalle->appendChild($montoItem_salida);
        $encabezado->appendChild($detalle);
    }

    //EXPRESAR TOTALES
    $totales = $dom->createElement('Totales');
    $mntNeto = $dom->createElement('MntNeto', $montoItemSumatoria);
    $totales->appendChild($mntNeto);
    $encabezado->appendChild($totales);
    //
    $dom->appendChild($setDte);
    $dom->save($filePath);

    //PARA MOSTRAR EL CONTENIDO XML
    $dom->formatOutput = true;
    $el_xml = $dom->saveXML();

    echo "<script type='text/javascript'>alert('ARCHIVO XML CREADO CON EXITO');</script>";
}
?>

<main class="fondo_main">
    <!-- INICIO AGREGAR PANADERO -->
    <div id="modal_agregar_pedido" class="modal">
        <form method="POST">
            <div class="modal-content">
                <div class="card-panel borde_card_panel grey lighten-5">
                    <h5 class="center-align black-text"><b>AGREGAR PEDIDO</b></h5>
                    <div class="input-field">
                        <select id="select_usuario">

                        </select>
                        <label>CLIENTES:</label>

                    </div>
                    <div class="input-field">
                        <select id="tipo_pan" name="tipo_pan">
                            <option value="1">Pan Corriente</option>
                            <option value="2">Pan Integral</option>
                        </select>
                        <label>TIPO PAN:</label>

                    </div>
                    <div class="input-field">
                        <input id="precio_unitario_pedido" type="text" class="validate validar_numero precio_unitario_pedido" maxlength="5" required="true" pattern="[0-9]+" value="0" onkeyup="sumar();">
                        <label for="precio_unitario_pedido">PRECIO UNITARIO:</label>
                    </div>
                    <div class="input-field">
                        <input id="cantidad_pan_pedido" type="text" class="validate validar_numero cantidad_pan_pedido" maxlength="3" required="true" pattern="[0-9]+" value="0" onkeyup="sumar();">
                        <label for="cantidad_pan_pedido">KILOS:</label>
                    </div>
                    <div class="input-field">
                        <input id="total_pedido" type="text" class="validate" maxlength="7" required="true" pattern="[0-9]+" readonly="true">
                        <label for="total_pedido">TOTAL (SIN IVA):</label>
                    </div>
                    <p class="center"><b>¿Agregar pedido a última factura realizada?</b></p>
                    <div class="center">
                        <input name="grupo" type="radio" id="si" value="1" checked="true"/>
                        <label for="si">Sí</label>
                        <input name="grupo" type="radio" id="no" value="0"/>
                        <label for="no">No</label>
                    </div>
                    <div class="input-field center-align">
                        <button id="boton_agregar_pedido" type="submit" class="waves-effect waves-light btn-floating teal darken-2 pulse">
                            <i class="material-icons">add</i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- FIN AGREGAR PANADERO -->
    <div class="container">
        <br>
        <div class="row">
            <div class="col s12 m10 l10 offset-m1 offset-l1">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>ADMINISTRACIÓN DE PEDIDOS</b></h5>
                    <p class="center" hidden="true">
                        <?php echo '' . $rut_usuario_validador . ' ' . $id_factura_validador; ?>
                    </p>
                    <table id="tabla_listado_pedido" class="centered bordered highlight nowrap cell-border table-striped">
                        <thead class="teal darken-2 white-text">
                            <tr>
                                <th>N° PED.</th>
                                <th>TIPO PROD.</th>
                                <th>KILOS</th>
                                <th>PRECIO CLI.</th>
                                <th>TOTAL</th>
                                <th>RUT</th>
                                <th>NOM. APE.</th>
                                <th>DIRECCION</th>
<!--                                <th>N° CAF.</th>
                                <th>N° FOL.</th>-->
                                <th>N° FACT.</th>
                                <th>XML</th>
                                <th>FACTURA</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <br>
                    <button class="btn waves-effect waves-light teal darken-2 right modal-trigger" type="submit" name="action" href="#modal_agregar_pedido">
                        <b>AGREGAR</b>
                    </button>
                    <br><br>
                </div>
            </div>
        </div>
    </div>

    <!-- ----------------------------------------------------------- XML ------------------------ -->

    <div id="modal_xml" class="modal">
        <div class="modal-content">
            <form method="POST">
                <div class="card-panel black-text texto-justificado borde_card_panel">
                    <h5 class="center-align black-text"><b>GENERAR ARCHIVO .XML</b></h5>
                    <div class="row">
                        <div class="col s12 black-text">
<!--                            <p>RUT:</p>-->
                            <input type="hidden" id="rut_usuario_e" name="rut_usuario_e" required="true" readonly="true"/>
                            <p>ID PEDIDO:</p>
                            <input type="text" id="id_pedido_e"  name="id_pedido_e" required="true" readonly="true"/>
                            <p>FACTURA:</p>
                            <input type="text" id="id_factura_e" name="id_factura_e" required="true" readonly="true"/>
                        </div>
                    </div>
                    <button type="submit" name="boton_xml_enviar" class="waves-effect waves-light btn teal darken-2 right">GENERAR XML</button>
                    <br><br>
                </div>
            </form>
        </div>
    </div>


    <!----------------------------------------------------- PDF ------------------------------------------------------- -->

    <div id="modal_pdf" class="modal">
        <div class="modal-content">
            <!--            <form method="POST">-->
            <div class="card-panel black-text texto-justificado borde_card_panel">
                <h5 class="center-align black-text"><b>GENERAR FACTURA .PDF</b></h5>
                <div class="row">
                    <div class="col s12 black-text">
<!--                        <p>RUT:</p>-->
                        <input type="hidden" id="rut_usuario_e1" name="rut_usuario_e1" required="true" readonly="true"/>
                        <p>ID PEDIDO:</p>
                        <input type="text" id="id_pedido_e1"  name="id_pedido_e1" required="true" readonly="true"/>
                        <p>FACTURA:</p>
                        <input type="text" id="id_factura_e1" name="id_factura_e1" required="true" readonly="true"/>
                    </div>
                </div>
                <!--<button class="waves-effect waves-light btn teal darken-2 right white-text"><a type="submit" name="boton_pdf_enviar" target="_blank" rel="noopener noreferrer">GENERAR FACTURA</a></button>-->
                <a type="button" id="boton_pdf_enviar" class="waves-effect waves-light btn teal darken-2 right">GENERAR FACTURA</a>
                <br><br>
            </div>
            <!--            </form>-->
        </div>
    </div>
</main>
<script>
    var base_url = "http://localhost/proyecto_php/";
    var rut_usuario_validador = '<?php echo $rut_usuario_validador ?>';
    var id_factura_validador = '<?php echo $id_factura_validador ?>';
</script>
<script type="text/javascript">

    select_usuario();

    function select_usuario() {

        var rut_usuario = rut_usuario_php;

        $.ajax({
            url: base_url + "select_usuario_cliente",
            type: 'post',
            dataType: 'json',
            data: {rut_usuario: rut_usuario},
            success: function (result) {
                $.each(result, function (i, o) {
                    var val = o.nombre_persona + " " + o.apellido_persona;
                    var rut_usuario_oculto = o.rut_usuario;
                    $("#select_usuario").append(new Option(rut_usuario_oculto + " | " + val, rut_usuario_oculto));
                    $('select').material_select();
                });
            },
            error: function () {
                Materialize.toast("ERROR 500", "3000");
            }
        });
    }

    $('.validar_numero').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    sumar();

    function sumar() {

        var cantidad_pan_pedido = 0;
        var precio_unitario_pedido = 0;
        var total_pedido = 0;

        $(".precio_unitario_pedido").each(function () {
            if (isNaN(parseFloat($(this).val()))) {
                cantidad_pan_pedido += 0;
                precio_unitario_pedido += 0;
                total_pedido += 0;
            } else {
                precio_unitario_pedido += $(this).val();
            }
        });

        $(".cantidad_pan_pedido").each(function () {
            if (isNaN(parseFloat($(this).val()))) {
                cantidad_pan_pedido += 0;
                precio_unitario_pedido += 0;
                total_pedido += 0;
            } else {
                cantidad_pan_pedido += $(this).val();
            }
        });

        total_pedido = (cantidad_pan_pedido * precio_unitario_pedido);
        $("#total_pedido").val(total_pedido);
    }

    $('#tabla_listado_pedido').DataTable({
        scrollX: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_pedido",
            type: 'post'
        },
        "iDisplayLength": 5,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Listado de Pedidos',
                messageTop: 'Desarrollado por Matías Montoya P.',
                filename: 'proyecto_php',
                extend: 'pdfHtml5',
                download: 'open',
                pageSize: 'letter',
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                },
                customize: function (doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.content[2].margin = [50, 0, 50, 0];
                }
            }
        ],
        "order": [[0, "desc"]],
        "columnDefs": [
            {targets: [3, 4], "render": function (data, type, row, meta) {
                    return '$' + data;
                }
            },
            {targets: [9],
                "defaultContent": '<button id="boton_modal_xml" class="btn btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons">turned_in</i></button>'
            },
            {targets: [10],
                "defaultContent": '<button id="boton_modal_pdf" class="btn btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons">add</i></button>'
            },
            {targets: [5], "render": function (data, type, row, meta) {
                    return "'" + data + "'";
                }
            }
        ]
    });

    $("body").on("click", "#boton_modal_pdf", function (e) {
        e.preventDefault();

        var id_pedido = $(this).parent().parent().children()[0];
        var rut_usuario = $(this).parent().parent().children()[5];
        var id_factura = $(this).parent().parent().children()[8];

        $("#rut_usuario_e1").val($(rut_usuario).text());
        $("#id_factura_e1").val($(id_factura).text());
        $("#id_pedido_e1").val($(id_pedido).text());

        $("#modal_pdf").modal('open');
    });

    var rut_usuario_asincrono = rut_usuario_validador;
    var id_factura_asincrono = id_factura_validador;

    $("#boton_agregar_pedido").click(function (excepcion) {
        excepcion.preventDefault();
        //DATOS IMPORTANTES
        var rut_usuario = $("#select_usuario").val();
        //
        var precio_unitario_pedido = $("#precio_unitario_pedido").val();
        var cantidad_pan_pedido = $("#cantidad_pan_pedido").val();
        var total_pedido = $("#total_pedido").val();
        var tipo_pan = $("#tipo_pan").val();
        var grupo;

        if (precio_unitario_pedido == "0" || cantidad_pan_pedido == "0" || total_pedido == "0") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            if ($("#si").is(':checked')) {
                if (rut_usuario_asincrono == rut_usuario) {
                    grupo = 1;
                } else {
                    grupo = 2;
                }
            } else {
                grupo = 0;
            }
            //SEGUNDA SECUENCIA
            if (grupo == 2) {
                Materialize.toast("ERROR AL REGISTRAR PEDIDO A MISMO N° DE FACTURA. RUT INCORRECTO", "3000");
            } else {
                if (grupo == 1 || grupo == 0) {
                    $.ajax({
                        url: base_url + 'insertar_pedido_factura',
                        type: 'post',
                        dataType: 'json',
                        data: {rut_usuario: rut_usuario, precio_unitario_pedido: precio_unitario_pedido,
                            cantidad_pan_pedido: cantidad_pan_pedido, total_pedido: total_pedido, tipo_pan: tipo_pan, grupo: grupo, id_factura_asincrono: id_factura_asincrono},
                        success: function (resultado) {
                            if (resultado.mensaje === "0") {
                                Materialize.toast(resultado.mensaje, "3000");
                            } else {
                                Materialize.toast(resultado.mensaje, "3000");
                                $("#modal_agregar_pedido").modal('close');
                                $("#tabla_listado_pedido").DataTable().ajax.reload();
                                rut_usuario_asincrono = rut_usuario;
                                id_factura_asincrono = resultado.variable_id_pedido;
                            }
                        },
                        error: function () {
                            Materialize.toast("ERROR 500", "3000");
                        }
                    });
                }
            }
        }
    });


    $("body").on("click", "#boton_modal_xml", function (e) {
        e.preventDefault();

        var id_pedido = $(this).parent().parent().children()[0];
        var rut_usuario = $(this).parent().parent().children()[5];
        var id_factura = $(this).parent().parent().children()[8];

        $("#rut_usuario_e").val($(rut_usuario).text());
        $("#id_factura_e").val($(id_factura).text());
        $("#id_pedido_e").val($(id_pedido).text());

        $("#modal_xml").modal('open');
    });

    $("#boton_pdf_enviar").click(function () {

        var rut_usuario_1 = $("#rut_usuario_e1").val();
        var id_factura_1 = $("#id_factura_e1").val();
        var id_pedido_1 = $("#id_pedido_e1").val();
        var base_url_pdf_1 = "http://localhost/proyecto_php/welcome/controlador_generar_factura";
        var base_url_pdf_2 = "http://localhost/proyecto_php/welcome/vista_generar_factura";
        $.ajax({
            url: base_url_pdf_1,
            type: 'post',
            data: {rut_usuario: rut_usuario_1, id_factura: id_factura_1,
                id_pedido: id_pedido_1},
            success: function () {
                Materialize.toast("FACTURA GENERADA CON EXITO", "3000");
                window.open(base_url_pdf_2, '_blank');
            },
            error: function () {
                Materialize.toast("ERROR 500", "3000");
            }
        });
    });

</script>


