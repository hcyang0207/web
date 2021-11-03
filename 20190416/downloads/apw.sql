-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: db1.cumi.co
-- 產生時間： 2019 年 04 月 16 日 16:54
-- 伺服器版本: 5.7.14-google-log
-- PHP 版本： 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `cumi_apw`
--

-- --------------------------------------------------------

--
-- 資料表結構 `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `uuid` varchar(12) COLLATE utf8_bin NOT NULL,
  `name` varchar(25) COLLATE utf8_bin NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 資料表的匯出資料 `devices`
--

INSERT INTO `devices` (`id`, `uid`, `uuid`, `name`, `enabled`) VALUES
(1, 0, 'A020A6104F47', '家裡小夜燈', 1),
(2, 0, 'A020A60279B8', '家裡小夜燈2', 1),
(3, 0, '2C3AE840A954', '陽台電風扇', 1),
(4, 0, '5CCF7F623977', '5CCF7F623977', 1),
(5, 0, '68C63AE15F5B', '68C63AE15F5B', 1),
(6, 0, 'B4E62D3F0B2B', 'B4E62D3F0B2B', 1),
(7, 0, '807D3A751897', '807D3A751897', 1);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
