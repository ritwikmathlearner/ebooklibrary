-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2019 at 03:54 PM
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
(4, 'David Baldacci', '26 Cassinia Street', '(02) 6158 9958', 'dabid@gmail.com', 'David Baldacci (born August 5, 1960) is a bestselling American novelist.', 'David published his first novel, Absolute Power, in 1996. The feature film adaptation followed, with Clint Eastwood as its director and star. In total, David has published 37 novels for adults; all have been national and international bestsellers, and several have been adapted for film and television. His novels are published in over 45 languages and in more than 80 countries, with over 130 million worldwide sales. David has also published seven novels for younger readers.', './img/david.jpg'),
(5, 'Paula Hawkins', '77 Goldfields Road', '(07) 4504 4358', 'paula@gmail.com', 'Paula Hawkins (born 26 August 1972) is a Zimbabwe-born British author, best known for her best-selling psychological thriller novel The Girl on the Train (2015)', 'Paula Hawkins (born 26 August 1972) is a Zimbabwe-born British author, best known for her best-selling psychological thriller novel The Girl on the Train (2015) which deals with themes of domestic violence, alcohol, and drug abuse. The novel was adapted into a film starring Emily Blunt in 2016. Hawkins\' second thriller novel, Into the Water, was released in 2017.', './img/paula.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `author` int(11) NOT NULL,
  `average_rating` decimal(9,1) NOT NULL,
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
(1, 'The Shining', 1, '5.0', 'Jack Torrance\'s new job at the Overlook Hotel is the perfect chance for a fresh start.', 'Jack Torrance\'s new job at the Overlook Hotel is the perfect chance for a fresh start. As the off-season caretaker at the atmospheric old hotel, he\'ll have plenty of time to spend reconnecting with his family and working on his writing. But as the harsh winter weather sets in, the idyllic location feels ever more remote...and more sinister. And the only one to notice the strange and terrible forces gathering around the Overlook is Danny Torrance, a uniquely gifted five-year-old.', '9.34', './img/theshining.jpg', 'theshining.pdf'),
(2, 'Stephen King\'s N', 1, '0.0', 'There is something unearthly and mysterious deep in Acherman\'s Field in rural Maine. ', 'There is something unearthly and mysterious deep in Acherman\'s Field in rural Maine. There is a Stonehenge-like arrangement of seven stones with a horrifying EYE in the center. And whatever dwells there in that strange, windswept setting may have brought about the suicide of one man...and harbor death for the OCD afflicted \"N.,\" whose visits to the field have passed beyond compulsion into the realm of obsession. Based on the chilling short story from the recent Stephen King collection, JUST AFTER SUNSET, this adaptation will provide nightmares aplenty. Just keep counting the stories...keep counting...counting COLLECTING: Stephen King\'s N.', '7.28', './img/n.jpg', 'n.pdf'),
(3, 'It', 1, '0.0', 'They were seven teenagers when they first stumbled upon the horror.', 'They were seven teenagers when they first stumbled upon the horror. Now they are grown-up men and women who have gone out into the big world to gain success and happiness. But none of them can withstand the force that has drawn them back to Derry to face the nightmare without an end, and the evil without a name.', '10.45', './img/It.jpg', 'It.pdf'),
(4, 'The Outsider', 1, '0.0', 'An unspeakable crime. A confounding investigation. At a time when the King brand has never been stronger, he has delivered one of his most unsettling and compulsively readable stories.', 'An unspeakable crime. A confounding investigation. At a time when the King brand has never been stronger, he has delivered one of his most unsettling and compulsively readable stories. ', '15.50', './img/theoutsider.jpg', 'theoutsider.pdf'),
(5, 'The Green Mile', 1, '0.0', 'When it first appeared, one volume per month, Stephen King\'s THE GREEN MILE was an unprecedented publishing triumph: all six volumes ended up on the New York Times bestseller listsâ€”simultaneouslyâ€”and delighted millions of fans the world over.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '9.80', './img/thegreenmile.jpg', 'thegreenmile.pdf'),
(6, 'Mr. Mercedes', 1, '0.0', '#1 New York Times bestseller! In a high-suspense race against time, three of the most unlikely heroes Stephen King has ever created try to stop a lone killer from blowing up thousands. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '8.23', './img/mrmercedes.jpg', 'mrmercedes.pdf'),
(7, 'A Game of Thrones', 2, '0.0', 'Here is the first volume in George R. R. Martinâ€™s magnificent cycle of novels that includes A Clash of Kings and A Storm of Swords. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '12.88', './img/agameofthrones.jpg', 'agameofthrones.pdf'),
(8, 'A Clash of Kings', 2, '0.0', 'A comet the color of blood and flame cuts across the sky. Two great leadersâ€”Lord Eddard Stark and Robert Baratheonâ€”who hold sway over an age of enforced peace are dead, victims of royal treachery.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '12.88', './img/aclashofkings.jpg', 'aclashofkings.pdf'),
(9, 'A Storm of Swords', 2, '4.7', 'Here is the third volume in George R.R. Martin\'s magnificent cycle of novels that includes A Game of Thrones and A Clash of Kings. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '13.95', './img/astormofswords.jpg', 'astormofswords.pdf'),
(10, 'A Feast for Crows', 2, '0.0', 'Bloodthirsty, treacherous and cunning, the Lannisters are in power on the Iron Throne in the name of the boy-king Tommen. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '14.73', './img/afeastforcrows.jpg', 'afeastforcrows.pdf'),
(11, 'A Dance with Dragons', 2, '0.0', 'In the aftermath of a colossal battle, the future of the Seven Kingdoms hangs in the balanceâ€”beset by newly emerging threats from every direction.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '16.89', './img/adancewithdragons.jpg', 'adancewithdragons.pdf'),
(12, 'Harry Potter and the Sorcerer\'s Stone', 3, '0.0', 'Harry Potter\'s life is miserable. His parents are dead and he\'s stuck with his heartless relatives, who force him to live in a tiny closet under the stairs. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '10.67', './img/harrypotterandthesorcerersstone.jpg', 'harrypotterandthesorcerersstone.jpg'),
(13, 'Harry Potter and the Chamber of Secrets', 3, '0.0', 'The Dursleys were so mean and hideous that summer that all Harry Potter wanted was to get back to the Hogwarts School for Witchcraft and Wizardry.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '11.25', './img/thechamberofsecrets.jpg', 'thechamberofsecrets.pdf'),
(14, 'Harry Potter and the Prisoner of Azkaban', 3, '4.9', 'Harry Potter\'s third year at Hogwarts is full of new dangers. A convicted murderer, Sirius Black, has broken out of Azkaban prison, and it seems he\'s after Harry.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '12.32', './img/theprisonerofazkaban.jpg', 'theprisonerofazkaban.pdf'),
(15, 'Harry Potter and the Goblet of Fire', 3, '0.0', 'Harry Potter is midway through his training as a wizard and his coming of age. Harry wants to get away from the pernicious Dursleys and go to the International Quidditch Cup.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '13.21', './img/thegobletoffire.jpg', 'thegobletoffire.pdf'),
(16, 'Harry Potter and the Order of the Phoenix', 3, '0.0', 'There is a door at the end of a silent corridor. And itâ€™s haunting Harry Pottterâ€™s dreams. Why else would he be waking in the middle of the night, screaming in terror?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et malesuada fames ac turpis egestas. Adipiscing bibendum est ultricies integer quis auctor elit sed. In tellus integer feugiat scelerisque. Purus viverra accumsan in nisl nisi scelerisque eu. In cursus turpis massa tincidunt dui ut ornare. ', '14.56', './img/theorderofthephoenix.jpg', 'theorderofthephoenix.pdf'),
(17, 'Harry Potter and the Half-Blood Prince', 3, '0.0', 'When Harry Potter and the Half-Blood Prince opens, the war against Voldemort has begun. The Wizarding world has split down the middle, and as the casualties mount, the effects even spill over onto the Muggles.', 'When Harry Potter and the Half-Blood Prince opens, the war against Voldemort has begun. The Wizarding world has split down the middle, and as the casualties mount, the effects even spill over onto the Muggles. Dumbledore is away from Hogwarts for long periods, and the Order of the Phoenix has suffered grievous losses. And yet, as in all wars, life goes on. Harry, Ron, and Hermione, having passed their O.W.L. level exams, start on their specialist N.E.W.T. courses. Sixth-year students learn to Apparate, losing a few eyebrows in the process. Teenagers flirt and fight and fall in love. Harry becomes captain of the Gryffindor Quidditch team, while Draco Malfoy pursues his own dark ends. And classes are as fascinating and confounding as ever, as Harry receives some extraordinary help in Potions from the mysterious Half-Blood Prince.', '15.34', './img/thehalfbloodprince.jpg', 'thehalfbloodprince.pdf'),
(18, 'Harry Potter and the Deathly Hallows', 3, '0.0', 'Harry Potter is leaving Privet Drive for the last time. But as he climbs into the sidecar of Hagridâ€™s motorbike and they take to the skies, he knows Lord Voldemort and the Death Eaters will not be far behind.', 'Harry Potter is leaving Privet Drive for the last time. But as he climbs into the sidecar of Hagridâ€™s motorbike and they take to the skies, he knows Lord Voldemort and the Death Eaters will not be far behind. The protective charm that has kept him safe until now is broken. But the Dark Lord is breathing fear into everything he loves. And he knows he canâ€™t keep hiding. To stop Voldemort, Harry knows he must find the remaining Horcruxes and destroy them. He will have to face his enemy in one final battle.', '17.89', './img/thedeathlyhallows.jpg', 'thedeathlyhallows.pdf'),
(19, 'Memory Man', 4, '0.0', 'The first time was on the gridiron. A big, towering athlete, he was the only person from his hometown of Burlington ever to go pro.', 'The first time was on the gridiron. A big, towering athlete, he was the only person from his hometown of Burlington ever to go pro. But his career ended before it had a chance to begin. On his very first play, a violent helmet-to-helmet collision knocked him off the field for good, and left him with an improbable side effect--he can never forget anything. The second time was at home nearly two decades later. Now a police detective, Decker returned from a stakeout one evening and entered a nightmare--his wife, young daughter, and brother-in-law had been murdered.', '6.98', './img/memoryman.jpg', 'memoryman.pdf'),
(20, 'The Last Mile', 4, '0.0', 'Convicted murderer Melvin Mars is counting down the last hours before his execution--for the violent killing of his parents twenty years earlier--when he\'s granted an unexpected reprieve. Another man has confessed to the crime.', 'Convicted murderer Melvin Mars is counting down the last hours before his execution--for the violent killing of his parents twenty years earlier--when he\'s granted an unexpected reprieve. Another man has confessed to the crime. Amos Decker, newly hired on an FBI special task force, takes an interest in Mars\'s case after discovering the striking similarities to his own life: Both men were talented football players with promising careers cut short by tragedy. Both men\'s families were brutally murdered. And in both cases, another suspect came forward, years after the killing, to confess to the crime. A suspect who may or may not have been telling the truth.', '8.42', './img/thelastmile.jpg', 'thelastmile.pdf'),
(21, 'The Fix', 4, '0.0', 'David Baldacci\'s remarkable detective Amos Decker - the man who can forget nothing - was first introduced in the sensational number-one New York Times best seller Memory Man. Now Decker returns in a stunning new novel.', 'Amos Decker witnesses a murder just outside FBI headquarters. A man shoots a woman execution style on a crowded sidewalk, then turns the gun on himself. Even with Decker\'s extraordinary powers of observation and deduction, the killing is baffling. Decker and his team can find absolutely no connection between the shooter - a family man with a successful consulting business - and his victim, a schoolteacher. Nor is there a hint of any possible motive for the attack. \r\n', '7.87', './img/thefix.jpg', 'thefix.pdf'),
(22, 'The Girl on the Train', 5, '0.0', 'Rachel catches the same commuter train every morning. She knows it will wait at the same signal each time, overlooking a row of back gardens.', 'Rachel catches the same commuter train every morning. She knows it will wait at the same signal each time, overlooking a row of back gardens. She\'s even started to feel like she knows the people who live in one of the houses. \'Jess and Jason\', she calls them. Their life - as she sees it - is perfect. If only Rachel could be that happy. And then she sees something shocking. It\'s only a minute until the train moves on, but it\'s enough. Now everything\'s changed. Now Rachel has a chance to become a part of the lives she\'s only watched from afar. Now they\'ll see; she\'s much more than just the girl on the train.', '8.21', './img/thegirlonthetrain.jpg', 'thegirlonthetrain.pdf'),
(23, 'Into the Water', 5, '4.0', 'In the last days before her death, Nel called her sister. Jules didnâ€™t pick up the phone, ignoring her plea for help. Now Nel is dead. They say she jumped.', 'In the last days before her death, Nel called her sister. Jules didn\'t pick up the phone, ignoring her plea for help. Now Nel is dead. They say she jumped. And Jules has been dragged back to the one place she hoped she had escaped for good, to care for the teenage girl her sister left behind. But Jules is afraid. So afraid. Of her long-buried memories, of the old Mill House, of knowing that Nel would never have jumped. And most of all she\'s afraid of the water, and the place they call the Drowning Pool.', '8.76', './img/intothewater.jpg', 'intothewater.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `book` int(11) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`book`, `category`) VALUES
(1, 'fiction'),
(1, 'horror'),
(1, 'thriller'),
(2, 'fiction'),
(2, 'horror'),
(3, 'fiction'),
(3, 'horror'),
(4, 'fiction'),
(4, 'horror'),
(5, 'fiction'),
(5, 'thriller'),
(6, 'fiction'),
(6, 'thriller'),
(7, 'fantasy'),
(7, 'fiction'),
(8, 'fantasy'),
(8, 'fiction'),
(9, 'fantasy'),
(9, 'fiction'),
(10, 'fantasy'),
(10, 'fiction'),
(11, 'fantasy'),
(11, 'fiction'),
(12, 'fantasy'),
(12, 'fiction'),
(13, 'fantasy'),
(13, 'fiction'),
(14, 'fantasy'),
(14, 'fiction'),
(15, 'fantasy'),
(15, 'fiction'),
(16, 'fantasy'),
(16, 'fiction'),
(17, 'fantasy'),
(17, 'fiction'),
(18, 'fantasy'),
(18, 'fiction'),
(19, 'fiction'),
(19, 'mystery'),
(20, 'fiction'),
(20, 'mystery'),
(21, 'fiction'),
(21, 'mystery'),
(22, 'fiction'),
(22, 'mystery'),
(23, 'fiction'),
(23, 'mystery');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `user` varchar(200) NOT NULL,
  `book` int(11) NOT NULL,
  `purchase_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`user`, `book`, `purchase_date_time`) VALUES
('ritwikmath@gmail.com', 23, '2019-08-31 00:11:21');

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
('james.r@gmail.com', 1, '5.00', 'Very good and thrilling'),
('james.r@gmail.com', 14, '4.90', 'I was so into reading this book that I failed to take notes, so I don\'t have many specifics to add except that I love how Crookshanks was basically Sirius\'s secret agent spy cat friend and I LOVE THAT.'),
('ritwikmath@gmail.com', 9, '4.70', 'This book made me want to throw it against the wall in anger and disbelief. It made me root for the death of a child (and then despise myself), love a hated character, cry angry tears, and bite my nails because of all the suspense.'),
('ritwikmath@gmail.com', 15, '5.00', 'I had serious problems with the way this book is written.'),
('ritwikmath@gmail.com', 23, '4.00', 'Very good readin');

--
-- Triggers `review`
--
DELIMITER $$
CREATE TRIGGER `update_average_review_after_delete` AFTER DELETE ON `review` FOR EACH ROW BEGIN
    UPDATE books INNER JOIN review ON books.book_id = review.book set average_rating  = (SELECT AVG(rating) from review where book = old.book) where books.book_id = old.book;
END
$$
DELIMITER ;
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
('ronnie', 'Ritwik Math', 'ritwikmath@gmail.com', '1234', 'customer', '1.24');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `book` int(11) NOT NULL,
  `customer` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`book`,`category`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`user`,`book`),
  ADD KEY `book` (`book`);

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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`book`,`customer`),
  ADD KEY `customer` (`customer`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author`) REFERENCES `author` (`authorID`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`book`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`book`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`book`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`book`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `user` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
