-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2013 at 06:34 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clothstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `holder_name` varchar(100) NOT NULL,
  `account_no` varchar(45) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `branch` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `balance` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_accounts_companies1_idx` (`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `company_id`, `holder_name`, `account_no`, `bank`, `branch`, `date`, `balance`) VALUES
(1, 1, 'Mayur & co', '3', 'local', 'local', '2013-07-31', 80000),
(2, 2, 'Arzoo Fashion House', '4', 'local', 'local', '2013-07-31', 20000),
(3, 3, 'Rudra EnterPrise', '5', 'local', 'local', '2013-08-02', 60000),
(4, 4, 'TEST CO', '7', 'local', 'local', '2013-08-20', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `blank`
--

CREATE TABLE IF NOT EXISTS `blank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('251bdfebcd8b7b8bdadb5ff6662e7a5e', '117.223.52.40', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1375264348, ''),
('92a57e182054cb8ac44e8ae42481045b', '1.38.31.250', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1375271973, 'a:6:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"4";s:8:"username";s:5:"Ahmed";s:3:"key";N;s:12:"is_logged_in";i:1;s:10:"company_id";s:1:"2";}'),
('d65b81fb9c0f5633c8b7df7bde73adcc', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1375323584, ''),
('7f66fc1c85828945ff8a9fbe6b5e279b', '117.212.129.118', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1375340791, ''),
('5db00fcda9ebf39a69dd0291bdd8a12d', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1375445181, ''),
('c1c823865a4a912ceb5e2e743bc1aaf8', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1375447428, 'a:6:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"5";s:8:"username";s:7:"jagdish";s:3:"key";s:1:"1";s:12:"is_logged_in";i:1;s:10:"company_id";s:1:"3";}'),
('380a21b222ba2c918ccf7b2dc292c958', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1375449388, 'a:6:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"5";s:8:"username";s:7:"jagdish";s:3:"key";s:1:"1";s:12:"is_logged_in";i:1;s:10:"company_id";s:1:"3";}'),
('cbfa5691d0d7aabc69818497a877012f', '59.94.47.187', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1375451222, ''),
('6742da2d1101bd1f829f65e9c87ac9a4', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1375464186, 'a:6:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"5";s:8:"username";s:7:"jagdish";s:3:"key";s:1:"1";s:12:"is_logged_in";i:1;s:10:"company_id";s:1:"3";}'),
('9b7e4a96f6afbbd31c3c6d7b9995ee95', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1375530833, 'a:6:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"5";s:8:"username";s:7:"jagdish";s:3:"key";s:1:"1";s:12:"is_logged_in";i:1;s:10:"company_id";s:1:"3";}'),
('040a0bf2522817049eec27bf3582a3c1', '117.206.151.76', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1375539165, ''),
('078fbb68c9bca6eb827a10f3d5cc788d', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1375549954, ''),
('895312ac7ae92f7249d9cf7661e55945', '117.212.129.16', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1375550032, ''),
('1fbd4086331f91e35e105a75eea08a9d', '117.212.129.16', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1375550066, ''),
('2682e889f45183ee53cc1c1bffc39b23', '59.94.40.20', 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0', 1375804480, ''),
('d9dd9520bb0e8589ee1167f0cfa289d2', '59.94.40.20', 'Mozilla/5.0 (Linux; Android 4.1.2; GT-P3100 Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Saf', 1375815937, ''),
('65342395b5c2b82f64fb5abd3203b823', '1.38.29.36', 'Mozilla/5.0 (Linux; Android 4.1.2; GT-I9082 Build/JZO54K) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mo', 1376062352, ''),
('292e5bd201e9e16ea78fedc929dac7e9', '1.38.25.111', 'Mozilla/5.0 (Linux; Android 4.1.2; GT-P3100 Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Saf', 1376116470, ''),
('2daafe09602460c31af8c92025a7da0b', '117.212.129.148', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1376198450, ''),
('6dace2c0c973197d15975a67be9cee41', '117.212.129.148', 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0', 1376210316, ''),
('7f4b9dca56e92bf8fdc33c63388c6720', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376211712, 'a:6:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"4";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"1";s:12:"is_logged_in";i:1;s:10:"company_id";s:1:"2";}'),
('d5bafdaa28dba9b2213706cf896ff22f', '117.212.129.44', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376219974, ''),
('90d4e8103ce645e21ccdaf3645d28977', '117.212.129.44', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376228781, ''),
('7b2f992703106a0a305dccc8d6966c01', '1.38.24.21', 'Mozilla/5.0 (Linux; Android 4.1.2; GT-P3100 Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Saf', 1376285320, ''),
('a5c01e80984ac79da3258b364ee7f1a4', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376314056, ''),
('cb1e21d0fde60ee9143b4fe2f19ac1db', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376321508, 'a:6:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:10:"company_id";s:1:"2";}'),
('9720fd18cd8210f19daaad8092324fbd', '27.107.238.128', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.6 (KHTML, like Gecko) Chrome/7.0.503.0 Safari/534.6', 1376321772, ''),
('1f05d1e09241d943ae85f438aa944110', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376489398, ''),
('ee632eeb0bbe48c60d340c90cc8ad64c', '117.206.145.231', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376489405, ''),
('eed92c65dae9e4f83390b7e7ac018195', '117.206.145.231', 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0', 1376489466, 'a:7:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:10:"company_id";s:1:"2";s:11:"current_tab";s:7:"product";}'),
('8cacff6dd687c1fad9bbd96295a04874', '117.206.145.231', 'Mozilla/5.0 (Linux; Android 4.1.2; GT-P3100 Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Saf', 1376490240, 'a:11:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:14:"search_product";s:0:"";s:12:"search_party";s:0:"";s:15:"search_purchase";s:0:"";s:12:"search_sales";s:0:"";s:11:"current_tab";s:7:"barcode";s:10:"company_id";s:1:"2";}'),
('bdc0d0520b6c0fabe323dc26853298cb', '117.206.145.231', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1376491479, ''),
('748e89b296864d0825148d2d17a835c0', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376547064, ''),
('06b2f9355ecb0ffab0e10f52726d8e21', '117.206.145.231', 'Mozilla/5.0 (Linux; U; Android 4.1.2; en-gb; GT-I9082 Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 M', 1376490675, ''),
('43de958ece5f910e584acd1ab7f0bc2a', '117.206.145.231', 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0', 1376490627, 'a:11:{s:9:"user_data";s:0:"";s:11:"current_tab";s:5:"party";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:14:"search_product";s:0:"";s:12:"search_party";s:0:"";s:15:"search_purchase";s:0:"";s:12:"search_sales";s:0:"";s:10:"company_id";s:1:"2";}'),
('0506374aed4fad0a9bbd7537eebf0520', '117.223.48.148', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376816397, ''),
('8e90acce8cd65f3703deac114227a383', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376827324, 'a:11:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:14:"search_product";s:0:"";s:12:"search_party";s:0:"";s:15:"search_purchase";s:0:"";s:12:"search_sales";s:0:"";s:11:"current_tab";s:5:"trans";s:10:"company_id";s:1:"2";}'),
('e2588ebe91c497f17d5d763133efeec3', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1376550282, ''),
('5076daf248ceebb492edacaa6a7224be', '117.223.51.65', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376973346, ''),
('f12dccbd48309167efac598e0a63b916', '117.226.172.107', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727; .NET CLR 1.1.4322)', 1376974273, ''),
('ec0acaf6b9bac9256c9704ebbfca590f', '1.38.24.51', 'Mozilla/5.0 (Linux; Android 4.1.2; GT-P3100 Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Saf', 1376974559, 'a:11:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:14:"search_product";s:0:"";s:12:"search_party";s:0:"";s:15:"search_purchase";s:0:"";s:12:"search_sales";s:0:"";s:11:"current_tab";s:4:"dash";s:10:"company_id";s:1:"2";}'),
('335b9158b64bf278dc522322801e9408', '117.223.57.22', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376982104, ''),
('b0fb28674ae73bdfac6215c550779265', '117.223.52.200', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1377172742, 'a:11:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:14:"search_product";s:0:"";s:12:"search_party";s:0:"";s:15:"search_purchase";s:0:"";s:12:"search_sales";s:0:"";s:11:"current_tab";s:8:"cust_rep";s:10:"company_id";s:1:"2";}'),
('142b0d2d9c7b22762389f5d558e08561', '117.223.57.22', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376983953, ''),
('17b1eb5a22d14f02a232a623d714c579', '117.223.57.22', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376984814, 'a:11:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"7";s:8:"username";s:6:"sttest";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:14:"search_product";s:0:"";s:12:"search_party";s:0:"";s:15:"search_purchase";s:0:"";s:12:"search_sales";s:0:"";s:11:"current_tab";s:8:"purchase";s:10:"company_id";s:1:"4";}'),
('8b4c1f11c20fd32bbe6b7f0e3837acda', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1376987176, ''),
('b27efe1aeea89e2843c756eaa4e07ccd', '117.223.57.22', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1376995574, ''),
('fe89307ac4f1e0c1c845ac42157e204c', '1.38.30.105', 'Mozilla/5.0 (Linux; Android 4.1.2; GT-P3100 Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Saf', 1377003000, ''),
('bdb74c95322e80f27d729347bce73a7c', '1.38.24.46', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1377006344, ''),
('165aaf8b883fe88f60e5193823b9debd', '117.226.187.109', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727; .NET CLR 1.1.4322)', 1377009839, ''),
('5e8ad9aa3cf43a622803c762c9401ae2', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1377017529, 'a:11:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:14:"search_product";s:0:"";s:12:"search_party";s:0:"";s:15:"search_purchase";s:0:"";s:12:"search_sales";s:0:"";s:11:"current_tab";s:7:"barcode";s:10:"company_id";s:1:"2";}'),
('5285fb138008e4bcc37d2e44d8000929', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1377334152, ''),
('66c4ead7d2316f924345dc6a658edbfd', '117.223.50.59', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1377334161, ''),
('d65b3eb09b58a7fe259be908d69d2057', '117.223.50.59', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36', 1377340565, ''),
('d7618d120eaa063da63578bf014cf0c3', '1.38.24.176', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1377343423, 'a:11:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:14:"search_product";s:0:"";s:12:"search_party";s:0:"";s:15:"search_purchase";s:0:"";s:12:"search_sales";s:0:"";s:11:"current_tab";s:8:"purchase";s:10:"company_id";s:1:"2";}'),
('f5efbd7f9d78e377b6ac1f9495afbab1', '117.223.50.59', 'Mozilla/5.0 (Linux; Android 4.1.2; GT-P3100 Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.59 Saf', 1377341530, 'a:11:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:14:"search_product";s:0:"";s:12:"search_party";s:0:"";s:15:"search_purchase";s:0:"";s:12:"search_sales";s:0:"";s:11:"current_tab";s:5:"party";s:10:"company_id";s:1:"2";}'),
('e037ffe84dfd63628401b4d6689cf6ad', '117.223.50.59', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1377344972, 'a:11:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:14:"search_product";s:0:"";s:12:"search_party";s:0:"";s:15:"search_purchase";s:0:"";s:12:"search_sales";s:0:"";s:11:"current_tab";s:7:"barcode";s:10:"company_id";s:1:"2";}'),
('4f1e5790c3f939d1394c3552e55c34ed', '117.223.50.59', 'Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0', 1377343772, ''),
('d688ebc875de2498855534f727a3ba6c', '59.161.29.153', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36', 1377345325, ''),
('8e4fb8cf9f89bce174d27b7d3a458ca7', '117.223.50.59', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36', 1377402366, ''),
('2acc90f52e3a62d1dfd5d9bad56e561d', '117.223.50.59', 'Mozilla/5.0 (Linux; Android 4.1.2; GT-P3100 Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.59 Saf', 1377403567, ''),
('6fe16ea28e75cb6ee192c08d8eeeba00', '106.212.191.98', 'Mozilla/5.0 (Android; Mobile; rv:23.0) Gecko/23.0 Firefox/23.0', 1377403713, ''),
('bfdba474896d398f491f58726fa860f7', '106.212.191.98', 'Mozilla/5.0 (X11; Linux x86_64; rv:23.0) Gecko/20100101 Firefox/23.0', 1377404738, 'a:11:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"3";s:8:"username";s:5:"Ahmed";s:3:"key";s:1:"0";s:12:"is_logged_in";i:1;s:14:"search_product";s:4:"rivo";s:12:"search_party";s:0:"";s:15:"search_purchase";s:0:"";s:12:"search_sales";s:0:"";s:11:"current_tab";s:7:"barcode";s:10:"company_id";s:1:"2";}');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `mobile` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `pan_no` varchar(45) NOT NULL,
  `service_tax_no` varchar(45) NOT NULL,
  `compniescol` text NOT NULL,
  `user_id` int(4) DEFAULT NULL,
  `logo` longblob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `code`, `name`, `address`, `city`, `contact`, `mobile`, `email`, `pan_no`, `service_tax_no`, `compniescol`, `user_id`, `logo`) VALUES
(2, 990, 'Arzoo Fashion House', 'Mundra', 'Mundra', '93123128989', '7405688786', 'ahmedbhimani2212@gmail.com', '523453453', '534534', '', 3, NULL),
(4, 444, 'TEST CO', 'TEST', 'TEST', '78888888', '8888888888', 'taunkmayur@gmail.com', '444', '4', '', 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE IF NOT EXISTS `parties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `company_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id`, `name`, `address`, `contact`, `company_id`) VALUES
(2, 'Archna Agencies', 'Bhuj', '9426490831', 3),
(3, 'Sales and Purchase Co', 'Anjar', '99565455666', 4),
(4, 'Cash', '', '123456', 2),
(5, 'Adorn Fashion', '', '9876543210', 2),
(6, 'Shubham Creation', 'Adipur', '9865432170', 2),
(7, 'Mahavir Garments', '', '9654321780', 2),
(8, 'Mahavir Trading', '', '954321670', 2),
(9, 'Simandhar Garments', 'Anjar', '9432156780', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `category` varchar(45) NOT NULL,
  `active` int(11) NOT NULL,
  `company_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `active`, `company_id`) VALUES
(1, 'AMUL PUREGHEE 200ML BOX (60)', 'AMUL PUREGHEE', 1, 3),
(2, 'AMUL PUREGHEE 200ML JAR (60)', 'AMUL PUREGHEE', 1, 3),
(3, 'AMUL PUREGHEE 500ML POUCH (20)', 'AMUL PUREGHEE', 1, 3),
(4, 'AMUL PUREGHEE 500ML JAR (24)', 'AMUL PUREGHEE', 1, 3),
(5, 'AMUL PUREGHEE 500ML TIN (24)', 'AMUL PUREGHEE', 1, 3),
(6, 'AMUL PUREGHEE 1LTR POUCH (10)', 'AMUL PUREGHEE', 1, 3),
(7, 'AMUL PUREGHEE 1LTR BOX (12)', 'AMUL PUREGHEE', 1, 3),
(8, 'AMUL PUREGHEE 1LTR TIN (12)', 'AMUL PUREGHEE', 1, 3),
(9, 'AMUL PUREGHEE 2LTR TIN (6)', 'AMUL PUREGHEE', 1, 3),
(10, 'AMUL PUREGHEE 5LTR TIN (4)', 'AMUL PUREGHEE', 1, 3),
(11, 'AMUL PUREGHEE BUCKET 10 KG', 'AMUL PUREGHEE', 1, 3),
(12, 'AMUL PUREGHEE TIN 15 KG', 'AMUL PUREGHEE', 1, 3),
(13, 'AMUL COW GHEE TIN 15 KG', 'AMUL COW GHEE', 1, 3),
(14, 'AMUL BUTTER 500GM', 'AMUL BUTTER', 1, 4),
(15, 'Kivon Shirt Apple Cotton Plain L', 'Shirt', 1, 2),
(16, 'Cute Shirt Plain L', 'Cute Shirt', 1, 2),
(17, 'Adorn Shirt Slim Fit - L', 'Shirt', 1, 2),
(18, 'Structure Cargo Shirt Slim - L', 'Shirt', 1, 2),
(19, 'Rivon Shirt Slim - L', 'Shirt', 1, 2),
(20, 'Royal Jack Shirt Slim - M', 'Shirt', 1, 2),
(21, 'XM Fancy Shirt Long', 'Shirt', 1, 2),
(22, 'XM Fancy Shirt Long', 'Shirt', 1, 2),
(23, 'Beffer Jeans Shirt - S', 'Shirt', 1, 2),
(24, 'Px Dr Slives Shirt', 'Shirt', 1, 2),
(25, 'Make N Zone Double Collar Shirt - L', 'Shirt', 1, 2),
(26, 'Px Slim Fit Shirt - L', 'Shirt', 1, 2),
(27, 'RD Fiber Regular Plain Shirt - M', 'Shirt', 1, 2),
(28, 'RD Fiber Regular Plain Shirt - XL', 'Shirt', 1, 2),
(29, 'X Spirit Short Shirt - XL', 'Shirt', 1, 2),
(30, 'X Spirit Short Shirt - M', 'Shirt', 1, 2),
(31, 'X Spirit Short Shirt - L', 'Shirt', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `bill_no` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `recieved` int(11) DEFAULT NULL,
  `amount_paid` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchases_parties1_idx` (`party_id`),
  KEY `fk_purchases_companies1_idx` (`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `company_id`, `party_id`, `date`, `bill_no`, `amount`, `image`, `recieved`, `amount_paid`) VALUES
(1, 2, 6, '2013-08-21', '2', 900, NULL, 1, 0),
(2, 2, 5, '2013-08-21', '1', 340, NULL, 1, 0),
(3, 2, 7, '2013-08-21', '4', 325, NULL, 1, 0),
(4, 2, 8, '2013-08-21', '5', 315, NULL, 1, 0),
(5, 2, 9, '2013-08-21', '1', 600, NULL, 1, 0),
(6, 2, 6, '2013-08-21', '13234', 620, NULL, 1, 0),
(7, 2, 7, '2013-08-21', '3472', 267, NULL, 1, 0),
(8, 2, 6, '2013-08-21', '74', 270, NULL, 1, 0),
(9, 2, 6, '2013-08-21', '6754', 440, NULL, 1, 0),
(10, 2, 6, '2013-08-21', '7429', 440, NULL, 1, 0),
(11, 2, 6, '2013-08-21', '74923', 2640, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE IF NOT EXISTS `purchase_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `mrp` double NOT NULL,
  `purchase_price` double NOT NULL,
  `quantity` double NOT NULL,
  `sold` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchase_details_purchases1_idx` (`purchase_id`),
  KEY `fk_purchase_details_products1_idx` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `barcode`, `mrp`, `purchase_price`, `quantity`, `sold`, `product_id`) VALUES
(1, 1, '', 0, 0, 0, 0, 0),
(2, 1, 'SC218300', 500, 300, 3, 0, 18),
(3, 2, 'AF218340', 470, 340, 1, 0, 17),
(4, 3, 'MG218325', 550, 325, 1, 0, 19),
(6, 4, 'MT218315', 470, 315, 1, 0, 21),
(7, 5, 'SG218300', 450, 300, 2, 0, 23),
(8, 6, 'SC218310', 460, 310, 2, 0, 24),
(9, 7, 'MG218267', 450, 267, 1, 0, 25),
(10, 8, 'SC218270', 450, 270, 1, 0, 26),
(11, 9, 'SC218110', 225, 110, 4, 0, 27),
(12, 10, 'SC218110', 225, 110, 4, 0, 28),
(13, 11, 'SC218220', 370, 220, 4, 0, 29),
(14, 11, 'SC218220', 370, 220, 4, 0, 30),
(15, 11, 'SC218220', 370, 220, 4, 0, 31);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `type` enum('Estimate','Invoice') NOT NULL DEFAULT 'Estimate',
  `id2` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `less` double NOT NULL,
  `amount` double NOT NULL,
  `party_name` varchar(45) DEFAULT NULL,
  `party_contact` varchar(10) DEFAULT NULL,
  `amount_recieved` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sales_companies1_idx` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE IF NOT EXISTS `sale_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `purchase_detail_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `quantity` double NOT NULL,
  `purchase_details_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_details_purchase_details1` (`purchase_detail_id`),
  KEY `fk_sale_details_sales1_idx` (`sale_id`),
  KEY `fk_sale_details_purchase_details1_idx` (`purchase_details_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `user_id` int(4) NOT NULL,
  `name` varchar(45) NOT NULL,
  `value` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`user_id`, `name`, `value`) VALUES
(3, 'default_company', '2'),
(4, 'default_company', '2'),
(7, 'default_company', '4'),
(8, 'default_company', '4');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(45) NOT NULL COMMENT 'Cr,Dr',
  `particular` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `remarks` text NOT NULL,
  `type1` varchar(45) NOT NULL,
  `company_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Transactions_accounts1_idx` (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='		' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  `fullname` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `status` enum('Active','Suspended','Disabled') NOT NULL DEFAULT 'Active',
  `last_modified` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `key` int(1) DEFAULT NULL,
  `company_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created`, `username`, `password`, `fullname`, `email`, `status`, `last_modified`, `last_login`, `key`, `company_id`) VALUES
(3, '2013-08-01 02:23:50', 'Ahmed', '9193ce3b31332b03f7d8af056c692b84', 'Ahmed Bhimani', 'ahmedbhimani2212@gmail.com', 'Active', '0000-00-00 00:00:00', NULL, 0, 2),
(4, '2013-08-01 02:24:28', 'Ahmed', 'd31a43a7be55cbb430741cf2a85a73bb', 'Ahmed Bhimani', 'ahmedbhimani2212@gmail.com', 'Active', '2013-08-01 00:00:00', '2013-08-01 00:00:00', 1, 2),
(8, '2013-08-20 07:31:43', 'sttest', '1692fcfff3e01e7ba8cffc2baadef5f5', 'Test', 'mayurtaunk@gmail.com', 'Active', '2013-08-20 00:00:00', '2013-08-20 00:00:00', 1, 4),
(7, '2013-08-20 07:28:10', 'sttest', '202cb962ac59075b964b07152d234b70', 'Test', 'mayurtaunk@gmail.com', 'Active', '2013-08-20 00:00:00', '2013-08-20 00:00:00', 0, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
