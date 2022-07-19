-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2022 a las 02:11:06
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sawas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'Administrador', 'admin', '$2a$07$usesomesillystringforewOdLB5CheF5NZbm8TQfHJwIPWk0j23q', 'Administrador', '', 1, '0000-00-00 00:00:00', '2022-07-18 00:15:56'),
(2, 'Jose Fernando Henao', 'jhenao', '$2a$07$usesomesillystringforewOdLB5CheF5NZbm8TQfHJwIPWk0j23q', 'Administrador', '', 1, '2022-06-23 20:01:43', '2022-07-18 23:32:28'),
(3, 'Luis Carlos Arias', 'larias', '$2a$07$usesomesillystringfore43bsn0dimt5uCtaMFmXVlZDf7Durypq', 'Administrador', '', 1, '0000-00-00 00:00:00', '2022-07-18 23:31:11'),
(6, 'isabella henao', 'ihenao', '$2a$07$usesomesillystringforewOdLB5CheF5NZbm8TQfHJwIPWk0j23q', 'Administrador', '', 1, '0000-00-00 00:00:00', '2022-07-18 23:33:13'),
(7, 'camilo ruiz', 'cruiz', '$2a$07$usesomesillystringforewOdLB5CheF5NZbm8TQfHJwIPWk0j23q', 'Administrador', '', 1, '0000-00-00 00:00:00', '2022-07-18 23:33:22'),
(8, 'samuel', 'samu', '$2a$07$usesomesillystringforewOdLB5CheF5NZbm8TQfHJwIPWk0j23q', 'Administrador', '', 0, '0000-00-00 00:00:00', '2022-07-09 19:53:19'),
(9, 'Claudia Mejia', 'cmejia', '$2a$07$usesomesillystringforewOdLB5CheF5NZbm8TQfHJwIPWk0j23q', 'Vendedor', '', 0, '0000-00-00 00:00:00', '2022-07-09 01:46:50'),
(10, 'Juan Rodriguez', 'jrodri', '', 'Supervisor', '', 1, '0000-00-00 00:00:00', '2022-07-18 00:45:45'),
(11, 'luis florez', 'lflorez', '$2a$07$usesomesillystringforeXO5Hlvc7qidt2Z1dYxwCTh5cUsbSfWK', 'Supervisor', '', 0, '0000-00-00 00:00:00', '2022-07-18 23:33:36');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
