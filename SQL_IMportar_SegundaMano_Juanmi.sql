-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2021 a las 11:25:56
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `segunda_mano_juanmi`
--
CREATE DATABASE IF NOT EXISTS `segunda_mano_juanmi` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `segunda_mano_juanmi`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `foto_articulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `titulo`, `descripcion`, `precio`, `foto_articulo`, `id_usuario`) VALUES
(1, 'Caja', 'Cajas', '1', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `foto`) VALUES
(3, 'Juan', 'jmhurtadomontejano@gmail.com', '$2y$10$3vgNb5mvJeHIBAjq4aYf4OwRMkylSt9/5QE9BM5IaWQ.qft9ksUji', 'Juanmi.jpg'),
(4, 'Cintia', 'cinti@gmail.com', '$2y$10$yAvsoaX.GQHSQoo8/nClB.8XzcfVxDw8.Jn1GEP1aMoVTWnxZop9W', 'foto.jpg'),
(5, 'Angel', 'angel@gmail.com', '$2y$10$ecKvIFspZQGe1qWoXJXuKe7rJO9RZJVuDFRnon4h70UB/JUhscawK', 'foto.png'),
(6, 'Jaouad', 'jaouad@gmail.com', '$2y$10$bG0mowzqxZ4I8A9R1PUCJ.eeKifsJSdV61KaV10vR/U2XrRQdkoIe', 'foto.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
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
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
