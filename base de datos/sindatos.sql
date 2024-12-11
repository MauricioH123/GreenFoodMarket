-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para greend
CREATE DATABASE IF NOT EXISTS `greend` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `greend`;

-- Volcando estructura para procedimiento greend.actualizarClientes
DELIMITER //
CREATE PROCEDURE `actualizarClientes`(
id_clienteA INT, 
nombreA VARCHAR(45), 
numero_celularA VARCHAR(45), 
correoA VARCHAR(45), 
direccionA VARCHAR(45))
BEGIN
UPDATE clientes
SET nombre = nombreA,
numero_celular = numero_celularA,
correo = correoA,
direccion = direccionA
WHERE id_cliente = id_clienteA;
END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.actualizarProveedor
DELIMITER //
CREATE PROCEDURE `actualizarProveedor`(IN id_proveedorA INT, IN nombre_proveedorA VARCHAR(100))
BEGIN
UPDATE proveedores
SET nombre_proveedor = nombre_proveedorA
WHERE id_proveedor = id_proveedorA;
END//
DELIMITER ;

-- Volcando estructura para tabla greend.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `numero_celular` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `correo` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `direccion` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para vista greend.clientes_frecuente
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `clientes_frecuente` (
	`id_cliente` INT(10) NOT NULL,
	`fecha` DATE NOT NULL,
	`Total_facturas` BIGINT(19) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla greend.detalle_factura
CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_detalle_factura` int NOT NULL AUTO_INCREMENT,
  `id_factura` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad_facturada` int NOT NULL,
  `precio_unitario` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id_detalle_factura`,`id_factura`,`id_producto`),
  KEY `fk_PRODUCTOS_has_FACTURA_FACTURA1_idx` (`id_factura`),
  KEY `fk_PRODUCTOS_has_FACTURA_PRODUCTOS1_idx` (`id_producto`),
  CONSTRAINT `fk_PRODUCTOS_has_FACTURA_FACTURA1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE,
  CONSTRAINT `fk_PRODUCTOS_has_FACTURA_PRODUCTOS1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla greend.detalle_pago
CREATE TABLE IF NOT EXISTS `detalle_pago` (
  `id_detalle_pago` int NOT NULL AUTO_INCREMENT,
  `id_factura` int NOT NULL,
  `id_tipo_pago` int NOT NULL,
  PRIMARY KEY (`id_detalle_pago`),
  KEY `fk_FACTURA_has_TIPO_PAGO_TIPO_PAGO1_idx` (`id_tipo_pago`),
  KEY `fk_FACTURA_has_TIPO_PAGO_FACTURA1_idx` (`id_factura`),
  CONSTRAINT `fk_FACTURA_has_TIPO_PAGO_FACTURA1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON UPDATE CASCADE,
  CONSTRAINT `fk_FACTURA_has_TIPO_PAGO_TIPO_PAGO1` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipo_pago` (`id_tipo_pago`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla greend.devolucion
CREATE TABLE IF NOT EXISTS `devolucion` (
  `id_devolucion` int NOT NULL AUTO_INCREMENT,
  `id_detalle_factura` int NOT NULL,
  `id_factura` int NOT NULL,
  `id_producto` int NOT NULL,
  `id_motivo` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `fecha_devolucion` date NOT NULL,
  PRIMARY KEY (`id_devolucion`,`id_detalle_factura`,`id_factura`,`id_producto`),
  KEY `fk_table1_DETALLE_FACTURA1_idx` (`id_detalle_factura`,`id_factura`,`id_producto`),
  KEY `fk_DEVOLUCION_MOTIVO_DEVOLUCION1_idx` (`id_motivo`),
  CONSTRAINT `fk_DEVOLUCION_MOTIVO_DEVOLUCION1` FOREIGN KEY (`id_motivo`) REFERENCES `motivo_devolucion` (`id_motivo`),
  CONSTRAINT `fk_table1_DETALLE_FACTURA1` FOREIGN KEY (`id_detalle_factura`, `id_factura`, `id_producto`) REFERENCES `detalle_factura` (`id_detalle_factura`, `id_factura`, `id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento greend.eliminar_cliente
DELIMITER //
CREATE PROCEDURE `eliminar_cliente`(
	IN `cliente_id` INT
)
BEGIN
    -- Intentar eliminar el cliente
    DELETE FROM clientes WHERE id_cliente = cliente_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.eliminar_detalle_factura
DELIMITER //
CREATE PROCEDURE `eliminar_detalle_factura`(
IN detalle_factura_id INT, 
OUT resultado VARCHAR(50))
BEGIN
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
SET resultado = 'No se pudo eliminar el producto de la factura debido a un error';

DELETE FROM detalle_factura WHERE id_detalle_factura = detalle_factura_id;

IF ROW_COUNT() > 0 THEN
SET resultado = 'producto eliminado de la factura correctamente';
ELSE
SET resultado = 'No se encontró el producto en la factura con el ID proporcionado';
END IF;

END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.eliminar_entrada
DELIMITER //
CREATE PROCEDURE `eliminar_entrada`(
IN entrada_id INT, 
OUT resultado VARCHAR(50))
BEGIN
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
SET resultado = 'No se pudo eliminar la entrada debido a un error';

DELETE FROM entradas WHERE id_entrada = entrada_id;

IF ROW_COUNT() > 0 THEN
SET resultado = 'Entrada eliminado correctamente';
ELSE
SET resultado = 'No se encontró la entrada con el ID proporcionado';
END IF;

END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.eliminar_factura
DELIMITER //
CREATE PROCEDURE `eliminar_factura`(
IN factura_id INT, 
OUT resultado VARCHAR(50))
BEGIN
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
SET resultado = 'No se pudo eliminar la factura debido a un error';

DELETE FROM factura WHERE id_factura = factura_id;

IF ROW_COUNT() > 0 THEN
SET resultado = 'Factura eliminada correctamente';
ELSE
SET resultado = 'No se encontró la factura con el ID proporcionado';
END IF;

END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.eliminar_producto
DELIMITER //
CREATE PROCEDURE `eliminar_producto`(
	IN `producto_id` INT
)
BEGIN
DELETE FROM productos WHERE id_producto = producto_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.eliminar_proveedor
DELIMITER //
CREATE PROCEDURE `eliminar_proveedor`(
	IN `proveedor_id` INT
)
BEGIN
DELETE FROM proveedores WHERE id_proveedor = proveedor_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.eliminar_tipo_pago
DELIMITER //
CREATE PROCEDURE `eliminar_tipo_pago`(
IN tipo_pago_id INT, 
OUT resultado VARCHAR(50))
BEGIN
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
SET resultado = 'No se pudo eliminar el tipo de pago debido a un error';

DELETE FROM tipo_pago WHERE id_tipo_pago = tipo_pago_id;

IF ROW_COUNT() > 0 THEN
SET resultado = 'Tipo de pago eliminado correctamente';
ELSE
SET resultado = 'No se encontró el tipo de pago con el ID proporcionado';
END IF;

END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.eliminar_usuario
DELIMITER //
CREATE PROCEDURE `eliminar_usuario`(
IN usuario_id INT, 
OUT resultado VARCHAR(50))
BEGIN
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
SET resultado = 'No se pudo eliminar el usuario debido a un error';

DELETE FROM usuario WHERE id_usuario = usuario_id;

IF ROW_COUNT() > 0 THEN
SET resultado = 'Usuario eliminado correctamente';
ELSE
SET resultado = 'No se encontró el usuario con el ID proporcionado';
END IF;

END//
DELIMITER ;

-- Volcando estructura para tabla greend.entradas
CREATE TABLE IF NOT EXISTS `entradas` (
  `id_entrada` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `cantidad_entrada` int NOT NULL,
  `precio_entrada` decimal(12,2) NOT NULL,
  `fecha_entrada` date NOT NULL,
  PRIMARY KEY (`id_entrada`,`id_producto`),
  KEY `fk_ENTRADAS_PRODUCTOS1_idx` (`id_producto`),
  CONSTRAINT `fk_ENTRADAS_PRODUCTOS1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla greend.factura
CREATE TABLE IF NOT EXISTS `factura` (
  `id_factura` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `fk_FACTURA_CLIENTES1_idx` (`id_cliente`),
  CONSTRAINT `fk_FACTURA_CLIENTES1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento greend.insertar_clientes
DELIMITER //
CREATE PROCEDURE `insertar_clientes`(
	IN `nombre_cli` VARCHAR(45),
	IN `celular_cli` VARCHAR(45),
	IN `correo_cli` VARCHAR(45),
	IN `direccion_cli` VARCHAR(45)
)
BEGIN
INSERT INTO clientes (nombre, numero_celular, correo, direccion) VALUES (nombre_cli, celular_cli, correo_cli, direccion_cli);
END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.insertar_detalle_factura
DELIMITER //
CREATE PROCEDURE `insertar_detalle_factura`(
	IN `factura_id` INT,
	IN `producto_id` INT,
	IN `cantidad_de` INT,
	IN `precio_un` DECIMAL(12,2)
)
BEGIN
    INSERT INTO detalle_factura (id_factura, id_producto, cantidad_facturada, precio_unitario) 
    VALUES (factura_id, producto_id, cantidad_de, precio_un);

END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.insertar_entradas
DELIMITER //
CREATE PROCEDURE `insertar_entradas`(
	IN `producto_id` INT,
	IN `entrada_cantidad` INT,
	IN `entrada_precio` DECIMAL(12,2),
	IN `entrada_fecha` DATE
)
BEGIN
    -- Intentar insertar el cliente
    INSERT INTO entradas (id_producto, cantidad_entrada, precio_entrada, fecha_entrada) 
    VALUES (producto_id, entrada_cantidad, entrada_precio, entrada_fecha);
END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.insertar_factura
DELIMITER //
CREATE PROCEDURE `insertar_factura`(
	IN `cliente_id` INT,
	IN `fecha_f` DATE
)
BEGIN
    INSERT INTO factura (id_cliente, fecha) 
    VALUES (cliente_id, fecha_f);

END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.insertar_producto
DELIMITER //
CREATE PROCEDURE `insertar_producto`(
	IN `proveedor_id` INT,
	IN `producto_nombre` VARCHAR(205),
	IN `venta_precio` DECIMAL(12,2)
)
BEGIN
    -- Intentar insertar el cliente
    INSERT INTO productos (id_proveedor, Nombre_producto, precio_venta) 
    VALUES (proveedor_id, producto_nombre, venta_precio);
END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.insertar_proveedor
DELIMITER //
CREATE PROCEDURE `insertar_proveedor`(
	IN `nombre_pro` VARCHAR(45)
)
BEGIN
INSERT INTO proveedores (nombre_proveedor) VALUES (nombre_pro);
END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.insertar_tipo_pago
DELIMITER //
CREATE PROCEDURE `insertar_tipo_pago`(
	IN `tipo_p` VARCHAR(45),
	OUT `resultado` VARCHAR(50)
)
BEGIN
    INSERT INTO tipo_pago (tipo_pago) 
    VALUES (tipo_p);

END//
DELIMITER ;

-- Volcando estructura para procedimiento greend.insertar_usuario
DELIMITER //
CREATE PROCEDURE `insertar_usuario`(
    IN correo_electronico_u VARCHAR(100),
    IN contraseña_u VARCHAR(225),
    OUT resultado VARCHAR(50)
)
BEGIN
    -- Declarar un manejador de excepciones para capturar errores en la inserción
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION 
    SET resultado = 'No se pudo agregar el nuevo usuario debido a un error';

    -- Intentar insertar el cliente
    INSERT INTO usuario (correo_electronico, contraseña) 
    VALUES (correo_electronico_u, contraseña_u);

    -- Si no ocurre ningún error, establecer el mensaje de éxito
    IF resultado IS NULL THEN
        SET resultado = 'Se agregó el nueva usuario';
    END IF;
END//
DELIMITER ;

-- Volcando estructura para tabla greend.inventario
CREATE TABLE IF NOT EXISTS `inventario` (
  `id_inventario` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id_inventario`),
  KEY `fk_table1_PRODUCTOS1_idx` (`id_producto`),
  CONSTRAINT `fk_table1_PRODUCTOS1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla greend.motivo_devolucion
CREATE TABLE IF NOT EXISTS `motivo_devolucion` (
  `id_motivo` int NOT NULL AUTO_INCREMENT,
  `motivo` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_motivo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para vista greend.precio_compra_productos
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `precio_compra_productos` (
	`id_producto` INT(10) NOT NULL,
	`Nombre_producto` VARCHAR(205) NOT NULL COLLATE 'utf8mb3_spanish2_ci',
	`fecha_entrada` DATE NOT NULL,
	`precio` DECIMAL(34,2) NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla greend.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `Nombre_producto` varchar(205) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `precio_venta` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `fk_PRODUCTOS_PROVEEDORES_idx` (`id_proveedor`),
  CONSTRAINT `fk_PRODUCTOS_PROVEEDORES` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para vista greend.productos_tienda
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `productos_tienda` (
	`id_producto` INT(10) NOT NULL,
	`nombre_proveedor` VARCHAR(100) NOT NULL COLLATE 'utf8mb3_spanish2_ci',
	`Nombre_producto` VARCHAR(205) NOT NULL COLLATE 'utf8mb3_spanish2_ci',
	`precio_venta` DECIMAL(12,2) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla greend.proveedores
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int NOT NULL AUTO_INCREMENT,
  `nombre_proveedor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla greend.tipo_pago
CREATE TABLE IF NOT EXISTS `tipo_pago` (
  `id_tipo_pago` int NOT NULL AUTO_INCREMENT,
  `tipo_pago` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_tipo_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para vista greend.total_entradas_productos
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `total_entradas_productos` (
	`id_producto` INT(10) NOT NULL,
	`Nombre_producto` VARCHAR(205) NOT NULL COLLATE 'utf8mb3_spanish2_ci',
	`fecha_entrada` DATE NOT NULL,
	`cantidad` DECIMAL(32,0) NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista greend.total_facturas_clientes
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `total_facturas_clientes` (
	`id_factura` INT(10) NOT NULL,
	`nombre` VARCHAR(45) NOT NULL COLLATE 'utf8mb3_spanish2_ci',
	`fecha` DATE NOT NULL,
	`total_factura` DECIMAL(44,2) NULL,
	`correo` VARCHAR(45) NOT NULL COLLATE 'utf8mb3_spanish2_ci'
) ENGINE=MyISAM;

-- Volcando estructura para tabla greend.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `correo_electronico` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `contraseña` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para función greend.ventas_netas
DELIMITER //
CREATE FUNCTION `ventas_netas`(fecha INT, tipo VARCHAR(100)) RETURNS decimal(12,2)
    DETERMINISTIC
BEGIN
DECLARE venta_bruta DECIMAL(12,2);
DECLARE devoluciones DECIMAL(12,2);

IF tipo = 'Mensual' THEN
SELECT SUM(t.total_factura) INTO venta_bruta FROM total_facturas_clientes AS t WHERE MONTH(t.fecha) = fecha;
SELECT SUM(d.precio * d.cantidad) INTO devoluciones FROM devolucion AS d WHERE MONTH(d.fecha_devolucion) = fecha;

ELSEIF tipo = 'Anual' THEN
SELECT SUM(t.total_factura) INTO venta_bruta FROM total_facturas_clientes AS t WHERE YEAR(t.fecha) = fecha;
SELECT SUM(d.precio * d.cantidad) INTO devoluciones FROM devolucion AS d WHERE YEAR(d.fecha_devolucion) = fecha;

ELSEIF tipo = 'Semanal' THEN
SELECT SUM(t.total_factura) INTO venta_bruta FROM total_facturas_clientes AS t WHERE YEAR(t.fecha) = YEAR(CURDATE()) AND WEEK(t.fecha, 1) = fecha;
SELECT SUM(d.precio * d.cantidad) INTO devoluciones FROM devolucion AS d WHERE YEAR(d.fecha_devolucion) = YEAR(CURDATE()) AND WEEK(d.fecha_devolucion, 1) = fecha;

END IF;	

RETURN venta_bruta - devoluciones;

END//
DELIMITER ;

-- Volcando estructura para disparador greend.actulizar_inventario
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `actulizar_inventario` AFTER INSERT ON `entradas` FOR EACH ROW BEGIN
UPDATE inventario
SET cantidad = cantidad + NEW.cantidad_entrada
WHERE id_producto = NEW.id_producto;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador greend.actulizar_inventario_resta
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `actulizar_inventario_resta` AFTER INSERT ON `detalle_factura` FOR EACH ROW BEGIN
UPDATE inventario
SET cantidad = cantidad - NEW.cantidad_facturada
WHERE id_producto = NEW.id_producto;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador greend.insertar_producto_inventario
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `insertar_producto_inventario` AFTER INSERT ON `productos` FOR EACH ROW BEGIN
INSERT INTO inventario (id_producto, cantidad) VALUES(NEW.id_producto, 0);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para vista greend.clientes_frecuente
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `clientes_frecuente`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `clientes_frecuente` AS select `f`.`id_cliente` AS `id_cliente`,`f`.`fecha` AS `fecha`,count(`f`.`id_factura`) AS `Total_facturas` from `factura` `f` group by `f`.`id_cliente`,`f`.`fecha` order by count(`f`.`id_factura`) desc;

-- Volcando estructura para vista greend.precio_compra_productos
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `precio_compra_productos`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `precio_compra_productos` AS select `p`.`id_producto` AS `id_producto`,`p`.`Nombre_producto` AS `Nombre_producto`,`e`.`fecha_entrada` AS `fecha_entrada`,sum(`e`.`precio_entrada`) AS `precio` from (`productos` `p` join `entradas` `e` on((`p`.`id_producto` = `e`.`id_producto`))) group by `p`.`id_producto`,`p`.`Nombre_producto`,`e`.`fecha_entrada` order by `p`.`Nombre_producto`,`e`.`fecha_entrada`;

-- Volcando estructura para vista greend.productos_tienda
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `productos_tienda`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `productos_tienda` AS select `pr`.`id_producto` AS `id_producto`,`p`.`nombre_proveedor` AS `nombre_proveedor`,`pr`.`Nombre_producto` AS `Nombre_producto`,`pr`.`precio_venta` AS `precio_venta` from (`proveedores` `p` join `productos` `pr` on((`p`.`id_proveedor` = `pr`.`id_proveedor`))) order by `pr`.`id_producto`;

-- Volcando estructura para vista greend.total_entradas_productos
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `total_entradas_productos`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `total_entradas_productos` AS select `p`.`id_producto` AS `id_producto`,`p`.`Nombre_producto` AS `Nombre_producto`,`e`.`fecha_entrada` AS `fecha_entrada`,sum(`e`.`cantidad_entrada`) AS `cantidad` from (`productos` `p` join `entradas` `e` on((`p`.`id_producto` = `e`.`id_producto`))) group by `p`.`id_producto`,`p`.`Nombre_producto`,`e`.`fecha_entrada` order by `p`.`Nombre_producto`,`e`.`fecha_entrada`;

-- Volcando estructura para vista greend.total_facturas_clientes
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `total_facturas_clientes`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `total_facturas_clientes` AS select `f`.`id_factura` AS `id_factura`,`c`.`nombre` AS `nombre`,`f`.`fecha` AS `fecha`,sum((`d`.`cantidad_facturada` * `d`.`precio_unitario`)) AS `total_factura`,`c`.`correo` AS `correo` from ((`clientes` `c` join `factura` `f` on((`c`.`id_cliente` = `f`.`id_cliente`))) join `detalle_factura` `d` on((`f`.`id_factura` = `d`.`id_factura`))) group by `f`.`id_factura`,`c`.`nombre`,`f`.`fecha` order by `f`.`id_factura`,`f`.`fecha`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
