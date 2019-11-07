CREATE DATABASE jeticave
DEFAULT CHARACTER SET   utf8
DEFAULT COLLATE utf8_general_ci;
USE jeticave;


CREATE TABLE lot (
id INT AUTO_INCREMENT PRIMARY KEY,
title CHAR,
description TEXT,
url_image CHAR,
first_price DECIMAL,
date_finish TIMESTAMP,
rate_step DECIMAL
);
CREATE TABLE user(
id INT AUTO_INCREMENT PRIMARY KEY,
date_registration DATE,
email CHAR NOT NULL UNIQUE,
name CHAR NOT NULL,
password CHAR NOT NULL,
contact CHAR
);
CREATE TABLE category(
id INT AUTO_INCREMENT PRIMARY KEY,
boards CHAR,
attachment CHAR,
boots CHAR,
clothing CHAR,
tools CHAR,
other CHAR
);
CREATE TABLE rate(
id INT AUTO_INCREMENT PRIMARY KEY,
date_post DATE,
price DECIMAL NOT NULL
);
CREATE UNIQUE INDEX email ON user(email);
CREATE INDEX name ON user(name);
CREATE INDEX title ON lot(title);
CREATE INDEX date_finish ON lot(date_finish);
CREATE INDEX date_post ON rate(date_post);