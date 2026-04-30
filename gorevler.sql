
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `gorevler` (
  `id` int(11) NOT NULL,
  `GorevAdi` varchar(255) NOT NULL,
  `DersAdi` varchar(100) NOT NULL,
  `Deadline` date DEFAULT NULL,
  `Severity` enum('Düşük','Orta','Yüksek') DEFAULT 'Orta',
  `StatusHomework` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `gorevler` (`id`, `GorevAdi`, `DersAdi`, `Deadline`, `Severity`, `StatusHomework`) VALUES
(5, 'PDO-PHP ', 'Internet Based Programming', '2026-05-06', 'Orta', 1),
(11, 'kelimeler', 'edebiyat', '2026-04-16', 'Orta', 1),
(12, 'Çarpanlar', 'Matematik', '2026-04-16', 'Düşük', 0),
(13, 'Laboratuvar Çalışması', 'FizikII', '2026-05-09', 'Yüksek', 0),
(14, 'Mikrobiyoloji', 'Biyokimya', '2026-05-06', 'Yüksek', 0);


ALTER TABLE `gorevler`
  ADD PRIMARY KEY (`id`);



ALTER TABLE `gorevler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;
