-- Dumping database structure for micro
/*CREATE DATABASE IF NOT EXISTS `micro` */ /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `micro`;

-- Dumping structure for table micro.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_type` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table micro.posts: ~3 rows (approximately)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `post_type`, `slug`, `title`, `content`, `status`, `is_deleted`, `created_on`, `updated_on`) VALUES
	(1, 1, 'hello-world', 'Hello World', '&lt;div class=&quot;container&quot;&gt;\r\n\r\n&lt;h3&gt;Forests are the ecosystem of Earth&lt;/h3&gt;\r\n&lt;p&gt;A forest is a large area dominated by trees.\r\n Hundreds of more precise definitions of forest are used throughout the world, incorporating factors such as tree density, tree height, land use, legal standing and ecological function.\r\n \r\nAccording to the widely used United Nations Food and Agriculture Organization definition, forests covered four billion hectares (15 million square miles) or approximately 30 percent of the world&#039;s land area in 2006.&lt;/p&gt;\r\n\r\n&lt;div id=&quot;features&quot;&gt;&lt;img src=&quot;/img/front/1.png&quot; style=&quot;width: 357px; height: 270.768px;&quot;&gt;&lt;/div&gt;\r\n\r\n&lt;b&gt;This is new text11&lt;/b&gt;\r\n\r\n&lt;p&gt;Forests at different latitudes and elevations form distinctly different ecozones: boreal forests near the poles, tropical forests near the equator and temperate forests at mid-latitude. Higher elevation areas tend to support forests similar to those at higher latitudes, and amount of precipitation also affects forest composition.&lt;/p&gt;\r\n\r\n&lt;/div&gt;', 0, 0, '2017-07-06 16:10:40', '2017-07-14 23:02:02'),
	(2, 1, 'post-features', 'My Page 1', '&lt;section id=&quot;features&quot;&gt;\r\n		&lt;div class=&quot;container&quot;&gt;\r\n			&lt;div class=&quot;row&quot;&gt;\r\n				&lt;div class=&quot;center&quot;&gt;\r\n					&lt;div class=&quot;col-md-6 col-md-offset-3&quot;&gt;\r\n						&lt;h2&gt;Features&lt;/h2&gt;\r\n						&lt;hr&gt;\r\n						&lt;p class=&quot;lead&quot;&gt;This page is coming from internal posts&lt;/p&gt;\r\n					&lt;/div&gt;\r\n				&lt;/div&gt;\r\n\r\n				&lt;div class=&quot;col-md-4 wow fadeInLeft&quot;&gt;\r\n					&lt;h3&gt;Responsive&lt;/h3&gt;\r\n					&lt;img src=&quot;/img/front/feature1.png&quot; alt=&quot;&quot;&gt;\r\n					&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut\r\n					non cupidatat skateboard dolor brunch.&lt;/p&gt;\r\n				&lt;/div&gt;\r\n\r\n				&lt;div class=&quot;col-md-4 wow fadeInUp&quot;&gt;\r\n					&lt;h3&gt;Web Design&lt;/h3&gt;\r\n					&lt;img src=&quot;/img/front/feature2.png&quot; alt=&quot;&quot;&gt;\r\n					&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut\r\n					non cupidatat skateboard dolor brunch.&lt;/p&gt;\r\n				&lt;/div&gt;\r\n\r\n				&lt;div class=&quot;col-md-4 wow fadeInRight&quot;&gt;\r\n					&lt;h3&gt;Easy Customize&lt;/h3&gt;\r\n					&lt;img src=&quot;/img/front/feature3.png&quot; alt=&quot;&quot;&gt;\r\n					&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut\r\n					non cupidatat skateboard dolor brunch.&lt;/p&gt;\r\n				&lt;/div&gt;\r\n			&lt;/div&gt;\r\n		&lt;/div&gt;\r\n	&lt;/section&gt;', 1, 0, '2017-07-06 16:10:40', '2017-07-11 15:46:05'),
	(3, 1, '404', '404', '&lt;section id=&quot;features&quot;&gt;\r\n	&lt;div class=&quot;container&quot;&gt;\r\n		&lt;div class=&quot;row&quot;&gt;\r\n			&lt;div class=&quot;center&quot;&gt;\r\n				&lt;div class=&quot;col-md-6 col-md-offset-3&quot;&gt;\r\n					&lt;h2&gt;Error 404&lt;/h2&gt;\r\n					&lt;hr&gt;\r\n					&lt;p class=&quot;lead&quot;&gt;The page you are looking for does not exist&lt;/p&gt;\r\n				&lt;/div&gt;\r\n			&lt;/div&gt;\r\n		&lt;/div&gt;\r\n	&lt;/div&gt;\r\n&lt;/section&gt;\r\n', 0, 0, '2017-07-06 16:10:40', '2017-07-16 15:03:17');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table micro.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table micro.roles: ~2 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `created_on`, `updated_on`) VALUES
	(1, 'User', '2017-06-27 17:06:29', '2017-06-27 17:07:01'),
	(2, 'Admin', '2017-06-27 17:06:29', '2017-06-27 17:07:04');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table micro.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `about` text,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `udated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_roles_id` (`roles_id`),
  CONSTRAINT `FK_roles_id` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table micro.users: ~14 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `roles_id`, `username`, `password`, `fullname`, `email`, `mobile`, `address`, `about`, `status`, `is_deleted`, `created_on`, `udated_on`) VALUES
	(1, 2, 'admin', 'admin', 'Administrator', 'aa@aa.aa', '95666655', 'asdasd', '', 0, 0, '2017-06-27 17:00:51', '2017-07-16 14:55:50'),
	(2, 1, 'user', 'user', 'Andrew Mathue', 'usr@ss.ss', '2533522', '', '', 0, 0, '2017-06-27 17:01:39', '2017-07-07 14:34:25'),
	(3, 1, 'angelica', '123', 'Angelica Ramo', 'aa1@aa.aa', '2323423423', '', '', 0, 0, '2017-07-04 19:05:47', '2017-07-07 15:43:51'),
	(4, 1, 'ashton', '123', 'Ashton Cox', 'aa@aa.aac', '999666663', '', '', 0, 0, '2017-07-04 19:07:08', '2017-07-07 13:24:45'),
	(5, 1, 'bradley', '123', 'Bradley Greer', 'sdf@sds.sds', '23423432', NULL, NULL, 0, 0, '2017-07-04 19:08:12', '2017-07-07 14:34:48'),
	(6, 1, 'brenden', '123', 'Brenden Wagner', 'ddd@ddd.dd', '22222', NULL, NULL, 0, 1, '2017-07-04 19:08:41', '2017-07-07 13:22:37'),
	(7, 1, 'brielle', '123', 'Brielle Williamson', 'asdasd@eqwe.qwewqe', '25552585', NULL, NULL, 0, 0, '2017-07-04 19:11:34', '2017-07-07 13:24:51'),
	(8, 1, 'bruno', '123', 'Bruno Nash', 'sdd@sdsd.dsds', 'sd', NULL, NULL, 0, 0, '2017-07-04 19:17:00', '2017-07-07 13:23:01'),
	(9, 1, 'caesar', '123', 'Caesar Vance', 'sdd@sdsd.dsds', 'sd', NULL, NULL, 0, 0, '2017-07-04 19:17:09', '2017-07-07 13:23:12'),
	(10, 1, 'cara', '123', 'Cara Stevens', 'cara@xmail.com', '7307105700', NULL, NULL, 0, 0, '2017-07-04 19:57:07', '2017-07-07 13:24:30'),
	(11, 1, 'cedric', '123', 'Cedric Kelly', 'ffff@ss.ss', '3333333333', NULL, NULL, 0, 0, '2017-07-04 19:57:58', '2017-07-07 13:23:43'),
	(12, 1, 'dairios', '123', 'Dai Rios', 'dddd@xmail.cg', '7307105700', NULL, NULL, 0, 0, '2017-07-04 20:04:37', '2017-07-07 13:24:39'),
	(13, 1, 'fiona', '123', 'Fiona Green', 'sam@sam.com', '85632547', NULL, NULL, 0, 0, '2017-07-05 17:12:02', '2017-07-07 13:24:04'),
	(16, 1, 'newwwww', '1111', 'Peter Anderson', 'pander7070@gmail.com', NULL, NULL, NULL, 0, 0, '2017-07-14 16:23:38', '2017-07-14 16:31:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
