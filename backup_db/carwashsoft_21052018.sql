-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2018 a las 00:22:52
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carwashsoft`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`carwashsoft`@`localhost` PROCEDURE `ProCalculaComisionLava` (IN `v_fecha` VARCHAR(20))  BEGIN
                   delete from `baseadpersonal`
                   where fecha=v_fecha
                   and tipopersonal_id=2;
                   
                   
 INSERT INTO 
  `baseadpersonal`
(
  `persona_id`,
  `fecha`,
  `porcentaje`,
  `valor`,
  `tipopersonal_id`)
  
  
select pe.`id`, 
STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') as fecha,
c.`comision`,
sum(
(df.`cantidad`*df.`valor`)*(c.`comision`/100)
) as valor_comi,2 as tipoper
from factura f,
     `detallefactura` df,
     `conceptos` c,
     `tipo_conceptos` `tc`,
     lavados l,
     `equipo_personas` ep,
     `personas` pe
where f.`id` = df.`factura_id`
and df.`concepto_id`=c.`id`
and c.`tipo_conceptos_id`=tc.id
and f.`id`=l.`comanda_id`
AND STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') =v_fecha
and l.`equipo_id`=ep.`equipo_id`
and ep.`persona_id`=pe.`id`
and tc.`id` in (3,1)
group by  pe.`id`, 
STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y'),
c.`comision`;

 SELECT "Comanda Facturada";
                                
END$$

CREATE DEFINER=`carwashsoft`@`localhost` PROCEDURE `ProFacturarComanda` (IN `v_id` INTEGER(10))  BEGIN
                                DECLARE s_salida VARCHAR(20);


                                 delete FROM  `detallefactura` 
                                  WHERE `id`=v_id; 
                                  
                             

                                   delete FROM  `detallefactura` 
                                  where  `factura_id` =v_id;


                                
                                INSERT INTO 
                                  `factura`
                                (
                                  `id`,
                                  `persona_id`,
                                  `vehiculo_id`,
                                  `estado_id`,
                                  `observacion`,
                                  `users_id`,
                                  `created_at`,
                                  `updated_at`)
                                  SELECT 
                                  `c`.`id`,
                                  `c`.`persona_id`,
                                  `c`.`vehiculo_id`,
                                  `c`.`estado_id`,
                                  `c`.`observacion`,
                                  `c`.`users_id`,
                                  `c`.`created_at`,
                                  `c`.`updated_at`
                                FROM 
                                  `comandas` `c` 
                                  WHERE c.`id`=v_id; 

                                INSERT INTO 
                                  `detallefactura`
                                (
                                  `id`,
                                  `factura_id`,
                                  `concepto_id`,
                                  `cantidad`,
                                  `descuentos_id`,
                                  `descuento`,
                                  `valor`,
                                  `comision`,
                                  `impuesto`,
                                  `users_id`,
                                  `created_at`,
                                  `updated_at`) 

                                SELECT 
                                  `c`.`id`,
                                  `c`.`comanda_id`,
                                  `c`.`concepto_id`,
                                  `c`.`cantidad`,
                                  `c`.`descuentos_id`,
                                  `c`.`descuento`,
                                  `c`.`valor`,
                                  `c`.`comision`,
                                  `c`.`impuesto`,
                                  `c`.`users_id`,
                                  `c`.`created_at`,
                                  `c`.`updated_at`
                                FROM 
                                  `comanda_detalles` `c`
                                  WHERE c.`comanda_id`=v_id;

                                UPDATE   `comandas`  
                                    SET `estado_id`=3
                                    WHERE  `id`=v_id;

                                SELECT "Comanda Facturada";
                                
                            END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrativos`
--

CREATE TABLE `administrativos` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `comision` int(11) NOT NULL,
  `estado_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `administrativos`
--

INSERT INTO `administrativos` VALUES(1, 5, 0, 1, 2, '2018-05-22 02:25:28', '2018-05-22 02:25:28');
INSERT INTO `administrativos` VALUES(2, 6, 0, 1, 2, '2018-05-22 02:25:33', '2018-05-22 02:25:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `baseadpersonal`
--

CREATE TABLE `baseadpersonal` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `porcentaje` int(10) UNSIGNED NOT NULL,
  `valor` int(11) NOT NULL,
  `tipopersonal_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `basegancia`
--

CREATE TABLE `basegancia` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `valor_inicia` int(11) NOT NULL,
  `valor_cierre` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comandas`
--

CREATE TABLE `comandas` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `vehiculo_id` int(10) UNSIGNED NOT NULL,
  `estado_id` int(10) UNSIGNED NOT NULL,
  `observacion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comandas`
--

INSERT INTO `comandas` VALUES(1, 1, 1, 3, NULL, 2, '2018-05-22 02:38:31', '2018-05-22 02:38:31');
INSERT INTO `comandas` VALUES(2, 2, 2, 3, NULL, 2, '2018-05-22 03:00:53', '2018-05-22 03:00:53');
INSERT INTO `comandas` VALUES(3, 4, 3, 3, NULL, 2, '2018-05-22 03:04:48', '2018-05-22 03:04:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda_detalles`
--

