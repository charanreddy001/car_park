-- Create the database (if not already existing)
CREATE DATABASE IF NOT EXISTS parking_db;
USE parking_db;

-- Drop tables if they exist (for a clean setup)
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS parking_slots;
DROP TABLE IF EXISTS users;

-- Users Table: stores user & admin accounts
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);

-- Parking Slots Table: stores slots & status
CREATE TABLE parking_slots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slot_name VARCHAR(100) NOT NULL UNIQUE,
    status TINYINT(1) NOT NULL DEFAULT 0  -- 0: available, 1: booked
);

-- Bookings Table: stores user reservations
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    slot_id INT NOT NULL,
    booking_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (slot_id) REFERENCES parking_slots(id) ON DELETE CASCADE
);

-- Create default admin account
-- Password = admin123 (hashed with MD5 for demo)
INSERT INTO users (name, email, password, role)
VALUES ('Admin', 'admin@example.com', MD5('admin123'), 'admin');

-- Insert test user accounts (optional)
INSERT INTO users (name, email, password, role)
VALUES
('John Doe', 'john@example.com', MD5('password123'), 'user'),
('Jane Smith', 'jane@example.com', MD5('mypassword'), 'user');

-- Insert test parking slots (optional)
INSERT INTO parking_slots (slot_name, status)
VALUES 
('A1', 0),
('A2', 0),
('B1', 1),
('B2', 0),
('C1', 1);

-- Insert test bookings (optional)
INSERT INTO bookings (user_id, slot_id)
VALUES
((SELECT id FROM users WHERE email='john@example.com'),
 (SELECT id FROM parking_slots WHERE slot_name='B1')),
((SELECT id FROM users WHERE email='jane@example.com'),
 (SELECT id FROM parking_slots WHERE slot_name='C1'));
