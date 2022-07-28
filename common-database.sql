-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 25, 2022 at 09:22 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `common-database`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `tweet_id`, `date`, `user_id`) VALUES
(1, 'ah ok super', 31, '2022-07-15 13:27:26', 14),
(2, 'super', 31, '2022-07-15 14:36:21', 2),
(3, 'ok', 31, '2022-07-18 07:57:53', 4),
(5, 'ok c\'est un com', 31, '2022-07-18 08:20:48', 4),
(6, 'ok le test', 31, '2022-07-18 08:23:21', 4),
(7, 'ok', 31, '2022-07-18 08:24:20', 4),
(8, 'le test final', 31, '2022-07-18 08:29:02', 4),
(9, 'le test de test', 31, '2022-07-18 08:35:06', 4),
(10, 'efreere', 31, '2022-07-18 08:35:17', 4),
(11, 'dzdzdz', 31, '2022-07-18 08:35:28', 4),
(12, 'cela fonctionne ', 31, '2022-07-18 08:39:12', 4),
(13, 'ok boy', 31, '2022-07-18 08:41:26', 4),
(14, 'salut', 95, '2022-07-21 14:06:54', 17);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `folllowing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `follower`, `folllowing`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `hashtag`
--

CREATE TABLE `hashtag` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `nbr_use` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hashtag`
--

INSERT INTO `hashtag` (`id`, `tag`, `nbr_use`) VALUES
(3, '#chat', 0),
(5, '#cool', 3);

-- --------------------------------------------------------

--
-- Table structure for table `private_msg`
--

CREATE TABLE `private_msg` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `private_msg`
--

