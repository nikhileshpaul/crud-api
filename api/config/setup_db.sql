CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;


INSERT INTO `products` (`id`, `name`, `description`, `price`, `created`, `modified`) VALUES
(1, 'Ipad', 'Apple Ipad', '555', '2021-06-06 01:12:26', NULL),
(2, 'Iphone', 'Apple Iphone', '1500', '2021-06-06 01:12:26', NULL),
(3, 'Macbook', 'Macbook Air', '1500', '2021-06-06 01:12:26', NULL);