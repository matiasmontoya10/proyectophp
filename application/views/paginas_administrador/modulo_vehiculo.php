<main class="fondo_main">
    <!-- INICIO AGREGAR REPARTIDOR VEHICULO -->
    <div id="modal_agregar_repartidor_vehiculo" class="modal">
        <div class="modal-content">
            <div class="card-panel borde_card_panel grey lighten-5">
                <h5 class="center-align black-text"><b>AGREGAR REPARTIDOR VEHÍCULO</b></h5>
                <div class="input-field">
                    <select id="rut_persona_intermedia">

                    </select>
                    <label>REPARTIDOR:</label>
                </div>
                <div class="input-field">
                    <select id="patente_vehiculo_intermedia">

                    </select>
                    <label>VEHÍCULO:</label>
                </div>
                <div class="input-field center-align">
                    <button id="boton_agregar_repartidor_vehiculo" type="submit" class="waves-effect waves-light btn-floating teal darken-2 pulse">
                        <i class="material-icons">account_circle</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN AGREGAR VEHÍCULO -->


    <!-- INICIO EDITAR VEHÍCULO -->
    <div id="modal_editar_vehiculo" class="modal">
        <div class="modal-content">
            <form id="formulario_editar_vehiculo">
                <div class="card-panel black-text texto-justificado borde_card_panel">
                    <h5 class="center-align black-text"><b>EDITAR VEHÍCULO</b></h5>
                    <div class="row">
                        <div class="col s12 black-text">
                            <input type="hidden" id="patente_vehiculo_e"/>
                            <small class="grey-text">FECHA REVISIÓN TÉCNICA VEHÍCULO:</small>
                            <input type="text" id="fecha_revision_tecnica_vehiculo_e" class="datepicker"/>
                            <div class="input-field">
                                <select id="estado_vehiculo_e">
                                    <option value="1">Disponible</option>
                                    <option value="0">No Disponible</option>
                                </select>
                                <label>ESTADO VEHÍCULO:</label>
                            </div>
                        </div>
                        <button type="submit" id="boton_editar_vehiculo" class="waves-effect waves-light btn teal darken-2 right">EDITAR VEHÍCULO</button>
                        <br><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- FIN EDITAR USUARIO -->
    <!-- INICIO AGREGAR PANADERO -->
    <div id="modal_agregar_vehiculo" class="modal">
        <div class="modal-content">
            <div class="card-panel borde_card_panel grey lighten-5">
                <h5 class="center-align black-text"><b>AGREGAR VEHÍCULO</b></h5>
                <div class="input-field">
                    <input id="patente_vehiculo" type="text" class="validate" placeholder="DZ-SH-37" maxlength="8">
                    <label for="patente_vehiculo">PATENTE VEHÍCULO:</label>
                </div>
                <div class="input-field">
                    <select id="marca_vehiculo">
                        <option>Opel</option>
                        <option>Citroen</option>
                        <option>Pegueot</option>
                    </select>
                    <label>MARCA VEHÍCULO:</label>
                </div>
                <div class="input-field">
                    <input id="modelo_vehiculo" type="text" class="validate" placeholder="C-13" maxlength="10" required="true">
                    <label for="modelo_vehiculo">MODELO VEHÍCULO:</label>
                </div>
                <div class="input-field">
                    <select id="ano_vehiculo">
                        <?php
                        for ($i = 2019; $i >= 1990; $i--) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }
                        ?>
                    </select>
                    <label>AÑO VEHÍCULO:</label>
                </div>
                <div class="input-field">
                    <input id="fecha_revision_tecnica_vehiculo" type="text" class="datepicker">
                    <label for="fecha_revision_tecnica_vehiculo">FECHA REVISIÓN TÉCNICA VEHÍCULO:</label>
                </div>
                <div class="input-field">
                    <select id="estado_vehiculo">
                        <option value="1">Disponible</option>
                        <option value="0">No Disponible</option>
                    </select>
                    <label>ESTADO VEHÍCULO:</label>
                </div>
                <div class="input-field center-align">
                    <button id="boton_agregar_vehiculo" type="submit" class="waves-effect waves-light btn-floating teal darken-2 pulse">
                        <i class="material-icons">account_circle</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN AGREGAR VEHÍCULO -->
    <div class="container">
        <br>
        <div class="row">
            <div class="col s12 m12 l6">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>ADMINISTRACIÓN DE VEHÍCULOS</b></h5>
                    <table id="tabla_listado_vehiculo" class="centered bordered highlight nowrap cell-border table-striped">
                        <thead class="teal darken-2 white-text">
                            <tr>
                                <th>PATENTE</th>
                                <th>MARCA</th>
                                <th>MODELO</th>
                                <th>AÑO</th>
                                <th>REVISIÓN TÉC.</th>
                                <th>ESTADO VEHÍCULO</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <br>
                    <button class="btn waves-effect waves-light teal darken-2 right modal-trigger" type="submit" name="action" href="#modal_agregar_vehiculo">
                        <b>AGREGAR</b>
                    </button>
                    <br><br>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>VINCULAR REPARTIDOR / VEHÍCULO</b></h5>
                    <table id="tabla_listado_repartidor_vehiculo" class="centered bordered highlight nowrap cell-border table-striped">
                        <thead class="teal darken-2 white-text">
                            <tr>
                                <th>RUT PERS.</th>
                                <th>NOM. PERS.</th>
                                <th>APE. PERS.</th>
                                <th>PAT. VEH.</th>
                                <th>MODELO VEH.</th>
                                <th>MARCA VEH.</th>
                                <th>FECHA VIN. REPAR. VEH.</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <br>
                    <button class="btn waves-effect waves-light teal darken-2 right modal-trigger" type="submit" name="action" href="#modal_agregar_repartidor_vehiculo">
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

    $('#tabla_listado_repartidor_vehiculo').DataTable({
        scrollX: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_repartidor_vehiculo",
            type: 'post'
        },
        "iDisplayLength": 5,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Listado de Vehículos',
                messageTop: 'Desarrollado por Matías Montoya P.',
                filename: 'proyecto_php',
                extend: 'pdfHtml5',
                download: 'open',
                pageSize: 'letter',
                orientation: 'portrait',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                },
                customize: function (doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.content[2].margin = [100, 0, 100, 0];
                }
            }
        ],
        "order": [[0, "desc"]],
        "columnDefs": [
            {targets: [7],
                "defaultContent": '<button id="boton_eliminar_repartidor_vehiculo" class="btn btn-floating waves-effect waves-light red" type="submit"><i class="material-icons">delete</i></button>'
            }
        ]
    });

    $('#tabla_listado_vehiculo').DataTable({
        scrollX: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_vehiculo",
            type: 'post'
        },
        "iDisplayLength": 5,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Listado de Vehículos',
                messageTop: 'Desarrollado por Matías Montoya P.',
                filename: 'proyecto_php',
                extend: 'pdfHtml5',
                download: 'open',
                pageSize: 'letter',
                orientation: 'portrait',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
                customize: function (doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.content[2].margin = [100, 0, 100, 0];
                }
            }
        ],
        "order": [[0, "desc"]],
        "columnDefs": [
            {targets: [6],
                "defaultContent": '<button id="boton_modal_editar_vehiculo" class="btn btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons">edit</i></button>'
            },
            {targets: [5], "render": function (data, type, row, meta) {
                    if (data == "1") {
                        return 'Disponible';
                    } else {
                        return 'No Disponible';
                    }
                }
            }
        ]
    });

    $("body").on("click", "#boton_editar_vehiculo", function (e) {
        e.preventDefault();

        var patente_vehiculo = $("#patente_vehiculo_e").val();
        var fecha_revision_tecnica_vehiculo = $("#fecha_revision_tecnica_vehiculo_e").val();
        var estado_vehiculo = $("#estado_vehiculo_e").val();

        if (fecha_revision_tecnica_vehiculo == "" || estado_vehiculo == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S)", "3000");
        } else {
            $.ajax({
                url: base_url + "editar_vehiculo",
                type: 'post',
                dataType: 'json',
                data: {patente_vehiculo: patente_vehiculo, fecha_revision_tecnica_vehiculo: fecha_revision_tecnica_vehiculo, estado_vehiculo: estado_vehiculo},
                success: function (o) {
                    Materialize.toast(o.mensaje, "3000");
                    $("#tabla_listado_vehiculo").DataTable().ajax.reload();
                    $("#modal_editar_vehiculo").modal('close');
                },
                error: function () {
                    Materialize.toast("ERROR 500", "3000");
                }
            });
        }
    });

    $("body").on("click", "#boton_modal_editar_vehiculo", function (e) {
        e.preventDefault();

        var patente_vehiculo = $(this).parent().parent().children()[0];
        var fecha_revision_tecnica_vehiculo = $(this).parent().parent().children()[4];
        var estado_vehiculo = $(this).parent().parent().children()[5];


        $("#patente_vehiculo_e").val($(patente_vehiculo).text());
        $("#fecha_revision_tecnica_vehiculo_e").val($(fecha_revision_tecnica_vehiculo).text());
        $("#estado_vehiculo_e").val($(estado_vehiculo).text());

        $("#modal_editar_vehiculo").modal('open');
    });

    $("#boton_agregar_vehiculo").click(function (excepcion) {
        excepcion.preventDefault();

        //VEHICULO
        var patente_vehiculo = $("#patente_vehiculo").val();
        var modelo_vehiculo = $("#modelo_vehiculo").val();
        var marca_vehiculo = $("#marca_vehiculo").val();
        var ano_vehiculo = $("#ano_vehiculo").val();
        var fecha_revision_tecnica_vehiculo = $("#fecha_revision_tecnica_vehiculo").val();
        var estado_vehiculo = $("#estado_vehiculo").val();

        if (patente_vehiculo == "" || modelo_vehiculo == "" || marca_vehiculo == "" || ano_vehiculo == "" || fecha_revision_tecnica_vehiculo == "" || estado_vehiculo == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            $.ajax({
                url: base_url + 'insertar_vehiculo',
                type: 'post',
                dataType: 'json',
                data: {patente_vehiculo: patente_vehiculo, modelo_vehiculo: modelo_vehiculo,
                    marca_vehiculo: marca_vehiculo, ano_vehiculo: ano_vehiculo, fecha_revision_tecnica_vehiculo: fecha_revision_tecnica_vehiculo,
                    estado_vehiculo: estado_vehiculo},
                success: function (resultado) {
                    if (resultado.mensaje === "0") {
                        Materialize.toast(resultado.mensaje, "3000");
                    } else {
                        Materialize.toast(resultado.mensaje, "3000");
                        $("#tabla_listado_vehiculo").DataTable().ajax.reload();
                        $("#modal_agregar_vehiculo").modal('close');
                    }
                },
                error: function () {
                    Materialize.toast("ERROR 500", "3000");
                }
            });
        }
    });

    select_repartidor_agregar();
    patente_vehiculo();

    function select_repartidor_agregar() {
        var url = base_url + "select_repartidor";

        $.getJSON(url, function (result) {
            $.each(result, function (i, o) {
                var val = o.nombre_persona + " " + o.apellido_persona;
                var rut_persona_oculto = o.rut_persona;
                $("#rut_persona").append(new Option(val, rut_persona_oculto));
                $('select').material_select();
            });
        });
    }

    function patente_vehiculo() {
        var url = base_url + "select_patente_vehiculo";

        $.getJSON(url, function (result) {
            $.each(result, function (i, o) {
                var val = o.marca_vehiculo + " " + o.modelo_vehiculo;
                var patente_vehiculo = o.patente_vehiculo;
                $("#patente_vehiculo").append(new Option(val, patente_vehiculo));
                $('select').material_select();
            });
        });
    }

    $("#boton_agregar_repartidor_vehiculo").click(function (excepcion) {
        excepcion.preventDefault();

        //VEHICULO
        var patente_vehiculo = $("#patente_vehiculo_intermedia").val();
        //PERSONA
        var rut_persona = $("#rut_persona_intermedia").val();


        if ($("#rut_persona_intermedia").val() == null || $("#patente_vehiculo_intermedia").val() == null) {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            $.ajax({
                url: base_url + 'insertar_repartidor_vehiculo',
                type: 'post',
                dataType: 'json',
                data: {patente_vehiculo: patente_vehiculo, rut_persona: rut_persona},
                success: function (resultado) {
                    if (resultado.mensaje === "0") {
                        Materialize.toast(resultado.mensaje, "3000");
                    } else {
                        Materialize.toast(resultado.mensaje, "3000");
                        $("#tabla_listado_repartidor_vehiculo").DataTable().ajax.reload();
                        $("#modal_agregar_repartidor_vehiculo").modal('close');
                        select_rut_persona_intermedia();
                        select_vehiculo_intermedia();
                    }
                },
                error: function () {
                    Materialize.toast("ERROR 500", "3000");
                }
            });
        }
    });


    select_rut_persona_intermedia();

    function select_rut_persona_intermedia() {
        var url = base_url + "select_rut_persona_intermedia";
        $.getJSON(url, function (result) {
            $.each(result, function (i, o) {
                var val = o.nombre_persona + " " + o.apellido_persona;
                var rut_persona_oculto = o.rut_persona;
                $("#rut_persona_intermedia").append(new Option(val, rut_persona_oculto));
                $('select').material_select();
            });
        });
        $('#rut_persona_intermedia').empty();
    }

    select_vehiculo_intermedia();

    function select_vehiculo_intermedia() {
        var url = base_url + "select_patente_vehiculo_intermedia";
        $.getJSON(url, function (result) {
            $.each(result, function (i, o) {
                var val = o.marca_vehiculo + " " + o.modelo_vehiculo;
                var patente_vehiculo_oculto = o.patente_vehiculo;
                $("#patente_vehiculo_intermedia").append(new Option(val, patente_vehiculo_oculto));
                $('select').material_select();
            });
        });
        $('#patente_vehiculo_intermedia').empty();
    }

    $("body").on("click", "#boton_eliminar_repartidor_vehiculo", function (e) {
        e.preventDefault();
        var rut_persona = $(this).parent().parent().children()[0];
        var patente_vehiculo = $(this).parent().parent().children()[3];
        ;
        $.ajax({
            url: base_url + 'eliminar_repartidor_vehiculo',
            type: 'post',
            dataType: 'json',
            data: {rut_persona: $(rut_persona).text(), patente_vehiculo: $(patente_vehiculo).text()},
            success: function (resultado) {
                Materialize.toast(resultado.mensaje, "3000");
                $("#tabla_listado_repartidor_vehiculo").DataTable().ajax.reload();
                select_rut_persona_intermedia();
                select_vehiculo_intermedia();
            },
            error: function () {
                Materialize.toast("ERROR 500", "4000");
            }
        });
    });
</script>