CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
);

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `average_minutes` int(10) unsigned NOT NULL,
  UNIQUE KEY `id` (`id`)
);

CREATE TABLE IF NOT EXISTS `turn` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`module_id` int(10) unsigned NOT NULL,
	`user_name` varchar(100) NOT NULL,
	`user_email` varchar(100) NOT NULL,
	`completed_at` datetime NULL,
	`canceled_at` datetime NULL,
	`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
KEY `module_id` (`module_id`),
CONSTRAINT `turn_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`)
);

-- modulos
insert into module (name, description, average_minutes) values ('A', 'Servicio de atención al cliente', 5);
insert into module (name, description, average_minutes) values ('B', 'Soporte especializado', 10);
insert into module (name, description, average_minutes) values ('C', 'Adquisición de productos', 2);