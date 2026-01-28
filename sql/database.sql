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

# user com senha oldMotors
INSERT INTO users (fullname, email, password, type) VALUES ('Admin', 'admin@oldmotors.com','$2y$12$xJufFosuLubKJ7/Op986sexObAcN7D9hUDAIsCx4GcwALioDdjKCm','admin');

CREATE TABLE IF NOT EXISTS vehicles (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    mark VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    year VARCHAR(4) NOT NULL,
    plate VARCHAR(10) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    status ENUM('sketch','completed') NOT NULL DEFAULT('sketch'),
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW()
);

CREATE TABLE IF NOT EXISTS vehicle_images (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    vehicle_id INT,
    path VARCHAR(255) NOT NULL,
    main BOOLEAN DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY(vehicle_id) REFERENCES vehicles(id)
);