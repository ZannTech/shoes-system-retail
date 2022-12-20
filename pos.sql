
CREATE DATABASE IF NOT EXISTS `pos`;

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `brand` (`brand_id`, `name`) VALUES
(1, 'Bata'),
(2, 'Outfitters'),
(3, 'Khaadi'),
(4, 'Bareeze'),
(5, 'HSY Studio'),
(6, 'ChenOne');

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `category` (`cat_id`, `name`) VALUES
(1, 'Male'),
(2, 'Female');

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(250) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_phone` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `customer` (`c_id`, `customer_name`, `customer_address`, `customer_phone`) VALUES
(1, 'Shahzaib', 'morah kalan', '03084090617'),
(2, 'Ali Akbar', 'Morah Kalan More Khunda', '03084090617'),
(3, 'Shahiryar', 'Madina Colony Faisalabad', '03348347219');

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `purchase` (`id`, `sale_id`) VALUES
(1, 1),
(2, 2);

DROP TABLE IF EXISTS `salereceipt`;
CREATE TABLE IF NOT EXISTS `salereceipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `salereceipt` (`id`, `sale_id`) VALUES
(1, 1),
(2, 2);

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) NOT NULL,
  `dateofpurchase` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sale_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `sales` (`sale_id`, `product_id`, `dateofpurchase`) VALUES
(1, 'BT1345', '2019-12-27 19:00:00'),
(2, 'BT1346', '2019-12-28 01:43:21'),
(3, 'BT1344', '2019-12-26 01:32:25');

DROP TABLE IF EXISTS `servicereceipt`;
CREATE TABLE IF NOT EXISTS `servicereceipt` (
  `sr_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`sr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


INSERT INTO `servicereceipt` (`sr_id`, `service_id`) VALUES
(1, 1);

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `service_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `return_date` timestamp NOT NULL,
  `service_charges` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `services` (`service_id`, `sale_id`, `customer_id`, `service_date`, `return_date`, `service_charges`) VALUES
(1, 1, 3, '2019-12-29 19:00:00', '2020-01-14 19:00:00', 67.6);

DROP TABLE IF EXISTS `supplies`;
CREATE TABLE IF NOT EXISTS `supplies` (
  `product_ID` varchar(50) NOT NULL,
  `category` int(11) NOT NULL DEFAULT '0',
  `color` text NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `brand` int(11) NOT NULL DEFAULT '0',
  `size` double NOT NULL,
  `dateofentery` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `supplies` (`product_ID`, `category`, `color`, `price`, `brand`, `size`, `dateofentery`) VALUES
('BT1345', 1, 'orange', 4000, 1, 20, '2019-12-27 19:00:00'),
('BT1346', 2, 'red', 5000, 2, 30, '2019-12-27 19:00:00');

DROP TABLE IF EXISTS `usermeta`;
CREATE TABLE IF NOT EXISTS `usermeta` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(250) NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `usermeta` (`meta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'first_name', 'Shahzaib'),
(2, 1, 'last_name', 'Saifullah'),
(3, 1, 'capabilities', 'admin'),
(5, 1, 'avatar', '25490859_2.jpg'),
(7, 1, 'gender', 'male'),
(9, 2, 'first_name', 'Ali'),
(10, 2, 'last_name', 'Akbar'),
(11, 2, 'avatar', 'received_1228496093888124_9_1_1.jpeg'),
(12, 2, 'gender', 'male'),
(13, 2, 'capabilities', 'staff');

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL,
  `user_pass` varchar(300) NOT NULL,
  `user_registered` datetime DEFAULT CURRENT_TIMESTAMP,
  `display_name` varchar(300) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_registered`, `display_name`) VALUES
(1, 'shahzaib', '$2y$10$Q.STMgv4O47vEY9ybRFEe.p.KfIERFR1Q7allRh6f/2yIVbq0Uwxi', '2019-05-24 08:08:14', 'Shahzaib Chadhar'),
(2, 'aliakbar', '$2y$10$LViuqi.t.dU0VBKXajRd3exhdSziGoBT3rRJoWRnBUQyJ5spEwYwi', '2019-12-28 03:14:08', 'Ali Akbar');
COMMIT;