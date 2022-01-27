-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 27 Oca 2022, 08:45:42
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `exam2`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `logs`
--

CREATE TABLE `logs` (
  `id` int(150) NOT NULL,
  `std_id` int(123) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `paper_id` int(20) NOT NULL,
  `status` varchar(150) NOT NULL,
  `eyes_movement` varchar(200) NOT NULL,
  `phone_detected` varchar(100) NOT NULL,
  `person_detected` varchar(100) NOT NULL,
  `img_log` varchar(189) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `logs`
--

INSERT INTO `logs` (`id`, `std_id`, `name`, `surname`, `paper_id`, `status`, `eyes_movement`, `phone_detected`, `person_detected`, `img_log`, `date`) VALUES
(1, 5, 'Cigdem', 'Aktay', 2, 'Bilinmeyen Yüz', 'Normal', 'Normal', 'Normal', 'None', '2022-01-06 10:29:51'),
(2, 5, 'Cigdem', 'Aktay', 2, 'Bilinmeyen Yüz', 'Normal', 'Normal', 'Normal', 'None', '2022-01-06 10:29:53'),
(3, 3, 'Yusuf', 'Coskun', 2, 'Bilinmeyen Yüz', 'Normal', 'Normal', 'Normal', 'http://localhost/exam/img_logs/phone2.jpg', '2022-01-06 10:29:54'),
(4, 5, 'Cigdem', 'Aktay', 3, 'Normal', 'Normal', 'Cep telefonu algilandi', 'Normal', 'None', '2022-01-06 10:29:54'),
(5, 5, 'Cigdem', 'Aktay', 3, 'Normal', 'Normal', 'Cep telefonu algilandi', 'Normal', 'None', '2022-01-06 10:29:56'),
(6, 5, 'Cigdem', 'Aktay', 2, 'Normal', 'Normal', 'Cep telefonu algilandi', 'Normal', 'None', '2022-01-06 10:29:56'),
(7, 5, 'Cigdem', 'Aktay', 2, 'Normal', 'Normal', 'Cep telefonu algilandi', 'Normal', 'None', '2022-01-06 10:29:58'),
(8, 3, 'Yusuf', 'Coskun', 2, 'Normal', 'Saga Bakiyor', 'Normal', 'Normal', 'http://localhost/exam/img_logs/phone2.jpg', '2022-01-06 10:30:02'),
(9, 3, 'Yusuf', 'Coskun', 1, 'Normal', 'Saga Bakiyor', 'Normal', 'Normal', 'http://localhost/exam/img_logs/phone2.jpg', '2022-01-06 10:30:03'),
(10, 3, 'Yusuf', 'Coskun', 1, 'Normal', 'Sola Bakiyor', 'Normal', 'Normal', 'http://localhost/exam/img_logs/phone2.jpg', '2022-01-06 10:30:04');

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
(1, 'Türkçe 3', 50, 10, 60, '2022-01-18 14:53:00', '2022-01-18 15:53:00', 'Türkçe', '6,7,8,'),
(2, 'Anayasa 2', 40, 15, 50, '2021-11-23 16:17:00', '2021-11-23 17:17:00', 'Anayasa', '11,12,13,'),
(3, 'Türkçe 1', 60, 20, 60, '2021-12-30 13:28:00', '2021-12-30 14:28:00', 'Türkçe', '6,7,10,'),
(12, 'Mat4', 30, 30, 60, '2022-01-17 10:25:00', '2022-01-17 10:31:00', 'Matematik', '11,');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question` varchar(10000) NOT NULL,
  `answer1` varchar(255) NOT NULL,
  `answer2` varchar(255) NOT NULL,
  `answer3` varchar(255) NOT NULL,
  `answer4` varchar(255) NOT NULL,
  `answer5` varchar(255) NOT NULL,
  `correct_answer` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `correct_answer`, `category`) VALUES
(1, 'A = 6 . 8 . 10 + 8 . 10 . 12 + ... + 22 . 24 . 26 olduğuna göre,\r\n\r\n2 . 3 . 4 + 3 . 4 . 5 + ... + 11 . 12 . 13\r\n\r\nifadesinin A\'türünden eşiti aşağıdakilerden hangisidir?', 'A/2', 'A/4', 'A/28', 'A/2 + 12', 'A/8 + 24', 4, 'Matematik'),
(2, 'Ardışık 7 tam sayının toplamı, bu sayılardan en küçüğünün 5 katından 45 fazladır.\r\n\r\nBuna göre, bu sayılardan en büyüğü kaçtır?', '17', '18', '19', '20', '21', 1, 'Matematik'),
(3, 'x sayısının sayı doğrusunda -3 sayısına olan uzaklığı A dır.\r\n\r\n-3 sayısının sayı doğrusunda x sayısına olan uzaklığı B dir.\r\n\r\nA + B = 8\r\n\r\nolduğuna göre, x’in alabileceği farklı değerlerin toplamı kaçtır ?', '-6', '-3', '0', '3', '6', 0, 'Matematik'),
(4, 'Gerçel sayılarda tanımlı f ve g fonksiyonları\r\n\r\nf(x + 2) = f(x) + 8\r\n\r\ng(x — 1) = 2x + 3\r\n\r\neşitliklerini sağlıyor.\r\n\r\nf(8) + g(5) = 25\r\n\r\nolduğuna göre, f(10). g(3) değeri kaçtır?', '160', '175', '184', '198', '204', 3, 'Matematik'),
(5, 'Bir kafede içinde sadece kaşar peyniri ve sucuk bulunan pizzalar satılmaktadır. Bu pizzalar ile ilgili aşağıdakiler bilinmektedir.\r\nPizzalar küçük ve büyük boy olmak üzere iki farklı büyüklükte hazırlanmaktadır.\r\nHer bir pizza hazırlanırken kullanılan kaşar peyniri miktarının sucuk miktarına oranı sabittir.\r\nKullanılan kaşar peyniri ve sucuk miktarlarının toplamı küçük boy pizzalarda 180 gram ve büyük boy pizzalarda 225 gramdır.\r\nBu kafe de 1 küçük ve 1 büyük boy pizza hazırlanmış ve bu pizzalar için toplam 225 gram sucuk kullanılmıştır.\r\n\r\nBuna göre; büyük boy pizzada kullanılan kaşar peyniri miktarı, küçük boy pizzada kullanılan kaşar peyniri miktarından kaç gram daha fazladır?', '15', '20', '25', '30', '35', 1, 'Matematik'),
(6, 'Şiir; edebiyat dalları içindeki en zor, en nankör tür­dür. Sizi etkileyen bir öyküyü, bir romanı aradan çok uzun yıllar geçse de unutamazsınız. Çünkü o yapıt ilginç bir olay üzerine kurulmuştur. Şiir böyle de­ğildir. Aradan zaman geçip bellek zayıflayınca şiir, elekten akıp gider.\r\n\r\nBu parçada geçen “şiirin elekten akıp gitmesi” sö­züyle şiirin hangi niteliği anlatılmak istenmek­tedir?', 'Diğer türlere göre, kısa olma', 'Belli bir olay üzerine kurulmamış olma', 'Eleştirmenlerce yıpratılma', 'Zamanla unutulma', 'Etkileyici bir tür olmama', 3, 'Türkçe'),
(7, 'Türkçede köy göçüren olarak bilinen ve bilimsel adı amanita phalloides olan mantarın tadı çok güzeldir ama bu mantarla yaptığınız yemek, son yemeğiniz olur.\r\n\r\nBu cümleden aşağıdaki yargıların hangisi kesin olarak çıkarılabilir?', 'Dünyadaki en zehirli mantar türü amanita phalloidestir.', 'Zehirli mantar türlerinin hiçbirinin panzehiri yok­tur.', 'Mantar türlerinin çoğu bir insanı öldürecek kadar zehir içerir.', 'Tüm mantar türleri lezzetlidir.', 'Amanita phalloides türü mantar, zehirlidir.', 4, 'Türkçe'),
(8, 'I. Suçlu olduğu için yüzüme bakmadan konuşu­yordu.\r\n\r\nII. Her gece yatmadan önce birkaç satır okurum.\r\n\r\nIII. Söyleyeceklerini bir sıraya koymazsan konuşma sırasında heyecanlanırsın.\r\n\r\nIV. Bu sözleri söylemeden evvel iyice düşünmeliy­din.\r\n\r\nV. Babandan izin almadan tatile çıkamazsın.\r\n\r\nYukarıdaki numaralanmış cümlelerin hangile­rinde “koşul” anlamı vardır?', 'I. ve II.', 'I. ve III.', 'II. ve III.', 'III. ve V', 'IV. ve V', 3, 'Türkçe'),
(10, 'Yolunuzun ilerisini göremiyorsanız dönemece gel­mişsiniz demektir.\r\n\r\nBu cümlede aşağıdakilerden hangisi yoktur?', 'ünsüz yumuşaması', 'ünlü daralması', 'ünlü düşmesi', 'ünsüz sertleşmesi', 'kaynaştırma', 2, 'Türkçe'),
(11, 'Türk Medeni Kanunu’na göre, kendisinden uzun süre haber alınamayan birinin mahkeme kararı ile gerçek kişiliğinin sona erdirilmesine ne ad verilir?', 'Ölüm karinesi\r\n', 'Gaiplik\r\n', 'Gabin', 'Muvazaa', 'Birlikte ölüm karinesi\r\n', 1, 'Anayasa'),
(12, 'Cumhurbaşkanı tarafından hukuka aykırı yapılan bir idari işlemin mahkeme kararı ile hükümsüz kılınması aşağıdaki maddi yaptırım türlerinden hangisi ile ifade edilir?', 'Tek taraflı bağlamazlık\r\n', 'Mutlak butlan\r\n', 'Nisbi butlan\r\n', 'Yokluk', 'İptal', 0, 'Anayasa'),
(13, 'Kişinin suçun kanuni tanımındaki unsurları bilmeden ve istemeden işlemesi aşağıdakilerden hangisi ile ifade edilir?', 'İcra', 'İhmal', 'Taksir', 'Kast', 'Kanunilik', 2, 'Anayasa'),
(14, '1982 Anayasası’na göre, yasama yılının başlangıcı ile ilgili aşağıdakilerden hangisi doğrudur?', 'Yasama yılının başlangıcı Cumhurbaşkanı kararı ile belirlenir.\r\n', 'Yasama yılının başlangıcı TBMM kararı ite belirlenir.\r\n', 'TBMM her yıl Ekim ayının ilk günü kendiliğinden toplanır.\r\n', 'TBMM her yıl Ocak ayının iikgüritı kendiliğinden toplanır.\r\n', 'TBMM her yıl Eylül ayının ilk günü kendiliğinden toplanır.\r\n', 2, 'Anayasa'),
(15, '1982 Anayasası’na göre, Diyanet İşleri Başkanlığı aşağıdakilerden hangisine bağlıdır?\r\n\r\n', 'TBMM', 'İçişleri Bakanlığı\r\n', 'Meclis Başkanlığı\r\n', 'Cumhurbaşkanlığı', 'Adalet Bakanlığı\r\n', 3, 'Anayasa'),
(16, 'Türkiye üzerinde Ekvator\'a yakınlık ya da uzaklık bazı olaylar üzerinde etkili olmuştur\r\n\r\nBuna göre, aşağıdaki olaylardan hangisi üzerinde açıklamadaki durumun etkili olduğundan bahsedilemez?', 'Çizgisel hızın en fazla Hatay\'da olması\r\n', 'Sinop\'un güneş ışınlarını en küçük açıyla alması\r\n', 'Erzurum\'da yükseltinin Adana\'dan fazla olması\r\n', 'Hatay da gece-gündüz sürelerindeki değişimin Sinop\'tan daha az olması\r\n', 'Sinop\'a doğru yer çekiminin artış göstermesi\r\n', 2, 'Coğrafya'),
(17, 'Türkiye, bugünkü görünümünü büyük ölçüde 3. ve 4 Jeolojik Zaman\'da kazanmış genç oluşumlu bir ülkedir.\r\n\r\nAşağıdakilerden hangisi yalnızca yukarıdaki bilgiye göre açıklanamaz?', 'Kırıklı yer yapısının yaygın olması\r\n', 'Ortalama yükseltisinin fazla olması\r\n', 'Dağların doğu-batı yönlü uzanması\r\n', 'Termal kaynakların yaygın olması\r\n', 'Akarsuların denge profilinden uzak olması\r\n', 2, 'Coğrafya'),
(18, 'Türkiye\'nin iklim özellikleri düşünüldüğünde,\r\n\r\nI. bozkır,\r\n\r\nII. çayır,\r\n\r\nIII. maki,\r\n\r\nIV. orman,\r\n\r\nV. psödomaki\r\n\r\ngibi bitki örtülerinden hangisinin daha geniş alanda görüldüğü söylenebilir?', 'I', 'II', 'III', 'IV', 'V', 0, 'Coğrafya'),
(19, 'Türkiye\'de kırsal kesimden kentlere doğru gerçekleşen göçlerin nedenleri arasında aşağıdakilerden hangisi yer almaz?', 'Makineli tarımın yaygınlaşması\r\n', 'Tarım arazilerinin miras yoluyla bölünmesi\r\n', 'Kırsal kesimde iş imkânlarının kısıtlı olması\r\n', 'Nüfus artışının hızlı olması\r\n', 'Kırsal kesimde toprak çeşitliliğinin az olması\r\n', 4, 'Coğrafya'),
(20, 'Geçimini tarım sektöründen sağlayan nüfusun toplam tarım alanlarına bölünmesiyle tarımsal nüfus yoğunluğu bulunur. Türkiye\'de bu yoğunluk bölgelere göre farklılık gösterir.\r\n\r\nBuna göre, bu farklılığı oluşturan nedenler arasında,\r\n\r\nI. yer şekilleri,\r\n\r\nII. tarımla uğraşan nüfusun tarıma bakış açısı,\r\n\r\nIII. tarıma elverişli sahaların yüz ölçümü\r\n\r\nfaktörlerinden hangileri yer almaz?', 'Yalnız I', 'Yalnız II', 'Yalnız III', 'I ve II', 'II ve III', 1, 'Coğrafya'),
(23, '10-10x10+10=?', '90', '100', '-80', '80', '-120', 2, 'Matematik');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `questions_answers`
--

CREATE TABLE `questions_answers` (
  `Id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `paper_name` varchar(50) NOT NULL,
  `s_id` int(11) NOT NULL,
  `s_questions` varchar(1000) NOT NULL,
  `answers` varchar(20) NOT NULL,
  `answer_key` varchar(20) NOT NULL,
  `s_status` varchar(20) NOT NULL,
  `instance` varchar(20) NOT NULL,
  `mark` int(10) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `questions_answers`
--

INSERT INTO `questions_answers` (`Id`, `name`, `surname`, `paper_id`, `paper_name`, `s_id`, `s_questions`, `answers`, `answer_key`, `s_status`, `instance`, `mark`, `category`) VALUES
(1, 'Çiğdem', 'Aktay', 2, 'Anayasa 2', 5, '11,12,13,14,15,', 'B,A,C,C,D,', 'B,A,C,C,D,', 'Başarılı', 'Geçerli', 50, 'Anayasa'),
(2, 'Yusuf', 'Coşkun', 2, 'Anayasa 2', 3, '11,12,13,14,15,', 'A,B,C,D,E,', 'B,A,C,C,D,', 'Başarısız', 'Geçersiz', 10, 'Anayasa'),
(3, 'Çiğdem', 'Aktay', 2, 'Anayasa 2', 5, '11,12,13,14,15,', 'B,A,C,C,D,', 'B,A,C,C,D,', 'Başarılı', 'Geçerli', 50, 'Anayasa'),
(4, 'Çiğdem', 'Aktay', 3, 'Türkçe 1', 5, '6,7,8,10,', 'D,E,D,C,', 'D,E,D,C,', 'Başarılı', 'Geçerli', 80, 'Türkçe'),
(5, 'Yusuf', 'Coşkun', 3, 'Türkçe 1', 3, '6,7,8,10,', 'D,E,D,C,', 'D,E,D,C,', 'Başarılı', 'Geçersiz', 80, 'Türkçe'),
(6, 'Yusuf', 'Coşkun', 2, 'Anayasa 2', 3, '11,12,13,14,', 'A,A,A,BOS,', 'B,A,C,C,', 'Başarısız', 'Geçersiz', 15, 'Anayasa'),
(7, 'Yusuf', 'Coşkun', 2, 'Anayasa 2', 3, '11,12,13,14,', 'A,E,B,D,', 'B,A,C,C,', 'Başarısız', 'Geçersiz', 0, 'Anayasa'),
(8, 'Çiğdem', 'Aktay', 2, 'Anayasa 2', 5, '11,12,13,14,', 'B,D,BOS,BOS,', 'B,A,C,C,', 'Başarısız', 'Geçerli', 15, 'Anayasa'),
(9, 'Yusuf', 'Coşkun', 1, 'Türkçe 3', 3, '6,7,8,', 'D,E,D,', 'D,E,D,', 'Başarısız', 'Geçersiz', 30, 'Türkçe'),
(10, 'Yusuf', 'Coşkun', 1, 'Türkçe 3', 3, '6,7,8,', 'C,BOS,B,', 'D,E,D,', 'Başarısız', 'Geçersiz', 0, 'Türkçe');

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
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `pass`, `second_id`, `created_at`, `image`, `category`) VALUES
(1, 'Muhammed', 'Ali', 'teacherdemo1@gmail.com', '123456', 1, '2021-10-12 09:53:21', 'http://localhost/exam/upload/pic_20211012085320.jpeg', 'Matematik'),
(2, 'mehmet ali', 'alabora', 'teacherdemo2@gmail.com', '123456', 1, '2021-10-14 15:16:31', 'http://localhost/exam/upload/pic_20211014141630.jpeg', 'Anayasa,Türkçe'),
(3, 'Yusuf', 'Coşkun', 'studentdemo1@gmail.com', '123456', 0, '2021-10-27 09:44:47', '', ''),
(4, 'murat', 'arslan', 'teacherdemo3@gmail.com', '123456', 1, '2021-11-10 16:05:07', 'http://localhost/exam/upload/pic_20211110140506.jpeg', 'Coğrafya,Matematik'),
(5, 'Çiğdem', 'Aktay', 'studentdemo2@gmail.com', '123456', 0, '2021-11-29 13:41:41', 'http://localhost/exam/upload/pic_20211129114140.jpeg', ''),
(6, 'Hüseyin', 'Özgümüş', 'studentdemo3@gmail.com', '123456', 0, '2021-11-30 13:40:34', 'http://localhost/exam/upload/pic_20211130114033.jpeg', ''),
(7, 'rana', 'bilgi', 'rana@gmail.com', '123456', 0, '2022-01-05 14:24:53', 'http://localhost/exam/upload/pic_20220105122448.jpeg', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

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
-- Tablo için AUTO_INCREMENT değeri `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `papers`
--
ALTER TABLE `papers`
  MODIFY `paper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `questions_answers`
--
ALTER TABLE `questions_answers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
