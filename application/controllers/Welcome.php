<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("modelo");
    }

    //INICIO PAGINA NO ADMINISTRATIVA

    public function index() {
        $this->load->view('paginas_generales/header');
        $this->load->view('paginas_generales/inicio');
        $this->load->view('paginas_generales/footer');
    }

    //REGISTRAR CLIENTE

    public function registrar() {
        $this->load->view('paginas_generales/header');
        $this->load->view('paginas_generales/registrar');
        $this->load->view('paginas_generales/footer');
    }

    public function controlador_insertar_persona() {
        $rut_usuario = $this->input->post("rut_usuario");
        $clave_usuario = $this->input->post("clave_usuario");
        $nombre_persona = $this->input->post("nombre_persona");
        $apellido_persona = $this->input->post("apellido_persona");
        $telefono_persona = $this->input->post("telefono_persona");
        $correo_persona = $this->input->post("correo_persona");
        $direccion_persona = $this->input->post("direccion_persona");
        //ID_PERFIL: 1 ADMINISTRADOR, 2 DESPACHADOR, 3 CLIENTE.
        $id_perfil = $this->input->post("id_perfil");
        if ($this->modelo->modelo_insertar_persona($rut_usuario, $nombre_persona, $apellido_persona, $telefono_persona, $correo_persona, $direccion_persona)) {
            $this->modelo->modelo_insertar_usuario($rut_usuario, $id_perfil, $clave_usuario);
            echo json_encode(array("mensaje" => "USUARIO AGREGADO CON EXITO"));
        } else {
            echo json_encode((array("mensaje" => "USUARIO YA EXISTENTE")));
        }
    }

    //FUNCIONES INICIO / CIERRE SESSION

    public function cerrar_sesion() {
        $this->session->sess_destroy();
        redirect("welcome/index");
    }

    public function iniciar_sesion() {
        $this->load->view('paginas_generales/header');
        $this->load->view('paginas_generales/iniciar_sesion');
        $this->load->view('paginas_generales/footer');
    }

    public function controlador_iniciar_sesion() {
        $rut_usuario = $this->input->post('rut_usuario');
        $clave_usuario = $this->input->post('clave_usuario');

        $usuario = $this->modelo->modelo_iniciar_sesion($rut_usuario, md5($clave_usuario));
        $persona_sesion = $this->modelo->modelo_persona_sesion($rut_usuario);

        if (count($usuario) > 0 && $usuario[0]->estado_usuario == 1) {
            if ($usuario[0]->id_perfil == 1) {
                $this->session->set_userdata("administrador", $usuario);
                $this->session->set_userdata("administrador", $persona_sesion);
                echo json_encode(array("mensaje" => "welcome/administrador"));
            }
        } else {
            echo json_encode(array("mensaje" => "0"));
        }
    }

    //FIN PAGINA NO ADMINISTRATIVA
//
    //PERFIL ADMINISTRADOR
