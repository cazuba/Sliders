
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_imagen` varchar(150) COLLATE utf8_bin NOT NULL,
  `url_destino` varchar(150) COLLATE utf8_bin NOT NULL,
  `activo` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '1',
  `orden` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
