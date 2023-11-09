-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 23-11-09 11:26
-- 서버 버전: 10.4.28-MariaDB
-- PHP 버전: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `baseballboard`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `boards`
--

CREATE TABLE `boards` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `writerId` varchar(200) NOT NULL,
  `writerName` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `views` int(11) NOT NULL,
  `recom` int(11) NOT NULL,
  `league` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `boardsbackup`
--

CREATE TABLE `boardsbackup` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `writerId` varchar(200) NOT NULL,
  `writerName` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `views` int(11) NOT NULL,
  `recom` int(11) NOT NULL,
  `league` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `boardId` int(11) NOT NULL,
  `content` text NOT NULL,
  `writerId` varchar(200) NOT NULL,
  `writerName` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `commentsbackup`
--

CREATE TABLE `commentsbackup` (
  `id` int(11) NOT NULL,
  `boardId` int(11) NOT NULL,
  `content` text NOT NULL,
  `writerId` varchar(200) NOT NULL,
  `writerName` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `recomId` text NOT NULL,
  `stop` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `usersbackup`
--

CREATE TABLE `usersbackup` (
  `id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `recomId` text NOT NULL,
  `stop` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `boardsbackup`
--
ALTER TABLE `boardsbackup`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `commentsbackup`
--
ALTER TABLE `commentsbackup`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `usersbackup`
--
ALTER TABLE `usersbackup`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `boardsbackup`
--
ALTER TABLE `boardsbackup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `commentsbackup`
--
ALTER TABLE `commentsbackup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
