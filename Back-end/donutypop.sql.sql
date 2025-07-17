
CREATE DATABASE IF NOT EXISTS donutypop;
USE donutypop;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS cliente (
  `id_cliente` int(11) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `dona` (
  `id_dona` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE dona
ADD COLUMN imagen VARCHAR(255),
ADD COLUMN precio DECIMAL(6,2);

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre_empleado` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `sucursal` (
  `id_sucursal` int(11) NOT NULL,
  `direccion` enum('Melchor Ocampo','Plaza Americas','Torre Sol') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `orden` (
  `id_orden` int(11) NOT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `medio_entrega` enum('Tienda','Domicilio') DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `tipo_pago` enum('Efectivo','Tarjeta') DEFAULT NULL,
  `precio_total` decimal(10,2) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `id_dona` int(11) DEFAULT NULL,
  `id_sucursal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

ALTER TABLE `dona`
  ADD PRIMARY KEY (`id_dona`);

ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id_sucursal`);

ALTER TABLE `orden`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_dona` (`id_dona`),
  ADD KEY `id_sucursal` (`id_sucursal`);

ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `dona`
  MODIFY `id_dona` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `sucursal`
  MODIFY `id_sucursal` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `orden`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `orden`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `orden_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`),
  ADD CONSTRAINT `orden_ibfk_3` FOREIGN KEY (`id_dona`) REFERENCES `dona` (`id_dona`),
  ADD CONSTRAINT `orden_ibfk_4` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id_sucursal`);

COMMIT;
