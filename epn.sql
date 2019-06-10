-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2019 a las 01:28:28
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `epn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `idlogin` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `ultimoIngreso` varchar(45) NOT NULL,
  `numIngresos` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`idlogin`, `idUser`, `ultimoIngreso`, `numIngresos`) VALUES
(1, 2, '28/05/19', 1),
(2, 2, '28/05/19', 1),
(3, 2, '28/05/19', 1),
(4, 4, '28/05/19', 0),
(5, 5, '28/05/19', 0),
(6, 6, '01/06/19', 1),
(7, 7, '03/06/19', 1),
(8, 8, '04/06/19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repositorio`
--

CREATE TABLE `repositorio` (
  `idRepositorio` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `tipoArchivo` varchar(45) NOT NULL,
  `autor` varchar(45) NOT NULL,
  `institucion` varchar(45) NOT NULL,
  `fechaCrea` varchar(45) NOT NULL,
  `fechaSubida` varchar(45) NOT NULL,
  `palabrasClave` varchar(45) DEFAULT NULL,
  `enlace` varchar(45) DEFAULT NULL,
  `carrera` varchar(45) NOT NULL,
  `materia` varchar(45) NOT NULL,
  `directorio` varchar(255) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `repositorio`
--

INSERT INTO `repositorio` (`idRepositorio`, `titulo`, `descripcion`, `tipoArchivo`, `autor`, `institucion`, `fechaCrea`, `fechaSubida`, `palabrasClave`, `enlace`, `carrera`, `materia`, `directorio`, `idUser`) VALUES
(2, 'Taller de BI', 'Taller de creacion de bases de datos dimensio', 'text/plain', 'Jorge Morales', 'EPN', '2019-04-23', '02-06-19', 'BI', '', 'Ingenieria en ciencias de la computacion', 'Algoritmos', 'C:/xampp/Xampp/htdocs/Epn-Learning/repositori', 6),
(9, 'libres', 'asdasdasd', 'image/jpeg', 'Bryan Zambrano', 'EPN', '2019-04-10', '02-06-19', 'libres', '', 'Ingenieria de software', 'Compiladores', 'C:/xampp/Xampp/htdocs/Epn-Learning/repositorio/member03-k.jpg', 2),
(11, 'imagen', 'hola a todos', 'image/jpeg', 'Bryan Zambrano', 'EPN', '2019-04-04', '02-06-19', 'software', '', 'Ingenieria de software', 'Bases de datos', 'C:/xampp/Xampp/htdocs/Epn-Learning/repositorio/member04-k.jpg', 2),
(12, 'pdf', 'sin descripcion', 'application/vnd.openxmlformats-officedocument', 'Bryan Zambrano', 'EPN', '2019-06-12', '02-06-19', 'software', '', 'Ingenieria en sistemas', 'Algoritmos', 'C:/xampp/Xampp/htdocs/Epn-Learning/repositorio/Tarea Proyecto 5 Primera versiÃ³n Proyecto.docx', 2),
(13, 'ya no se que poner', 'x2', 'application/pdf', 'Bryan Zambrano', 'EPN', '2019-06-28', '02-06-19', 'software', '', 'Ingenieria de software', 'Compiladores', 'C:/xampp/Xampp/htdocs/Epn-Learning/repositorio/ExÃ¡men Bimestral 1B.pdf', 2),
(14, 'ultima prueba', 'cargar una imagen', 'image/png', 'Bryan Zambrano', 'EPN', '2019-02-08', '02-06-19', 'software', '', 'Ingenieria de software', 'Bases de datos', 'C:/xampp/Xampp/htdocs/Epn-Learning/repositorio/Buho.png', 2),
(16, 'prueba', 'prueba', 'image/png', 'Bryan Zambrano', 'EPN', '2019-04-18', '04-06-19', 'prueba', '', 'Ingenieria en sistemas', 'Bases de datos', 'C:/xampp/Xampp/htdocs/Epn-Learning/repositorio/Escudo_de_la_Escuela_PolitÃ©cnica_Nacional.png', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `userName` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idusers`, `cedula`, `nombre`, `apellido`, `tipo`, `correo`, `userName`, `password`) VALUES
(1, '1234567890', 'prueba', 'prueba', 'Estudiante', 'correo@epn.edu.ec', 'prueba', '1234'),
(2, '1727558726', 'Bryan', 'Zambrano', 'Estudiante', 'bryan.zambrano@epn.edu.ec', 'bz001', '1234'),
(3, '0987654321', 'Juan', 'Perez', 'Profesor', 'ksdjf&ntilde;lka@lak.com', 'jp', '1234'),
(4, '0987654321', 'Juan', 'Perez', 'Profesor', 'ksdjf&ntilde;lka@lak.com', 'jp', '1234'),
(5, '2134123423', 'Maria', 'Perez', 'Profesor', 'asdfq@sdfga.com', 'MP', '1234'),
(6, '1748368502', 'Pablo', 'Perez', 'Profesor', 'bryanz557@gmail.com', 'pl1', 'asdf'),
(7, '1726237744', 'Alex', 'Arevalo', 'Estudiante', 'arevaloalex9@gmail.com', 'alex69', 'asdf'),
(8, '1725116139', 'Jonathan', 'Vargas', 'Estudiante', 'jonathan.1996mds@gmail.com', 'jona', 'asdf');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idlogin`),
  ADD KEY `login_user_idx` (`idUser`);

--
-- Indices de la tabla `repositorio`
--
ALTER TABLE `repositorio`
  ADD PRIMARY KEY (`idRepositorio`),
  ADD KEY `repositorio_user_idx` (`idUser`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `idlogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `repositorio`
--
ALTER TABLE `repositorio`
  MODIFY `idRepositorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_user` FOREIGN KEY (`idUser`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `repositorio`
--
ALTER TABLE `repositorio`
  ADD CONSTRAINT `repositorio_user` FOREIGN KEY (`idUser`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
