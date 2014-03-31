-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 31. Mrz 2014 um 15:42
-- Server Version: 5.5.32
-- PHP-Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `paymey_admin`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) unsigned NOT NULL,
  `business_id` int(10) unsigned DEFAULT NULL,
  `corporation_id` int(10) unsigned DEFAULT NULL,
  `fee_group_id` int(10) unsigned NOT NULL,
  `free_transactions` int(10) unsigned DEFAULT '0',
  `affiliate_code` varchar(255) DEFAULT NULL,
  `timezone_id` varchar(255) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127353 ;

--
-- Daten für Tabelle `accounts`
--

INSERT INTO `accounts` (`id`, `owner_id`, `business_id`, `corporation_id`, `fee_group_id`, `free_transactions`, `affiliate_code`, `timezone_id`, `status`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(127350, 127350, 127350, 0, 1, 100, '4c93', '136', 1, 0, 1375706156, 1, 1375706156, 1),
(127351, 127351, 0, 0, 1, 0, '4c94', '136', 1, 0, 1375706156, 2, 1375706156, 2),
(127352, 127352, 0, 0, 1, 100, '4c95', '136', 1, 0, 1375706156, 2, 1375706156, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL,
  `country_id` smallint(5) unsigned NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `street_number` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `is_default` tinyint(3) unsigned DEFAULT '0',
  `type` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127353 ;

--
-- Daten für Tabelle `addresses`
--

INSERT INTO `addresses` (`id`, `account_id`, `country_id`, `street`, `street_number`, `zip`, `city`, `is_default`, `type`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(127350, 127350, 54, 'Musterstraße', '7', '72074', 'Tübingen', 1, '', 0, 1375706725, 1, 1375706725, 1),
(127351, 127351, 54, 'Hauptstr.', '1', '72076', 'Tübingen', 1, '', 0, 1375706739, 2, 1375706739, 2),
(127352, 127352, 54, 'In der Sackgasse', '1', '72072', 'Stuttgart', 1, '', 0, 1375706739, 2, 1375706739, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT '0',
  `login_attempts` smallint(5) unsigned DEFAULT '0',
  `locked_until` int(10) unsigned DEFAULT '0',
  `pass_created` int(10) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `admin_users`
--

INSERT INTO `admin_users` (`id`, `email`, `password`, `name`, `status`, `login_attempts`, `locked_until`, `pass_created`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'cv@attentra.de', '$2a$13$kOswAviCbh21g0qhekG9me5193U5SWls9TwMl2fW/60k9m97SP3Py', 'Christian Vollrath', 1, 0, 0, 1396273252, 0, 1392737984, NULL, 1396273252, 1),
(2, 'your@email.here', '$2a$13$kFYxgsJ3tM1BOyf6UrJinumt9SG.bFZSZQOb6ZhBfIVn6bMp4QT.6', 'Your Name', 1, 0, 0, 1396273253, 0, 1392737984, NULL, 1396273253, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `affiliate_history`
--

CREATE TABLE IF NOT EXISTS `affiliate_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `advertiser_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `api_keys`
--

CREATE TABLE IF NOT EXISTS `api_keys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL,
  `key_ident` varchar(255) NOT NULL,
  `key_secret` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(3) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `api_keys`
--

INSERT INTO `api_keys` (`id`, `account_id`, `key_ident`, `key_secret`, `password`, `is_active`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 0, '', '', '', 0, 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `balance_histories`
--

CREATE TABLE IF NOT EXISTS `balance_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `paymey_account_id` int(10) unsigned NOT NULL,
  `transaction_id` bigint(20) unsigned NOT NULL,
  `transaction_detail_id` bigint(20) unsigned NOT NULL,
  `current_balance` int(11) NOT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Daten für Tabelle `balance_histories`
--

INSERT INTO `balance_histories` (`id`, `paymey_account_id`, `transaction_id`, `transaction_detail_id`, `current_balance`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 179848, 1, 2, -50000, 0, 1396269130, NULL, 1396269130, NULL),
(2, 179846, 1, 3, 50000, 0, 1396269130, NULL, 1396269130, NULL),
(3, 179846, 2, 6, -30000, 0, 1396269131, NULL, 1396269131, NULL),
(4, 179848, 2, 7, 30000, 0, 1396269131, NULL, 1396269131, NULL),
(5, 179847, 3, 10, -30000, 0, 1396269159, NULL, 1396269159, NULL),
(6, 179846, 3, 11, 0, 0, 1396269159, NULL, 1396269159, NULL),
(7, 179846, 4, 14, -10000, 0, 1396269159, NULL, 1396269159, NULL),
(8, 179847, 4, 15, -23500, 0, 1396269159, NULL, 1396269159, NULL),
(9, 179847, 5, 18, -63500, 0, 1396269185, NULL, 1396269185, NULL),
(10, 179848, 5, 19, 70000, 0, 1396269185, NULL, 1396269185, NULL),
(11, 179848, 6, 21, 40000, 0, 1396269185, NULL, 1396269185, NULL),
(12, 179847, 6, 22, -37000, 0, 1396269185, NULL, 1396269185, NULL),
(13, 179848, 7, 25, -20000, 0, 1396269219, NULL, 1396269219, NULL),
(14, 179847, 7, 26, 19500, 0, 1396269219, NULL, 1396269219, NULL),
(15, 179847, 8, 29, -25500, 0, 1396269219, NULL, 1396269219, NULL),
(16, 179848, 8, 30, 25000, 0, 1396269219, NULL, 1396269219, NULL),
(17, 179846, 9, 33, -38000, 0, 1396269254, NULL, 1396269254, NULL),
(18, 179847, 9, 34, -1000, 0, 1396269254, NULL, 1396269254, NULL),
(19, 179847, 10, 37, -100000, 0, 1396269255, NULL, 1396269255, NULL),
(20, 179846, 10, 38, 61000, 0, 1396269255, NULL, 1396269255, NULL),
(21, 179846, 11, 40, 18000, 0, 1396269282, NULL, 1396269282, NULL),
(22, 179848, 11, 41, 68000, 0, 1396269282, NULL, 1396269282, NULL),
(23, 179848, 12, 44, -19000, 0, 1396269282, NULL, 1396269282, NULL),
(24, 179846, 12, 45, 105000, 0, 1396269282, NULL, 1396269282, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `banks`
--

CREATE TABLE IF NOT EXISTS `banks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` smallint(5) unsigned NOT NULL,
  `is_master` tinyint(3) unsigned DEFAULT '0',
  `bic` varchar(255) DEFAULT NULL,
  `national_bank_code` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24514 ;

--
-- Daten für Tabelle `banks`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bank_accounts`
--

CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `paymey_account_id` int(11) unsigned NOT NULL,
  `country_id` smallint(5) unsigned NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_account` varchar(50) NOT NULL,
  `bank_code` varchar(50) NOT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `bic` varchar(255) DEFAULT NULL,
  `is_default` tinyint(3) unsigned DEFAULT '0',
  `is_verified` tinyint(3) unsigned DEFAULT '0',
  `payon_ident` varchar(255) DEFAULT NULL,
  `payon_response_url` varchar(255) NOT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `paymey_account_id`, `country_id`, `bank_name`, `bank_account`, `bank_code`, `iban`, `bic`, `is_default`, `is_verified`, `payon_ident`, `payon_response_url`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 179846, 54, 'Kreissparkasse', '********2345', '*****696', '********2345', '*****696', 1, 1, 'ff808081425622a001425ca298cf0951', '', 0, NULL, 0, NULL, 0),
(2, 179847, 54, 'Volksbank', '********2345', '********2342', '********2345', '********6456', 1, 1, 'ff808081425622a001425ca298cf0951', '', 0, NULL, 0, NULL, 0),
(3, 179848, 54, 'Commerzbank', '********2345', '********45646', '********6476', '********9786', 1, 1, 'ff808081425622a001425ca298cf0951', '', 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `businesses`
--

CREATE TABLE IF NOT EXISTS `businesses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_type_id` tinyint(3) unsigned NOT NULL,
  `business_category_id` smallint(5) unsigned NOT NULL,
  `business_subcategory_id` smallint(5) unsigned NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127351 ;

--
-- Daten für Tabelle `businesses`
--

INSERT INTO `businesses` (`id`, `business_type_id`, `business_category_id`, `business_subcategory_id`, `business_name`, `tax_id`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(127350, 1, 1, 1, 'attentra GmbH', 'DE12345678', 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `business_categories`
--

CREATE TABLE IF NOT EXISTS `business_categories` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `payon_channel` varchar(255) NOT NULL,
  `payon_sender` varchar(255) NOT NULL,
  `payon_login` varchar(255) NOT NULL,
  `payon_pass` varchar(255) NOT NULL,
  `payon_secret` varchar(255) NOT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Daten für Tabelle `business_categories`
--

INSERT INTO `business_categories` (`id`, `name`, `payon_channel`, `payon_sender`, `payon_login`, `payon_pass`, `payon_secret`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'Arts, crafts and collectibles', 'ff8080813ff6959e013ff83bdb2b02b7', 'ff8080813ff6959e013ff83bdb2b02b7', 'ff8080813ff6959e013ff83bdb2b02b9', 'cnBjRt35', 'ywNZaTSa8yZxS8MX', 0, 1379326250, 0, 1379326250, 0),
(2, 'B2B', 'ff8080813ff6959e013ff8222be90250', 'ff8080813ff6959e013ff8222be90250', 'ff8080813ff6959e013ff8222bea0254', 'WK7CzGt9', 'meTb87X2Zbaeyedt', 0, 1379326250, 0, 1379326250, 0),
(3, 'Baby', 'ff8080813ff6959e013ff84293d202e8', 'ff8080813ff6959e013ff84293d202e8', 'ff8080813ff6959e013ff84293d302ec', '2KfggFyE', 'Q5cygX75zRPwB2qc', 0, 1379326250, 0, 1379326250, 0),
(4, 'Beauty and fragrances', 'ff8080813ff6959e013ff844e0140301', 'ff8080813ff6959e013ff844e0140301', 'ff8080813ff6959e013ff844e0140303', 'Ww4PNGJt', '5XqM3cwytaXNTrHj', 0, 1379326250, 0, 1379326250, 0),
(5, 'Books and magazines', 'ff8080813ff6959e013ff848cf560312', 'ff8080813ff6959e013ff848cf560312', 'ff8080813ff6959e013ff848cf580316', 'jRZ4f88c', 'fctDG7SR84s4EjZB', 0, 1379326250, 0, 1379326250, 0),
(6, 'Clothing, accessoires and shoes', 'ff8080813ff6959e013ff84d29260335', 'ff8080813ff6959e013ff84d29260335', 'ff8080813ff6959e013ff84d29270339', 'MC3htCYk', 'dtHbK9FPKzJbndhQ', 0, 1379326250, 0, 1379326250, 0),
(7, 'Computer, accessories and services', 'ff8080813ff6959e013ff862e393035f', 'ff8080813ff6959e013ff862e393035f', 'ff8080813ff6959e013ff862e3950363', 'D82Cn6XP', 'fyje6pxPJbbRwGNa', 0, 1379326250, 0, 1379326250, 0),
(8, 'Education', 'ff8080813ff6959e013ff86b17e7039b', 'ff8080813ff6959e013ff86b17e7039b', 'ff8080813ff6959e013ff86b17e9039f', '748sHGqS', 'Ap8PCJXDhHqFEabk', 0, 1379326250, 0, 1379326250, 0),
(9, 'Entertainment and media', 'ff8080813ff6959e013ff8766c6b03ea', 'ff8080813ff6959e013ff8766c6b03ea', 'ff8080813ff6959e013ff8766c6c03ee', 'eHnyQ6kd', 'fB6BhTGybn4mZWNh', 0, 1379326250, 0, 1379326250, 0),
(10, 'Financial services and products', 'ff8080813ff6959e013ff87ee6c6042d', 'ff8080813ff6959e013ff87ee6c6042d', 'ff8080813ff6959e013ff87ee6c70431', 'ZF86rmK3', 'KDmXtzQXt8RGk76j', 0, 1379326250, 0, 1379326250, 0),
(11, 'Food retail and service', 'ff8080813ff6959e013ff88d4d9b0495', 'ff8080813ff6959e013ff88d4d9b0495', 'ff8080813ff6959e013ff88d4d9b0497', 'Dhdw3G5Z', '3cP3YwnD42NgDxEX', 0, 1379326250, 0, 1379326250, 0),
(12, 'Gifts and flowers', 'ff8080813ff6959e013ff8915d8a04b9', 'ff8080813ff6959e013ff8915d8a04b9', 'ff8080813ff6959e013ff8915d8b04bd', '2B37CjNF', 'axQjwkFDYH5eCNpX', 0, 1379326250, 0, 1379326250, 0),
(13, 'Government', 'ff8080813ff6959e013ff894b55304d6', 'ff8080813ff6959e013ff894b55304d6', 'ff8080813ff6959e013ff894b55404d8', 'K3qeAtFM', 'EjwxBEJ57jJgKHTZ', 0, 1379326250, 0, 1379326250, 0),
(14, 'Health and personal care', 'ff8080813ff6959e013ff8958c3d04de', 'ff8080813ff6959e013ff8958c3d04de', 'ff8080813ff6959e013ff8958c3e04e2', '8js5R3pB', 'G4bbc9MhCH5W5EHj', 0, 1379326250, 0, 1379326250, 0),
(15, 'Home and garden', 'ff8080813ff6959e013ff899991c04fd', 'ff8080813ff6959e013ff899991c04fd', 'ff8080813ff6959e013ff899991d0501', 'k3k3qycr', 'MTJHFsqc6j9cqXAw', 0, 1379326250, 0, 1379326250, 0),
(16, 'Nonprofit', 'ff8080813ff6959e013ff8a30eb0054d', 'ff8080813ff6959e013ff8a30eb0054d', 'ff8080813ff6959e013ff8a30eb10551', 'dp3tYbr2', 'KcYyEfRnrr7zgmaH', 0, 1379326250, 0, 1379326250, 0),
(17, 'Pets and animals', 'ff8080813ff6959e013ff8a53b550568', 'ff8080813ff6959e013ff8a53b550568', 'ff8080813ff6959e013ff8a53b56056c', '4Pd3zKqq', 'CYatZTkC9EyMtNJj', 0, 1379326250, 0, 1379326250, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `business_subcategories`
--

CREATE TABLE IF NOT EXISTS `business_subcategories` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` smallint(5) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `payon_channel` varchar(255) NOT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=160 ;

--
-- Daten für Tabelle `business_subcategories`
--

INSERT INTO `business_subcategories` (`id`, `category_id`, `name`, `payon_channel`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 1, 'Antiques', 'ff8080813ff6959e013ff83c437902bb', 0, 1379347489, NULL, 1379347489, NULL),
(2, 1, 'Art and craft supplies ', 'ff8080813ff6959e013ff83cd32302c1', 0, 1379347489, NULL, 1379347489, NULL),
(3, 1, 'Art dealers and galleries ', 'ff8080813ff6959e013ff83d594e02c3', 0, 1379347489, NULL, 1379347489, NULL),
(4, 1, 'Camera and photographic supplies ', 'ff8080813ff6959e013ff83e111102c9', 0, 1379347489, NULL, 1379347489, NULL),
(5, 1, 'Digital art', 'ff8080813ff6959e013ff83e7f5e02cb', 0, 1379347489, NULL, 1379347489, NULL),
(6, 1, 'Memorabilia ', 'ff8080813ff6959e013ff83f075602d1', 0, 1379347489, NULL, 1379347489, NULL),
(7, 1, 'Music store - instruments', 'ff8080813ff6959e013ff83fbf6302d4', 0, 1379347489, NULL, 1379347489, NULL),
(8, 1, 'Sewing, needlework and fabrics ', 'ff8080813ff6959e013ff840825c02d8', 0, 1379347489, NULL, 1379347489, NULL),
(9, 1, 'Stamp and coin', 'ff8080813ff6959e013ff840f06902de', 0, 1379347489, NULL, 1379347489, NULL),
(10, 1, 'Stationary, printing and writing paper ', 'ff8080813ff6959e013ff841acd302e0', 0, 1379347489, NULL, 1379347489, NULL),
(11, 1, 'Vintage and collectibles', 'ff8080813ff6959e013ff8422be202e4', 0, 1379347489, NULL, 1379347489, NULL),
(12, 2, 'Accounting', 'ff8080813ff6959e013ff82413320259', 0, 1379347489, NULL, 1379347489, NULL),
(13, 2, 'Advertising', 'ff8080813ff6959e013ff824a394025b', 0, 1379347489, NULL, 1379347489, NULL),
(14, 2, 'Agricultural', 'ff8080813ff6959e013ff8252e3d0261', 0, 1379347489, NULL, 1379347489, NULL),
(15, 2, 'Architectural, engineering and surveying services', 'ff8080813ff6959e013ff8264c4c0265', 0, 1379347489, NULL, 1379347489, NULL),
(16, 2, 'Chemicals and allied products', 'ff8080813ff6959e013ff826f7630267', 0, 1379347489, NULL, 1379347489, NULL),
(17, 2, 'Commercial photography, art and grafik design', 'ff8080813ff6959e013ff82bbbfa026c', 0, 1379347489, NULL, 1379347489, NULL),
(18, 2, 'Construction', 'ff8080813ff6959e013ff82c244d0270', 0, 1379347489, NULL, 1379347489, NULL),
(19, 2, 'Consulting services', 'ff8080813ff6959e013ff82cb4490274', 0, 1379347489, NULL, 1379347489, NULL),
(20, 2, 'Educational services', 'ff8080813ff6959e013ff82d430b0279', 0, 1379347489, NULL, 1379347489, NULL),
(21, 2, 'Equipment and leasing services', 'ff8080813ff6959e013ff82de673027f', 0, 1379347489, NULL, 1379347489, NULL),
(22, 2, 'Equipment repair services', 'ff8080813ff6959e013ff82e79340281', 0, 1379347489, NULL, 1379347489, NULL),
(23, 2, 'Hiring services', 'ff8080813ff6959e013ff82f01d20287', 0, 1379347489, NULL, 1379347489, NULL),
(24, 2, 'Industrial and manufacturing suppli', 'ff8080813ff6959e013ff82fc9aa0289', 0, 1379347489, NULL, 1379347489, NULL),
(25, 2, 'Mailing lists', 'ff8080813ff6959e013ff8302b53028d', 0, 1379347489, NULL, 1379347489, NULL),
(26, 2, 'Marketing', 'ff8080813ff6959e013ff83086750291', 0, 1379347489, NULL, 1379347489, NULL),
(27, 2, 'Office and commercial furniture', 'ff8080813ff6959e013ff8315c9d0295', 0, 1379347489, NULL, 1379347489, NULL),
(28, 2, 'Office supplies and equipment', 'ff8080813ff6959e013ff83215ce029c', 0, 1379347489, NULL, 1379347489, NULL),
(29, 2, 'Publishing and printing', 'ff8080813ff6959e013ff8328c88029e', 0, 1379347489, NULL, 1379347489, NULL),
(30, 2, 'Quick copy and reproduction service', 'ff8080813ff6959e013ff833280302a4', 0, 1379347489, NULL, 1379347489, NULL),
(31, 2, 'Shipping and packing', 'ff8080813ff6959e013ff833bf6102a6', 0, 1379347489, NULL, 1379347489, NULL),
(32, 2, 'Stenographic and secretarial suppor', 'ff8080813ff6959e013ff83a593202ae', 0, 1379347489, NULL, 1379347489, NULL),
(33, 2, 'Wholesale', 'ff8080813ff6959e013ff83adafe02b1', 0, 1379347489, NULL, 1379347489, NULL),
(34, 3, 'Baby products - other', 'ff8080813ff6959e013ff842fbf902ee', 0, 1379347489, NULL, 1379347489, NULL),
(35, 3, 'Clothing', 'ff8080813ff6959e013ff843562802f2', 0, 1379347489, NULL, 1379347489, NULL),
(36, 3, 'Furniture', 'ff8080813ff6959e013ff843dc5702f7', 0, 1379347489, NULL, 1379347489, NULL),
(37, 3, 'Safety and health', 'ff8080813ff6959e013ff8444c9602fb', 0, 1379347489, NULL, 1379347489, NULL),
(38, 4, 'Bath and body', 'ff8080813ff6959e013ff845471f0305', 0, 1379347489, NULL, 1379347489, NULL),
(39, 4, 'Fragrances and perfumes', 'ff8080813ff6959e013ff845c69c0309', 0, 1379347489, NULL, 1379347489, NULL),
(40, 4, 'Makeup and cosmetics', 'ff8080813ff6959e013ff8464c2f030d', 0, 1379347489, NULL, 1379347489, NULL),
(41, 5, 'Audio books', 'ff8080813ff6959e013ff8492ca00318', 0, 1379347489, NULL, 1379347489, NULL),
(42, 5, 'Digital content', 'ff8080813ff6959e013ff8499f83031c', 0, 1379347489, NULL, 1379347489, NULL),
(43, 5, 'Educational and textbooks', 'ff8080813ff6959e013ff84a218a0320', 0, 1379347489, NULL, 1379347489, NULL),
(44, 5, 'Fiction and non-fiction', 'ff8080813ff6959e013ff84af82f0324', 0, 1379347489, NULL, 1379347489, NULL),
(45, 5, 'Magazines', 'ff8080813ff6959e013ff84b4f2c0328', 0, 1379347489, NULL, 1379347489, NULL),
(46, 5, 'Publishing and printing', 'ff8080813ff6959e013ff84bd87c032e', 0, 1379347489, NULL, 1379347489, NULL),
(47, 5, 'Rare and used books', 'ff8080813ff6959e013ff84c5b300330', 0, 1379347489, NULL, 1379347489, NULL),
(48, 6, 'Accessories', 'ff8080813ff6959e013ff84d926a033b', 0, 1379347489, NULL, 1379347489, NULL),
(49, 6, 'Children clothing', 'ff8080813ff6959e013ff84e14fa0341', 0, 1379347489, NULL, 1379347489, NULL),
(50, 6, 'Fashion jewelry', 'ff8080813ff6959e013ff84e9dcb0343', 0, 1379347489, NULL, 1379347489, NULL),
(51, 6, 'Fine jewelry and watches', 'ff8080813ff6959e013ff8505a4f034d', 0, 1379347489, NULL, 1379347489, NULL),
(52, 6, 'Men clothing', 'ff8080813ff6959e013ff84f0ed80349', 0, 1379347489, NULL, 1379347489, NULL),
(53, 6, 'Shoes', 'ff8080813ff6959e013ff850c783034f', 0, 1379347489, NULL, 1379347489, NULL),
(54, 6, 'Wholesale - precious stones metals', 'ff8080813ff6959e013ff8516b920355', 0, 1379347489, NULL, 1379347489, NULL),
(55, 6, 'Women clothing', 'ff8080813ff6959e013ff860e050035b', 0, 1379347489, NULL, 1379347489, NULL),
(56, 7, 'Computer and data processing servic', 'ff8080813ff6959e013ff8636c920365', 0, 1379347489, NULL, 1379347489, NULL),
(57, 7, 'Desktop, laptops and notebooks', 'ff8080813ff6959e013ff864206b036c', 0, 1379347489, NULL, 1379347489, NULL),
(58, 7, 'Digital content', 'ff8080813ff6959e013ff864a744036e', 0, 1379347489, NULL, 1379347489, NULL),
(59, 7, 'eCommerce services', 'ff8080813ff6959e013ff86a938d0397', 0, 1379347489, NULL, 1379347489, NULL),
(60, 7, 'Maintenance', 'ff8080813ff6959e013ff8653d930374', 0, 1379347489, NULL, 1379347489, NULL),
(61, 7, 'Monitors and projectors', 'ff8080813ff6959e013ff865dc240376', 0, 1379347489, NULL, 1379347489, NULL),
(62, 7, 'Networking', 'ff8080813ff6959e013ff8666e34037c', 0, 1379347489, NULL, 1379347489, NULL),
(63, 7, 'Online gaming', 'ff8080813ff6959e013ff866e1f3037e', 0, 1379347489, NULL, 1379347489, NULL),
(64, 7, 'Parts and accessories', 'ff8080813ff6959e013ff867afb10384', 0, 1379347489, NULL, 1379347489, NULL),
(65, 7, 'Peripherals', 'ff8080813ff6959e013ff86820530386', 0, 1379347489, NULL, 1379347489, NULL),
(66, 7, 'Software', 'ff8080813ff6959e013ff8687a15038b', 0, 1379347489, NULL, 1379347489, NULL),
(67, 7, 'Training services', 'ff8080813ff6959e013ff869062f038f', 0, 1379347489, NULL, 1379347489, NULL),
(68, 7, 'Web hosting and design', 'ff8080813ff6959e013ff869c8e10395', 0, 1379347489, NULL, 1379347489, NULL),
(69, 8, 'Business and secretarial schools', 'ff8080813ff6959e013ff86bc21f03a1', 0, 1379347489, NULL, 1379347489, NULL),
(70, 8, 'Child daycare services', 'ff8080813ff6959e013ff86c469d03a7', 0, 1379347489, NULL, 1379347489, NULL),
(71, 8, 'Colleges and Universities', 'ff8080813ff6959e013ff86cf2a703aa', 0, 1379347489, NULL, 1379347489, NULL),
(72, 8, 'Dance halls, studios and schools', 'ff8080813ff6959e013ff86df7a603ae', 0, 1379347489, NULL, 1379347489, NULL),
(73, 8, 'Elementary and secondary schools', 'ff8080813ff6959e013ff86e8dd303b4', 0, 1379347489, NULL, 1379347489, NULL),
(74, 8, 'Vocational and trade schools', 'ff8080813ff6959e013ff86f187203b6', 0, 1379347489, NULL, 1379347489, NULL),
(75, 9, 'Adult digital content', 'ff8080813ff6959e013ff876de2e03f0', 0, 1379347489, NULL, 1379347489, NULL),
(76, 9, 'Cable, satellite and other pay tv', 'ff8080813ff6959e013ff877cbdb03f6', 0, 1379347489, NULL, 1379347489, NULL),
(77, 9, 'Concert tickets', 'ff8080813ff6959e013ff878377903f8', 0, 1379347489, NULL, 1379347489, NULL),
(78, 9, 'Digital content', 'ff8080813ff6959e013ff87899bc03fc', 0, 1379347489, NULL, 1379347489, NULL),
(79, 9, 'Entertainers', 'ff8080813ff6959e013ff878fee90400', 0, 1379347489, NULL, 1379347489, NULL),
(80, 9, 'Gambling', 'ff8080813ff6959e013ff8795a630404', 0, 1379347489, NULL, 1379347489, NULL),
(81, 9, 'Memorabilia', 'ff8080813ff6959e013ff879dad8040a', 0, 1379347489, NULL, 1379347489, NULL),
(82, 9, 'Movie tickets', 'ff8080813ff6959e013ff87a4abd040c', 0, 1379347489, NULL, 1379347489, NULL),
(83, 9, 'Movies - Blueray,DVD', 'ff8080813ff6959e013ff87b0de80413', 0, 1379347489, NULL, 1379347489, NULL),
(84, 9, 'Music - CD, Albums', 'ff8080813ff6959e013ff87bc67c0415', 0, 1379347489, NULL, 1379347489, NULL),
(85, 9, 'Online games', 'ff8080813ff6959e013ff87c50e9041b', 0, 1379347489, NULL, 1379347489, NULL),
(86, 9, 'Slot machines', 'ff8080813ff6959e013ff87cbe36041d', 0, 1379347489, NULL, 1379347489, NULL),
(87, 9, 'Theater tickets', 'ff8080813ff6959e013ff87d24ed0421', 0, 1379347489, NULL, 1379347489, NULL),
(88, 9, 'Toys and games', 'ff8080813ff6959e013ff87db4cc0425', 0, 1379347489, NULL, 1379347489, NULL),
(89, 9, 'Video games and systems', 'ff8080813ff6959e013ff87e3081042b', 0, 1379347489, NULL, 1379347489, NULL),
(90, 10, 'Accounting', 'ff8080813ff6959e013ff87f961f0434', 0, 1379347489, NULL, 1379347489, NULL),
(91, 10, 'Collection agency', 'ff8080813ff6959e013ff880a9a80438', 0, 1379347489, NULL, 1379347489, NULL),
(92, 10, 'Commodities and future exchange', 'ff8080813ff6959e013ff8816598043e', 0, 1379347489, NULL, 1379347489, NULL),
(93, 10, 'Consumer credit reporting agencies', 'ff8080813ff6959e013ff881f9530440', 0, 1379347489, NULL, 1379347489, NULL),
(94, 10, 'Credit union', 'ff8080813ff6959e013ff8826bcd0446', 0, 1379347489, NULL, 1379347489, NULL),
(95, 10, 'Currency dealers and currency excha', 'ff8080813ff6959e013ff8830ca30448', 0, 1379347489, NULL, 1379347489, NULL),
(96, 10, 'Debt counseling service', 'ff8080813ff6959e013ff883a180044e', 0, 1379347489, NULL, 1379347489, NULL),
(97, 10, 'Escrow', 'ff8080813ff6959e013ff88414090451', 0, 1379347489, NULL, 1379347489, NULL),
(98, 10, 'Finance company', 'ff8080813ff6959e013ff88478c00455', 0, 1379347489, NULL, 1379347489, NULL),
(99, 10, 'Financial and investment advice', 'ff8080813ff6959e013ff8850fcc0459', 0, 1379347489, NULL, 1379347489, NULL),
(100, 10, 'Insurance - auto and home', 'ff8080813ff6959e013ff885a804045f', 0, 1379347489, NULL, 1379347489, NULL),
(101, 10, 'Insurance - life and annuity', 'ff8080813ff6959e013ff8862bf60461', 0, 1379347489, NULL, 1379347489, NULL),
(102, 10, 'Investments - general', 'ff8080813ff6959e013ff886b5190467', 0, 1379347489, NULL, 1379347489, NULL),
(103, 10, 'Money service business', 'ff8080813ff6959e013ff8872fc90469', 0, 1379347489, NULL, 1379347489, NULL),
(104, 10, 'Mortage brokers or dealers', 'ff8080813ff6959e013ff887a809046f', 0, 1379347489, NULL, 1379347489, NULL),
(105, 10, 'Online gaming currency', 'ff8080813ff6959e013ff88838dc0471', 0, 1379347489, NULL, 1379347489, NULL),
(106, 10, 'Paycheck lender or cash advance', 'ff8080813ff6959e013ff8893d4d0476', 0, 1379347489, NULL, 1379347489, NULL),
(107, 10, 'Prepaid and stored value cards', 'ff8080813ff6959e013ff889d9ee047c', 0, 1379347489, NULL, 1379347489, NULL),
(108, 10, 'Real estate agent', 'ff8080813ff6959e013ff88a711b047e', 0, 1379347489, NULL, 1379347489, NULL),
(109, 10, 'Remittance', 'ff8080813ff6959e013ff88af0db0484', 0, 1379347490, NULL, 1379347490, NULL),
(110, 10, 'Rental property management', 'ff8080813ff6959e013ff88b870f0486', 0, 1379347490, NULL, 1379347490, NULL),
(111, 10, 'Security brokers and dealers', 'ff8080813ff6959e013ff88c2cff048c', 0, 1379347490, NULL, 1379347490, NULL),
(112, 10, 'Wire transfer and money order', 'ff8080813ff6959e013ff88cb044048e', 0, 1379347490, NULL, 1379347490, NULL),
(113, 11, 'Alcoholic beverages', 'ff8080813ff6959e013ff88daf550499', 0, 1379347490, NULL, 1379347490, NULL),
(114, 11, 'Catering services', 'ff8080813ff6959e013ff88e233c049d', 0, 1379347490, NULL, 1379347490, NULL),
(115, 11, 'Coffee and tea', 'ff8080813ff6959e013ff88e819e04a1', 0, 1379347490, NULL, 1379347490, NULL),
(116, 11, 'Gourmet foods', 'ff8080813ff6959e013ff88f0f8f04a5', 0, 1379347490, NULL, 1379347490, NULL),
(117, 11, 'Restaurant', 'ff8080813ff6959e013ff88f6d8404a9', 0, 1379347490, NULL, 1379347490, NULL),
(118, 11, 'Specialty and misc food', 'ff8080813ff6959e013ff890175404af', 0, 1379347490, NULL, 1379347490, NULL),
(119, 11, 'Tobacco', 'ff8080813ff6959e013ff8907ab004b1', 0, 1379347490, NULL, 1379347490, NULL),
(120, 11, 'Vitamins and supplements', 'ff8080813ff6959e013ff890da8904b5', 0, 1379347490, NULL, 1379347490, NULL),
(121, 12, 'Florist', 'ff8080813ff6959e013ff891a52b04c0', 0, 1379347490, NULL, 1379347490, NULL),
(122, 12, 'Gift, card, novelty and souvenir', 'ff8080813ff6959e013ff892a3fb04c6', 0, 1379347490, NULL, 1379347490, NULL),
(123, 12, 'Gourmet foods', 'ff8080813ff6959e013ff89325bd04c8', 0, 1379347490, NULL, 1379347490, NULL),
(124, 12, 'Nursery plants and flowers', 'ff8080813ff6959e013ff893bd1404ce', 0, 1379347490, NULL, 1379347490, NULL),
(125, 12, 'Party supplies', 'ff8080813ff6959e013ff8942f6c04d0', 0, 1379347490, NULL, 1379347490, NULL),
(126, 13, 'Government services', 'ff8080813ff6959e013ff8950c3004da', 0, 1379347490, NULL, 1379347490, NULL),
(127, 14, 'Dental care', 'ff8080813ff6959e013ff895df0e04e4', 0, 1379347490, NULL, 1379347490, NULL),
(128, 14, 'Drugstore (excl prescription)', 'ff8080813ff6959e013ff89786cb04ed', 0, 1379347490, NULL, 1379347490, NULL),
(129, 14, 'Drugstore (incl prescription)', 'ff8080813ff6959e013ff897168d04eb', 0, 1379347490, NULL, 1379347490, NULL),
(130, 14, 'Medical care', 'ff8080813ff6959e013ff897e16804f1', 0, 1379347490, NULL, 1379347490, NULL),
(131, 14, 'Medical equipment and supplies', 'ff8080813ff6959e013ff89878f404f5', 0, 1379347490, NULL, 1379347490, NULL),
(132, 14, 'Vision care', 'ff8080813ff6959e013ff898d39d04f9', 0, 1379347490, NULL, 1379347490, NULL),
(133, 15, 'Antiques', 'ff8080813ff6959e013ff89a3f610503', 0, 1379347490, NULL, 1379347490, NULL),
(134, 15, 'Appliances', 'ff8080813ff6959e013ff89a9f2b0509', 0, 1379347490, NULL, 1379347490, NULL),
(135, 15, 'Bed and bath', 'ff8080813ff6959e013ff89b73e7050c', 0, 1379347490, NULL, 1379347490, NULL),
(136, 15, 'Construction material', 'ff8080813ff6959e013ff89be5bb0510', 0, 1379347490, NULL, 1379347490, NULL),
(137, 15, 'Drapery, window covering and uphols', 'ff8080813ff6959e013ff89ca43c0516', 0, 1379347490, NULL, 1379347490, NULL),
(138, 15, 'Exterminating and disinfection service', 'ff8080813ff6959e013ff89d401d0518', 0, 1379347490, NULL, 1379347490, NULL),
(139, 15, 'Fireplace and fireplace screens', 'ff8080813ff6959e013ff89dc61a051e', 0, 1379347490, NULL, 1379347490, NULL),
(140, 15, 'Furniture', 'ff8080813ff6959e013ff89e22640520', 0, 1379347490, NULL, 1379347490, NULL),
(141, 15, 'Garden supplies', 'ff8080813ff6959e013ff89e8cdb0524', 0, 1379347490, NULL, 1379347490, NULL),
(142, 15, 'Glass, paint and wallpaper', 'ff8080813ff6959e013ff89f299a0528', 0, 1379347490, NULL, 1379347490, NULL),
(143, 15, 'Hardware and tools', 'ff8080813ff6959e013ff89f8c94052d', 0, 1379347490, NULL, 1379347490, NULL),
(144, 15, 'Home decor', 'ff8080813ff6959e013ff89fef6d0531', 0, 1379347490, NULL, 1379347490, NULL),
(145, 15, 'Housewares', 'ff8080813ff6959e013ff8a06a7a0535', 0, 1379347490, NULL, 1379347490, NULL),
(146, 15, 'Kitchenware', 'ff8080813ff6959e013ff8a0cae10539', 0, 1379347490, NULL, 1379347490, NULL),
(147, 15, 'Landscaping', 'ff8080813ff6959e013ff8a1236f053d', 0, 1379347490, NULL, 1379347490, NULL),
(148, 15, 'Rugs and carpets', 'ff8080813ff6959e013ff8a197dd0543', 0, 1379347490, NULL, 1379347490, NULL),
(149, 15, 'Security and surveillance equipment', 'ff8080813ff6959e013ff8a2402c0545', 0, 1379347490, NULL, 1379347490, NULL),
(150, 15, 'Swimming pools and spas', 'ff8080813ff6959e013ff8a2ad0c054b', 0, 1379347490, NULL, 1379347490, NULL),
(151, 16, 'Charity', 'ff8080813ff6959e013ff8a35a340553', 0, 1379347490, NULL, 1379347490, NULL),
(152, 16, 'Educational', 'ff8080813ff6959e013ff8a3ac7d0557', 0, 1379347490, NULL, 1379347490, NULL),
(153, 16, 'Other', 'ff8080813ff6959e013ff8a3fecd055e', 0, 1379347490, NULL, 1379347490, NULL),
(154, 16, 'Personal', 'ff8080813ff6959e013ff8a4549c0560', 0, 1379347490, NULL, 1379347490, NULL),
(155, 16, 'Political', 'ff8080813ff6959e013ff8a4b6f50564', 0, 1379347490, NULL, 1379347490, NULL),
(156, 17, 'Medication and supplements', 'ff8080813ff6959e013ff8a59d24056e', 0, 1379347490, NULL, 1379347490, NULL),
(157, 17, 'Pet shops, pet food and supplies', 'ff8080813ff6959e013ff8a61f9e0572', 0, 1379347490, NULL, 1379347490, NULL),
(158, 17, 'Specialty or rare pets', 'ff8080813ff6959e013ff8a6adff0576', 0, 1379347490, NULL, 1379347490, NULL),
(159, 17, 'Veterinary service', 'ff8080813ff6959e013ff8a72f8b057c', 0, 1379347490, NULL, 1379347490, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `business_types`
--

CREATE TABLE IF NOT EXISTS `business_types` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `business_types`
--

INSERT INTO `business_types` (`id`, `name`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'Natural person', 0, NULL, 0, NULL, 0),
(2, 'Sole Proprietorship', 0, NULL, 0, NULL, 0),
(3, 'Partnership', 0, NULL, 0, NULL, 0),
(4, 'Capital Corporation', 0, NULL, 0, NULL, 0),
(5, 'Listed Company', 0, NULL, 0, NULL, 0),
(6, 'Non-profit Organization', 0, NULL, 0, NULL, 0),
(7, 'Public company', 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_default` tinyint(3) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `channels`
--

INSERT INTO `channels` (`id`, `name`, `is_default`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'default', 1, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `currency_id` smallint(5) unsigned NOT NULL,
  `region_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `local_name` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `iso_2` varchar(255) NOT NULL,
  `iso_3` varchar(255) NOT NULL,
  `sorting` int(10) unsigned DEFAULT '0',
  `is_eu_member` int(10) unsigned DEFAULT '0',
  `is_uno_member` int(10) unsigned DEFAULT '0',
  `is_visible` int(10) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=251 ;

--
-- Daten für Tabelle `countries`
--

INSERT INTO `countries` (`id`, `currency_id`, `region_id`, `name`, `local_name`, `name_en`, `name_de`, `iso_2`, `iso_3`, `sorting`, `is_eu_member`, `is_uno_member`, `is_visible`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 0, 0, 'Principality of Andorra', 'Andorra', 'Andorra', 'Andorra', 'AD', 'AND', 1, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(2, 0, 0, 'United Arab Emirates', 'الإمارات العربيّة المتّحدة', 'United Arab Emirates', 'Vereinigte Arabische Emirate', 'AE', 'ARE', 2, 0, 1, 1, 0, 1376646223, 0, 1376648201, 0),
(3, 0, 0, 'Islamic Republic of Afghanistan', 'افغانستان', 'Afghanistan', 'Afghanistan', 'AF', 'AFG', 3, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(4, 0, 0, 'Antigua and Barbuda', 'Antigua and Barbuda', 'Antigua and Barbuda', 'Antigua und Barbuda', 'AG', 'ATG', 4, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(5, 0, 0, 'Anguilla', 'Anguilla', 'Anguilla', 'Anguilla', 'AI', 'AIA', 5, 0, 0, 1, 0, 1376646223, 0, 1376648197, 0),
(6, 0, 0, 'Republic of Albania', 'Shqipëria', 'Albania', 'Albanien', 'AL', 'ALB', 6, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(7, 0, 0, 'Republic of Armenia', 'Հայաստան', 'Armenia', 'Armenien', 'AM', 'ARM', 7, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(8, 0, 0, 'Netherlands Antilles', 'Nederlandse Antillen', 'Netherlands Antilles', 'Niederländische Antillen', 'AN', 'ANT', 8, 0, 0, 1, 0, 1376646223, 0, 1376648200, 0),
(9, 0, 0, 'Republic of Angola', 'Angola', 'Angola', 'Angola', 'AO', 'AGO', 9, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(10, 0, 0, 'Antarctica', 'Antarctica', 'Antarctica', 'Südliche Shetlandinseln ', 'AQ', 'ATA', 10, 0, 0, 1, 0, 1376646223, 0, 1376648201, 0),
(11, 0, 0, 'Argentine Republic', 'Argentina', 'Argentina', 'Argentinien', 'AR', 'ARG', 11, 0, 1, 1, 0, 1376646223, 0, 1376648198, 0),
(12, 0, 0, 'American Samoa', 'Amerika Samoa', 'American Samoa', 'Amerikanisch-Samoa', 'AS', 'ASM', 12, 0, 0, 1, 0, 1376646223, 0, 1376648197, 0),
(13, 1, 1, 'Republic of Austria', 'Österreich', 'Austria', 'Österreich', 'AT', 'AUT', 13, 1, 1, 1, 0, 1376646223, 0, 1376648200, 0),
(14, 0, 0, 'Commonwealth of Australia', 'Australia', 'Australia', 'Australien', 'AU', 'AUS', 14, 0, 1, 1, 0, 1376646223, 0, 1376648199, 0),
(15, 0, 0, 'Aruba', 'Aruba', 'Aruba', 'Aruba', 'AW', 'ABW', 15, 0, 0, 1, 0, 1376646223, 0, 1376648197, 0),
(16, 0, 0, 'Republic of Azerbaijan', 'Azərbaycan', 'Azerbaijan', 'Aserbaidschan', 'AZ', 'AZE', 16, 0, 1, 1, 0, 1376646223, 0, 1376648201, 0),
(17, 0, 0, 'Bosnia and Herzegovina', 'BiH/БиХ', 'Bosnia and Herzegovina', 'Sastavci', 'BA', 'BIH', 17, 0, 1, 1, 0, 1376646223, 0, 1376648200, 0),
(18, 0, 0, 'Barbados', 'Barbados', 'Barbados', 'Barbados', 'BB', 'BRB', 18, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(19, 0, 0, 'People’s Republic of Bangladesh', 'বাংলাদেশ', 'Bangladesh', 'Bangladesch', 'BD', 'BGD', 19, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(20, 0, 0, 'Kingdom of Belgium', 'Belgique', 'Belgium', 'Belgien', 'BE', 'BEL', 20, 1, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(21, 0, 0, 'Burkina Faso', 'Burkina', 'Burkina Faso', 'Burkina Faso', 'BF', 'BFA', 21, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(22, 0, 0, 'Republic of Bulgaria', 'България', 'Bulgaria', 'Bulgarien', 'BG', 'BGR', 22, 1, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(23, 0, 0, 'Kingdom of Bahrain', 'البحري', 'Bahrain', 'Bahrain', 'BH', 'BHR', 23, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(24, 0, 0, 'Republic of Burundi', 'Burundi', 'Burundi', 'Burundi', 'BI', 'BDI', 24, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(25, 0, 0, 'Republic of Benin', 'Bénin', 'Benin', 'Benin', 'BJ', 'BEN', 25, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(26, 0, 0, 'Bermuda', 'Bermuda', 'Bermuda', 'Bermuda', 'BM', 'BMU', 26, 0, 0, 1, 0, 1376646223, 0, 1376648197, 0),
(27, 0, 0, 'Sultanate of Brunei', 'دارالسلام', 'Brunei', 'Brunei Darussalam', 'BN', 'BRN', 27, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(28, 0, 0, 'Plurinational State of Bolivia', 'Bolivia', 'Bolivia', 'Bolivien', 'BO', 'BOL', 28, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(29, 0, 0, 'Federative Republic of Brazil', 'Brasil', 'Brazil', 'Brasilien', 'BR', 'BRA', 29, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(30, 0, 0, 'Commonwealth of The Bahamas', 'The Bahamas', 'The Bahamas', 'Bahamas', 'BS', 'BHS', 30, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(31, 0, 0, 'Kingdom of Bhutan', 'Druk-Yul', 'Bhutan', 'Bhutan', 'BT', 'BTN', 31, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(32, 0, 0, 'Bouvet Island', 'Bouvet Island', 'Bouvet Island', 'Bouvetinsel', 'BV', 'BVT', 32, 0, 0, 1, 0, 1376646223, 0, 1376648197, 0),
(33, 0, 0, 'Republic of Botswana', 'Botswana', 'Botswana', 'Botsuana', 'BW', 'BWA', 33, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(34, 0, 0, 'Republic of Belarus', 'Беларусь', 'Belarus', 'Weißrussland', 'BY', 'BLR', 34, 0, 1, 1, 0, 1376646223, 0, 1376648201, 0),
(35, 0, 0, 'Belize', 'Belize', 'Belize', 'Belize', 'BZ', 'BLZ', 35, 0, 1, 1, 0, 1376646223, 0, 1376648197, 0),
(36, 0, 0, 'Canada', 'Canada', 'Canada', 'Kanada', 'CA', 'CAN', 36, 0, 1, 1, 0, 1376646223, 0, 1376648199, 0),
(37, 0, 0, 'Territory of Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'Kokosinseln', 'CC', 'CCK', 37, 0, 0, 1, 0, 1376646223, 0, 1376648199, 0),
(38, 0, 0, 'Democratic Republic of the Congo', 'Congo', 'Congo', 'Kongo (Kinshasa)', 'CD', 'COD', 38, 0, 1, 1, 0, 1376646223, 0, 1376648199, 0),
(39, 0, 0, 'Central African Republic', 'Centrafrique', 'Central African Republic', 'Zentralafrikanische Republik', 'CF', 'CAF', 39, 0, 1, 1, 0, 1376646223, 0, 1376648201, 0),
(40, 0, 0, 'Republic of the Congo', 'Congo-Brazzaville', 'Congo-Brazzaville', 'Kongo (Brazzaville)', 'CG', 'COG', 40, 0, 1, 1, 0, 1376646223, 0, 1376648199, 0),
(41, 0, 0, 'Swiss Confederation', 'Schweiz', 'Switzerland', 'Schweiz', 'CH', 'CHE', 41, 0, 1, 1, 0, 1376646223, 0, 1376648200, 0),
(42, 0, 0, 'Republic of Côte d''Ivoire', 'Côte d’Ivoire', 'Côte d’Ivoire', 'Elfenbeinküste', 'CI', 'CIV', 42, 0, 1, 1, 0, 1376646223, 0, 1376648198, 0),
(43, 0, 0, 'Cook Islands', 'Cook Islands', 'Cook Islands', 'Cookinseln', 'CK', 'COK', 43, 0, 0, 1, 0, 1376646223, 0, 1376648197, 0),
(44, 0, 0, 'Republic of Chile', 'Chile', 'Chile', 'Chile', 'CL', 'CHL', 44, 0, 1, 1, 0, 1376646223, 0, 1376648200, 0),
(45, 0, 0, 'Republic of Cameroon', 'Cameroun', 'Cameroon', 'Kamerun', 'CM', 'CMR', 45, 0, 1, 1, 0, 1376646223, 0, 1376648199, 0),
(46, 0, 0, 'People’s Republic of China', '中华', 'China', 'Tibet', 'CN', 'CHN', 46, 0, 1, 1, 0, 1376646223, 0, 1376648201, 0),
(47, 0, 0, 'Republic of Colombia', 'Colombia', 'Colombia', 'Kolumbien', 'CO', 'COL', 47, 0, 1, 1, 0, 1376646223, 0, 1376648200, 0),
(48, 0, 0, 'Republic of Costa Rica', 'Costa Rica', 'Costa Rica', 'Costa Rica', 'CR', 'CRI', 48, 0, 1, 1, 0, 1376646223, 0, 1376648198, 0),
(49, 0, 0, 'Republic of Cuba', 'Cuba', 'Cuba', 'Kuba', 'CU', 'CUB', 49, 0, 1, 1, 0, 1376646223, 0, 1376648199, 0),
(50, 0, 0, 'Republic of Cape Verde', 'Cabo Verde', 'Cape Verde', 'Kap Verde', 'CV', 'CPV', 50, 0, 1, 1, 0, 1376646223, 0, 1376648199, 0),
(51, 0, 0, 'Territory of Christmas Island', 'Christmas Island', 'Christmas Island', 'Weihnachtsinsel', 'CX', 'CXR', 51, 0, 0, 1, 0, 1376646223, 0, 1376648201, 0),
(52, 0, 0, 'Republic of Cyprus', 'Κύπρος / Kıbrıs', 'Cyprus', 'Zypern', 'CY', 'CYP', 52, 1, 1, 1, 0, 1376646223, 0, 1376648201, 0),
(53, 0, 0, 'Czech Republic', 'Cesko', 'Czech Republic', 'Tschechien', 'CZ', 'CZE', 53, 1, 1, 1, 0, 1376646223, 0, 1376648201, 0),
(54, 1, 1, 'Federal Republic of Germany', 'Deutschland', 'Germany', 'Deutschland', 'DE', 'DEU', 54, 1, 1, 1, 0, 1376646223, 0, 1376648198, 0),
(55, 0, 0, 'Republic of Djibouti', 'جيبوتي /Djibouti', 'Djibouti', 'Dschibuti', 'DJ', 'DJI', 55, 0, 1, 1, 0, 1376646223, 0, 1376648198, 0),
(56, 0, 0, 'Kingdom of Denmark', 'Danmark', 'Denmark', 'Dänemark', 'DK', 'DNK', 56, 1, 1, 1, 0, 1376646223, 0, 1376648198, 0),
(57, 0, 0, 'Commonwealth of Dominica', 'Dominica', 'Dominica', 'Dominica', 'DM', 'DMA', 57, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(58, 0, 0, 'Dominican Republic', 'Quisqueya', 'Dominican Republic', 'Dominikanische Republik', 'DO', 'DOM', 58, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(59, 0, 0, 'People’s Democratic Republic of Algeria', 'الجزائ', 'Algeria', 'Algerien', 'DZ', 'DZA', 59, 0, 1, 1, 0, 1376646224, 0, 1376648197, 0),
(60, 0, 0, 'Republic of Ecuador', 'Ecuador', 'Ecuador', 'Ecuador', 'EC', 'ECU', 60, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(61, 0, 0, 'Republic of Estonia', 'Eesti', 'Estonia', 'Estland', 'EE', 'EST', 61, 1, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(62, 0, 0, 'Arab Republic of Egypt', 'مصر', 'Egypt', 'Ägypten', 'EG', 'EGY', 62, 0, 1, 1, 0, 1376646224, 0, 1376648197, 0),
(63, 0, 0, 'Western Sahara', 'الصحراء الغربي', 'Western Sahara', 'Westsahara', 'EH', 'ESH', 63, 0, 0, 1, 0, 1376646224, 0, 1376648201, 0),
(64, 0, 0, 'State of Eritrea', 'ኤርትራ', 'Eritrea', 'Eritrea', 'ER', 'ERI', 64, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(65, 0, 0, 'Kingdom of Spain', 'España', 'Spain', 'Spanien', 'ES', 'ESP', 65, 1, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(66, 0, 0, 'Federal Democratic Republic of Ethiopia', 'ኢትዮጵያ', 'Ethiopia', 'Äthiopien', 'ET', 'ETH', 66, 0, 1, 1, 0, 1376646224, 0, 1376648197, 0),
(67, 0, 0, 'Republic of Finland', 'Suomi', 'Finland', 'Finnland', 'FI', 'FIN', 67, 1, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(68, 0, 0, 'Republic of the Fiji Islands', 'Viti', 'Fiji', 'Fidschi', 'FJ', 'FJI', 68, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(69, 0, 0, 'Falkland Islands', 'Falkland Islands', 'Falkland Islands', 'Falklandinseln', 'FK', 'FLK', 69, 0, 0, 1, 0, 1376646224, 0, 1376648198, 0),
(70, 0, 0, 'Federated States of Micronesia', 'Micronesia', 'Micronesia', 'Mikronesien', 'FM', 'FSM', 70, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(71, 0, 0, 'Faroe Islands', 'Føroyar / Færøerne', 'Faroes', 'Färöer', 'FO', 'FRO', 71, 0, 0, 1, 0, 1376646224, 0, 1376648198, 0),
(72, 0, 0, 'French Republic', 'France', 'France', 'Frankreich', 'FR', 'FRA', 72, 1, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(73, 0, 0, 'Gabonese Republic', 'Gabon', 'Gabon', 'Gabun', 'GA', 'GAB', 73, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(74, 0, 0, 'United Kingdom of Great Britain and Northern', 'United Kingdom', 'United Kingdom', 'Wales', 'GB', 'GBR', 74, 1, 1, 1, 0, 1376646224, 0, 1376648201, 0),
(75, 0, 0, 'Grenada', 'Grenada', 'Grenada', 'Grenada', 'GD', 'GRD', 75, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(76, 0, 0, 'Georgia', 'საქართველო', 'Georgia', 'Georgien', 'GE', 'GEO', 76, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(77, 0, 0, 'French Guiana', 'Guyane française', 'French Guiana', 'Französisch-Guayana', 'GF', 'GUF', 77, 0, 0, 1, 0, 1376646224, 0, 1376648198, 0),
(78, 0, 0, 'Republic of Ghana', 'Ghana', 'Ghana', 'Ghana', 'GH', 'GHA', 78, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(79, 0, 0, 'Gibraltar', 'Gibraltar', 'Gibraltar', 'Gibraltar', 'GI', 'GIB', 79, 0, 0, 1, 0, 1376646224, 0, 1376648198, 0),
(80, 0, 0, 'Greenland', 'Grønland', 'Greenland', 'Grönland', 'GL', 'GRL', 80, 0, 0, 1, 0, 1376646224, 0, 1376648198, 0),
(81, 0, 0, 'Republic of The Gambia', 'Gambia', 'Gambia', 'Gambia', 'GM', 'GMB', 81, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(82, 0, 0, 'Republic of Guinea', 'Guinée', 'Guinea', 'Guinea', 'GN', 'GIN', 82, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(83, 0, 0, 'Department of Guadeloupe', 'Guadeloupe', 'Guadeloupe', 'Guadeloupe', 'GP', 'GLP', 83, 0, 0, 1, 0, 1376646224, 0, 1376648199, 0),
(84, 0, 0, 'Republic of Equatorial Guinea', 'Guinea Ecuatorial', 'Equatorial Guinea', 'Äquatorialguinea', 'GQ', 'GNQ', 84, 0, 1, 1, 0, 1376646224, 0, 1376648197, 0),
(85, 0, 0, 'Hellenic Republic', 'Ελλάδα', 'Greece', 'Griechenland', 'GR', 'GRC', 85, 1, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(86, 0, 0, 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'Südliche Sandwichinseln', 'GS', 'SGS', 86, 0, 0, 1, 0, 1376646224, 0, 1376648201, 0),
(87, 0, 0, 'Republic of Guatemala', 'Guatemala', 'Guatemala', 'Guatemala', 'GT', 'GTM', 87, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(88, 0, 0, 'The Territory of Guam', 'Guåhån', 'Guam', 'Guam', 'GU', 'GUM', 88, 0, 0, 1, 0, 1376646224, 0, 1376648198, 0),
(89, 0, 0, 'Republic of Guinea-Bissau', 'Guiné-Bissau', 'Guinea-Bissau', 'Guinea-Bissau', 'GW', 'GNB', 89, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(90, 0, 0, 'Co-operative Republic of Guyana', 'Guyana', 'Guyana', 'Guyana', 'GY', 'GUY', 90, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(91, 0, 0, 'Hong Kong SAR of the People’s Republic of China', '香港', 'Hong Kong SAR of China', 'Hong Kong', 'HK', 'HKG', 91, 0, 0, 1, 0, 1376646224, 0, 1376648198, 0),
(92, 0, 0, 'Republic of Honduras', 'Honduras', 'Honduras', 'Honduras', 'HN', 'HND', 92, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(93, 0, 0, 'Republic of Croatia', 'Hrvatska', 'Croatia', 'Kroatien', 'HR', 'HRV', 93, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(94, 0, 0, 'Republic of Haiti', 'Ayiti', 'Haiti', 'Haiti', 'HT', 'HTI', 94, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(95, 0, 0, 'Republic of Hungary', 'Magyarország', 'Hungary', 'Ungarn', 'HU', 'HUN', 95, 1, 1, 1, 0, 1376646224, 0, 1376648201, 0),
(96, 0, 0, 'Republic of Indonesia', 'Indonesia', 'Indonesia', 'Indonesien', 'ID', 'IDN', 96, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(97, 0, 0, 'Republic of Ireland', 'Éire', 'Ireland', 'Irland', 'IE', 'IRL', 97, 1, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(98, 0, 0, 'State of Israel', 'ישראל', 'Israel', 'Israel', 'IL', 'ISR', 98, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(99, 0, 0, 'Republic of India', 'India', 'India', 'Indien', 'IN', 'IND', 99, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(100, 0, 0, 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'Britisches Territorium im Indischen Ozean', 'IO', 'IOT', 100, 0, 0, 1, 0, 1376646224, 0, 1376648201, 0),
(101, 0, 0, 'Republic of Iraq', 'العراق / عيَراق', 'Iraq', 'Irak', 'IQ', 'IRQ', 101, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(102, 0, 0, 'Islamic Republic of Iran', 'ايران', 'Iran', 'Iran', 'IR', 'IRN', 102, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(103, 0, 0, 'Republic of Iceland', 'Ísland', 'Iceland', 'Island', 'IS', 'ISL', 103, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(104, 0, 0, 'Italian Republic', 'Italia', 'Italy', 'Italien', 'IT', 'ITA', 104, 1, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(105, 0, 0, 'Commonwealth of Jamaica', 'Jamaica', 'Jamaica', 'Jamaika', 'JM', 'JAM', 105, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(106, 0, 0, 'Hashemite Kingdom of Jordan', 'أردنّ', 'Jordan', 'Jordanien', 'JO', 'JOR', 106, 0, 1, 1, 0, 1376646224, 0, 1376648198, 0),
(107, 0, 0, 'Japan', '日本', 'Japan', 'Japan', 'JP', 'JPN', 107, 0, 1, 1, 0, 1376646224, 0, 1376648201, 0),
(108, 0, 0, 'Republic of Kenia', 'Kenya', 'Kenya', 'Kenia', 'KE', 'KEN', 108, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(109, 0, 0, 'Kyrgyzstan', 'Кыргызстан', 'Kyrgyzstan', 'Kirgisistan', 'KG', 'KGZ', 109, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(110, 0, 0, 'Kingdom of Cambodia', 'Kâmpŭchea', 'Cambodia', 'Kambodscha', 'KH', 'KHM', 110, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(111, 0, 0, 'Republic of Kiribati', 'Kiribati', 'Kiribati', 'Kiribati', 'KI', 'KIR', 111, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(112, 0, 0, 'Union of the Comoros', 'اتحاد القمر', 'Comoros', 'Komoren', 'KM', 'COM', 112, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(113, 0, 0, 'Federation of Saint Kitts and Nevis', 'Saint Kitts and Nevis', 'Saint Kitts and Nevis', 'Saint Kitts und Nevis', 'KN', 'KNA', 113, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(114, 0, 0, 'Democratic People’s Republic of Korea', '북조선', 'North Korea', 'Korea (Nord)', 'KP', 'PRK', 114, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(115, 0, 0, 'Republic of Korea', '한국', 'South Korea', 'Korea (Süd)', 'KR', 'KOR', 115, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(116, 0, 0, 'State of Kuweit', 'الكويت', 'Kuwait', 'Kuwait', 'KW', 'KWT', 116, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(117, 0, 0, 'Cayman Islands', 'Cayman Islands', 'Cayman Islands', 'Kaimaninseln', 'KY', 'CYM', 117, 0, 0, 1, 0, 1376646224, 0, 1376648198, 0),
(118, 0, 0, 'Republic of Kazakhstan', 'Қазақстан /Казахстан', 'Kazakhstan', 'Kasachstan', 'KZ', 'KAZ', 118, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(119, 0, 0, 'Lao People’s Democratic Republic', 'ເມືອງລາວ', 'Laos', 'Laos', 'LA', 'LAO', 119, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(120, 0, 0, 'Republic of Lebanon', 'لبنان', 'Lebanon', 'Libanon', 'LB', 'LBN', 120, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(121, 0, 0, 'Saint Lucia', 'Saint Lucia', 'Saint Lucia', 'Saint Lucia', 'LC', 'LCA', 121, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(122, 0, 0, 'Principality of Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'LI', 'LIE', 122, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(123, 0, 0, 'Democratic Socialist Republic of Sri Lanka', 'ශ්‍රී ලංකා / இலங்கை', 'Sri Lanka', 'Sri Lanka', 'LK', 'LKA', 123, 0, 1, 1, 0, 1376646224, 0, 1376648201, 0),
(124, 0, 0, 'Republic of Liberia', 'Liberia', 'Liberia', 'Liberia', 'LR', 'LBR', 124, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(125, 0, 0, 'Kingdon of Lesotho', 'Lesotho', 'Lesotho', 'Lesotho', 'LS', 'LSO', 125, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(126, 0, 0, 'Republic of Lithuania', 'Lietuva', 'Lithuania', 'Litauen', 'LT', 'LTU', 126, 1, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(127, 0, 0, 'Grand Duchy of Luxembourg', 'Luxemburg', 'Luxembourg', 'Luxemburg', 'LU', 'LUX', 127, 1, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(128, 0, 0, 'Republic of Latvia', 'Latvija', 'Latvia', 'Lettland', 'LV', 'LVA', 128, 1, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(129, 0, 0, 'Great Socialist People’s Libyan Arab Jamahiriya', 'الليبية', 'Libya', 'Libyen', 'LY', 'LBY', 129, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(130, 0, 0, 'Kingdom of Morocco', 'المغربية', 'Morocco', 'Marokko', 'MA', 'MAR', 130, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(131, 0, 0, 'Principality of Monaco', 'Monaco', 'Monaco', 'Monaco', 'MC', 'MCO', 131, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(132, 0, 0, 'Republic of Moldova', 'Moldova', 'Moldova', 'Moldau', 'MD', 'MDA', 132, 0, 1, 1, 0, 1376646224, 0, 1376648201, 0),
(133, 0, 0, 'Republic of Madagascar', 'Madagascar', 'Madagascar', 'Madagaskar', 'MG', 'MDG', 133, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(134, 0, 0, 'Republic of the Marshall Islands', 'Marshall Islands', 'Marshall Islands', 'Marshallinseln', 'MH', 'MHL', 134, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(135, 0, 0, 'Republic of Macedonia', 'Македонија', 'Macedonia', 'Mazedonien', 'MK', 'MKD', 135, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(136, 0, 0, 'Republik Mali', 'Mali', 'Mali', 'Mali', 'ML', 'MLI', 136, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(137, 0, 0, 'Union of Myanmar', 'Myanmar', 'Myanmar', 'Myanmar', 'MM', 'MMR', 137, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(138, 0, 0, 'Mongolia', 'Монгол Улс', 'Mongolia', 'Mongolei', 'MN', 'MNG', 138, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(139, 0, 0, 'Macao SAR of the People’s Republic of China', '澳門 / Macau', 'Macao SAR of China', 'Macau', 'MO', 'MAC', 139, 0, 0, 1, 0, 1376646224, 0, 1376648199, 0),
(140, 0, 0, 'Commonwealth of the Northern Mariana Islands', 'Northern Marianas', 'Northern Marianas', 'Nördliche Marianen', 'MP', 'MNP', 140, 0, 0, 1, 0, 1376646224, 0, 1376648200, 0),
(141, 0, 0, 'Department of Martinique', 'Martinique', 'Martinique', 'Martinique', 'MQ', 'MTQ', 141, 0, 0, 1, 0, 1376646224, 0, 1376648199, 0),
(142, 0, 0, 'Islamic Republic of Mauritania', 'الموريتانية', 'Mauritania', 'Mauretanien', 'MR', 'MRT', 142, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(143, 0, 0, 'Montserrat', 'Montserrat', 'Montserrat', 'Montserrat', 'MS', 'MSR', 143, 0, 0, 1, 0, 1376646224, 0, 1376648199, 0),
(144, 0, 0, 'Republic of Malta', 'Malta', 'Malta', 'Malta', 'MT', 'MLT', 144, 1, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(145, 0, 0, 'Republic of Mauritius', 'Mauritius', 'Mauritius', 'Mauritius', 'MU', 'MUS', 145, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(146, 0, 0, 'Republic of Maldives', 'ޖުމުހޫރިއްޔ', 'Maldives', 'Malediven', 'MV', 'MDV', 146, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(147, 0, 0, 'Republic of Malawi', 'Malawi', 'Malawi', 'Malawi', 'MW', 'MWI', 147, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(148, 0, 0, 'United Mexican States', 'México', 'Mexico', 'Mexiko', 'MX', 'MEX', 148, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(149, 0, 0, 'Malaysia', 'مليسيا', 'Malaysia', 'Malaysia', 'MY', 'MYS', 149, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(150, 0, 0, 'Republic of Mozambique', 'Moçambique', 'Mozambique', 'Mosambik', 'MZ', 'MOZ', 150, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(151, 0, 0, 'Republic of Namibia', 'Namibia', 'Namibia', 'Namibia', 'NA', 'NAM', 151, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(152, 0, 0, 'Territory of New Caledonia', 'Nouvelle-Calédonie', 'New Caledonia', 'Neukaledonien', 'NC', 'NCL', 152, 0, 0, 1, 0, 1376646224, 0, 1376648199, 0),
(153, 0, 0, 'Republic of Niger', 'Niger', 'Niger', 'Niger', 'NE', 'NER', 153, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(154, 0, 0, 'Territory of Norfolk Island', 'Norfolk Island', 'Norfolk Island', 'Norfolkinseln', 'NF', 'NFK', 154, 0, 0, 1, 0, 1376646224, 0, 1376648200, 0),
(155, 0, 0, 'Federal Republic of Nigeria', 'Nigeria', 'Nigeria', 'Nigeria', 'NG', 'NGA', 155, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(156, 0, 0, 'Republic of Nicaragua', 'Nicaragua', 'Nicaragua', 'Nicaragua', 'NI', 'NIC', 156, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(157, 0, 0, 'Kingdom of the Netherlands', 'Nederland', 'Netherlands', 'Niederlande', 'NL', 'NLD', 157, 1, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(158, 0, 0, 'Kingdom of Norway', 'Norge', 'Norway', 'Norwegen', 'NO', 'NOR', 158, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(159, 0, 0, 'Federal Democratic Republic of Nepal', 'नेपाल', 'Nepal', 'Nepal', 'NP', 'NPL', 159, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(160, 0, 0, 'Republic of Nauru', 'Naoero', 'Nauru', 'Nauru', 'NR', 'NRU', 160, 0, 1, 1, 0, 1376646224, 0, 1376648199, 0),
(161, 0, 0, 'Niue', 'Niue', 'Niue', 'Niue', 'NU', 'NIU', 161, 0, 0, 1, 0, 1376646224, 0, 1376648200, 0),
(162, 0, 0, 'New Zealand', 'New Zealand / Aotearoa', 'New Zealand', 'Neuseeland', 'NZ', 'NZL', 162, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(163, 0, 0, 'Sultanate of Oman', 'عُمان', 'Oman', 'Oman', 'OM', 'OMN', 163, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(164, 0, 0, 'Repulic of Panama', 'Panamá', 'Panama', 'Panama', 'PA', 'PAN', 164, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(165, 0, 0, 'Republic of Peru', 'Perú', 'Peru', 'Peru', 'PE', 'PER', 165, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(166, 0, 0, 'French Polynesia', 'Polynésie française', 'French Polynesia', 'Französisch-Polynesien', 'PF', 'PYF', 166, 0, 0, 1, 0, 1376646224, 0, 1376648201, 0),
(167, 0, 0, 'Independent State of Papua New Guinea', 'Papua New Guinea  / Papua Niugini', 'Papua New Guinea', 'Papua-Neuguinea', 'PG', 'PNG', 167, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(168, 0, 0, 'Republic of the Philippines', 'Philippines', 'Philippines', 'Philippinen', 'PH', 'PHL', 168, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(169, 0, 0, 'Islamic Republic of Pakistan', 'پاکستان', 'Pakistan', 'Pakistan', 'PK', 'PAK', 169, 0, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(170, 0, 0, 'Republic of Poland', 'Polska', 'Poland', 'Polen', 'PL', 'POL', 170, 1, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(171, 0, 0, 'Saint Pierre and Miquelon', 'Saint-Pierre-et-Miquelon', 'Saint Pierre and Miquelon', 'Saint Pierre und Miquelon', 'PM', 'SPM', 171, 0, 0, 1, 0, 1376646224, 0, 1376648200, 0),
(172, 0, 0, 'Pitcairn Islands', 'Pitcairn Islands', 'Pitcairn Islands', 'Pitcairninseln', 'PN', 'PCN', 172, 0, 0, 1, 0, 1376646224, 0, 1376648200, 0),
(173, 0, 0, 'Commonwealth of Puerto Rico', 'Puerto Rico', 'Puerto Rico', 'Puerto Rico', 'PR', 'PRI', 173, 0, 0, 1, 0, 1376646224, 0, 1376648200, 0),
(174, 0, 0, 'Portuguese Republic', 'Portugal', 'Portugal', 'Portugal', 'PT', 'PRT', 174, 1, 1, 1, 0, 1376646224, 0, 1376648200, 0),
(175, 0, 0, 'Republic of Palau', 'Belau / Palau', 'Palau', 'Palau', 'PW', 'PLW', 175, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(176, 0, 0, 'Republic of Paraguay', 'Paraguay', 'Paraguay', 'Paraguay', 'PY', 'PRY', 176, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(177, 0, 0, 'State of Qatar', 'قطر', 'Qatar', 'Katar', 'QA', 'QAT', 177, 0, 1, 1, 0, 1376646225, 0, 1376648199, 0),
(178, 0, 0, 'Department of Réunion', 'Réunion', 'Reunion', 'Réunion', 'RE', 'REU', 178, 0, 0, 1, 0, 1376646225, 0, 1376648200, 0),
(179, 0, 0, 'Romania', 'România', 'Romania', 'Rumänien', 'RO', 'ROU', 179, 1, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(180, 0, 0, 'Russian Federation', 'Росси́я', 'Russia', 'Russland', 'RU', 'RUS', 180, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(181, 0, 0, 'Republic of Rwanda', 'Rwanda', 'Rwanda', 'Ruanda', 'RW', 'RWA', 181, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(182, 0, 0, 'Kingdom of Saudi Arabia', 'السعودية', 'Saudi Arabia', 'Saudi-Arabien', 'SA', 'SAU', 182, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(183, 0, 0, 'Solomon Islands', 'Solomon Islands', 'Solomon Islands', 'Salomonen', 'SB', 'SLB', 183, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(184, 0, 0, 'Republic of Seychelles', 'Seychelles', 'Seychelles', 'Seychellen', 'SC', 'SYC', 184, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(185, 0, 0, 'Republic of the Sudan', 'السودان', 'Sudan', 'Sudan', 'SD', 'SDN', 185, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(186, 0, 0, 'Kingdom of Sweden', 'Sverige', 'Sweden', 'Schweden', 'SE', 'SWE', 186, 1, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(187, 0, 0, 'Republic of Singapore', 'Singapore', 'Singapore', 'Singapur', 'SG', 'SGP', 187, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(188, 0, 0, 'Saint Helena, Ascension and Tristan da Cunha', 'Saint Helena, Ascension and Tristan da Cunha', 'Saint Helena, Ascension and Tristan da Cunha', 'Saint Helena', 'SH', 'SHN', 188, 0, 0, 1, 0, 1376646225, 0, 1376648200, 0),
(189, 0, 0, 'Republic of Slovenia', 'Slovenija', 'Slovenia', 'Slowenien', 'SI', 'SVN', 189, 1, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(190, 0, 0, 'Svalbard', 'Svalbard', 'Svalbard', 'Svalbard und Jan Mayen', 'SJ', 'SJM', 190, 0, 0, 1, 0, 1376646225, 0, 1376648201, 0),
(191, 0, 0, 'Slovak Republic', 'Slovensko', 'Slovakia', 'Slowakei', 'SK', 'SVK', 191, 1, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(192, 0, 0, 'Republic of Sierra Leone', 'Sierra Leone', 'Sierra Leone', 'Sierra Leone', 'SL', 'SLE', 192, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(193, 0, 0, 'Most Serene Republic of San Marino', 'San Marino', 'San Marino', 'San Marino', 'SM', 'SMR', 193, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(194, 0, 0, 'Republic of Senegal', 'Sénégal', 'Senegal', 'Senegal', 'SN', 'SEN', 194, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(195, 0, 0, 'Somalia', 'Soomaaliya', 'Somalia', 'Somaliland', 'SO', 'SOM', 195, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(196, 0, 0, 'Republic of Surinam', 'Suriname', 'Suriname', 'Suriname', 'SR', 'SUR', 196, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(197, 0, 0, 'Democratic Republic of São Tomé e Príncipe', 'São Tomé e Príncipe', 'São Tomé e Príncipe', 'São Tomé und Princípe', 'ST', 'STP', 197, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(198, 0, 0, 'Republic of El Salvador', 'El Salvador', 'El Salvador', 'El Salvador', 'SV', 'SLV', 198, 0, 1, 1, 0, 1376646225, 0, 1376648198, 0),
(199, 0, 0, 'Syrian Arab Republic', 'سوري', 'Syria', 'Syrien', 'SY', 'SYR', 199, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(200, 0, 0, 'Kingdom of Swaziland', 'weSwatini', 'Swaziland', 'Swasiland', 'SZ', 'SWZ', 200, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(201, 0, 0, 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'Turks- und Caicosinseln', 'TC', 'TCA', 201, 0, 0, 1, 0, 1376646225, 0, 1376648201, 0),
(202, 0, 0, 'Republic of Chad', 'تشاد / Tchad', 'Chad', 'Tschad', 'TD', 'TCD', 202, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(203, 0, 0, 'French Southern Territories', 'Terres australes françaises', 'French Southern Territories', 'Tromelin', 'TF', 'ATF', 203, 0, 0, 1, 0, 1376646225, 0, 1376648201, 0),
(204, 0, 0, 'Republic of Togo', 'Togo', 'Togo', 'Togo', 'TG', 'TGO', 204, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(205, 0, 0, 'Kingdom of Thailand', 'ไทย', 'Thailand', 'Thailand', 'TH', 'THA', 205, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(206, 0, 0, 'Republic of Tajikistan', 'Тоҷикистон', 'Tajikistan', 'Tadschikistan', 'TJ', 'TJK', 206, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(207, 0, 0, 'Tokelau', 'Tokelau', 'Tokelau', 'Tokelau', 'TK', 'TKL', 207, 0, 0, 1, 0, 1376646225, 0, 1376648201, 0),
(208, 0, 0, 'Republic of Turkmenistan', 'Türkmenistan', 'Turkmenistan', 'Turkmenistan', 'TM', 'TKM', 208, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(209, 0, 0, 'Republic of Tunisia', 'التونسية', 'Tunisia', 'Tunesien', 'TN', 'TUN', 209, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(210, 0, 0, 'Kingdom of Tonga', 'Tonga', 'Tonga', 'Tonga', 'TO', 'TON', 210, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(211, 0, 0, 'Democratic Republic of Timor-Leste', 'Timor Lorosa''e', 'Timor-Leste', 'Timor-Leste', 'TL', 'TLS', 211, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(212, 0, 0, 'Republic of Turkey', 'Türkiye', 'Turkey', 'Türkei', 'TR', 'TUR', 212, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(213, 0, 0, 'Republic of Trinidad and Tobago', 'Trinidad and Tobago', 'Trinidad and Tobago', 'Trinidad und Tobago', 'TT', 'TTO', 213, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(214, 0, 0, 'Tuvalu', 'Tuvalu', 'Tuvalu', 'Tuvalu', 'TV', 'TUV', 214, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(215, 0, 0, 'Republic of China', '中華', 'Taiwan', 'Taiwan', 'TW', 'TWN', 215, 0, 0, 1, 0, 1376646225, 0, 1376648201, 0),
(216, 0, 0, 'United Republic of Tanzania', 'Tanzania', 'Tanzania', 'Tansania', 'TZ', 'TZA', 216, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(217, 0, 0, 'Ukraine', 'Україна', 'Ukraine', 'Ukraine', 'UA', 'UKR', 217, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(218, 0, 0, 'Republic of Uganda', 'Uganda', 'Uganda', 'Uganda', 'UG', 'UGA', 218, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(219, 0, 0, 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'Amerikanisch-Ozeanien', 'UM', 'UMI', 219, 0, 0, 1, 0, 1376646225, 0, 1376648201, 0),
(220, 0, 0, 'United States of America', 'United States', 'United States', 'Vereinigte Staaten von Amerika', 'US', 'USA', 220, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(221, 0, 0, 'Eastern Republic of Uruguay', 'Uruguay', 'Uruguay', 'Uruguay', 'UY', 'URY', 221, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(222, 0, 0, 'Republic of Uzbekistan', 'O‘zbekiston', 'Uzbekistan', 'Usbekistan', 'UZ', 'UZB', 222, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(223, 0, 0, 'Vatican City', 'Vaticano', 'Vatican City', 'Vatikan', 'VA', 'VAT', 223, 0, 0, 1, 0, 1376646225, 0, 1376648201, 0),
(224, 0, 0, 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'Saint Vincent und die Grenadinen', 'VC', 'VCT', 224, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(225, 0, 0, 'Bolivarian Republic of Venezuela', 'Venezuela', 'Venezuela', 'Venezuela', 'VE', 'VEN', 225, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(226, 0, 0, 'British Virgin Islands', 'British Virgin Islands', 'British Virgin Islands', 'Britische Jungferninseln', 'VG', 'VGB', 226, 0, 0, 1, 0, 1376646225, 0, 1376648197, 0),
(227, 0, 0, 'United States Virgin Islands', 'US Virgin Islands', 'US Virgin Islands', 'Amerikanische Jungferninseln', 'VI', 'VIR', 227, 0, 0, 1, 0, 1376646225, 0, 1376648197, 0),
(228, 0, 0, 'Socialist Republic of Vietnam', 'Việt Nam', 'Vietnam', 'Vietnam', 'VN', 'VNM', 228, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(229, 0, 0, 'Republic of Vanuatu', 'Vanuatu', 'Vanuatu', 'Vanuatu', 'VU', 'VUT', 229, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(230, 0, 0, 'Territory of Wallis and Futuna Islands', 'Wallis and Futuna', 'Wallis and Futuna', 'Wallis und Futuna', 'WF', 'WLF', 230, 0, 0, 1, 0, 1376646225, 0, 1376648201, 0),
(231, 0, 0, 'Independent State of Samoa', 'Samoa', 'Samoa', 'Samoa', 'WS', 'WSM', 231, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(232, 0, 0, 'Republic of Yemen', 'اليمنية', 'Yemen', 'Jemen', 'YE', 'YEM', 232, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(233, 0, 0, 'Mayotte', 'Mayotte', 'Mayotte', 'Mayotte', 'YT', 'MYT', 233, 0, 0, 1, 0, 1376646225, 0, 1376648199, 0),
(234, 0, 0, 'Republic of South Africa', 'Afrika-Borwa', 'South Africa', 'Südafrika', 'ZA', 'ZAF', 234, 0, 1, 1, 0, 1376646225, 0, 1376648201, 0),
(235, 0, 0, 'Republic of Zambia', 'Zambia', 'Zambia', 'Sambia', 'ZM', 'ZMB', 235, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(236, 0, 0, 'Republic of Zimbabwe', 'Zimbabwe', 'Zimbabwe', 'Simbabwe', 'ZW', 'ZWE', 236, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(237, 0, 0, 'Palestinian territories', 'فلسطين', 'Palestine', 'Westjordanland', 'PS', 'PSE', 237, 0, 0, 1, 0, 1376646225, 0, 1376648201, 0),
(238, 0, 0, 'State Union of Serbia and Montenegro', 'Србија и Црна Гора', 'Serbia and Montenegro', 'Tschechoslowakei', 'CS', 'CSG', 238, 0, 1, 1, 0, 1376646225, 0, 1376647349, 0),
(239, 0, 0, 'Åland Islands', 'Landskapet Åland', 'Åland Islands', 'Ålandinseln', 'AX', 'ALA', 239, 1, 0, 1, 0, 1376646225, 0, 1376648197, 0),
(240, 0, 0, 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'McDonaldinseln', 'HM', 'HMD', 240, 0, 0, 1, 0, 1376646225, 0, 1376648199, 0),
(241, 0, 0, 'Montenegro', 'Crna Gora', 'Montenegro', 'Montenegro ', 'ME', 'MNE', 241, 0, 1, 1, 0, 1376646225, 0, 1376648199, 0),
(242, 0, 0, 'Republic of Serbia', 'Srbija', 'Serbia', 'Serbien ', 'RS', 'SRB', 242, 0, 1, 1, 0, 1376646225, 0, 1376648200, 0),
(243, 0, 0, 'Bailiwick of Jersey', 'Jersey', 'Jersey', 'Jersey', 'JE', 'JEY', 243, 0, 0, 1, 0, 1376646225, 0, 1376648198, 0),
(244, 0, 0, 'Bailiwick of Guernsey', 'Guernsey', 'Guernsey', 'Guernsey', 'GG', 'GGY', 244, 0, 0, 1, 0, 1376646225, 0, 1376648200, 0),
(245, 0, 0, 'Isle of Man', 'Mann / Mannin', 'Isle of Man', 'Isle of Man', 'IM', 'IMN', 245, 0, 0, 1, 0, 1376646225, 0, 1376648198, 0),
(246, 0, 0, 'Collectivity of Saint Martin', 'Saint-Martin', 'Saint Martin', 'Saint Martin', 'MF', 'MAF', 246, 0, 0, 1, 0, 1376646225, 0, 1376648200, 0),
(247, 0, 0, 'Collectivity of Saint Barthélemy', 'Saint-Barthélemy', 'Saint Barthélemy', 'Saint Barthélemy', 'BL', 'BLM', 247, 0, 0, 1, 0, 1376646225, 0, 1376648200, 0),
(248, 0, 0, 'Bonaire, Saint Eustatius and Saba', 'Bonaire, Sint Eustatius en Saba', 'Bonaire, Saint Eustatius and Saba', 'Bonaire', 'BQ', 'BES', 248, 0, 0, 1, 0, 1376646225, 0, 1376648197, 0),
(249, 0, 0, 'Curaçao', 'Curaçao', 'Curaçao', 'Curaçao', 'CW', 'CUW', 249, 0, 0, 1, 0, 1376646225, 0, 1376648198, 0),
(250, 0, 0, 'Sint Maarten', 'Sint Maarten', 'Sint Maarten', 'Sint Maarten ', 'SX', 'SXM', 250, 0, 0, 1, 0, 1376646225, 0, 1376648200, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `iso_code` varchar(10) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `status` tinyint(3) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `iso_code`, `symbol`, `status`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'EURO', 'EUR', '€', 1, 0, NULL, 0, NULL, 0),
(2, 'Dollar', 'USD', '$', 0, 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL,
  `api_key_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `limit` int(10) unsigned DEFAULT '0',
  `uuid` varchar(255) DEFAULT NULL,
  `is_disabled` tinyint(3) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=228290 ;

--
-- Daten für Tabelle `devices`
--

INSERT INTO `devices` (`id`, `account_id`, `api_key_id`, `name`, `limit`, `uuid`, `is_disabled`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(228289, 127350, 1, 'iPhone attentra', 0, NULL, 0, 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fees`
--

CREATE TABLE IF NOT EXISTS `fees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fee_group_id` int(10) unsigned NOT NULL,
  `region_id` int(10) unsigned NOT NULL,
  `channel_id` int(10) unsigned NOT NULL,
  `currency_id` smallint(5) unsigned NOT NULL,
  `from` int(11) unsigned DEFAULT '0',
  `to` int(11) unsigned DEFAULT '0',
  `percent` int(11) unsigned DEFAULT '0',
  `amount` int(11) unsigned DEFAULT '0',
  `minimum_charge` int(11) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `fees`
--

INSERT INTO `fees` (`id`, `fee_group_id`, `region_id`, `channel_id`, `currency_id`, `from`, `to`, `percent`, `amount`, `minimum_charge`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 1, 1, 1, 1, 0, 4294967295, 120, 3500, 3500, 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fee_groups`
--

CREATE TABLE IF NOT EXISTS `fee_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_default` tinyint(3) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `fee_groups`
--

INSERT INTO `fee_groups` (`id`, `country_id`, `name`, `description`, `is_default`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 54, 'Standard', 'Die Allgemeine FeeGroup', 1, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `iso_code` varchar(255) NOT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `languages`
--

INSERT INTO `languages` (`id`, `name`, `iso_code`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'Deutsch', 'de', 0, 1375706156, 0, 1375706156, 0),
(2, 'English', 'en', 0, 1375706156, 0, 1375706156, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `paymey_accounts`
--

CREATE TABLE IF NOT EXISTS `paymey_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `stat_name` varchar(255) DEFAULT NULL,
  `stat_name_ext` varchar(255) DEFAULT NULL,
  `balance` int(11) DEFAULT '0',
  `currency_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned DEFAULT '0',
  `activation_attempts` smallint(5) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=179849 ;

--
-- Daten für Tabelle `paymey_accounts`
--

INSERT INTO `paymey_accounts` (`id`, `account_id`, `name`, `stat_name`, `stat_name_ext`, `balance`, `currency_id`, `status`, `activation_attempts`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(179846, 127350, 'Hans Wurscht', 'Hans Wurscht', NULL, 0, 1, 2, 0, 0, 1382622074, NULL, 1382622074, NULL),
(179847, 127351, 'Florian Walter', 'Florian Walter', NULL, 0, 1, 2, 0, 0, 1382622074, NULL, 1382622074, NULL),
(179848, 127352, 'Christian Vollrath', 'PAYMEY GmbH', NULL, 0, 1, 2, 0, 0, 1382622074, NULL, 1382622074, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_default` tinyint(3) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `regions`
--

INSERT INTO `regions` (`id`, `name`, `is_default`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'Europa', 1, 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1377611699),
('m130827_154600_bankAccountCountryId', 1377611733),
('m130827_174600_hashRename', 1377618275),
('m130829_150000_zendeskUserId', 1377779839),
('m130902_070000_fee', 1378300091),
('m130902_103000_timezone', 1378300095),
('m130903_150000_channels', 1378300097),
('m130904_153107_user_add_login_attempts', 1378475719),
('m130906_160000_bankAccountType', 1378485287),
('m130906_190000_phonepin', 1378903280),
('m130911_140000_business', 1378906788),
('m130916_101643_user_add_locked_until', 1379331596),
('m130916_154800_affiliate', 1379339808),
('m130916_171200_payonChannels', 1379344850),
('m130917_123000_date_of_birth', 1379414095),
('m130917_150000_payonChannelsRename', 1379422694),
('m130917_173000_payonRedirectUrl', 1379431950),
('m130918_160000_accountStatus', 1379514140),
('m130923_161207_add_api_keys_password', 1382611991),
('m130927_160000_userEmail', 1382611993),
('m130927_180000_timezone', 1382611995),
('m131023_134904_transaction_requests', 1382611998),
('m131024_143804_paymey_account', 1382622074),
('m131024_161904_paymey_bank_account', 1382705658),
('m131025_102146_paymey_account_names', 1383065236),
('m131025_103013_transaction_requests_add_is_deleted', 1383065243),
('m131029_173000_user_account', 1383065410),
('m131113_160000_transactionPayonId', 1384358740),
('m131113_170000_balanceTransactions', 1384360104),
('m131115_170000_transactionTypes', 1384531114),
('m131115_180000_transactionStatus', 1384535627),
('m131128_190000_fee_minimum_charge', 1385661861),
('m131129_170000_promotionTransactionType', 1385747031),
('m131129_173000_autoincrement_values', 1385748610),
('m131129_190000_short_id', 1385748854),
('m131209_190000_creditTransactionType', 1386612652),
('m131210_150000_balanceTransactionId', 1386683812),
('m140124_105644_change_phone_pin', 1390652649),
('m140131_173000_microdepositFailures', 1395063462),
('m140210_180000_adminUser', 1392735330),
('m140313_150000_userTmpEmail', 1395063466);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `timezones`
--

CREATE TABLE IF NOT EXISTS `timezones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_code` char(2) NOT NULL,
  `zone_name` varchar(35) NOT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=418 ;

--
-- Daten für Tabelle `timezones`
--

INSERT INTO `timezones` (`id`, `country_code`, `zone_name`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'AD', 'Europe/Andorra', 0, 1378111967, NULL, 1378111967, NULL),
(2, 'AE', 'Asia/Dubai', 0, 1378111967, NULL, 1378111967, NULL),
(3, 'AF', 'Asia/Kabul', 0, 1378111967, NULL, 1378111967, NULL),
(4, 'AG', 'America/Antigua', 0, 1378111967, NULL, 1378111967, NULL),
(5, 'AI', 'America/Anguilla', 0, 1378111967, NULL, 1378111967, NULL),
(6, 'AL', 'Europe/Tirane', 0, 1378111967, NULL, 1378111967, NULL),
(7, 'AM', 'Asia/Yerevan', 0, 1378111967, NULL, 1378111967, NULL),
(8, 'AO', 'Africa/Luanda', 0, 1378111967, NULL, 1378111967, NULL),
(9, 'AQ', 'Antarctica/McMurdo', 0, 1378111967, NULL, 1378111967, NULL),
(10, 'AQ', 'Antarctica/South_Pole', 0, 1378111967, NULL, 1378111967, NULL),
(11, 'AQ', 'Antarctica/Rothera', 0, 1378111967, NULL, 1378111967, NULL),
(12, 'AQ', 'Antarctica/Palmer', 0, 1378111967, NULL, 1378111967, NULL),
(13, 'AQ', 'Antarctica/Mawson', 0, 1378111967, NULL, 1378111967, NULL),
(14, 'AQ', 'Antarctica/Davis', 0, 1378111967, NULL, 1378111967, NULL),
(15, 'AQ', 'Antarctica/Casey', 0, 1378111967, NULL, 1378111967, NULL),
(16, 'AQ', 'Antarctica/Vostok', 0, 1378111967, NULL, 1378111967, NULL),
(17, 'AQ', 'Antarctica/DumontDUrville', 0, 1378111967, NULL, 1378111967, NULL),
(18, 'AQ', 'Antarctica/Syowa', 0, 1378111967, NULL, 1378111967, NULL),
(19, 'AR', 'America/Argentina/Buenos_Aires', 0, 1378111967, NULL, 1378111967, NULL),
(20, 'AR', 'America/Argentina/Cordoba', 0, 1378111967, NULL, 1378111967, NULL),
(21, 'AR', 'America/Argentina/Salta', 0, 1378111967, NULL, 1378111967, NULL),
(22, 'AR', 'America/Argentina/Jujuy', 0, 1378111967, NULL, 1378111967, NULL),
(23, 'AR', 'America/Argentina/Tucuman', 0, 1378111967, NULL, 1378111967, NULL),
(24, 'AR', 'America/Argentina/Catamarca', 0, 1378111967, NULL, 1378111967, NULL),
(25, 'AR', 'America/Argentina/La_Rioja', 0, 1378111967, NULL, 1378111967, NULL),
(26, 'AR', 'America/Argentina/San_Juan', 0, 1378111967, NULL, 1378111967, NULL),
(27, 'AR', 'America/Argentina/Mendoza', 0, 1378111967, NULL, 1378111967, NULL),
(28, 'AR', 'America/Argentina/San_Luis', 0, 1378111967, NULL, 1378111967, NULL),
(29, 'AR', 'America/Argentina/Rio_Gallegos', 0, 1378111967, NULL, 1378111967, NULL),
(30, 'AR', 'America/Argentina/Ushuaia', 0, 1378111967, NULL, 1378111967, NULL),
(31, 'AS', 'Pacific/Pago_Pago', 0, 1378111967, NULL, 1378111967, NULL),
(32, 'AT', 'Europe/Vienna', 0, 1378111967, NULL, 1378111967, NULL),
(33, 'AU', 'Australia/Lord_Howe', 0, 1378111967, NULL, 1378111967, NULL),
(34, 'AU', 'Antarctica/Macquarie', 0, 1378111967, NULL, 1378111967, NULL),
(35, 'AU', 'Australia/Hobart', 0, 1378111967, NULL, 1378111967, NULL),
(36, 'AU', 'Australia/Currie', 0, 1378111967, NULL, 1378111967, NULL),
(37, 'AU', 'Australia/Melbourne', 0, 1378111967, NULL, 1378111967, NULL),
(38, 'AU', 'Australia/Sydney', 0, 1378111967, NULL, 1378111967, NULL),
(39, 'AU', 'Australia/Broken_Hill', 0, 1378111967, NULL, 1378111967, NULL),
(40, 'AU', 'Australia/Brisbane', 0, 1378111967, NULL, 1378111967, NULL),
(41, 'AU', 'Australia/Lindeman', 0, 1378111967, NULL, 1378111967, NULL),
(42, 'AU', 'Australia/Adelaide', 0, 1378111967, NULL, 1378111967, NULL),
(43, 'AU', 'Australia/Darwin', 0, 1378111967, NULL, 1378111967, NULL),
(44, 'AU', 'Australia/Perth', 0, 1378111967, NULL, 1378111967, NULL),
(45, 'AU', 'Australia/Eucla', 0, 1378111967, NULL, 1378111967, NULL),
(46, 'AW', 'America/Aruba', 0, 1378111967, NULL, 1378111967, NULL),
(47, 'AX', 'Europe/Mariehamn', 0, 1378111967, NULL, 1378111967, NULL),
(48, 'AZ', 'Asia/Baku', 0, 1378111967, NULL, 1378111967, NULL),
(49, 'BA', 'Europe/Sarajevo', 0, 1378111967, NULL, 1378111967, NULL),
(50, 'BB', 'America/Barbados', 0, 1378111967, NULL, 1378111967, NULL),
(51, 'BD', 'Asia/Dhaka', 0, 1378111967, NULL, 1378111967, NULL),
(52, 'BE', 'Europe/Brussels', 0, 1378111967, NULL, 1378111967, NULL),
(53, 'BF', 'Africa/Ouagadougou', 0, 1378111967, NULL, 1378111967, NULL),
(54, 'BG', 'Europe/Sofia', 0, 1378111967, NULL, 1378111967, NULL),
(55, 'BH', 'Asia/Bahrain', 0, 1378111967, NULL, 1378111967, NULL),
(56, 'BI', 'Africa/Bujumbura', 0, 1378111967, NULL, 1378111967, NULL),
(57, 'BJ', 'Africa/Porto-Novo', 0, 1378111967, NULL, 1378111967, NULL),
(58, 'BL', 'America/St_Barthelemy', 0, 1378111967, NULL, 1378111967, NULL),
(59, 'BM', 'Atlantic/Bermuda', 0, 1378111967, NULL, 1378111967, NULL),
(60, 'BN', 'Asia/Brunei', 0, 1378111967, NULL, 1378111967, NULL),
(61, 'BO', 'America/La_Paz', 0, 1378111967, NULL, 1378111967, NULL),
(62, 'BQ', 'America/Kralendijk', 0, 1378111967, NULL, 1378111967, NULL),
(63, 'BR', 'America/Noronha', 0, 1378111967, NULL, 1378111967, NULL),
(64, 'BR', 'America/Belem', 0, 1378111967, NULL, 1378111967, NULL),
(65, 'BR', 'America/Fortaleza', 0, 1378111967, NULL, 1378111967, NULL),
(66, 'BR', 'America/Recife', 0, 1378111967, NULL, 1378111967, NULL),
(67, 'BR', 'America/Araguaina', 0, 1378111967, NULL, 1378111967, NULL),
(68, 'BR', 'America/Maceio', 0, 1378111967, NULL, 1378111967, NULL),
(69, 'BR', 'America/Bahia', 0, 1378111967, NULL, 1378111967, NULL),
(70, 'BR', 'America/Sao_Paulo', 0, 1378111967, NULL, 1378111967, NULL),
(71, 'BR', 'America/Campo_Grande', 0, 1378111967, NULL, 1378111967, NULL),
(72, 'BR', 'America/Cuiaba', 0, 1378111967, NULL, 1378111967, NULL),
(73, 'BR', 'America/Santarem', 0, 1378111967, NULL, 1378111967, NULL),
(74, 'BR', 'America/Porto_Velho', 0, 1378111967, NULL, 1378111967, NULL),
(75, 'BR', 'America/Boa_Vista', 0, 1378111967, NULL, 1378111967, NULL),
(76, 'BR', 'America/Manaus', 0, 1378111967, NULL, 1378111967, NULL),
(77, 'BR', 'America/Eirunepe', 0, 1378111967, NULL, 1378111967, NULL),
(78, 'BR', 'America/Rio_Branco', 0, 1378111967, NULL, 1378111967, NULL),
(79, 'BS', 'America/Nassau', 0, 1378111967, NULL, 1378111967, NULL),
(80, 'BT', 'Asia/Thimphu', 0, 1378111967, NULL, 1378111967, NULL),
(81, 'BW', 'Africa/Gaborone', 0, 1378111967, NULL, 1378111967, NULL),
(82, 'BY', 'Europe/Minsk', 0, 1378111967, NULL, 1378111967, NULL),
(83, 'BZ', 'America/Belize', 0, 1378111967, NULL, 1378111967, NULL),
(84, 'CA', 'America/St_Johns', 0, 1378111967, NULL, 1378111967, NULL),
(85, 'CA', 'America/Halifax', 0, 1378111967, NULL, 1378111967, NULL),
(86, 'CA', 'America/Glace_Bay', 0, 1378111967, NULL, 1378111967, NULL),
(87, 'CA', 'America/Moncton', 0, 1378111967, NULL, 1378111967, NULL),
(88, 'CA', 'America/Goose_Bay', 0, 1378111967, NULL, 1378111967, NULL),
(89, 'CA', 'America/Blanc-Sablon', 0, 1378111967, NULL, 1378111967, NULL),
(90, 'CA', 'America/Montreal', 0, 1378111967, NULL, 1378111967, NULL),
(91, 'CA', 'America/Toronto', 0, 1378111967, NULL, 1378111967, NULL),
(92, 'CA', 'America/Nipigon', 0, 1378111967, NULL, 1378111967, NULL),
(93, 'CA', 'America/Thunder_Bay', 0, 1378111967, NULL, 1378111967, NULL),
(94, 'CA', 'America/Iqaluit', 0, 1378111967, NULL, 1378111967, NULL),
(95, 'CA', 'America/Pangnirtung', 0, 1378111967, NULL, 1378111967, NULL),
(96, 'CA', 'America/Resolute', 0, 1378111967, NULL, 1378111967, NULL),
(97, 'CA', 'America/Atikokan', 0, 1378111967, NULL, 1378111967, NULL),
(98, 'CA', 'America/Rankin_Inlet', 0, 1378111967, NULL, 1378111967, NULL),
(99, 'CA', 'America/Winnipeg', 0, 1378111967, NULL, 1378111967, NULL),
(100, 'CA', 'America/Rainy_River', 0, 1378111967, NULL, 1378111967, NULL),
(101, 'CA', 'America/Regina', 0, 1378111967, NULL, 1378111967, NULL),
(102, 'CA', 'America/Swift_Current', 0, 1378111967, NULL, 1378111967, NULL),
(103, 'CA', 'America/Edmonton', 0, 1378111967, NULL, 1378111967, NULL),
(104, 'CA', 'America/Cambridge_Bay', 0, 1378111967, NULL, 1378111967, NULL),
(105, 'CA', 'America/Yellowknife', 0, 1378111967, NULL, 1378111967, NULL),
(106, 'CA', 'America/Inuvik', 0, 1378111967, NULL, 1378111967, NULL),
(107, 'CA', 'America/Creston', 0, 1378111967, NULL, 1378111967, NULL),
(108, 'CA', 'America/Dawson_Creek', 0, 1378111967, NULL, 1378111967, NULL),
(109, 'CA', 'America/Vancouver', 0, 1378111967, NULL, 1378111967, NULL),
(110, 'CA', 'America/Whitehorse', 0, 1378111967, NULL, 1378111967, NULL),
(111, 'CA', 'America/Dawson', 0, 1378111967, NULL, 1378111967, NULL),
(112, 'CC', 'Indian/Cocos', 0, 1378111967, NULL, 1378111967, NULL),
(113, 'CD', 'Africa/Kinshasa', 0, 1378111967, NULL, 1378111967, NULL),
(114, 'CD', 'Africa/Lubumbashi', 0, 1378111967, NULL, 1378111967, NULL),
(115, 'CF', 'Africa/Bangui', 0, 1378111967, NULL, 1378111967, NULL),
(116, 'CG', 'Africa/Brazzaville', 0, 1378111967, NULL, 1378111967, NULL),
(117, 'CH', 'Europe/Zurich', 0, 1378111967, NULL, 1378111967, NULL),
(118, 'CI', 'Africa/Abidjan', 0, 1378111967, NULL, 1378111967, NULL),
(119, 'CK', 'Pacific/Rarotonga', 0, 1378111967, NULL, 1378111967, NULL),
(120, 'CL', 'America/Santiago', 0, 1378111967, NULL, 1378111967, NULL),
(121, 'CL', 'Pacific/Easter', 0, 1378111967, NULL, 1378111967, NULL),
(122, 'CM', 'Africa/Douala', 0, 1378111967, NULL, 1378111967, NULL),
(123, 'CN', 'Asia/Shanghai', 0, 1378111967, NULL, 1378111967, NULL),
(124, 'CN', 'Asia/Harbin', 0, 1378111967, NULL, 1378111967, NULL),
(125, 'CN', 'Asia/Chongqing', 0, 1378111967, NULL, 1378111967, NULL),
(126, 'CN', 'Asia/Urumqi', 0, 1378111967, NULL, 1378111967, NULL),
(127, 'CN', 'Asia/Kashgar', 0, 1378111967, NULL, 1378111967, NULL),
(128, 'CO', 'America/Bogota', 0, 1378111967, NULL, 1378111967, NULL),
(129, 'CR', 'America/Costa_Rica', 0, 1378111967, NULL, 1378111967, NULL),
(130, 'CU', 'America/Havana', 0, 1378111967, NULL, 1378111967, NULL),
(131, 'CV', 'Atlantic/Cape_Verde', 0, 1378111967, NULL, 1378111967, NULL),
(132, 'CW', 'America/Curacao', 0, 1378111967, NULL, 1378111967, NULL),
(133, 'CX', 'Indian/Christmas', 0, 1378111967, NULL, 1378111967, NULL),
(134, 'CY', 'Asia/Nicosia', 0, 1378111967, NULL, 1378111967, NULL),
(135, 'CZ', 'Europe/Prague', 0, 1378111967, NULL, 1378111967, NULL),
(136, 'DE', 'Europe/Berlin', 0, 1378111967, NULL, 1378111967, NULL),
(137, 'DE', 'Europe/Busingen', 0, 1378111967, NULL, 1378111967, NULL),
(138, 'DJ', 'Africa/Djibouti', 0, 1378111967, NULL, 1378111967, NULL),
(139, 'DK', 'Europe/Copenhagen', 0, 1378111967, NULL, 1378111967, NULL),
(140, 'DM', 'America/Dominica', 0, 1378111967, NULL, 1378111967, NULL),
(141, 'DO', 'America/Santo_Domingo', 0, 1378111967, NULL, 1378111967, NULL),
(142, 'DZ', 'Africa/Algiers', 0, 1378111967, NULL, 1378111967, NULL),
(143, 'EC', 'America/Guayaquil', 0, 1378111967, NULL, 1378111967, NULL),
(144, 'EC', 'Pacific/Galapagos', 0, 1378111967, NULL, 1378111967, NULL),
(145, 'EE', 'Europe/Tallinn', 0, 1378111967, NULL, 1378111967, NULL),
(146, 'EG', 'Africa/Cairo', 0, 1378111967, NULL, 1378111967, NULL),
(147, 'EH', 'Africa/El_Aaiun', 0, 1378111968, NULL, 1378111968, NULL),
(148, 'ER', 'Africa/Asmara', 0, 1378111968, NULL, 1378111968, NULL),
(149, 'ES', 'Europe/Madrid', 0, 1378111968, NULL, 1378111968, NULL),
(150, 'ES', 'Africa/Ceuta', 0, 1378111968, NULL, 1378111968, NULL),
(151, 'ES', 'Atlantic/Canary', 0, 1378111968, NULL, 1378111968, NULL),
(152, 'ET', 'Africa/Addis_Ababa', 0, 1378111968, NULL, 1378111968, NULL),
(153, 'FI', 'Europe/Helsinki', 0, 1378111968, NULL, 1378111968, NULL),
(154, 'FJ', 'Pacific/Fiji', 0, 1378111968, NULL, 1378111968, NULL),
(155, 'FK', 'Atlantic/Stanley', 0, 1378111968, NULL, 1378111968, NULL),
(156, 'FM', 'Pacific/Chuuk', 0, 1378111968, NULL, 1378111968, NULL),
(157, 'FM', 'Pacific/Pohnpei', 0, 1378111968, NULL, 1378111968, NULL),
(158, 'FM', 'Pacific/Kosrae', 0, 1378111968, NULL, 1378111968, NULL),
(159, 'FO', 'Atlantic/Faroe', 0, 1378111968, NULL, 1378111968, NULL),
(160, 'FR', 'Europe/Paris', 0, 1378111968, NULL, 1378111968, NULL),
(161, 'GA', 'Africa/Libreville', 0, 1378111968, NULL, 1378111968, NULL),
(162, 'GB', 'Europe/London', 0, 1378111968, NULL, 1378111968, NULL),
(163, 'GD', 'America/Grenada', 0, 1378111968, NULL, 1378111968, NULL),
(164, 'GE', 'Asia/Tbilisi', 0, 1378111968, NULL, 1378111968, NULL),
(165, 'GF', 'America/Cayenne', 0, 1378111968, NULL, 1378111968, NULL),
(166, 'GG', 'Europe/Guernsey', 0, 1378111968, NULL, 1378111968, NULL),
(167, 'GH', 'Africa/Accra', 0, 1378111968, NULL, 1378111968, NULL),
(168, 'GI', 'Europe/Gibraltar', 0, 1378111968, NULL, 1378111968, NULL),
(169, 'GL', 'America/Godthab', 0, 1378111968, NULL, 1378111968, NULL),
(170, 'GL', 'America/Danmarkshavn', 0, 1378111968, NULL, 1378111968, NULL),
(171, 'GL', 'America/Scoresbysund', 0, 1378111968, NULL, 1378111968, NULL),
(172, 'GL', 'America/Thule', 0, 1378111968, NULL, 1378111968, NULL),
(173, 'GM', 'Africa/Banjul', 0, 1378111968, NULL, 1378111968, NULL),
(174, 'GN', 'Africa/Conakry', 0, 1378111968, NULL, 1378111968, NULL),
(175, 'GP', 'America/Guadeloupe', 0, 1378111968, NULL, 1378111968, NULL),
(176, 'GQ', 'Africa/Malabo', 0, 1378111968, NULL, 1378111968, NULL),
(177, 'GR', 'Europe/Athens', 0, 1378111968, NULL, 1378111968, NULL),
(178, 'GS', 'Atlantic/South_Georgia', 0, 1378111968, NULL, 1378111968, NULL),
(179, 'GT', 'America/Guatemala', 0, 1378111968, NULL, 1378111968, NULL),
(180, 'GU', 'Pacific/Guam', 0, 1378111968, NULL, 1378111968, NULL),
(181, 'GW', 'Africa/Bissau', 0, 1378111968, NULL, 1378111968, NULL),
(182, 'GY', 'America/Guyana', 0, 1378111968, NULL, 1378111968, NULL),
(183, 'HK', 'Asia/Hong_Kong', 0, 1378111968, NULL, 1378111968, NULL),
(184, 'HN', 'America/Tegucigalpa', 0, 1378111968, NULL, 1378111968, NULL),
(185, 'HR', 'Europe/Zagreb', 0, 1378111968, NULL, 1378111968, NULL),
(186, 'HT', 'America/Port-au-Prince', 0, 1378111968, NULL, 1378111968, NULL),
(187, 'HU', 'Europe/Budapest', 0, 1378111968, NULL, 1378111968, NULL),
(188, 'ID', 'Asia/Jakarta', 0, 1378111968, NULL, 1378111968, NULL),
(189, 'ID', 'Asia/Pontianak', 0, 1378111968, NULL, 1378111968, NULL),
(190, 'ID', 'Asia/Makassar', 0, 1378111968, NULL, 1378111968, NULL),
(191, 'ID', 'Asia/Jayapura', 0, 1378111968, NULL, 1378111968, NULL),
(192, 'IE', 'Europe/Dublin', 0, 1378111968, NULL, 1378111968, NULL),
(193, 'IL', 'Asia/Jerusalem', 0, 1378111968, NULL, 1378111968, NULL),
(194, 'IM', 'Europe/Isle_of_Man', 0, 1378111968, NULL, 1378111968, NULL),
(195, 'IN', 'Asia/Kolkata', 0, 1378111968, NULL, 1378111968, NULL),
(196, 'IO', 'Indian/Chagos', 0, 1378111968, NULL, 1378111968, NULL),
(197, 'IQ', 'Asia/Baghdad', 0, 1378111968, NULL, 1378111968, NULL),
(198, 'IR', 'Asia/Tehran', 0, 1378111968, NULL, 1378111968, NULL),
(199, 'IS', 'Atlantic/Reykjavik', 0, 1378111968, NULL, 1378111968, NULL),
(200, 'IT', 'Europe/Rome', 0, 1378111968, NULL, 1378111968, NULL),
(201, 'JE', 'Europe/Jersey', 0, 1378111968, NULL, 1378111968, NULL),
(202, 'JM', 'America/Jamaica', 0, 1378111968, NULL, 1378111968, NULL),
(203, 'JO', 'Asia/Amman', 0, 1378111968, NULL, 1378111968, NULL),
(204, 'JP', 'Asia/Tokyo', 0, 1378111968, NULL, 1378111968, NULL),
(205, 'KE', 'Africa/Nairobi', 0, 1378111968, NULL, 1378111968, NULL),
(206, 'KG', 'Asia/Bishkek', 0, 1378111968, NULL, 1378111968, NULL),
(207, 'KH', 'Asia/Phnom_Penh', 0, 1378111968, NULL, 1378111968, NULL),
(208, 'KI', 'Pacific/Tarawa', 0, 1378111968, NULL, 1378111968, NULL),
(209, 'KI', 'Pacific/Enderbury', 0, 1378111968, NULL, 1378111968, NULL),
(210, 'KI', 'Pacific/Kiritimati', 0, 1378111968, NULL, 1378111968, NULL),
(211, 'KM', 'Indian/Comoro', 0, 1378111968, NULL, 1378111968, NULL),
(212, 'KN', 'America/St_Kitts', 0, 1378111968, NULL, 1378111968, NULL),
(213, 'KP', 'Asia/Pyongyang', 0, 1378111968, NULL, 1378111968, NULL),
(214, 'KR', 'Asia/Seoul', 0, 1378111968, NULL, 1378111968, NULL),
(215, 'KW', 'Asia/Kuwait', 0, 1378111968, NULL, 1378111968, NULL),
(216, 'KY', 'America/Cayman', 0, 1378111968, NULL, 1378111968, NULL),
(217, 'KZ', 'Asia/Almaty', 0, 1378111968, NULL, 1378111968, NULL),
(218, 'KZ', 'Asia/Qyzylorda', 0, 1378111968, NULL, 1378111968, NULL),
(219, 'KZ', 'Asia/Aqtobe', 0, 1378111968, NULL, 1378111968, NULL),
(220, 'KZ', 'Asia/Aqtau', 0, 1378111968, NULL, 1378111968, NULL),
(221, 'KZ', 'Asia/Oral', 0, 1378111968, NULL, 1378111968, NULL),
(222, 'LA', 'Asia/Vientiane', 0, 1378111968, NULL, 1378111968, NULL),
(223, 'LB', 'Asia/Beirut', 0, 1378111968, NULL, 1378111968, NULL),
(224, 'LC', 'America/St_Lucia', 0, 1378111968, NULL, 1378111968, NULL),
(225, 'LI', 'Europe/Vaduz', 0, 1378111968, NULL, 1378111968, NULL),
(226, 'LK', 'Asia/Colombo', 0, 1378111968, NULL, 1378111968, NULL),
(227, 'LR', 'Africa/Monrovia', 0, 1378111968, NULL, 1378111968, NULL),
(228, 'LS', 'Africa/Maseru', 0, 1378111968, NULL, 1378111968, NULL),
(229, 'LT', 'Europe/Vilnius', 0, 1378111968, NULL, 1378111968, NULL),
(230, 'LU', 'Europe/Luxembourg', 0, 1378111968, NULL, 1378111968, NULL),
(231, 'LV', 'Europe/Riga', 0, 1378111968, NULL, 1378111968, NULL),
(232, 'LY', 'Africa/Tripoli', 0, 1378111968, NULL, 1378111968, NULL),
(233, 'MA', 'Africa/Casablanca', 0, 1378111968, NULL, 1378111968, NULL),
(234, 'MC', 'Europe/Monaco', 0, 1378111968, NULL, 1378111968, NULL),
(235, 'MD', 'Europe/Chisinau', 0, 1378111968, NULL, 1378111968, NULL),
(236, 'ME', 'Europe/Podgorica', 0, 1378111968, NULL, 1378111968, NULL),
(237, 'MF', 'America/Marigot', 0, 1378111968, NULL, 1378111968, NULL),
(238, 'MG', 'Indian/Antananarivo', 0, 1378111968, NULL, 1378111968, NULL),
(239, 'MH', 'Pacific/Majuro', 0, 1378111968, NULL, 1378111968, NULL),
(240, 'MH', 'Pacific/Kwajalein', 0, 1378111968, NULL, 1378111968, NULL),
(241, 'MK', 'Europe/Skopje', 0, 1378111968, NULL, 1378111968, NULL),
(242, 'ML', 'Africa/Bamako', 0, 1378111968, NULL, 1378111968, NULL),
(243, 'MM', 'Asia/Rangoon', 0, 1378111968, NULL, 1378111968, NULL),
(244, 'MN', 'Asia/Ulaanbaatar', 0, 1378111968, NULL, 1378111968, NULL),
(245, 'MN', 'Asia/Hovd', 0, 1378111968, NULL, 1378111968, NULL),
(246, 'MN', 'Asia/Choibalsan', 0, 1378111968, NULL, 1378111968, NULL),
(247, 'MO', 'Asia/Macau', 0, 1378111968, NULL, 1378111968, NULL),
(248, 'MP', 'Pacific/Saipan', 0, 1378111968, NULL, 1378111968, NULL),
(249, 'MQ', 'America/Martinique', 0, 1378111968, NULL, 1378111968, NULL),
(250, 'MR', 'Africa/Nouakchott', 0, 1378111968, NULL, 1378111968, NULL),
(251, 'MS', 'America/Montserrat', 0, 1378111968, NULL, 1378111968, NULL),
(252, 'MT', 'Europe/Malta', 0, 1378111968, NULL, 1378111968, NULL),
(253, 'MU', 'Indian/Mauritius', 0, 1378111968, NULL, 1378111968, NULL),
(254, 'MV', 'Indian/Maldives', 0, 1378111968, NULL, 1378111968, NULL),
(255, 'MW', 'Africa/Blantyre', 0, 1378111968, NULL, 1378111968, NULL),
(256, 'MX', 'America/Mexico_City', 0, 1378111968, NULL, 1378111968, NULL),
(257, 'MX', 'America/Cancun', 0, 1378111968, NULL, 1378111968, NULL),
(258, 'MX', 'America/Merida', 0, 1378111968, NULL, 1378111968, NULL),
(259, 'MX', 'America/Monterrey', 0, 1378111968, NULL, 1378111968, NULL),
(260, 'MX', 'America/Matamoros', 0, 1378111968, NULL, 1378111968, NULL),
(261, 'MX', 'America/Mazatlan', 0, 1378111968, NULL, 1378111968, NULL),
(262, 'MX', 'America/Chihuahua', 0, 1378111968, NULL, 1378111968, NULL),
(263, 'MX', 'America/Ojinaga', 0, 1378111968, NULL, 1378111968, NULL),
(264, 'MX', 'America/Hermosillo', 0, 1378111968, NULL, 1378111968, NULL),
(265, 'MX', 'America/Tijuana', 0, 1378111968, NULL, 1378111968, NULL),
(266, 'MX', 'America/Santa_Isabel', 0, 1378111968, NULL, 1378111968, NULL),
(267, 'MX', 'America/Bahia_Banderas', 0, 1378111968, NULL, 1378111968, NULL),
(268, 'MY', 'Asia/Kuala_Lumpur', 0, 1378111968, NULL, 1378111968, NULL),
(269, 'MY', 'Asia/Kuching', 0, 1378111968, NULL, 1378111968, NULL),
(270, 'MZ', 'Africa/Maputo', 0, 1378111968, NULL, 1378111968, NULL),
(271, 'NA', 'Africa/Windhoek', 0, 1378111968, NULL, 1378111968, NULL),
(272, 'NC', 'Pacific/Noumea', 0, 1378111968, NULL, 1378111968, NULL),
(273, 'NE', 'Africa/Niamey', 0, 1378111968, NULL, 1378111968, NULL),
(274, 'NF', 'Pacific/Norfolk', 0, 1378111968, NULL, 1378111968, NULL),
(275, 'NG', 'Africa/Lagos', 0, 1378111968, NULL, 1378111968, NULL),
(276, 'NI', 'America/Managua', 0, 1378111968, NULL, 1378111968, NULL),
(277, 'NL', 'Europe/Amsterdam', 0, 1378111968, NULL, 1378111968, NULL),
(278, 'NO', 'Europe/Oslo', 0, 1378111968, NULL, 1378111968, NULL),
(279, 'NP', 'Asia/Kathmandu', 0, 1378111968, NULL, 1378111968, NULL),
(280, 'NR', 'Pacific/Nauru', 0, 1378111968, NULL, 1378111968, NULL),
(281, 'NU', 'Pacific/Niue', 0, 1378111968, NULL, 1378111968, NULL),
(282, 'NZ', 'Pacific/Auckland', 0, 1378111968, NULL, 1378111968, NULL),
(283, 'NZ', 'Pacific/Chatham', 0, 1378111968, NULL, 1378111968, NULL),
(284, 'OM', 'Asia/Muscat', 0, 1378111968, NULL, 1378111968, NULL),
(285, 'PA', 'America/Panama', 0, 1378111968, NULL, 1378111968, NULL),
(286, 'PE', 'America/Lima', 0, 1378111968, NULL, 1378111968, NULL),
(287, 'PF', 'Pacific/Tahiti', 0, 1378111968, NULL, 1378111968, NULL),
(288, 'PF', 'Pacific/Marquesas', 0, 1378111968, NULL, 1378111968, NULL),
(289, 'PF', 'Pacific/Gambier', 0, 1378111968, NULL, 1378111968, NULL),
(290, 'PG', 'Pacific/Port_Moresby', 0, 1378111968, NULL, 1378111968, NULL),
(291, 'PH', 'Asia/Manila', 0, 1378111968, NULL, 1378111968, NULL),
(292, 'PK', 'Asia/Karachi', 0, 1378111968, NULL, 1378111968, NULL),
(293, 'PL', 'Europe/Warsaw', 0, 1378111968, NULL, 1378111968, NULL),
(294, 'PM', 'America/Miquelon', 0, 1378111968, NULL, 1378111968, NULL),
(295, 'PN', 'Pacific/Pitcairn', 0, 1378111968, NULL, 1378111968, NULL),
(296, 'PR', 'America/Puerto_Rico', 0, 1378111968, NULL, 1378111968, NULL),
(297, 'PS', 'Asia/Gaza', 0, 1378111968, NULL, 1378111968, NULL),
(298, 'PS', 'Asia/Hebron', 0, 1378111968, NULL, 1378111968, NULL),
(299, 'PT', 'Europe/Lisbon', 0, 1378111968, NULL, 1378111968, NULL),
(300, 'PT', 'Atlantic/Madeira', 0, 1378111968, NULL, 1378111968, NULL),
(301, 'PT', 'Atlantic/Azores', 0, 1378111968, NULL, 1378111968, NULL),
(302, 'PW', 'Pacific/Palau', 0, 1378111968, NULL, 1378111968, NULL),
(303, 'PY', 'America/Asuncion', 0, 1378111968, NULL, 1378111968, NULL),
(304, 'QA', 'Asia/Qatar', 0, 1378111968, NULL, 1378111968, NULL),
(305, 'RE', 'Indian/Reunion', 0, 1378111968, NULL, 1378111968, NULL),
(306, 'RO', 'Europe/Bucharest', 0, 1378111968, NULL, 1378111968, NULL),
(307, 'RS', 'Europe/Belgrade', 0, 1378111968, NULL, 1378111968, NULL),
(308, 'RU', 'Europe/Kaliningrad', 0, 1378111968, NULL, 1378111968, NULL),
(309, 'RU', 'Europe/Moscow', 0, 1378111968, NULL, 1378111968, NULL),
(310, 'RU', 'Europe/Volgograd', 0, 1378111968, NULL, 1378111968, NULL),
(311, 'RU', 'Europe/Samara', 0, 1378111968, NULL, 1378111968, NULL),
(312, 'RU', 'Asia/Yekaterinburg', 0, 1378111968, NULL, 1378111968, NULL),
(313, 'RU', 'Asia/Omsk', 0, 1378111968, NULL, 1378111968, NULL),
(314, 'RU', 'Asia/Novosibirsk', 0, 1378111968, NULL, 1378111968, NULL),
(315, 'RU', 'Asia/Novokuznetsk', 0, 1378111968, NULL, 1378111968, NULL),
(316, 'RU', 'Asia/Krasnoyarsk', 0, 1378111968, NULL, 1378111968, NULL),
(317, 'RU', 'Asia/Irkutsk', 0, 1378111968, NULL, 1378111968, NULL),
(318, 'RU', 'Asia/Yakutsk', 0, 1378111968, NULL, 1378111968, NULL),
(319, 'RU', 'Asia/Khandyga', 0, 1378111968, NULL, 1378111968, NULL),
(320, 'RU', 'Asia/Vladivostok', 0, 1378111968, NULL, 1378111968, NULL),
(321, 'RU', 'Asia/Sakhalin', 0, 1378111968, NULL, 1378111968, NULL),
(322, 'RU', 'Asia/Ust-Nera', 0, 1378111968, NULL, 1378111968, NULL),
(323, 'RU', 'Asia/Magadan', 0, 1378111968, NULL, 1378111968, NULL),
(324, 'RU', 'Asia/Kamchatka', 0, 1378111968, NULL, 1378111968, NULL),
(325, 'RU', 'Asia/Anadyr', 0, 1378111968, NULL, 1378111968, NULL),
(326, 'RW', 'Africa/Kigali', 0, 1378111968, NULL, 1378111968, NULL),
(327, 'SA', 'Asia/Riyadh', 0, 1378111968, NULL, 1378111968, NULL),
(328, 'SB', 'Pacific/Guadalcanal', 0, 1378111968, NULL, 1378111968, NULL),
(329, 'SC', 'Indian/Mahe', 0, 1378111968, NULL, 1378111968, NULL),
(330, 'SD', 'Africa/Khartoum', 0, 1378111968, NULL, 1378111968, NULL),
(331, 'SE', 'Europe/Stockholm', 0, 1378111968, NULL, 1378111968, NULL),
(332, 'SG', 'Asia/Singapore', 0, 1378111968, NULL, 1378111968, NULL),
(333, 'SH', 'Atlantic/St_Helena', 0, 1378111968, NULL, 1378111968, NULL),
(334, 'SI', 'Europe/Ljubljana', 0, 1378111968, NULL, 1378111968, NULL),
(335, 'SJ', 'Arctic/Longyearbyen', 0, 1378111968, NULL, 1378111968, NULL),
(336, 'SK', 'Europe/Bratislava', 0, 1378111968, NULL, 1378111968, NULL),
(337, 'SL', 'Africa/Freetown', 0, 1378111968, NULL, 1378111968, NULL),
(338, 'SM', 'Europe/San_Marino', 0, 1378111968, NULL, 1378111968, NULL),
(339, 'SN', 'Africa/Dakar', 0, 1378111968, NULL, 1378111968, NULL),
(340, 'SO', 'Africa/Mogadishu', 0, 1378111968, NULL, 1378111968, NULL),
(341, 'SR', 'America/Paramaribo', 0, 1378111968, NULL, 1378111968, NULL),
(342, 'ST', 'Africa/Sao_Tome', 0, 1378111968, NULL, 1378111968, NULL),
(343, 'SV', 'America/El_Salvador', 0, 1378111968, NULL, 1378111968, NULL),
(344, 'SX', 'America/Lower_Princes', 0, 1378111968, NULL, 1378111968, NULL),
(345, 'SY', 'Asia/Damascus', 0, 1378111968, NULL, 1378111968, NULL),
(346, 'SZ', 'Africa/Mbabane', 0, 1378111968, NULL, 1378111968, NULL),
(347, 'TC', 'America/Grand_Turk', 0, 1378111968, NULL, 1378111968, NULL),
(348, 'TD', 'Africa/Ndjamena', 0, 1378111968, NULL, 1378111968, NULL),
(349, 'TF', 'Indian/Kerguelen', 0, 1378111968, NULL, 1378111968, NULL),
(350, 'TG', 'Africa/Lome', 0, 1378111968, NULL, 1378111968, NULL),
(351, 'TH', 'Asia/Bangkok', 0, 1378111968, NULL, 1378111968, NULL),
(352, 'TJ', 'Asia/Dushanbe', 0, 1378111968, NULL, 1378111968, NULL),
(353, 'TK', 'Pacific/Fakaofo', 0, 1378111968, NULL, 1378111968, NULL),
(354, 'TL', 'Asia/Dili', 0, 1378111968, NULL, 1378111968, NULL),
(355, 'TM', 'Asia/Ashgabat', 0, 1378111968, NULL, 1378111968, NULL),
(356, 'TN', 'Africa/Tunis', 0, 1378111968, NULL, 1378111968, NULL),
(357, 'TO', 'Pacific/Tongatapu', 0, 1378111968, NULL, 1378111968, NULL),
(358, 'TR', 'Europe/Istanbul', 0, 1378111968, NULL, 1378111968, NULL),
(359, 'TT', 'America/Port_of_Spain', 0, 1378111968, NULL, 1378111968, NULL),
(360, 'TV', 'Pacific/Funafuti', 0, 1378111968, NULL, 1378111968, NULL),
(361, 'TW', 'Asia/Taipei', 0, 1378111968, NULL, 1378111968, NULL),
(362, 'TZ', 'Africa/Dar_es_Salaam', 0, 1378111968, NULL, 1378111968, NULL),
(363, 'UA', 'Europe/Kiev', 0, 1378111968, NULL, 1378111968, NULL),
(364, 'UA', 'Europe/Uzhgorod', 0, 1378111968, NULL, 1378111968, NULL),
(365, 'UA', 'Europe/Zaporozhye', 0, 1378111968, NULL, 1378111968, NULL),
(366, 'UA', 'Europe/Simferopol', 0, 1378111968, NULL, 1378111968, NULL),
(367, 'UG', 'Africa/Kampala', 0, 1378111968, NULL, 1378111968, NULL),
(368, 'UM', 'Pacific/Johnston', 0, 1378111968, NULL, 1378111968, NULL),
(369, 'UM', 'Pacific/Midway', 0, 1378111968, NULL, 1378111968, NULL),
(370, 'UM', 'Pacific/Wake', 0, 1378111968, NULL, 1378111968, NULL),
(371, 'US', 'America/New_York', 0, 1378111968, NULL, 1378111968, NULL),
(372, 'US', 'America/Detroit', 0, 1378111968, NULL, 1378111968, NULL),
(373, 'US', 'America/Kentucky/Louisville', 0, 1378111968, NULL, 1378111968, NULL),
(374, 'US', 'America/Kentucky/Monticello', 0, 1378111968, NULL, 1378111968, NULL),
(375, 'US', 'America/Indiana/Indianapolis', 0, 1378111969, NULL, 1378111969, NULL),
(376, 'US', 'America/Indiana/Vincennes', 0, 1378111969, NULL, 1378111969, NULL),
(377, 'US', 'America/Indiana/Winamac', 0, 1378111969, NULL, 1378111969, NULL),
(378, 'US', 'America/Indiana/Marengo', 0, 1378111969, NULL, 1378111969, NULL),
(379, 'US', 'America/Indiana/Petersburg', 0, 1378111969, NULL, 1378111969, NULL),
(380, 'US', 'America/Indiana/Vevay', 0, 1378111969, NULL, 1378111969, NULL),
(381, 'US', 'America/Chicago', 0, 1378111969, NULL, 1378111969, NULL),
(382, 'US', 'America/Indiana/Tell_City', 0, 1378111969, NULL, 1378111969, NULL),
(383, 'US', 'America/Indiana/Knox', 0, 1378111969, NULL, 1378111969, NULL),
(384, 'US', 'America/Menominee', 0, 1378111969, NULL, 1378111969, NULL),
(385, 'US', 'America/North_Dakota/Center', 0, 1378111969, NULL, 1378111969, NULL),
(386, 'US', 'America/North_Dakota/New_Salem', 0, 1378111969, NULL, 1378111969, NULL),
(387, 'US', 'America/North_Dakota/Beulah', 0, 1378111969, NULL, 1378111969, NULL),
(388, 'US', 'America/Denver', 0, 1378111969, NULL, 1378111969, NULL),
(389, 'US', 'America/Boise', 0, 1378111969, NULL, 1378111969, NULL),
(390, 'US', 'America/Shiprock', 0, 1378111969, NULL, 1378111969, NULL),
(391, 'US', 'America/Phoenix', 0, 1378111969, NULL, 1378111969, NULL),
(392, 'US', 'America/Los_Angeles', 0, 1378111969, NULL, 1378111969, NULL),
(393, 'US', 'America/Anchorage', 0, 1378111969, NULL, 1378111969, NULL),
(394, 'US', 'America/Juneau', 0, 1378111969, NULL, 1378111969, NULL),
(395, 'US', 'America/Sitka', 0, 1378111969, NULL, 1378111969, NULL),
(396, 'US', 'America/Yakutat', 0, 1378111969, NULL, 1378111969, NULL),
(397, 'US', 'America/Nome', 0, 1378111969, NULL, 1378111969, NULL),
(398, 'US', 'America/Adak', 0, 1378111969, NULL, 1378111969, NULL),
(399, 'US', 'America/Metlakatla', 0, 1378111969, NULL, 1378111969, NULL),
(400, 'US', 'Pacific/Honolulu', 0, 1378111969, NULL, 1378111969, NULL),
(401, 'UY', 'America/Montevideo', 0, 1378111969, NULL, 1378111969, NULL),
(402, 'UZ', 'Asia/Samarkand', 0, 1378111969, NULL, 1378111969, NULL),
(403, 'UZ', 'Asia/Tashkent', 0, 1378111969, NULL, 1378111969, NULL),
(404, 'VA', 'Europe/Vatican', 0, 1378111969, NULL, 1378111969, NULL),
(405, 'VC', 'America/St_Vincent', 0, 1378111969, NULL, 1378111969, NULL),
(406, 'VE', 'America/Caracas', 0, 1378111969, NULL, 1378111969, NULL),
(407, 'VG', 'America/Tortola', 0, 1378111969, NULL, 1378111969, NULL),
(408, 'VI', 'America/St_Thomas', 0, 1378111969, NULL, 1378111969, NULL),
(409, 'VN', 'Asia/Ho_Chi_Minh', 0, 1378111969, NULL, 1378111969, NULL),
(410, 'VU', 'Pacific/Efate', 0, 1378111969, NULL, 1378111969, NULL),
(411, 'WF', 'Pacific/Wallis', 0, 1378111969, NULL, 1378111969, NULL),
(412, 'WS', 'Pacific/Apia', 0, 1378111969, NULL, 1378111969, NULL),
(413, 'YE', 'Asia/Aden', 0, 1378111969, NULL, 1378111969, NULL),
(414, 'YT', 'Indian/Mayotte', 0, 1378111969, NULL, 1378111969, NULL),
(415, 'ZA', 'Africa/Johannesburg', 0, 1378111969, NULL, 1378111969, NULL),
(416, 'ZM', 'Africa/Lusaka', 0, 1378111969, NULL, 1378111969, NULL),
(417, 'ZW', 'Africa/Harare', 0, 1378111969, NULL, 1378111969, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payer_id` int(10) unsigned NOT NULL,
  `payer_user_id` int(10) unsigned NOT NULL,
  `receiver_id` int(10) unsigned NOT NULL,
  `receiver_user_id` int(10) unsigned NOT NULL,
  `currency_id` smallint(5) unsigned NOT NULL,
  `channel_id` int(10) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `amount` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `status` tinyint(3) DEFAULT '0',
  `fee_amount` int(11) NOT NULL,
  `fee_percent` int(11) NOT NULL,
  `pspId` varchar(255) DEFAULT NULL,
  `short_id` varchar(14) DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `transactions`
--

INSERT INTO `transactions` (`id`, `payer_id`, `payer_user_id`, `receiver_id`, `receiver_user_id`, `currency_id`, `channel_id`, `timestamp`, `amount`, `fee`, `type`, `status`, `fee_amount`, `fee_percent`, `pspId`, `short_id`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 179848, 127352, 179846, 127350, 1, 1, 1396269130, 50000, 0, 1, 1, 0, 0, 'ff11111111111111111111111', '1111.1111.1111', 0, 1396269130, 0, 1396269130, 0),
(2, 179846, 127350, 179848, 127352, 1, 1, 1396269131, 80000, 0, 1, 1, 0, 0, 'ff11111111111111111111111', '1111.1111.1111', 0, 1396269131, 0, 1396269131, 0),
(3, 179847, 127351, 179846, 127350, 1, 1, 1396269158, 30000, 0, 1, 1, 0, 0, 'ff11111111111111111111111', '1111.1111.1111', 0, 1396269158, 0, 1396269159, 0),
(4, 179846, 127350, 179847, 127351, 1, 1, 1396269159, 10000, 3500, 1, 1, 3500, 0, 'ff11111111111111111111111', '1111.1111.1111', 0, 1396269159, 0, 1396269159, 0),
(5, 179847, 127351, 179848, 127352, 1, 1, 1396269185, 40000, 0, 1, 1, 0, 0, 'ff11111111111111111111111', '1111.1111.1111', 0, 1396269185, 0, 1396269185, 0),
(6, 179848, 127352, 179847, 127351, 1, 1, 1396269185, 30000, 3500, 1, 2, 3500, 0, NULL, '0', 0, 1396269185, 0, 1396269185, 0),
(7, 179848, 127352, 179847, 127351, 1, 1, 1396269219, 60000, 3500, 1, 1, 3500, 0, 'ff11111111111111111111111', '1111.1111.1111', 0, 1396269219, 0, 1396269219, 0),
(8, 179847, 127351, 179848, 127352, 1, 1, 1396269219, 45000, 0, 1, 1, 0, 0, 'ff11111111111111111111111', '1111.1111.1111', 0, 1396269219, 0, 1396269219, 0),
(9, 179846, 127350, 179847, 127351, 1, 1, 1396269254, 28000, 3500, 1, 1, 3500, 0, 'ff11111111111111111111111', '1111.1111.1111', 0, 1396269254, 0, 1396269255, 0),
(10, 179847, 127351, 179846, 127350, 1, 1, 1396269255, 99000, 0, 1, 1, 0, 0, 'ff11111111111111111111111', '1111.1111.1111', 0, 1396269255, 0, 1396269255, 0),
(11, 179846, 127350, 179848, 127352, 1, 1, 1396269282, 43000, 0, 1, 2, 0, 0, NULL, '0', 0, 1396269282, 0, 1396269282, 0),
(12, 179848, 127352, 179846, 127350, 1, 1, 1396269282, 87000, 0, 1, 1, 0, 0, 'ff11111111111111111111111', '1111.1111.1111', 0, 1396269282, 0, 1396269282, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `transaction_details`
--

CREATE TABLE IF NOT EXISTS `transaction_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint(20) unsigned NOT NULL,
  `transaction_type_id` smallint(5) unsigned NOT NULL,
  `paymey_account_id` int(10) unsigned NOT NULL,
  `currency_id` smallint(5) unsigned NOT NULL,
  `amount` int(10) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Daten für Tabelle `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `transaction_type_id`, `paymey_account_id`, `currency_id`, `amount`, `timestamp`, `description`, `status`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 1, 5, 179848, 1, 50000, 1396269130, '4053.4901.6226 Personal-reg Ihre Zahlung an Hans Wurscht', 0, 0, 1396269130, 0, 1396269130, 0),
(2, 1, 1, 179848, 1, -50000, 1396269130, '', 1, 0, 1396269130, 0, 1396269130, 0),
(3, 1, 2, 179846, 1, 50000, 1396269130, '', 1, 0, 1396269130, 0, 1396269130, 0),
(4, 1, 4, 179846, 1, 0, 1396269130, '', 1, 0, 1396269130, 0, 1396269130, 0),
(5, 2, 5, 179846, 1, 30000, 1396269131, '4053.4901.6226 Personal-reg Ihre Zahlung an PAYMEY GmbH', 0, 0, 1396269131, 0, 1396269131, 0),
(6, 2, 1, 179846, 1, -80000, 1396269131, '', 1, 0, 1396269131, 0, 1396269131, 0),
(7, 2, 2, 179848, 1, 80000, 1396269131, '', 1, 0, 1396269131, 0, 1396269131, 0),
(8, 2, 4, 179848, 1, 0, 1396269131, '', 1, 0, 1396269131, 0, 1396269131, 0),
(9, 3, 5, 179847, 1, 30000, 1396269159, '4053.4901.6226 Personal-reg Ihre Zahlung an Hans Wurscht', 0, 0, 1396269159, 0, 1396269159, 0),
(10, 3, 1, 179847, 1, -30000, 1396269159, '', 1, 0, 1396269159, 0, 1396269159, 0),
(11, 3, 2, 179846, 1, 30000, 1396269159, '', 1, 0, 1396269159, 0, 1396269159, 0),
(12, 3, 4, 179846, 1, 0, 1396269159, '', 1, 0, 1396269159, 0, 1396269159, 0),
(13, 4, 5, 179846, 1, 10000, 1396269159, '4053.4901.6226 Personal-reg Ihre Zahlung an Florian Walter', 0, 0, 1396269159, 0, 1396269159, 0),
(14, 4, 1, 179846, 1, -10000, 1396269159, '', 1, 0, 1396269159, 0, 1396269159, 0),
(15, 4, 2, 179847, 1, 10000, 1396269159, '', 1, 0, 1396269159, 0, 1396269159, 0),
(16, 4, 3, 179847, 1, -3500, 1396269159, 'Abzüglich Gebühren 0,35 €', 1, 0, 1396269159, 0, 1396269159, 0),
(17, 5, 5, 179847, 1, 40000, 1396269185, '4053.4901.6226 Personal-reg Ihre Zahlung an PAYMEY GmbH', 0, 0, 1396269185, 0, 1396269185, 0),
(18, 5, 1, 179847, 1, -40000, 1396269185, '', 1, 0, 1396269185, 0, 1396269185, 0),
(19, 5, 2, 179848, 1, 40000, 1396269185, '', 1, 0, 1396269185, 0, 1396269185, 0),
(20, 5, 4, 179848, 1, 0, 1396269185, '', 1, 0, 1396269185, 0, 1396269185, 0),
(21, 6, 1, 179848, 1, -30000, 1396269185, '', 1, 0, 1396269185, 0, 1396269185, 0),
(22, 6, 2, 179847, 1, 30000, 1396269185, '', 1, 0, 1396269185, 0, 1396269185, 0),
(23, 6, 3, 179847, 1, -3500, 1396269185, 'Abzüglich Gebühren 0,35 €', 1, 0, 1396269185, 0, 1396269185, 0),
(24, 7, 5, 179848, 1, 20000, 1396269219, '4053.4901.6226 Personal-reg Ihre Zahlung an Florian Walter', 0, 0, 1396269219, 0, 1396269219, 0),
(25, 7, 1, 179848, 1, -60000, 1396269219, '', 1, 0, 1396269219, 0, 1396269219, 0),
(26, 7, 2, 179847, 1, 60000, 1396269219, '', 1, 0, 1396269219, 0, 1396269219, 0),
(27, 7, 3, 179847, 1, -3500, 1396269219, 'Abzüglich Gebühren 0,35 €', 1, 0, 1396269219, 0, 1396269219, 0),
(28, 8, 5, 179847, 1, 25500, 1396269219, '4053.4901.6226 Personal-reg Ihre Zahlung an PAYMEY GmbH', 0, 0, 1396269219, 0, 1396269219, 0),
(29, 8, 1, 179847, 1, -45000, 1396269219, '', 1, 0, 1396269219, 0, 1396269219, 0),
(30, 8, 2, 179848, 1, 45000, 1396269219, '', 1, 0, 1396269219, 0, 1396269219, 0),
(31, 8, 4, 179848, 1, 0, 1396269219, '', 1, 0, 1396269219, 0, 1396269219, 0),
(32, 9, 5, 179846, 1, 28000, 1396269254, '4053.4901.6226 Personal-reg Ihre Zahlung an Florian Walter', 0, 0, 1396269254, 0, 1396269254, 0),
(33, 9, 1, 179846, 1, -28000, 1396269254, '', 1, 0, 1396269254, 0, 1396269254, 0),
(34, 9, 2, 179847, 1, 28000, 1396269254, '', 1, 0, 1396269254, 0, 1396269254, 0),
(35, 9, 3, 179847, 1, -3500, 1396269254, 'Abzüglich Gebühren 0,35 €', 1, 0, 1396269254, 0, 1396269254, 0),
(36, 10, 5, 179847, 1, 99000, 1396269255, '4053.4901.6226 Personal-reg Ihre Zahlung an Hans Wurscht', 0, 0, 1396269255, 0, 1396269255, 0),
(37, 10, 1, 179847, 1, -99000, 1396269255, '', 1, 0, 1396269255, 0, 1396269255, 0),
(38, 10, 2, 179846, 1, 99000, 1396269255, '', 1, 0, 1396269255, 0, 1396269255, 0),
(39, 10, 4, 179846, 1, 0, 1396269255, '', 1, 0, 1396269255, 0, 1396269255, 0),
(40, 11, 1, 179846, 1, -43000, 1396269282, '', 1, 0, 1396269282, 0, 1396269282, 0),
(41, 11, 2, 179848, 1, 43000, 1396269282, '', 1, 0, 1396269282, 0, 1396269282, 0),
(42, 11, 4, 179848, 1, 0, 1396269282, '', 1, 0, 1396269282, 0, 1396269282, 0),
(43, 12, 5, 179848, 1, 19000, 1396269282, '4053.4901.6226 Personal-reg Ihre Zahlung an Hans Wurscht', 0, 0, 1396269282, 0, 1396269282, 0),
(44, 12, 1, 179848, 1, -87000, 1396269282, '', 1, 0, 1396269282, 0, 1396269282, 0),
(45, 12, 2, 179846, 1, 87000, 1396269282, '', 1, 0, 1396269282, 0, 1396269282, 0),
(46, 12, 4, 179846, 1, 0, 1396269282, '', 1, 0, 1396269282, 0, 1396269282, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `transaction_requests`
--

CREATE TABLE IF NOT EXISTS `transaction_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `receiver_id` int(10) unsigned NOT NULL,
  `receiver_user_id` int(10) unsigned NOT NULL,
  `currency_id` int(10) unsigned NOT NULL,
  `channel_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tan` int(10) unsigned NOT NULL,
  `amount` int(11) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_completed` tinyint(3) unsigned DEFAULT '0',
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `transaction_types`
--

CREATE TABLE IF NOT EXISTS `transaction_types` (
  `id` smallint(5) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `dsc` text,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `name`, `dsc`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'debit', 'debitDescription', 0, 1384531114, 0, 1384531114, 0),
(2, 'credit', 'creditDescription', 0, 1384531114, 0, 1384531114, 0),
(3, 'fee', 'feeDescription', 0, 1384531114, 0, 1384531114, 0),
(4, 'freeTransaction', 'freeTransactionDescription', 0, 1384531114, 0, 1384531114, 0),
(5, 'directDebit', 'directDebitDescription', 0, 1384531114, 0, 1384531114, 0),
(6, 'promotion', 'promotionDescription', 0, 1384531114, 0, 1384531114, 0),
(7, 'creditTransfer', 'creditTransferDescription', 0, 1384531114, 0, 1384531114, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `gender` char(1) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tmp_email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `activation_hash` varchar(255) NOT NULL,
  `pass_created` int(10) unsigned DEFAULT '0',
  `date_of_birth` date NOT NULL,
  `nationality` smallint(5) unsigned NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_pin` varchar(255) NOT NULL,
  `is_verified` tinyint(3) unsigned DEFAULT '0',
  `status` tinyint(3) unsigned DEFAULT '0',
  `login_attempts` smallint(5) unsigned DEFAULT '0',
  `locked_until` int(10) unsigned DEFAULT '0',
  `zendesk_id` int(10) unsigned DEFAULT NULL,
  `is_deleted` tinyint(3) unsigned DEFAULT '0',
  `created` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT '0',
  `modified` int(10) unsigned DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127353 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `account_id`, `language_id`, `gender`, `firstname`, `lastname`, `email`, `tmp_email`, `password`, `activation_hash`, `pass_created`, `date_of_birth`, `nationality`, `mobile`, `phone`, `phone_pin`, `is_verified`, `status`, `login_attempts`, `locked_until`, `zendesk_id`, `is_deleted`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(127350, 127350, 1, 'm', 'Hans', 'Wurscht', 'spam@attentra.de', '', '$2a$13$GQ3GQQisYK00faCcirxHM.N2mpql65IeQTeDWTJ2686udmTjbwDvO', '8L6wt9pW7AtPHz5i', 1396273251, '1972-04-28', 54, '0176123456', '', '1234', 1, 1, 0, 0, NULL, 0, 1375706757, 1, 1396273251, 1),
(127351, 127351, 1, 'm', 'Florian', 'Walter', 'fw@attentra.de', '', '$2a$13$VP.7F1PWtpoW/FP/Jno.q.m4xKgGDUBHWbdxDeeLC0EbJE43qxTLO', '', 1396273251, '1949-05-01', 54, '0176123456', '', '1234', 1, 1, 0, 0, NULL, 0, NULL, 2, 1396273251, 1),
(127352, 127352, 1, 'm', 'Christian', 'Vollrath', 'cv@attentra.de', '', '$2a$13$OupwXuRC.PDkd6ZLNLPRH./eXBkTFMHyk9dZ3LHFORgX6EHGsoy46', '', 1396273252, '1958-03-23', 54, '0176123456', '', '3214', 1, 1, 0, 0, NULL, 0, NULL, 2, 1396273252, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
