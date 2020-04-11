DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions (
    transaction_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT(10) UNSIGNED NOT NULL,
    item_id INT UNSIGNED NOT NULL,
    -- withdrawn_quantity INT UNSIGNED NOT NULL, -- Replace with quantity and add transaction type
    -- add previous and remaining quantity
    previous_quantity INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    remaining_quantity INT UNSIGNED NOT NULL,
    transaction_type CHAR(10) NOT NULL,
    transaction_date DATETIME NOT NULL,
    remarks TEXT NOT NULL,
    PRIMARY KEY (transaction_id),
    INDEX (transaction_type),
    INDEX (transaction_date)

/* Removed foreign key constraint

    FOREIGN KEY (user_id)
        REFERENCES users (user_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION, 
    FOREIGN KEY (item_id)
        REFERENCES items (item_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION 
    
*/ 
) ENGINE = INNODB;


-- Dummy data
INSERT INTO transactions (user_id, item_id, withdrawn_quantity, transaction_date, remarks)
VALUES
    (
        6,
        2,
        25,
        NOW(),
        'Use for loader'
    ),
    (
        7,
        1,
        5,
        NOW(),
        'For PM'
    ),
    (
        9,
        3,
        6,
        NOW(),
        'For singulator maintenance'
    ),
    (
        12,
        4,
        12,
        NOW(),
        'Monthly PM'
    ),
    (
        6,
        1,
        7,
        NOW(),
        'Quarterly PM'
    ),
    (
        13,
        9,
        7,
        NOW(),
        'Yearly PM'
    );