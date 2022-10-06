-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2022 at 03:13 PM
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
  `category_id` int(11) NOT NULL,
  `category_title` varchar(211) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_title`) VALUES
(1, 'Information And technology'),
(2, 'Knowledge'),
(6, 'Travelling'),
(8, 'New 1'),
(12, 'test');

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
(1, 1, 16, 'This is comment.', '2022-09-29 09:50:00'),
(2, 1, 9, 'This Is comment .......', '2022-08-03 09:50:00'),
(3, 1, 16, 'Second Comment..', '2022-09-29 09:55:26'),
(4, 2, 16, 'Hello World !!!!!', '2022-07-20 04:00:36'),
(7, 2, 9, '123', '2022-09-29 10:09:43'),
(8, 1, 9, 'New', '2022-09-30 11:48:53'),
(9, 3, 9, 'Hello from Ram!!!!\r\n', '2022-09-30 13:56:53'),
(14, 1, 36, 'comment', '2022-10-05 05:41:45'),
(16, 3, 27, 'hello', '2022-10-05 10:16:55'),
(20, 2, 27, 'hello', '2022-10-05 10:33:54'),
(22, 2, 27, 'rohan', '2022-10-05 10:44:29'),
(23, 1, 40, 'New comment on 6-10\r\n', '2022-10-06 04:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `feature_image` varchar(255) NOT NULL,
  `count_category` int(11) NOT NULL,
  `count_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `title`, `description`, `slug`, `publish_date`, `feature_image`, `count_category`, `count_tag`) VALUES
(1, 1, 'Himanshu ', 'When choosing a partner for your digital website needs, or your career you want the best. What better proof than seeing what customers and employees have to say. It would be our pleasure to introduce you to all and share their reviews about NITSAN!\n\nWhen choosing a partner for your digital website needs, or your career you want the best. What better proof than seeing what customers and employees have to say. We constantly survey our customers and staff and ask if they’re willing to say a few words. As you’ll see, many do. We’re proud of our high-quality TYPO3 and Web development services, and most proud of the culture and value we’ve delivered to these clients.\n\nIt would be our pleasure to introduce you to all!\n\nIt’s good to hear the appreciation!\nWe\'re loved Socially!\nWe make ordinary projects remarkable!', '/Post/himanshu', '2022-09-30 06:53:41', 'img1.jpg ', 3, 2),
(9, 1, 'New Blog 3', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of de Finibus Bonorum et Malorum (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, Lorem ipsum dolor sit amet.., comes from a line in section 1.10.32.', '/Post/new-blog-3', '2022-09-30 11:47:31', 'bg.jpg', 2, 2),
(16, 1, 'Why Shopware Is a Perfect Platform To Build Online Store? ', '<p><strong><u>Shopware</u></strong>, a leading eCommerce platform in Germany, is working incredibly hard, and thats not without reason. Shopware is gaining more market share in Europe and the number of active installations is increasing rapidly.</p><p>Shopware, a leading eCommerce platform in Germany, is working incredibly hard, and thats not without reason. Shopware is gaining more market share in Europe and the number of active installations is increasing rapidly.</p><p>However, for what reason is Shopware so famous, and why it is one of the best eCommerce solutions? Let’s find out to know all about Shopware!</p><p><br></p><p>Shopware is a german open-source stage that spotlights the excitement of client experience. Shopware was laid out in 2000, and meanwhile, they have in excess of 100,000 happy Shopware users.</p><p>The incredible thing about Shopware is that the product is created by individuals who use it as it is very user-friendly and does not need hard development skills to build. Therefore, the nature of the product isnt without a doubt, extremely high yet in addition meets the most noteworthy necessities as far as to plan and innovation</p> ', '/Post/why-shopware-is-a-perfect-platform-to-build-online-store', '2022-10-03 12:00:13', 'Blog-Banner-Shopware.jpg ', 2, 2),
(27, 1, 'new blog post  ', '<h2>hello world</h2><p>hrergrfgefg<strong>rgderegederegrdeergr<em>rgdergdrfgergee<u>edrgergegrfgerfg</u></em></strong></p><blockquote><strong>hrergrfgefgrgderegederegrdeergr<em>rgdergdrfgergee<u>edrgergegrfgerfg</u></em></strong></blockquote><pre class=ql-syntax spellcheck=false>hrergrfgefgrgderegederegrdeergrrgdergdrfgergeeedrgergegrfgerfg\r\n</pre>', '/Post/new-blog-post- ', '2022-10-05 04:12:50', 'banner.jpg ', 2, 1),
(36, 1, 'New Blog 3 ', '<p>This is <strong>blog</strong></p> ', '/Post/new-blog-3(1) ', '2022-10-05 05:08:20', 'download (1).jpg ', 2, 2),
(40, 1, 'thidask jasndias uef eijf kmdf a ', '<p>sf ag aerigh sdfn jndjn jajngireg rug rgb rg rgvjufrubg rbgubr gbrg <strong> ef adrjfb aguibrgrudfnamvhbgherg sdvfbr r <em> fa f sadhfg vkduf vhsf </em></strong></p>', '/Post/thidask-jasndias-uef-eijf-kmdf-a ', '2022-10-05 13:14:08', '30_-extensions-Main-Banner.jpg ', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`id`, `post_id`, `category_id`) VALUES
(1, 1, 1),
(2, 1, 6),
(3, 1, 8),
(4, 2, 2),
(5, 2, 6),
(6, 3, 2),
(7, 4, 2),
(8, 5, 2),
(9, 6, 2),
(29, 9, 2),
(30, 9, 6),
(48, 16, 1),
(49, 16, 2),
(84, 36, 2),
(85, 36, 8),
(88, 27, 2),
(89, 27, 8),
(102, 40, 1),
(103, 40, 8),
(104, 40, 12);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`) VALUES
(1, 1, 2),
(2, 1, 23),
(3, 2, 3),
(4, 2, 23),
(5, 3, 23),
(6, 4, 23),
(7, 5, 23),
(8, 6, 23),
(25, 9, 2),
(26, 9, 3),
(43, 16, 1),
(44, 16, 3),
(84, 36, 1),
(85, 36, 2),
(88, 27, 3),
(101, 40, 4),
(102, 40, 23),
(103, 40, 28);

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
(23, 'Politics'),
(28, 'testing');

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
  ADD PRIMARY KEY (`category_id`);

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
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `tag_id` (`tag_id`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `post_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
