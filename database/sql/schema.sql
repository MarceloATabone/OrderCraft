
-- CREATE DATABASE (if needed) --
CREATE DATABASE order_craft;

-- Connect to the database --
\c order_craft;

-- CREATE EXTENSIONS (if needed) --
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";


-- Define a user table 
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    document VARCHAR(20) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
	password varchar(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    birth_date DATE DEFAULT NULL,
	created_at timestamp NOT NULL DEFAULT current_timestamp,
	updated_at timestamp DEFAULT current_timestamp
);

-- Defines the products table
CREATE TABLE IF NOT EXISTS products (
    id SERIAL PRIMARY KEY,
    name varchar(100) NOT NULL,
    description varchar(255) DEFAULT NULL,
    quantity_stock INT NOT NULL,
    price DECIMAL(10, 2),
	created_at timestamp NOT NULL DEFAULT current_timestamp,
	updated_at timestamp DEFAULT current_timestamp
);


-- Defines the order table
CREATE TABLE IF NOT EXISTS orders (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    description varchar(255) DEFAULT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2),
	created_at timestamp NOT NULL DEFAULT current_timestamp,
	updated_at timestamp DEFAULT current_timestamp,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Define a order_items table
CREATE TABLE IF NOT EXISTS order_items (
    id SERIAL PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    CHECK (quantity > 0)  -- Garante que a quantidade seja positiva
);

