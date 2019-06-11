<main class="fondo_main">
    <!-- INICIO AGREGAR MENSAJE -->
    <div id="modal_agregar_mensaje" class="modal">
        <div class="modal-content">
            <div class="card-panel borde_card_panel grey lighten-5">
                <h5 class="center-align black-text"><b>ENVIAR MENSAJE</b></h5>
                <div class="input-field">
                    <select id="select_usuario">

                    </select>
                    <label>SELECT USUARIOS:</label>

                </div>
                <div class="input-field">
                    <input id="titulo_mensaje" type="text" class="validate" maxlength="30" pattern="[a-zA-Z ]+">
                    <label for="titulo_mensaje">TÍTULO:</label>
                </div>
                <div class="input-field">
                    <textarea id="descripcion_mensaje" class="materialize-textarea validate" maxlength="250" pattern="[a-zA-Z ]+"></textarea>
                    <label for="descripcion_mensaje">DESCRIPCIÓN:</label>
                </div>
                <div class="input-field center-align">
                    <button id="boton_agregar_mensaje" type="submit" class="waves-effect waves-light btn-floating teal darken-2 pulse">
                        <i class="material-icons">account_circle</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN AGREGAR MENSAJE -->
    <div class="container">
        <br>
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>MENSAJERÍA</b></h5>
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">email</i>BUZÓN DE ENTRADA</div>
                            <div class="collapsible-body">
                                <ul>
                                    <table id="tabla_listado_mensaje_entrada" class="centered bordered highlight nowrap cell-border table-striped">
                                        <thead class="teal darken-2 white-text">
                                            <tr>
                                                <th>N°</th>
                                                <th>RUT RECEPTOR</th>
                                                <th>RUT EMISOR</th>
                                                <th>USUARIO RESPONSABLE DEL MENSAJE</th>
                                                <th>TITULO</th>
                                                <th>DESCRIPCION</th>
                                                <th>FECHA MENSAJE</th>
                                                <th>ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">reply</i>MENSAJES ENVIADOS</div>
                            <div class="collapsible-body">
                                <ul>
                                    <table id="tabla_listado_mensaje_salida" class="centered bordered highlight nowrap cell-border table-striped">
                                        <thead class="teal darken-2 white-text">
                                            <tr>
                                                <th>N°</th>
                                                <th>RUT EMISOR</th>
                                                <th>RUT RECEPTOR</th>
                                                <th>USUARIO QUE RECIBE EL MENSAJE</th>
                                                <th>TITULO</th>
                                                <th>DESCRIPCION</th>
                                                <th>FECHA MENSAJE</th>
                                                <th>ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <br>
                    <button class="btn waves-effect waves-light teal darken-2 right modal-trigger" type="submit" name="action" href="#modal_agregar_mensaje">
                        <b>AGREGAR</b>
                    </button>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">

    $('#tabla_listado_mensaje_entrada').DataTable({
        scrollX: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_mensaje_entrada",
            type: 'post',
            data: {rut_usuario: rut_usuario_php}
        },
        "iDisplayLength": 5,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Buzón de Mensajes',
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
        "order": [[0, "desc"]]
//        "columnDefs": [
//            {targets: [1], "render": function (data, type, row, meta) {
//                    if (row[9] == "Activo") {
//                        return '$' + data;
//                    } else {
//                        return '-$' + data;
//                    }
//                }
//            },
//            {targets: [2, 3], "render": function (data, type, row, meta) {
//                    return '$' + data;
//                }
//            }
//        ],
//        "fnRowCallback": function (nRow, aData) {
//            if (aData[9] == "Activo") {
//                $('td', nRow).css('background-color', '#2e7d32');
//                $('td', nRow).css('color', '#ffffff');
//            } else if (aData[9] == "Pasivo") {
//                $('td', nRow).css('background-color', '#c62828');
//                $('td', nRow).css('color', '#ffffff');
//            }
//        }
    });

