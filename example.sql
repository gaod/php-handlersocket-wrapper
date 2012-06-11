--
-- DB SCHEME
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Insert DATA
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `created`) VALUES
(101, 'foo', 'foo@example.com', '2011-03-13 17:50:40'),
(102, 'cat', 'cat@example.com', '2011-03-30 18:13:11'),
(111, 'dog', 'dog@example.com', '0000-00-00 00:00:00'),
(112, 'bar', 'bar@example.com', NULL);
