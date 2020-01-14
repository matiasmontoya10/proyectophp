<main class="fondo_main">
    <!-- INICIO AGREGAR CONTABILIDAD -->
    <div id="modal_agregar_contabilidad" class="modal">
        <div class="modal-content">
            <div class="card-panel borde_card_panel grey lighten-5">
                <h5 class="center-align black-text"><b>AGREGAR CONTABILIDAD</b></h5>
                <div class="input-field">
                    <select id="activo_pasivo">

                    </select>
                    <label>ACTIVO PASIVO:</label>
                </div>
                <div class="input-field">
                    <select id="activo_pasivo_categoria">

                    </select>
                    <label>ACTIVO PASIVO CATEGORIA:</label>
                </div>
                <div class="input-field">
                    <select id="activo_pasivo_detalle">

                    </select>
                    <label>ACTIVO PASIVO DETALLE:</label>
                </div>
                <div class="input-field">
                    <input id="neto_contabilidad" type="text" class="validate iva_total validar_numero" maxlength="7" required="true" pattern="[0-9]+" onkeyup="sumar();">
                    <label for="neto_contabilidad">NETO:</label>
                </div>
                <div class="input-field">
                    <input id="iva_contabilidad" type="text" class="validate" maxlength="7" required="true" pattern="[0-9]+" readonly="true">
                    <label for="iva_contabilidad">IVA 19%:</label>
                </div>
                <div class="input-field">
                    <input id="total_contabilidad" type="text" class="validate" maxlength="7" required="true" pattern="[0-9]+" readonly="true">
                    <label for="total_contabilidad">TOTAL:</label>
                </div>
                <div class="input-field center-align">
                    <button id="boton_agregar_contabilidad" type="submit" class="waves-effect waves-light btn-floating teal darken-2 pulse">
                        <i class="material-icons">add</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN AGREGAR PANADERO -->
    <div class="container">
        <br>
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>ADMINISTRACIÓN CONTABLE</b></h5>
                    <div class="input-field">
                        <input id="total_general" type="text" readonly="true" class="center" placeholder="" style="font-weight: bold">
                        <label for="total_general">TOTAL GENERAL:</label>
                    </div>
                    <div class="input-field">
                        <input id="total_ingresos" type="text" readonly="true" class="center green-text darken-1" placeholder="" style="font-weight: bold">
                        <label for="total_ingresos">INGRESOS ACUMULADOS:</label>
                    </div>
                    <div class="input-field">
                        <input id="total_egresos" type="text" readonly="true"  class="center red-text darken-1" placeholder="" style="font-weight: bold">
                        <label for="total_egresos">EGRESOS ACUMULADOS:</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 l6">
                <div class="card-panel borde_card_panel">
                    <br>
                    <h5 class="center"><b>INGRESOS POR MES</b></h5>
                    <table id="tabla_listado_ingresos_mes" class="centered bordered highlight nowrap cell-border table-striped" style="text-transform:uppercase">
                        <thead class="teal darken-2 white-text">
                            <tr>
                                <th>MESES DE AUDITORÍA</th>
                                <th>INGRESOS</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card-panel borde_card_panel">
                    <br>
                    <h5 class="center"><b>EGRESOS POR MES</b></h5>
                    <table id="tabla_listado_egresos_mes" class="centered bordered highlight nowrap cell-border table-striped" style="text-transform:uppercase">
                        <thead class="teal darken-2 white-text">
                            <tr>
                                <th>MESES DE AUDITORÍA</th>
                                <th>EGRESOS</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>CONTABILIDAD HÍSTORICA</b></h5>
                    <table id="tabla_listado_contabilidad" class="centered bordered highlight nowrap cell-border table-striped">
                        <thead class="teal darken-2 white-text">
                            <tr>
                                <th>ID</th>
                                <th>TOTAL</th>
                                <th>IVA</th>
                                <th>NETO</th>
                                <th>FEC. CONT.</th>
                                <th>NOM. RESP.</th>
                                <th>APE. RESP.</th>
                                <th>DETALLE PLAN</th>
                                <th>CAT. PLAN</th>
                                <th>TIPO PLAN.</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <button class="btn waves-effect waves-light teal darken-2 right modal-trigger" type="submit" name="action" href="#modal_agregar_contabilidad">
                        <b>AGREGAR</b>
                    </button>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">

    $('table.display').DataTable();

    $('#tabla_listado_egresos_mes').DataTable({
        scrollX: false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_egresos_mes",
            type: 'post'
        },
        "iDisplayLength": 3,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Egresos mensuales',
                messageTop: 'Desarrollado por Matías Montoya P.',
                filename: 'proyecto_php',
                extend: 'pdfHtml5',
                download: 'open',
                pageSize: 'letter',
                orientation: 'vertical',
                exportOptions: {
                    columns: [0, 1]
                },
                customize: function (doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.content[2].margin = [175, 0, 175, 0];
                }
            }
        ],
        "order": [[0, "asc"]],
        "columnDefs": [
            {targets: [1], "render": function (data, type, row, meta) {
                    return '$' + data;
                }
            }
        ]
    });

    $('#tabla_listado_ingresos_mes').DataTable({
        scrollX: false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_ingresos_mes",
            type: 'post'
        },
        "iDisplayLength": 3,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Ingresos mensuales',
                messageTop: 'Desarrollado por Matías Montoya P.',
                filename: 'proyecto_php',
                extend: 'pdfHtml5',
                download: 'open',
                pageSize: 'letter',
                orientation: 'vertical',
                exportOptions: {
                    columns: [0, 1]
                },
                customize: function (doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.content[2].margin = [175, 0, 175, 0];
                }
            }
        ],
        "order": [[0, "asc"]],
        "columnDefs": [
            {targets: [1], "render": function (data, type, row, meta) {
                    return '$' + data;
                }
            }
        ]
    });

    $('.validar_numero').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    total_ingresos();
    total_egresos();
    total_general();

    function total_general() {
        var ingresos = $("#total_ingresos").val().replace("$", "");
        var egresos = $("#total_egresos").val().replace("$", "");

        var total_ingreso_egreso = ingresos - egresos;
        $("#total_general").val("$" + total_ingreso_egreso);
    }

    function total_ingresos() {

        var url = base_url + "total_ingresos";

        $.getJSON(url, function (result) {
            $.each(result, function (i, o) {
                $("#total_ingresos").val("$" + o.total_ingresos);
                total_general();
            });
        });
    }

    function total_egresos() {

        var url = base_url + "total_egresos";

        $.getJSON(url, function (result) {
            $.each(result, function (i, o) {
                $("#total_egresos").val("$" + o.total_egresos);
                total_general();
            });
        });
    }

    sumar();

    function sumar() {

        var neto = 0;
        var iva = 0;
        var total = 0;

        $(".iva_total").each(function () {
            if (isNaN(parseFloat($(this).val()))) {
                neto += 0;
                iva += 0;
                total += 0;
            } else {
                neto += parseFloat($(this).val());
                iva += parseFloat($(this).val()) * 0.19;
                total += parseFloat($(this).val()) * 1.19;
            }

        });

        $("#iva_contabilidad").val(iva.toFixed(2));
        $("#total_contabilidad").val(total.toFixed(2));
    }

    $('#tabla_listado_contabilidad').DataTable({
        scrollX: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_contabilidad",
            type: 'post'
        },
        "iDisplayLength": 5,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Contabilidad',
                messageTop: 'Desarrollado por Matías Montoya P.',
                filename: 'proyecto_php',
                extend: 'pdfHtml5',
                download: 'open',
                pageSize: 'letter',
                orientation: 'landscape',
                customize: function (doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.content[2].margin = [50, 0, 50, 0];
                }
            }
        ],
        "order": [[0, "desc"]],
        "columnDefs": [
            {targets: [1], "render": function (data, type, row, meta) {
                    if (row[9] == "Activo") {
                        return '$' + data;
                    } else {
                        return '-$' + data;
                    }
                }
            },
            {targets: [2, 3], "render": function (data, type, row, meta) {
                    return '$' + data;
                }
            }
        ],
        "fnRowCallback": function (nRow, aData) {
            if (aData[9] == "Activo") {
                $('td', nRow).css('background-color', '#2e7d32');
                $('td', nRow).css('color', '#ffffff');
            } else if (aData[9] == "Pasivo") {
                $('td', nRow).css('background-color', '#c62828');
                $('td', nRow).css('color', '#ffffff');
            }
        }
    });

    activo_pasivo();

    function activo_pasivo() {

        var url = base_url + "select_activo_pasivo";

        $.getJSON(url, function (result) {
            $.each(result, function (i, o) {
                $("#activo_pasivo").append(new Option(o.nombre_activo_pasivo, o.id_activo_pasivo));
                $('select').material_select();
            });
        });
    }

    $("#activo_pasivo").on("change", function (e) {

        e.preventDefault();

        var activo_pasivo = $("#activo_pasivo").val();

        $.ajax({
            url: base_url + "select_activo_pasivo_categoria",
            type: 'post',
            dataType: 'json',
            data: {id_activo_pasivo: activo_pasivo},
            success: function (result) {
                $("#activo_pasivo_categoria").empty();
                $.each(result, function (i, o) {
                    $("#activo_pasivo_categoria").append(new Option(o.nombre_activo_pasivo_categoria, o.id_activo_pasivo_categoria));
                    $('select').material_select();
                });
            },
            error: function () {
                Materialize.toast("ERROR 500", "3000");
            }
        });
    });

    $("#activo_pasivo_categoria").on("change", function (e) {

        e.preventDefault();

        var activo_pasivo_categoria = $("#activo_pasivo_categoria").val();

        $.ajax({
            url: base_url + "select_activo_pasivo_detalle",
            type: 'post',
            dataType: 'json',
            data: {id_activo_pasivo_categoria: activo_pasivo_categoria},
            success: function (result) {
                $("#activo_pasivo_detalle").empty();
                $.each(result, function (i, o) {
                    $("#activo_pasivo_detalle").append(new Option(o.nombre_activo_pasivo_detalle, o.id_activo_pasivo_detalle));
                    $('select').material_select();
                });
            },
            error: function () {
                Materialize.toast("ERROR 500", "3000");
            }
        });
    });



    $("#boton_agregar_contabilidad").click(function (excepcion) {

        var rut_usuario = rut_usuario_php;
        var activo_pasivo = $("#activo_pasivo").val();
        var activo_pasivo_categoria = $("#activo_pasivo_categoria").val();
        var activo_pasivo_detalle = $("#activo_pasivo_detalle").val();
        var neto_contabilidad = $("#neto_contabilidad").val();
        var iva_contabilidad = $("#iva_contabilidad").val();
        var total_contabilidad = $("#total_contabilidad").val();

        if (activo_pasivo == null || activo_pasivo_categoria == null || activo_pasivo_detalle == null || neto_contabilidad == "" || iva_contabilidad == "" || total_contabilidad == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            $.ajax({
                url: base_url + 'insertar_contabilidad',
                type: 'post',
                dataType: 'json',
                data: {monto_contabilidad: neto_contabilidad, rut_usuario: rut_usuario, id_activo_pasivo_detalle: activo_pasivo_detalle,
                    iva_contabilidad: iva_contabilidad, total_contabilidad: total_contabilidad},
                success: function (resultado) {
                    if (resultado.mensaje === "0") {
                        Materialize.toast(resultado.mensaje, "3000");
                    } else {
                        Materialize.toast(resultado.mensaje, "3000");
                        $("#tabla_listado_contabilidad").DataTable().ajax.reload();
                        $("#tabla_listado_ingresos_mes").DataTable().ajax.reload();
                        $("#tabla_listado_egresos_mes").DataTable().ajax.reload();
                        $("#modal_agregar_contabilidad").modal('close');
                        total_general();
                        total_ingresos();
                        total_egresos();
                    }
                },
                error: function () {
                    Materialize.toast("ERROR 500", "3000");
                }
            });
        }
    });
</script>