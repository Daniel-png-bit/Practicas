USE example3;

CREATE TABLE professor
(id INT NOT NULL AUTO_INCREMENT,
first_name VARCHAR(50),
last_name VARCHAR(50),
city VARCHAR(50),
years_experience INT,
salary DECIMAL(10,2),
PRIMARY KEY(id)
)