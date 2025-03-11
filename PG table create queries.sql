create database StayNest;
use StayNest;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pg_listings (
    pg_id INT AUTO_INCREMENT PRIMARY KEY,
    owner_id INT,
    pg_name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    facilities TEXT,
    image_url VARCHAR(255),
    available ENUM('yes', 'no') DEFAULT 'yes',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (owner_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    pg_id INT,
    check_in DATE NOT NULL,
    duration INT NOT NULL,  -- Number of months
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (pg_id) REFERENCES pg_listings(pg_id) ON DELETE CASCADE
);

CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    amount DECIMAL(10,2) NOT NULL,
    payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    transaction_id VARCHAR(255) UNIQUE,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(booking_id) ON DELETE CASCADE
);

CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password, phone, role) 
VALUES ('John Doe', 'john@example.com', 'hashedpassword', '9876543210', 'user');
select * from users;

INSERT INTO pg_listings (owner_id, pg_name, location, price, facilities, image_url) 
VALUES (1, 'Green Nest PG', 'New York', 5000.00, 'WiFi, AC, Food', 'pg1.jpg');
select * from pg_listings;

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

select * from contact_messages;
delete from contact_messages where id=7;

select * from admin;

insert into admin (admin_name, email, password) values("Rashmi", "rashmibr7549@gmail.com", "rashmi@123");

insert into admin (admin_name, email, password) values("Rashmi", "rashmibr7549@gmail.com", "rashmi@123");


select * from pg_listings;
delete from pg_listings where pg_id=1;




