CREATE TABLE users (
                   id INT AUTO_INCREMENT PRIMARY KEY,
                   username VARCHAR(50) NOT NULL UNIQUE,
                   email VARCHAR(100) NOT NULL UNIQUE,
                   password VARCHAR(255) NOT NULL,
                   role ENUM('administrator', 'author', 'user') NOT NULL DEFAULT 'user',
                   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);