<?php

class Modelo extends CI_Model {

    //FUNCIONES NO ADMINISTRATIVAS

    public function modelo_iniciar_sesion($rut_usuario, $clave_usuario) {
        $this->db->where("rut_usuario", $rut_usuario);
        $this->db->where("clave_usuario", $clave_usuario);
        return $this->db->get("usuario")->result();
    }

    public function modelo_persona_sesion($rut_usuario) {
        $this->db->select("*");
        $this->db->from("persona");
        $this->db->join("usuario", "usuario.rut_usuario = persona.rut_persona");
        $this->db->where("persona.rut_persona", $rut_usuario);
        return $this->db->get()->result();
    }

    //AGREGAR PERSONA

    public function modelo_buscar_rut($rut_usuario) {
        $this->db->where("rut_persona", $rut_usuario);
        return count($this->db->get("persona")->result());
    }

    public function modelo_insertar_persona($rut_usuario, $nombre_persona, $apellido_persona, $telefono_persona, $correo_persona, $direccion_persona) {

        if ($this->modelo_buscar_rut($rut_usuario) == 0) {
            $data = array("rut_persona" => $rut_usuario,
                "nombre_persona" => $nombre_persona,
                "apellido_persona" => $apellido_persona,
                "telefono_persona" => $telefono_persona,
                "correo_persona" => $correo_persona,
                "direccion_persona" => $direccion_persona);
            return $this->db->insert("persona", $data);
        } else {
            return 0;
        }
    }

    public function modelo_insertar_usuario($rut_usuario, $id_perfil, $clave_usuario) {
        $data = array("rut_usuario" => $rut_usuario,
            "id_perfil" => $id_perfil,
            "clave_usuario" => md5($clave_usuario),
            "estado_usuario" => "1");
        return $this->db->insert("usuario", $data);
    }

    //FIN FUNCIONES NO ADMINISTRATIVAS
    //INICIO ADMINISTRATIVO
    //MODULO ADM DE USUARIOS

    public function modelo_listado_usuario() {
        $this->db->select("usuario.rut_usuario, nombre_persona, persona.apellido_persona, persona.telefono_persona, persona.correo_persona, persona.direccion_persona, perfil.nombre_perfil, usuario.estado_usuario");
        $this->db->from("usuario");
        $this->db->join("persona", "usuario.rut_usuario = persona.rut_persona");
        $this->db->join("perfil", "perfil.id_perfil = usuario.id_perfil");
        return $this->db->get();
    }

//    public function modelo_eliminar_usuario($rut_usuario) {
//        $this->db->where("rut_usuario", $rut_usuario);
//        return $this->db->delete("usuario");
//    }
//    
//    public function modelo_eliminar_usuario_persona($rut_usuario) {
//        $this->db->where("rut_persona", $rut_usuario);
//        return $this->db->delete("persona");
//    }

    public function modelo_editar_usuario($rut_persona, $telefono_persona, $correo_persona, $direccion_persona) {
        $this->db->where("rut_persona", $rut_persona);
        $data = array(
            "telefono_persona" => $telefono_persona,
            "correo_persona" => $correo_persona,
            "direccion_persona" => $direccion_persona
        );
        return $this->db->update("persona", $data);
    }

    public function modelo_editar_usuario_estado($rut_persona, $estado_usuario) {
        $this->db->where("rut_usuario", $rut_persona);
        $data = array(
            "estado_usuario" => $estado_usuario,
        );
        return $this->db->update("usuario", $data);
    }

    //ADM DE PANADEROS

    public function modelo_listado_panadero() {
        $this->db->select("persona.rut_persona, persona.nombre_persona, persona.apellido_persona, persona.telefono_persona, persona.correo_persona, persona.direccion_persona, panadero.tipo_panadero, panadero.jornada_panadero, panadero.estado_panadero");
        $this->db->from("persona");
        $this->db->join("panadero", "persona.rut_persona = panadero.rut_persona");
        return $this->db->get();
    }

    public function modelo_insertar_panadero($rut_usuario, $tipo_panadero, $jornada_panadero, $estado_panadero) {
        $data = array("rut_persona" => $rut_usuario,
            "tipo_panadero" => $tipo_panadero,
            "jornada_panadero" => $jornada_panadero,
            "estado_panadero" => $estado_panadero);
        return $this->db->insert("panadero", $data);
    }

