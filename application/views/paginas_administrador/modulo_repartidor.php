<main class="fondo_main">
    <!-- INICIO EDITAR REPARTIDOR -->
    <div id="modal_editar_repartidor" class="modal">
        <div class="modal-content">
            <form id="formulario_editar_usuario">
                <div class="card-panel black-text texto-justificado borde_card_panel">
                    <h5 class="center-align black-text"><b>EDITAR REPARTIDOR</b></h5>
                    <div class="row">
                        <div class="col s12 black-text">
                            <input type="hidden" id="rut_usuario_e"/>
                            <p>TELEFONO:</p>
                            <input type="text" id="telefono_usuario_e" maxlength="9" required="true" pattern="[0-9]+" class="validate validar_numero"/>
                            <p>EMAIL:</p>
                            <input type="text" id="correo_usuario_e" maxlength="45" required="true" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" class="validate"/>
                            <p>DIRECCION:</p>
                            <input type="text" id="direccion_usuario_e" maxlength="45" class="validate"/>
                            <div class="input-field">
                                <select id="licencia_repartidor_e">
                                    <option>Clase B</option>
                                    <option>Clase A1</option>
                                    <option>Clase A2</option>
                                </select>
                                <label>LICENCIA:</label>
                            </div>
                            <div class="input-field">
                                <select id="estado_licencia_repartidor_e">
                                    <option>Al día</option>
                                    <option>Caducada</option>
                                </select>
                                <label>ESTADO LICENCIA:</label>
                            </div>
                            <div class="input-field">
                                <select id="estado_repartidor_e">
                                    <option value="1">Vinculado</option>
                                    <option value="0">Desvinculado</option>
                                </select>
                                <label>ESTADO REPARTIDOR:</label>
                            </div>
                        </div>
                        <button type="submit" id="boton_editar_repartidor" class="waves-effect waves-light btn teal darken-2 right">EDITAR REPARTIDOR</button>
                        <br><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- FIN EDITAR REPARTIDOR -->
    <!-- INICIO AGREGAR REPARTIDOR -->
    <div id="modal_agregar_repartidor" class="modal">
        <div class="modal-content">
            <div class="card-panel borde_card_panel grey lighten-5">
                <h5 class="center-align black-text"><b>AGREGAR REPARTIDOR</b></h5>
                <div class="input-field">
                    <i class="material-icons prefix">create</i>
                    <input id="rut_usuario" type="text" class="validate" placeholder="19390359-2" maxlength="15">
                    <label for="rut_usuario">RUT:</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">create</i>
                    <input id="nombre_persona" type="text" class="validate" placeholder="Matias Ignacio" maxlength="30" required="true" pattern="[a-zA-Z ]+">
                    <label for="nombre_persona">NOMBRE COMPLETO:</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">create</i>
                    <input id="apellido_persona" type="text" class="validate" placeholder="Montoya Poblete" maxlength="30" required="true" pattern="[a-zA-Z ]+">
                    <label for="apellido_persona">APELLIDO COMPLETO:</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">phone</i>
                    <input id="telefono_persona" type="text" class="validate validar_numero" placeholder="983006194" maxlength="9" required="true" pattern="[0-9]+">
                    <label for="telefono_persona">TELEFÓNO:</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">mail</i>
                    <input id="correo_persona" type="text" class="validate" placeholder="matias.montoya.poblete@gmail.com" maxlength="45" required="true" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$">
                    <label for="correo_persona">CORREO:</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">create</i>
                    <input id="direccion_persona" type="text" class="validate" placeholder="28 Oriente, 7 Sur #678" maxlength="45">
                    <label for="direccion_persona">DOMICILIO:</label>
                </div>
                <div class="input-field">
                    <select id="licencia_repartidor">
                        <option>Clase B</option>
                        <option>Clase A1</option>
                        <option>Clase A2</option>
                    </select>
                    <label>LICENCIA:</label>
                </div>
                <div class="input-field">
                    <select id="estado_licencia_repartidor">
                        <option>Al día</option>
                        <option>Caducada</option>
                    </select>
                    <label>ESTADO LICENCIA:</label>
                </div>
                <div class="input-field">
                    <select id="estado_repartidor">
                        <option value="1">Vinculado</option>
                        <option value="0">Desvinculado</option>
                    </select>
                    <label>ESTADO REPARTIDOR:</label>
                </div>
                <div class="input-field center-align">
                    <button id="boton_agregar_repartidor" type="submit" class="waves-effect waves-light btn-floating teal darken-2 pulse">
                        <i class="material-icons">account_circle</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN AGREGAR REPARTIDOR -->
    <div class="container">
        <br>
        <div class="row">
            <div class="col s12 m10 l10 offset-m1 offset-l1">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>ADMINISTRACIÓN DE REPARTIDORES</b></h5>
                    <table id="tabla_listado_repartidor" class="centered bordered highlight nowrap cell-border table-striped">
                        <thead class="teal darken-2 white-text">
                            <tr>
                                <th>RUT</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>TELEFÓNO</th>
                                <th>CORREO</th>
                                <th>DIRECCIÓN</th>
                                <th>LICENCIA</th>
                                <th>ESTADO LICENCIA</th>
                                <th>ESTADO REPARTIDOR</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <br>
                    <button class="btn waves-effect waves-light teal darken-2 right modal-trigger" type="submit" name="action" href="#modal_agregar_repartidor">
                        <b>AGREGAR</b>
                    </button>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">

    $('.validar_numero').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    function validar_correo(correo) {

        var validacion = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

        if (validacion.test(correo)) {
            return true;
        } else {
            return false;
        }
    }


    $('#tabla_listado_repartidor').DataTable({
        scrollX: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_repartidor",
            type: 'post'
        },
        "iDisplayLength": 5,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Listado de Repartidores',
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
            {targets: [9],
                "defaultContent": '<button id="boton_modal_editar_repartidor" class="btn btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons">edit</i></button>'
            },
            {targets: [8], "render": function (data, type, row, meta) {
                    if (data == "1") {
                        return 'Vinculado';
                    } else {
                        return 'Desvinculado';
                    }
                }
            }
        ]
    });

    $("body").on("click", "#boton_editar_repartidor", function (e) {
        e.preventDefault();

        var rut_persona = $("#rut_usuario_e").val();
        var telefono_persona = $("#telefono_usuario_e").val();
        var correo_persona = $("#correo_usuario_e").val();
        var direccion_persona = $("#direccion_usuario_e").val();
        var licencia_repartidor = $("#licencia_repartidor_e").val();
        var estado_licencia_repartidor = $("#estado_licencia_repartidor_e").val();
        var estado_repartidor = $("#estado_repartidor_e").val();
        var estado_trabajador = 1;

        if (telefono_persona == "" || correo_persona == "" || direccion_persona == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S)", "3000");
        } else {
            if (validar_correo(correo_persona)) {
                $.ajax({
                    url: base_url + "editar_trabajador",
                    type: 'post',
                    dataType: 'json',
                    data: {rut_persona: rut_persona, telefono_persona: telefono_persona, correo_persona: correo_persona, direccion_persona: direccion_persona, licencia_repartidor: licencia_repartidor, estado_licencia_repartidor: estado_licencia_repartidor, estado_repartidor: estado_repartidor, estado_trabajador: estado_trabajador},
                    success: function (o) {
                        Materialize.toast(o.mensaje, "3000");
                        $("#tabla_listado_repartidor").DataTable().ajax.reload();
                        $("#modal_editar_repartidor").modal('close');
                    },
                    error: function () {
                        Materialize.toast("ERROR 500", "3000");
                    }
                });
            } else {
                Materialize.toast("CORREO NO VALIDO", "3000");
            }
        }
    });

    $("body").on("click", "#boton_modal_editar_repartidor", function (e) {
        e.preventDefault();

        var rut_usuario = $(this).parent().parent().children()[0];
        var telefono_usuario = $(this).parent().parent().children()[3];
        var correo_usuario = $(this).parent().parent().children()[4];
        var direccion_usuario = $(this).parent().parent().children()[5];

        $("#rut_usuario_e").val($(rut_usuario).text());
        $("#correo_usuario_e").val($(correo_usuario).text());
        $("#telefono_usuario_e").val($(telefono_usuario).text());
        $("#direccion_usuario_e").val($(direccion_usuario).text());

        $("#modal_editar_repartidor").modal('open');
    });

    $("#boton_agregar_repartidor").click(function (excepcion) {
        excepcion.preventDefault();
        //VALIDA RUT
        var Fn = {
            validaRut: function (rutCompleto) {
                rutCompleto = rutCompleto.replace("‐", "-");
                if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
                    return false;
                var tmp = rutCompleto.split('-');
                var digv = tmp[1];
                var rut = tmp[0];
                if (digv == 'K')
                    digv = 'k';

                return (Fn.dv(rut) == digv);
            },
            dv: function (T) {
                var M = 0, S = 1;
                for (; T; T = Math.floor(T / 10))
                    S = (S + T % 10 * (9 - M++ % 6)) % 11;
                return S ? S - 1 : 'k';
            }
        };

        //PERSONA
        var rut_usuario = $("#rut_usuario").val();
        var nombre_persona = $("#nombre_persona").val();
        var apellido_persona = $("#apellido_persona").val();
        var telefono_persona = $("#telefono_persona").val();
        var correo_persona = $("#correo_persona").val();
        var direccion_persona = $("#direccion_persona").val();
        //REPARTIDOR
        var licencia_repartidor = $("#licencia_repartidor").val();
        var estado_licencia_repartidor = $("#estado_licencia_repartidor").val();
        var estado_repartidor = $("#estado_repartidor").val();



        if (rut_usuario == "" || nombre_persona == "" || apellido_persona == "" || telefono_persona == "" || correo_persona == "" || direccion_persona == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            if (Fn.validaRut(rut_usuario)) {
                if (validar_correo(correo_persona)) {
                    $.ajax({
                        url: base_url + 'insertar_repartidor',
                        type: 'post',
                        dataType: 'json',
                        data: {rut_usuario: rut_usuario, nombre_persona: nombre_persona,
                            apellido_persona: apellido_persona, telefono_persona: telefono_persona, correo_persona: correo_persona,
                            direccion_persona: direccion_persona, licencia_repartidor: licencia_repartidor, estado_licencia_repartidor: estado_licencia_repartidor, estado_repartidor: estado_repartidor},
                        success: function (resultado) {
                            if (resultado.mensaje === "0") {
                                Materialize.toast(resultado.mensaje, "3000");
                            } else {
                                Materialize.toast(resultado.mensaje, "3000");
                                $("#tabla_listado_repartidor").DataTable().ajax.reload();
                                $("#modal_agregar_repartidor").modal('close');
                            }
                        },
                        error: function () {
                            Materialize.toast("ERROR 500", "3000");
                        }
                    });
                } else {
                    Materialize.toast("CORREO NO VALIDO", "3000");
                }
            } else {
                Materialize.toast("EL RUT INGRESADO NO ES VÁLIDO.", "3000");
            }
        }
    });
</script>