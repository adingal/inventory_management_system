CREATE TABLE items (
    item_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    item_name VARCHAR(255) NOT NULL,
    item_description TEXT NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    -- added_by VARCHAR(255) NOT NULL, -- Replace with user_id for good database design
    user_id INT(10) UNSIGNED NOT NULL,
    added_date DATETIME NOT NULL,
    PRIMARY KEY (item_id),
    INDEX (added_date)
) ENGINE = INNODB;


-- Dummy data
INSERT INTO items (item_name, item_description, quantity, added_by, added_date)
VALUES
    (
        'R52M-1A',
        'Resistor with 52 megaohms resistance and 1 ampere current capacity.',
        '10',
        'Juan Dela Cruz',
        NOW()
    ),
    (
        'R68O-5A',
        'Resistor with 68 ohms resistance and 5 amperes current capacity.',
        '23',
        'Jose Manalo',
        NOW() - 2
    ),
    (
        'R1M-3A',
        'Resistor with 1 megaohm resistance and 3 amperes current capacity.',
        '2',
        'Rufino David',
        NOW() + 1
    ),
    (
        'R50O-2A',
        'Resistor with 50 ohms resistance and 2 amperes current capacity.',
        '54',
        'Freddy Aguilar',
        NOW() + 4
    );