$(document).ready(function () {
    //VALIDACION DE CORREO

    function validar_correo(correo) {

        var validacion = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

        if (validacion.test(correo)) {
            return true;
        } else {
            return false;
        }
    }

    //JavaScript Materialize. Desarrollado por Matías Montoya.
    $(".button-collapse").sideNav();
    $(".slider").slider();
    $('.modal').modal();
    $('select').material_select();
    $('.collapsible').collapsible();

    //Date Picker.
    $('.datepicker').pickadate({
        //Format
        format: 'yyyy/mm/dd',
        // The title label to use for the month nav buttons
        labelMonthNext: 'Mes siguiente',
        labelMonthPrev: 'Mes anterior',
        // The title label to use for the dropdown selectors
        labelMonthSelect: 'Selecciona un mes',
        labelYearSelect: 'Selecciona un año',
        // Months and weekdays
        monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        // Materialize modified
        weekdaysLetter: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        // Today and clear
        today: 'HOY',
        clear: 'LIMPIAR',
        close: 'CERRAR',
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 5, // Creates a dropdown of 15 years to control year,
        closeOnSelect: false // Close upon selecting a date,
    });

    //Funciones de la plataforma web.
    var base_url = "http://localhost/proyecto_php/";

    //_FUNCION QUE VALIDA UN RUT CON SU CADENA COMPLETA EJ: "19576832-2".
    var Fn = {
        validaRut: function (rut_completo) {
            //RECIBE UN RUT Y REEMPLAZA LOS CARACTERES.
            rut_completo = rut_completo.replace("‐", "-");
            //DETERMINA LA CODIFICACION DE QUE SI EL RUT QUE RECIBE NO ES VALIDO
            //, YA QUE TIENE UN SIGNO DE EXCLAMACION.
            if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rut_completo))
                return false;
            var tmp = rut_completo.split('-');
            var digv = tmp[1];
            var rut = tmp[0];
            if (digv == 'K')
                digv = 'k';
            //RETORNA UN RUT VALIDO.
            return (Fn.dv(rut) == digv);

        },
        //CODIFICACION QUE CALCULA EL DIGITO VERFICACADOR CONVIRTIENDO LA LETRA "K" EN 1.
        dv: function (T) {
            var M = 0, S = 1;
            for (; T; T = Math.floor(T / 10))
                S = (S + T % 10 * (9 - M++ % 6)) % 11;
            return S ? S - 1 : 'k';
        }
    };

    $("#boton_iniciar_sesion").click(function (excepcion) {
        //CAPTURAR LOS DATOS DE LA PAGINA INICIAR SESION
        excepcion.preventDefault();
        var rut_usuario = $("#rut_usuario").val();
        var clave_usuario = $("#clave_usuario").val();
        //VALIDACION DE CAMPOS VACIOS
        if (rut_usuario == "" || clave_usuario == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            //DETERMINA SI EL RUT ES CORRECTO MEDIANTE LA FUNCION DE VALIDACION DE RUT
            if (Fn.validaRut(rut_usuario)) {
                $.ajax({
                    url: base_url + 'iniciar_sesion',
                    type: 'post',
                    dataType: 'json',
                    //ENVIA LOS DATOS AL CONTROLADOR
                    data: {rut_usuario: rut_usuario, clave_usuario: clave_usuario},
                    success: function (resultado) {
                        if (resultado.mensaje === "0") {
                            Materialize.toast("CREDENCIAL INCORRECTA / INACTIVA.", "3000");
                        } else {
                            Materialize.toast("BIENVENIDO.", "3000");
                            //CREACION DE SESION Y REDIRECCION AL MENU PRINCIPAL DE LA PAGINA DEL USUARIO (ADMINISTRADOR,
                            //DESPACHADOR O CLIENTE.
                            window.location.href = base_url + resultado.mensaje;
                        }
                    },
                    error: function () {
                        Materialize.toast("ERROR 500.", "3000");
                    }
                });
            } else {
                Materialize.toast("EL RUT INGRESADO NO ES VÁLIDO.", "3000");
            }
        }
    });

    $("#boton_registrar").click(function (excepcion) {
        excepcion.preventDefault();

        var rut_usuario = $("#rut_usuario").val();
        var clave_usuario = $("#clave_usuario").val();
        var clave_usuario_repetir = $("#clave_usuario_repetir").val();
        var nombre_persona = $("#nombre_persona").val();
        var apellido_persona = $("#apellido_persona").val();
        var telefono_persona = $("#telefono_persona").val();
        var correo_persona = $("#correo_persona").val();
        var direccion_persona = $("#direccion_persona").val();
        var id_perfil = $("#id_perfil").val();

        if (rut_usuario == "" || clave_usuario == "" || clave_usuario_repetir == "" ||
                nombre_persona == "" || apellido_persona == "" || telefono_persona == "" || correo_persona == "" || direccion_persona == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            if (Fn.validaRut(rut_usuario)) {
                if (clave_usuario === clave_usuario_repetir) {
                    if (clave_usuario.length >= 8) {
                        if (validar_correo(correo_persona)) {
                            $.ajax({
                                url: base_url + 'insertar_persona',
                                type: 'post',
                                dataType: 'json',
                                data: {rut_usuario: rut_usuario, clave_usuario: clave_usuario, nombre_persona: nombre_persona,
                                    apellido_persona: apellido_persona, telefono_persona: telefono_persona, correo_persona: correo_persona,
                                    direccion_persona: direccion_persona, id_perfil: id_perfil},
                                success: function (resultado) {
                                    if (resultado.mensaje === "0") {
                                        Materialize.toast(resultado.mensaje, "3000");
                                    } else {
                                        $("#rut_usuario").val("");
                                        $("#clave_usuario").val("");
                                        $("#clave_usuario_repetir").val("");
                                        $("#nombre_persona").val("");
                                        $("#apellido_persona").val("");
                                        $("#telefono_persona").val("");
                                        $("#correo_persona").val("");
                                        $("#direccion_persona").val("");
                                        Materialize.toast(resultado.mensaje, "3000");
                                        $("#modal_agregar_usuario").modal('close');
                                        $("#tabla_listado_usuario").DataTable().ajax.reload();
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
                        Materialize.toast("LA CONTRASEÑA DEBE SER MAYOR O IGUAL A 8 CARACTERES", "3000");
                    }
                } else {
                    Materialize.toast("CONTRASEÑAS ERRÓNEAS", "3000");

                }
            } else {
                Materialize.toast("EL RUT INGRESADO NO ES VÁLIDO.", "3000");
            }
        }
    });
});