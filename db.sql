CREATE DATABASE complaints_db;
USE complaints_db;

CREATE TABLE complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    area VARCHAR(100),
    ward_number VARCHAR(20),
    department ENUM('Water','Road','Sanitation','Electricity','Others'),
    description TEXT,
    photo VARCHAR(255),
    status ENUM('Submitted','Accepted','In Progress','Completed') DEFAULT 'Submitted',
    completed_photo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
