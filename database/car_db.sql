CREATE DATABASE car_rental_db;

USE car_rental_db;

-- Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('admin', 'manager', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Cars table
CREATE TABLE cars (
    id INT PRIMARY KEY AUTO_INCREMENT,
    make VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    rental_price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    status ENUM('available', 'rented', 'sold', 'maintenance') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Blogs table
CREATE TABLE blogs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id)
);

-- Bookings table
CREATE TABLE bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    car_id INT NOT NULL,
    user_id INT NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20),
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'confirmed', 'active', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES cars(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
-- Admin user
INSERT INTO users (username, password, email, full_name, role) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@carrental.com', 'System Administrator', 'admin');

-- Manager user
INSERT INTO users (username, password, email, full_name, role) 
VALUES ('manager', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'manager@carrental.com', 'John Manager', 'manager');

-- Regular user
INSERT INTO users (username, password, email, full_name, role) 
VALUES ('customer1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer1@example.com', 'John Doe', 'user');

-- Another regular user
INSERT INTO users (username, password, email, full_name, role) 
VALUES ('customer2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer2@example.com', 'Jane Smith', 'user');
-- Sedans
INSERT INTO cars (make, model, year, price, rental_price, description, image_url, status) 
VALUES 
('Toyota', 'Camry', 2023, 25000.00, 75.00, 'Reliable and fuel-efficient sedan with modern features and comfortable interior.', '/assets/images/cars/toyota-camry.jpg', 'available'),
('Honda', 'Accord', 2023, 28000.00, 85.00, 'Spacious sedan with advanced safety features and smooth ride quality.', '/assets/images/cars/honda-accord.jpg', 'available'),
('Nissan', 'Altima', 2022, 22000.00, 70.00, 'Comfortable midsize sedan with excellent fuel economy and tech features.', '/assets/images/cars/nissan-altima.jpg', 'available'),
('Mazda', '6', 2023, 26000.00, 80.00, 'Sporty sedan with premium interior and responsive handling.', '/assets/images/cars/mazda-6.jpg', 'available'),
('Hyundai', 'Elantra', 2023, 20000.00, 65.00, 'Stylish compact sedan with great warranty and fuel efficiency.', '/assets/images/cars/hyundai-elantra.jpg', 'available');


-- SUVs
INSERT INTO cars (make, model, year, price, rental_price, description, image_url, status) 
VALUES 
('Toyota', 'RAV4', 2023, 30000.00, 95.00, 'Compact SUV with hybrid option, spacious interior and advanced safety features.', '/assets/images/cars/toyota-rav4.jpg', 'available'),
('Honda', 'CR-V', 2023, 32000.00, 100.00, 'Popular SUV with cargo space, comfortable seating and reliable performance.', '/assets/images/cars/honda-cr-v.jpg', 'available'),
('Ford', 'Escape', 2023, 28000.00, 90.00, 'Versatile SUV with available hybrid power and advanced tech features.', '/assets/images/cars/ford-escape.jpg', 'available'),
('Chevrolet', 'Equinox', 2023, 27000.00, 85.00, 'Compact SUV with comfortable ride and ample cargo space.', '/assets/images/cars/chevrolet-equinox.jpg', 'available'),
('Mazda', 'CX-5', 2023, 29000.00, 95.00, 'Premium compact SUV with upscale interior and athletic handling.', '/assets/images/cars/mazda-cx-5.jpg', 'available');


-- Luxury Cars
INSERT INTO cars (make, model, year, price, rental_price, description, image_url, status) 
VALUES 
('BMW', '3 Series', 2023, 45000.00, 150.00, 'Luxury sedan with sporty performance, premium interior and advanced technology.', '/assets/images/cars/bmw-3-series.jpg', 'available'),
('Mercedes-Benz', 'C-Class', 2023, 48000.00, 160.00, 'Elegant luxury sedan with sophisticated design and cutting-edge features.', '/assets/images/cars/mercedes-c-class.jpg', 'available'),
('Audi', 'A4', 2023, 47000.00, 155.00, 'Premium sedan with Quattro all-wheel drive and upscale cabin.', '/assets/images/cars/audi-a4.jpg', 'available'),
('Lexus', 'ES', 2023, 42000.00, 140.00, 'Luxury sedan with exceptional comfort, quiet cabin and reliability.', '/assets/images/cars/lexus-es.jpg', 'available'),
('Cadillac', 'CT5', 2023, 44000.00, 145.00, 'Modern luxury sedan with bold styling and advanced tech features.', '/assets/images/cars/cadillac-ct5.jpg', 'available');


-- Sports Cars
INSERT INTO cars (make, model, year, price, rental_price, description, image_url, status) 
VALUES 
('Ford', 'Mustang', 2023, 55000.00, 200.00, 'Iconic American muscle car with powerful engine and aggressive styling.', '/assets/images/cars/ford-mustang.jpg', 'available'),


-- Trucks
INSERT INTO cars (make, model, year, price, rental_price, description, image_url, status) 
VALUES 
('Ford', 'F-150', 2023, 38000.00, 120.00, 'Best-selling truck with towing capacity, durability and versatility.', '/assets/images/cars/ford-f150.jpg', 'available'),
('Chevrolet', 'Silverado', 2023, 37000.00, 115.00, 'Reliable truck with strong performance and advanced features.', '/assets/images/cars/chevrolet-silverado.jpg', 'available'),
('Ram', '1500', 2023, 36000.00, 110.00, 'Comfortable truck with smooth ride and innovative features.', '/assets/images/cars/ram-1500.jpg', 'available'),
('Toyota', 'Tundra', 2023, 39000.00, 125.00, 'Reliable truck with powerful engine and long-term durability.', '/assets/images/cars/toyota-tundra.jpg', 'available'),
('GMC', 'Sierra', 2023, 38500.00, 118.00, 'Premium truck with upscale interior and advanced technology.', '/assets/images/cars/gmc-sierra.jpg', 'available');


-- Electric/Hybrid Cars
INSERT INTO cars (make, model, year, price, rental_price, description, image_url, status) 
VALUES 
('Tesla', 'Model 3', 2023, 42000.00, 130.00, 'Electric sedan with autopilot, long range and premium interior.', '/assets/images/cars/tesla-model3.jpg', 'available'),
('Tesla', 'Model Y', 2023, 45000.00, 140.00, 'Electric SUV with ample space, autopilot and impressive performance.', '/assets/images/cars/tesla-modely.jpg', 'available'),
('Toyota', 'Prius', 2023, 28000.00, 90.00, 'Hybrid sedan with exceptional fuel economy and reliability.', '/assets/images/cars/toyota-prius.jpg', 'available'),
('Hyundai', 'Ioniq 5', 2023, 45000.00, 135.00, 'Electric SUV with unique design, long range and fast charging.', '/assets/images/cars/hyundai-ioniq5.jpg', 'available'),
('Ford', 'Mustang Mach-E', 2023, 43000.00, 125.00, 'Electric SUV inspired by Mustang with impressive performance.', '/assets/images/cars/ford-mustang-mach-e.jpg', 'available');

-- Some cars with different statuses
INSERT INTO cars (make, model, year, price, rental_price, description, image_url, status) 
VALUES 
('Toyota', 'Camry', 2022, 22000.00, 65.00, 'Previous year model with great value and reliability.', '/assets/images/cars/toyota-camry-2022.jpg', 'rented'),
('Honda', 'CR-V', 2022, 29000.00, 90.00, 'Last year model with proven performance and features.', '/assets/images/cars/honda-cr-v-2022.jpg', 'rented'),
('BMW', 'X5', 2023, 65000.00, 200.00, 'Luxury SUV with premium features and powerful engine.', '/assets/images/cars/bmw-x5.jpg', 'maintenance'),
('Audi', 'Q7', 2023, 62000.00, 195.00, 'Premium SUV with spacious interior and advanced technology.', '/assets/images/cars/audi-q7.jpg', 'sold'),
('Mercedes-Benz', 'GLC', 2023, 58000.00, 180.00, 'Compact luxury SUV with elegant design and comfort.', '/assets/images/cars/mercedes-glc.jpg', 




