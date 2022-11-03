-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2022 at 09:33 AM
-- Server version: 5.7.24
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `globalbooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_surname` varchar(255) NOT NULL,
  `author_dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `author_surname`, `author_dob`) VALUES
(1, 'Stephen', 'King', '1947-09-21'),
(2, 'J.K.', 'Rowling', '1965-07-31'),
(3, 'Amy', 'Tan', '1952-02-19'),
(4, 'awd', 'awd', '2020-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `authors_genre`
--

CREATE TABLE `authors_genre` (
  `authors_genre_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors_genre`
--

INSERT INTO `authors_genre` (`authors_genre_id`, `author_id`, `genre_id`) VALUES
(29, 1, 1),
(30, 1, 2),
(31, 2, 1),
(32, 3, 2),
(36, 4, 1),
(37, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_desc` varchar(10000) NOT NULL,
  `book_published_date` date NOT NULL,
  `genre_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `book_desc`, `book_published_date`, `genre_id`, `status_id`, `author_id`) VALUES
(1, 'Fairy Tale', 'Legendary storyteller Stephen King goes into the deepest well of his imagination in this spellbinding novel about a seventeen-year-old boy who inherits the keys to a parallel world where good and evil are at war, and the stakes could not be higher—for their world or ours.', '2022-09-06', 1, 2, 1),
(2, 'Harry Potter and the Chamber of Secrets', 'This a fantasy novel written by British author J K Rowling and the second novel in the Harry Potter series The plot follows Harrys second year at Hogwarts School of Witchcraft and Wizardry during which a series of messages on the walls of the schools corridors warn that the Chamber of Secrets has been opened and that the heir of Slytherin would kill all pupils who do not come from all magical families These threats are found after attacks that leave residents of the school petrified Throughout the year Harry and his friends Ron and Hermione investigate the attacks ', '1998-07-02', 1, 2, 2),
(3, 'The Hundred Secret Senses', 'The story focuses on the relationship between Chinese-born Kwan and her younger, Chinese-American sister Olivia, who serves as the book\'s primary narrator. Olivia and Kwan\'s relationship begins when their father dies and Kwan is sent to live with the family. Olivia is embarrassed by Kwan because she is unfamiliar with American customs and does not speak English well. She constantly makes a fool of herself, and Olivia is teased by peers for having a \"retarded\" sister.\r\n\r\nKwan relates to Olivia through the telling of Chinese tales and superstitions. She believes she has \"Yin eyes\", which means that she can see ghosts. She converses with them at night, frightening Olivia. She speaks Chinese in private, and Olivia picks up the language. Kwan believes that her stories are not just stories; they are based on her belief that she is part of the Yin world, the world of the ghosts. She believes that she is recounting tales from her past lives. In the melding of Olivia\'s modern Western world and Kwan\'s yin world, Olivia and Kwan create Asian-American identities for themselves, individually and together.\r\n\r\nKwan plans a trip to China which is actually a scheme to get Olivia and her estranged husband, Simon, back together. Now Kwan serves as the translator for the writer (Simon) and photographer (Olivia). The real purpose of the trip is to discover Olivia and Kwan\'s connection to the Yin world.\r\n\r\nKwan makes Olivia come to see that besides what we understand through our five senses, there are many things that can only be understood by using the \"hundred secret senses\". This story is about the journey of identity, family history, past lives, and ultimately, love.', '1995-10-17', 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `books_rented`
--

CREATE TABLE `books_rented` (
  `rented_id` int(11) NOT NULL,
  `rented_date` date NOT NULL,
  `rented_return_date` date NOT NULL,
  `rented_date_returned` date DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `books_rented_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books_rented`
--

INSERT INTO `books_rented` (`rented_id`, `rented_date`, `rented_return_date`, `rented_date_returned`, `member_id`, `book_id`, `books_rented_status_id`) VALUES
(1, '2022-09-01', '2022-10-02', NULL, 1, 1, 4),
(3, '2022-09-22', '2022-09-22', '2022-09-27', 3, 2, 4),
(4, '2022-09-22', '2022-09-30', '2022-09-27', 3, 3, 2),
(5, '2022-09-27', '2022-10-27', NULL, 3, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `books_rented_status`
--

CREATE TABLE `books_rented_status` (
  `books_rented_status_id` int(11) NOT NULL,
  `books_rented_status_name` varchar(255) NOT NULL,
  `books_rented_status_desc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books_rented_status`
--

INSERT INTO `books_rented_status` (`books_rented_status_id`, `books_rented_status_name`, `books_rented_status_desc`) VALUES
(1, 'Active', 'This rental order is still ongoing.'),
(2, 'Completed', 'This rental order has been completed.'),
(3, 'Reserved', 'This book has been rented as is awaiting collection.'),
(4, 'Overdue', 'This rental order has passed its return date and a fine will be issues once the member returns the book.');

-- --------------------------------------------------------

--
-- Table structure for table `books_status`
--

CREATE TABLE `books_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `status_desc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books_status`
--

