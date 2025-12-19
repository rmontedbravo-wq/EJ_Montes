-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 
-- Tiempo de generación: 15-11-2025 a las 23:35:53
-- Versión del servidor: 11.4.7-MariaDB
-- Versión de PHP: 7.2.22


-- Crear la base de datos
CREATE DATABASE EstudioJurídico;

-- Usar la base de datos
USE EstudioJurídico;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `EstudioJuridico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `dni` varchar(15) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombres`, `apellidos`, `dni`, `direccion`, `telefono`, `correo`, `fecha_registro`) VALUES
(1, 'Carlos', 'López', '12345678', 'Av. Perú 123', '987654321', 'carlos@example.com', '2025-10-31 18:59:18'),
(2, 'María', 'Torres', '87654321', 'Jr. Lima 456', '987321654', 'maria@example.com', '2025-10-31 18:59:18'),
(3, 'José', 'Pérez', '45678912', 'Calle Olivos 23', '988765432', 'jose@example.com', '2025-10-31 18:59:18'),
(4, 'Lucía', 'Gómez', '65498732', 'Av. Grau 789', '985214365', 'lucia@example.com', '2025-10-31 18:59:18'),
(5, 'Andrés', 'Santos', '87451236', 'Jr. Huancayo 321', '986325147', 'andres@example.com', '2025-10-31 18:59:18'),
(6, 'Marta', 'Castro', '78541236', 'Av. Grau 222', '988541236', 'marta@example.com', '2025-10-31 18:59:18'),
(7, 'Luis', 'Ramírez', '78965412', 'Calle Lima 987', '987412369', 'luis@example.com', '2025-10-31 18:59:18'),
(8, 'Rosa', 'Campos', '12378945', 'Jr. Unión 654', '989745632', 'rosa@example.com', '2025-10-31 18:59:18'),
(9, 'Pedro', 'Vargas', '95175384', 'Av. Los Incas 888', '981234567', 'pedro@example.com', '2025-10-31 18:59:18'),
(10, 'Elena', 'Rivas', '32165498', 'Calle Bolívar 111', '982345678', 'elena@example.com', '2025-10-31 18:59:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte_judicial`
--

CREATE TABLE `corte_judicial` (
  `id_corte` int(11) NOT NULL,
  `nombre_corte` varchar(100) NOT NULL,
  `distrito` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `corte_judicial`
--

INSERT INTO `corte_judicial` (`id_corte`, `nombre_corte`, `distrito`) VALUES
(1, 'Corte de Lima Norte', 'Lima Norte'),
(2, 'Corte de Lima Sur', 'Lima Sur'),
(3, 'Corte del Callao', 'Callao'),
(4, 'Corte de Arequipa', 'Arequipa'),
(5, 'Corte de Cusco', 'Cusco'),
(6, 'Corte de Piura', 'Piura'),
(7, 'Corte de Trujillo', 'La Libertad'),
(8, 'Corte de Puno', 'Puno'),
(9, 'Corte de Huancayo', 'Junín'),
(10, 'Corte de Chiclayo', 'Lambayeque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapa_proceso`
--

CREATE TABLE `etapa_proceso` (
  `id_etapa` int(11) NOT NULL,
  `id_expediente` int(11) NOT NULL,
  `nombre_etapa` enum('Demanda','Audiencia','Sentencia','Apelación') NOT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  `total_pagado` decimal(10,2) DEFAULT 0.00,
  `saldo_pendiente` decimal(10,2) GENERATED ALWAYS AS (`monto_total` - `total_pagado`) STORED,
  `porcentaje_avance` decimal(5,2) GENERATED ALWAYS AS (`total_pagado` / `monto_total` * 100) STORED,
  `estado_etapa` enum('Pendiente','En proceso','Pagada') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `etapa_proceso`
--

INSERT INTO `etapa_proceso` (`id_etapa`, `id_expediente`, `nombre_etapa`, `monto_total`, `total_pagado`, `estado_etapa`) VALUES
(1, 1, 'Demanda', '500.00', '500.00', 'Pagada'),
(2, 1, 'Audiencia', '400.00', '150.00', 'En proceso'),
(3, 1, 'Sentencia', '600.00', '200.00', 'En proceso'),
(4, 1, 'Apelación', '700.00', '700.00', 'Pagada'),
(5, 2, 'Demanda', '450.00', '250.00', 'En proceso'),
(6, 2, 'Audiencia', '300.00', '100.00', 'En proceso'),
(7, 2, 'Sentencia', '500.00', '0.00', 'Pendiente'),
(8, 2, 'Apelación', '600.00', '0.00', 'Pendiente'),
(9, 3, 'Demanda', '550.00', '300.00', 'En proceso'),
(10, 3, 'Audiencia', '450.00', '200.00', 'En proceso'),
(11, 4, 'Demanda', '400.00', '0.00', 'Pendiente'),
(12, 5, 'Demanda', '500.00', '250.00', 'En proceso'),
(13, 6, 'Demanda', '450.00', '0.00', 'Pendiente'),
(14, 7, 'Demanda', '600.00', '0.00', 'Pendiente'),
(15, 8, 'Demanda', '500.00', '0.00', 'Pendiente'),
(16, 9, 'Demanda', '550.00', '0.00', 'Pendiente'),
(17, 10, 'Demanda', '500.00', '0.00', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expediente`
--

CREATE TABLE `expediente` (
  `id_expediente` int(11) NOT NULL,
  `numero_expediente` varchar(20) NOT NULL,
  `anio_expediente` year(4) NOT NULL,
  `materia` varchar(100) NOT NULL,
  `estado_proceso` varchar(50) DEFAULT NULL,
  `id_juzgado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `expediente`
--

INSERT INTO `expediente` (`id_expediente`, `numero_expediente`, `anio_expediente`, `materia`, `estado_proceso`, `id_juzgado`, `id_cliente`, `fecha_inicio`) VALUES
(1, 'EXP-001', 2025, 'Divorcio', 'En trámite', 1, 1, '2025-01-10'),
(2, 'EXP-002', 2025, 'Laboral', 'En trámite', 3, 2, '2025-02-15'),
(3, 'EXP-003', 2025, 'Penal', 'Con sentencia', 5, 3, '2025-02-20'),
(4, 'EXP-004', 2024, 'Civil', 'Archivado', 7, 4, '2024-03-10'),
(5, 'EXP-005', 2025, 'Laboral', 'En apelación', 6, 5, '2025-03-25'),
(6, 'EXP-006', 2024, 'Penal', 'En trámite', 8, 6, '2024-04-05'),
(7, 'EXP-007', 2025, 'Civil', 'En audiencia', 9, 7, '2025-05-14'),
(8, 'EXP-008', 2025, 'Civil', 'En demanda', 10, 8, '2025-06-12'),
(9, 'EXP-009', 2023, 'Laboral', 'Sentenciado', 4, 9, '2023-07-08'),
(10, 'EXP-010', 2025, 'Civil', 'En trámite', 2, 10, '2025-08-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juzgado`
--

CREATE TABLE `juzgado` (
  `id_juzgado` int(11) NOT NULL,
  `id_corte` int(11) NOT NULL,
  `nombre_juzgado` varchar(100) NOT NULL,
  `tipo_juzgado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `juzgado`
--

INSERT INTO `juzgado` (`id_juzgado`, `id_corte`, `nombre_juzgado`, `tipo_juzgado`) VALUES
(1, 1, '1er Juzgado Civil Lima Norte', 'Civil'),
(2, 2, '2do Juzgado Penal Lima Sur', 'Penal'),
(3, 3, '1er Juzgado Laboral Callao', 'Laboral'),
(4, 4, '2do Juzgado Civil Arequipa', 'Civil'),
(5, 5, '3er Juzgado Penal Cusco', 'Penal'),
(6, 6, '1er Juzgado Laboral Piura', 'Laboral'),
(7, 7, '2do Juzgado Civil Trujillo', 'Civil'),
(8, 8, '1er Juzgado Penal Puno', 'Penal'),
(9, 9, '2do Juzgado Civil Huancayo', 'Civil'),
(10, 10, '1er Juzgado Civil Chiclayo', 'Civil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `id_etapa` int(11) NOT NULL,
  `fecha_pago` datetime DEFAULT current_timestamp(),
  `monto_pagado` decimal(10,2) NOT NULL,
  `medio_pago` varchar(50) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id_pago`, `id_etapa`, `fecha_pago`, `monto_pagado`, `medio_pago`, `observacion`) VALUES
(1, 1, '2025-10-31 18:59:18', '200.00', 'Efectivo', 'Primer abono'),
(2, 1, '2025-10-31 18:59:18', '300.00', 'Transferencia', 'Pago completo demanda'),
(3, 2, '2025-10-31 18:59:18', '150.00', 'Efectivo', 'Avance audiencia'),
(4, 3, '2025-10-31 18:59:18', '200.00', 'Efectivo', 'Pago inicial sentencia'),
(5, 4, '2025-10-31 18:59:18', '700.00', 'Transferencia', 'Apelación completa'),
(6, 5, '2025-10-31 18:59:18', '250.00', 'Efectivo', 'Demanda laboral'),
(7, 6, '2025-10-31 18:59:18', '100.00', 'Transferencia', 'Audiencia parcial'),
(8, 9, '2025-10-31 18:59:18', '300.00', 'Efectivo', 'Abono demanda penal'),
(9, 10, '2025-10-31 18:59:18', '200.00', 'Efectivo', 'Inicio audiencia penal'),
(10, 12, '2025-10-31 18:59:18', '250.00', 'Transferencia', 'Demanda apelación');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
