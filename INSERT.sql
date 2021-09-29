INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `image`, `bio`, `remember_token`, `created_at`, `updated_at`)
VALUES ('1', 'Isha Shakya', 'sisha@gmail.com', 'isha.shakya', NULL, '$2y$10$/vcmVhMrYkfGNrELG/3NkO4uWrCnUGUrd6YHOQ.FBMK...', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`)
VALUES ('1', 'Summer', 'summer', '1', NULL, NULL);
INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`)
VALUES ('2', 'Winter', 'winter', '1', NULL, NULL);

INSERT INTO `products` (`id`, `title`, `slug`, `brand`, `description`, `category_id`, `image`, `user_id`, `created_at`, `updated_at`)
VALUES ('1', 'Jackets', 'jackets', 'Brand I', NULL, '1', NULL, '1', NULL, NULL), ('2', 'Jeans', 'jeans', 'Brand II', NULL, '1', NULL, '1', NULL, NULL);

SELECT SUM(s.quantity),products.title
FROM `sales_details` AS s, products
WHERE s.product_id = products.id
GROUP BY product_id ORDER BY SUM(quantity) DESC


SELECT SUM(credit), transaction_type
FROM `transactions`
WHERE date>='2021-07-12' AND date<='2021-07-14'
GROUP by transaction_type

SELECT SUM(price-cp)
FROM `sales_details`
WHERE created_at>='2021-07-12' AND date(created_at)<='2021-07-14'

SELECT c.id, c.name, SUM(sd.quantity)
FROM `sales_details` sd, products p, categories c
WHERE sd.product_id = p.id AND p.category_id = c.id
GROUP BY c.id ORDER BY SUM(sd.quantity) DESC

TRUNCATE categories;
TRUNCATE inventories;
TRUNCATE products;
TRUNCATE sales_details;
TRUNCATE transactions;
TRUNCATE transactions_details;
TRUNCATE users; 