    public function modelo_editar_panadero($rut_persona, $tipo_panadero, $jornada_panadero, $estado_panadero) {
        $this->db->where("rut_persona", $rut_persona);
        $data = array("rut_persona" => $rut_persona,
            "tipo_panadero" => $tipo_panadero,
            "jornada_panadero" => $jornada_panadero,
            "estado_panadero" => $estado_panadero);
        return $this->db->update("panadero", $data);
    }

    //ADM DE REPARTIDORES

    public function modelo_listado_repartidor() {
        $this->db->select("persona.rut_persona, persona.nombre_persona, persona.apellido_persona, persona.telefono_persona, persona.correo_persona, persona.direccion_persona, repartidor.licencia_repartidor, repartidor.estado_licencia_repartidor, repartidor.estado_repartidor");
        $this->db->from("persona");
        $this->db->join("repartidor", "persona.rut_persona = repartidor.rut_persona");
        return $this->db->get();
    }

    public function modelo_insertar_repartidor($rut_usuario, $licencia_repartidor, $estado_licencia_repartidor, $estado_repartidor) {
        $data = array("rut_persona" => $rut_usuario,
            "licencia_repartidor" => $licencia_repartidor,
            "estado_licencia_repartidor" => $estado_licencia_repartidor,
            "estado_repartidor" => $estado_repartidor);
        return $this->db->insert("repartidor", $data);
    }

    public function modelo_editar_repartidor($rut_persona, $licencia_repartidor, $estado_licencia_repartidor, $estado_repartidor) {
        $this->db->where("rut_persona", $rut_persona);
        $data = array("rut_persona" => $rut_persona,
            "licencia_repartidor" => $licencia_repartidor,
            "estado_licencia_repartidor" => $estado_licencia_repartidor,
            "estado_repartidor" => $estado_repartidor);
        return $this->db->update("repartidor", $data);
    }

    //ADM DE VEHICULOS

    public function modelo_listado_repartidor_vehiculo() {
        $this->db->select("repartidor_vehiculo.rut_persona, persona.nombre_persona, persona.apellido_persona, repartidor_vehiculo.patente_vehiculo, vehiculo.marca_vehiculo, vehiculo.modelo_vehiculo, repartidor_vehiculo.fecha_repartidor_vehiculo");
        $this->db->from("repartidor_vehiculo");
        $this->db->join("vehiculo", "repartidor_vehiculo.patente_vehiculo = vehiculo.patente_vehiculo");
        $this->db->join("repartidor", "repartidor_vehiculo.rut_persona = repartidor.rut_persona");
        $this->db->join("persona", "repartidor.rut_persona = persona.rut_persona");
        return $this->db->get();
    }

    public function modelo_listado_vehiculo() {
        $this->db->select("*");
        $this->db->from("vehiculo");
        return $this->db->get();
    }

    public function modelo_buscar_patente($patente_vehiculo) {
        $this->db->where("patente_vehiculo", $patente_vehiculo);
        return count($this->db->get("vehiculo")->result());
    }

    public function modelo_insertar_repartidor_vehiculo($rut_persona, $patente_vehiculo, $fecha_repartidor_vehiculo) {
        $data = array("patente_vehiculo" => $patente_vehiculo,
            "rut_persona" => $rut_persona,
            "fecha_repartidor_vehiculo" => $fecha_repartidor_vehiculo);
        return $this->db->insert("repartidor_vehiculo", $data);
    }

    public function modelo_insertar_vehiculo($patente_vehiculo, $marca_vehiculo, $modelo_vehiculo, $ano_vehiculo, $fecha_revision_tecnica_vehiculo, $estado_vehiculo) {

        if ($this->modelo_buscar_patente($patente_vehiculo) == 0) {
            $data = array("patente_vehiculo" => $patente_vehiculo,
                "marca_vehiculo" => $marca_vehiculo,
                "modelo_vehiculo" => $modelo_vehiculo,
                "ano_vehiculo" => $ano_vehiculo,
                "fecha_revision_tecnica_vehiculo" => $fecha_revision_tecnica_vehiculo,
                "estado_vehiculo" => $estado_vehiculo);
            return $this->db->insert("vehiculo", $data);
        } else {
            return 0;
        }
    }

    public function modelo_editar_vehiculo($patente_vehiculo, $fecha_revision_tecnica_vehiculo, $estado_vehiculo) {
        $this->db->where("patente_vehiculo", $patente_vehiculo);
        $data = array("patente_vehiculo" => $patente_vehiculo,
            "fecha_revision_tecnica_vehiculo" => $fecha_revision_tecnica_vehiculo,
            "estado_vehiculo" => $estado_vehiculo);
        return $this->db->update("vehiculo", $data);
    }

