DROP TABLE IF EXISTS users;
CREATE TABLE users (
    user_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL,
    registered_date DATETIME NOT NULL,
    -- Add user type to handle admin and normal users
    user_type CHAR(5),
    PRIMARY KEY (user_id),
    INDEX (registered_date)
) ENGINE = INNODB;