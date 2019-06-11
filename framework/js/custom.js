$(document).ready(function () {

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

    //Valida el rut con su cadena completa "XXXXXXXX-X".
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

    $("#boton_iniciar_sesion").click(function (excepcion) {

        excepcion.preventDefault();

        var rut_usuario = $("#rut_usuario").val();
        var clave_usuario = $("#clave_usuario").val();

        if (rut_usuario == "" || clave_usuario == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            if (Fn.validaRut(rut_usuario)) {
                $.ajax({
                    url: base_url + 'iniciar_sesion',
                    type: 'post',
                    dataType: 'json',
                    data: {rut_usuario: rut_usuario, clave_usuario: clave_usuario},
                    success: function (resultado) {
                        if (resultado.mensaje === "0") {
                            Materialize.toast("CREDENCIAL INCORRECTA / INACTIVA.", "3000");
                        } else {
                            Materialize.toast("BIENVENIDO.", "3000");
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
        var id_perfil = 3;

        if (rut_usuario == "" || clave_usuario == "" || clave_usuario_repetir == "" ||
                nombre_persona == "" || apellido_persona == "" || telefono_persona == "" || correo_persona == "" || direccion_persona == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            if (Fn.validaRut(rut_usuario)) {
                if (clave_usuario === clave_usuario_repetir) {
                    if (clave_usuario.length >= 8) {
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
                                    Materialize.toast(resultado.mensaje, "3000");
                                    //window.location.href = base_url + resultado.mensaje;
                                }
                            },
                            error: function () {
                                Materialize.toast("ERROR 500", "3000");
                            }
                        });
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