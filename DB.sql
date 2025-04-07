---USER
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'empolyee') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);