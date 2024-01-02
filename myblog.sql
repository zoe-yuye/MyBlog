-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 10:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('admin1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `title` varchar(500) NOT NULL,
  `body` longtext NOT NULL,
  `publish_date` date NOT NULL,
  `likes` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`title`, `body`, `publish_date`, `likes`) VALUES
('A New Blog', 'Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog.Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog. Test......A New Blog. A New Blog. A New Blog. A New Blog. A New Blog.', '2023-12-03', 1),
('A Third Blog', 'Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.Hello! This is my third blog.', '2023-12-01', 58),
('First Blog', 'This is my first blog........This is my first blog........This is my first blog........This is my first blog........This is my first blog........This is my first blog........This is my first blog........This is my first blog........This is my first blog........This is my first blog........This is my first blog........', '2023-11-29', 129),
('My Second Blog', 'My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........My second blog. This is my second blog........', '2023-11-30', 25),
('This is my forth Blog', 'Hi! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow! Hello! This is my forth Blog.Wow!', '2023-12-02', 7);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment` longtext NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `blog_title` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment`, `name`, `email`, `phone`, `date`, `blog_title`) VALUES
('Test comment 1', 'Jill', '', '', '2023-11-30', 'First Blog'),
('My Comment', 'Phill', '', '', '2023-11-30', 'First Blog'),
('New Comment', 'Ivy', '', '', '2023-11-30', 'First Blog'),
('Nice Blog', 'Amy', '', '', '2023-11-30', 'My Second Blog'),
('Thanks for sharing', 'Superman', '', '', '2023-11-30', 'My Second Blog'),
('Wow, deliciousï¼', 'Harry', '', '', '2023-12-02', 'This is my forth Blog'),
('Love PHP', 'Simon', '', '', '2023-12-02', 'My Second Blog'),
('Great post!', 'William', '', '', '2023-12-03', 'A New Blog'),
('Well done! Really enjoyed reading.', 'Zack', '', '', '2023-12-03', 'A New Blog');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message` text NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message`, `name`, `email`, `phone`) VALUES
('Hello.', 'Molly', '', ''),
('Hi Zoe, how are you?', 'Sadie', '', ''),
('Good Evening.', 'Tom', '', ''),
('Hi Zoe, how are you?', 'Sadie', '', ''),
('Thanks for providing valuable insights.', 'Lulu', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `path` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`path`, `name`, `description`) VALUES
('images/gallery/gallery1.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery10.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery11.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery12.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery13.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery14.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery2.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery3.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery4.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery5.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery6.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery7.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery8.jpg', 'Photo Name', 'This is a decription of the photo...'),
('images/gallery/gallery9.jpg', 'Photo Name', 'This is a decription of the photo...');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag` varchar(500) NOT NULL,
  `blog_title` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag`, `blog_title`) VALUES
('Tech', 'First Blog'),
('Tech', 'My Second Blog'),
('JavaScript', 'My Second Blog'),
('PHP', 'My Second Blog'),
('Life', 'A Third Blog'),
('Life', 'This is my forth Blog'),
('Cooking', 'This is my forth Blog'),
('Coding', 'First Blog'),
('Travel', 'A Third Blog'),
('Tech', 'A New Blog');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD KEY `name_2` (`name`);
ALTER TABLE `comments` ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`path`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
