CREATE TABLE users (
    user_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL,
    registered_date DATETIME NOT NULL,
    PRIMARY KEY (user_id),
    INDEX (registered_date)
) ENGINE = INNODB;

-- Dummy data
INSERT INTO users (first_name, last_name, email, hashed_password, registered_date)
VALUES 
    (
        'Jose',
        'Manalo',
        'jm@gmail.com',
        'jm123',
        NOW()
    ),
    (
        'Juan',
        'Dela Cruz',
        'jdc@aol.com',
        'jdc123',
        NOW()
    ),
    (
        'Pedro',
        'Agbayani',
        'pa@yahoo.com',
        'pa123',
        NOW()
    ),
    (
        'John',
        'Escoto',
        'je@gmail.com',
        'je123',
        NOW()
    ),
    (
        'Ricky',
        'Jones',
        'rj@gmail.com',
        'rj123',
        NOW()
    );