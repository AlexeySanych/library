CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users VALUES (1, 'admin', '$2y$10$tn6ktk4RpoJ9cenqJ8gIvuMhCseS54OLgjdpyY26BqA35qJnl8nIa');