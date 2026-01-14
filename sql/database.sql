CREATE DATABASE IF NOT EXISTS old_motors;

USE old_motors;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR() NOT NULL,
    type ENUM('common','admin','saleman') NOT NULL DEFAULT('common'),
    number VARCHAR(20),
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW()
);