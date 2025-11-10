/* Tabla users */
CREATE TABLE `users` (
  `userid` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(32) NOT NULL,
  `hash` VARCHAR(100) NOT NULL,
  `nombre` VARCHAR(32) NOT NULL,
  `apellidos` VARCHAR(32) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


/* Tabla datos */
CREATE TABLE `datos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `userid` INT NOT NULL,
  `altura` INT(11) NOT NULL,
  `peso` INT(11) NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_datos_users` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=7;


-- Volcado de datos para la tabla `users`
INSERT INTO `users` (`username`, `hash`, `nombre`, `apellidos`, `fecha_nacimiento`) VALUES
('ignacio', '$2a$12$lCW.iTImE2CF27df3.bth.HXihWyNUerWe0tZt31E5oF3.S.DC2uy', 'ignacio', 'sanchez', '2001-10-02');


-- Volcado de datos para la tabla `datos`
INSERT INTO `datos` (`id`, `userid`, `altura`, `peso`, `fecha`) VALUES
(1, 1, 180, 90, '2025-11-05'),
(4, 1, 70, 20, '2025-11-07'),
(5, 1, 70, 20, '2025-11-07'),
(6, 1, 80, 120, '2025-11-07');
