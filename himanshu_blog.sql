-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2022 at 01:12 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `himanshu_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(211) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(1, 'Information And technology'),
(2, 'Knowledge'),
(6, 'Travelling'),
(8, 'New 1');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `comment`, `time`) VALUES
(1, 1, 12, 'This is comment.', '2022-09-29 09:50:00'),
(2, 1, 9, 'This Is comment .......', '2022-08-03 09:50:00'),
(3, 1, 12, 'Second Comment..', '2022-09-29 09:55:26'),
(4, 2, 12, 'Hello World !!!!!', '2022-07-20 04:00:36'),
(7, 2, 9, '123', '2022-09-29 10:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL,
  `category` varchar(200) NOT NULL,
  `tag` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `title`, `description`, `timestamp`, `image`, `category`, `tag`) VALUES
(1, 1, 'NITSAN is Loved : Meet People & Their Stories!', 'When choosing a partner for your digital website needs, or your career you want the best. What better proof than seeing what customers and employees have to say. It would be our pleasure to introduce you to all and share their reviews about NITSAN!\r\n\r\nWhen choosing a partner for your digital website needs, or your career you want the best. What better proof than seeing what customers and employees have to say. We constantly survey our customers and staff and ask if they’re willing to say a few words. As you’ll see, many do. We’re proud of our high-quality TYPO3 and Web development services, and most proud of the culture and value we’ve delivered to these clients.\r\n\r\nIt would be our pleasure to introduce you to all!', '2022-09-28 10:10:55', 'img1.jpg', 'Knowledge,Travelling', 'World,Politics'),
(2, 1, '15+ TYPO3 Shop Extensions for TYPO3 Website', 'Are you looking for the best TYPO3 eCommerce extensions to grow your business? TYPO3 CMS is the ultimate CMS but it is missing shop and eCommerce functionalities. But an online store with TYPO3 CMS can be coordinated by amazing TYPO3 Shop Extensions. If you are anticipating building an online TYPO3 store or coordinating E-business needs, this blog is for you!\r\n\r\nThe good news about TYPO3 store extensions is that they integrate with an existing TYPO3 website. Therefore, if you run a blog and eventually decide to sell eBooks or merchandise, you have the capabilities to do so. We primarily looked at free solutions, since, frankly, the free solutions are far better than any paid ones.\r\n\r\nThese TYPO3 shop extensions can help you quickly and efficiently build your online business. That’s why, in this article, we’re excited to share the TYPO3 shop modules that will help you grow and expand your online store.\r\n\r\nReady to dive in? Let’s get started.', '2022-09-28 10:58:29', 'img2.png', 'Information And technology,New 1', 'Marketing,Information,SEO'),
(4, 1, ' TYPO3 Shop Extensions for TYPO3 Website - Updated', 'Are you looking for the best TYPO3 eCommerce extensions to grow your business? TYPO3 CMS is the ultimate CMS but it is missing shop and eCommerce functionalities. But an online store with TYPO3 CMS can be coordinated by amazing TYPO3 Shop Extensions. If you are anticipating building an online TYPO3 store or coordinating E-business needs, this blog is for you!\r\n\r\nThe good news about TYPO3 store extensions is that they integrate with an existing TYPO3 website. Therefore, if you run a blog and eventually decide to sell eBooks or merchandise, you have the capabilities to do so. We primarily looked at free solutions, since, frankly, the free solutions are far better than any paid ones.\r\n\r\nThese TYPO3 shop extensions can help you quickly and efficiently build your online business. That’s why, in this article, we’re excited to share the TYPO3 shop modules that will help you grow and expand your online store.\r\n\r\nReady to dive in? Let’s get started.  yes', '2022-09-28 11:49:29', 'Main-banner---FAQs-for-outsourcing-01.jpg', 'Information And technology,Knowledge,Travelling', 'Marketing,SEO,Politics'),
(9, 1, 'new 1', 'he Aimeos TYPO3 extension integrates the Aimeos e-commerce PHP library within any TYPO3 installation. The most obvious advantage of this extension is the \r\n\r\nDirect, seamless, and easy integration of Aimeos in an existing TYPO3 website like a company’s internet presence. \r\nThe Aimeos frontend can be adapted to the corporate design using usual TYPO3 techniques.\r\nThe extension provides several plug-ins for certain functionalities like \r\n\r\nProduct filter, article listings, detail view, basket, checkout, etc. which can be placed anywhere on any TYPO3 page. \r\nThe Aimeos administration interface is accessible via the TYPO3 back end, with no need for extra user accounts.', '2022-09-28 13:52:45', 'blog.jpg', 'Information And technology,Knowledge,New 1', 'Marketing,SEO'),
(12, 1, 'Test', 'Test', '2022-09-29 06:48:11', 'download5).jpg', 'New 1', 'Politics');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(211) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES
(1, 'Marketing'),
(2, 'Information'),
(3, 'SEO'),
(4, 'World'),
(23, 'Politics');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(211) NOT NULL,
  `user_email` varchar(211) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `about` varchar(200) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_img`, `about`, `type`) VALUES
(1, 'Himanshu', 'hr20072001@gmail.com', '123456', 'images.jpg', 'Hey this is Himanshu! Lorem ipsum dolor sit amet eos adipisci,   consectetur adipisicing elit.', 1),
(2, 'Parth', 'parth@gmail.com', '7894', 'images.png', 'Hey this is Parth! Lorem ipsum dolor sit amet eos adipisci,  consectetur adipisicing elit.', 2),
(3, 'Ram', 'ram@gmail.com', '5564', 'img3.jpg', 'Hey this is Ram! Lorem ipsum dolor sit amet eos adipisci,  consectetur adipisicing elit.', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
