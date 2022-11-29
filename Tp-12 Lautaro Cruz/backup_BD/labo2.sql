-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2022 a las 01:59:00
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `labo2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id_libro` int(11) NOT NULL,
  `titulo` varchar(75) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `paginas` smallint(6) DEFAULT NULL,
  `fecha_publicacion` date DEFAULT NULL,
  `portada` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id_libro`, `titulo`, `autor`, `genero`, `paginas`, `fecha_publicacion`, `portada`) VALUES
(1, 'Padre rico padre pobre', 'Robert Kiyosaki', 'Finanzas', 207, '1997-02-23', 'Padre rico padre pobre.jpg'),
(2, 'El elemento', 'Ken Robinson', 'Autoayuda', 336, '2009-07-15', 'El elemento.jpg'),
(3, 'La libertad de ser quien soy', 'Pilar Sordo', 'Autoayuda', 163, '2020-01-02', 'La libertad de ser quien soy.jpg'),
(4, 'Tres formas de tomar un helado', 'Enrique Espeche', 'Marketing', 314, '2022-07-18', 'Tres formas de tomar un helado.jpg'),
(5, 'Caos', 'Magalí Tajes', 'Poesía', 234, '2018-04-29', 'Caos.jpg'),
(6, 'Los secretos de la mente millonaria', 'Harv Eker', 'Finanzas', 246, '2005-02-15', 'Los secretos de la mente millonaria.jpg'),
(7, 'Historias de divan', 'Gabriel Rolón', 'Psicología', 256, '2007-06-17', 'Historias de divan.jpg'),
(8, 'La inteligenia emocional', 'Daniel Goleman', 'Psicología', 353, '1995-11-20', 'La inteligenia emocional.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `pass`, `tipo`, `foto`) VALUES
(1, 'jpepe', '39d19e8bec728e2cd4d2a4199e9434ad7df5e459', 'Administrador', 'jpepe.jpg'),
(2, 'mruiz', '397747e2ea1fd4995810616087d0e6c4ab7014d4', 'Administrador', 'mruiz.jpg'),
(3, 'dsingh', 'abab1d2a5f608941022d1b43da6c92d574d55060', 'Común', 'dsingh.jpg'),
(4, 'cflores', 'd1662c4daf4585ab458111cff0b30c954603d0ea', 'Común', ''),
(5, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrador', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id_libro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
