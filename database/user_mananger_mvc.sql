CREATE TABLE `users` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `fullname` varchar(100),
  `email` varchar(100),
  `password` varchar(100),
  `reset_token` varchar(100),
  `active_token` varchar(100),
  `remember_token` varchar(100),
  `status` tinyint(1) DEFAULT 0,
  `group_id` integer,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `groups` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(200),
  `description` text,
  `created_at` timestamp,
  `updated_at` timestamp
);

ALTER TABLE `users` ADD FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);
