CREATE DATABASE IF NOT EXISTS old_motors;

USE old_motors;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR(150) NOT NULL,
    type ENUM('common','admin','saleman') NOT NULL DEFAULT('common'),
    cellnumber VARCHAR(20),
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW()
);

# user com senha 12345678
INSERT INTO users (fullname, email, password, type) VALUES ('Admin', 'admin@oldmotors.com','$2y$12$xJufFosuLubKJ7/Op986sexObAcN7D9hUDAIsCx4GcwALioDdjKCm','admin');