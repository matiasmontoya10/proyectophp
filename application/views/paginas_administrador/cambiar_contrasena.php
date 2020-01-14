<main class="fondo_main">
    <br>
    <div class="row">
        <div class="col s12 m6 l6 offset-l3 offset-m3">
            <div class="card-panel borde_card_panel">
                <h5 class="center"><b>CAMBIAR CONTRASEÑA</b></h5>
                <div class="input-field">
                    <input id="clave_usuario_actual" type="password" class="validate">
                    <label for="clave_usuario_actual">INGRESE CONTRASEÑA ACTUAL:</label>
                </div>
                <div class="input-field">
                    <input id="clave_usuario_nueva" type="password" class="validate">
                    <label for="clave_usuario_nueva">INGRESE NUEVA CONTRASEÑA:</label>
                </div>
                <div class="input-field">
                    <input id="clave_usuario_nueva_repetir" type="password" class="validate">
                    <label for="clave_usuario_nueva_repetir">REPETIR NUEVA CONTRASEÑA:</label>
                </div>
                <button id="boton_cambiar_clave" class="btn waves-effect waves-light teal darken-2 right" type="submit" name="action">
                    <b>CAMBIAR</b>
                </button>
                <br><br>
            </div>
        </div>
    </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
<script type="text/javascript">
    $("#boton_cambiar_clave").click(function (excepcion) {
        excepcion.preventDefault();

        var rut_usuario = rut_usuario_php;
        //PARA CLAVES ACTUALES.
        var clave_usuario = clave_usuario_php;
        var clave_usuario_actual = $("#clave_usuario_actual").val();
        var md5_clave_usuario_actual = CryptoJS.MD5(clave_usuario_actual).toString();

        //CLAVES NUEVAS.
        var clave_usuario_nueva = $("#clave_usuario_nueva").val();
        var clave_usuario_nueva_repetir = $("#clave_usuario_nueva_repetir").val();
        var md5_clave_usuario_nueva = CryptoJS.MD5(clave_usuario_nueva).toString();


        if (clave_usuario_actual == "" || clave_usuario_nueva == "" || clave_usuario_nueva_repetir == "") {
            Materialize.toast("COMPLETE CAMPO(S) VACIO(S).", 3000);
        } else {
            if (clave_usuario === md5_clave_usuario_actual) {
                if (clave_usuario_nueva === clave_usuario_nueva_repetir) {
                    if (clave_usuario_nueva.length >= 8) {
                        $.ajax({
                            url: base_url + "cambiar_clave",
                            type: 'post',
                            dataType: 'json',
                            data: {rut_usuario: rut_usuario, clave_usuario: md5_clave_usuario_nueva},
                            success: function (o) {
                                $("#clave_usuario_actual").val("");
                                $("#clave_usuario_nueva").val("");
                                $("#clave_usuario_nueva_repetir").val("");
                                Materialize.toast(o.mensaje, "3000");
                            },
                            error: function () {
                                Materialize.toast("ERROR 500", "3000");
                            }
                        });
                    } else {
                        Materialize.toast("LA CONTRASEÑA DEBE TENER A LO MENOS 8 CARACTERES", 3000);
                    }
                } else {
                    Materialize.toast("CLAVES NUEVAS NO COINCIDEN", 3000);
                }
            } else {
                Materialize.toast("CLAVE ACTUAL NO COINCIDE", 3000);

            }
        }
    });
</script>