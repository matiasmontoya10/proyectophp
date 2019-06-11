<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>framework/css/personalizado.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>framework/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>framework/js/materialize.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>framework/js/custom.js"></script>
    </head>

    <body>
        <header>
            <div class="navbar-fixed">
                <nav>
                    <div class="nav-wrapper teal darken-2">
                        <a href="<?php echo base_url(); ?>welcome/index" class="brand-logo"><b>&nbsp;SANTA ANA S.A</b></a>
                        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <li><a href="<?php echo base_url(); ?>welcome/registrar">Registrate</a></li>
                            <li><a href="<?php echo base_url(); ?>welcome/iniciar_sesion">Iniciar Sesión</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <ul class="side-nav grey lighten-5" id="mobile-demo">
                <li>
                    <div class="user-view">
                        <div class="background">
                            <img src="<?php echo base_url(); ?>/framework/imagenes/fondo1.png" class="responsive-img">
                        </div>
                        <p class="center white-text"><b>OPCIONES<br>SANTA ANA S.A</b></p>
                    </div>
                </li>
                <li><a class="center" href="<?php echo base_url(); ?>welcome/registrar">Registrate</a></li>
                <li><a class="center" href="<?php echo base_url(); ?>welcome/iniciar_sesion">Iniciar Sesión</a></li>
            </ul>
        </header>
