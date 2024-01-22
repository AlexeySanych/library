CREATE TABLE books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title varchar(255),
    description	text,
    year smallint,
    pages smallint,
    isbn varchar(255),
    views int DEFAULT(0),
    clicks int DEFAULT(0)
);

CREATE TABLE authors (
     id INT PRIMARY KEY AUTO_INCREMENT,
     author VARCHAR(255) UNIQUE NOT NULL CHECK (author != '')
);

CREATE TABLE books_authors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    book_id INT,
    author_id INT
);

INSERT INTO books
VALUES
    (1, 'Thinking in Java (4th Edition)', 'Thinking in Java (4th Edition)', 2006, 1079, ' 0-13-187248-6', 0, 0),
    (2, 'Python for Data Analysis', 'Python for Data Analysis', 2012, 500, '978-1-491-95766', 0, 0),
    (3, 'Introduction to Algorithms', 'Introduction to Algorithms', 2009, 1313, '978-0-262-03384-8', 0, 0),
    (4, 'JavaScript Pocket Reference', 'JavaScript Pocket Reference', 1998, 280, '978-1-565-92521-2', 0, 0),
    (5, 'SQL: The Complete Referenc', 'SQL: The Complete Referenc', 2009,  960, '978-5-8459-1654-9', 0, 0),
    (6, 'PHP and MySQL Web Development', 'PHP and MySQL Web Development', 2016, 687, ' 978-0-321-83389-1', 0, 0),
    (7, 'Computer Coding for Kid', 'Computer Coding for Kid', 2016, 226, '978-0-2412-4133-2', 0, 0),
    (8, 'Programming in Go', 'Programming in Go', 2013, 582, '978-5-94074-854-0', 0, 0),
    (9, 'Clean Code', 'A Handbook of agile software craftsmanship', 2013, 464, '978-0132350884', 0, 0),
    (10, 'Responsive design', 'Building sites for an anywhere, everywhere web', 2013, 288, '978-5-496-00631-6', 0, 0),
    (11, 'Practical Vim', 'Second Edition', 2017,     3928, '978-5-97060-420-5', 0, 0);


INSERT INTO authors
VALUES
    (1, 'Bruce Eckel'),
    (2, 'Wes McKinney'),
    (3, 'Thomas H. Cormen'),
    (4, 'Charles E. Leiserson'),
    (5, 'Ronald L. Rivest'),
    (6, 'David Flanagan'),
    (7, 'James R. Groff'),
    (8, 'Paul N. Weinberg'),
    (9, 'Andrew J. Oppel'),
    (10, 'Luke Welling'),
    (11, 'Laura Thomson'),
    (12, 'Jon Woodcock'),
    (13, 'Mark Summerfield'),
    (14, 'Robert C. Martin'),
    (15, 'Tim Kadlec'),
    (16, 'Drew Neil');


INSERT INTO books_authors
VALUES
    (1, 1, 1),
    (2, 2, 2),
    (3, 3, 3),
    (4, 3, 4),
    (5, 3, 5),
    (6, 4, 6),
    (7, 5, 7),
    (8, 5, 8),
    (9, 5, 9),
    (10, 6, 10),
    (11, 6, 11),
    (12, 7, 12),
    (13, 8, 13),
    (14, 9, 14),
    (15, 10, 15),
    (16, 11, 16);