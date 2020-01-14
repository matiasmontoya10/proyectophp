<main class="fondo_main">
    <div id="modal_comentario" class="modal">
        <div class="modal-content">
            <div class="card-panel borde_card_panel grey lighten-5">
                <h5 class="center"><b>COMENTARIO DE MENSAJE</b></h5>
                <div class="input-field">
                    <input id="id_mensaje" type="text" readonly="true" placeholder="">
                    <label for="id_mensaje">ID DE MENSAJE:</label>
                </div>
                <div class="input-field">
                    <textarea id="comentario_mensaje" class="materialize-textarea" readonly="true" placeholder=""></textarea>
                    <label for="comentario_mensaje">COMENTARIO:</label>
                </div>
            </div>
        </div>
    </div>
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
                        <i class="material-icons">add</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN AGREGAR MENSAJE -->
    <div class="container">
        <br>
        <div class="row">
            <div class="col s12 m10 l10 offset-m1 offset-l1">
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
                                                <th>ELIMINAR</th>
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
                                                <th>ELIMINAR</th>
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
        "iDisplayLength": 3,
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
                    doc.content[2].margin = [80, 0, 80, 0];
                },
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6]
                }
            }
        ],
        "order": [[0, "desc"]],
        "columnDefs": [
            {targets: [5], "render": function (data, type, row, meta) {
                    return '<button id="boton_comentario_mensaje" class="btn btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons">drafts</i></button>';
                }
            },
            {targets: [7],
                "defaultContent": '<button id="boton_eliminar_mensaje" class="btn btn-floating waves-effect waves-light red" type="submit"><i class="material-icons">delete</i></button>'
            }
        ]
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
        "iDisplayLength": 3,
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
                    doc.content[2].margin = [80, 0, 80, 0];
                },
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6]
                }
            }
        ],
        "order": [[0, "desc"]],
        "columnDefs": [
            {targets: [5], "render": function (data, type, row, meta) {
                    return '<button id="boton_comentario_mensaje" class="btn btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons">drafts</i></button>';
                }
            },
            {targets: [7],
                "defaultContent": '<button id="boton_eliminar_mensaje" class="btn btn-floating waves-effect waves-light red" type="submit"><i class="material-icons">delete</i></button>'
            }
        ]
    });

    $("body").on("click", "#boton_comentario_mensaje", function (e) {
        e.preventDefault();
        var id_mensaje = $(this).parent().parent().children()[0];
        var mensaje = $(id_mensaje).text();
        $.ajax({
            url: base_url + "comentario_mensaje",
            type: 'post',
            dataType: 'json',
            data: {id_mensaje: mensaje},
            success: function (result) {
                $.each(result, function (i, o) {
                    $("#id_mensaje").val(o.id_mensaje);
                    $("#comentario_mensaje").val(o.descripcion_mensaje);
                    $("#modal_comentario").modal('open');
                });
            },
            error: function () {
                Materialize.toast("ERROR 500", "3000");
            }
        });
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
                        $("#tabla_listado_mensaje_entrada").DataTable().ajax.reload();
                        $("#tabla_listado_mensaje_salida").DataTable().ajax.reload();
                    }
                },
                error: function () {
                    Materialize.toast("ERROR 500", "3000");
                }
            });
        }
    });

    $("body").on("click", "#boton_eliminar_mensaje", function (e) {
        e.preventDefault();
        var id_mensaje = $(this).parent().parent().children()[0];
        $.ajax({
            url: base_url + 'eliminar_mensaje',
            type: 'post',
            dataType: 'json',
            data: {id_mensaje: $(id_mensaje).text()},
            success: function (resultado) {
                Materialize.toast(resultado.mensaje, "3000");
                $("#tabla_listado_mensaje_entrada").DataTable().ajax.reload();
                $("#tabla_listado_mensaje_salida").DataTable().ajax.reload();
            },
            error: function () {
                Materialize.toast("ERROR 500", "4000");
            }
        });
    });
</script>