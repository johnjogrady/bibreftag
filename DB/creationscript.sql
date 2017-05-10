-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2017 at 10:25 PM
-- Server version: 5.7.11-log
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bibreftag`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `college_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `git_hub_repo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `college_name`, `git_hub_repo`) VALUES
(1, 'John O\'Grady', 'ITB', 'https://github.com/johnjogrady/'),
(2, 'Dr Matt Smith', '', ''),
(3, 'Royce', 'Harvard', ''),
(4, 'Brennan', 'DCU', '');

-- --------------------------------------------------------

--
-- Table structure for table `bib`
--

CREATE TABLE `bib` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `bib_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_private` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bib`
--

INSERT INTO `bib` (`id`, `owner_id`, `bib_name`, `is_private`) VALUES
(1, 1, 'Thesis ITB', 1),
(2, 1, 'My really great piece of research', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bibref`
--

CREATE TABLE `bibref` (
  `id` int(11) NOT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `bib_id` int(11) DEFAULT NULL,
  `sequence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bibref`
--

INSERT INTO `bibref` (`id`, `ref_id`, `bib_id`, `sequence_id`) VALUES
(1, 1, 1, 1),
(12, 2, 1, 2),
(13, 3, 1, 3),
(14, 2, 1, 3),
(15, 3, 2, 2),
(16, 2, 1, 3),
(19, 4, 1, 2),
(20, 4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `id` int(11) NOT NULL,
  `publication_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publication_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`id`, `publication_category_id`, `name`, `publication_location`) VALUES
(1, 2, 'The Journal of Utter Nonsense', 'Bern, Switzerland'),
(2, 3, 'Looney Tunes Weekly', 'Hollywood, CA USA');

-- --------------------------------------------------------

--
-- Table structure for table `publicationcategory`
--

