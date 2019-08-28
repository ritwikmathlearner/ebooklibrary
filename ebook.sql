-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2019 at 03:41 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebook`
--
CREATE DATABASE IF NOT EXISTS `ebook` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ebook`;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `authorID` int(11) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email_address` varchar(200) NOT NULL,
  `short_desc` varchar(200) NOT NULL,
  `detailed_desc` text NOT NULL,
  `img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorID`, `fullName`, `address`, `contact`, `email_address`, `short_desc`, `detailed_desc`, `img`) VALUES
(1, 'Stephen King', '37 Watson Street', '(03) 5397 9616', 'stephen.king@email.com', 'American author of horror, supernatural fiction, suspense, science fiction, and fantasy novels.', 'Stephen Edwin King (born September 21, 1947) is an American author of horror, supernatural fiction, suspense, science fiction, and fantasy novels. His books have sold more than 350 million copies, many of which have been adapted into feature films, miniseries, television series, and comic books. King has published 58 novels (including seven under the pen name Richard Bachman) and six non-fiction books. He has written approximately 200 short stories, most of which have been published in book collections.', './img/stephen.webp'),
(2, 'George R. R. Martin', '98 Harris Street', '(03) 5336 8749', 'george@gamil.com', 'George Raymond Richard Martin  is an American novelist and short story writer', 'George Raymond Richard Martin  is an American novelist and short story writer in the fantasy, horror, and science fiction genres, screenwriter, and television producer. He is best known for his series of epic fantasy novels, A Song of Ice and Fire, which was adapted into the HBO series Game of Thrones', './img/george.jpg'),
(3, 'J. K. Rowling', '44 Kerma Crescent', '(02) 4078 9825', 'rowling@gmail.com', 'Joanne Rowling better known by her pen name J. K. Rowling, is a British novelist, screenwriter, producer, and philanthropist. ', 'Joanne Rowling better known by her pen name J. K. Rowling, is a British novelist, screenwriter, producer, and philanthropist.  She is best known for writing the Harry Potter fantasy series, which has won multiple awards and sold more than 500 million copies, becoming the best-selling book series in history.', './img/rowling.webp'),
(4, 'David Baldacci', '26 Cassinia Street', '(02) 6158 9958', 'dabid@gmail.com', 'David Baldacci (born August 5, 1960) is a bestselling American novelist.', 'David Baldacci (born August 5, 1960) is a bestselling American novelist.', './img/david.jpg'),
(5, 'Paula Hawkins', '77 Goldfields Road', '(07) 4504 4358', 'paula@gmail.com', 'Paula Hawkins (born 26 August 1972) is a Zimbabwe-born British author, best known for her best-selling psychological thriller novel The Girl on the Train (2015)', 'Paula Hawkins (born 26 August 1972) is a Zimbabwe-born British author, best known for her best-selling psychological thriller novel The Girl on the Train (2015) which deals with themes of domestic violence, alcohol, and drug abuse. The novel was adapted into a film starring Emily Blunt in 2016. Hawkins\' second thriller novel, Into the Water, was released in 2017.', './img/paula.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `author` int(11) NOT NULL,
  `average_rating` decimal(9,2) NOT NULL,
  `short_desc` text NOT NULL,
  `description` text NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `image` varchar(200) NOT NULL,
  `pdf_link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `name`, `author`, `average_rating`, `short_desc`, `description`, `price`, `image`, `pdf_link`) VALUES
(1, 'The Shining', 1, '5.00', 'Jack Torrance\'s new job at the Overlook Hotel is the perfect chance for a fresh start.', 'Jack Torrance\'s new job at the Overlook Hotel is the perfect chance for a fresh start. As the off-season caretaker at the atmospheric old hotel, he\'ll have plenty of time to spend reconnecting with his family and working on his writing. But as the harsh winter weather sets in, the idyllic location feels ever more remote...and more sinister. And the only one to notice the strange and terrible forces gathering around the Overlook is Danny Torrance, a uniquely gifted five-year-old.', '9.34', 'theshining.jpg', 'theshining.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `email` varchar(200) NOT NULL,
  `book` int(11) NOT NULL,
  `rating` decimal(9,2) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`email`, `book`, `rating`, `review`) VALUES
('james.r@gmail.com', 1, '5.00', 'Very good and thrilling');

--
-- Triggers `review`
--
DELIMITER $$
CREATE TRIGGER `update_avergare_review` AFTER INSERT ON `review` FOR EACH ROW BEGIN
    UPDATE books INNER JOIN review ON books.book_id = review.book set average_rating  = (SELECT AVG(rating) from review where book = new.book) where books.book_id = new.book;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_name` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL DEFAULT 'customer',
  `credit` decimal(9,2) NOT NULL DEFAULT '10.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_name`, `name`, `email`, `password`, `type`, `credit`) VALUES
('james@123', 'James Rodriguez', 'james.r@gmail.com', '1234', 'customer', '23.98'),
('ronnie', 'Ritwik Math', 'ritwikmath@gmail.com', '1234', 'customer', '10.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`email`,`book`),
  ADD KEY `book` (`book`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author`) REFERENCES `author` (`authorID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`book`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