INSERT INTO `books_status` (`status_id`, `status_name`, `status_desc`) VALUES
(1, 'Available', 'This book can be rented.'),
(2, 'Unavailable', 'This book has been rented and is therefore not available.'),
(3, 'Inactive', 'This book has been lost, stolen or is unobtainable.');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(255) NOT NULL,
  `genre_desc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`, `genre_desc`) VALUES
(1, 'Fantasy', 'These books are about magic and the supernatural.'),
(2, 'Science Fiction', 'These books are usually about stories set in the distant future.');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `member_surname` varchar(255) NOT NULL,
  `member_date_of_birth` date NOT NULL,
  `member_email` varchar(255) NOT NULL,
  `member_password` varchar(255) NOT NULL,
  `member_contact_number` char(10) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_name`, `member_surname`, `member_date_of_birth`, `member_email`, `member_password`, `member_contact_number`, `role_id`) VALUES
(1, 'Marie', 'Sue', '1992-09-17', 'mari@gmail.com', '$2y$10$m4MgpTs6V0o.fMZd1itJYeoGumllK3GfBpLZF2yNUYBZ9oIpdDOPC', '0815699564', 1),
(3, 'Martin', 'Louw', '2022-09-15', 'martin@louw.com', '$2y$10$/Jn.2ex5qhZFaogtvVVkcOFM7EUbyPRbFSf6SJkfo912Ckjd556La', '0126547894', 1),
(4, 'Sarie', 'Mare', '1985-02-09', 'sarie@mare.com', '$2y$10$zBX5nqht1kayraRWDgYH0uNcyozJb5jwMPqxxu4BQYW/HRaEZU/O.', '0321456987', 2);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_desc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_desc`) VALUES
(1, 'Member', 'This role is given to individuals that make use of Global Books\'s services.'),
(2, 'Librarian', 'This role is given to individuals that works as librarians for Global Books.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `authors_genre`
--
ALTER TABLE `authors_genre`
  ADD PRIMARY KEY (`authors_genre_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `books_rented`
--
ALTER TABLE `books_rented`
  ADD PRIMARY KEY (`rented_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `books_rented_status_id` (`books_rented_status_id`);

--
-- Indexes for table `books_rented_status`
--
ALTER TABLE `books_rented_status`
  ADD PRIMARY KEY (`books_rented_status_id`);

--
-- Indexes for table `books_status`
--
ALTER TABLE `books_status`
  ADD PRIMARY KEY (`status_id`),
  ADD UNIQUE KEY `status_name_index` (`status_name`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `genre_name_index` (`genre_name`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `email_index` (`member_email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name_index` (`role_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `authors_genre`
--
ALTER TABLE `authors_genre`
  MODIFY `authors_genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books_rented`
--
ALTER TABLE `books_rented`
  MODIFY `rented_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `books_rented_status`
--
ALTER TABLE `books_rented_status`
  MODIFY `books_rented_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `books_status`
--
ALTER TABLE `books_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authors_genre`
--
ALTER TABLE `authors_genre`
  ADD CONSTRAINT `authors_genre_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`),
  ADD CONSTRAINT `authors_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`);

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `books_status` (`status_id`),
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`);

--
-- Constraints for table `books_rented`
--
ALTER TABLE `books_rented`
  ADD CONSTRAINT `books_rented_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `books_rented_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `books_rented_ibfk_3` FOREIGN KEY (`books_rented_status_id`) REFERENCES `books_rented_status` (`books_rented_status_id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
