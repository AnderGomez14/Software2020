-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-12-2020 a las 07:25:42
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `quiz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_imagen`
--

CREATE TABLE `preguntas_imagen` (
  `id` int(11) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `enum` varchar(128) NOT NULL,
  `correcta` varchar(64) NOT NULL,
  `inco1` varchar(64) NOT NULL,
  `inco2` varchar(64) NOT NULL,
  `inco3` varchar(64) NOT NULL,
  `complejidad` int(64) NOT NULL,
  `tema` varchar(64) NOT NULL,
  `foto` varchar(8) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `dislikes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranking`
--

CREATE TABLE `ranking` (
  `nick` varchar(32) NOT NULL,
  `aciertos` int(11) NOT NULL,
  `fallos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `tipo` varchar(1) NOT NULL,
  `email` varchar(64) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `foto` varchar(8) NOT NULL,
  `last_visit` int(11) DEFAULT 0,
  `estado` varchar(1) NOT NULL DEFAULT 'A',
  `reset` varchar(32) DEFAULT NULL,
  `regCheck` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_social`
--

CREATE TABLE `users_social` (
  `email` varchar(32) NOT NULL,
  `last_visit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas_imagen`
--
ALTER TABLE `preguntas_imagen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`nick`) USING BTREE;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `users_social`
--
ALTER TABLE `users_social`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas_imagen`
--
ALTER TABLE `preguntas_imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
