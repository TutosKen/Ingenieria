-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-10-2020 a las 16:54:38
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `animales`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarCategorias` (IN `idPost` INT, IN `idCat` INT)  BEGIN
DECLARE cant INT;
	IF NOT EXISTS(SELECT * FROM postxcategoria WHERE FK_Post = idPost AND FK_Categoria = idCat) THEN
	INSERT INTO postxcategoria(FK_Post,FK_Categoria) VALUES(idPost,idCat);
    SELECT ROW_COUNT();
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IDCategoria` int(11) NOT NULL,
  `Nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Descripcion` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IDCategoria`, `Nombre`, `Descripcion`) VALUES
(1, 'Animales', 'Fotos de animales'),
(2, 'Viajes', 'Fotos de viajes'),
(3, 'Lugares', 'Fotos de Lugares'),
(4, 'Fiestas', 'Fotos de fiestas'),
(5, 'Vehiculos', 'Fotos de vehiculos'),
(6, 'Playas', 'Fotos de playa'),
(7, 'Curiosidades', 'Fotos de curiosidades'),
(8, 'Personas', 'Fotos de personas'),
(9, 'Otros', 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `IDComentario` int(11) NOT NULL,
  `Comentario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FK_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `IDPost` int(11) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `Fecha_publicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CantVistas` int(11) NOT NULL DEFAULT '0',
  `Tags` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `FK_Usuario` int(11) NOT NULL,
  `URI` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`IDPost`, `Titulo`, `Descripcion`, `Fecha_publicacion`, `CantVistas`, `Tags`, `FK_Usuario`, `URI`) VALUES
(1, 'Gato', 'Gato mirando por la ventana', '2020-09-27 04:00:00', 81, 'Pequeño,Animal,Gato', 1, '/Animales/img/gato.jpg'),
(2, 'Perro', 'Perro en el patio', '2020-09-28 04:00:00', 7, 'Perro,Animal,Lindo', 1, '/Animales/img/Perro.jpg'),
(3, 'Pato', 'Pato banandose', '2020-09-28 04:00:00', 5, 'Pato,Animal', 1, '/Animales/img/Pato.jpg'),
(25, 'Panda', 'Oso Panda', '2020-10-02 19:00:43', 1, 'Animales, Oso, Salvaje, Panda', 1, 'https://static.scientificamerican.com/espanol/cache/file/050D641B-C40F-460A-B892534B0024CB3C_source.jpg?w=590&h=800&4147C8A7-B3A4-4126-9293322177AC2D1C'),
(26, 'Koala', 'Koala en arbol', '2020-10-02 19:01:52', 0, 'Animales, Koala, arbol', 1, 'https://www.infobae.com/new-resizer/S_RtcmEitjPrJ2W6f9t45367wbk=/768x432/filters:format(jpg):quality(85)/s3.amazonaws.com/arc-wordpress-client-uploads/infobae-wp/wp-content/uploads/2019/05/18171857/koalas-1.jpg'),
(27, 'Elefante', 'Elefante en la selva', '2020-10-02 19:04:04', 3, 'animal,selva,naturaleza', 1, 'https://www.dw.com/image/45665028_303.jpg'),
(30, 'Leon', 'Leon en pradera', '2020-10-02 19:06:30', 0, 'Animales, Leon, Pradera', 51, 'https://concepto.de/wp-content/uploads/2019/05/leon-sabana-africa-e1559242836802.jpg'),
(31, 'Jirafa', 'Jiarafa en pradera', '2020-10-02 19:07:05', 0, 'Animales,Pradera', 51, 'https://okdiario.com/img/2016/12/29/jirafas-curiosidades-animal-b-655x368.jpg'),
(32, 'Mono', 'Mono en arbol', '2020-10-02 19:08:14', 2, 'Arbol,Naturaleza,Animales', 51, 'https://cumbrepuebloscop20.org/wp-content/uploads/2018/09/Mono-3.jpg'),
(33, 'Conejo', 'Conejo en casa', '2020-10-02 19:09:31', 0, 'Casa,Animales,Cautiverio', 51, 'https://t2.ea.ltmcdn.com/es/images/0/7/1/cuidados_del_conejo_3170_600.jpg'),
(34, 'Hamster', 'Hamster comiendo', '2020-10-02 19:10:28', 0, 'Animales,Casa,Mascotas', 51, 'https://www.petdarling.com/articulos/wp-content/uploads/2018/06/cuanto-vive-un-hamster.jpg'),
(35, 'Tortuga', 'Tortuga marin', '2020-10-02 20:06:15', 0, 'Animales,Oceano,Naturaleza', 51, 'https://okdiario.com/img/2020/01/23/-por-que-las-tortugas-viven-tantos-anos-655x368.jpg'),
(36, 'caballo', 'Caballo en llanura', '2020-10-02 21:02:39', 0, 'Animales,Naturaleza', 51, 'https://revistamundoequino.com/wp-content/uploads/2019/12/ok-shutterstock_516032272-760x490.jpg'),
(37, 'Camello', 'Camello en el desierto', '2020-10-02 21:03:50', 0, 'Animales,Naturaleza', 51, 'https://www.anipedia.net/imagenes/camello.jpg'),
(41, 'Oveja', 'Oveja con su hijo', '2020-10-03 01:37:15', 0, 'animales,naturaleza', 51, '/Animales/img/4120190905125728lamb-2295516_1920.jpg'),
(45, 'Elliot Alderson', 'Probando de nuevo', '2020-10-03 04:14:36', 1, 'Hacking,TV Show,Mr Robot', 51, '/Animales/img/45airtm.jpg');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `postusuario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `postusuario` (
`Apellido` varchar(255)
,`CantVistas` int(11)
,`Descripcion` text
,`Fecha_publicacion` timestamp
,`FK_Usuario` int(11)
,`IDPost` int(11)
,`Nick` varchar(25)
,`Nombre` varchar(255)
,`Tags` varchar(255)
,`Titulo` varchar(255)
,`URI` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postxcategoria`
--

