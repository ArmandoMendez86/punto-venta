-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2024 a las 07:56:13
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
(5, 'mario', 'mario', '$2y$10$Oxi8NBGwAymXQxithDPCke8uV6OAAlZYZhlWd4a7fG1MBTxuIXncS', 'Especial', 'vistas/img/usuarios/mario/512.jpeg', 0, '0000-00-00 00:00:00', '2024-06-23 21:26:14'),
(6, 'Armando', 'iory86', '$2y$10$w/11jJFFm4yAkL07s6wl8e.yecgNJtD.UFF.l4xptc9LN0yJ2pFce', 'Administrador', 'vistas/img/usuarios/armando/202.jpeg', 0, '0000-00-00 00:00:00', '2024-06-23 21:36:28'),
(7, 'elpidio', 'gumerneitor', '$2y$10$9nA47Q3z3pi808X5NAGehuaFfxWft2bixEf0jaMkmfLNLEitzgewC', 'Especial', '', 0, '0000-00-00 00:00:00', '2024-06-24 05:16:06'),
(10, 'dalia', 'daly', '$2y$10$9PTOJAYidO9bxI7l3cdcVOcntO3TQFyyLityVBY.tAAQ7o9enD5eG', 'Vendedor', '', 0, '0000-00-00 00:00:00', '2024-06-24 05:17:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
