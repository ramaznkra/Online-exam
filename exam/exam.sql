-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 08 Kas 2021, 14:07:12
-- Sunucu sürümü: 10.4.20-MariaDB
-- PHP Sürümü: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `exam`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `papers`
--

CREATE TABLE `papers` (
  `paper_id` int(11) NOT NULL,
  `paper_name` varchar(55) NOT NULL,
  `min_pass_score` int(3) NOT NULL,
  `mark_per_question` int(3) NOT NULL,
  `paper_duration` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `category` varchar(20) NOT NULL,
  `questions` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `papers`
--

INSERT INTO `papers` (`paper_id`, `paper_name`, `min_pass_score`, `mark_per_question`, `paper_duration`, `start_date`, `end_date`, `category`, `questions`) VALUES
(2, 'Mat3', 60, 5, 50, '2021-11-05 22:00:00', '2021-11-05 22:55:00', '', '1,2,3,4,14,'),
(16, 'deneme1', 60, 20, 10, '2021-11-10 10:10:00', '2021-11-10 10:20:00', '', '1,3,14,17,');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `answer1` varchar(255) NOT NULL,
  `answer2` varchar(255) NOT NULL,
  `answer3` varchar(255) NOT NULL,
  `answer4` varchar(255) NOT NULL,
  `answer5` varchar(255) NOT NULL,
  `correct_answer` int(1) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `correct_answer`, `category`) VALUES
(1, '720 = 2a . 3b . 5c\r\nYukarıda 720 sayısının asal çarpanlarına ayrılmış biçimi verilmiştir.\r\n\r\nBuna göre aşağıdakilerden hangisi doğrudur?', 'b + c toplamı asal sayıdır.', 'a ⋅ b çarpımı asal sayıdır.', 'a tek, b çift sayıdır.', 'a + b + c toplamı çift sayıdır.', '', 0, 'Matematik'),
(2, 'ram nedir ?', 'Random Access Memory', 'Ekran Kartı', 'Yazıcı', 'Mouse', '', 0, 'Bilgisayar'),
(3, '3+2', '5', '8', '9', '7', '', 0, 'Matematik');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `questions_answers`
--

CREATE TABLE `questions_answers` (
  `Id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `answers` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `second_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `image` mediumtext NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `pass`, `second_id`, `created_at`, `image`, `category`) VALUES
(1, 'Muhammed', 'Ali', 'teacherdemo1@gmail.com', '$2y$10$OOlA6nUTMNeHAPqMme5RFurqO3wSPbOnsVSL7pScrmy/jlGBF6ntu', 1, '2021-10-12 09:53:21', 'http://localhost/exam/upload/pic_20211012085320.jpeg', 'Matematik'),
(2, 'mehmet ali', 'alabora', 'teacherdemo2@gmail.com', '$2y$10$M5tC73oNrCd2/I/WgweMPuO8GuZ2kYOLRefCla5Cw8llsGbLgOISC', 1, '2021-10-14 15:16:31', 'http://localhost/exam/upload/pic_20211014141630.jpeg', 'İngilizce,Bilgisayar'),
(3, 'rasim', 'muslu', 'studentdemo1@gmail.com', '$2y$10$D8Ki86up3/n8X/lqfM9xIO/XE1dmWst2RNBr/NHFchlTfKvGFw.qG', 0, '2021-10-27 09:44:47', '', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`paper_id`);

--
-- Tablo için indeksler `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Tablo için indeksler `questions_answers`
--
ALTER TABLE `questions_answers`
  ADD PRIMARY KEY (`Id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `papers`
--
ALTER TABLE `papers`
  MODIFY `paper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `questions_answers`
--
ALTER TABLE `questions_answers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
