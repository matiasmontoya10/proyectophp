<main class="fondo_main">
    <!-- INICIO EDITAR USUARIO -->
    <div id="modal_editar_usuario" class="modal">
        <div class="modal-content">
            <form id="formulario_editar_usuario">
                <div class="card-panel black-text texto-justificado borde_card_panel">
                    <h5 class="center-align black-text"><b>EDITAR USUARIO</b></h5>
                    <div class="row">
                        <div class="col s12 black-text">
                            <input type="hidden" id="rut_usuario_e"/>
                            <p>TELEFONO:</p>
                            <input type="text" id="telefono_usuario_e" maxlength="9" required="true" pattern="[0-9]+" class="validate"/>
                            <p>EMAIL:</p>
                            <input type="text" id="correo_usuario_e" maxlength="45" required="true" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" class="validate"/>
                            <p>DIRECCION:</p>
                            <input type="text" id="direccion_usuario_e" maxlength="45" class="validate"/>
                            <div class="input-field">
                                <select id="estado_usuario_e">
                                    <option value="1">ACTIVO</option>
                                    <option value="0">INACTIVO</option>
                                </select>
                                <label>ESTADO USUARIO:</label>
                            </div>
                        </div>
                        <button type="submit" id="boton_editar_usuario" class="waves-effect waves-light btn teal darken-2 right">EDITAR USUARIO</button>
                        <br><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- FIN EDITAR USUARIO -->
    <div class="container">
        <br>
        <div class="row">
            <div class="col s12 m11 l11 offset-l1 offset-m1">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>CARTERA DE CLIENTES - DESPACHADOR</b></h5>
                    <table id="tabla_listado_usuario" class="centered bordered highlight nowrap cell-border table-striped">
                        <thead class="teal darken-2 white-text">
                            <tr>
                                <th>RUT</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>TELEFÓNO</th>
                                <th>CORREO</th>
                                <th>DIRECCIÓN</th>
                                <th>PERFIL</th>
                                <th>ESTADO</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    $('#tabla_listado_usuario').DataTable({
        scrollX: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_cliente",
            type: 'post'
        },
        "iDisplayLength": 10,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Listado de Clientes',
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
                }
            }
        ],
        "order": [[0, "desc"]],
        "columnDefs": [
            {targets: [8],
                "defaultContent": '<button id="boton_modal_editar_usuario" class="btn btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons">edit</i></button>'
            },
            {targets: [7], "render": function (data, type, row, meta) {
                    if (data == "1") {
                        return 'Activo';
                    } else {
                        return 'Inactivo';
                    }
                }
            }
        ]
    });

    $("body").on("click", "#boton_editar_usuario", function (e) {
        e.preventDefault();

        var rut_persona = $("#rut_usuario_e").val();
        var telefono_persona = $("#telefono_usuario_e").val();
        var correo_persona = $("#correo_usuario_e").val();
        var direccion_persona = $("#direccion_usuario_e").val();
        var estado_usuario = $("#estado_usuario_e").val();

        if (correo_persona == "" || telefono_persona == "" || direccion_persona == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S)", "3000");
        } else {
            $.ajax({
                url: base_url + "editar_persona",
                type: 'post',
                dataType: 'json',
                data: {rut_persona: rut_persona, telefono_persona: telefono_persona, correo_persona: correo_persona, direccion_persona: direccion_persona, estado_usuario: estado_usuario},
                success: function (o) {
                    Materialize.toast(o.mensaje, "3000");
                    $("#tabla_listado_usuario").DataTable().ajax.reload();
                    $("#modal_editar_usuario").modal('close');
                },
                error: function () {
                    Materialize.toast("ERROR 500", "3000");
                }
            });
        }
    });

    $("body").on("click", "#boton_modal_editar_usuario", function (e) {
        e.preventDefault();

        var rut_usuario = $(this).parent().parent().children()[0];
        var telefono_usuario = $(this).parent().parent().children()[3];
        var correo_usuario = $(this).parent().parent().children()[4];
        var direccion_usuario = $(this).parent().parent().children()[5];


        $("#rut_usuario_e").val($(rut_usuario).text());
        $("#correo_usuario_e").val($(correo_usuario).text());
        $("#telefono_usuario_e").val($(telefono_usuario).text());
        $("#direccion_usuario_e").val($(direccion_usuario).text());

        $("#modal_editar_usuario").modal('open');
    });
</script>