-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2016 at 07:55 PM
-- Server version: 5.5.47
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cl55-cell`
--

-- --------------------------------------------------------

--
-- Table structure for table `Clientes`
--

CREATE TABLE IF NOT EXISTS `Clientes` (
  `cedula` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Empleados`
--

CREATE TABLE IF NOT EXISTS `Empleados` (
  `id_emp` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_emp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Equipos`
--

CREATE TABLE IF NOT EXISTS `Equipos` (
  `serial` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Ordenes`
--

CREATE TABLE IF NOT EXISTS `Ordenes` (
  `n_orden` int(11) NOT NULL AUTO_INCREMENT,
  `cedula_cli` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `serial_eq` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `id_tec` int(11) NOT NULL,
  `memoria` varchar(2) NOT NULL,
  `chip` varchar(2) NOT NULL,
  `tapa` varchar(2) NOT NULL,
  `falla` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`n_orden`),
  KEY `cedula_cli` (`cedula_cli`),
  KEY `serial_eq` (`serial_eq`),
  KEY `id_tec` (`id_tec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Recibidos`
--

CREATE TABLE IF NOT EXISTS `Recibidos` (
  `cedula_cli` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `serial_eq` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  KEY `cedula_cli` (`cedula_cli`),
  KEY `serial_eq` (`serial_eq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Reparo`
--

CREATE TABLE IF NOT EXISTS `Reparo` (
  `id_tec` int(11) NOT NULL,
  `serial_eq` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  KEY `id_tec` (`id_tec`),
  KEY `serial_eq` (`serial_eq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Tecnicos`
--

CREATE TABLE IF NOT EXISTS `Tecnicos` (
  `id_tec` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Ordenes`
--
ALTER TABLE `Ordenes`
  ADD CONSTRAINT `Ordenes_ibfk_3` FOREIGN KEY (`id_tec`) REFERENCES `Tecnicos` (`id_tec`),
  ADD CONSTRAINT `Ordenes_ibfk_1` FOREIGN KEY (`cedula_cli`) REFERENCES `Clientes` (`cedula`),
  ADD CONSTRAINT `Ordenes_ibfk_2` FOREIGN KEY (`serial_eq`) REFERENCES `Equipos` (`serial`);

--
-- Constraints for table `Recibidos`
--
ALTER TABLE `Recibidos`
  ADD CONSTRAINT `Recibidos_ibfk_2` FOREIGN KEY (`serial_eq`) REFERENCES `Equipos` (`serial`),
  ADD CONSTRAINT `Recibidos_ibfk_1` FOREIGN KEY (`cedula_cli`) REFERENCES `Clientes` (`cedula`);

--
-- Constraints for table `Reparo`
--
ALTER TABLE `Reparo`
  ADD CONSTRAINT `Reparo_ibfk_2` FOREIGN KEY (`serial_eq`) REFERENCES `Equipos` (`serial`),
  ADD CONSTRAINT `Reparo_ibfk_1` FOREIGN KEY (`id_tec`) REFERENCES `Tecnicos` (`id_tec`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
