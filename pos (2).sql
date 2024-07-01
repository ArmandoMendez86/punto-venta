-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2024 a las 13:32:16
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(1, 'EQUIPOS ELECTROMECÁNICOS', '2024-06-30 20:39:30'),
(2, 'TALADROS', '2024-06-30 20:39:35'),
(3, 'ANDAMIOS', '2024-06-30 21:19:28'),
(4, 'GENERADORES DE ENERGÍA', '2024-06-30 21:19:32'),
(5, 'EQUIPOS PARA CONSTRUCCIÓN', '2024-06-30 21:19:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` text NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`) VALUES
(1, 1, '101', 'Aspiradora Industrial ', '', 20, 1500, 2100, 0, '2024-06-30 19:19:27'),
(2, 1, '102', 'Plato Flotante para Allanadora', '', 20, 4500, 6300, 0, '2024-06-30 19:19:27'),
(3, 1, '103', 'Compresor de Aire para pintura', '', 20, 3000, 4200, 0, '2024-06-30 19:19:27'),
(4, 1, '104', 'Cortadora de Adobe sin Disco ', '', 20, 4000, 5600, 0, '2024-06-30 19:19:27'),
(5, 1, '105', 'Cortadora de Piso sin Disco ', '', 20, 1540, 2156, 0, '2024-06-30 19:19:27'),
(6, 1, '106', 'Disco Punta Diamante ', '', 20, 1100, 1540, 0, '2024-06-30 19:19:27'),
(7, 1, '107', 'Extractor de Aire ', '', 20, 1540, 2156, 0, '2024-06-30 19:19:27'),
(8, 1, '108', 'Guada?adora ', '', 20, 1540, 2156, 0, '2024-06-30 19:19:27'),
(9, 1, '109', 'Hidrolavadora El?ctrica ', '', 20, 2600, 3640, 0, '2024-06-30 19:19:27'),
(10, 1, '110', 'Hidrolavadora Gasolina', '', 20, 2210, 3094, 0, '2024-06-30 19:19:27'),
(11, 1, '111', 'Motobomba a Gasolina', '', 20, 2860, 4004, 0, '2024-06-30 19:19:27'),
(12, 1, '112', 'Motobomba El?ctrica', '', 20, 2400, 3360, 0, '2024-06-30 19:19:27'),
(13, 1, '113', 'Sierra Circular ', '', 20, 1100, 1540, 0, '2024-06-30 19:19:27'),
(14, 1, '114', 'Disco de tugsteno para Sierra circular', '', 20, 4500, 6300, 0, '2024-06-30 19:19:27'),
(15, 1, '115', 'Soldador Electrico ', '', 20, 1980, 2772, 0, '2024-06-30 19:19:27'),
(16, 1, '116', 'Careta para Soldador', '', 20, 4200, 5880, 0, '2024-06-30 19:19:27'),
(17, 1, '117', 'Torre de iluminacion ', '', 20, 1800, 2520, 0, '2024-06-30 19:19:27'),
(18, 2, '201', 'Martillo Demoledor de Piso 110V', '', 20, 5600, 7840, 0, '2024-06-30 19:19:27'),
(19, 2, '202', 'Muela o cincel martillo demoledor piso', '', 20, 9600, 13440, 0, '2024-06-30 19:19:27'),
(20, 2, '203', 'Taladro Demoledor de muro 110V', '', 20, 3850, 5390, 0, '2024-06-30 19:19:27'),
(21, 2, '204', 'Muela o cincel martillo demoledor muro', '', 20, 9600, 13440, 0, '2024-06-30 19:19:27'),
(22, 2, '205', 'Taladro Percutor de 1/2\" Madera y Metal', '', 20, 8000, 11200, 0, '2024-06-30 19:19:27'),
(23, 2, '206', 'Taladro Percutor SDS Plus 110V', '', 20, 3900, 5460, 0, '2024-06-30 19:19:27'),
(24, 2, '207', 'Taladro Percutor SDS Max 110V (Mineria)', '', 20, 4600, 6440, 0, '2024-06-30 19:19:27'),
(25, 3, '301', 'Andamio colgante', '', 20, 1440, 2016, 0, '2024-06-30 19:19:27'),
(26, 3, '302', 'Distanciador andamio colgante', '', 20, 1600, 2240, 0, '2024-06-30 19:19:27'),
(27, 3, '303', 'Marco andamio modular ', '', 20, 900, 1260, 0, '2024-06-30 19:19:27'),
(28, 3, '304', 'Marco andamio tijera', '', 20, 100, 140, 0, '2024-06-30 19:19:27'),
(29, 3, '305', 'Tijera para andamio', '', 20, 162, 226, 0, '2024-06-30 19:19:27'),
(30, 3, '306', 'Escalera interna para andamio', '', 20, 270, 378, 0, '2024-06-30 19:19:27'),
(31, 3, '307', 'Pasamanos de seguridad', '', 20, 75, 105, 0, '2024-06-30 19:19:27'),
(32, 3, '308', 'Rueda giratoria para andamio', '', 20, 168, 235, 0, '2024-06-30 19:19:27'),
(33, 3, '309', 'Arnes de seguridad', '', 20, 1750, 2450, 0, '2024-06-30 19:19:27'),
(34, 3, '310', 'Eslinga para arnes', '', 20, 175, 245, 0, '2024-06-30 19:19:27'),
(35, 3, '311', 'Plataforma Met?lica', '', 20, 420, 588, 0, '2024-06-30 19:19:27'),
(36, 4, '401', 'Planta Electrica Diesel 6 Kva', '', 20, 3500, 4900, 0, '2024-06-30 19:19:27'),
(37, 4, '402', 'Planta Electrica Diesel 10 Kva', '', 20, 3550, 4970, 0, '2024-06-30 19:19:27'),
(38, 4, '403', 'Planta Electrica Diesel 20 Kva', '', 20, 3600, 5040, 0, '2024-06-30 19:19:27'),
(39, 4, '404', 'Planta Electrica Diesel 30 Kva', '', 20, 3650, 5110, 0, '2024-06-30 19:19:27'),
(40, 4, '405', 'Planta Electrica Diesel 60 Kva', '', 20, 3700, 5180, 0, '2024-06-30 19:19:27'),
(41, 4, '406', 'Planta Electrica Diesel 75 Kva', '', 20, 3750, 5250, 0, '2024-06-30 19:19:27'),
(42, 4, '407', 'Planta Electrica Diesel 100 Kva', '', 20, 3800, 5320, 0, '2024-06-30 19:19:27'),
(43, 4, '408', 'Planta Electrica Diesel 120 Kva', '', 20, 3850, 5390, 0, '2024-06-30 19:19:27'),
(44, 5, '501', 'Escalera de Tijera Aluminio ', '', 20, 350, 490, 0, '2024-06-30 19:19:27'),
(45, 5, '502', 'Extension Electrica ', '', 20, 370, 518, 0, '2024-06-30 19:19:27'),
(46, 5, '503', 'Gato tensor', '', 20, 380, 532, 0, '2024-06-30 19:19:27'),
(47, 5, '504', 'Lamina Cubre Brecha ', '', 20, 380, 532, 0, '2024-06-30 19:19:27'),
(48, 5, '505', 'Llave de Tubo', '', 20, 480, 672, 0, '2024-06-30 19:19:27'),
(49, 5, '506', 'Manila por Metro', '', 20, 600, 840, 0, '2024-06-30 19:19:27'),
(50, 5, '507', 'Polea 2 canales', '', 20, 900, 1260, 0, '2024-06-30 19:19:27'),
(51, 5, '508', 'Tensor', '', 20, 100, 140, 0, '2024-06-30 19:19:27'),
(52, 5, '509', 'Bascula ', '', 20, 130, 182, 0, '2024-06-30 19:19:27'),
(53, 5, '510', 'Bomba Hidrostatica', '', 20, 770, 1078, 0, '2024-06-30 19:19:27'),
(54, 5, '511', 'Chapeta', '', 20, 660, 924, 0, '2024-06-30 19:19:27'),
(55, 5, '512', 'Cilindro muestra de concreto', '', 20, 400, 560, 0, '2024-06-30 19:19:27'),
(56, 5, '513', 'Cizalla de Palanca', '', 20, 450, 630, 0, '2024-06-30 19:19:27'),
(57, 5, '514', 'Cizalla de Tijera', '', 20, 580, 812, 0, '2024-06-30 19:19:27'),
(58, 5, '515', 'Coche llanta neumatica', '', 20, 420, 588, 0, '2024-06-30 19:19:27'),
(59, 5, '516', 'Cono slump', '', 20, 140, 196, 0, '2024-06-30 19:19:27'),
(60, 5, '517', 'Cortadora de Baldosin', '', 20, 930, 1302, 0, '2024-06-30 19:19:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `perfil` text NOT NULL,
  `foto` text NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(6, 'Armando Mendez ', 'iory86', '$2y$10$Nk7cklJYCk8UrwJw4GOrDuTaN4uKcU64SWAo5WA3eGCKG6Gn278Du', 'Administrador', 'vistas/img/usuarios/iory86/989.jpeg', 1, '2024-06-30 22:17:21', '2024-07-01 03:17:21'),
(11, 'mario mendez ', 'mario', '$2y$10$hcfraxrNfL.59K6z6fAbvOmrSZQomfXXi8MniT8ECvgB2hShFGeRm', 'Especial', 'vistas/img/usuarios/mario/901.png', 1, '0000-00-00 00:00:00', '2024-06-29 14:46:54'),
(12, 'mirna luz rios leyva', 'luz', '$2y$10$I8NgI9Ddn806SGkIIziay.UB40wQ/3ooL6ZTxsmqE/LICUC6MHGqy', 'Vendedor', 'vistas/img/usuarios/luz/161.jpeg', 1, '2024-06-29 09:09:17', '2024-06-29 14:53:04'),
(20, 'gumercindo', 'gume', '$2y$10$CXpctL5ASti8arsclmx83.6jrnKiMJF60vTK1alNRzTyLr0HdcYnO', 'Administrador', 'vistas/img/usuarios/gume/763.jpeg', 0, '0000-00-00 00:00:00', '2024-06-29 17:48:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
