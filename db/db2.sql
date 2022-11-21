CREATE USER 'user2'@'%' IDENTIFIED WITH mysql_native_password BY 'password';
create database IF NOT EXISTS vcs2;
GRANT ALL PRIVILEGES ON vcs2.* TO 'user2'@'%';
use vcs2;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS news;

CREATE TABLE users(
    `id` int NOT NULL AUTO_INCREMENT,
    `username` varchar(255),
    `password` varchar(255),
    PRIMARY KEY (id)
);
CREATE TABLE news(
    `id` int NOT NULL AUTO_INCREMENT,
    `title` varchar(355),
    `author` varchar(255),
    `content` varchar(3000),
    `date_created` datetime,
    PRIMARY KEY (id)
);

CREATE TABLE `flag` (
  `flag` varchar(255) NOT NULL
);

INSERT INTO `users` (`username`,`password`) VALUES ('admin','d033e22ae348aeb5660fc2140aec35850c4da997');
INSERT INTO `flag` (`flag`) VALUES ('Flag{f4k3_fl4g_f0r_t3st1ng}');
