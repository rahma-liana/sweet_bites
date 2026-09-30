-- Sweet Bites database
CREATE DATABASE IF NOT EXISTS `sweet_bites`;
USE `sweet_bites`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT '0',
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Username: admin
-- Password: admin123
INSERT INTO `admin` (`nama`, `username`, `password`) VALUES
('Sweet Bites Admin', 'admin', '$2y$10$98vbxh4xT65X0Rnc9/L33eWkPdxz8VL4hbvd338D7IILqDOqYj4e6');

INSERT INTO `produk` (`nama`, `kategori`, `deskripsi`, `harga`, `stok`, `gambar`) VALUES
('Strawberry Cream Cookies', 'Cookies', 'Buttery cookies with strawberry cream filling and a soft pink finish.', 28000.00, 24, 'strawberry-cookies.svg'),
('Matcha Milk Pudding', 'Pudding', 'Silky matcha pudding with creamy milk layers and a gentle green tea taste.', 22000.00, 18, 'matcha-pudding.svg'),
('Berry Choco Dessert Box', 'Dessert Box', 'Chocolate sponge, berry cream, and crunchy crumbs layered in one delightful box.', 35000.00, 16, 'berry-dessert.svg'),
('Pink Velvet Cookies', 'Cookies', 'Soft-baked red velvet cookies with white chocolate chunks.', 30000.00, 20, 'pink-velvet.svg'),
('Pistachio Pudding Cup', 'Pudding', 'Creamy pistachio pudding topped with crushed nuts and a fresh finish.', 24000.00, 14, 'pistachio-pudding.svg'),
('Choco Berry Cloud', 'Dessert Box', 'Light chocolate mousse, berry sauce, and cookie crumble in a sweet little cup.', 32000.00, 12, 'choco-berry.svg');

COMMIT;
