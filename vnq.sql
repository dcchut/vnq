CREATE TABLE `quotes` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `date` INTEGER(8) NOT NULL,
  `quote` TEXT NOT NULL,
  `up` INTEGER(8) NOT NULL,
  `down` INTEGER(8) NOT NULL,
  `status` INTEGER(4) NOT NULL,
  `ip` TEXT NOT NULL default '127.0.0.1'
);
CREATE TABLE `users` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `username` VARCHAR(40) NOT NULL,
  `password` VARCHAR(40) NOT NULL
);