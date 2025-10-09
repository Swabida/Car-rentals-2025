CREATE DATABASE IF NOT EXISTS car_db;
USE car_db;

-- Admins table
CREATE TABLE admins (
  username VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- Cars table
CREATE TABLE cars (
  id INT AUTO_INCREMENT PRIMARY KEY,
  model VARCHAR(100),
  year YEAR,
  price DECIMAL(10,2),
  description TEXT,
  image VARCHAR(255)
);


-- Bookings table
CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  car_id INT,
  customer_name VARCHAR(100),
  pick_up_date DATE,
  drop_off_date DATE,
  total_price DECIMAL(10,2),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (car_id) REFERENCES cars(id)
);
