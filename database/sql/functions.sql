\c order_craft;

-- Trigger to check if the product exists and if there is sufficient quantity in stock
CREATE OR REPLACE FUNCTION check_product_stock()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (SELECT 1 FROM products WHERE id = NEW.product_id) THEN
        RAISE EXCEPTION 'Product with ID % does not exist', NEW.product_id;
    END IF;

    IF (SELECT quantity_stock FROM products WHERE id = NEW.product_id) < NEW.quantity THEN
        RAISE EXCEPTION 'Insufficient quantity in stock for product with ID %', NEW.product_id;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
