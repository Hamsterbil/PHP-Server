-- Create tables
CREATE TABLE `salutation` (
    `salutation_id` int(11) NOT NULL AUTO_INCREMENT,
    `salutation` varchar(10) NOT NULL,

    PRIMARY KEY (`salutation_id`)
);

CREATE TABLE `membership` (
    `membership_id` int(11) NOT NULL AUTO_INCREMENT,
    `full_name` varchar(255) NOT NULL,
    `physical_address` varchar(255) NOT NULL,
    `salutation_id` int(11) NOT NULL,
    `age` int(3) NOT NULL,
    `email` varchar(255) UNIQUE NOT NULL,
    `phone_number` varchar(255) NOT NULL,
    `password_hash` varchar(255) NOT NULL,
    
    PRIMARY KEY (`membership_id`),
    FOREIGN KEY (`salutation_id`) REFERENCES `salutation` (`salutation_id`)
        ON DELETE CASCADE 
        ON UPDATE CASCADE 
);

CREATE TABLE `movies` (
    `movie_id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `release_year` YEAR NOT NULL,
    `genre` varchar(100),
    `rental_price` decimal(5, 2) NOT NULL,
    
    PRIMARY KEY (`movie_id`)
);

CREATE TABLE `rentals` (
    `rental_id` int(11) NOT NULL AUTO_INCREMENT,
    `membership_id` int(11) NOT NULL,
    `movie_id` int(11) NOT NULL,
    `rental_date` DATE NOT NULL,
    `return_date` DATE,

    PRIMARY KEY (`rental_id`),
    FOREIGN KEY (`membership_id`) REFERENCES `membership` (`membership_id`),
    FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


-- Sample data ---------------------------------------------------------------
-- Values for the movies table
INSERT INTO `movies` (`movie_id`, `title`, `release_year`, `genre`, `rental_price`)
VALUES
    (1, 'The Shawshank Redemption', 1994, 'Drama', 2.99),
    (2, 'Inception', 2010, 'Sci-Fi', 3.49),
    (3, 'The Dark Knight', 2008, 'Action', 3.99),
    (4, 'The Matrix', 1999, 'Sci-Fi', 2.99),
    (5, 'The Matrix Reloaded', 2003, 'Sci-Fi', 2.99),
    (6, 'The Matrix Revolutions', 2003, 'Sci-Fi', 2.99),
    (7, 'The Lord of the Rings: The Fellowship of the Ring', 2001, 'Fantasy', 3.99),
    (8, 'The Lord of the Rings: The Two Towers', 2002, 'Fantasy', 3.99),
    (9, 'The Lord of the Rings: The Return of the King', 2003, 'Fantasy', 3.99),
    (10, 'The Hobbit: An Unexpected Journey', 2012, 'Fantasy', 3.99),
    (11, 'The Hobbit: The Desolation of Smaug', 2013, 'Fantasy', 3.99),
    (12, 'The Hobbit: The Battle of the Five Armies', 2014, 'Fantasy', 3.99);

-- Values for the salutation table
INSERT INTO `salutation` (`salutation`, `salutation_id`)
VALUES
    ('Mr', NULL),
    ('Mrs', NULL),
    ('Miss', NULL),
    ('Dr', NULL);

-- Sample data for membership table with hashed passwords
INSERT INTO `membership` (`membership_id`, `salutation_id`, `full_name`, `physical_address`, `email`, `age`, `phone_number`, `password_hash`)
VALUES
    (NULL, 1, 'John Doe', '123 Main Street, Anytown, USA', 'john@example.com', 25, '12345678', '$2y$10$2aJ8G5Pheh/W.9W/MDwnk.NAn5dGhYANf3FYhxT/RJYOXVVaNtZkO'), -- Hashed version of 'P@ssw0rd'
    (NULL, 2, 'Jane Smith', '456 Main Street, Anytown, USA', 'jane@exmaple.com', 30, '87654321', '$2y$10$eQFEEl5bZCxALucSMjknG.pasQUnbL14bnlMih7KgjLfuzsNjbyHu'); -- Hashed version of 'StrongP@ss'

-- Sample data for rentals table
INSERT INTO `rentals` (`rental_id`, `membership_id`, `movie_id`, `rental_date`, `return_date`)
VALUES
    (1, 1, 1, '2023-08-01', '2023-08-08'),
    (2, 1, 2, '2023-08-02', '2023-08-09'),
    (3, 1, 3, '2023-08-03', '2023-08-10'),
    (4, 2, 1, '2023-08-04', '2023-08-11'),
    (5, 2, 2, '2023-08-05', '2023-08-12'),
    (6, 2, 3, '2023-08-06', '2023-08-13');