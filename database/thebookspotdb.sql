-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2023 at 04:53 PM
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
  `description` text DEFAULT NULL,
  `book_ISBN` varchar(13) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `amt_sold` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `image`, `title`, `author`, `genre`, `format`, `publisher`, `publication_date`, `description`, `book_ISBN`, `language`, `price`, `stock`, `amt_sold`, `create_at`) VALUES
(1, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/63975913z_276x.jpg?v=1660118189', 'The Ballad of Never After', 'Stephanie Garber', 'Young Adult Fantasy', 'Paperback', 'Platiron', '2022-09-13', 'Not every love is meant to be.\n\nAfter Jacks, the Prince of Hearts, betrays her, Evangeline Fox swears she\'ll never trust him again. Now that she’s discovered her own magic, Evangeline believes she can use it to restore the chance at happily ever after that Jacks stole away.\n\nBut when a new terrifying curse is revealed, Evangeline finds herself entering into a tenuous partnership with the Prince of Hearts again. Only this time, the rules have changed. Jacks isn’t the only force Evangeline needs to be wary of. In fact, he might be the only one she can trust, despite her desire to despise him.\n\nInstead of a love spell wreaking havoc on Evangeline’s life, a murderous spell has been cast. To break it, Evangeline and Jacks will have to do battle with old friends, new foes, and a magic that plays with heads and hearts. Evangeline has always trusted her heart, but this time she’s not sure she can...', '9781250879530', 'English', 44.93, 15, 0, '2023-09-18 14:32:35'),
(2, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781803362182_262x.jpg?v=1663638420', 'A Magic Steeped In Poison', 'Judy I. Lin', 'Young Adult Fantasy', 'Paperback', 'Titan', '2022-03-29', 'I used to look at my hands with pride. Now all I can think is, These are the hands that buried my mother.\n\nFor Ning, the only thing worse than losing her mother is knowing that it\'s her own fault. She was the one who unknowingly brewed the poison tea that killed her the poison tea that now threatens to also take her sister, Shu.\n\nWhen Ning hears of a competition to find the kingdom\'s greatest shennong-shi--masters of the ancient and magical art of tea-making--she travels to the imperial city to compete. The winner will receive a favor from the princess, which may be Ning\'s only chance to save her sister\'s life.\n\nBut between the backstabbing competitors, bloody court politics, and a mysterious (and handsome) boy with a shocking secret, Ning might actually be the one in more danger.', '9781803362182', 'English', 47.92, 13, 0, '2023-09-18 14:51:20'),
(3, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781534465299_267x.jpg?v=1657787764', 'Blood Like Magic', 'Liselle Sambury', 'Young Adult Fantasy', 'Paperback', 'Simon & Schuster US', '2021-06-15', 'An urban fantasy debut following a teen witch who is given a horrifying task: sacrificing her first love to save her family’s magic. The problem is, she’s never been in love—she’ll have to find the perfect guy before she can kill him.\n\nAfter years of waiting for her Calling—a trial every witch must pass in order to come into their powers—the one thing Voya Thomas didn’t expect was to fail. When Voya’s ancestor gives her an unprecedented second chance to complete her Calling, she agrees—and then is horrified when her task is to kill her first love. And this time, failure means every Thomas witch will be stripped of their magic.\n\nVoya is determined to save her family’s magic no matter the cost. The problem is, Voya has never been in love, so for her to succeed, she’ll first have to find the perfect guy—and fast. Fortunately, a genetic matchmaking program has just hit the market. Her plan is to join the program, fall in love, and complete her task before the deadline. What she doesn’t count on is being paired with the infuriating Luc—how can she fall in love with a guy who seemingly wants nothing to do with her?\n\nWith mounting pressure from her family, Voya is caught between her morality and her duty to her bloodline. If she wants to save their heritage and Luc, she’ll have to find something her ancestor wants more than blood. And in witchcraft, blood is everything.', '9781534465299', 'English', 55.12, 20, 0, '2023-09-18 15:00:11'),
(4, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781471410918_260x.jpg?v=1657787594', 'Daughter of Darkness', 'Katharine Corr', 'Young Adult Fantasy', 'Paperback', 'Hot Key Books', '2022-10-04', 'Deina is trapped. As one of the Soul Severers serving the god Hades on earth, her future is tied to the task of shepherding the dying on from the mortal world - unless she can earn or steal enough to buy her way out.\n\nThen the tyrant ruler Orpheus offers both fortune and freedom to whoever can retrieve his dead wife, Eurydice, from the Underworld. Deina jumps at the chance. But to win, she must enter an uneasy alliance with a group of fellow Severers she neither likes nor trusts.\n\nSo begins their perilous journey into the realm of Hades... The prize of freedom is before her - but what will it take to reach it?\n\nEnter the Underworld in an epic new fantasy, where the Gods of ancient Greece rule everything but fate.', '9781471410918', 'English', 45.20, 20, 0, '2023-09-18 15:05:11'),
(5, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9780241532577_261x.jpg?v=1657787945', 'Beasts of Ruin', 'Ayana Gray', 'Young Adult Fantasy', 'Paperback', 'Puffin UK', '2022-07-26', 'In this much anticipated follow up to New York Times bestselling Beasts of Prey, Koffi’s powers grow stronger and Ekon’s secrets turn darker as they face the god of death.\n\nKoffi has saved her city and the boy she loves, but at a terrible price. Now a servant to the cunning god of death, she must use her newfound power to further his continental conquest, or risk the safety of her home and loved ones. As she reluctantly learns to survive amidst unexpected friends and foes, she will also have to choose between the life—and love—she once had, or the one she could have, if she truly embraces her dangerous gifts.\n\nCast out from the only home he’s ever known, Ekon is forced to strike new and unconventional alliances to find and rescue Koffi before it’s too late. But as he gets closer to the realm of death each day, so too does he draw nearer to a terrible truth—one that could cost everything.\n\nKoffi and Ekon—separated by land, sea, and gods—will have to risk everything to reunite again. But the longer they’re kept apart, the more each of their loyalties are tested. Soon, both may have to reckon with changing hearts—and maybe, changing destinies.', '9780241532577', 'English', 48.35, 16, 0, '2023-09-18 15:06:01'),
(6, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9780702314636_500x.jpg?v=1642663434', 'The Girl with No Soul', 'Morgan Owen', 'Young Adult Fantasy', 'Paperback', 'Scholastic UK', '2022-01-09', 'How can you find your soul mate, when you don\'t have a soul?\n\nIris lives in a world ruled by The Order. Inspectors police the population by keeping careful watch over people\'s souls. If they shine their lanterns on you, your soul is projected for the world to see... and judge. But Iris has a deadly secret ... she is a hollow, a person with no soul.\n\nShe must hide from the Order at all costs, scraping a living in the shadows. But when she\'s sent to steal a ring from a lady of nobility, she is reunited with her Spark - one of the five parts that make up her own missing soul.\n\nNow she must rely on the help of a young scholar named Evander Mountebank to track down the other four missing pieces of her soul, all the while evading The Order. Will she be able to protect her heart as well as find her soul?\n\nThe Girl with no Soul combines a fabulous concept, a swooning love story, and intoxicating world building in one glorious package. Perfect for fans of Alice Broadway and Leigh Bardugo. Morgan Owen is a bright new talent in the YA world.', '9780702314636', 'English', 48.90, 25, 0, '2023-09-18 15:09:47');

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
