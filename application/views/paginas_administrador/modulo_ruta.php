<main class="fondo_main">
    <!-- INICIO EDITAR RUTA -->
    <div id="modal_editar_ruta" class="modal">
        <div class="modal-content">
            <form id="formulario_editar_ruta">
                <div class="card-panel black-text texto-justificado borde_card_panel">
                    <h5 class="center-align black-text"><b>EDITAR REPARTIDOR</b></h5>
                    <div class="row">
                        <div class="col s12 black-text">
                            <input type="hidden" id="id_ruta_e"/>
                            <input type="hidden" id="rut_persona_ruta_e"/>
                            <small>REPARTIDOR ACTUAL:</small>
                            <input id="nombre_apellido_persona_e" readonly="true">
                            <div class="input-field">
                                <select id="rut_persona_ruta_editar">

                                </select>
                                <label>NUEVO REPARTIDOR:</label>
                            </div>
                        </div>
                        <button type="submit" id="boton_editar_ruta" class="waves-effect waves-light btn teal darken-2 right">EDITAR RUTA</button>
                        <br><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- FIN EDITAR RUTA -->
    <!-- INICIO AGREGAR RUTA -->
    <div id="modal_agregar_ruta" class="modal">
        <div class="modal-content">
            <div class="card-panel borde_card_panel grey lighten-5">
                <h5 class="center-align black-text"><b>AGREGAR RUTA</b></h5>
                <div class="input-field">
                    <select id="rut_persona_ruta_agregar">

                    </select>
                    <label>REPARTIDOR:</label>
                </div>
                <div class="input-field">
                    <select id="sector_ruta">
                        <option value="Oriente">Oriente</option>
                        <option value="Oriente">Poniente</option>
                        <option value="Oriente">Sur</option>
                        <option value="Oriente">Norte</option>
                    </select>
                    <label>SECTOR RUTA:</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">create</i>
                    <input id="destino_ruta" type="text" class="validate" maxlength="40">
                    <label for="destino_ruta">DESTINO RUTA:</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">create</i>
                    <input id="repetir_destino_ruta" type="text" class="validate" maxlength="40">
                    <label for="repetir_destino_ruta">REPETIR DESTINO RUTA:</label>
                </div>
                <div class="input-field center-align">
                    <button id="boton_agregar_ruta" type="submit" class="waves-effect waves-light btn-floating teal darken-2 pulse">
                        <i class="material-icons">add_location</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN AGREGAR RUTA -->
    <div class="container">
        <br>
        <div class="row">
            <div class="col s12 m10 l10 offset-m1 offset-l1">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>ADMINISTRACIÓN DE RUTAS</b></h5>
                    <table id="tabla_listado_ruta" class="centered bordered highlight nowrap cell-border table-striped">
                        <thead class="teal darken-2 white-text">
                            <tr>
                                <th>ID</th>
                                <th>RUT</th>
                                <th>NOM. REPART.</th>
                                <th>APE. REPART.</th>
                                <th>SECTOR</th>
                                <th>DESTINO</th>
                                <th>FECHA RUTA CREADA.</th>
                                <th>FECHA ÚLTIMA MODIF.</th>
                                <th>ESTADO RUTA</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <br>
                    <button class="btn waves-effect waves-light teal darken-2 right modal-trigger" type="submit" name="action" href="#modal_agregar_ruta">
                        <b>AGREGAR</b>
                    </button>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">

    select_repartidor_agregar();
    select_repartidor_editar();

    function select_repartidor_editar() {
        var url = base_url + "select_repartidor";

        $.getJSON(url, function (result) {
            $.each(result, function (i, o) {
                var val = o.nombre_persona + " " + o.apellido_persona;
                var rut_persona_oculto = o.rut_persona;
                $("#rut_persona_ruta_editar").append(new Option(val, rut_persona_oculto));
                $('select').material_select();
            });
        });
    }

    function select_repartidor_agregar() {
        var url = base_url + "select_repartidor";

        $.getJSON(url, function (result) {
            $.each(result, function (i, o) {
                var val = o.nombre_persona + " " + o.apellido_persona;
                var rut_persona_oculto = o.rut_persona;
                $("#rut_persona_ruta_agregar").append(new Option(val, rut_persona_oculto));
                $('select').material_select();
            });
        });
    }
    $('#tabla_listado_ruta').DataTable({
        scrollX: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_ruta",
            type: 'post'
        },
        "iDisplayLength": 3,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Listado de Rutas',
                messageTop: 'Desarrollado por Matías Montoya P.',
                filename: 'proyecto_php',
                extend: 'pdfHtml5',
                download: 'open',
                pageSize: 'letter',
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
            {targets: [8], "render": function (data, type, row, meta) {
                    if (data == "1") {
                        return '<button id="#" class="btn btn-floating waves-effect waves-light green" type="submit"><i class="material-icons">check_circle</i></button>';
                    } else {
                        return '<button id="boton_actualizar_estado_ruta" class="btn btn-floating waves-effect waves-light red" type="submit"><i class="material-icons">not_interested</i></button>';
                    }
                }
            },
            {targets: [9], "render": function (data, type, row, meta) {
                    if (row[8] == 1) {
                        return '<button id="boton_modal_editar_ruta" class="btn btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons">edit</i></button>';
                    } else {
                        return '<button id="#" class="btn btn-floating waves-effect waves-light blue disabled" type="submit"><i class="material-icons">edit</i></button>';
                    }
                }
            }
        ]
    });

    $("body").on("click", "#boton_actualizar_estado_ruta", function (e) {
        e.preventDefault();
        var id_ruta_tabla = $(this).parent().parent().children()[0];
        var id_ruta = $(id_ruta_tabla).text();

        $.ajax({
            url: base_url + "actualizar_estado_ruta",
            type: 'post',
            dataType: 'json',
            data: {id_ruta: id_ruta},
            success: function (o) {
                Materialize.toast(o.mensaje, "3000");
                $("#tabla_listado_ruta").DataTable().ajax.reload();
            },
            error: function () {
                Materialize.toast("ERROR 500", "3000");
            }
        });

    });


    $("body").on("click", "#boton_editar_ruta", function (e) {
        e.preventDefault();

        var id_ruta = $("#id_ruta_e").val();
        var rut_persona_ruta_e = $("#rut_persona_ruta_e").val();
        var rut_persona_ruta_select = $("#rut_persona_ruta_editar").val();

        if (rut_persona_ruta_e === rut_persona_ruta_select) {
            Materialize.toast("INGRESE UN REPARTIDOR DIFERENTE", "3000");
        } else {
            $.ajax({
                url: base_url + "editar_ruta",
                type: 'post',
                dataType: 'json',
                data: {id_ruta: id_ruta, rut_persona_ruta_actual: rut_persona_ruta_select},
                success: function (o) {
                    Materialize.toast(o.mensaje, "3000");
                    $("#tabla_listado_ruta").DataTable().ajax.reload();
                    $("#modal_editar_ruta").modal('close');
                },
                error: function () {
                    Materialize.toast("ERROR 500", "3000");
                }
            });
        }
    });

    $("body").on("click", "#boton_modal_editar_ruta", function (e) {
        e.preventDefault();

        var id_ruta = $(this).parent().parent().children()[0];
        var rut_persona_ruta = $(this).parent().parent().children()[1];
        var nombre_persona_e = $(this).parent().parent().children()[2];
        var apellido_persona_e = $(this).parent().parent().children()[3];

        $("#id_ruta_e").val($(id_ruta).text());
        $("#rut_persona_ruta_e").val($(rut_persona_ruta).text());
        $("#nombre_persona_e").val($(nombre_persona_e).text());
        $("#apellido_persona_e").val($(apellido_persona_e).text());

        $("#nombre_apellido_persona_e").val(($(nombre_persona_e).text()) + " " + $(apellido_persona_e).text());
        $("#modal_editar_ruta").modal('open');
    });

    $("#boton_agregar_ruta").click(function (excepcion) {
        excepcion.preventDefault();

        //REPARTIDOR
        var rut_persona_ruta = $("#rut_persona_ruta_agregar").val();
        //RUTA
        var sector_ruta = $("#sector_ruta").val();
        var destino_ruta = $("#destino_ruta").val();
        var repertir_destino_ruta = $("#repetir_destino_ruta").val();

        if (destino_ruta == "" || repertir_destino_ruta == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            if (destino_ruta === repertir_destino_ruta) {
                $.ajax({
                    url: base_url + 'insertar_ruta',
                    type: 'post',
                    dataType: 'json',
                    data: {rut_persona_ruta: rut_persona_ruta, sector_ruta: sector_ruta,
                        destino_ruta: destino_ruta},
                    success: function (resultado) {
                        if (resultado.mensaje === "0") {
                            Materialize.toast(resultado.mensaje, "3000");
                        } else {
                            Materialize.toast(resultado.mensaje, "3000");
                            $("#tabla_listado_ruta").DataTable().ajax.reload();
                            $("#modal_agregar_ruta").modal('close');
                        }
                    },
                    error: function () {
                        Materialize.toast("ERROR 500", "3000");
                    }
                });
            } else {
                Materialize.toast("DIRECCIONES NO IDENTICAS", "3000");
            }
        }
    });
</script>