$('#tabla_listado_mensaje_salida').DataTable({
        scrollX: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_mensaje_salida",
            type: 'post',
            data: {rut_usuario: rut_usuario_php}
        },
        "iDisplayLength": 5,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Mensajes Enviados',
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
        "order": [[0, "desc"]]
//        "columnDefs": [
//            {targets: [1], "render": function (data, type, row, meta) {
//                    if (row[9] == "Activo") {
//                        return '$' + data;
//                    } else {
//                        return '-$' + data;
//                    }
//                }
//            },
//            {targets: [2, 3], "render": function (data, type, row, meta) {
//                    return '$' + data;
//                }
//            }
//        ],
//        "fnRowCallback": function (nRow, aData) {
//            if (aData[9] == "Activo") {
//                $('td', nRow).css('background-color', '#2e7d32');
//                $('td', nRow).css('color', '#ffffff');
//            } else if (aData[9] == "Pasivo") {
//                $('td', nRow).css('background-color', '#c62828');
//                $('td', nRow).css('color', '#ffffff');
//            }
//        }
    });

    select_usuario();

    function select_usuario() {

        var rut_usuario = rut_usuario_php;

        $.ajax({
            url: base_url + "select_usuario",
            type: 'post',
            dataType: 'json',
            data: {rut_usuario: rut_usuario},
            success: function (result) {
                $.each(result, function (i, o) {
                    var val = o.nombre_persona + " " + o.apellido_persona;
                    var rut_usuario_oculto = o.rut_usuario;
                    $("#select_usuario").append(new Option(val, rut_usuario_oculto));
                    $('select').material_select();
                });
            },
            error: function () {
                Materialize.toast("ERROR 500", "3000");
            }
        });
    }

    $("body").on("click", "#boton_editar_panadero", function (e) {
        e.preventDefault();

        var rut_persona = $("#rut_usuario_e").val();
        var telefono_persona = $("#telefono_usuario_e").val();
        var correo_persona = $("#correo_usuario_e").val();
        var direccion_persona = $("#direccion_usuario_e").val();
        var tipo_panadero = $("#tipo_panadero_e").val();
        var jornada_panadaero = $("#jornada_panadero_e").val();
        var estado_panadero = $("#estado_panadero_e").val();
        var estado_trabajador = 0;

        if (telefono_persona == "" || correo_persona == "" || direccion_persona == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S)", "3000");
        } else {
            $.ajax({
                url: base_url + "editar_trabajador",
                type: 'post',
                dataType: 'json',
                data: {rut_persona: rut_persona, telefono_persona: telefono_persona, correo_persona: correo_persona, direccion_persona: direccion_persona, tipo_panadero: tipo_panadero, jornada_panadero: jornada_panadaero, estado_panadero: estado_panadero, estado_trabajador: estado_trabajador},
                success: function (o) {
                    Materialize.toast(o.mensaje, "3000");
                    $("#tabla_listado_panadero").DataTable().ajax.reload();
                    $("#modal_editar_panadero").modal('close');
                },
                error: function () {
                    Materialize.toast("ERROR 500", "3000");
                }
            });
        }
    });

    $("body").on("click", "#boton_modal_editar_panadero", function (e) {
        e.preventDefault();

        var rut_usuario = $(this).parent().parent().children()[0];
        var telefono_usuario = $(this).parent().parent().children()[3];
        var correo_usuario = $(this).parent().parent().children()[4];
        var direccion_usuario = $(this).parent().parent().children()[5];


        $("#rut_usuario_e").val($(rut_usuario).text());
        $("#correo_usuario_e").val($(correo_usuario).text());
        $("#telefono_usuario_e").val($(telefono_usuario).text());
        $("#direccion_usuario_e").val($(direccion_usuario).text());

        $("#modal_editar_panadero").modal('open');
    });

    $("#boton_agregar_mensaje").click(function (excepcion) {

        excepcion.preventDefault();

        var rut_usuario = rut_usuario_php;
        var select_usuario = $("#select_usuario").val();
        var titulo_mensaje = $("#titulo_mensaje").val();
        var descripcion_mensaje = $("#descripcion_mensaje").val();

        if (rut_usuario == "" || select_usuario == "" || titulo_mensaje == "" || descripcion_mensaje == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            $.ajax({
                url: base_url + 'insertar_mensaje',
                type: 'post',
                dataType: 'json',
                data: {rut_usuario: rut_usuario, select_usuario: select_usuario,
                    titulo_mensaje: titulo_mensaje, descripcion_mensaje: descripcion_mensaje},
                success: function (resultado) {
                    if (resultado.mensaje === "0") {
                        Materialize.toast(resultado.mensaje, "3000");
                    } else {
                        Materialize.toast(resultado.mensaje, "3000");
                        $("#modal_agregar_mensaje").modal('close');
                    }
                },
                error: function () {
                    Materialize.toast("ERROR 500", "3000");
                }
            });
        }
    });
</script>