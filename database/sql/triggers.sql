\c order_craft;

-- Trigger to update the modified time for the user table before an update
CREATE TRIGGER update_user_modtime
BEFORE UPDATE ON public.users
FOR EACH ROW
EXECUTE FUNCTION update_updated_at_column();

-- Trigger to update the modified time for the products table before an update
CREATE TRIGGER update_products_modtime
BEFORE UPDATE ON public.products
FOR EACH ROW
EXECUTE FUNCTION update_updated_at_column();

-- Trigger to update the modified time for the orders table before an update
CREATE TRIGGER update_orders_modtime
BEFORE UPDATE ON public.orders
FOR EACH ROW
EXECUTE FUNCTION update_updated_at_column();

-- Trigger to call the check_product_stock function before inserting a new order item
CREATE TRIGGER check_product_stock_trigger
BEFORE INSERT ON order_items
FOR EACH ROW
EXECUTE FUNCTION check_product_stock();