    public function modelo_select_patente_vehiculo_intermedia() {
        $this->db->select("vehiculo.patente_vehiculo, vehiculo.modelo_vehiculo, vehiculo.marca_vehiculo");
        $this->db->from("vehiculo");
        $this->db->join("repartidor_vehiculo", "vehiculo.patente_vehiculo = repartidor_vehiculo.patente_vehiculo", "left");
        $this->db->where("repartidor_vehiculo.patente_vehiculo is null");
        return $this->db->get()->result();
    }

    public function modelo_eliminar_repartidor_vehiculo($rut_persona, $patente_vehiculo) {
        $this->db->query("delete from repartidor_vehiculo where rut_persona = '$rut_persona' and patente_vehiculo = '$patente_vehiculo'");
    }

    public function modelo_select_rut_persona_intermedia() {
        $this->db->select("repartidor.rut_persona, persona.nombre_persona, persona.apellido_persona");
        $this->db->from("repartidor");
        $this->db->join("repartidor_vehiculo", "repartidor.rut_persona = repartidor_vehiculo.rut_persona", "left");
        $this->db->join("persona", "repartidor.rut_persona = persona.rut_persona");
        $this->db->where("repartidor_vehiculo.rut_persona is null");
        return $this->db->get()->result();
    }

    //ADM DE RUTAS

    public function modelo_select_patente_vehiculo() {
        $this->db->select("vehiculo.patente_vehiculo, vehiculo.marca_vehiculo, vehiculo.modelo_vehiculo");
        $this->db->from("vehiculo");
        return $this->db->get()->result();
    }

    public function modelo_listado_ruta() {
        $this->db->select("ruta.id_ruta, ruta.rut_persona_ruta, persona.nombre_persona, persona.apellido_persona, ruta.sector_ruta, ruta.destino_ruta, ruta.fecha_ruta_antigua, ruta.fecha_ruta_actual, ruta.estado_ruta");
        $this->db->from("ruta");
        $this->db->join("repartidor", "ruta.rut_persona_ruta = repartidor.rut_persona");
        $this->db->join("persona", "persona.rut_persona = repartidor.rut_persona");
        return $this->db->get();
    }

    public function modelo_select_repartidor() {
        $this->db->select("repartidor.rut_persona, persona.nombre_persona, persona.apellido_persona");
        $this->db->from("repartidor");
        $this->db->join("persona", "persona.rut_persona = repartidor.rut_persona");
        return $this->db->get()->result();
    }

    public function modelo_buscar_destino($destino_ruta) {
        $this->db->where("destino_ruta", $destino_ruta);
        return count($this->db->get("ruta")->result());
    }

    public function modelo_insertar_ruta($rut_persona_ruta, $sector_ruta, $destino_ruta, $fecha_ruta_antigua_actual, $estado_ruta) {

        if ($this->modelo_buscar_destino($destino_ruta) == 0) {
            $data = array("rut_persona_ruta" => $rut_persona_ruta,
                "sector_ruta" => $sector_ruta,
                "destino_ruta" => $destino_ruta,
                "fecha_ruta_antigua" => $fecha_ruta_antigua_actual,
                "fecha_ruta_actual" => $fecha_ruta_antigua_actual,
                "estado_ruta" => $estado_ruta);
            return $this->db->insert("ruta", $data);
        } else {
            return 0;
        }
    }

    public function modelo_actualizar_estado_ruta($id_ruta, $estado_ruta) {
        $this->db->where("id_ruta", $id_ruta);
        $data = array("estado_ruta" => $estado_ruta);
        return $this->db->update("ruta", $data);
    }

    public function modelo_editar_ruta($id_ruta, $rut_persona_ruta_actual, $fecha_ruta_actual, $estado_ruta) {
        $this->db->where("id_ruta", $id_ruta);
        $data = array("rut_persona_ruta" => $rut_persona_ruta_actual,
            "fecha_ruta_actual" => $fecha_ruta_actual,
            "estado_ruta" => $estado_ruta);
        return $this->db->update("ruta", $data);
    }

    //ADM CONTABLE

    public function modelo_select_activo_pasivo() {
        return $this->db->get("activo_pasivo")->result();
    }

    public function modelo_select_activo_pasivo_categoria($id_activo_pasivo) {
        $this->db->where("id_activo_pasivo", $id_activo_pasivo);
        return $this->db->get("activo_pasivo_categoria")->result();
    }

    public function modelo_select_activo_pasivo_detalle($id_activo_pasivo_categoria) {
        $this->db->where("id_activo_pasivo_categoria", $id_activo_pasivo_categoria);
        return $this->db->get("activo_pasivo_detalle")->result();
    }

