<main class="fondo_main">
    <!-- INICIO EDITAR INSUMO -->
    <div id="modal_editar_insumo" class="modal">
        <div class="modal-content">
            <form id="formulario_editar_insumo">
                <div class="card-panel black-text texto-justificado borde_card_panel">
                    <h5 class="center-align black-text"><b>EDITAR USUARIO</b></h5>
                    <div class="row">
                        <div class="col s12 black-text">
                            <input type="hidden" id="id_insumo_e"/>
                            <input type="hidden" id="rut_usuario_e"/>
                            <p>STOCK DISPONIBLE:</p>
                            <input type="text" id="stock_insumo_e" maxlength="2" required="true" pattern="[0-9]+" readonly="true"/>
                            <p>COMPRA DE STOCK:</p>
                            <input type="text" id="compra_insumo_e" maxlength="2" required="true" pattern="[0-9]+" class="validate" value="0"/>
                            <p>GASTO DE STOCK:</p>
                            <input type="text" id="gasto_insumo_e" maxlength="2" required="true" pattern="[0-9]+" class="validate" value="0"/>
                            <button type="submit" id="boton_editar_insumo" class="waves-effect waves-light btn teal darken-2 right">EDITAR INSUMO</button>
                            <br><br>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- FIN EDITAR INSUMO -->
    <!-- INICIO AGREGAR INSUMO-->
    <div id="modal_agregar_insumo" class="modal">
        <div class="modal-content">
            <div class="card-panel borde_card_panel grey lighten-5">
                <h5 class="center-align black-text"><b>AGREGAR INSUMO</b></h5>
                <div class="input-field">
                    <select id="select_lista_insumo">

                    </select>
                    <label>DESCRIPCIÓN INSUMO:</label>
                </div>
                <div class="input-field">
                    <input id="inicial_insumo" type="text" class="inicial_insumo" maxlength="2" required="true" pattern="[0-9]+">
                    <label for="inicial_insumo">TOTAL UNIDADES:</label>
                </div>
                <div class="input-field center-align">
                    <button id="boton_agregar_contabilidad" type="submit" class="waves-effect waves-light btn-floating teal darken-2 pulse">
                        <i class="material-icons">account_circle</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN AGREGAR INSUMO -->
    <div class="container">
        <br>
        <div class="row">
            <div class="col s12 m11 l11 offset-m1 offset-l1">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>ADMINISTRACIÓN DE INSUMOS</b></h5>
                    <table id="tabla_listado_insumo" class="centered bordered highlight nowrap cell-border table-striped">
                        <thead class="teal darken-2 white-text">
                            <tr>
                                <th>ID</th>
                                <th>FECHA REGISTRO</th>
                                <th>CANT. INICIAL</th>
                                <th>COMPRA(S)</th>
                                <th>GASTO(S).</th>
                                <th>STOCK</th>
                                <th>FECHA ACT.</th>
                                <th>NOM. INSUMO</th>
                                <th>RUT</th>
                                <th>NOMBRE COM.</th>
                                <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <br>
                    <button class="btn waves-effect waves-light teal darken-2 right modal-trigger" type="submit" name="action" href="#modal_agregar_insumo">
                        <b>AGREGAR</b>
                    </button>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">

    select_lista_insumo();

    function select_lista_insumo() {

        var url = base_url + "select_lista_insumo";

        $.getJSON(url, function (result) {
            $.each(result, function (i, o) {
                $("#select_lista_insumo").append(new Option(o.nombre_lista_insumo, o.id_lista_insumo));
                $('select').material_select();
            });
        });
    }

    $('#tabla_listado_insumo').DataTable({
        scrollX: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            url: base_url + "listado_insumo",
            type: 'post'
        },
        "iDisplayLength": 10,
        "bJQueryUI": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                title: 'Santa Ana S.A - Insumos',
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
                },
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            }
        ],
        "order": [[0, "desc"]],
        "fnRowCallback": function (nRow, aData) {
            if (aData[5] < 5) {
                $('td', nRow).css('background-color', '#c62828');
                $('td', nRow).css('color', '#ffffff');
            } else {
                if (aData[5] >= 10) {
                    $('td', nRow).css('background-color', '#2e7d32');
                    $('td', nRow).css('color', '#ffffff');
                } else {
                    if (aData[5] >= 5) {
                        $('td', nRow).css('background-color', '#ffc400');
                        $('td', nRow).css('color', '#ffffff');
                    }
                }
            }
        },
        "columnDefs": [
            {targets: [2], "render": function (data, type, row, meta) {
                    return data + " Ud(s)";
                }
            },
            {targets: [4], "render": function (data, type, row, meta) {
                    if (data == 0) {
                        return data;
                    } else {
                        return "-" + data;
                    }
                }
            }, {targets: [10],
                "defaultContent": '<button id="boton_modal_editar_insumo" class="btn btn-floating waves-effect waves-dark white" type="submit"><i class="material-icons black-text">mode_edit</i></button>'
            }
        ]
    });

    $("#boton_agregar_contabilidad").click(function (excepcion) {

        excepcion.preventDefault();
        var rut_usuario = rut_usuario_php;
        var id_lista_insumo = $("#select_lista_insumo").val();
        var inicial_insumo = $("#inicial_insumo").val();

        if (id_lista_insumo == "" || inicial_insumo == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            $.ajax({
                url: base_url + 'insertar_insumo',
                type: 'post',
                dataType: 'json',
                data: {rut_usuario: rut_usuario, id_lista_insumo: id_lista_insumo, inicial_insumo: inicial_insumo},
                success: function (resultado) {
                    if (resultado.mensaje === "0") {
                        Materialize.toast(resultado.mensaje, "3000");
                    } else {
                        Materialize.toast(resultado.mensaje, "3000");
                        $("#tabla_listado_insumo").DataTable().ajax.reload();
                        $("#modal_agregar_insumo").modal('close');
                    }
                },
                error: function () {
                    Materialize.toast("ERROR 500", "3000");
                }
            });
        }
    });

    $("body").on("click", "#boton_modal_editar_insumo", function (e) {
        e.preventDefault();

        var id_insumo = $(this).parent().parent().children()[0];
        var stock_insumo = $(this).parent().parent().children()[5];
        var rut_usuario = $(this).parent().parent().children()[8];

        $("#id_insumo_e").val($(id_insumo).text());
        $("#rut_usuario_e").val($(rut_usuario).text());
        $("#stock_insumo_e").val($(stock_insumo).text());

        $("#modal_editar_insumo").modal('open');
    });

    $("body").on("click", "#boton_editar_insumo", function (e) {
        e.preventDefault();

        var id_insumo = $("#id_insumo_e").val();
        var rut_usuario = $("#rut_usuario_e").val();
        var stock_insumo = $("#stock_insumo_e").val();
        var compra_insumo = $("#compra_insumo_e").val();
        var gasto_insumo = $("#gasto_insumo_e").val();

        if (stock_insumo == "" || compra_insumo == "" || gasto_insumo == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S)", "3000");
        } else {
            if (compra_insumo >= 0 && gasto_insumo >= 0) {
                if (stock_insumo >= gasto_insumo) {
                    $.ajax({
                        url: base_url + "editar_insumo",
                        type: 'post',
                        dataType: 'json',
                        data: {id_insumo: id_insumo, compra_insumo: compra_insumo, gasto_insumo: gasto_insumo, stock_insumo: stock_insumo, rut_usuario: rut_usuario},
                        success: function (o) {
                            Materialize.toast(o.mensaje, "3000");
                            $("#tabla_listado_insumo").DataTable().ajax.reload();
                            $("#modal_editar_insumo").modal('close');
                        },
                        error: function () {
                            Materialize.toast("ERROR 500", "3000");
                        }
                    });

                } else {
                    Materialize.toast("STOCK INSUFICIENTE PARA GASTO(S)", "3000");
                }
            } else {
                Materialize.toast("INGRESE VALORES MAYORES O IGUALES QUE 0)", "3000");
            }
        }
    });
</script>