CREATE TABLE `comanda_detalles` (
  `id` int(10) UNSIGNED NOT NULL,
  `comanda_id` int(10) UNSIGNED NOT NULL,
  `concepto_id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `descuentos_id` int(10) UNSIGNED NOT NULL,
  `descuento` int(10) UNSIGNED NOT NULL,
  `valor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comision` int(11) NOT NULL,
  `impuesto` int(11) NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comanda_detalles`
--

INSERT INTO `comanda_detalles` VALUES(1, 1, 11, 1, 1, 0, '30000', 50, 0, 2, '2018-05-22 02:38:56', '2018-05-22 02:38:56');
INSERT INTO `comanda_detalles` VALUES(2, 1, 3, 1, 1, 0, '2000', 0, 0, 2, '2018-05-22 02:38:59', '2018-05-22 02:38:59');
INSERT INTO `comanda_detalles` VALUES(3, 1, 7, 3, 1, 0, '1800', 0, 0, 2, '2018-05-22 02:39:04', '2018-05-22 02:39:04');
INSERT INTO `comanda_detalles` VALUES(4, 2, 3, 5, 1, 0, '2000', 0, 0, 2, '2018-05-22 03:04:00', '2018-05-22 03:04:00');
INSERT INTO `comanda_detalles` VALUES(5, 2, 4, 2, 1, 0, '5500', 0, 0, 2, '2018-05-22 03:04:05', '2018-05-22 03:04:05');
INSERT INTO `comanda_detalles` VALUES(6, 2, 7, 5, 1, 0, '1800', 0, 0, 2, '2018-05-22 03:04:09', '2018-05-22 03:04:09');
INSERT INTO `comanda_detalles` VALUES(7, 2, 10, 1, 1, 0, '25000', 40, 0, 2, '2018-05-22 03:04:14', '2018-05-22 03:04:14');
INSERT INTO `comanda_detalles` VALUES(8, 2, 8, 1, 1, 0, '15000', 10, 0, 2, '2018-05-22 03:04:18', '2018-05-22 03:04:18');
INSERT INTO `comanda_detalles` VALUES(9, 3, 3, 1, 1, 0, '2000', 0, 0, 2, '2018-05-22 03:05:00', '2018-05-22 03:05:00');
INSERT INTO `comanda_detalles` VALUES(10, 3, 5, 1, 1, 0, '2500', 0, 0, 2, '2018-05-22 03:05:03', '2018-05-22 03:05:03');
INSERT INTO `comanda_detalles` VALUES(11, 3, 7, 1, 1, 0, '1800', 0, 0, 2, '2018-05-22 03:05:05', '2018-05-22 03:05:05');
INSERT INTO `comanda_detalles` VALUES(12, 3, 8, 1, 1, 0, '15000', 10, 0, 2, '2018-05-22 03:05:10', '2018-05-22 03:05:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combos`
--

CREATE TABLE `combos` (
  `id` int(10) UNSIGNED NOT NULL,
  `concepto_id1` int(10) UNSIGNED NOT NULL,
  `concepto_id2` int(10) UNSIGNED NOT NULL,
  `estado_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `combos`
--

INSERT INTO `combos` VALUES(1, 11, 8, 1, 2, '2018-05-22 02:19:45', '2018-05-22 02:19:45');
INSERT INTO `combos` VALUES(2, 11, 9, 1, 2, '2018-05-22 02:19:54', '2018-05-22 02:19:54');
INSERT INTO `combos` VALUES(3, 12, 10, 1, 2, '2018-05-22 02:20:08', '2018-05-22 02:20:08');
INSERT INTO `combos` VALUES(4, 12, 9, 1, 2, '2018-05-22 02:20:12', '2018-05-22 02:20:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos`
--

CREATE TABLE `conceptos` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_conceptos_id` int(10) UNSIGNED NOT NULL,
  `comision` int(11) NOT NULL DEFAULT '0',
  `impuesto` int(11) NOT NULL DEFAULT '0',
  `estado_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `conceptos`
--

INSERT INTO `conceptos` VALUES(1, '000-1', 'Gasto Trabajador', 4, 0, 0, 1, 1, NULL, NULL);
INSERT INTO `conceptos` VALUES(2, '000-2', 'Gasto Lavador', 4, 0, 0, 1, 1, NULL, NULL);
INSERT INTO `conceptos` VALUES(3, 'cc1', 'coca cola 350', 2, 0, 0, 1, 2, '2018-05-22 02:11:46', '2018-05-22 02:11:46');
INSERT INTO `conceptos` VALUES(4, 'cc2', 'coca cola litro y medio', 2, 0, 0, 1, 2, '2018-05-22 02:12:01', '2018-05-22 02:12:01');
INSERT INTO `conceptos` VALUES(5, 'aguila1', 'aguila light', 2, 0, 0, 1, 2, '2018-05-22 02:12:44', '2018-05-22 02:26:06');
INSERT INTO `conceptos` VALUES(6, 'aguila2', 'aguila negra', 2, 0, 0, 1, 2, '2018-05-22 02:12:58', '2018-05-22 02:12:58');
INSERT INTO `conceptos` VALUES(7, 'papa1', 'papa pequeña pollo', 2, 0, 0, 1, 2, '2018-05-22 02:14:23', '2018-05-22 02:14:23');
INSERT INTO `conceptos` VALUES(8, 'lavado', 'lavado uno', 3, 10, 0, 1, 2, '2018-05-22 02:14:43', '2018-05-22 02:26:22');
INSERT INTO `conceptos` VALUES(9, 'encerada', 'encerada general', 3, 30, 0, 1, 2, '2018-05-22 02:14:56', '2018-05-22 02:26:29');
INSERT INTO `conceptos` VALUES(10, 'motor1', 'lavado de motor uno', 3, 40, 0, 1, 2, '2018-05-22 02:18:40', '2018-05-22 02:26:43');
INSERT INTO `conceptos` VALUES(11, 'combo1', 'lavado motor y encerado', 1, 50, 0, 1, 2, '2018-05-22 02:19:01', '2018-05-22 02:26:50');
INSERT INTO `conceptos` VALUES(12, 'combo2', 'lavado y lavado de motor', 1, 51, 0, 1, 2, '2018-05-22 02:19:17', '2018-05-22 02:26:59');
INSERT INTO `conceptos` VALUES(13, 'cera1', 'cera marca acme', 4, 0, 0, 1, 2, '2018-05-22 03:14:40', '2018-05-22 03:14:40');
INSERT INTO `conceptos` VALUES(14, 'ajuste1', 'ajuste de cierre', 4, 0, 0, 1, 2, '2018-05-22 03:14:55', '2018-05-22 03:14:55');
INSERT INTO `conceptos` VALUES(15, 'servicio', 'pago de luz electrica', 4, 0, 0, 1, 2, '2018-05-22 03:15:12', '2018-05-22 03:15:12');
INSERT INTO `conceptos` VALUES(17, 'servicio2', 'pago del servicio de agua', 4, 0, 0, 1, 2, '2018-05-22 03:15:47', '2018-05-22 03:15:47');
INSERT INTO `conceptos` VALUES(18, 'retirocaja1', 'retiro en efectivo de caja', 4, 0, 0, 1, 2, '2018-05-22 03:18:56', '2018-05-22 03:18:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracions`
--

CREATE TABLE `configuracions` (
  `id` int(10) UNSIGNED NOT NULL,
  `concepto_admin_gasto` int(10) UNSIGNED NOT NULL,
  `concepto_lavador_gasto` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configuracions`
--

INSERT INTO `configuracions` VALUES(1, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` VALUES(1, '0', '0', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `id` int(10) UNSIGNED NOT NULL,
  `factura_id` int(10) UNSIGNED NOT NULL,
  `concepto_id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `descuentos_id` int(10) UNSIGNED NOT NULL,
  `descuento` int(10) UNSIGNED NOT NULL,
  `valor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comision` int(11) NOT NULL,
  `impuesto` int(11) NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` VALUES(1, 1, 11, 1, 1, 0, '30000', 50, 0, 2, '2018-05-22 02:38:56', '2018-05-22 02:38:56');
INSERT INTO `detallefactura` VALUES(4, 2, 3, 5, 1, 0, '2000', 0, 0, 2, '2018-05-22 03:04:00', '2018-05-22 03:04:00');
INSERT INTO `detallefactura` VALUES(5, 2, 4, 2, 1, 0, '5500', 0, 0, 2, '2018-05-22 03:04:05', '2018-05-22 03:04:05');
INSERT INTO `detallefactura` VALUES(6, 2, 7, 5, 1, 0, '1800', 0, 0, 2, '2018-05-22 03:04:09', '2018-05-22 03:04:09');
INSERT INTO `detallefactura` VALUES(7, 2, 10, 1, 1, 0, '25000', 40, 0, 2, '2018-05-22 03:04:14', '2018-05-22 03:04:14');
INSERT INTO `detallefactura` VALUES(8, 2, 8, 1, 1, 0, '15000', 10, 0, 2, '2018-05-22 03:04:18', '2018-05-22 03:04:18');
INSERT INTO `detallefactura` VALUES(9, 3, 3, 1, 1, 0, '2000', 0, 0, 2, '2018-05-22 03:05:00', '2018-05-22 03:05:00');
INSERT INTO `detallefactura` VALUES(10, 3, 5, 1, 1, 0, '2500', 0, 0, 2, '2018-05-22 03:05:03', '2018-05-22 03:05:03');
INSERT INTO `detallefactura` VALUES(11, 3, 7, 1, 1, 0, '1800', 0, 0, 2, '2018-05-22 03:05:05', '2018-05-22 03:05:05');
INSERT INTO `detallefactura` VALUES(12, 3, 8, 1, 1, 0, '15000', 10, 0, 2, '2018-05-22 03:05:10', '2018-05-22 03:05:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` VALUES(1, 'eq1', 'equipo uno', 2, '2018-05-22 02:23:50', '2018-05-22 02:23:50');
INSERT INTO `equipos` VALUES(2, 'eq2', 'equipo dos', 2, '2018-05-22 02:24:15', '2018-05-22 02:24:15');
INSERT INTO `equipos` VALUES(3, 'eq3', 'equipo tres', 2, '2018-05-22 02:25:00', '2018-05-22 02:25:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_personas`
--

CREATE TABLE `equipo_personas` (
  `id` int(10) UNSIGNED NOT NULL,
  `equipo_id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `estado_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipo_personas`
--

INSERT INTO `equipo_personas` VALUES(1, 1, 7, 1, 2, '2018-05-22 02:23:58', '2018-05-22 02:23:58');
INSERT INTO `equipo_personas` VALUES(2, 1, 8, 1, 2, '2018-05-22 02:24:04', '2018-05-22 02:24:04');
INSERT INTO `equipo_personas` VALUES(3, 2, 9, 1, 2, '2018-05-22 02:24:22', '2018-05-22 02:24:22');
INSERT INTO `equipo_personas` VALUES(4, 2, 10, 1, 2, '2018-05-22 02:24:31', '2018-05-22 02:24:31');
INSERT INTO `equipo_personas` VALUES(5, 3, 11, 1, 2, '2018-05-22 02:25:09', '2018-05-22 02:25:09');
INSERT INTO `equipo_personas` VALUES(6, 3, 12, 1, 2, '2018-05-22 02:25:13', '2018-05-22 02:25:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` VALUES(1, 'Activo', 1, NULL, NULL);
INSERT INTO `estados` VALUES(2, 'Inactivo', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_comandas`
--

CREATE TABLE `estado_comandas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_comandas`
--

INSERT INTO `estado_comandas` VALUES(1, 'Activa', 1, NULL, NULL);
INSERT INTO `estado_comandas` VALUES(2, 'Inactiva', 1, NULL, NULL);
INSERT INTO `estado_comandas` VALUES(3, 'Facturada', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_facturas`
--

CREATE TABLE `estado_facturas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_facturas`
--

INSERT INTO `estado_facturas` VALUES(1, 'Activa', 1, NULL, NULL);
INSERT INTO `estado_facturas` VALUES(2, 'Inactiva', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `vehiculo_id` int(10) UNSIGNED NOT NULL,
  `estado_id` int(10) UNSIGNED NOT NULL,
  `observacion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` VALUES(1, 1, 1, 1, NULL, 2, '2018-05-22 02:38:31', '2018-05-22 02:38:31');
INSERT INTO `factura` VALUES(2, 2, 2, 1, NULL, 2, '2018-05-22 03:00:53', '2018-05-22 03:00:53');
INSERT INTO `factura` VALUES(3, 4, 3, 1, NULL, 2, '2018-05-22 03:04:48', '2018-05-22 03:04:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria_vehiculos`
--

CREATE TABLE `galeria_vehiculos` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehiculo_id` int(10) UNSIGNED NOT NULL,
  `foto` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ganancia_administrivos`
--

CREATE TABLE `ganancia_administrivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `valorini` int(11) NOT NULL,
  `valorfin` int(11) NOT NULL,
  `porcenganancia` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lavados`
--

CREATE TABLE `lavados` (
  `id` int(10) UNSIGNED NOT NULL,
  `comanda_id` int(10) UNSIGNED NOT NULL,
  `equipo_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lavados`
--

INSERT INTO `lavados` VALUES(1, 1, 1, 2, '2018-05-22 02:38:49', '2018-05-22 02:38:49');
INSERT INTO `lavados` VALUES(2, 2, 2, 2, '2018-05-22 03:00:58', '2018-05-22 03:00:58');
INSERT INTO `lavados` VALUES(3, 3, 3, 2, '2018-05-22 03:04:53', '2018-05-22 03:04:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `id` int(10) UNSIGNED NOT NULL,
  `marca_id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` VALUES(1, 1, 'linea 1', 2, '2018-05-22 02:08:55', '2018-05-22 02:08:55');
INSERT INTO `lineas` VALUES(2, 2, 'linea dos', 2, '2018-05-22 02:09:02', '2018-05-22 02:09:02');
INSERT INTO `lineas` VALUES(3, 3, 'linea 3', 2, '2018-05-22 02:09:09', '2018-05-22 02:09:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` VALUES(1, 'marca uno', 2, '2018-05-22 02:08:31', '2018-05-22 02:08:31');
INSERT INTO `marcas` VALUES(2, 'marca dos', 2, '2018-05-22 02:08:38', '2018-05-22 02:08:38');
INSERT INTO `marcas` VALUES(3, 'marca tres', 2, '2018-05-22 02:08:46', '2018-05-22 02:08:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` VALUES(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES(2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES(3, '2018_04_08_041326_create_roles_table', 1);
INSERT INTO `migrations` VALUES(4, '2018_04_08_042250_create_usuarios_rols_table', 1);
INSERT INTO `migrations` VALUES(5, '2018_04_08_081506_create_estados_table', 1);
INSERT INTO `migrations` VALUES(6, '2018_04_08_151653_create_tipo_conceptos_table', 1);
INSERT INTO `migrations` VALUES(7, '2018_04_08_151831_create_conceptos_table', 1);
INSERT INTO `migrations` VALUES(8, '2018_04_08_160227_create_permisos_table', 1);
INSERT INTO `migrations` VALUES(9, '2018_04_08_164929_create_valores_conceptos_table', 1);
INSERT INTO `migrations` VALUES(10, '2018_04_08_165153_create_tipo_identificacions_table', 1);
INSERT INTO `migrations` VALUES(11, '2018_04_08_170154_create_personas_table', 1);
INSERT INTO `migrations` VALUES(12, '2018_04_13_015043_create_marcas_table', 1);
INSERT INTO `migrations` VALUES(13, '2018_04_13_015850_create_lineas_table', 1);
INSERT INTO `migrations` VALUES(14, '2018_04_14_173351_create_vehiculos_table', 1);
INSERT INTO `migrations` VALUES(15, '2018_04_15_165740_create_galeria_vehiculos_table', 1);
INSERT INTO `migrations` VALUES(16, '2018_04_15_201932_create_equipos_table', 1);
INSERT INTO `migrations` VALUES(17, '2018_04_15_231131_create_estado_facturas_table', 1);
INSERT INTO `migrations` VALUES(18, '2018_04_15_235002_create_estado_comandas_table', 1);
INSERT INTO `migrations` VALUES(19, '2018_04_16_003807_create_descuentos_table', 1);
INSERT INTO `migrations` VALUES(20, '2018_04_16_015527_create_proveedores_table', 1);
INSERT INTO `migrations` VALUES(21, '2018_04_18_001835_create_combos_table', 1);
INSERT INTO `migrations` VALUES(22, '2018_04_18_032122_create_comandas_table', 1);
INSERT INTO `migrations` VALUES(23, '2018_04_18_214037_create_lavados_table', 1);
INSERT INTO `migrations` VALUES(24, '2018_04_20_162958_create_comanda_detalles_table', 1);
INSERT INTO `migrations` VALUES(25, '2018_04_22_004110_create_equipo_personas_table', 1);
INSERT INTO `migrations` VALUES(26, '2018_05_10_023044_create_factura_table', 1);
INSERT INTO `migrations` VALUES(27, '2018_05_10_023103_create_detallefactura_table', 1);
INSERT INTO `migrations` VALUES(28, '2018_05_12_195213_create_tipo_remision_table', 1);
INSERT INTO `migrations` VALUES(29, '2018_05_12_195855_create_remisions_table', 1);
INSERT INTO `migrations` VALUES(30, '2018_05_12_223048_create__pro_facturar_comanda_function', 1);
INSERT INTO `migrations` VALUES(31, '2018_05_12_231407_create_configuracions_table', 1);
INSERT INTO `migrations` VALUES(32, '2018_05_13_151205_create_administrativos_table', 1);
INSERT INTO `migrations` VALUES(33, '2018_05_13_185522_modificar_factura', 1);
INSERT INTO `migrations` VALUES(34, '2018_05_13_190914_modificar_facturados', 1);
INSERT INTO `migrations` VALUES(35, '2018_05_13_192742_modificar_facturatres', 1);
INSERT INTO `migrations` VALUES(36, '2018_05_13_195639_create_basegancia_table', 1);
INSERT INTO `migrations` VALUES(37, '2018_05_13_195654_create_tipopersonal_table', 1);
INSERT INTO `migrations` VALUES(38, '2018_05_13_200204_create_baseadpersonal_table', 1);
INSERT INTO `migrations` VALUES(39, '2018_05_16_163331_create_ganancia_admin_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(10) UNSIGNED NOT NULL,
  `modulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_identificacion_id` int(10) UNSIGNED NOT NULL,
  `identificacion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` VALUES(1, 'Diego', 'Santiago', 1, '123456', NULL, NULL, NULL, NULL, 1, NULL, NULL);
INSERT INTO `personas` VALUES(2, 'cliente', 'uno', 1, '10001', '2018-05-31', NULL, NULL, NULL, 2, '2018-05-22 01:59:29', '2018-05-22 01:59:29');
INSERT INTO `personas` VALUES(3, 'cliente', 'dos', 1, '1002', '2018-05-09', NULL, NULL, NULL, 2, '2018-05-22 01:59:44', '2018-05-22 01:59:44');
INSERT INTO `personas` VALUES(4, 'cliente', 'tres', 1, '1003', '2018-05-06', NULL, NULL, NULL, 2, '2018-05-22 02:00:03', '2018-05-22 02:00:03');
INSERT INTO `personas` VALUES(5, 'admin', 'uni', 1, '2001', '2018-05-24', NULL, NULL, NULL, 2, '2018-05-22 02:00:20', '2018-05-22 02:00:20');
INSERT INTO `personas` VALUES(6, 'admin', 'dos', 1, '2002', '2018-05-31', NULL, NULL, NULL, 2, '2018-05-22 02:00:41', '2018-05-22 02:00:41');
INSERT INTO `personas` VALUES(7, 'lavador', 'uno', 1, '3001', '2018-05-23', NULL, NULL, NULL, 2, '2018-05-22 02:00:53', '2018-05-22 02:00:53');
INSERT INTO `personas` VALUES(8, 'lavador', 'dos', 1, '3002', '2018-05-16', NULL, NULL, NULL, 2, '2018-05-22 02:01:05', '2018-05-22 02:01:05');
INSERT INTO `personas` VALUES(9, 'lavador', 'tres', 1, '3003', '2018-05-26', NULL, NULL, NULL, 2, '2018-05-22 02:01:20', '2018-05-22 02:01:20');
INSERT INTO `personas` VALUES(10, 'lavador', 'cuatro', 1, '3004', '2018-05-29', NULL, NULL, NULL, 2, '2018-05-22 02:01:38', '2018-05-22 02:01:38');
INSERT INTO `personas` VALUES(11, 'lavador', 'cinco', 1, '3005', '2018-05-22', NULL, NULL, NULL, 2, '2018-05-22 02:01:56', '2018-05-22 02:01:56');
INSERT INTO `personas` VALUES(12, 'lavador', 'seis', 1, '3006', '2018-05-26', NULL, NULL, NULL, 2, '2018-05-22 02:02:09', '2018-05-22 02:02:09');
INSERT INTO `personas` VALUES(13, 'gasto', 'uno', 1, '4001', '2018-05-30', NULL, NULL, NULL, 2, '2018-05-22 02:02:35', '2018-05-22 02:02:35');
INSERT INTO `personas` VALUES(14, 'gasto', 'dos', 1, '4002', '2018-05-19', NULL, NULL, NULL, 2, '2018-05-22 02:02:46', '2018-05-22 02:02:46');
INSERT INTO `personas` VALUES(15, 'entrada', 'uno', 1, '5001', '2018-05-25', NULL, NULL, NULL, 2, '2018-05-22 02:03:00', '2018-05-22 02:03:00');
INSERT INTO `personas` VALUES(16, 'entrada', 'dos', 1, '5002', '2018-05-25', NULL, NULL, NULL, 2, '2018-05-22 02:03:10', '2018-05-22 02:03:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `razon_social` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` VALUES(1, '00', 1, 'Brillancor', '00000-0', NULL, NULL, NULL, 1, NULL, NULL);
INSERT INTO `proveedores` VALUES(2, 'pro', 13, 'gasto uno', '10002', NULL, NULL, NULL, 2, '2018-05-22 02:06:29', '2018-05-22 02:06:29');
INSERT INTO `proveedores` VALUES(3, 'pro2', 14, 'gasto dos', '20001', NULL, NULL, NULL, 2, '2018-05-22 02:06:44', '2018-05-22 02:06:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remisions`
--

CREATE TABLE `remisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `concepto_id` int(10) UNSIGNED NOT NULL,
  `tipo_remision_id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `valor` int(11) NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `remisions`
--

INSERT INTO `remisions` VALUES(1, 'compra de cera', 1, 1, 13, 2, '2018-05-21', 20000, 2, '2018-05-22 03:17:29', '2018-05-22 03:18:19');
INSERT INTO `remisions` VALUES(2, 'retiro para pagaf el colegio de la beba', 1, 1, 18, 2, '2018-05-21', 11000, 2, '2018-05-22 03:19:44', '2018-05-22 03:20:34');
INSERT INTO `remisions` VALUES(3, 'ingreso por ajuste de caja', 1, 1, 14, 1, '2018-05-21', 450000, 2, '2018-05-22 03:20:20', '2018-05-22 03:20:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` VALUES(1, 'Super Root', 1, NULL, NULL);
INSERT INTO `roles` VALUES(2, 'Administrador', 1, NULL, NULL);
INSERT INTO `roles` VALUES(3, 'Trabajador', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopersonal`
--

CREATE TABLE `tipopersonal` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipopersonal`
--

INSERT INTO `tipopersonal` VALUES(1, 'Administrador', NULL, NULL);
INSERT INTO `tipopersonal` VALUES(2, 'Lavador', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_conceptos`
--

CREATE TABLE `tipo_conceptos` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_conceptos`
--

INSERT INTO `tipo_conceptos` VALUES(1, 'Combo', 1, NULL, NULL);
INSERT INTO `tipo_conceptos` VALUES(2, 'Producto', 1, NULL, NULL);
INSERT INTO `tipo_conceptos` VALUES(3, 'Servicio', 1, NULL, NULL);
INSERT INTO `tipo_conceptos` VALUES(4, 'Entrada o Salida', 1, NULL, '2018-05-22 02:17:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_identificacions`
--

CREATE TABLE `tipo_identificacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_identificacions`
--

INSERT INTO `tipo_identificacions` VALUES(1, 'CC', 1, NULL, NULL);
INSERT INTO `tipo_identificacions` VALUES(2, 'TI', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_remision`
--

CREATE TABLE `tipo_remision` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_remision`
--

INSERT INTO `tipo_remision` VALUES(1, 'Entrada', NULL, NULL);
INSERT INTO `tipo_remision` VALUES(2, 'Salida', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` VALUES(1, 'Super Root', 'rodrigo@gmail.com', '$2y$10$ji6WSbe4u3hx0wwiiVUBcuj/52syF7Wln272IT8wEX4c/GzMJQNLu', NULL, NULL, NULL);
INSERT INTO `users` VALUES(2, 'Cristian', 'caho@gmail.com', '$2y$10$ji6WSbe4u3hx0wwiiVUBcuj/52syF7Wln272IT8wEX4c/GzMJQNLu', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_rols`
--

CREATE TABLE `usuarios_rols` (
  `id` int(10) UNSIGNED NOT NULL,
  `roles_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios_rols`
--

INSERT INTO `usuarios_rols` VALUES(1, 1, 1, NULL, NULL);
INSERT INTO `usuarios_rols` VALUES(2, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores_conceptos`
--

CREATE TABLE `valores_conceptos` (
  `id` int(10) UNSIGNED NOT NULL,
  `concepto_id` int(10) UNSIGNED NOT NULL,
  `valor` int(11) NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `valores_conceptos`
--

INSERT INTO `valores_conceptos` VALUES(1, 3, 2000, 2, '2018-05-22 02:21:10', '2018-05-22 02:21:10');
INSERT INTO `valores_conceptos` VALUES(2, 4, 5500, 2, '2018-05-22 02:21:23', '2018-05-22 02:21:23');
INSERT INTO `valores_conceptos` VALUES(3, 7, 1800, 2, '2018-05-22 02:21:34', '2018-05-22 02:21:34');
INSERT INTO `valores_conceptos` VALUES(4, 8, 15000, 2, '2018-05-22 02:21:47', '2018-05-22 02:21:47');
INSERT INTO `valores_conceptos` VALUES(5, 9, 18000, 2, '2018-05-22 02:21:59', '2018-05-22 02:21:59');
INSERT INTO `valores_conceptos` VALUES(6, 5, 2500, 2, '2018-05-22 02:22:10', '2018-05-22 02:22:10');
INSERT INTO `valores_conceptos` VALUES(7, 10, 25000, 2, '2018-05-22 02:22:33', '2018-05-22 02:22:33');
INSERT INTO `valores_conceptos` VALUES(8, 11, 30000, 2, '2018-05-22 02:22:52', '2018-05-22 02:22:52');
INSERT INTO `valores_conceptos` VALUES(9, 12, 32000, 2, '2018-05-22 02:23:04', '2018-05-22 02:23:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `placa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `marcas_id` int(10) UNSIGNED NOT NULL,
  `lineas_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` VALUES(1, 1, 'placa1', '2015', '#000000', 2, 1, 1, '2018-05-22 02:10:34', '2018-05-22 02:10:34');
INSERT INTO `vehiculos` VALUES(2, 2, 'placa2', '2016', '#000000', 2, 1, 1, '2018-05-22 02:10:47', '2018-05-22 02:10:47');
INSERT INTO `vehiculos` VALUES(3, 4, 'placa3', '2014', '#000000', 2, 1, 1, '2018-05-22 02:10:59', '2018-05-22 02:10:59');
INSERT INTO `vehiculos` VALUES(4, 2, 'placa5', '2014', '#000000', 2, 1, 1, '2018-05-22 02:11:13', '2018-05-22 02:11:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrativos`
--
ALTER TABLE `administrativos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `administrativos_persona_id_foreign` (`persona_id`),
  ADD KEY `administrativos_estado_id_foreign` (`estado_id`),
  ADD KEY `administrativos_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `baseadpersonal`
--
ALTER TABLE `baseadpersonal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `baseadpersonal_persona_id_foreign` (`persona_id`),
  ADD KEY `baseadpersonal_tipopersonal_id_foreign` (`tipopersonal_id`);

--
-- Indices de la tabla `basegancia`
--
ALTER TABLE `basegancia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `basegancia_fecha_unique` (`fecha`);

--
-- Indices de la tabla `comandas`
--
ALTER TABLE `comandas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comandas_persona_id_foreign` (`persona_id`),
  ADD KEY `comandas_vehiculo_id_foreign` (`vehiculo_id`),
  ADD KEY `comandas_estado_id_foreign` (`estado_id`),
  ADD KEY `comandas_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `comanda_detalles`
--
ALTER TABLE `comanda_detalles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `comanda_detalles_comanda_id_concepto_id_unique` (`comanda_id`,`concepto_id`),
  ADD KEY `comanda_detalles_concepto_id_foreign` (`concepto_id`),
  ADD KEY `comanda_detalles_descuentos_id_foreign` (`descuentos_id`),
  ADD KEY `comanda_detalles_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `combos`
--
ALTER TABLE `combos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `combos_concepto_id1_foreign` (`concepto_id1`),
  ADD KEY `combos_concepto_id2_foreign` (`concepto_id2`),
  ADD KEY `combos_estado_id_foreign` (`estado_id`),
  ADD KEY `combos_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `conceptos_codigo_unique` (`codigo`),
  ADD KEY `conceptos_tipo_conceptos_id_foreign` (`tipo_conceptos_id`),
  ADD KEY `conceptos_estado_id_foreign` (`estado_id`),
  ADD KEY `conceptos_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `configuracions_concepto_admin_gasto_foreign` (`concepto_admin_gasto`),
  ADD KEY `configuracions_concepto_lavador_gasto_foreign` (`concepto_lavador_gasto`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descuentos_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detallefactura_concepto_id_foreign` (`concepto_id`),
  ADD KEY `detallefactura_descuentos_id_foreign` (`descuentos_id`),
  ADD KEY `detallefactura_users_id_foreign` (`users_id`),
  ADD KEY `detallefactura_factura_id_foreign` (`factura_id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipos_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `equipo_personas`
--
ALTER TABLE `equipo_personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `equipo_personas_equipo_id_persona_id_unique` (`equipo_id`,`persona_id`),
  ADD KEY `equipo_personas_persona_id_foreign` (`persona_id`),
  ADD KEY `equipo_personas_estado_id_foreign` (`estado_id`),
  ADD KEY `equipo_personas_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estados_descripcion_unique` (`descripcion`),
  ADD KEY `estados_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `estado_comandas`
--
ALTER TABLE `estado_comandas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_comandas_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `estado_facturas`
--
ALTER TABLE `estado_facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_facturas_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factura_persona_id_foreign` (`persona_id`),
  ADD KEY `factura_vehiculo_id_foreign` (`vehiculo_id`),
  ADD KEY `factura_estado_id_foreign` (`estado_id`),
  ADD KEY `factura_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `galeria_vehiculos`
--
ALTER TABLE `galeria_vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galeria_vehiculos_vehiculo_id_foreign` (`vehiculo_id`),
  ADD KEY `galeria_vehiculos_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `ganancia_administrivos`
--
ALTER TABLE `ganancia_administrivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lavados`
--
ALTER TABLE `lavados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lavados_comanda_id_equipo_id_unique` (`comanda_id`,`equipo_id`),
  ADD KEY `lavados_equipo_id_foreign` (`equipo_id`),
  ADD KEY `lavados_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lineas_marca_id_foreign` (`marca_id`),
  ADD KEY `lineas_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marcas_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permisos_roles_id_foreign` (`roles_id`),
  ADD KEY `permisos_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personas_identificacion_unique` (`identificacion`),
  ADD KEY `personas_tipo_identificacion_id_foreign` (`tipo_identificacion_id`),
  ADD KEY `personas_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedores_persona_id_foreign` (`persona_id`),
  ADD KEY `proveedores_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `remisions`
--
ALTER TABLE `remisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remisions_persona_id_foreign` (`persona_id`),
  ADD KEY `remisions_proveedor_id_foreign` (`proveedor_id`),
  ADD KEY `remisions_concepto_id_foreign` (`concepto_id`),
  ADD KEY `remisions_tipo_remision_id_foreign` (`tipo_remision_id`),
  ADD KEY `remisions_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_descripcion_unique` (`descripcion`),
  ADD KEY `roles_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `tipopersonal`
--
ALTER TABLE `tipopersonal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_conceptos`
--
ALTER TABLE `tipo_conceptos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_conceptos_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `tipo_identificacions`
--
ALTER TABLE `tipo_identificacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_identificacions_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `tipo_remision`
--
ALTER TABLE `tipo_remision`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios_rols`
--
ALTER TABLE `usuarios_rols`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_rols_roles_id_foreign` (`roles_id`),
  ADD KEY `usuarios_rols_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `valores_conceptos`
--
ALTER TABLE `valores_conceptos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valores_conceptos_concepto_id_foreign` (`concepto_id`),
  ADD KEY `valores_conceptos_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `100` (`placa`),
  ADD KEY `vehiculos_persona_id_foreign` (`persona_id`),
  ADD KEY `vehiculos_users_id_foreign` (`users_id`),
  ADD KEY `vehiculos_marcas_id_foreign` (`marcas_id`),
  ADD KEY `vehiculos_lineas_id_foreign` (`lineas_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrativos`
--
ALTER TABLE `administrativos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `baseadpersonal`
--
ALTER TABLE `baseadpersonal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `basegancia`
--
ALTER TABLE `basegancia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comandas`
--
ALTER TABLE `comandas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `comanda_detalles`
--
ALTER TABLE `comanda_detalles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `combos`
--
ALTER TABLE `combos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `equipo_personas`
--
ALTER TABLE `equipo_personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado_comandas`
--
ALTER TABLE `estado_comandas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_facturas`
--
ALTER TABLE `estado_facturas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `galeria_vehiculos`
--
ALTER TABLE `galeria_vehiculos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ganancia_administrivos`
--
ALTER TABLE `ganancia_administrivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lavados`
--
ALTER TABLE `lavados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lineas`
--
ALTER TABLE `lineas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `remisions`
--
ALTER TABLE `remisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipopersonal`
--
ALTER TABLE `tipopersonal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_conceptos`
--
ALTER TABLE `tipo_conceptos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_identificacions`
--
ALTER TABLE `tipo_identificacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_remision`
--
ALTER TABLE `tipo_remision`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios_rols`
--
ALTER TABLE `usuarios_rols`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `valores_conceptos`
--
ALTER TABLE `valores_conceptos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrativos`
--
ALTER TABLE `administrativos`
  ADD CONSTRAINT `administrativos_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `administrativos_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `administrativos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `baseadpersonal`
--
ALTER TABLE `baseadpersonal`
  ADD CONSTRAINT `baseadpersonal_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `baseadpersonal_tipopersonal_id_foreign` FOREIGN KEY (`tipopersonal_id`) REFERENCES `tipopersonal` (`id`);

--
-- Filtros para la tabla `comandas`
--
ALTER TABLE `comandas`
  ADD CONSTRAINT `comandas_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estado_comandas` (`id`),
  ADD CONSTRAINT `comandas_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `comandas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comandas_vehiculo_id_foreign` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`);

--
-- Filtros para la tabla `comanda_detalles`
--
ALTER TABLE `comanda_detalles`
  ADD CONSTRAINT `comanda_detalles_comanda_id_foreign` FOREIGN KEY (`comanda_id`) REFERENCES `comandas` (`id`),
  ADD CONSTRAINT `comanda_detalles_concepto_id_foreign` FOREIGN KEY (`concepto_id`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `comanda_detalles_descuentos_id_foreign` FOREIGN KEY (`descuentos_id`) REFERENCES `descuentos` (`id`),
  ADD CONSTRAINT `comanda_detalles_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `combos`
--
ALTER TABLE `combos`
  ADD CONSTRAINT `combos_concepto_id1_foreign` FOREIGN KEY (`concepto_id1`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `combos_concepto_id2_foreign` FOREIGN KEY (`concepto_id2`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `combos_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `combos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD CONSTRAINT `conceptos_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `conceptos_tipo_conceptos_id_foreign` FOREIGN KEY (`tipo_conceptos_id`) REFERENCES `tipo_conceptos` (`id`),
  ADD CONSTRAINT `conceptos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `configuracions`
--
ALTER TABLE `configuracions`
  ADD CONSTRAINT `configuracions_concepto_admin_gasto_foreign` FOREIGN KEY (`concepto_admin_gasto`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `configuracions_concepto_lavador_gasto_foreign` FOREIGN KEY (`concepto_lavador_gasto`) REFERENCES `conceptos` (`id`);

--
-- Filtros para la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD CONSTRAINT `descuentos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_concepto_id_foreign` FOREIGN KEY (`concepto_id`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `detallefactura_descuentos_id_foreign` FOREIGN KEY (`descuentos_id`) REFERENCES `descuentos` (`id`),
  ADD CONSTRAINT `detallefactura_factura_id_foreign` FOREIGN KEY (`factura_id`) REFERENCES `factura` (`id`),
  ADD CONSTRAINT `detallefactura_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `equipo_personas`
--
ALTER TABLE `equipo_personas`
  ADD CONSTRAINT `equipo_personas_equipo_id_foreign` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `equipo_personas_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `equipo_personas_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `equipo_personas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `estados`
--
ALTER TABLE `estados`
  ADD CONSTRAINT `estados_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `estado_comandas`
--
ALTER TABLE `estado_comandas`
  ADD CONSTRAINT `estado_comandas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `estado_facturas`
--
ALTER TABLE `estado_facturas`
  ADD CONSTRAINT `estado_facturas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estado_comandas` (`id`),
  ADD CONSTRAINT `factura_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `factura_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `factura_vehiculo_id_foreign` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`);

--
-- Filtros para la tabla `galeria_vehiculos`
--
ALTER TABLE `galeria_vehiculos`
  ADD CONSTRAINT `galeria_vehiculos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `galeria_vehiculos_vehiculo_id_foreign` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`);

--
-- Filtros para la tabla `lavados`
--
ALTER TABLE `lavados`
  ADD CONSTRAINT `lavados_comanda_id_foreign` FOREIGN KEY (`comanda_id`) REFERENCES `comandas` (`id`),
  ADD CONSTRAINT `lavados_equipo_id_foreign` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `lavados_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD CONSTRAINT `lineas_marca_id_foreign` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `lineas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD CONSTRAINT `marcas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `permisos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_tipo_identificacion_id_foreign` FOREIGN KEY (`tipo_identificacion_id`) REFERENCES `tipo_identificacions` (`id`),
  ADD CONSTRAINT `personas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `proveedores_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `remisions`
--
ALTER TABLE `remisions`
  ADD CONSTRAINT `remisions_concepto_id_foreign` FOREIGN KEY (`concepto_id`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `remisions_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `remisions_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`),
  ADD CONSTRAINT `remisions_tipo_remision_id_foreign` FOREIGN KEY (`tipo_remision_id`) REFERENCES `tipo_remision` (`id`),
  ADD CONSTRAINT `remisions_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tipo_conceptos`
--
ALTER TABLE `tipo_conceptos`
  ADD CONSTRAINT `tipo_conceptos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tipo_identificacions`
--
ALTER TABLE `tipo_identificacions`
  ADD CONSTRAINT `tipo_identificacions_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `usuarios_rols`
--
ALTER TABLE `usuarios_rols`
  ADD CONSTRAINT `usuarios_rols_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `usuarios_rols_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `valores_conceptos`
--
ALTER TABLE `valores_conceptos`
  ADD CONSTRAINT `valores_conceptos_concepto_id_foreign` FOREIGN KEY (`concepto_id`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `valores_conceptos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_lineas_id_foreign` FOREIGN KEY (`lineas_id`) REFERENCES `lineas` (`id`),
  ADD CONSTRAINT `vehiculos_marcas_id_foreign` FOREIGN KEY (`marcas_id`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `vehiculos_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `vehiculos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