    public function modelo_listado_contabilidad() {
        $this->db->select("contabilidad.id_contabilidad, contabilidad.total_contabilidad, contabilidad.iva_contabilidad, contabilidad.monto_contabilidad, contabilidad.fecha_contabilidad, persona.nombre_persona, persona.apellido_persona, activo_pasivo_detalle.nombre_activo_pasivo_detalle, activo_pasivo_categoria.nombre_activo_pasivo_categoria, activo_pasivo.nombre_activo_pasivo");
        $this->db->from("contabilidad");
        $this->db->join("usuario", "contabilidad.rut_usuario = usuario.rut_usuario");
        $this->db->join("persona", "usuario.rut_usuario = persona.rut_persona");
        $this->db->join("activo_pasivo_detalle", "contabilidad.id_activo_pasivo_detalle = activo_pasivo_detalle.id_activo_pasivo_detalle");
        $this->db->join("activo_pasivo_categoria", "activo_pasivo_categoria.id_activo_pasivo_categoria = activo_pasivo_detalle.id_activo_pasivo_categoria");
        $this->db->join("activo_pasivo", "activo_pasivo_categoria.id_activo_pasivo = activo_pasivo.id_activo_pasivo");
        return $this->db->get();
    }

    public function modelo_insertar_contabilidad($monto_contabilidad, $fecha_contabilidad, $rut_usuario, $id_activo_pasivo_detalle, $iva_contabilidad, $total_contabilidad) {
        $data = array("monto_contabilidad" => $monto_contabilidad,
            "fecha_contabilidad" => $fecha_contabilidad,
            "rut_usuario" => $rut_usuario,
            "id_activo_pasivo_detalle" => $id_activo_pasivo_detalle,
            "iva_contabilidad" => $iva_contabilidad,
            "total_contabilidad" => $total_contabilidad);
        return $this->db->insert("contabilidad", $data);
    }

    public function modelo_total_general() {
        $this->db->select("sum(total_contabilidad) as total_general");
        $this->db->from("contabilidad");
        return $this->db->get()->result();
    }

    public function modelo_total_ingresos() {
        $this->db->select("sum(total_contabilidad) as total_ingresos");
        $this->db->from("contabilidad");
        $this->db->join("activo_pasivo_detalle", "contabilidad.id_activo_pasivo_detalle = activo_pasivo_detalle.id_activo_pasivo_detalle");
        $this->db->join("activo_pasivo_categoria", "activo_pasivo_categoria.id_activo_pasivo_categoria = activo_pasivo_detalle.id_activo_pasivo_categoria");
        $this->db->join("activo_pasivo", "activo_pasivo_categoria.id_activo_pasivo = activo_pasivo.id_activo_pasivo");
        $this->db->where("activo_pasivo.id_activo_pasivo", "1");
        return $this->db->get()->result();
    }

    public function modelo_total_egresos() {
        $this->db->select("sum(total_contabilidad) as total_egresos");
        $this->db->from("contabilidad");
        $this->db->join("activo_pasivo_detalle", "contabilidad.id_activo_pasivo_detalle = activo_pasivo_detalle.id_activo_pasivo_detalle");
        $this->db->join("activo_pasivo_categoria", "activo_pasivo_categoria.id_activo_pasivo_categoria = activo_pasivo_detalle.id_activo_pasivo_categoria");
        $this->db->join("activo_pasivo", "activo_pasivo_categoria.id_activo_pasivo = activo_pasivo.id_activo_pasivo");
        $this->db->where("activo_pasivo.id_activo_pasivo", "2");
        return $this->db->get()->result();
    }

    //ADM DE INSUMOS

    public function modelo_select_lista_insumo() {
        $this->db->select("lista_insumo.id_lista_insumo, lista_insumo.nombre_lista_insumo");
        $this->db->from("lista_insumo");
        return $this->db->get()->result();
    }

    public function modelo_listado_insumo() {
        $this->db->select('insumo.id_insumo, insumo.fecha_insumo_antigua, insumo.inicial_insumo, insumo.compra_insumo, insumo.gasto_insumo, insumo.stock_insumo, insumo.fecha_insumo_actual, lista_insumo.nombre_lista_insumo, usuario.rut_usuario, concat(persona.nombre_persona," ",persona.apellido_persona) as nombre_completo_persona');
        $this->db->from("insumo");
        $this->db->join("lista_insumo", "insumo.id_lista_insumo = lista_insumo.id_lista_insumo");
        $this->db->join("usuario", "usuario.rut_usuario = insumo.rut_usuario");
        $this->db->join("persona", "persona.rut_persona = usuario.rut_usuario");
        return $this->db->get();
    }

