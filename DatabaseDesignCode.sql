CREATE TABLE student (
student_id INT NOT NULL AUTO_INCREMENT UNIQUE,
student_last_name VARCHAR(25) NOT NULL,
student_first_name VARCHAR(25) NOT NULL,
username VARCHAR(45) NOT NULL UNIQUE,
password VARCHAR(45) NOT NULL,
PRIMARY KEY (student_id)
);

CREATE TABLE skill (
skill_id INT NOT NULL AUTO_INCREMENT UNIQUE,
student_id INT NOT NULL,
skill_name VARCHAR(100),
skill_type ENUM('technology','writing','research','design','language','other'),
skill_details VARCHAR(250),
PRIMARY KEY (skill_id),
FOREIGN KEY (student_id)
REFERENCES student (student_id)
ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE student_phone (
student_phone_id INT NOT NULL AUTO_INCREMENT UNIQUE,
student_id INT NOT NULL,
student_phone CHAR(10),
student_phone_type ENUM('home','cell'),
PRIMARY KEY (student_phone_id),
FOREIGN KEY (student_id)
REFERENCES student (student_id)
ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE student_address (
student_address_id INT NOT NULL AUTO_INCREMENT UNIQUE,
student_id INT NOT NULL,
building_number VARCHAR(10),
street VARCHAR(100),
apartment VARCHAR(10),
city VARCHAR(100),
state CHAR(2),
zip CHAR(5),
on_off_campus ENUM('on campus','off campus'),
pratt_building_name VARCHAR(25),
pratt_room_number VARCHAR(5),
PRIMARY KEY (student_address_id),
FOREIGN KEY (student_id)
REFERENCES student (student_id)
ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE availability (
availability_id INT NOT NULL AUTO_INCREMENT UNIQUE,
student_id INT NOT NULL,
start_date DATE,
end_date DATE,
availability_details VARCHAR(250),
PRIMARY KEY (availability_id),
FOREIGN KEY (student_id)
REFERENCES student (student_id)
ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE student_enrollment (
student_enrollment_id INT NOT NULL AUTO_INCREMENT UNIQUE,
main_campus ENUM('Brooklyn','Manhattan'),
program_enrollment VARCHAR(100),
advanced_certificate VARCHAR(100),
degree_level ENUM('undergraduate','graduate'),
graduation_date DATE,
student_id INT NOT NULL,
PRIMARY KEY (student_enrollment_id),
FOREIGN KEY (student_id)
REFERENCES student (student_id)
ON DELETE CASCADE
ON UPDATE CASCADE
);