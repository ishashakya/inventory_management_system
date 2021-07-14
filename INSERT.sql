INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `image`, `bio`, `remember_token`, `created_at`, `updated_at`)
VALUES ('1', 'Isha Shakya', 'sisha@gmail.com', 'isha.shakya', NULL, '$2y$10$/vcmVhMrYkfGNrELG/3NkO4uWrCnUGUrd6YHOQ.FBMK...', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`)
VALUES ('1', 'Summer', 'summer', '1', NULL, NULL);
INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`)
VALUES ('2', 'Winter', 'winter', '1', NULL, NULL);

INSERT INTO `products` (`id`, `title`, `slug`, `brand`, `description`, `category_id`, `image`, `user_id`, `created_at`, `updated_at`)
VALUES ('1', 'Jackets', 'jackets', 'Brand I', NULL, '1', NULL, '1', NULL, NULL), ('2', 'Jeans', 'jeans', 'Brand II', NULL, '1', NULL, '1', NULL, NULL);