    public function modelo_insertar_insumo($fecha_insumo_antigua, $inicial_insumo, $fecha_insumo_actual, $id_lista_insumo, $rut_usuario) {
        $data = array("fecha_insumo_antigua" => $fecha_insumo_antigua,
            "inicial_insumo" => $inicial_insumo,
            "compra_insumo" => "0",
            "gasto_insumo" => "0",
            "stock_insumo" => $inicial_insumo,
            "fecha_insumo_actual" => $fecha_insumo_actual,
            "id_lista_insumo" => $id_lista_insumo,
            "rut_usuario" => $rut_usuario);
        return $this->db->insert("insumo", $data);
    }

    public function modelo_editar_insumo($id_insumo, $compra_insumo, $gasto_insumo, $stock_insumo, $rut_usuario, $fecha_insumo_actual) {
        $this->db->where("id_insumo", $id_insumo);
        $data = array("compra_insumo" => $compra_insumo,
            "gasto_insumo" => $gasto_insumo,
            "stock_insumo" => $stock_insumo,
            "rut_usuario" => $rut_usuario,
            "fecha_insumo_actual" => $fecha_insumo_actual);
        return $this->db->update("insumo", $data);
    }

    //ADM DE CLIENTES

    public function modelo_listado_cliente() {
        $this->db->select("usuario.rut_usuario, nombre_persona, persona.apellido_persona, persona.telefono_persona, persona.correo_persona, persona.direccion_persona, perfil.nombre_perfil, usuario.estado_usuario");
        $this->db->from("usuario");
        $this->db->join("persona", "usuario.rut_usuario = persona.rut_persona");
        $this->db->join("perfil", "perfil.id_perfil = usuario.id_perfil");
        $this->db->where("perfil.id_perfil", 3);
        return $this->db->get();
    }

    //MENSAJE

    public function modelo_select_usuario($rut_usuario) {
        $this->db->select("usuario.rut_usuario, persona.nombre_persona, persona.apellido_persona");
        $this->db->from("usuario");
        $this->db->join("persona", "usuario.rut_usuario = persona.rut_persona");
        $this->db->where("usuario.rut_usuario !=", $rut_usuario);
        return $this->db->get()->result();
    }

    public function modelo_insertar_mensaje($rut_usuario, $select_usuario, $titulo_mensaje, $descripcion_mensaje, $fecha_mensaje, $estado_mensaje) {
        $data = array("rut_usuario_emisor" => $rut_usuario,
            "rut_usuario_receptor" => $select_usuario,
            "titulo_mensaje" => $titulo_mensaje,
            "descripcion_mensaje" => $descripcion_mensaje,
            "fecha_mensaje" => $fecha_mensaje,
            "estado_mensaje" => $estado_mensaje);
        return $this->db->insert("mensaje", $data);
    }

    public function modelo_listado_mensaje_entrada($rut_usuario) {
        $this->db->select("mensaje.id_mensaje, mensaje.rut_usuario_receptor, mensaje.rut_usuario_emisor, concat(persona.nombre_persona, ' ' ,persona.apellido_persona) as receptor_nombre_completo, mensaje.titulo_mensaje, mensaje.descripcion_mensaje, mensaje.fecha_mensaje, mensaje.estado_mensaje");
        $this->db->from("mensaje");
        $this->db->join("usuario", "usuario.rut_usuario = mensaje.rut_usuario_emisor");
        $this->db->join("persona", "persona.rut_persona = mensaje.rut_usuario_emisor");
        $this->db->where("mensaje.rut_usuario_receptor", $rut_usuario);
        return $this->db->get();
    }
    
    public function modelo_listado_mensaje_salida($rut_usuario) {
        $this->db->select("mensaje.id_mensaje, mensaje.rut_usuario_emisor, mensaje.rut_usuario_receptor, concat(persona.nombre_persona, ' ' ,persona.apellido_persona) as receptor_nombre_completo, mensaje.titulo_mensaje, mensaje.descripcion_mensaje, mensaje.fecha_mensaje, mensaje.estado_mensaje");
        $this->db->from("mensaje");
        $this->db->join("usuario", "usuario.rut_usuario = mensaje.rut_usuario_receptor");
        $this->db->join("persona", "persona.rut_persona = mensaje.rut_usuario_receptor");
        $this->db->where("mensaje.rut_usuario_emisor", $rut_usuario);
        return $this->db->get();
    }

}
