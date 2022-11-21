CREATE USER 'user1'@'%' IDENTIFIED WITH mysql_native_password BY 'password';
create database IF NOT EXISTS vcs;
GRANT ALL PRIVILEGES ON vcs.* TO 'user1'@'%';
use vcs;
DROP TABLE IF EXISTS users;

CREATE TABLE users(
    `id` int NOT NULL AUTO_INCREMENT,
    `username` varchar(255),
    `password` varchar(255),
    PRIMARY KEY (id)
);