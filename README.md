#SMALL PHP PROJECT
## Login Registration System

This PHP project is a simple login and registration system that utilizes a MySQL database. The database includes a table named `student_profile` with fields for user information such as first name, last name, email, and password.git 

### Table Structure

The database has one table named `student_profile` with the following structure:

```sql
CREATE TABLE student_profile (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(30) NOT NULL,
    lname VARCHAR(30) NOT NULL,
    email VARCHAR(60) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
