-- Insert a new user
INSERT INTO users (first_name, last_name, document, email, password, phone_number, birth_date)
VALUES ('John', 'Doe', '123456789', 'john.doe@example.com', 'password123', '123456789', '1990-01-01');

-- Insert products
INSERT INTO products (name, description, quantity_stock, price)
VALUES ('Product A', 'Description of Product A', 10, 20.00),
       ('Product B', 'Description of Product B', 15, 30.00);

-- Insert an order
WITH new_order AS (
    INSERT INTO orders (user_id, description, quantity, price)
    VALUES (1, 'Test Order', 2, 50.00)
    RETURNING id
)
INSERT INTO order_items (order_id, product_id, quantity)
VALUES ((SELECT id FROM new_order), 1, 2);  -- Add 2 units of Product A to the order

-- Try to insert an order with a non-existent product
WITH new_order AS (
    INSERT INTO orders (user_id, description, quantity, price)
    VALUES (1, 'Order with Non-existent Product', 1, 25.00)
    RETURNING id
)
INSERT INTO order_items (order_id, product_id, quantity)
VALUES ((SELECT id FROM new_order), 999, 1);  -- Try to add a product with non-existent ID to the order

-- Try to insert an order with insufficient quantity in stock
WITH new_order AS (
    INSERT INTO orders (user_id, description, quantity, price)
    VALUES (1, 'Order with Insufficient Quantity', 1, 25.00)
    RETURNING id
)
INSERT INTO order_items (order_id, product_id, quantity)
VALUES ((SELECT id FROM new_order), 2, 20);  -- Try to add a larger quantity of Product B to the order than what is in stock
