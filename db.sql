DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    id int(10) unsigned NOT NULL AUTO_INCREMENT,
    username varchar(12),
    password varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_username_unique` (`username`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;