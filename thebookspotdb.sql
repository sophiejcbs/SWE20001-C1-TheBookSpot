-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2023 at 09:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thebookspotdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `username`, `pwd`) VALUES
(1, 'admin', '$2y$10$w1U5d0gaeytCgopjcgEtJe973iqvjjImcxpwCjqfuDBJvojDfl36O');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `format` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `book_ISBN` varchar(13) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `amt_sold` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `image`, `title`, `author`, `genre`, `format`, `publisher`, `publication_date`, `description`, `book_ISBN`, `language`, `price`, `stock`, `amt_sold`, `create_at`) VALUES
(1, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/63975913z_276x.jpg?v=1660118189', 'The Ballad of Never After', 'Stephanie Garber', 'Young Adult Fantasy', 'Paperback', 'Platiron', '2022-09-13', 'Not every love is meant to be.\r\n\r\nAfter Jacks, the Prince of Hearts, betrays her, Evangeline Fox swears she\'ll never trust him again. Now that she\'s discovered her own magic, Evangeline believes she can use it to restore the chance at happily ever after t', '9781250879530', 'English', 44.93, 15, 0, '2023-09-18 14:32:35'),
(2, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781803362182_262x.jpg?v=1663638420', 'A Magic Steeped In Poison', 'Judy I. Lin', 'Young Adult Fantasy', 'Paperback', 'Titan', '2022-03-29', 'I used to look at my hands with pride. Now all I can think is, These are the hands that buried my mother.\r\n\r\nFor Ning, the only thing worse than losing her mother is knowing that it\'s her own fault. She was the one who unknowingly brewed the poison tea th', '9781803362182', 'English', 47.92, 13, 0, '2023-09-18 14:51:20'),
(3, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781534465299_267x.jpg?v=1657787764', 'Blood Like Magic', 'Liselle Sambury', 'Young Adult Fantasy', 'Paperback', 'Simon & Schuster US', '2021-06-15', 'After years of waiting for her Calling-a trial every witch must pass to come into their powers-the one thing Voya Thomas didn\'t expect was to fail. When Voya\'s ancestor gives her an unprecedented second chance to complete her Calling, she agrees-and then ', '9781534465299', 'English', 55.12, 20, 0, '2023-09-18 15:00:11'),
(4, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781471410918_260x.jpg?v=1657787594', 'Daughter of Darkness', 'Katharine Corr', 'Young Adult Fantasy', 'Paperback', 'Hot Key Books', '2022-10-04', 'Deina is trapped. As one of the Soul Severers serving the god Hades on earth, her future is tied to the task of shepherding the dying on from the mortal world - unless she can earn or steal enough to buy her way out.\r\n\r\nThen the tyrant ruler Orpheus offer', '9781471410918', 'English', 45.2, 20, 0, '2023-09-18 15:05:11'),
(5, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9780241532577_261x.jpg?v=1657787945', 'Beasts of Ruin', 'Ayana Gray', 'Young Adult Fantasy', 'Paperback', 'Puffin UK', '2022-07-26', 'Koffi, gifted with powerful magic, has saved the boy she loves - at a terrible price. Now Koffi is a servant to the god of death, and must choose between the life she once had, or the life she could have if she truly embraced her power.\r\n\r\nEkon is on the ', '9780241532577', 'English', 48.35, 16, 0, '2023-09-18 15:06:01'),
(6, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9780702314636_500x.jpg?v=1642663434', 'The Girl with No Soul', 'Morgan Owen', 'Young Adult Fantasy', 'Paperback', 'Scholastic UK', '2022-01-09', 'How can you find your soul mate, when you don\'t have a soul?\r\n\r\nIris lives in a world ruled by The Order. Inspectors police the population by keeping careful watch over people\'s souls. If they shine their lanterns on you, your soul is projected for the wo', '9780702314636', 'English', 48.9, 25, 0, '2023-09-18 15:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `form_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `b_Address` varchar(100) DEFAULT NULL,
  `b_Country` varchar(50) DEFAULT NULL,
  `b_City` varchar(50) DEFAULT NULL,
  `b_State` varchar(50) DEFAULT NULL,
  `b_Zip` varchar(10) DEFAULT NULL,
  `s_Address` varchar(100) DEFAULT NULL,
  `s_Country` varchar(50) DEFAULT NULL,
  `s_City` varchar(50) DEFAULT NULL,
  `s_State` varchar(50) DEFAULT NULL,
  `s_Zip` varchar(10) DEFAULT NULL,
  `cardNo` int(16) DEFAULT NULL,
  `expiry` varchar(10) DEFAULT NULL,
  `cvv` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
