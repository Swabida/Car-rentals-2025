CREATE DATABASE IF NOT EXISTS car_db;
USE car_db;

-- Admins table
CREATE TABLE user ( 
  username VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL
);

INSERT INTO `users` (`username`, `password`) VALUES
('Admin', 'admin@');

-- Cars table
CREATE TABLE cars (
  id INT AUTO_INCREMENT PRIMARY KEY,
  model VARCHAR(100),
  year YEAR,
  price DECIMAL(10,2),
  description TEXT,
  image VARCHAR(255)
);

INSERT INTO `cars` (`id`, `model`,'model','price','description','image') VALUES
(1, '2018 Honda Accord', 2020, 50.00, 'A comfortable midsize sedan with great fuel efficiency.', 'assets\images\2018_Honda_accord_sport4.jpg'),
(2, '2017 Hyundai Elantra', 2021, 60.00, 'A spacious sALOON perfect for family trips.', 'assets/images/2017_hyundai_elantra14.jpg'),
(3, '2017 Hyundai Elantra', 2019, 80.00, 'A classic American muscle car with powerful performance.', '../assets/images/2017_hyundai_elantra_15.jpg'),

-- Bookings table
CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  car_id INT,
  customer_name VARCHAR(100),
  pick_up_date DATE,
  drop_off_date DATE,
   pick_up_location VARCHAR,
  drop_off_location VARCHAR,
  total_price DECIMAL(10,2),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (car_id) REFERENCES cars(id)
);
INSERT INTO `bookings` (`id`, `car_id`, `customer_name`, `pick_up_date`, `drop_off_date`, `pick_up_location`, `drop_off_location`, `total_price`) VALUES
(1, 1, 'John Doe', '2023-10-01', '2023-10-05', 'New York', 'New York', 200.00),
(2, 2, 'Jane Smith', '2023-11-10', '2023-11-15', 'Los Angeles', 'San Francisco', 300.00);
(3, 3, 'Alice Johnson', '2023-12-20', '2023-12-25', 'Chicago', 'Chicago', 400.00);