INSERT INTO `private_msg` (`id`, `message`, `sender`, `receiver`) VALUES
(1, 'salut mec', 2, 4),
(6, 'mec tu es une énorme f,&quot;zitozuto\'', 4, 2),
(12, 'yo mec !', 4, 2),
(14, 'dernier test de msg_privée mec ! ', 4, 2),
(15, 'yo !', 4, 1),
(16, 'azertyuk', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `retweet`
--

CREATE TABLE `retweet` (
  `id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `retweet`
--

INSERT INTO `retweet` (`id`, `tweet_id`, `users_id`) VALUES
(6, 111, 16),
(7, 111, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tweet`
--

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url_picture` varchar(255) DEFAULT NULL,
  `like` int(11) DEFAULT '0',
  `retweet` int(11) DEFAULT '0',
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweet`
--

INSERT INTO `tweet` (`id`, `content`, `date`, `url_picture`, `like`, `retweet`, `users_id`) VALUES
(16, 'azerty', '2022-07-01 07:53:25', NULL, NULL, 0, 1),
(17, 'darezazrfaa', '2022-07-01 11:52:54', NULL, NULL, 0, 2),
(19, 'dfzkmfnezk,ezmvl,;zvùmz;lveùz;vezùmv;dsùvm;zevùme;zvmùez;vùezm;vezùmv;ezùmv;dùm;vezùvme;zùmvez;vùmez;vùmezv;ùm\r\n\r\ndfzkmfnezk,ezmvl,;zvùmz;lveùz;vezùmv;dsùvm;zevùme;zvmùez;vùezm;vezùmv;ezùmv;dùm;vezùvme;zùmvez;vùmez;vùmezv;ùm\r\n\r\n', '2022-07-01 13:04:45', NULL, NULL, 0, 2),
(20, 'azerty', '2022-07-01 13:13:27', NULL, NULL, 0, 2),
(30, 'test like ', '2022-07-08 15:03:49', NULL, NULL, 0, 4),
(31, 'salut !', '2022-07-15 09:55:30', NULL, NULL, 0, 14),
(46, 'le test d\'image est ici !!', '2022-07-18 13:12:51', 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg', NULL, 0, 4),
(63, 'ok please....', '2022-07-21 08:38:08', '../membres/imgTweet/866276.jpg', NULL, 0, 4),
(95, 'ok', '2022-07-21 13:55:01', NULL, NULL, 0, 17),
(98, 'ok salit #cool ', '2022-07-21 15:07:07', NULL, NULL, 0, 17),
(109, 'okok', '2022-07-22 14:34:39', NULL, NULL, 0, 17),
(110, 'ok on test', '2022-07-22 14:35:44', NULL, NULL, 0, 17),
(111, 'alors alors ', '2022-07-22 17:47:59', '../membres/imgTweet/124940.png', NULL, 0, 17),
(112, 'ok ok', '2022-07-25 09:20:31', NULL, 0, 0, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tweet_like`
--

CREATE TABLE `tweet_like` (
  `id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweet_like`
--

INSERT INTO `tweet_like` (`id`, `tweet_id`, `users_id`) VALUES
(1, 16, 2),
(2, 16, 1),
(3, 19, 2),
(4, 19, 2),
(5, 17, 2),
(97, 17, 4),
(120, 20, 4),
(145, 19, 4),
(153, 30, 4),
(158, 30, 2),
(160, 111, 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `Token_Auth` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `password` text NOT NULL,
  `bio` text,
  `avatar` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `Token_Auth`, `lastname`, `firstname`, `email`, `birthdate`, `country`, `password`, `bio`, `avatar`, `banner`) VALUES
(1, 'Testa!', NULL, 'testeur', 'testman', 'test@gmail.com', '1998-01-01', 'france', '123', 'je suis la test', NULL, NULL),
(2, 'tester2', NULL, 'Mtest', 'testman2.0', 'testeur2@gmail.com', '1970-02-02', 'france', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'les tests 02 c\'est ici', NULL, NULL),
(3, 'test3', NULL, 'Mmetest', 'testwomen3.0', 'test3@gmail.com', '1978-03-03', 'france', '963', 'les tests 03 c\'est ici', NULL, NULL),
(4, 'fzfezfef', NULL, 'olalala le test', 'ezfezrer', 'test123@gmail.com', '1888-01-01', NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, NULL, NULL),
(13, 'Unknown', NULL, 'Unknown', 'Unknown', 'Unknown', '0001-01-01', 'Unknown', 'Unknown', 'Unknown', 'Unknown.png', 'Unknown'),
(14, 'max67', NULL, 'pa', 'maxime', 'maxime@gmail.com', '1963-01-01', NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, NULL, NULL),
(15, 'le testeur fou', NULL, 'zert', 'ezaeazeaze', 'test003@gmail.com', '1994-02-02', NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, NULL, NULL),
(16, 'le testeur du 04', NULL, 'azerty', 'ytreza', 'test04@gmail.fr', '1994-03-03', NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, NULL, NULL),
(17, 'le test 005', NULL, 'okkkk', 'situveuxxx', 'test05@gmail.fr', '1995-05-05', NULL, '01f708168283475a39dd6830b9b0ad6c74e0e0ba', 'la bioooooo !!!!', '17.png', NULL),
(18, 'la testeuse du 0606', NULL, 'putain', 'dzdzz', 'testeur06@gmail.com', '1998-06-06', NULL, '01f708168283475a39dd6830b9b0ad6c74e0e0ba', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_tweet1` (`tweet_id`),
  ADD KEY `fk_comments_user1` (`user_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_followers_users1` (`follower`),
  ADD KEY `fk_followers_users2` (`folllowing`);

--
-- Indexes for table `hashtag`
--
ALTER TABLE `hashtag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `private_msg`
--
ALTER TABLE `private_msg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_private_msg_users1` (`receiver`),
  ADD KEY `fk_private_msg_users2` (`sender`);

--
-- Indexes for table `retweet`
--
ALTER TABLE `retweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_retweet_tweet1` (`tweet_id`),
  ADD KEY `fk_retweet_users1` (`users_id`);

--
-- Indexes for table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tweet_users` (`users_id`);

--
-- Indexes for table `tweet_like`
--
ALTER TABLE `tweet_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tweet_like_tweet1` (`tweet_id`),
  ADD KEY `fk_tweet_like_users1` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hashtag`
--
ALTER TABLE `hashtag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `private_msg`
--
ALTER TABLE `private_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `retweet`
--
ALTER TABLE `retweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tweet_like`
--
ALTER TABLE `tweet_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_tweet1` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `fk_followers_users1` FOREIGN KEY (`follower`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_followers_users2` FOREIGN KEY (`folllowing`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `private_msg`
--
ALTER TABLE `private_msg`
  ADD CONSTRAINT `fk_private_msg_users1` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_private_msg_users2` FOREIGN KEY (`sender`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `retweet`
--
ALTER TABLE `retweet`
  ADD CONSTRAINT `fk_retweet_tweet1` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_retweet_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `fk_tweet_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tweet_like`
--
ALTER TABLE `tweet_like`
  ADD CONSTRAINT `fk_tweet_like_tweet1` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tweet_like_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
