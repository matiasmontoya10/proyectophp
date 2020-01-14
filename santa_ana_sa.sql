-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-01-2020 a las 19:57:16
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `santa_ana_sa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_pasivo`
--

CREATE TABLE IF NOT EXISTS `activo_pasivo` (
  `id_activo_pasivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_activo_pasivo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_activo_pasivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `activo_pasivo`
--

INSERT INTO `activo_pasivo` (`id_activo_pasivo`, `nombre_activo_pasivo`) VALUES
(1, 'Activo'),
(2, 'Pasivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_pasivo_categoria`
--

CREATE TABLE IF NOT EXISTS `activo_pasivo_categoria` (
  `id_activo_pasivo_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_activo_pasivo_categoria` varchar(50) NOT NULL,
  `id_activo_pasivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_activo_pasivo_categoria`),
  KEY `fk_activo_pasivo` (`id_activo_pasivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `activo_pasivo_categoria`
--

INSERT INTO `activo_pasivo_categoria` (`id_activo_pasivo_categoria`, `nombre_activo_pasivo_categoria`, `id_activo_pasivo`) VALUES
(1, 'Activo circulante', 1),
(2, 'Activo no circulante', 1),
(3, 'Otros activos', 1),
(4, 'Pasivo a corto plazo', 2),
(5, 'Pasivo a largo plazo', 2),
(6, 'Otros pasivos', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_pasivo_detalle`
--

CREATE TABLE IF NOT EXISTS `activo_pasivo_detalle` (
  `id_activo_pasivo_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_activo_pasivo_detalle` varchar(50) NOT NULL,
  `id_activo_pasivo_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_activo_pasivo_detalle`),
  KEY `fk_activo_pasivo_detale` (`id_activo_pasivo_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `activo_pasivo_detalle`
--

INSERT INTO `activo_pasivo_detalle` (`id_activo_pasivo_detalle`, `nombre_activo_pasivo_detalle`, `id_activo_pasivo_categoria`) VALUES
(1, 'Caja', 1),
(2, 'Bancos', 1),
(3, 'Inversiones temporales', 1),
(4, 'Mercancias, inventarios o almaces', 1),
(5, 'Clientes', 1),
(6, 'Documentos por pagar', 1),
(7, 'Deudores diversos', 1),
(8, 'Anticipo a proveedores', 1),
(9, 'Terrenos', 2),
(10, 'Edificios', 2),
(11, 'Mobiliario o equipo', 2),
(12, 'Equipo de computo electronico', 2),
(13, 'Equipo de entrega o reparto', 2),
(14, 'Depositos de garantia', 2),
(15, 'Inversiones permanentes', 2),
(16, 'Gastos de desarrollo', 3),
(17, 'Gastos de etapas preoperativas', 3),
(18, 'Gastos de mercadotecnia', 3),
(19, 'Gastos de organizacion', 3),
(20, 'Gastos de instalacion', 3),
(21, 'Papeleria y utiles', 3),
(22, 'Propoganda y publicidad', 3),
(23, 'Primas de seguros', 3),
(24, 'Intereses de pagos anticipados', 3),
(25, 'Proveedores', 4),
(26, 'Documentos por pagar', 4),
(27, 'Acreedores diversos', 4),
(28, 'Anticipos de clientes', 4),
(29, 'Gastos pendientes de pago', 4),
(30, 'Gastos acumulados', 4),
(31, 'Impuestos pendientes de pago', 4),
(32, 'Impuestos acumulados', 4),
(33, 'Hipotecas por pagar', 5),
(34, 'Hipotecarios', 5),
(35, 'Documentos por pagar', 5),
(36, 'Cuentas por pagar', 5),
(37, 'Rentas cobradas con anticipo', 6),
(38, 'Interes cobrados con anticipo', 6),
(39, 'Ventas cobradas con anticipo', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caf`
--

CREATE TABLE IF NOT EXISTS `caf` (
  `id_caf` int(11) NOT NULL AUTO_INCREMENT,
  `encriptacion_caf` varchar(255) NOT NULL,
  PRIMARY KEY (`id_caf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `caf`
--

INSERT INTO `caf` (`id_caf`, `encriptacion_caf`) VALUES
(1, '202cb962ac59075b964b07152d234b70'),
(2, '81dc9bdb52d04dc20036dbd8313ed055'),
(3, '4c56ff4ce4aaf9573aa5dff913df997a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
  `id_calificacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_calificacion` varchar(50) NOT NULL,
  `comentario_calificacion` varchar(50) NOT NULL,
  `rut_usuario` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_calificacion`),
  KEY `fk_id_calificacion_rut_usuario` (`rut_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contabilidad`
--

CREATE TABLE IF NOT EXISTS `contabilidad` (
  `id_contabilidad` int(11) NOT NULL AUTO_INCREMENT,
  `monto_contabilidad` int(11) NOT NULL,
  `fecha_contabilidad` date NOT NULL,
  `rut_usuario` varchar(50) DEFAULT NULL,
  `id_activo_pasivo_detalle` int(11) DEFAULT NULL,
  `iva_contabilidad` int(11) NOT NULL,
  `total_contabilidad` int(11) NOT NULL,
  PRIMARY KEY (`id_contabilidad`),
  KEY `fk_rut_usuario_contabilidad` (`rut_usuario`),
  KEY `fk_id_activo_pasivo_detalle_01` (`id_activo_pasivo_detalle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Volcado de datos para la tabla `contabilidad`
--

INSERT INTO `contabilidad` (`id_contabilidad`, `monto_contabilidad`, `fecha_contabilidad`, `rut_usuario`, `id_activo_pasivo_detalle`, `iva_contabilidad`, `total_contabilidad`) VALUES
(14, 12000, '2019-05-31', '19390359-2', 9, 2280, 14280),
(15, 15000, '2019-05-31', '19390359-2', 16, 2850, 17850),
(16, 9000, '2019-05-31', '19390359-2', 25, 1710, 10710),
(17, 1500, '2019-05-31', '19390359-2', 36, 285, 1785),
(18, 4500, '2019-05-31', '19390359-2', 1, 855, 5355),
(19, 1000, '2019-05-31', '19390359-2', 1, 190, 1190),
(20, 8000, '2019-05-31', '19390359-2', 25, 1520, 9520),
(22, 1000, '2019-05-31', '19390359-2', 1, 190, 1190),
(23, 2000, '2019-05-31', '19390359-2', 25, 380, 2380),
(24, 24000, '2019-06-01', '19390359-2', 25, 4560, 28560),
(25, 3000, '2019-06-02', '19390359-2', 19, 570, 3570),
(26, 10000, '2019-06-02', '19390359-2', 1, 1900, 11900),
(27, 4500, '2019-06-02', '19390359-2', 1, 855, 5355),
(28, 2000, '2019-06-02', '19390359-2', 25, 380, 2380),
(29, 12000, '2019-06-02', '19390359-2', 25, 2280, 14280),
(30, 10000, '2019-06-02', '19390359-2', 3, 1900, 11900),
(32, 1000, '2019-06-19', '19390359-2', 17, 190, 1190),
(33, 5600, '2019-06-19', '15499039-9', 2, 1064, 6664),
(34, 1000, '2019-06-20', '19390359-2', 1, 190, 1190),
(42, 1200, '2019-07-06', '19390359-2', 33, 228, 1428),
(44, 5000, '2019-07-06', '19390359-2', 1, 950, 5950),
(45, 10000, '2019-07-06', '19390359-2', 1, 1900, 11900),
(46, 14000, '2019-07-07', '19390359-2', 1, 2660, 16660),
(47, 1000, '2019-07-07', '19390359-2', 25, 190, 1190),
(48, 3240, '2019-07-07', '19390359-2', 1, 616, 3856),
(49, 3240, '2019-07-07', '19390359-2', 25, 616, 3856),
(50, 50000, '2019-07-10', '19390359-2', 1, 9500, 59500),
(51, 30000, '2019-07-10', '19390359-2', 1, 5700, 35700),
(52, 20000, '2019-07-10', '19390359-2', 1, 3800, 23800),
(53, 76234, '2019-07-10', '19390359-2', 1, 14484, 90718),
(56, 5000, '2019-12-07', '19390359-2', 1, 950, 5950),
(57, 3000, '2019-12-07', '19390359-2', 1, 570, 3570),
(58, 1500, '2019-12-07', '19390359-2', 25, 285, 1785),
(59, 1500, '2019-12-07', '19390359-2', 25, 285, 1785),
(60, 7500, '2019-12-07', '19390359-2', 5, 1425, 8925),
(61, 4560, '2019-12-07', '19390359-2', 1, 866, 5426),
(62, 5000, '2019-12-09', '19390359-2', 1, 950, 5950),
(63, 20000, '2019-12-09', '19390359-2', 25, 3800, 23800),
(64, 5000, '2019-12-11', '19390359-2', 1, 950, 5950),
(65, 3000, '2019-12-11', '19390359-2', 1, 570, 3570),
(66, 3000, '2019-12-11', '19390359-2', 25, 570, 3570);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido_factura`
--

CREATE TABLE IF NOT EXISTS `detalle_pedido_factura` (
  `id_pedido` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  PRIMARY KEY (`id_pedido`,`id_factura`),
  KEY `fk_id_factura` (`id_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_pedido_factura`
--

INSERT INTO `detalle_pedido_factura` (`id_pedido`, `id_factura`) VALUES
(1, 1),
(2, 3),
(15, 3),
(16, 5),
(17, 6),
(18, 7),
(19, 8),
(20, 9),
(21, 10),
(22, 11),
(23, 12),
(24, 13),
(25, 14),
(26, 15),
(27, 16),
(28, 17),
(29, 18),
(30, 19),
(31, 20),
(32, 21),
(33, 22),
(34, 23),
(35, 24),
(36, 25),
(37, 26),
(38, 27),
(39, 28),
(40, 29),
(41, 30),
(42, 31),
(43, 32),
(44, 33),
(45, 33),
(46, 33),
(48, 33),
(49, 33),
(50, 33),
(51, 33),
(52, 33),
(53, 33),
(58, 33),
(61, 33),
(63, 33),
(64, 33),
(65, 34),
(66, 34),
(67, 35),
(68, 36),
(69, 36),
(70, 36),
(71, 37),
(72, 38),
(73, 38),
(74, 39),
(75, 40),
(76, 40),
(77, 41),
(78, 41),
(79, 42),
(80, 42),
(81, 43),
(82, 43),
(83, 44),
(84, 44),
(85, 45),
(86, 46),
(87, 47);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_producto_pedido`
--

CREATE TABLE IF NOT EXISTS `detalle_producto_pedido` (
  `id_producto` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `cantidad_pedido` int(11) NOT NULL,
  `total_pedido` int(11) NOT NULL,
  `precio_cliente_pedido` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`,`id_pedido`),
  KEY `fk_id_producto_pedido_ii` (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_producto_pedido`
--

INSERT INTO `detalle_producto_pedido` (`id_producto`, `id_pedido`, `cantidad_pedido`, `total_pedido`, `precio_cliente_pedido`) VALUES
(1, 68, 3, 3000, 1000),
(1, 69, 7, 3500, 500),
(1, 70, 2, 1600, 800),
(1, 71, 2, 1000, 500),
(1, 72, 5, 3750, 750),
(1, 73, 2, 1300, 650),
(1, 74, 15, 9750, 650),
(1, 75, 42, 18900, 450),
(1, 76, 12, 5400, 450),
(1, 77, 8, 4480, 560),
(1, 79, 4, 2000, 500),
(1, 80, 12, 7800, 650),
(1, 81, 12, 7800, 650),
(1, 82, 3, 900, 300),
(1, 83, 3, 900, 300),
(1, 84, 3, 1500, 500),
(1, 85, 2, 1000, 500),
(1, 87, 5, 1500, 300),
(2, 78, 8, 6240, 780),
(2, 86, 3, 1500, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `rut_empresa` varchar(50) NOT NULL,
  `nombre_empresa` varchar(50) NOT NULL,
  `giro_comercial_empresa` varchar(50) NOT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `rut_empresa`, `nombre_empresa`, `giro_comercial_empresa`) VALUES
(1, '69507100-0', 'Panaderia Santa Ana', 'Panaderia y pasteleria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_elaboracion_factura` date NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_folio` int(11) NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `fk_id_empresa` (`id_empresa`),
  KEY `fk_id_folio` (`id_folio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `fecha_elaboracion_factura`, `id_empresa`, `id_folio`) VALUES
(1, '2019-10-26', 1, 1),
(3, '2019-10-26', 1, 2),
(4, '2019-10-26', 1, 2),
(5, '2019-11-28', 1, 2),
(6, '2019-11-28', 1, 2),
(7, '2019-11-28', 1, 2),
(8, '2019-11-30', 1, 2),
(9, '2019-11-30', 1, 2),
(10, '2019-11-30', 1, 2),
(11, '2019-11-30', 1, 2),
(12, '2019-11-30', 1, 2),
(13, '2019-11-30', 1, 2),
(14, '2019-11-30', 1, 2),
(15, '2019-11-30', 1, 2),
(16, '2019-11-30', 1, 2),
(17, '2019-11-30', 1, 2),
(18, '2019-11-30', 1, 2),
(19, '2019-11-30', 1, 2),
(20, '2019-11-30', 1, 2),
(21, '2019-11-30', 1, 2),
(22, '2019-11-30', 1, 2),
(23, '2019-11-30', 1, 2),
(24, '2019-11-30', 1, 2),
(25, '2019-11-30', 1, 2),
(26, '2019-11-30', 1, 2),
(27, '2019-11-30', 1, 2),
(28, '2019-11-30', 1, 2),
(29, '2019-11-30', 1, 2),
(30, '2019-11-30', 1, 2),
(31, '2019-11-30', 1, 2),
(32, '2019-11-30', 1, 2),
(33, '2019-11-30', 1, 2),
(34, '2019-11-30', 1, 2),
(35, '2019-11-30', 1, 2),
(36, '2019-11-30', 1, 2),
(37, '2019-11-30', 1, 2),
(38, '2019-11-30', 1, 2),
(39, '2019-11-30', 1, 2),
(40, '2019-11-30', 1, 2),
(41, '2019-11-30', 1, 2),
(42, '2019-12-03', 1, 2),
(43, '2019-12-07', 1, 2),
(44, '2019-12-09', 1, 2),
(45, '2019-12-11', 1, 2),
(46, '2019-12-11', 1, 2),
(47, '2019-12-12', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folio`
--

CREATE TABLE IF NOT EXISTS `folio` (
  `id_folio` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(50) NOT NULL,
  `estado_dis` int(11) NOT NULL,
  `estado_envio` int(11) NOT NULL,
  `estado_respuesta_sii` int(11) NOT NULL,
  `fecha_vigencia_folio` date NOT NULL,
  `id_caf` int(11) NOT NULL,
  PRIMARY KEY (`id_folio`),
  KEY `fk_id_caf` (`id_caf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `folio`
--

INSERT INTO `folio` (`id_folio`, `tipo_documento`, `estado_dis`, `estado_envio`, `estado_respuesta_sii`, `fecha_vigencia_folio`, `id_caf`) VALUES
(1, '33', 0, 0, 0, '2019-10-26', 1),
(2, '34', 0, 0, 0, '2019-10-26', 2),
(3, '33', 0, 0, 0, '2019-10-26', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo`
--

CREATE TABLE IF NOT EXISTS `insumo` (
  `id_insumo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_insumo_antigua` date NOT NULL,
  `inicial_insumo` int(11) NOT NULL,
  `compra_insumo` int(11) NOT NULL,
  `gasto_insumo` int(11) NOT NULL,
  `stock_insumo` int(11) NOT NULL,
  `fecha_insumo_actual` date NOT NULL,
  `id_lista_insumo` int(11) DEFAULT NULL,
  `rut_usuario` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_insumo`),
  KEY `fk_id_descripcion_insumo` (`id_lista_insumo`),
  KEY `fk_rut_usuario_insumo` (`rut_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `insumo`
--

INSERT INTO `insumo` (`id_insumo`, `fecha_insumo_antigua`, `inicial_insumo`, `compra_insumo`, `gasto_insumo`, `stock_insumo`, `fecha_insumo_actual`, `id_lista_insumo`, `rut_usuario`) VALUES
(16, '2019-06-19', 12, 13, 15, 10, '2019-06-19', 1, '15499039-9'),
(17, '2019-06-19', 4, 15, 16, 4, '2019-06-19', 2, '15499039-9'),
(18, '2019-06-19', 5, 17, 2, 20, '2019-12-07', 4, '15499039-9'),
(22, '2019-07-07', 20, 0, 5, 15, '2019-07-07', 3, '19390359-2'),
(25, '2019-12-07', 5, 0, 2, 3, '2019-12-07', 2, '19390359-2'),
(26, '2019-12-09', 5, 12, 13, 4, '2019-12-11', 2, '19390359-2'),
(27, '2019-12-11', 5, 0, 0, 5, '2019-12-11', 3, '19390359-2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_insumo`
--

CREATE TABLE IF NOT EXISTS `lista_insumo` (
  `id_lista_insumo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_lista_insumo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_lista_insumo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `lista_insumo`
--

INSERT INTO `lista_insumo` (`id_lista_insumo`, `nombre_lista_insumo`) VALUES
(1, 'Harina 15 KG'),
(2, 'Harina 25 KG'),
(3, 'Bicarbonato 3 KG'),
(4, 'Sal 10 KG'),
(5, 'Sal 5 KG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `rut_usuario_emisor` varchar(50) NOT NULL,
  `rut_usuario_receptor` varchar(50) NOT NULL,
  `titulo_mensaje` varchar(50) NOT NULL,
  `descripcion_mensaje` varchar(255) NOT NULL,
  `fecha_mensaje` date NOT NULL,
  `estado_mensaje` int(11) NOT NULL,
  PRIMARY KEY (`id_mensaje`),
  KEY `fk_rut_usuario_emisor` (`rut_usuario_emisor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id_mensaje`, `rut_usuario_emisor`, `rut_usuario_receptor`, `titulo_mensaje`, `descripcion_mensaje`, `fecha_mensaje`, `estado_mensaje`) VALUES
(5, '19390359-2', '9830768-0', 'test', 'test mama', '2019-06-04', 0),
(18, '19390359-2', '19389252-3', 'Bienvenido', 'Saludos.', '2019-07-07', 0),
(20, '16825934-4', '19154619-9', 'Hola', 'Me acabo de registrar.', '2019-07-10', 0),
(23, '19390359-2', '19389252-3', 'Test', 'Esto es una prueba', '2019-12-07', 0),
(24, '19390359-2', '19389252-3', 'Test', 'Prueba 2', '2019-12-07', 0),
(25, '19390359-2', '12561290-3', 'Gracias', 'Aumentamos las ventas', '2019-12-07', 0),
(26, '19390359-2', '6732307-6', 'test', 'test', '2019-12-09', 0),
(27, '6732307-6', '19390359-2', 'prueba', 'como estas', '2019-12-09', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `panadero`
--

CREATE TABLE IF NOT EXISTS `panadero` (
  `rut_persona` varchar(50) NOT NULL DEFAULT '',
  `tipo_panadero` varchar(50) NOT NULL,
  `jornada_panadero` varchar(50) NOT NULL,
  `estado_panadero` int(11) NOT NULL,
  PRIMARY KEY (`rut_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `panadero`
--

INSERT INTO `panadero` (`rut_persona`, `tipo_panadero`, `jornada_panadero`, `estado_panadero`) VALUES
('13202604-1', 'Hornero', 'Diurno', 0),
('16019545-2', 'Amasador', 'Diurna', 1),
('22064222-4', 'Hornero', 'Nocturna', 1),
('4438158-3', 'Coninero', 'Diurna', 1),
('5197775-0', 'Hornero', 'Noctura', 1),
('6932343-K', 'Hornero', 'Diurno', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pedido` datetime NOT NULL,
  `estado_pedido` int(11) NOT NULL,
  `rut_usuario` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_rut_usuario_caf` (`rut_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `fecha_pedido`, `estado_pedido`, `rut_usuario`) VALUES
(1, '2019-10-26 20:44:59', 0, '12561290-3'),
(2, '2019-10-26 20:49:06', 0, '13124800-8'),
(3, '2019-11-28 20:15:33', 0, '12561290-3'),
(4, '2019-11-28 20:17:44', 0, '13124800-8'),
(5, '2019-11-28 20:18:36', 0, '14006026-7'),
(6, '2019-11-28 20:22:55', 0, '13124800-8'),
(7, '2019-11-28 20:25:34', 0, '19390359-2'),
(8, '2019-11-28 20:25:46', 0, '19390359-2'),
(9, '2019-11-28 20:29:47', 0, '13279880-K'),
(10, '2019-11-28 20:32:08', 0, '12561290-3'),
(11, '2019-11-28 20:33:00', 0, '12561290-3'),
(12, '2019-11-28 20:34:33', 0, '15029547-5'),
(13, '2019-11-28 20:46:22', 0, '12561290-3'),
(14, '2019-11-28 20:48:36', 0, '12561290-3'),
(15, '2019-11-28 20:50:35', 0, '12561290-3'),
(16, '2019-11-28 21:09:37', 0, '12561290-3'),
(17, '2019-11-28 21:16:31', 0, '16628710-3'),
(18, '2019-11-28 21:31:49', 0, '12561290-3'),
(19, '2019-11-30 01:01:27', 0, '15029547-5'),
(20, '2019-11-30 02:35:06', 0, '13124800-8'),
(21, '2019-11-30 02:39:31', 0, '16628710-3'),
(22, '2019-11-30 03:12:14', 0, '16825934-4'),
(23, '2019-11-30 03:12:33', 0, '16825934-4'),
(24, '2019-11-30 03:17:02', 0, '6732307-6'),
(25, '2019-11-30 03:18:36', 0, '12561290-3'),
(26, '2019-11-30 03:18:43', 0, '12561290-3'),
(27, '2019-11-30 03:18:49', 0, '12561290-3'),
(28, '2019-11-30 03:20:43', 0, '12561290-3'),
(29, '2019-11-30 03:24:07', 0, '12561290-3'),
(30, '2019-11-30 03:24:22', 0, '12561290-3'),
(31, '2019-11-30 03:25:51', 0, '12561290-3'),
(32, '2019-11-30 03:32:56', 0, '14006026-7'),
(33, '2019-11-30 04:08:17', 0, '12561290-3'),
(34, '2019-11-30 04:09:02', 0, '12561290-3'),
(35, '2019-11-30 04:09:21', 0, '14006026-7'),
(36, '2019-11-30 04:32:04', 0, '12561290-3'),
(37, '2019-11-30 04:33:51', 0, '12561290-3'),
(38, '2019-11-30 04:38:16', 0, '12561290-3'),
(39, '2019-11-30 04:39:34', 0, '12561290-3'),
(40, '2019-11-30 04:40:41', 0, '12561290-3'),
(41, '2019-11-30 15:18:59', 0, '12561290-3'),
(42, '2019-11-30 15:19:19', 0, '12561290-3'),
(43, '2019-11-30 15:20:54', 0, '12561290-3'),
(44, '2019-11-30 15:21:03', 0, '12561290-3'),
(45, '2019-11-30 15:34:54', 0, '12561290-3'),
(46, '2019-11-30 15:35:08', 0, '12561290-3'),
(47, '2019-11-30 15:35:23', 0, '14006026-7'),
(48, '2019-11-30 15:37:59', 0, '12561290-3'),
(49, '2019-11-30 15:38:11', 0, '12561290-3'),
(50, '2019-11-30 15:38:45', 0, '12561290-3'),
(51, '2019-11-30 15:38:54', 0, '13279880-K'),
(52, '2019-11-30 15:40:46', 0, '12561290-3'),
(53, '2019-11-30 15:41:00', 0, '12561290-3'),
(54, '2019-11-30 15:44:01', 0, '12561290-3'),
(55, '2019-11-30 15:44:11', 0, '12561290-3'),
(56, '2019-11-30 15:44:19', 0, '12561290-3'),
(57, '2019-11-30 15:44:25', 0, '12561290-3'),
(58, '2019-11-30 15:46:26', 0, '12561290-3'),
(59, '2019-11-30 15:46:45', 0, '13279880-K'),
(60, '2019-11-30 15:46:55', 0, '12561290-3'),
(61, '2019-11-30 15:51:08', 0, '13279880-K'),
(62, '2019-11-30 15:51:23', 0, '13279880-K'),
(63, '2019-11-30 15:54:20', 0, '12561290-3'),
(64, '2019-11-30 15:54:42', 0, '12561290-3'),
(65, '2019-11-30 15:54:58', 0, '13124800-8'),
(66, '2019-11-30 15:55:20', 0, '13124800-8'),
(67, '2019-11-30 15:55:37', 0, '16628710-3'),
(68, '2019-11-30 16:00:43', 0, '12561290-3'),
(69, '2019-11-30 16:01:03', 0, '12561290-3'),
(70, '2019-11-30 16:01:15', 0, '12561290-3'),
(71, '2019-11-30 16:02:10', 0, '13279880-K'),
(72, '2019-11-30 16:02:26', 0, '16825934-4'),
(73, '2019-11-30 16:02:37', 0, '16825934-4'),
(74, '2019-11-30 16:03:01', 0, '6732307-6'),
(75, '2019-11-30 16:06:38', 0, '12561290-3'),
(76, '2019-11-30 16:19:37', 0, '12561290-3'),
(77, '2019-11-30 16:19:58', 0, '14006026-7'),
(78, '2019-11-30 16:20:32', 0, '14006026-7'),
(79, '2019-12-03 17:30:22', 0, '12561290-3'),
(80, '2019-12-07 20:44:35', 0, '12561290-3'),
(81, '2019-12-07 20:44:53', 0, '13124800-8'),
(82, '2019-12-09 20:14:08', 0, '13124800-8'),
(83, '2019-12-09 20:14:35', 0, '13279880-K'),
(84, '2019-12-11 22:50:52', 0, '13279880-K'),
(85, '2019-12-11 23:07:07', 0, '12561290-3'),
(86, '2019-12-11 23:47:31', 0, '14006026-7'),
(87, '2019-12-12 18:48:17', 0, '12561290-3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_perfil` varchar(50) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre_perfil`) VALUES
(1, 'Administrador'),
(2, 'Despachador'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `rut_persona` varchar(50) NOT NULL,
  `nombre_persona` varchar(50) NOT NULL,
  `apellido_persona` varchar(50) NOT NULL,
  `telefono_persona` varchar(50) NOT NULL,
  `correo_persona` varchar(50) NOT NULL,
  `direccion_persona` varchar(50) NOT NULL,
  PRIMARY KEY (`rut_persona`),
  UNIQUE KEY `rut_persona` (`rut_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`rut_persona`, `nombre_persona`, `apellido_persona`, `telefono_persona`, `correo_persona`, `direccion_persona`) VALUES
('12561290-3', 'Rodrigo', 'Palacios', '872783232', 'rpalacios92@gmail.com', '28 oriente'),
('13124800-8', 'Paulo Cesar', 'Diaz Poblete', '973632246', 'pdiaz29@gmail.com', 'Las colines #452'),
('13202604-1', 'Pedro Ignacio', 'Perez Rebolledo', '871271762', 'pperezr@gmail.com', '3 sur #584'),
('13279880-K', 'Jorge', 'Sansoval Files', '982387237', 'jfiles@gmail.com', 'Sta Teresita 830 P 20'),
('13441471-5', '123', '2121', '122121', '1122@gmail.com', '1221'),
('13688758-0', '11', '11', 'assa', 'as', 'assa'),
('14006026-7', 'Matias', 'Pedraza', '778848757', 'pedrazama10@gmail.com', 'Calle pájaros #123'),
('14345878-4', 'Pablo Joaquin', 'Diaz Gomez', '983129836', 'correo220@gmail.com', 'Calle 012'),
('14458765-0', '111111111111111111111111111111', '111', '111', '11', '111'),
('14592778-1', 'test', 'test', '837463833', 'matias@gmail.com', '28 oriente'),
('14754704-8', '111', '111', '111', '111', '111'),
('15029547-5', 'Ignacio', 'Cerpa Briones', '891981289', 'cerpab@outlook.es', '8 Oriente #6524'),
('15499039-9', 'Fernanda', 'Gallardo', '748373331', 'fgallardo@hotmail.com', 'Las rastras #2365'),
('15636837-7', 'Armando', 'Rodriguez Gomez', '987345672', 'armando1345@gmail.com', 'Calle alameda #456'),
('15882048-K', 'joaco', 'a', 'a', 'a', 'a'),
('16019545-2', 'Juan', 'Hormazabal', '635627682', 'chormaza@gmail.com', 'Maule #585'),
('16303922-2', 'juan', 'perez', '893489438', 'matiasmontoyapoblete@gmail.com', 'Maule #12'),
('16417924-9', 'Cristobal', 'Atria', '838662214', 'catria@gmail.com', '6 oriente #241'),
('16628710-3', 'Nicolas', 'Troncoso', '873232511', 'troncosonico10@outlook.es', 'Barrio oriente #1256'),
('16780757-7', '11111', '1', '1', '1', '1'),
('16825934-4', 'Pamela', 'Montoya', '783278378', 'matias.montoya.poblete@gmail.com', '123 calle las rastras.'),
('17968582-5', 'testij', 'testi', '2123', 'a@a.com', '123'),
('19154619-9', 'Camila', 'van Buuren', '837464322', 'camilav@gmail.com', 'Calle las rastras #123'),
('19389252-3', 'Homero', 'Perez', '673846221', 'homerop@gmail.com', '19 Oriente #452'),
('19390359-2', 'Matias', 'Montoya', '983006194', 'mmontoyap@gmail.com', '12 Oriente #469'),
('2-2', 'MA', 'MO', '+569', 'test@gmail.com', 'Calle 01'),
('22064222-4', 'Roberto', 'Pereira Sandoval', '736281221', 'psandoval10@gmail.com', 'Brisas del maule #1762'),
('23943213-1', 'Gladys', 'Piñera', '983006183', 'gpinera@gmail.com', 'Alameda #245'),
('2520807-2', 'Ignacio', 'Perez', '912358212', 'correo12@gmai.com', '6 Sur #456'),
('3776670-4', 'Domingo', 'Montoya', '837487553', 'matias.montoya.poblete@gmail.com', '28 Oriente'),
('4198356-6', 'Pedro', 'Funes', '974733142', 'machine@gmail.com', 'Barrio Ort. S/N.'),
('4438158-3', 'Rodrigo', 'Cid', '726376722', 'cidcid10@gmail.com', 'Maule #12'),
('4971685-0', '11', '11', '11', '11', '11'),
('5015452-1', '122112', '12121', 'asd', '2121', 'saassa'),
('5197775-0', 'Andres', 'Chadwick', '763543567', 'achad@hotmail.com', 'Unihue Km 2'),
('5279233-9', 'Jorge', 'Pedrero', '7839493', 'jpedrero123@hotmail.es', '8 sur #546'),
('6394822-5', 'sddsds', 'sasdaas', '123', 'a@a.com', '123'),
('6732307-6', 'Javiera', 'Vazquez', '984873683', 'jvazquez45@gmail.com', '6 Sur #456'),
('6744227-k', '11111', '1', '1', '1', '1'),
('6932343-K', 'Carmen', 'Loyola', '823787832', 'cloyola@gmail.com', 'Calle Paris #123'),
('6960368-8', 'Diego', 'Maureria', '948314355', 'testing@gmail.com', 'Calle nueva 123'),
('7092527-3', '11111', '1', '1', '1', '1'),
('7354141-7', 'Mario Cesar', 'Montoya Mena', '983647833', 'mmontoya47@gmail.com', '2 Sur #1357'),
('8089127-K', 'Domingo', 'Ruiz Tagle', '847859334', 'ruizdo@outlook.es', 'Sta Ines 2913 Casa 26'),
('8217755-8', 'Roman', 'Lopez Rodriguez', '587382873', 'lopezromanr@gmail.com', '32 sur #12'),
('8409278-9', 'Zelda Isidora', 'Perez Gomez', '984635521', 'zelda467@hotmail.es', 'Calle tortolos #583'),
('9015074-K', 'Juan', 'Perez', '847324533', 'jperez1293@hotmail.es', 'Calle #120'),
('930894-6', 'Juan Carlos', 'Perez Gomez', '+569133', 'correo01@gmail.com', 'Calle 57 #32'),
('9830768-0', 'Maria Ines', 'Poblete Gonzalez', '985348312', 'mariaines27@gmai.com', 'Calle 56 #34'),
('9911725-7', 'Jorge', 'Irarrazaval Gomez', '972779239', 'jirra@gmail.com', 'Maule #832');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_producto` varchar(50) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `tipo_producto`) VALUES
(1, 'Pan Corriente'),
(2, 'Pan Integral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidor`
--

CREATE TABLE IF NOT EXISTS `repartidor` (
  `rut_persona` varchar(50) NOT NULL DEFAULT '',
  `licencia_repartidor` varchar(50) NOT NULL,
  `estado_licencia_repartidor` varchar(50) NOT NULL,
  `estado_repartidor` int(11) NOT NULL,
  PRIMARY KEY (`rut_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `repartidor`
--

INSERT INTO `repartidor` (`rut_persona`, `licencia_repartidor`, `estado_licencia_repartidor`, `estado_repartidor`) VALUES
('16417924-9', 'Clase B', 'Al día', 1),
('5279233-9', 'Clase A1', 'Al día', 1),
('8217755-8', 'Clase B', 'Caducada', 0),
('8409278-9', 'Clase B', 'Al día', 1),
('9015074-K', 'Clase B', 'Al día', 1),
('9911725-7', 'Clase B', 'Al día', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidor_vehiculo`
--

CREATE TABLE IF NOT EXISTS `repartidor_vehiculo` (
  `rut_persona` varchar(50) NOT NULL,
  `patente_vehiculo` varchar(50) NOT NULL,
  `fecha_repartidor_vehiculo` date NOT NULL,
  PRIMARY KEY (`rut_persona`,`patente_vehiculo`),
  UNIQUE KEY `patente_vehiculo` (`patente_vehiculo`),
  UNIQUE KEY `rut_persona` (`rut_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `repartidor_vehiculo`
--

INSERT INTO `repartidor_vehiculo` (`rut_persona`, `patente_vehiculo`, `fecha_repartidor_vehiculo`) VALUES
('16417924-9', 'PK-08-92', '2019-10-30'),
('5279233-9', 'DZ-ST-21', '2019-12-07'),
('8217755-8', 'S1-23-12', '2019-12-07'),
('8409278-9', 'XS-S1-23', '2019-12-11'),
('9015074-K', 'S1-12-34', '2019-12-07'),
('9911725-7', 'SH-12-34', '2019-12-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE IF NOT EXISTS `ruta` (
  `id_ruta` int(11) NOT NULL AUTO_INCREMENT,
  `sector_ruta` varchar(50) NOT NULL,
  `destino_ruta` varchar(50) NOT NULL,
  `fecha_ruta_antigua` date NOT NULL,
  `fecha_ruta_actual` date NOT NULL,
  `estado_ruta` int(11) NOT NULL,
  `rut_persona_ruta` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ruta`),
  KEY `fk_rut_persona_ruta` (`rut_persona_ruta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`id_ruta`, `sector_ruta`, `destino_ruta`, `fecha_ruta_antigua`, `fecha_ruta_actual`, `estado_ruta`, `rut_persona_ruta`) VALUES
(1, 'Oriente', '14 Oriente #454', '2019-05-05', '2019-07-06', 1, '16417924-9'),
(2, 'Sur', 'Sur #12', '2019-08-21', '2019-07-10', 1, '16417924-9'),
(7, 'Oriente', '15 oriente #456', '2019-05-29', '2019-05-29', 1, '8409278-9'),
(8, 'Oriente', '12 Ort', '2019-06-16', '2019-12-07', 0, '5279233-9'),
(9, 'Oriente', '15 Ort #238', '2019-12-07', '2019-12-09', 0, '8217755-8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensor`
--

CREATE TABLE IF NOT EXISTS `sensor` (
  `id_sensor` int(11) NOT NULL AUTO_INCREMENT,
  `temperatura_sensor` varchar(50) NOT NULL,
  `humedad_sensor` varchar(50) NOT NULL,
  `fecha_sensor` date NOT NULL,
  `rut_usuario` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sensor`),
  KEY `fk_rut_usuario_sensor` (`rut_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=791 ;

--
-- Volcado de datos para la tabla `sensor`
--

INSERT INTO `sensor` (`id_sensor`, `temperatura_sensor`, `humedad_sensor`, `fecha_sensor`, `rut_usuario`) VALUES
(31, '26.6', '43', '2019-11-30', '19390359-2'),
(32, '26.6', '43', '2019-11-30', '19390359-2'),
(33, '26.6', '42', '2019-11-30', '19390359-2'),
(34, '26.6', '42', '2019-11-30', '19390359-2'),
(35, '26.7', '42', '2019-11-30', '19390359-2'),
(36, '26.7', '42', '2019-11-30', '19390359-2'),
(37, '26.6', '42', '2019-11-30', '19390359-2'),
(38, '26.6', '42', '2019-11-30', '19390359-2'),
(39, '26.7', '42', '2019-11-30', '19390359-2'),
(40, '26.4', '43', '2019-11-30', '19390359-2'),
(41, '26.4', '45', '2019-11-30', '19390359-2'),
(42, '26.4', '45', '2019-11-30', '19390359-2'),
(43, '26.3', '44', '2019-11-30', '19390359-2'),
(44, '26.4', '44', '2019-11-30', '19390359-2'),
(45, '26.6', '44', '2019-11-30', '19390359-2'),
(46, '26.5', '45', '2019-11-30', '19390359-2'),
(47, '26.5', '49', '2019-11-30', '19390359-2'),
(48, '26.4', '48', '2019-11-30', '19390359-2'),
(49, '26.4', '46', '2019-11-30', '19390359-2'),
(50, '26.6', '45', '2019-11-30', '19390359-2'),
(51, '26.6', '44', '2019-11-30', '19390359-2'),
(52, '26.9', '63', '2019-11-30', '19390359-2'),
(53, '26.8', '64', '2019-11-30', '19390359-2'),
(54, '27', '60', '2019-11-30', '19390359-2'),
(55, '27.1', '53', '2019-11-30', '19390359-2'),
(56, '27.1', '50', '2019-11-30', '19390359-2'),
(57, '27.2', '47', '2019-11-30', '19390359-2'),
(58, '27.3', '45', '2019-11-30', '19390359-2'),
(59, '27.3', '43', '2019-11-30', '19390359-2'),
(60, '27.3', '43', '2019-11-30', '19390359-2'),
(61, '27.3', '42', '2019-11-30', '19390359-2'),
(62, '23.5', '54', '2019-11-30', '19390359-2'),
(63, '26.3', '51', '2019-11-30', '19390359-2'),
(64, '26.3', '51', '2019-11-30', '19390359-2'),
(65, '26.3', '50', '2019-11-30', '19390359-2'),
(66, '26.4', '50', '2019-11-30', '19390359-2'),
(67, '26.4', '49', '2019-11-30', '19390359-2'),
(68, '26.4', '49', '2019-11-30', '19390359-2'),
(69, '26.4', '49', '2019-11-30', '19390359-2'),
(70, '26.4', '49', '2019-11-30', '19390359-2'),
(71, '26.4', '49', '2019-11-30', '19390359-2'),
(72, '26.4', '55', '2019-11-30', '19390359-2'),
(73, '26.6', '72', '2019-11-30', '19390359-2'),
(74, '26.9', '85', '2019-11-30', '19390359-2'),
(75, '27.2', '91', '2019-11-30', '19390359-2'),
(76, '27.4', '74', '2019-11-30', '19390359-2'),
(77, '27.7', '63', '2019-11-30', '19390359-2'),
(78, '27.7', '58', '2019-11-30', '19390359-2'),
(79, '27.8', '55', '2019-11-30', '19390359-2'),
(80, '26.4', '49', '2019-11-30', '19390359-2'),
(81, '26.4', '49', '2019-11-30', '19390359-2'),
(82, '26.5', '49', '2019-11-30', '19390359-2'),
(83, '26.5', '49', '2019-11-30', '19390359-2'),
(84, '26.5', '49', '2019-11-30', '19390359-2'),
(85, '26.6', '48', '2019-11-30', '19390359-2'),
(86, '26.6', '48', '2019-11-30', '19390359-2'),
(87, '26.6', '68', '2019-11-30', '19390359-2'),
(88, '27.1', '52', '2019-11-30', '19390359-2'),
(89, '27.1', '49', '2019-11-30', '19390359-2'),
(90, '27.2', '48', '2019-11-30', '19390359-2'),
(91, '27.3', '47', '2019-11-30', '19390359-2'),
(92, '27.2', '47', '2019-11-30', '19390359-2'),
(93, '27.2', '47', '2019-11-30', '19390359-2'),
(94, '27.2', '47', '2019-11-30', '19390359-2'),
(95, '27.2', '48', '2019-11-30', '19390359-2'),
(96, '27.2', '48', '2019-11-30', '19390359-2'),
(97, '27.1', '48', '2019-11-30', '19390359-2'),
(98, '27.1', '50', '2019-11-30', '19390359-2'),
(99, '27.1', '49', '2019-11-30', '19390359-2'),
(100, '27.1', '48', '2019-11-30', '19390359-2'),
(101, '27.2', '48', '2019-11-30', '19390359-2'),
(102, '27.1', '47', '2019-11-30', '19390359-2'),
(103, '27.1', '47', '2019-11-30', '19390359-2'),
(104, '27.1', '47', '2019-11-30', '19390359-2'),
(105, '27', '47', '2019-11-30', '19390359-2'),
(106, '27.1', '47', '2019-11-30', '19390359-2'),
(107, '27', '47', '2019-11-30', '19390359-2'),
(108, '27.1', '47', '2019-11-30', '19390359-2'),
(109, '27.1', '47', '2019-11-30', '19390359-2'),
(110, '27', '46', '2019-11-30', '19390359-2'),
(111, '26.9', '46', '2019-11-30', '19390359-2'),
(112, '27', '46', '2019-11-30', '19390359-2'),
(113, '27', '46', '2019-11-30', '19390359-2'),
(114, '26.9', '46', '2019-11-30', '19390359-2'),
(115, '26.9', '47', '2019-11-30', '19390359-2'),
(116, '26.8', '46', '2019-11-30', '19390359-2'),
(117, '26.9', '46', '2019-11-30', '19390359-2'),
(118, '26.9', '47', '2019-11-30', '19390359-2'),
(119, '26.9', '46', '2019-11-30', '19390359-2'),
(120, '26.8', '47', '2019-11-30', '19390359-2'),
(121, '26.9', '48', '2019-11-30', '19390359-2'),
(122, '26.9', '48', '2019-11-30', '19390359-2'),
(123, '26.9', '48', '2019-11-30', '19390359-2'),
(124, '26.8', '48', '2019-11-30', '19390359-2'),
(125, '26.9', '48', '2019-11-30', '19390359-2'),
(126, '26.9', '48', '2019-11-30', '19390359-2'),
(127, '26.8', '47', '2019-11-30', '19390359-2'),
(128, '26.8', '46', '2019-11-30', '19390359-2'),
(129, '26.8', '47', '2019-11-30', '19390359-2'),
(130, '26.9', '46', '2019-11-30', '19390359-2'),
(131, '26.8', '48', '2019-11-30', '19390359-2'),
(132, '26.8', '47', '2019-11-30', '19390359-2'),
(133, '26.8', '47', '2019-11-30', '19390359-2'),
(134, '26.8', '47', '2019-11-30', '19390359-2'),
(135, '26.8', '47', '2019-11-30', '19390359-2'),
(136, '26.8', '48', '2019-11-30', '19390359-2'),
(137, '26.8', '49', '2019-11-30', '19390359-2'),
(138, '26.8', '48', '2019-11-30', '19390359-2'),
(139, '26.8', '48', '2019-11-30', '19390359-2'),
(140, '26.8', '47', '2019-11-30', '19390359-2'),
(141, '26.8', '47', '2019-11-30', '19390359-2'),
(142, '26.9', '47', '2019-11-30', '19390359-2'),
(143, '27.2', '49', '2019-11-30', '19390359-2'),
(144, '27.3', '48', '2019-11-30', '19390359-2'),
(145, '27.3', '47', '2019-11-30', '19390359-2'),
(146, '27.4', '48', '2019-11-30', '19390359-2'),
(147, '27.3', '47', '2019-11-30', '19390359-2'),
(148, '27.3', '46', '2019-11-30', '19390359-2'),
(149, '27.3', '46', '2019-11-30', '19390359-2'),
(150, '27.3', '47', '2019-11-30', '19390359-2'),
(151, '27.2', '50', '2019-11-30', '19390359-2'),
(152, '27.3', '47', '2019-11-30', '19390359-2'),
(153, '27.4', '47', '2019-11-30', '19390359-2'),
(154, '27.4', '47', '2019-11-30', '19390359-2'),
(155, '27.4', '46', '2019-11-30', '19390359-2'),
(156, '27.4', '45', '2019-11-30', '19390359-2'),
(157, '27.4', '46', '2019-11-30', '19390359-2'),
(158, '27.3', '47', '2019-11-30', '19390359-2'),
(159, '27.4', '46', '2019-11-30', '19390359-2'),
(160, '27.3', '46', '2019-11-30', '19390359-2'),
(161, '27.4', '46', '2019-11-30', '19390359-2'),
(162, '27.5', '61', '2019-11-30', '19390359-2'),
(163, '27.8', '57', '2019-11-30', '19390359-2'),
(164, '27.8', '50', '2019-11-30', '19390359-2'),
(165, '27.8', '48', '2019-11-30', '19390359-2'),
(166, '27.7', '47', '2019-11-30', '19390359-2'),
(167, '27.7', '46', '2019-11-30', '19390359-2'),
(168, '27.7', '46', '2019-11-30', '19390359-2'),
(169, '27.2', '62', '2019-11-30', '19390359-2'),
(170, '27.6', '47', '2019-11-30', '19390359-2'),
(171, '27.6', '45', '2019-11-30', '19390359-2'),
(172, '27.7', '46', '2019-11-30', '19390359-2'),
(173, '27.6', '45', '2019-11-30', '19390359-2'),
(174, '27.6', '45', '2019-11-30', '19390359-2'),
(175, '27.5', '50', '2019-11-30', '19390359-2'),
(176, '27.6', '48', '2019-11-30', '19390359-2'),
(177, '27.6', '45', '2019-11-30', '19390359-2'),
(178, '27.7', '44', '2019-11-30', '19390359-2'),
(179, '28', '53', '2019-11-30', '19390359-2'),
(180, '28.1', '48', '2019-11-30', '19390359-2'),
(181, '28.1', '45', '2019-11-30', '19390359-2'),
(182, '28.1', '45', '2019-11-30', '19390359-2'),
(183, '28.1', '45', '2019-11-30', '19390359-2'),
(184, '28.2', '46', '2019-11-30', '19390359-2'),
(185, '28.1', '46', '2019-11-30', '19390359-2'),
(186, '28.3', '49', '2019-11-30', '19390359-2'),
(187, '28.3', '47', '2019-11-30', '19390359-2'),
(188, '28.3', '44', '2019-11-30', '19390359-2'),
(189, '28.3', '44', '2019-11-30', '19390359-2'),
(190, '28.2', '44', '2019-11-30', '19390359-2'),
(191, '28.3', '43', '2019-11-30', '19390359-2'),
(192, '28.2', '43', '2019-11-30', '19390359-2'),
(193, '28.1', '43', '2019-11-30', '19390359-2'),
(194, '28', '43', '2019-11-30', '19390359-2'),
(195, '27.9', '42', '2019-11-30', '19390359-2'),
(196, '27.8', '42', '2019-11-30', '19390359-2'),
(197, '27.8', '42', '2019-11-30', '19390359-2'),
(198, '27.8', '42', '2019-11-30', '19390359-2'),
(199, '27.7', '42', '2019-11-30', '19390359-2'),
(200, '27.7', '53', '2019-11-30', '19390359-2'),
(201, '27.7', '47', '2019-11-30', '19390359-2'),
(202, '27.8', '46', '2019-11-30', '19390359-2'),
(203, '27.8', '45', '2019-11-30', '19390359-2'),
(204, '27.8', '45', '2019-11-30', '19390359-2'),
(205, '27.7', '44', '2019-11-30', '19390359-2'),
(206, '27.7', '44', '2019-11-30', '19390359-2'),
(207, '27.7', '44', '2019-11-30', '19390359-2'),
(208, '27.7', '45', '2019-11-30', '19390359-2'),
(209, '27.7', '44', '2019-11-30', '19390359-2'),
(210, '27.6', '45', '2019-11-30', '19390359-2'),
(211, '27.6', '44', '2019-11-30', '19390359-2'),
(212, '27.6', '44', '2019-11-30', '19390359-2'),
(213, '27.6', '46', '2019-11-30', '19390359-2'),
(214, '27.5', '45', '2019-11-30', '19390359-2'),
(215, '27.5', '46', '2019-11-30', '19390359-2'),
(216, '27.6', '43', '2019-11-30', '19390359-2'),
(217, '27.3', '44', '2019-11-30', '19390359-2'),
(218, '27.3', '44', '2019-11-30', '19390359-2'),
(219, '27.4', '45', '2019-11-30', '19390359-2'),
(220, '27.3', '46', '2019-11-30', '19390359-2'),
(221, '27.3', '47', '2019-11-30', '19390359-2'),
(222, '27.3', '46', '2019-11-30', '19390359-2'),
(223, '27.3', '45', '2019-11-30', '19390359-2'),
(224, '27.3', '45', '2019-11-30', '19390359-2'),
(225, '27.3', '44', '2019-11-30', '19390359-2'),
(226, '27.3', '47', '2019-11-30', '19390359-2'),
(227, '27.2', '46', '2019-11-30', '19390359-2'),
(228, '27.2', '45', '2019-11-30', '19390359-2'),
(229, '27.2', '45', '2019-11-30', '19390359-2'),
(230, '27.2', '46', '2019-11-30', '19390359-2'),
(231, '27.2', '46', '2019-11-30', '19390359-2'),
(232, '27.2', '45', '2019-11-30', '19390359-2'),
(233, '27.2', '46', '2019-11-30', '19390359-2'),
(234, '27.2', '45', '2019-11-30', '19390359-2'),
(235, '27.2', '46', '2019-11-30', '19390359-2'),
(236, '27.2', '45', '2019-11-30', '19390359-2'),
(237, '27.2', '45', '2019-11-30', '19390359-2'),
(238, '27.2', '45', '2019-11-30', '19390359-2'),
(239, '27.2', '45', '2019-11-30', '19390359-2'),
(240, '27.2', '45', '2019-11-30', '19390359-2'),
(241, '27.2', '44', '2019-11-30', '19390359-2'),
(242, '27.2', '45', '2019-11-30', '19390359-2'),
(243, '27.2', '45', '2019-11-30', '19390359-2'),
(244, '27.2', '44', '2019-11-30', '19390359-2'),
(245, '27.1', '45', '2019-11-30', '19390359-2'),
(246, '27.2', '46', '2019-11-30', '19390359-2'),
(247, '27.2', '46', '2019-11-30', '19390359-2'),
(248, '27.2', '45', '2019-11-30', '19390359-2'),
(249, '27.2', '45', '2019-11-30', '19390359-2'),
(250, '27.2', '46', '2019-11-30', '19390359-2'),
(251, '27.2', '45', '2019-11-30', '19390359-2'),
(252, '27.1', '45', '2019-11-30', '19390359-2'),
(253, '27.2', '46', '2019-11-30', '19390359-2'),
(254, '27.1', '46', '2019-11-30', '19390359-2'),
(255, '27.1', '46', '2019-11-30', '19390359-2'),
(256, '27.1', '46', '2019-11-30', '19390359-2'),
(257, '27.1', '45', '2019-11-30', '19390359-2'),
(258, '27.1', '45', '2019-11-30', '19390359-2'),
(259, '27.1', '44', '2019-11-30', '19390359-2'),
(260, '27.1', '45', '2019-11-30', '19390359-2'),
(261, '27.1', '46', '2019-11-30', '19390359-2'),
(262, '27.9', '40', '2019-12-07', '19390359-2'),
(263, '27.8', '40', '2019-12-07', '19390359-2'),
(264, '27.9', '39', '2019-12-07', '19390359-2'),
(265, '27.8', '43', '2019-12-07', '19390359-2'),
(266, '27.8', '40', '2019-12-07', '19390359-2'),
(267, '27.8', '40', '2019-12-07', '19390359-2'),
(268, '27.8', '40', '2019-12-07', '19390359-2'),
(269, '27.8', '40', '2019-12-07', '19390359-2'),
(270, '27.8', '40', '2019-12-07', '19390359-2'),
(271, '27.8', '44', '2019-12-07', '19390359-2'),
(272, '27.8', '44', '2019-12-07', '19390359-2'),
(273, '28.6', '95', '2019-12-07', '19390359-2'),
(274, '28.3', '58', '2019-12-07', '19390359-2'),
(278, '27.4', '41', '2019-12-07', '19390359-2'),
(279, '27.5', '40', '2019-12-07', '19390359-2'),
(280, '27.6', '40', '2019-12-07', '19390359-2'),
(281, '27.6', '40', '2019-12-07', '19390359-2'),
(282, '26.8', '43', '2019-12-07', '19390359-2'),
(283, '26.7', '43', '2019-12-07', '19390359-2'),
(284, '26.7', '42', '2019-12-07', '19390359-2'),
(285, '26.6', '43', '2019-12-07', '19390359-2'),
(286, '26.7', '43', '2019-12-07', '19390359-2'),
(287, '26.7', '43', '2019-12-07', '19390359-2'),
(288, '26.7', '43', '2019-12-07', '19390359-2'),
(289, '26.7', '43', '2019-12-07', '19390359-2'),
(290, '26.6', '44', '2019-12-07', '19390359-2'),
(291, '26.5', '44', '2019-12-07', '19390359-2'),
(292, '26.6', '44', '2019-12-07', '19390359-2'),
(293, '26.6', '43', '2019-12-07', '19390359-2'),
(294, '26.5', '43', '2019-12-07', '19390359-2'),
(295, '26.6', '43', '2019-12-07', '19390359-2'),
(296, '26.6', '43', '2019-12-07', '19390359-2'),
(297, '26.4', '44', '2019-12-07', '19390359-2'),
(298, '26.4', '44', '2019-12-07', '19390359-2'),
(299, '26.6', '44', '2019-12-07', '19390359-2'),
(300, '26.5', '43', '2019-12-07', '19390359-2'),
(301, '26.6', '43', '2019-12-07', '19390359-2'),
(302, '26.6', '43', '2019-12-07', '19390359-2'),
(303, '26.5', '43', '2019-12-07', '19390359-2'),
(304, '26.6', '43', '2019-12-07', '19390359-2'),
(305, '26.6', '43', '2019-12-07', '19390359-2'),
(306, '26.6', '43', '2019-12-07', '19390359-2'),
(307, '26.7', '43', '2019-12-07', '19390359-2'),
(308, '26.7', '43', '2019-12-07', '19390359-2'),
(309, '26.7', '43', '2019-12-07', '19390359-2'),
(310, '26.6', '43', '2019-12-07', '19390359-2'),
(311, '26.6', '43', '2019-12-07', '19390359-2'),
(312, '26.7', '43', '2019-12-07', '19390359-2'),
(313, '26.6', '43', '2019-12-07', '19390359-2'),
(314, '26.6', '43', '2019-12-07', '19390359-2'),
(315, '26.6', '43', '2019-12-07', '19390359-2'),
(316, '26.7', '43', '2019-12-07', '19390359-2'),
(317, '26.7', '43', '2019-12-07', '19390359-2'),
(318, '26.7', '43', '2019-12-07', '19390359-2'),
(319, '26.7', '43', '2019-12-07', '19390359-2'),
(320, '26.7', '43', '2019-12-07', '19390359-2'),
(321, '26.7', '43', '2019-12-07', '19390359-2'),
(322, '26.6', '43', '2019-12-07', '19390359-2'),
(323, '26.5', '43', '2019-12-07', '19390359-2'),
(324, '26.6', '43', '2019-12-07', '19390359-2'),
(325, '26.6', '43', '2019-12-07', '19390359-2'),
(326, '26.7', '43', '2019-12-07', '19390359-2'),
(327, '26.6', '43', '2019-12-07', '19390359-2'),
(328, '26.6', '43', '2019-12-07', '19390359-2'),
(329, '26.7', '43', '2019-12-07', '19390359-2'),
(330, '26.6', '43', '2019-12-07', '19390359-2'),
(331, '26.6', '43', '2019-12-07', '19390359-2'),
(332, '26.7', '43', '2019-12-07', '19390359-2'),
(333, '26.6', '43', '2019-12-07', '19390359-2'),
(334, '26.6', '42', '2019-12-07', '19390359-2'),
(335, '26.6', '44', '2019-12-07', '19390359-2'),
(336, '26.6', '48', '2019-12-07', '19390359-2'),
(337, '26.8', '50', '2019-12-07', '19390359-2'),
(338, '26.8', '50', '2019-12-07', '19390359-2'),
(339, '27', '50', '2019-12-07', '19390359-2'),
(340, '26.9', '50', '2019-12-07', '19390359-2'),
(341, '27.2', '44', '2019-12-07', '19390359-2'),
(342, '27.3', '42', '2019-12-07', '19390359-2'),
(343, '27.3', '41', '2019-12-07', '19390359-2'),
(344, '26.9', '42', '2019-12-07', '19390359-2'),
(345, '26.9', '42', '2019-12-07', '19390359-2'),
(346, '26.9', '42', '2019-12-07', '19390359-2'),
(347, '26.9', '42', '2019-12-07', '19390359-2'),
(348, '26.9', '41', '2019-12-07', '19390359-2'),
(349, '26.9', '42', '2019-12-07', '19390359-2'),
(350, '26.9', '42', '2019-12-07', '19390359-2'),
(351, '26.9', '42', '2019-12-07', '19390359-2'),
(352, '26.9', '42', '2019-12-07', '19390359-2'),
(353, '27', '42', '2019-12-07', '19390359-2'),
(354, '26.9', '42', '2019-12-07', '19390359-2'),
(355, '26.9', '42', '2019-12-07', '19390359-2'),
(356, '26.9', '42', '2019-12-07', '19390359-2'),
(357, '26.9', '42', '2019-12-07', '19390359-2'),
(358, '26.9', '42', '2019-12-07', '19390359-2'),
(359, '26.9', '42', '2019-12-07', '19390359-2'),
(360, '26.9', '42', '2019-12-07', '19390359-2'),
(361, '26.9', '42', '2019-12-07', '19390359-2'),
(362, '26.9', '42', '2019-12-07', '19390359-2'),
(363, '27.2', '42', '2019-12-07', '19390359-2'),
(364, '27.2', '42', '2019-12-07', '19390359-2'),
(365, '27.3', '42', '2019-12-07', '19390359-2'),
(366, '27.3', '42', '2019-12-07', '19390359-2'),
(367, '27.3', '42', '2019-12-07', '19390359-2'),
(368, '27.4', '42', '2019-12-07', '19390359-2'),
(369, '27.3', '42', '2019-12-07', '19390359-2'),
(370, '27.4', '41', '2019-12-07', '19390359-2'),
(371, '27.4', '41', '2019-12-07', '19390359-2'),
(372, '27.4', '41', '2019-12-07', '19390359-2'),
(373, '27.6', '41', '2019-12-07', '19390359-2'),
(374, '27.4', '41', '2019-12-07', '19390359-2'),
(375, '27.4', '41', '2019-12-07', '19390359-2'),
(376, '27.5', '41', '2019-12-07', '19390359-2'),
(377, '27.6', '41', '2019-12-07', '19390359-2'),
(378, '27.5', '41', '2019-12-07', '19390359-2'),
(379, '27.5', '41', '2019-12-07', '19390359-2'),
(380, '27.5', '41', '2019-12-07', '19390359-2'),
(381, '27.5', '41', '2019-12-07', '19390359-2'),
(382, '27.7', '41', '2019-12-07', '19390359-2'),
(383, '27.5', '41', '2019-12-07', '19390359-2'),
(384, '27.5', '41', '2019-12-07', '19390359-2'),
(385, '27.6', '41', '2019-12-07', '19390359-2'),
(386, '27.6', '41', '2019-12-07', '19390359-2'),
(387, '27.4', '41', '2019-12-07', '19390359-2'),
(388, '27.6', '42', '2019-12-07', '19390359-2'),
(389, '27.6', '42', '2019-12-07', '19390359-2'),
(390, '27.6', '41', '2019-12-07', '19390359-2'),
(391, '27.6', '41', '2019-12-07', '19390359-2'),
(392, '27.6', '41', '2019-12-07', '19390359-2'),
(393, '27.6', '41', '2019-12-07', '19390359-2'),
(394, '27.6', '41', '2019-12-07', '19390359-2'),
(395, '27.6', '41', '2019-12-07', '19390359-2'),
(396, '27.6', '41', '2019-12-07', '19390359-2'),
(397, '27.6', '41', '2019-12-07', '19390359-2'),
(398, '27.6', '41', '2019-12-07', '19390359-2'),
(399, '27.7', '41', '2019-12-07', '19390359-2'),
(400, '27.7', '41', '2019-12-07', '19390359-2'),
(401, '27.7', '41', '2019-12-07', '19390359-2'),
(402, '27.7', '41', '2019-12-07', '19390359-2'),
(403, '27.6', '41', '2019-12-07', '19390359-2'),
(404, '27.4', '42', '2019-12-07', '19390359-2'),
(405, '27.4', '42', '2019-12-07', '19390359-2'),
(406, '27.5', '42', '2019-12-07', '19390359-2'),
(407, '27.5', '42', '2019-12-07', '19390359-2'),
(408, '27.5', '41', '2019-12-07', '19390359-2'),
(409, '27.5', '41', '2019-12-07', '19390359-2'),
(410, '27.6', '42', '2019-12-07', '19390359-2'),
(411, '27.6', '41', '2019-12-07', '19390359-2'),
(412, '27.6', '41', '2019-12-07', '19390359-2'),
(413, '27.6', '42', '2019-12-07', '19390359-2'),
(414, '27.6', '42', '2019-12-07', '19390359-2'),
(415, '27.7', '42', '2019-12-07', '19390359-2'),
(416, '27.6', '42', '2019-12-07', '19390359-2'),
(417, '27.6', '42', '2019-12-07', '19390359-2'),
(418, '27.6', '42', '2019-12-07', '19390359-2'),
(419, '27.6', '42', '2019-12-07', '19390359-2'),
(420, '27.6', '41', '2019-12-07', '19390359-2'),
(421, '27.6', '41', '2019-12-07', '19390359-2'),
(422, '27.6', '41', '2019-12-07', '19390359-2'),
(423, '27.7', '41', '2019-12-07', '19390359-2'),
(424, '27.6', '41', '2019-12-07', '19390359-2'),
(425, '27.7', '41', '2019-12-07', '19390359-2'),
(426, '27.6', '41', '2019-12-07', '19390359-2'),
(427, '27.7', '41', '2019-12-07', '19390359-2'),
(428, '27.7', '41', '2019-12-07', '19390359-2'),
(429, '27.7', '41', '2019-12-07', '19390359-2'),
(430, '27.7', '41', '2019-12-07', '19390359-2'),
(431, '27.7', '41', '2019-12-07', '19390359-2'),
(432, '27.8', '41', '2019-12-07', '19390359-2'),
(433, '27.7', '41', '2019-12-07', '19390359-2'),
(434, '27.7', '41', '2019-12-07', '19390359-2'),
(435, '27.2', '43', '2019-12-07', '19390359-2'),
(436, '27.2', '43', '2019-12-07', '19390359-2'),
(437, '27.3', '43', '2019-12-07', '19390359-2'),
(438, '27.2', '43', '2019-12-07', '19390359-2'),
(439, '27.2', '43', '2019-12-07', '19390359-2'),
(440, '27.3', '43', '2019-12-07', '19390359-2'),
(441, '27.2', '43', '2019-12-07', '19390359-2'),
(442, '27.3', '43', '2019-12-07', '19390359-2'),
(443, '27.3', '43', '2019-12-07', '19390359-2'),
(444, '27.2', '43', '2019-12-07', '19390359-2'),
(445, '27.3', '43', '2019-12-07', '19390359-2'),
(446, '27.3', '43', '2019-12-07', '19390359-2'),
(447, '27.3', '43', '2019-12-07', '19390359-2'),
(448, '27.3', '43', '2019-12-07', '19390359-2'),
(449, '27.3', '43', '2019-12-07', '19390359-2'),
(450, '27.4', '43', '2019-12-07', '19390359-2'),
(451, '27.2', '43', '2019-12-07', '19390359-2'),
(452, '27.2', '43', '2019-12-07', '19390359-2'),
(453, '27.2', '42', '2019-12-07', '19390359-2'),
(454, '27.3', '43', '2019-12-07', '19390359-2'),
(455, '27.3', '42', '2019-12-07', '19390359-2'),
(456, '27.3', '43', '2019-12-07', '19390359-2'),
(457, '27.2', '42', '2019-12-07', '19390359-2'),
(458, '27.3', '42', '2019-12-07', '19390359-2'),
(459, '27.3', '42', '2019-12-07', '19390359-2'),
(460, '27.3', '43', '2019-12-07', '19390359-2'),
(461, '27.3', '42', '2019-12-07', '19390359-2'),
(462, '27.3', '42', '2019-12-07', '19390359-2'),
(463, '27.3', '43', '2019-12-07', '19390359-2'),
(464, '27.3', '43', '2019-12-07', '19390359-2'),
(465, '27.3', '42', '2019-12-07', '19390359-2'),
(466, '27.3', '42', '2019-12-07', '19390359-2'),
(467, '27.3', '42', '2019-12-07', '19390359-2'),
(468, '27.3', '43', '2019-12-07', '19390359-2'),
(469, '27.4', '43', '2019-12-07', '19390359-2'),
(470, '27.3', '43', '2019-12-07', '19390359-2'),
(471, '27.3', '42', '2019-12-07', '19390359-2'),
(472, '27.3', '42', '2019-12-07', '19390359-2'),
(473, '27.3', '42', '2019-12-07', '19390359-2'),
(474, '27.3', '42', '2019-12-07', '19390359-2'),
(475, '27.3', '42', '2019-12-07', '19390359-2'),
(476, '27.3', '42', '2019-12-07', '19390359-2'),
(477, '27.3', '42', '2019-12-07', '19390359-2'),
(478, '27.4', '42', '2019-12-07', '19390359-2'),
(479, '27.3', '42', '2019-12-07', '19390359-2'),
(480, '27.3', '42', '2019-12-07', '19390359-2'),
(481, '27.3', '42', '2019-12-07', '19390359-2'),
(482, '27.3', '42', '2019-12-07', '19390359-2'),
(483, '27.3', '42', '2019-12-07', '19390359-2'),
(484, '27.3', '42', '2019-12-07', '19390359-2'),
(485, '27.3', '42', '2019-12-07', '19390359-2'),
(486, '27.3', '42', '2019-12-07', '19390359-2'),
(487, '27.3', '43', '2019-12-07', '19390359-2'),
(488, '27.3', '42', '2019-12-07', '19390359-2'),
(489, '27.3', '42', '2019-12-07', '19390359-2'),
(490, '27.4', '43', '2019-12-07', '19390359-2'),
(491, '27.3', '42', '2019-12-07', '19390359-2'),
(492, '27.3', '42', '2019-12-07', '19390359-2'),
(493, '27.3', '42', '2019-12-07', '19390359-2'),
(494, '27.3', '42', '2019-12-07', '19390359-2'),
(495, '27.4', '56', '2019-12-07', '19390359-2'),
(496, '27.6', '69', '2019-12-07', '19390359-2'),
(497, '27.7', '64', '2019-12-07', '19390359-2'),
(498, '28.2', '50', '2019-12-07', '19390359-2'),
(499, '28.3', '46', '2019-12-07', '19390359-2'),
(500, '28.4', '44', '2019-12-07', '19390359-2'),
(501, '28.4', '42', '2019-12-07', '19390359-2'),
(502, '28.4', '41', '2019-12-07', '19390359-2'),
(503, '28.3', '41', '2019-12-07', '19390359-2'),
(504, '27.5', '42', '2019-12-07', '19390359-2'),
(505, '27.4', '42', '2019-12-07', '19390359-2'),
(506, '27.4', '42', '2019-12-07', '19390359-2'),
(507, '27.4', '41', '2019-12-07', '19390359-2'),
(508, '27.5', '41', '2019-12-07', '19390359-2'),
(509, '27.5', '41', '2019-12-07', '19390359-2'),
(510, '27.5', '41', '2019-12-07', '19390359-2'),
(511, '27.5', '41', '2019-12-07', '19390359-2'),
(512, '27.4', '41', '2019-12-07', '19390359-2'),
(513, '27.3', '42', '2019-12-07', '19390359-2'),
(514, '27.2', '42', '2019-12-07', '19390359-2'),
(515, '27.3', '42', '2019-12-07', '19390359-2'),
(516, '27.3', '42', '2019-12-07', '19390359-2'),
(517, '27.3', '42', '2019-12-07', '19390359-2'),
(518, '27.4', '41', '2019-12-07', '19390359-2'),
(519, '27.4', '41', '2019-12-07', '19390359-2'),
(520, '27.4', '41', '2019-12-07', '19390359-2'),
(521, '27.3', '42', '2019-12-07', '19390359-2'),
(522, '27.4', '42', '2019-12-07', '19390359-2'),
(523, '27.4', '42', '2019-12-07', '19390359-2'),
(524, '27.4', '42', '2019-12-07', '19390359-2'),
(525, '27.4', '42', '2019-12-07', '19390359-2'),
(526, '27.4', '42', '2019-12-07', '19390359-2'),
(527, '27.4', '41', '2019-12-07', '19390359-2'),
(528, '27.4', '41', '2019-12-07', '19390359-2'),
(529, '27.4', '41', '2019-12-07', '19390359-2'),
(530, '27.4', '41', '2019-12-07', '19390359-2'),
(531, '27.4', '42', '2019-12-07', '19390359-2'),
(532, '27.4', '42', '2019-12-07', '19390359-2'),
(533, '27.4', '42', '2019-12-07', '19390359-2'),
(534, '27.4', '41', '2019-12-07', '19390359-2'),
(535, '27.4', '41', '2019-12-07', '19390359-2'),
(536, '27.4', '41', '2019-12-07', '19390359-2'),
(537, '27.5', '41', '2019-12-07', '19390359-2'),
(538, '27.4', '41', '2019-12-07', '19390359-2'),
(539, '27.4', '41', '2019-12-07', '19390359-2'),
(540, '27.4', '41', '2019-12-07', '19390359-2'),
(541, '27.4', '41', '2019-12-07', '19390359-2'),
(542, '27.2', '41', '2019-12-07', '19390359-2'),
(543, '27.2', '41', '2019-12-07', '19390359-2'),
(544, '27.2', '41', '2019-12-07', '19390359-2'),
(545, '27.3', '41', '2019-12-07', '19390359-2'),
(546, '27.2', '41', '2019-12-07', '19390359-2'),
(547, '27.3', '41', '2019-12-07', '19390359-2'),
(548, '27.3', '41', '2019-12-07', '19390359-2'),
(549, '27.3', '41', '2019-12-07', '19390359-2'),
(550, '27.3', '41', '2019-12-07', '19390359-2'),
(551, '27.3', '41', '2019-12-07', '19390359-2'),
(552, '27.3', '41', '2019-12-07', '19390359-2'),
(553, '27.3', '41', '2019-12-07', '19390359-2'),
(554, '27.4', '41', '2019-12-07', '19390359-2'),
(555, '27.3', '41', '2019-12-07', '19390359-2'),
(556, '27.4', '41', '2019-12-07', '19390359-2'),
(557, '27.3', '41', '2019-12-07', '19390359-2'),
(558, '27.3', '41', '2019-12-07', '19390359-2'),
(559, '27.4', '41', '2019-12-07', '19390359-2'),
(560, '27.4', '45', '2019-12-09', '19390359-2'),
(561, '27.3', '46', '2019-12-09', '19390359-2'),
(562, '27.3', '46', '2019-12-09', '19390359-2'),
(563, '27.4', '46', '2019-12-09', '19390359-2'),
(564, '27.4', '46', '2019-12-09', '19390359-2'),
(565, '27.4', '46', '2019-12-09', '19390359-2'),
(566, '27.4', '46', '2019-12-09', '19390359-2'),
(567, '27.5', '47', '2019-12-09', '19390359-2'),
(568, '27.4', '46', '2019-12-09', '19390359-2'),
(569, '27.6', '47', '2019-12-09', '19390359-2'),
(570, '27.5', '47', '2019-12-09', '19390359-2'),
(571, '27.6', '47', '2019-12-09', '19390359-2'),
(572, '27.5', '47', '2019-12-09', '19390359-2'),
(573, '28.1', '93', '2019-12-09', '19390359-2'),
(574, '28.6', '61', '2019-12-09', '19390359-2'),
(575, '28.6', '56', '2019-12-09', '19390359-2'),
(576, '28.5', '53', '2019-12-09', '19390359-2'),
(577, '23.6', '54', '2019-12-09', '19390359-2'),
(578, '23.5', '55', '2019-12-09', '19390359-2'),
(579, '23.5', '55', '2019-12-09', '19390359-2'),
(580, '23.5', '55', '2019-12-09', '19390359-2'),
(581, '23.5', '55', '2019-12-09', '19390359-2'),
(582, '23.5', '55', '2019-12-09', '19390359-2'),
(583, '23.5', '55', '2019-12-09', '19390359-2'),
(584, '23.5', '56', '2019-12-09', '19390359-2'),
(585, '23.6', '65', '2019-12-09', '19390359-2'),
(586, '23.6', '61', '2019-12-09', '19390359-2'),
(587, '23.7', '60', '2019-12-09', '19390359-2'),
(588, '23.7', '59', '2019-12-09', '19390359-2'),
(589, '23.7', '57', '2019-12-09', '19390359-2'),
(590, '23.8', '57', '2019-12-09', '19390359-2'),
(591, '23.8', '56', '2019-12-09', '19390359-2'),
(592, '23.9', '55', '2019-12-09', '19390359-2'),
(593, '23.9', '55', '2019-12-09', '19390359-2'),
(594, '24', '54', '2019-12-09', '19390359-2'),
(595, '24', '54', '2019-12-09', '19390359-2'),
(596, '24', '53', '2019-12-09', '19390359-2'),
(597, '24', '53', '2019-12-09', '19390359-2'),
(598, '24', '53', '2019-12-09', '8089127-K'),
(599, '22.8', '58', '2019-12-09', '19390359-2'),
(600, '21.9', '60', '2019-12-09', '19390359-2'),
(601, '21.9', '60', '2019-12-09', '19390359-2'),
(602, '21.5', '62', '2019-12-09', '19390359-2'),
(603, '21.5', '62', '2019-12-09', '19390359-2'),
(604, '21.3', '65', '2019-12-09', '19390359-2'),
(605, '21.7', '65', '2019-12-09', '19390359-2'),
(606, '20.8', '67', '2019-12-09', '19390359-2'),
(607, '20.9', '60', '2019-12-09', '19390359-2'),
(608, '21.7', '56', '2019-12-09', '19390359-2'),
(609, '21.7', '55', '2019-12-09', '19390359-2'),
(610, '21.7', '55', '2019-12-09', '19390359-2'),
(611, '21.8', '55', '2019-12-09', '19390359-2'),
(612, '21.9', '55', '2019-12-09', '19390359-2'),
(613, '21.8', '54', '2019-12-09', '19390359-2'),
(614, '21.8', '54', '2019-12-09', '19390359-2'),
(615, '21.7', '51', '2019-12-09', '19390359-2'),
(616, '21.7', '51', '2019-12-09', '19390359-2'),
(617, '21.8', '51', '2019-12-09', '19390359-2'),
(618, '21.8', '51', '2019-12-09', '19390359-2'),
(619, '21.7', '51', '2019-12-09', '19390359-2'),
(620, '21.8', '51', '2019-12-09', '19390359-2'),
(621, '21.8', '51', '2019-12-09', '19390359-2'),
(622, '21.8', '51', '2019-12-09', '19390359-2'),
(623, '21.9', '51', '2019-12-09', '19390359-2'),
(624, '22.2', '52', '2019-12-09', '19390359-2'),
(625, '22.6', '52', '2019-12-09', '19390359-2'),
(626, '22.9', '51', '2019-12-09', '19390359-2'),
(627, '23', '50', '2019-12-09', '19390359-2'),
(628, '23.1', '50', '2019-12-09', '19390359-2'),
(629, '23.3', '48', '2019-12-09', '19390359-2'),
(630, '22.5', '54', '2019-12-09', '19390359-2'),
(631, '22.6', '54', '2019-12-09', '19390359-2'),
(632, '22.6', '54', '2019-12-09', '19390359-2'),
(633, '22.6', '54', '2019-12-09', '19390359-2'),
(634, '22.6', '54', '2019-12-09', '19390359-2'),
(635, '22.6', '54', '2019-12-09', '19390359-2'),
(636, '22.6', '54', '2019-12-09', '19390359-2'),
(637, '22.6', '54', '2019-12-09', '19390359-2'),
(638, '22.7', '54', '2019-12-09', '19390359-2'),
(639, '22.6', '54', '2019-12-09', '19390359-2'),
(640, '22.6', '54', '2019-12-09', '19390359-2'),
(641, '22.6', '54', '2019-12-09', '19390359-2'),
(642, '22.6', '54', '2019-12-09', '19390359-2'),
(643, '22.6', '54', '2019-12-09', '19390359-2'),
(644, '22.6', '54', '2019-12-09', '19390359-2'),
(645, '22.6', '54', '2019-12-09', '19390359-2'),
(646, '22.6', '54', '2019-12-09', '19390359-2'),
(647, '22.6', '54', '2019-12-09', '19390359-2'),
(648, '22.6', '54', '2019-12-09', '19390359-2'),
(649, '22.6', '54', '2019-12-09', '19390359-2'),
(650, '22.6', '54', '2019-12-09', '19390359-2'),
(651, '22.6', '54', '2019-12-09', '19390359-2'),
(652, '22.7', '54', '2019-12-09', '19390359-2'),
(653, '22.6', '54', '2019-12-09', '19390359-2'),
(654, '22.6', '54', '2019-12-09', '19390359-2'),
(655, '22.6', '54', '2019-12-09', '19390359-2'),
(656, '22.6', '54', '2019-12-09', '19390359-2'),
(657, '22.6', '54', '2019-12-09', '19390359-2'),
(658, '22.6', '54', '2019-12-09', '19390359-2'),
(659, '22.6', '54', '2019-12-09', '19390359-2'),
(660, '22.6', '54', '2019-12-09', '19390359-2'),
(661, '22.6', '54', '2019-12-09', '19390359-2'),
(662, '22.6', '54', '2019-12-09', '19390359-2'),
(663, '22.6', '54', '2019-12-09', '19390359-2'),
(664, '22.6', '54', '2019-12-09', '19390359-2'),
(665, '22.6', '54', '2019-12-09', '19390359-2'),
(666, '22.6', '54', '2019-12-09', '19390359-2'),
(667, '22.6', '54', '2019-12-09', '19390359-2'),
(668, '22.6', '54', '2019-12-09', '19390359-2'),
(669, '22.7', '54', '2019-12-09', '19390359-2'),
(670, '22.6', '54', '2019-12-09', '19390359-2'),
(671, '22.6', '54', '2019-12-09', '19390359-2'),
(672, '22.6', '54', '2019-12-09', '19390359-2'),
(673, '22.6', '54', '2019-12-09', '19390359-2'),
(674, '22.6', '54', '2019-12-09', '19390359-2'),
(675, '22.6', '54', '2019-12-09', '19390359-2'),
(676, '22.6', '54', '2019-12-09', '19390359-2'),
(677, '22.6', '54', '2019-12-09', '19390359-2'),
(678, '22.6', '54', '2019-12-09', '19390359-2'),
(679, '22.6', '54', '2019-12-09', '19390359-2'),
(680, '22.6', '54', '2019-12-09', '19390359-2'),
(681, '22.6', '54', '2019-12-09', '19390359-2'),
(682, '22.6', '54', '2019-12-09', '19390359-2'),
(683, '22.6', '54', '2019-12-09', '19390359-2'),
(684, '22.6', '54', '2019-12-09', '19390359-2'),
(685, '22.6', '54', '2019-12-09', '19390359-2'),
(686, '22.6', '54', '2019-12-09', '19390359-2'),
(687, '22.6', '54', '2019-12-09', '19390359-2'),
(688, '22.6', '54', '2019-12-09', '19390359-2'),
(689, '22.6', '54', '2019-12-09', '19390359-2'),
(690, '22.6', '54', '2019-12-09', '19390359-2'),
(691, '22.6', '54', '2019-12-09', '19390359-2'),
(692, '22.6', '54', '2019-12-09', '19390359-2'),
(693, '22.6', '54', '2019-12-09', '19390359-2'),
(694, '22.6', '54', '2019-12-09', '19390359-2'),
(695, '22.6', '54', '2019-12-09', '19390359-2'),
(696, '22.6', '54', '2019-12-09', '19390359-2'),
(697, '22.6', '54', '2019-12-09', '19390359-2'),
(698, '22.6', '54', '2019-12-09', '19390359-2'),
(699, '22.6', '54', '2019-12-09', '19390359-2'),
(700, '22.6', '54', '2019-12-09', '19390359-2'),
(701, '22.6', '54', '2019-12-09', '19390359-2'),
(702, '22.6', '54', '2019-12-09', '19390359-2'),
(703, '22.6', '54', '2019-12-09', '19390359-2'),
(704, '22.6', '54', '2019-12-09', '19390359-2'),
(705, '22.6', '54', '2019-12-09', '19390359-2'),
(706, '22.6', '54', '2019-12-09', '19390359-2'),
(707, '22.6', '54', '2019-12-09', '19390359-2'),
(708, '22.6', '54', '2019-12-09', '19390359-2'),
(709, '22.6', '54', '2019-12-09', '19390359-2'),
(710, '22.6', '54', '2019-12-09', '19390359-2'),
(711, '22.6', '54', '2019-12-09', '19390359-2'),
(712, '22.6', '54', '2019-12-09', '19390359-2'),
(713, '22.6', '54', '2019-12-09', '19390359-2'),
(714, '22.6', '54', '2019-12-09', '19390359-2'),
(715, '22.6', '54', '2019-12-09', '19390359-2'),
(716, '22.6', '54', '2019-12-09', '19390359-2'),
(717, '22.6', '54', '2019-12-09', '19390359-2'),
(718, '22.6', '54', '2019-12-09', '19390359-2'),
(719, '22.6', '54', '2019-12-09', '19390359-2'),
(720, '22.6', '54', '2019-12-09', '19390359-2'),
(721, '22.6', '54', '2019-12-09', '19390359-2'),
(722, '22.6', '54', '2019-12-09', '19390359-2'),
(723, '22.6', '54', '2019-12-09', '19390359-2'),
(724, '22.6', '54', '2019-12-09', '19390359-2'),
(725, '22.6', '54', '2019-12-09', '19390359-2'),
(726, '22.6', '54', '2019-12-09', '19390359-2'),
(727, '22.6', '55', '2019-12-09', '19390359-2'),
(728, '22.6', '54', '2019-12-09', '19390359-2'),
(729, '22.6', '54', '2019-12-09', '19390359-2'),
(730, '22.6', '54', '2019-12-09', '19390359-2'),
(731, '22.6', '54', '2019-12-09', '19390359-2'),
(732, '22.6', '54', '2019-12-09', '19390359-2'),
(733, '22.6', '54', '2019-12-09', '19390359-2'),
(734, '22.6', '54', '2019-12-09', '19390359-2'),
(735, '22.6', '54', '2019-12-09', '19390359-2'),
(736, '22.6', '54', '2019-12-09', '19390359-2'),
(737, '22.6', '54', '2019-12-09', '19390359-2'),
(738, '22.6', '54', '2019-12-09', '19390359-2'),
(739, '22.6', '54', '2019-12-09', '19390359-2'),
(740, '22.6', '54', '2019-12-09', '19390359-2'),
(741, '22.6', '54', '2019-12-09', '19390359-2'),
(742, '22.6', '54', '2019-12-09', '19390359-2'),
(743, '22.6', '54', '2019-12-09', '19390359-2'),
(744, '22.6', '54', '2019-12-09', '19390359-2'),
(745, '22.6', '54', '2019-12-09', '19390359-2'),
(746, '22.6', '54', '2019-12-09', '19390359-2'),
(747, '22.6', '54', '2019-12-09', '19390359-2'),
(748, '22.6', '54', '2019-12-09', '19390359-2'),
(749, '22.6', '54', '2019-12-09', '19390359-2'),
(750, '22.5', '54', '2019-12-09', '19390359-2'),
(751, '22.5', '54', '2019-12-09', '19390359-2'),
(752, '22.5', '54', '2019-12-09', '19390359-2'),
(753, '22.5', '54', '2019-12-09', '19390359-2'),
(754, '22.6', '54', '2019-12-09', '19390359-2'),
(755, '22.5', '55', '2019-12-09', '19390359-2'),
(756, '22.5', '54', '2019-12-09', '19390359-2'),
(757, '22.5', '55', '2019-12-09', '19390359-2'),
(758, '22.5', '55', '2019-12-09', '19390359-2'),
(759, '22.5', '55', '2019-12-09', '19390359-2'),
(760, '22.5', '55', '2019-12-09', '19390359-2'),
(761, '22.4', '55', '2019-12-09', '19390359-2'),
(762, '22.5', '55', '2019-12-09', '19390359-2'),
(763, '22.5', '55', '2019-12-09', '19390359-2'),
(764, '22.4', '55', '2019-12-09', '19390359-2'),
(765, '22.4', '55', '2019-12-09', '19390359-2'),
(766, '22.5', '55', '2019-12-09', '19390359-2'),
(767, '26.8', '41', '2019-12-11', '19390359-2'),
(768, '26.7', '41', '2019-12-11', '19390359-2'),
(769, '26.7', '41', '2019-12-11', '19390359-2'),
(770, '26.8', '41', '2019-12-11', '19390359-2'),
(771, '26.7', '41', '2019-12-11', '19390359-2'),
(772, '26.8', '41', '2019-12-11', '19390359-2'),
(773, '26.8', '41', '2019-12-11', '19390359-2'),
(774, '26.8', '41', '2019-12-11', '19390359-2'),
(775, '26.9', '41', '2019-12-11', '19390359-2'),
(776, '26.9', '41', '2019-12-11', '19390359-2'),
(777, '26.9', '41', '2019-12-11', '19390359-2'),
(778, '26.9', '41', '2019-12-11', '19390359-2'),
(779, '26.9', '41', '2019-12-11', '19390359-2'),
(780, '27.2', '40', '2019-12-11', '19390359-2'),
(781, '27.2', '40', '2019-12-11', '19390359-2'),
(782, '27.3', '40', '2019-12-11', '19390359-2'),
(783, '27.3', '40', '2019-12-11', '19390359-2'),
(784, '27.4', '40', '2019-12-11', '19390359-2'),
(785, '27.3', '40', '2019-12-11', '19390359-2'),
(786, '27.3', '40', '2019-12-11', '19390359-2'),
(787, '27.3', '41', '2019-12-11', '19390359-2'),
(788, '27.4', '41', '2019-12-11', '19390359-2'),
(789, '27.4', '41', '2019-12-11', '19390359-2'),
(790, '27.4', '40', '2019-12-11', '19390359-2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `rut_usuario` varchar(50) NOT NULL DEFAULT '',
  `id_perfil` int(11) NOT NULL DEFAULT '0',
  `clave_usuario` varchar(50) NOT NULL,
  `estado_usuario` int(11) NOT NULL,
  PRIMARY KEY (`rut_usuario`,`id_perfil`),
  KEY `fk_id_perfil` (`id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`rut_usuario`, `id_perfil`, `clave_usuario`, `estado_usuario`) VALUES
('12561290-3', 3, '25d55ad283aa400af464c76d713c07ad', 1),
('13124800-8', 3, '25d55ad283aa400af464c76d713c07ad', 1),
('13279880-K', 3, '25d55ad283aa400af464c76d713c07ad', 1),
('14006026-7', 3, '25d55ad283aa400af464c76d713c07ad', 0),
('15029547-5', 3, '25d55ad283aa400af464c76d713c07ad', 1),
('15499039-9', 2, '25d55ad283aa400af464c76d713c07ad', 1),
('15636837-7', 3, '25d55ad283aa400af464c76d713c07ad', 1),
('16303922-2', 1, '25d55ad283aa400af464c76d713c07ad', 0),
('16628710-3', 3, '25d55ad283aa400af464c76d713c07ad', 1),
('16825934-4', 3, 'f5bb0c8de146c67b44babbf4e6584cc0', 1),
('19154619-9', 3, '25d55ad283aa400af464c76d713c07ad', 1),
('19389252-3', 1, '4ba36d23a78c7393b4900ef38019d8ff', 1),
('19390359-2', 1, '25d55ad283aa400af464c76d713c07ad', 1),
('23943213-1', 3, '25d55ad283aa400af464c76d713c07ad', 0),
('3776670-4', 3, '25d55ad283aa400af464c76d713c07ad', 1),
('6732307-6', 3, '25d55ad283aa400af464c76d713c07ad', 1),
('7354141-7', 1, '25d55ad283aa400af464c76d713c07ad', 1),
('8089127-K', 2, '25d55ad283aa400af464c76d713c07ad', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `patente_vehiculo` varchar(50) NOT NULL,
  `marca_vehiculo` varchar(50) NOT NULL,
  `modelo_vehiculo` varchar(50) NOT NULL,
  `ano_vehiculo` int(11) NOT NULL,
  `fecha_revision_tecnica_vehiculo` date NOT NULL,
  `estado_vehiculo` int(11) NOT NULL,
  PRIMARY KEY (`patente_vehiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`patente_vehiculo`, `marca_vehiculo`, `modelo_vehiculo`, `ano_vehiculo`, `fecha_revision_tecnica_vehiculo`, `estado_vehiculo`) VALUES
('DZ-ST-21', 'Opel', 'C-16', 2019, '2019-06-26', 0),
('PK-08-92', 'Opel', 'C13', 1992, '2019-05-29', 1),
('S1-12-34', 'Pegueot', 'Partner', 2003, '2019-05-24', 1),
('S1-23-12', 'Citroen', 'C3', 1997, '2019-08-14', 1),
('SH-12-34', 'Opel', 'Corsa', 1996, '2019-12-27', 1),
('SH-SH-10', 'Opel', 'C-19', 2019, '2019-06-19', 1),
('TE-AS-87', 'Citroen', 'C4', 1995, '2019-06-26', 1),
('TI-XD-12', 'Opel', 'C-10', 1997, '2019-05-24', 0),
('XS-S1-23', 'Pegueot', 'W12', 2016, '2019-05-22', 1),
('XS-S1-38', 'Opel', 'Nose', 2018, '2019-07-27', 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activo_pasivo_categoria`
--
ALTER TABLE `activo_pasivo_categoria`
  ADD CONSTRAINT `fk_activo_pasivo` FOREIGN KEY (`id_activo_pasivo`) REFERENCES `activo_pasivo` (`id_activo_pasivo`);

--
-- Filtros para la tabla `activo_pasivo_detalle`
--
ALTER TABLE `activo_pasivo_detalle`
  ADD CONSTRAINT `fk_activo_pasivo_detale` FOREIGN KEY (`id_activo_pasivo_categoria`) REFERENCES `activo_pasivo_categoria` (`id_activo_pasivo_categoria`);

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `fk_id_calificacion_rut_usuario` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`);

--
-- Filtros para la tabla `contabilidad`
--
ALTER TABLE `contabilidad`
  ADD CONSTRAINT `fk_id_activo_pasivo_detalle_01` FOREIGN KEY (`id_activo_pasivo_detalle`) REFERENCES `activo_pasivo_detalle` (`id_activo_pasivo_detalle`),
  ADD CONSTRAINT `fk_rut_usuario_contabilidad` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`);

--
-- Filtros para la tabla `detalle_pedido_factura`
--
ALTER TABLE `detalle_pedido_factura`
  ADD CONSTRAINT `fk_id_factura` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`),
  ADD CONSTRAINT `fk_id_producto_ii` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`);

--
-- Filtros para la tabla `detalle_producto_pedido`
--
ALTER TABLE `detalle_producto_pedido`
  ADD CONSTRAINT `fk_id_producto_pedido` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `fk_id_producto_pedido_ii` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_id_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`),
  ADD CONSTRAINT `fk_id_folio` FOREIGN KEY (`id_folio`) REFERENCES `folio` (`id_folio`);

--
-- Filtros para la tabla `folio`
--
ALTER TABLE `folio`
  ADD CONSTRAINT `fk_id_caf` FOREIGN KEY (`id_caf`) REFERENCES `caf` (`id_caf`);

--
-- Filtros para la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD CONSTRAINT `fk_id_descripcion_insumo` FOREIGN KEY (`id_lista_insumo`) REFERENCES `lista_insumo` (`id_lista_insumo`),
  ADD CONSTRAINT `fk_rut_usuario_insumo` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_rut_usuario_emisor` FOREIGN KEY (`rut_usuario_emisor`) REFERENCES `usuario` (`rut_usuario`);

--
-- Filtros para la tabla `panadero`
--
ALTER TABLE `panadero`
  ADD CONSTRAINT `fk_persona_panadero` FOREIGN KEY (`rut_persona`) REFERENCES `persona` (`rut_persona`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_rut_usuario_caf` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`);

--
-- Filtros para la tabla `repartidor`
--
ALTER TABLE `repartidor`
  ADD CONSTRAINT `fk_persona_repartidor` FOREIGN KEY (`rut_persona`) REFERENCES `persona` (`rut_persona`);

--
-- Filtros para la tabla `repartidor_vehiculo`
--
ALTER TABLE `repartidor_vehiculo`
  ADD CONSTRAINT `fk_rut_persona_vehiculo` FOREIGN KEY (`rut_persona`) REFERENCES `repartidor` (`rut_persona`),
  ADD CONSTRAINT `fk_vehiculo_persona` FOREIGN KEY (`patente_vehiculo`) REFERENCES `vehiculo` (`patente_vehiculo`);

--
-- Filtros para la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD CONSTRAINT `fk_rut_persona_ruta` FOREIGN KEY (`rut_persona_ruta`) REFERENCES `repartidor` (`rut_persona`);

--
-- Filtros para la tabla `sensor`
--
ALTER TABLE `sensor`
  ADD CONSTRAINT `fk_rut_usuario_sensor` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_id_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `fk_rut_usuario` FOREIGN KEY (`rut_usuario`) REFERENCES `persona` (`rut_persona`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
