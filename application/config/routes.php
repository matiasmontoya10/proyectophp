<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//INICIO DE SESION
$route['iniciar_sesion'] = 'welcome/controlador_iniciar_sesion';
$route['insertar_persona'] = 'welcome/controlador_insertar_persona';

//ADMINISTRACION DE USUARIOS
$route['listado_usuario'] = 'welcome/controlador_listado_usuario';
$route['eliminar_usuario'] = 'welcome/controlador_eliminar_usuario';
$route['editar_persona'] = 'welcome/controlador_editar_persona';

//ADMINISTARCION DE PANADEROS
$route['listado_panadero'] = 'welcome/controlador_listado_panadero';
$route['insertar_panadero'] = 'welcome/controlador_insertar_panadero';
$route['editar_trabajador'] = 'welcome/controlador_editar_trabajador';

//ADMINISTRADOR DE REPARTIDORES
$route['listado_repartidor'] = 'welcome/controlador_listado_repartidor';
$route['insertar_repartidor'] = 'welcome/controlador_insertar_repartidor';

//ADMINISTRACION DE VEHICULOS
$route['listado_vehiculo'] = 'welcome/controlador_listado_vehiculo';
$route['insertar_vehiculo'] = 'welcome/controlador_insertar_vehiculo';
$route['editar_vehiculo'] = 'welcome/controlador_editar_vehiculo';
$route['listado_repartidor_vehiculo'] = 'welcome/controlador_listado_repartidor_vehiculo';
$route['select_patente_vehiculo'] = 'welcome/controlador_select_patente_vehiculo';
$route['insertar_repartidor_vehiculo'] = 'welcome/controlador_insertar_repartidor_vehiculo';

//ADMINISTRACION VEHICULO REPARTIDOR
$route['select_patente_vehiculo_intermedia'] = 'welcome/controlador_select_patente_vehiculo_intermedia';
$route['select_rut_persona_intermedia'] = 'welcome/controlador_select_rut_persona_intermedia';
$route['eliminar_repartidor_vehiculo'] = 'welcome/controlador_eliminar_repartidor_vehiculo';

//ADMINISTRADOR DE RUTAS
$route['listado_ruta'] = 'welcome/controlador_listado_ruta';
$route['select_repartidor'] = 'welcome/controlador_select_repartidor';
$route['insertar_ruta'] = 'welcome/controlador_insertar_ruta';
$route['actualizar_estado_ruta'] = 'welcome/controlador_actualizar_estado_ruta';
$route['editar_ruta'] = 'welcome/controlador_editar_ruta';

//ADMINISTRACION CONTABLE
$route['select_activo_pasivo'] = 'welcome/controlador_select_activo_pasivo';
$route['select_activo_pasivo_categoria'] = 'welcome/controlador_select_activo_pasivo_categoria';
$route['select_activo_pasivo_detalle'] = 'welcome/controlador_select_activo_pasivo_detalle';
$route['listado_contabilidad'] = 'welcome/controlador_listado_contabilidad';
$route['insertar_contabilidad'] = 'welcome/controlador_insertar_contabilidad';
$route['total_general'] = 'welcome/controlador_total_general';
$route['total_ingresos'] = 'welcome/controlador_total_ingresos';
$route['total_egresos'] = 'welcome/controlador_total_egresos';

//ADMINISTRACION DE INSUMO
$route['select_lista_insumo'] = 'welcome/controlador_select_lista_insumo';
$route['listado_insumo'] = 'welcome/controlador_listado_insumo';
$route['insertar_insumo'] = 'welcome/controlador_insertar_insumo';
$route['editar_insumo'] = 'welcome/controlador_editar_insumo';

//ADMINISTRACION DE CLIENTES
$route['listado_cliente'] = 'welcome/controlador_listado_cliente';

//MENSAJERÍA
$route['select_usuario'] = 'welcome/controlador_select_usuario';
$route['insertar_mensaje'] = 'welcome/controlador_insertar_mensaje';
$route['listado_mensaje_entrada'] = 'welcome/controlador_listado_mensaje_entrada';
$route['listado_mensaje_salida'] = 'welcome/controlador_listado_mensaje_salida';