CREATE TABLE `postxcategoria` (
  `FK_Post` int(11) NOT NULL,
  `FK_Categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `postxcategoria`
--

INSERT INTO `postxcategoria` (`FK_Post`, `FK_Categoria`) VALUES
(25, 1),
(26, 1),
(30, 1),
(30, 3),
(31, 1),
(31, 3),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(36, 3),
(37, 1),
(37, 3),
(2, 1),
(3, 1),
(41, 1),
(45, 8),
(45, 9),
(1, 2),
(1, 3),
(1, 8),
(27, 2),
(27, 3),
(27, 7),
(27, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postxcomentario`
--

CREATE TABLE `postxcomentario` (
  `FK_Post` int(11) NOT NULL,
  `FK_Comentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta_secreta`
--

CREATE TABLE `pregunta_secreta` (
  `IDPregunta` int(11) NOT NULL,
  `Pregunta` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pregunta_secreta`
--

INSERT INTO `pregunta_secreta` (`IDPregunta`, `Pregunta`) VALUES
(1, '¿Cual es tu libro favorito?'),
(2, '¿Cual es tu pelicula favorita?'),
(3, '¿Que nombre tenia tu primer mascota?'),
(4, '¿En que ciudad naciste?'),
(5, '¿Cual fue la primera compañia para la que trabajaste?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `IDRespuesta` int(11) NOT NULL,
  `Contenido` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FK_Usuario` int(11) NOT NULL,
  `FK_Comentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Apellido` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Cedula` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Telefono` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Nick` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Clave` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `FK_Pregunta` int(11) NOT NULL,
  `RespuestaSecreta` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `IDUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Nombre`, `Apellido`, `Cedula`, `Direccion`, `Email`, `Telefono`, `Nick`, `Clave`, `FK_Pregunta`, `RespuestaSecreta`, `IDUsuario`) VALUES
('Keneth', 'Chaves Cubero', '208030605', 'San Ramon, Alajuela', 'anonymouscarvajalcarranza@gmail.com', '60300923', 'Whoami', 'q5aE', 1, '0sXF7XXNDeh5xYRV', 1),
('Carlos', 'Castro', '208030607', 'San Isidro, San Ramon, Costa Rica', 'carlotas@gmail.com', '70651276', 'Carlotas', 'q5aE', 1, 'Maquinas mortales', 51);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usuariopregunta`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `usuariopregunta` (
`Clave` text
,`Email` varchar(255)
,`FK_Pregunta` int(11)
,`Nick` varchar(25)
,`Pregunta` varchar(255)
,`RespuestaSecreta` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `postusuario`
--
DROP TABLE IF EXISTS `postusuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `postusuario`  AS  select `post`.`IDPost` AS `IDPost`,`post`.`Titulo` AS `Titulo`,`post`.`Descripcion` AS `Descripcion`,`post`.`Fecha_publicacion` AS `Fecha_publicacion`,`post`.`CantVistas` AS `CantVistas`,`post`.`Tags` AS `Tags`,`post`.`URI` AS `URI`,`post`.`FK_Usuario` AS `FK_Usuario`,`u`.`Nick` AS `Nick`,`u`.`Nombre` AS `Nombre`,`u`.`Apellido` AS `Apellido` from (`post` join `usuario` `u` on((`post`.`FK_Usuario` = `u`.`IDUsuario`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `usuariopregunta`
--
DROP TABLE IF EXISTS `usuariopregunta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usuariopregunta`  AS  select `u`.`Clave` AS `Clave`,`u`.`Email` AS `Email`,`u`.`RespuestaSecreta` AS `RespuestaSecreta`,`u`.`FK_Pregunta` AS `FK_Pregunta`,`ps`.`Pregunta` AS `Pregunta`,`u`.`Nick` AS `Nick` from (`usuario` `u` join `pregunta_secreta` `ps` on((`u`.`FK_Pregunta` = `ps`.`IDPregunta`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IDCategoria`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`IDComentario`),
  ADD KEY `ElimComentarios` (`FK_Usuario`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`IDPost`),
  ADD KEY `ElimCuenta` (`FK_Usuario`);

--
-- Indices de la tabla `postxcategoria`
--
ALTER TABLE `postxcategoria`
  ADD KEY `FKPost` (`FK_Post`),
  ADD KEY `FKCat` (`FK_Categoria`);

--
-- Indices de la tabla `postxcomentario`
--
ALTER TABLE `postxcomentario`
  ADD KEY `FK_post` (`FK_Post`),
  ADD KEY `FK_comment` (`FK_Comentario`);

--
-- Indices de la tabla `pregunta_secreta`
--
ALTER TABLE `pregunta_secreta`
  ADD PRIMARY KEY (`IDPregunta`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`IDRespuesta`),
  ADD KEY `FKComRes` (`FK_Comentario`),
  ADD KEY `FKUsuarioRes` (`FK_Usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDUsuario`),
  ADD KEY `FKPreg` (`FK_Pregunta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IDCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `IDComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `IDPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `pregunta_secreta`
--
ALTER TABLE `pregunta_secreta`
  MODIFY `IDPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `IDRespuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `ElimComentarios` FOREIGN KEY (`FK_Usuario`) REFERENCES `usuario` (`IDUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `ElimCuenta` FOREIGN KEY (`FK_Usuario`) REFERENCES `usuario` (`IDUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `postxcategoria`
--
ALTER TABLE `postxcategoria`
  ADD CONSTRAINT `FKCat` FOREIGN KEY (`FK_Categoria`) REFERENCES `categoria` (`IDCategoria`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `FKPost` FOREIGN KEY (`FK_Post`) REFERENCES `post` (`IDPost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `postxcomentario`
--
ALTER TABLE `postxcomentario`
  ADD CONSTRAINT `FK_comment` FOREIGN KEY (`FK_Comentario`) REFERENCES `comentario` (`IDComentario`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_post` FOREIGN KEY (`FK_Post`) REFERENCES `post` (`IDPost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `FKComRes` FOREIGN KEY (`FK_Comentario`) REFERENCES `comentario` (`IDComentario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKUsuarioRes` FOREIGN KEY (`FK_Usuario`) REFERENCES `usuario` (`IDUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FKPreg` FOREIGN KEY (`FK_Pregunta`) REFERENCES `pregunta_secreta` (`IDPregunta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
