CREATE DATABASE juegos;

USE juegos;

CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT UNIQUE,
  `nombre` varchar(32) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `juego` (
  `id` int NOT NULL AUTO_INCREMENT UNIQUE,
  `nombre` varchar(32) NOT NULL,
  `tipo` varchar(32) NOT NULL,
  `numJugadores` varchar(32) NOT NULL,
  `gratuito` enum('SI','NO'),
  `foto` varchar(500) NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `favoritos` (
  `id` int NOT NULL AUTO_INCREMENT UNIQUE,
  `idUsuario` int NOT NULL,
  `idJuego` int NOT NULL,
  `nombre` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idUsuario`) REFERENCES `usuario`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`idJuego`) REFERENCES `juego`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);


INSERT INTO `juego` (`nombre`,`tipo`,`numJugadores`,`gratuito`, `foto`) VALUES 
('EldenRing','Soulslike','singleplayer/multiplayer', 'NO','https://image.api.playstation.com/vulcan/ap/rnd/202108/0410/2odx6gpsgR6qQ16YZ7YkEt2B.png'),
('Escape from Tarkov','Shooter','multiplayer', 'NO','https://image.ceneostatic.pl/data/products/83760656/i-escape-from-tarkov-digital.jpg'),
('LoL','MOBA','multiplayer', 'SI','https://www.leagueoflegends.com/static/open-graph-2e582ae9fae8b0b396ca46ff21fd47a8.jpg'),
('Crusader Kings','Estrategia','singleplayer/multiplayer', 'NO','https://cdn-products.eneba.com/resized-products/Cuu1GmaLMcoJZ7f1TTk3gLRJz17CWJZlBQIi1_PPymk_350x200_1x-0.jpeg');

INSERT INTO `favoritos` (`idUsuario`,`idJuego`,`nombre`) VALUES 
('1','1','EldenRing'),
('2','2','Escape from Tarkov');