CREATE TABLE `publicationcategory` (
  `id` int(11) NOT NULL,
  `publication_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `publicationcategory`
--

INSERT INTO `publicationcategory` (`id`, `publication_category`) VALUES
(1, 'Journal Article'),
(2, 'Conference Paper'),
(3, 'Newspaper'),
(4, 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `ref`
--

CREATE TABLE `ref` (
  `id` int(11) NOT NULL,
  `publication_id` int(11) DEFAULT NULL,
  `ref_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publication_year` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `last_edit_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ref`
--

INSERT INTO `ref` (`id`, `publication_id`, `ref_name`, `publication_year`, `description`, `is_public`, `owner_id`, `is_confirmed`, `author_id`, `last_edit_date`) VALUES
(1, 2, 'Why I am a genius', 2017, 'Story of my life from  little fella until now', 1, 10, 0, 1, '2017-01-17'),
(2, 2, 'Symfony 3 Book', 2016, 'Symfony is a great framework founded by Fabien Potencier', 0, 1, 0, 1, NULL),
(3, 2, 'Learn Javascript', 2017, 'all the reasons why I am cool', 0, 2, 1, 2, NULL),
(4, 1, 'Agile moves too slow', 2017, 'A treatise in the follies of Agile Development', 1, 2, 1, 3, NULL),
(5, 1, 'My dummry ref', 2016, 'Cos I\'m just that smart', 0, NULL, 0, 4, NULL),
(6, 2, 'My dummry ref', 2016, 'Cos I\'m just that smart', 1, 1, 1, 3, NULL),
(7, 1, 'Spaghetti', 2016, 'code', 1, NULL, 1, 2, NULL),
(8, 2, 'Learn C++ The Really Horrible Way', 2002, 'Highly recommended to stretch your brain', 1, 15, 1, 2, NULL),
(9, 2, 'Learn C++ The Really Horrible Way', 2002, 'Highly recommended to stretch your brain', 0, NULL, 0, 2, NULL),
(10, 1, 'Learn C++ The Really Horrible Way', 2017, 'Highly recommended to stretch your brain', 0, NULL, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reftag`
--

CREATE TABLE `reftag` (
  `id` int(11) NOT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reftag`
--

INSERT INTO `reftag` (`id`, `ref_id`, `tag_id`) VALUES
(12, 1, 6),
(14, 1, 7),
(15, 1, 3),
(16, 2, 5),
(17, 3, 2),
(18, 4, 6),
(19, 2, 4),
(20, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sharedbib`
--

CREATE TABLE `sharedbib` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bib_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sharedbib`
--

INSERT INTO `sharedbib` (`id`, `user_id`, `bib_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sharedref`
--

CREATE TABLE `sharedref` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sharedref`
--

INSERT INTO `sharedref` (`id`, `user_id`, `ref_id`) VALUES
(1, 1, 2),
(2, 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numVotes` int(11) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `last_edit_date` date DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL,
  `owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `tag_name`, `numVotes`, `confirmed`, `last_edit_date`, `is_private`, `owner_id`) VALUES
(1, 'Biomedical', 65, 1, '2017-04-04', 0, NULL),
(2, 'PHP', 45, 1, '2012-11-30', 0, NULL),
(3, 'C#', 10, 1, '2017-04-01', 0, NULL),
(4, 'Twig2.0', 10, 0, '2017-04-01', 0, NULL),
(5, 'SQL Server', 10, 1, NULL, 0, NULL),
(6, 'HTML5', 5, 1, NULL, 0, NULL),
(7, 'CSS', 5, 1, '2017-04-02', 0, NULL),
(8, 'C++', 0, 0, '2016-05-02', 0, NULL),
(10, 'Baloney', 1, 0, NULL, 0, NULL),
(11, 'myTag', 0, 0, NULL, 1, NULL),
(12, 'myOtherTag', 0, 0, NULL, 1, NULL),
(13, 'johnstag', 0, 0, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_pic` varchar(255) NOT NULL,
  `is_private` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`, `enabled`, `username`, `user_pic`, `is_private`) VALUES
(1, 'john.ogrady@iwa.ie', '$2y$13$ohXUdn.p7r8X6p63Zj2SfuNEE23ekC2Seor2DikLWZ377LRetxAyS', 'ROLE_ADMIN', 1, 'John O\'Grady', '', 1),
(2, 'johnjogrady@yahoo.co.uk', '$2y$13$8x0jr.tpPv8YQnv2JKx33eZzAjiq1n5ZbPNIBJpNgQfjp1pd/YWgK', 'ROLE_ADMIN', 1, 'Joe Brown', '', 1),
(10, 'paulpogba@iwa.ie', '$2y$13$spcvKyIPrNLLea2.wC5gteGpA/cm3daZlH7ZQwD/RYXgM5Tak1jLO', 'ROLE_LECTURER', 1, 'Paul Pogba', '', 0),
(11, 'testuser@gmail.com', '$2y$13$5KEnDVgOCWViE.Xvvl84IuiGr513wo6POZSbz6Cqj7WhIhpHOoYAK', 'ROLE_USER', 1, 'Test User', '', 0),
(15, 'admin@withnail.com9877', '$2y$13$AQtdRMHbklRsAChpXIvPJuHgKLurbeqt8v1inYXT.sGysGswpxvc.', 'ROLE_USER', 1, '987', 'fac61e2fa572d3eddab1b4bbb913cee4.jpg', 0),
(16, 'admin@withnail.com98778', '$2y$13$2ZMJQYW1AB3vFjA5QyTJ0ughk.5XvbLZE7JvnWTe4BOPmHdhPe3xy', 'ROLE_USER', 1, '987', '43e30927f29696461b6b877adee50480.jpg', 0),
(17, 'john.brown@iwa.ie8', '$2y$13$XZxbTM/jQMLa4bKjrIGK9u5RwMXQAdXTA6UQyP7Pyb2BkGqoDbVSe', 'ROLE_USER', 1, '987', 'd8ad83b295bd5d2b5207aacf2721c878.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bib`
--
ALTER TABLE `bib`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9BDC50267E3C61F9` (`owner_id`);

--
-- Indexes for table `bibref`
--
ALTER TABLE `bibref`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_253C812121B741A9` (`ref_id`),
  ADD KEY `IDX_253C812168F33964` (`bib_id`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29A0E8AEC5253849` (`publication_category_id`);

--
-- Indexes for table `publicationcategory`
--
ALTER TABLE `publicationcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref`
--
ALTER TABLE `ref`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2C22784338B217A7` (`publication_id`),
  ADD KEY `IDX_2C2278437E3C61F9` (`owner_id`),
  ADD KEY `IDX_2C227843F675F31B` (`author_id`);

--
-- Indexes for table `reftag`
--
ALTER TABLE `reftag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7B9E70CC21B741A9` (`ref_id`),
  ADD KEY `IDX_7B9E70CCBAD26311` (`tag_id`);

--
-- Indexes for table `sharedbib`
--
ALTER TABLE `sharedbib`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_44F828D5A76ED395` (`user_id`),
  ADD KEY `IDX_44F828D568F33964` (`bib_id`);

--
-- Indexes for table `sharedref`
--
ALTER TABLE `sharedref`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F30600B0A76ED395` (`user_id`),
  ADD KEY `IDX_F30600B021B741A9` (`ref_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BC4F1637E3C61F9` (`owner_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bib`
--
ALTER TABLE `bib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bibref`
--
ALTER TABLE `bibref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `publicationcategory`
--
ALTER TABLE `publicationcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ref`
--
ALTER TABLE `ref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `reftag`
--
ALTER TABLE `reftag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `sharedbib`
--
ALTER TABLE `sharedbib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sharedref`
--
ALTER TABLE `sharedref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bib`
--
ALTER TABLE `bib`
  ADD CONSTRAINT `FK_9BDC50267E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `bibref`
--
ALTER TABLE `bibref`
  ADD CONSTRAINT `FK_253C812121B741A9` FOREIGN KEY (`ref_id`) REFERENCES `ref` (`id`),
  ADD CONSTRAINT `FK_253C812168F33964` FOREIGN KEY (`bib_id`) REFERENCES `bib` (`id`);

--
-- Constraints for table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `FK_29A0E8AEC5253849` FOREIGN KEY (`publication_category_id`) REFERENCES `publicationcategory` (`id`);

--
-- Constraints for table `ref`
--
ALTER TABLE `ref`
  ADD CONSTRAINT `FK_2C22784338B217A7` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`),
  ADD CONSTRAINT `FK_2C2278437E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2C227843F675F31B` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`);

--
-- Constraints for table `reftag`
--
ALTER TABLE `reftag`
  ADD CONSTRAINT `FK_7B9E70CC21B741A9` FOREIGN KEY (`ref_id`) REFERENCES `ref` (`id`),
  ADD CONSTRAINT `FK_7B9E70CCBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Constraints for table `sharedbib`
--
ALTER TABLE `sharedbib`
  ADD CONSTRAINT `FK_44F828D568F33964` FOREIGN KEY (`bib_id`) REFERENCES `bib` (`id`),
  ADD CONSTRAINT `FK_44F828D5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `sharedref`
--
ALTER TABLE `sharedref`
  ADD CONSTRAINT `FK_F30600B021B741A9` FOREIGN KEY (`ref_id`) REFERENCES `ref` (`id`),
  ADD CONSTRAINT `FK_F30600B0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `FK_3BC4F1637E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