//
//    public function controlador_eliminar_usuario() {
//        if ($this->session->userdata("administrador")) {
//            $rut_usuario = $this->input->post("rut_usuario");
//            $this->modelo->modelo_eliminar_usuario($rut_usuario);
//            $this->modelo->modelo_eliminar_usuario_persona($rut_usuario);
//            echo json_encode(array("mensaje" => "USUARIO ELIMINADO."));
//        } else {
//            redirect("welcome/index");
//        }
//    }
//    
    //INICIO PAGINA ADMINISTRATIVA
    //MODULO ADM USUARIO

    public function administrador() {
        if ($this->session->userdata("administrador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/menu_administrador');
            $this->load->view('paginas_generales/footer');
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_listado_usuario() {
        if ($this->session->userdata('administrador')) {
            $draw = intval($this->input->get("draw"));

            $listado_usuario = $this->modelo->modelo_listado_usuario();
            $data = array();

            foreach ($listado_usuario->result() as $lista) {

                $data[] = array(
                    $lista->rut_usuario,
                    $lista->nombre_persona,
                    $lista->apellido_persona,
                    $lista->telefono_persona,
                    $lista->correo_persona,
                    $lista->direccion_persona,
                    $lista->nombre_perfil,
                    $lista->estado_usuario,
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_usuario->num_rows(),
                "recordsFiltered" => $listado_usuario->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_editar_persona() {
        if ($this->session->userdata("administrador")) {
            $rut_persona = $this->input->post("rut_persona");
            $telefono_persona = $this->input->post("telefono_persona");
            $correo_persona = $this->input->post("correo_persona");
            $direccion_persona = $this->input->post("direccion_persona");
            $this->modelo->modelo_editar_usuario($rut_persona, $telefono_persona, $correo_persona, $direccion_persona);

            //SOLO PARA PERSONAS QUE TENGAN CUENTAS DE USUARIO.
            $estado_usuario = $this->input->post("estado_usuario");

            if ($estado_usuario != "-1") {
                //EDITAR USUARIO.
                $this->modelo->modelo_editar_usuario_estado($rut_persona, $estado_usuario);
            } else {
                
            }
            echo json_encode(array("mensaje" => "USUARIO ACTUALIZADO CON EXITO"));
        } else {
            redirect("welcome/index");
        }
    }

    //MODULO ADM PANADEROS

    public function modulo_panadero() {
        if ($this->session->userdata("administrador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/modulo_panadero');
            $this->load->view('paginas_generales/footer');
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_listado_panadero() {
        if ($this->session->userdata('administrador')) {
            $draw = intval($this->input->get("draw"));

            $listado_panadero = $this->modelo->modelo_listado_panadero();
            $data = array();

            foreach ($listado_panadero->result() as $lista) {

                $data[] = array(
                    $lista->rut_persona,
                    $lista->nombre_persona,
                    $lista->apellido_persona,
                    $lista->telefono_persona,
                    $lista->correo_persona,
                    $lista->direccion_persona,
                    $lista->tipo_panadero,
                    $lista->jornada_panadero,
                    $lista->estado_panadero,
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_panadero->num_rows(),
                "recordsFiltered" => $listado_panadero->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_insertar_panadero() {
        if ($this->session->userdata("administrador")) {
            $rut_usuario = $this->input->post("rut_usuario");
            $nombre_persona = $this->input->post("nombre_persona");
            $apellido_persona = $this->input->post("apellido_persona");
            $telefono_persona = $this->input->post("telefono_persona");
            $correo_persona = $this->input->post("correo_persona");
            $direccion_persona = $this->input->post("direccion_persona");

            //PANADERO
            $tipo_panadero = $this->input->post("tipo_panadero");
            $jornada_panadero = $this->input->post("jornada_panadero");
            $estado_panadero = $this->input->post("estado_panadero");
            if ($this->modelo->modelo_insertar_persona($rut_usuario, $nombre_persona, $apellido_persona, $telefono_persona, $correo_persona, $direccion_persona)) {
                $this->modelo->modelo_insertar_panadero($rut_usuario, $tipo_panadero, $jornada_panadero, $estado_panadero);
                echo json_encode(array("mensaje" => "PANADERO AGREGADO CON EXITO"));
            } else {
                echo json_encode((array("mensaje" => "USUARIO YA EXISTENTE")));
            }
        } else {
            redirect('welcome/index');
        }
    }

    //EDITAR PANADERO Y REPARTIDOR

    public function controlador_editar_trabajador() {
        if ($this->session->userdata("administrador")) {
            $rut_persona = $this->input->post("rut_persona");
            $telefono_persona = $this->input->post("telefono_persona");
            $correo_persona = $this->input->post("correo_persona");
            $direccion_persona = $this->input->post("direccion_persona");
            $this->modelo->modelo_editar_usuario($rut_persona, $telefono_persona, $correo_persona, $direccion_persona);

            //VARIABLE DIFERENCIADORA DE TRABAJADORES (REPARTIDOR, PANADERO)
            $estado_trabajador = $this->input->post("estado_trabajador");

            if ($estado_trabajador == 0) {
                //EDITAR PANADERO
                $tipo_panadero = $this->input->post("tipo_panadero");
                $jornada_panadero = $this->input->post("jornada_panadero");
                $estado_panadero = $this->input->post("estado_panadero");
                $this->modelo->modelo_editar_panadero($rut_persona, $tipo_panadero, $jornada_panadero, $estado_panadero);
                echo json_encode(array("mensaje" => "PANADERO ACTUALIZADO CON EXITO"));
            } else {
                //EDITAR REPARTIDOR
                $licencia_repartidor = $this->input->post("licencia_repartidor");
                $estado_licencia_repartidor = $this->input->post("estado_licencia_repartidor");
                $estado_repartidor = $this->input->post("estado_repartidor");
                $this->modelo->modelo_editar_repartidor($rut_persona, $licencia_repartidor, $estado_licencia_repartidor, $estado_repartidor);
                echo json_encode(array("mensaje" => "REPARTIDOR ACTUALIZADO CON EXITO"));
            }
        } else {
            redirect("welcome/index");
        }
    }

    //ADM DE REPARTIDORES

    public function modulo_repartidor() {
        if ($this->session->userdata("administrador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/modulo_repartidor');
            $this->load->view('paginas_generales/footer');
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_listado_repartidor() {
        if ($this->session->userdata('administrador')) {
            $draw = intval($this->input->get("draw"));

            $listado_repartidor = $this->modelo->modelo_listado_repartidor();
            $data = array();

            foreach ($listado_repartidor->result() as $lista) {

                $data[] = array(
                    $lista->rut_persona,
                    $lista->nombre_persona,
                    $lista->apellido_persona,
                    $lista->telefono_persona,
                    $lista->correo_persona,
                    $lista->direccion_persona,
                    $lista->licencia_repartidor,
                    $lista->estado_licencia_repartidor,
                    $lista->estado_repartidor,
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_repartidor->num_rows(),
                "recordsFiltered" => $listado_repartidor->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_insertar_repartidor() {
        if ($this->session->userdata("administrador")) {
            $rut_usuario = $this->input->post("rut_usuario");
            $nombre_persona = $this->input->post("nombre_persona");
            $apellido_persona = $this->input->post("apellido_persona");
            $telefono_persona = $this->input->post("telefono_persona");
            $correo_persona = $this->input->post("correo_persona");
            $direccion_persona = $this->input->post("direccion_persona");

            //REPARTIDOR
            $licencia_repartidor = $this->input->post("licencia_repartidor");
            $estado_licencia_repartidor = $this->input->post("estado_licencia_repartidor");
            $estado_repartidor = $this->input->post("estado_repartidor");
            if ($this->modelo->modelo_insertar_persona($rut_usuario, $nombre_persona, $apellido_persona, $telefono_persona, $correo_persona, $direccion_persona)) {
                $this->modelo->modelo_insertar_repartidor($rut_usuario, $licencia_repartidor, $estado_licencia_repartidor, $estado_repartidor);
                echo json_encode(array("mensaje" => "REPARTIDOR CREADO CON EXITO AGREGADO CON EXITO"));
            } else {
                echo json_encode((array("mensaje" => "USUARIO YA EXISTENTE")));
            }
        } else {
            redirect('welcome/index');
        }
    }

    //ADM DE VEHICULO

    public function controlador_select_patente_vehiculo_intermedia() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            echo json_encode($this->modelo->modelo_select_patente_vehiculo_intermedia());
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_select_rut_persona_intermedia() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            echo json_encode($this->modelo->modelo_select_rut_persona_intermedia());
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_select_patente_vehiculo() {
        if ($this->session->userdata("administrador")) {
            echo json_encode($this->modelo->modelo_select_patente_vehiculo());
        } else {
            redirect("welcome/index");
        }
    }

    public function modulo_vehiculo() {
        if ($this->session->userdata("administrador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/modulo_vehiculo');
            $this->load->view('paginas_generales/footer');
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_listado_vehiculo() {
        if ($this->session->userdata('administrador')) {
            $draw = intval($this->input->get("draw"));

            $listado_vehiculo = $this->modelo->modelo_listado_vehiculo();
            $data = array();

            foreach ($listado_vehiculo->result() as $lista) {

                $data[] = array(
                    $lista->patente_vehiculo,
                    $lista->marca_vehiculo,
                    $lista->modelo_vehiculo,
                    $lista->ano_vehiculo,
                    $lista->fecha_revision_tecnica_vehiculo,
                    $lista->estado_vehiculo
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_vehiculo->num_rows(),
                "recordsFiltered" => $listado_vehiculo->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_insertar_vehiculo() {
        if ($this->session->userdata("administrador")) {
            $patente_vehiculo = $this->input->post("patente_vehiculo");
            $marca_vehiculo = $this->input->post("marca_vehiculo");
            $modelo_vehiculo = $this->input->post("modelo_vehiculo");
            $ano_vehiculo = $this->input->post("ano_vehiculo");
            $fecha_revision_tecnica_vehiculo = $this->input->post("fecha_revision_tecnica_vehiculo");
            $estado_vehiculo = $this->input->post("estado_vehiculo");

            if ($this->modelo->modelo_insertar_vehiculo($patente_vehiculo, $marca_vehiculo, $modelo_vehiculo, $ano_vehiculo, $fecha_revision_tecnica_vehiculo, $estado_vehiculo)) {
                echo json_encode(array("mensaje" => "VEHÍCULO CREADO CON EXITO AGREGADO CON EXITO"));
            } else {
                echo json_encode((array("mensaje" => "VEHÍCULO YA EXISTENTE")));
            }
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_editar_vehiculo() {
        if ($this->session->userdata("administrador")) {
            $patente_vehiculo = $this->input->post("patente_vehiculo");
            $fecha_revision_tecnica_vehiculo = $this->input->post("fecha_revision_tecnica_vehiculo");
            $estado_vehiculo = $this->input->post("estado_vehiculo");

            $this->modelo->modelo_editar_vehiculo($patente_vehiculo, $fecha_revision_tecnica_vehiculo, $estado_vehiculo);
            echo json_encode(array("mensaje" => "VEHÍCULO ACTUALIZADO CON EXITO"));
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_listado_repartidor_vehiculo() {
        if ($this->session->userdata('administrador')) {
            $draw = intval($this->input->get("draw"));

            $listado_repartidor_vehiculo = $this->modelo->modelo_listado_repartidor_vehiculo();
            $data = array();

            foreach ($listado_repartidor_vehiculo->result() as $lista) {

                $data[] = array(
                    $lista->rut_persona,
                    $lista->nombre_persona,
                    $lista->apellido_persona,
                    $lista->patente_vehiculo,
                    $lista->marca_vehiculo,
                    $lista->modelo_vehiculo,
                    $lista->fecha_repartidor_vehiculo
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_repartidor_vehiculo->num_rows(),
                "recordsFiltered" => $listado_repartidor_vehiculo->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_insertar_repartidor_vehiculo() {
        if ($this->session->userdata("administrador")) {
            $rut_persona = $this->input->post("rut_persona");
            $patente_vehiculo = $this->input->post("patente_vehiculo");
            $fecha_repartidor_vehiculo = date("Y-m-d H:i:s");

            if ($this->modelo->modelo_insertar_repartidor_vehiculo($rut_persona, $patente_vehiculo, $fecha_repartidor_vehiculo)) {
                echo json_encode(array("mensaje" => "VEHÍCULO / REPARTIDOR AGREGADO CON EXITO"));
            }
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_eliminar_repartidor_vehiculo() {
        if ($this->session->userdata("administrador")) {
            $rut_persona = $this->input->post("rut_persona");
            $patente_vehiculo = $this->input->post("patente_vehiculo");
            $this->modelo->modelo_eliminar_repartidor_vehiculo($rut_persona, $patente_vehiculo);
            echo json_encode(array("mensaje" => "VINCULACIÓN ELIMINADA"));
        } else {
            redirect("welcome/index");
        }
    }

//ADM DE RUTA

    public function modulo_ruta() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/modulo_ruta');
            $this->load->view('paginas_generales/footer');
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_listado_ruta() {
        if ($this->session->userdata('administrador') || $this->session->userdata("despachador")) {
            $draw = intval($this->input->get("draw"));

            $listado_ruta = $this->modelo->modelo_listado_ruta();
            $data = array();

            foreach ($listado_ruta->result() as $lista) {

                $data[] = array(
                    $lista->id_ruta,
                    $lista->rut_persona_ruta,
                    $lista->nombre_persona,
                    $lista->apellido_persona,
                    $lista->sector_ruta,
                    $lista->destino_ruta,
                    $lista->fecha_ruta_antigua,
                    $lista->fecha_ruta_actual,
                    $lista->estado_ruta,
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_ruta->num_rows(),
                "recordsFiltered" => $listado_ruta->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_select_repartidor() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            echo json_encode($this->modelo->modelo_select_repartidor());
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_insertar_ruta() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $rut_persona_ruta = $this->input->post("rut_persona_ruta");
            $sector_ruta = $this->input->post("sector_ruta");
            $destino_ruta = $this->input->post("destino_ruta");
            $fecha_ruta_antigua_actual = date("Y-m-d H:i:s");
            $estado_ruta = 0;

            if ($this->modelo->modelo_insertar_ruta($rut_persona_ruta, $sector_ruta, $destino_ruta, $fecha_ruta_antigua_actual, $estado_ruta)) {
                echo json_encode(array("mensaje" => "RUTA CREADA CON EXITO"));
            } else {
                echo json_encode((array("mensaje" => "DESTINO YA EXISTENTE")));
            }
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_actualizar_estado_ruta() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $id_ruta = $this->input->post("id_ruta");
            $estado_ruta = 1;

            $this->modelo->modelo_actualizar_estado_ruta($id_ruta, $estado_ruta);
            echo json_encode(array("mensaje" => "RUTA REALIZADA CON EXITO"));
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_editar_ruta() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $id_ruta = $this->input->post("id_ruta");
            $rut_persona_ruta_actual = $this->input->post("rut_persona_ruta_actual");
            $fecha_ruta_actual = date("Y-m-d H:i:s");
            $estado_ruta = 0;

            $this->modelo->modelo_editar_ruta($id_ruta, $rut_persona_ruta_actual, $fecha_ruta_actual, $estado_ruta);

            echo json_encode(array("mensaje" => "RUTA ACTUALIZADA CON EXITO"));
        } else {
            redirect("welcome/index");
        }
    }

    //MODULO ADMINISTRACION CONTABLE

    public function modulo_contable() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/modulo_contable');
            $this->load->view('paginas_generales/footer');
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_select_activo_pasivo() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            echo json_encode($this->modelo->modelo_select_activo_pasivo());
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_select_activo_pasivo_categoria() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $id_activo_pasivo = $this->input->post("id_activo_pasivo");
            echo json_encode($this->modelo->modelo_select_activo_pasivo_categoria($id_activo_pasivo));
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_select_activo_pasivo_detalle() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $id_activo_pasivo_categoria = $this->input->post("id_activo_pasivo_categoria");
            echo json_encode($this->modelo->modelo_select_activo_pasivo_detalle($id_activo_pasivo_categoria));
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_listado_contabilidad() {
        if ($this->session->userdata('administrador')) {
            $draw = intval($this->input->get("draw"));

            $listado_contabilidad = $this->modelo->modelo_listado_contabilidad();
            $data = array();

            foreach ($listado_contabilidad->result() as $lista) {

                $data[] = array(
                    $lista->id_contabilidad,
                    $lista->total_contabilidad,
                    $lista->iva_contabilidad,
                    $lista->monto_contabilidad,
                    $lista->fecha_contabilidad,
                    $lista->nombre_persona,
                    $lista->apellido_persona,
                    $lista->nombre_activo_pasivo_detalle,
                    $lista->nombre_activo_pasivo_categoria,
                    $lista->nombre_activo_pasivo
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_contabilidad->num_rows(),
                "recordsFiltered" => $listado_contabilidad->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_insertar_contabilidad() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $monto_contabilidad = $this->input->post("monto_contabilidad");
            $fecha_contabilidad = date("Y-m-d H:i:s");
            $rut_usuario = $this->input->post("rut_usuario");
            $id_activo_pasivo_detalle = $this->input->post("id_activo_pasivo_detalle");
            $iva_contabilidad = $this->input->post("iva_contabilidad");
            $total_contabilidad = $this->input->post("total_contabilidad");
            $this->modelo->modelo_insertar_contabilidad($monto_contabilidad, $fecha_contabilidad, $rut_usuario, $id_activo_pasivo_detalle, $iva_contabilidad, $total_contabilidad);
            echo json_encode(array("mensaje" => "CONTABILIDAD REALIZADA CON EXITO"));
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_total_general() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            echo json_encode($this->modelo->modelo_total_general());
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_total_ingresos() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            echo json_encode($this->modelo->modelo_total_ingresos());
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_total_egresos() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            echo json_encode($this->modelo->modelo_total_egresos());
        } else {
            redirect("welcome/index");
        }
    }

    //ADM DE INSUMOS

    public function modulo_insumo() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/modulo_insumo');
            $this->load->view('paginas_generales/footer');
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_select_lista_insumo() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            echo json_encode($this->modelo->modelo_select_lista_insumo());
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_listado_insumo() {
        if ($this->session->userdata('administrador') || $this->session->userdata("despachador")) {
            $draw = intval($this->input->get("draw"));

            $listado_insumo = $this->modelo->modelo_listado_insumo();
            $data = array();

            foreach ($listado_insumo->result() as $lista) {

                $data[] = array(
                    $lista->id_insumo,
                    $lista->fecha_insumo_antigua,
                    $lista->inicial_insumo,
                    $lista->compra_insumo,
                    $lista->gasto_insumo,
                    $lista->stock_insumo,
                    $lista->fecha_insumo_actual,
                    $lista->nombre_lista_insumo,
                    $lista->rut_usuario,
                    $lista->nombre_completo_persona
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_insumo->num_rows(),
                "recordsFiltered" => $listado_insumo->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_insertar_insumo() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $rut_usuario = $this->input->post("rut_usuario");
            $inicial_insumo = $this->input->post("inicial_insumo");
            $id_lista_insumo = $this->input->post("id_lista_insumo");
            $fecha_insumo_antigua = date("Y-m-d H:i:s");
            $fecha_insumo_actual = date("Y-m-d H:i:s");
            $this->modelo->modelo_insertar_insumo($fecha_insumo_antigua, $inicial_insumo, $fecha_insumo_actual, $id_lista_insumo, $rut_usuario);
            echo json_encode(array("mensaje" => "INSUMO REALIZADO CON EXITO"));
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_editar_insumo() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $id_insumo = $this->input->post("id_insumo");
            $compra_insumo = $this->input->post("compra_insumo");
            $gasto_insumo = $this->input->post("gasto_insumo");
            $stock_insumo = $this->input->post("stock_insumo");
            $rut_usuario = $this->input->post("rut_usuario");
            $fecha_insumo_actual = date("Y-m-d H:i:s");
            $this->modelo->modelo_editar_insumo($id_insumo, $compra_insumo, $gasto_insumo, $stock_insumo, $rut_usuario, $fecha_insumo_actual);
            echo json_encode(array("mensaje" => "INSUMO ACTUALIZADO CON EXITO"));
        } else {
            redirect("welcome/index");
        }
    }

    public function modulo_cliente() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/modulo_cliente');
            $this->load->view('paginas_generales/footer');
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_listado_cliente() {
        if ($this->session->userdata('administrador')) {
            $draw = intval($this->input->get("draw"));

            $listado_cliente = $this->modelo->modelo_listado_cliente();
            $data = array();

            foreach ($listado_cliente->result() as $lista) {

                $data[] = array(
                    $lista->rut_usuario,
                    $lista->nombre_persona,
                    $lista->apellido_persona,
                    $lista->telefono_persona,
                    $lista->correo_persona,
                    $lista->direccion_persona,
                    $lista->nombre_perfil,
                    $lista->estado_usuario,
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_cliente->num_rows(),
                "recordsFiltered" => $listado_cliente->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect('welcome/index');
        }
    }

    public function modulo_mensajeria() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador") || $this->session->userdata("cliente")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/modulo_mensajeria');
            $this->load->view('paginas_generales/footer');
        } else {
            redirect("welcome/index");
        }
    }

    //MENSAJERIA

    public function controlador_select_usuario() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador") || $this->session->userdata("despachador")) {
            $rut_usuario = $this->input->post("rut_usuario");
            echo json_encode($this->modelo->modelo_select_usuario($rut_usuario));
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_insertar_mensaje() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador") || $this->session->userdata("cliente")) {
            $rut_usuario = $this->input->post("rut_usuario");
            $select_usuario = $this->input->post("select_usuario");
            $titulo_mensaje = $this->input->post("titulo_mensaje");
            $descripcion_mensaje = $this->input->post("descripcion_mensaje");
            $fecha_mensaje = date("Y-m-d H:i:s");
            $estado_mensaje = 0;
            $this->modelo->modelo_insertar_mensaje($rut_usuario, $select_usuario, $titulo_mensaje, $descripcion_mensaje, $fecha_mensaje, $estado_mensaje);
            echo json_encode(array("mensaje" => "MENSAJE ENVIADO CON EXITO"));
        } else {
            redirect("welcome/index");
        }
    }

    public function controlador_listado_mensaje_entrada() {
        if ($this->session->userdata('administrador')) {
            $draw = intval($this->input->get("draw"));
            $rut_usuario = $this->input->post("rut_usuario");
            $listado_mensaje_entrada = $this->modelo->modelo_listado_mensaje_entrada($rut_usuario);
            $data = array();

            foreach ($listado_mensaje_entrada->result() as $lista) {

                $data[] = array(
                    $lista->id_mensaje,
                    $lista->rut_usuario_receptor,
                    $lista->rut_usuario_emisor,
                    $lista->receptor_nombre_completo,
                    $lista->titulo_mensaje,
                    $lista->descripcion_mensaje,
                    $lista->fecha_mensaje,
                    $lista->estado_mensaje,
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_mensaje_entrada->num_rows(),
                "recordsFiltered" => $listado_mensaje_entrada->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect('welcome/index');
        }
    }

    public function controlador_listado_mensaje_salida() {
        if ($this->session->userdata('administrador')) {
            $draw = intval($this->input->get("draw"));
            $rut_usuario = $this->input->post("rut_usuario");
            $listado_mensaje_salida = $this->modelo->modelo_listado_mensaje_salida($rut_usuario);
            $data = array();

            foreach ($listado_mensaje_salida->result() as $lista) {

                $data[] = array(
                    $lista->id_mensaje,
                    $lista->rut_usuario_emisor,
                    $lista->rut_usuario_receptor,
                    $lista->receptor_nombre_completo,
                    $lista->titulo_mensaje,
                    $lista->descripcion_mensaje,
                    $lista->fecha_mensaje,
                    $lista->estado_mensaje,
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_mensaje_salida->num_rows(),
                "recordsFiltered" => $listado_mensaje_salida->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect('welcome/index');
        }
    }

    public function modulo_sensor() {
        if ($this->session->userdata("administrador") || $this->session->userdata("despachador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/modulo_sensor');
            $this->load->view('paginas_generales/footer');
        } else {
            redirect("welcome/index");
        }
    }

}
