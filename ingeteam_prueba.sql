-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-08-2020 a las 21:25:29
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ingeteam_prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_user_credentials`
--

CREATE TABLE `tb_user_credentials` (
  `EMAIL` varchar(80) NOT NULL,
  `PASSWORD` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_user_credentials`
--

INSERT INTO `tb_user_credentials` (`EMAIL`, `PASSWORD`) VALUES
('blanca@fine.net', 'stTxa5TTKGFuI'),
('edu@mail.com', 'stX/kmp2y6.zE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_user_data`
--

CREATE TABLE `tb_user_data` (
  `USER_NAME` varchar(80) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `DESCRIPTION` varchar(500) DEFAULT NULL,
  `ADDRESS` varchar(200) DEFAULT NULL,
  `POSTAL_CODE` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_user_data`
--

INSERT INTO `tb_user_data` (`USER_NAME`, `EMAIL`, `DESCRIPTION`, `ADDRESS`, `POSTAL_CODE`) VALUES
('Blanca', 'blanca@fine.net', 'segunda Prueba', 'Calle enladrillada Nº 62', '24568'),
('Edu', 'edu@mail.com', 'Primera prueba, hola mundo', 'Calle Mikasa 23', '46010');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_user_credentials`
--
ALTER TABLE `tb_user_credentials`
  ADD PRIMARY KEY (`EMAIL`,`PASSWORD`);

--
-- Indices de la tabla `tb_user_data`
--
ALTER TABLE `tb_user_data`
  ADD PRIMARY KEY (`EMAIL`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_user_credentials`
--
ALTER TABLE `tb_user_credentials`
  ADD CONSTRAINT `tb_user_credentials_ibfk_1` FOREIGN KEY (`EMAIL`) REFERENCES `tb_user_data` (`EMAIL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
