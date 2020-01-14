<main class="fondo_main">
    <br>
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2 l8 offset-l2">
                <div class="card-panel borde_card_panel grey lighten-5">
                    <h5 class="center-align black-text"><b>INGRESA TUS DATOS PARA EL REGISTRO</b></h5>
                    <div class="input-field">
                        <i class="material-icons prefix">create</i>
                        <input id="rut_usuario" type="text" class="validate" placeholder="19390359-2" maxlength="15">
                        <label for="rut_usuario">RUT:</label>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                        <input id="clave_usuario" type="password" class="validate" maxlength="15">
                        <label for="clave_usuario">CONTRASEÑA:</label>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                        <input id="clave_usuario_repetir" type="password" class="validate" maxlength="15">
                        <label for="clave_usuario_repetir">REPITA CONTRASEÑA:</label>
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
                    <input type="hidden" id="id_perfil" value="3"/>
                    <div class="input-field center-align">
                        <button id="boton_registrar" type="submit" class="waves-effect waves-light btn-floating teal darken-2 pulse">
                            <i class="material-icons">account_circle</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    $('.validar_numero').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>