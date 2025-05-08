-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08-Maio-2025 às 19:20
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `carteiramaiseficiente`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historical_data`
--

DROP TABLE IF EXISTS `historical_data`;
CREATE TABLE IF NOT EXISTS `historical_data` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `stock_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `preco_justo` decimal(10,2) NOT NULL,
  `potencial_valorizacao` decimal(5,2) NOT NULL,
  `preco_atual` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `historical_data_user_id_foreign` (`user_id`),
  KEY `historical_data_stock_id_foreign` (`stock_id`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `historical_data`
--

INSERT INTO `historical_data` (`id`, `user_id`, `stock_id`, `date`, `preco_justo`, `potencial_valorizacao`, `preco_atual`, `created_at`, `updated_at`) VALUES
(36, 1, 173, '2024-11-12', '12.48', '146.12', '5.07', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(35, 1, 139, '2024-11-12', '66.39', '67.30', '39.68', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(34, 1, 94, '2024-11-12', '62.93', '143.08', '25.89', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(33, 1, 90, '2024-11-12', '24.24', '-27.88', '33.61', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(32, 1, 170, '2024-11-12', '37.78', '60.48', '23.54', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(31, 1, 166, '2024-11-12', '12.38', '-77.55', '55.17', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(30, 1, 171, '2024-11-12', '16.00', '51.26', '10.58', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(29, 1, 169, '2024-11-12', '42.89', '41.73', '30.26', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(28, 1, 168, '2024-11-12', '41.39', '73.76', '23.82', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(27, 1, 142, '2024-11-12', '50.19', '27.28', '39.43', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(26, 1, 107, '2024-11-12', '6.36', '14.38', '5.56', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(25, 1, 162, '2024-11-12', '104.83', '83.21', '57.22', '2024-11-12 20:41:33', '2024-11-12 20:59:27'),
(37, 1, 162, '2024-11-13', '104.83', '82.73', '57.37', '2024-11-13 03:05:53', '2024-11-13 20:52:21'),
(38, 1, 107, '2024-11-13', '5.10', '-2.80', '5.25', '2024-11-13 03:05:53', '2024-11-13 20:52:21'),
(39, 1, 142, '2024-11-13', '50.19', '27.47', '39.37', '2024-11-13 03:05:53', '2024-11-13 20:52:21'),
(40, 1, 168, '2024-11-13', '41.39', '75.31', '23.61', '2024-11-13 03:05:53', '2024-11-13 20:52:21'),
(41, 1, 169, '2024-11-13', '42.89', '42.20', '30.16', '2024-11-13 03:05:53', '2024-11-13 20:52:21'),
(42, 1, 171, '2024-11-13', '16.00', '52.13', '10.52', '2024-11-13 03:05:53', '2024-11-13 20:52:21'),
(43, 1, 166, '2024-11-13', '12.38', '-77.40', '54.78', '2024-11-13 03:05:53', '2024-11-13 20:52:21'),
(44, 1, 170, '2024-11-13', '37.78', '60.00', '23.61', '2024-11-13 03:05:53', '2024-11-13 20:52:21'),
(45, 1, 90, '2024-11-13', '24.24', '-27.88', '33.61', '2024-11-13 03:05:54', '2024-11-13 20:52:21'),
(46, 1, 94, '2024-11-13', '62.93', '142.52', '25.95', '2024-11-13 03:05:54', '2024-11-13 20:52:21'),
(47, 1, 139, '2024-11-13', '66.39', '67.98', '39.52', '2024-11-13 03:05:54', '2024-11-13 20:52:21'),
(48, 1, 173, '2024-11-13', '12.48', '150.06', '4.99', '2024-11-13 03:05:54', '2024-11-13 20:52:22'),
(49, 1, 162, '2024-11-14', '104.83', '83.40', '57.16', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(50, 1, 107, '2024-11-14', '5.10', '-2.43', '5.23', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(51, 1, 142, '2024-11-14', '50.19', '27.54', '39.35', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(52, 1, 168, '2024-11-14', '41.39', '75.46', '23.59', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(53, 1, 169, '2024-11-14', '42.89', '42.53', '30.09', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(54, 1, 171, '2024-11-14', '16.00', '51.55', '10.56', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(55, 1, 166, '2024-11-14', '12.38', '-77.36', '54.70', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(56, 1, 170, '2024-11-14', '37.78', '60.07', '23.60', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(57, 1, 90, '2024-11-14', '24.24', '-27.73', '33.54', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(58, 1, 94, '2024-11-14', '59.68', '129.97', '25.95', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(59, 1, 139, '2024-11-14', '66.39', '66.25', '39.93', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(60, 1, 173, '2024-11-14', '12.48', '151.57', '4.96', '2024-11-14 12:36:20', '2024-11-14 14:08:35'),
(61, 1, 162, '2024-11-21', '104.83', '81.94', '57.62', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(62, 1, 107, '2024-11-21', '5.10', '-0.92', '5.15', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(63, 1, 142, '2024-11-21', '50.19', '27.44', '39.38', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(64, 1, 168, '2024-11-21', '41.39', '67.16', '24.76', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(65, 1, 169, '2024-11-21', '42.89', '45.53', '29.47', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(66, 1, 171, '2024-11-21', '16.00', '55.83', '10.27', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(67, 1, 166, '2024-11-21', '12.38', '-76.97', '53.78', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(68, 1, 170, '2024-11-21', '37.78', '59.06', '23.75', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(69, 1, 90, '2024-11-21', '24.24', '-27.92', '33.63', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(70, 1, 94, '2024-11-21', '59.68', '135.13', '25.38', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(71, 1, 139, '2024-11-21', '66.39', '60.70', '41.31', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(72, 1, 173, '2024-11-21', '12.48', '147.58', '5.04', '2024-11-21 20:00:47', '2024-11-21 20:30:26'),
(73, 1, 162, '2024-12-01', '104.83', '78.35', '58.78', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(74, 1, 107, '2024-12-01', '5.10', '-3.35', '5.28', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(75, 1, 142, '2024-12-01', '50.19', '25.03', '40.14', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(76, 1, 168, '2024-12-01', '41.39', '63.08', '25.38', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(77, 1, 169, '2024-12-01', '42.89', '50.38', '28.52', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(78, 1, 171, '2024-12-01', '16.00', '61.17', '9.93', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(79, 1, 166, '2024-12-01', '12.38', '-77.04', '53.94', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(80, 1, 170, '2024-12-01', '37.78', '60.00', '23.61', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(81, 1, 90, '2024-12-01', '24.24', '-27.71', '33.53', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(82, 1, 94, '2024-12-01', '59.68', '140.92', '24.77', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(83, 1, 139, '2024-12-01', '66.39', '55.76', '42.62', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(84, 1, 173, '2024-12-01', '12.48', '112.21', '5.88', '2024-12-01 22:13:54', '2024-12-01 22:13:54'),
(85, 1, 162, '2025-01-07', '0.00', '-100.00', '52.56', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(86, 1, 107, '2025-01-07', '0.00', '-100.00', '5.01', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(87, 1, 142, '2025-01-07', '0.00', '-100.00', '41.40', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(88, 1, 168, '2025-01-07', '0.00', '-100.00', '20.81', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(89, 1, 169, '2025-01-07', '0.00', '-100.00', '27.66', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(90, 1, 171, '2025-01-07', '0.00', '-100.00', '9.04', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(91, 1, 166, '2025-01-07', '0.00', '-100.00', '53.12', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(92, 1, 170, '2025-01-07', '0.00', '-100.00', '22.81', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(93, 1, 90, '2025-01-07', '0.00', '-100.00', '36.67', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(94, 1, 94, '2025-01-07', '0.00', '-100.00', '24.09', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(95, 1, 139, '2025-01-07', '0.00', '-100.00', '40.25', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(96, 1, 173, '2025-01-07', '0.00', '-100.00', '5.27', '2025-01-07 13:20:20', '2025-01-07 13:22:45'),
(97, 1, 162, '2025-04-25', '83.32', '55.10', '53.72', '2025-04-25 19:21:42', '2025-04-25 20:59:58'),
(98, 1, 107, '2025-04-25', '5.91', '-4.07', '6.16', '2025-04-25 19:21:42', '2025-04-25 20:59:58'),
(99, 1, 142, '2025-04-25', '86.90', '148.86', '34.92', '2025-04-25 19:21:42', '2025-04-25 20:59:58'),
(100, 1, 168, '2025-04-25', '40.60', '91.31', '21.22', '2025-04-25 19:21:42', '2025-04-25 20:59:58'),
(101, 1, 169, '2025-04-25', '41.94', '38.97', '30.18', '2025-04-25 19:21:42', '2025-04-25 20:59:58'),
(102, 1, 171, '2025-04-25', '15.98', '51.28', '10.56', '2025-04-25 19:21:42', '2025-04-25 20:59:58'),
(103, 1, 166, '2025-04-25', '13.09', '-73.93', '50.21', '2025-04-25 19:21:42', '2025-04-25 20:59:58'),
(104, 1, 170, '2025-04-25', '36.30', '67.43', '21.68', '2025-04-25 19:21:42', '2025-04-25 20:59:58'),
(105, 1, 90, '2025-04-25', '21.79', '-48.01', '41.91', '2025-04-25 19:21:43', '2025-04-25 20:59:58'),
(106, 1, 94, '2025-04-25', '56.95', '102.83', '28.08', '2025-04-25 19:21:43', '2025-04-25 20:59:58'),
(107, 1, 139, '2025-04-25', '42.60', '30.51', '32.64', '2025-04-25 19:21:43', '2025-04-25 20:59:58'),
(108, 1, 173, '2025-04-25', '13.08', '121.64', '5.90', '2025-04-25 19:21:43', '2025-04-25 20:59:58'),
(109, 1, 162, '2025-04-28', '83.32', '54.43', '53.95', '2025-04-28 14:31:05', '2025-04-28 20:24:37'),
(110, 1, 107, '2025-04-28', '5.91', '-3.60', '6.13', '2025-04-28 14:31:05', '2025-04-28 20:24:37'),
(111, 1, 142, '2025-04-28', '86.90', '155.97', '33.95', '2025-04-28 14:31:05', '2025-04-28 20:24:37'),
(112, 1, 168, '2025-04-28', '40.60', '91.22', '21.23', '2025-04-28 14:31:05', '2025-04-28 20:24:37'),
(113, 1, 169, '2025-04-28', '41.94', '37.74', '30.45', '2025-04-28 14:31:05', '2025-04-28 20:24:37'),
(114, 1, 171, '2025-04-28', '15.98', '50.14', '10.64', '2025-04-28 14:31:05', '2025-04-28 20:24:37'),
(115, 1, 166, '2025-04-28', '13.09', '-73.96', '50.28', '2025-04-28 14:31:05', '2025-04-28 20:24:37'),
(116, 1, 170, '2025-04-28', '36.30', '68.83', '21.50', '2025-04-28 14:31:05', '2025-04-28 20:24:37'),
(117, 1, 90, '2025-04-28', '21.79', '-48.44', '42.26', '2025-04-28 14:31:05', '2025-04-28 20:24:37'),
(118, 1, 94, '2025-04-28', '56.95', '103.11', '28.04', '2025-04-28 14:31:05', '2025-04-28 20:24:37'),
(119, 1, 139, '2025-04-28', '42.60', '31.12', '32.49', '2025-04-28 14:31:05', '2025-04-28 20:24:38'),
(120, 1, 173, '2025-04-28', '13.08', '119.41', '5.96', '2025-04-28 14:31:05', '2025-04-28 20:24:38'),
(121, 1, 211, '2025-04-28', '23.16', '53.14', '15.12', '2025-04-28 15:07:29', '2025-04-28 20:24:38'),
(122, 1, 162, '2025-04-29', '83.32', '54.18', '54.04', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(123, 1, 107, '2025-04-29', '5.91', '-3.75', '6.14', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(124, 1, 142, '2025-04-29', '86.90', '151.31', '34.58', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(125, 1, 168, '2025-04-29', '40.60', '90.06', '21.36', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(126, 1, 169, '2025-04-29', '41.94', '37.15', '30.58', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(127, 1, 171, '2025-04-29', '15.98', '49.72', '10.67', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(128, 1, 166, '2025-04-29', '13.09', '-74.05', '50.45', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(129, 1, 170, '2025-04-29', '36.30', '67.66', '21.65', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(130, 1, 90, '2025-04-29', '21.79', '-48.06', '41.95', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(131, 1, 94, '2025-04-29', '56.95', '101.46', '28.27', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(132, 1, 139, '2025-04-29', '42.60', '32.01', '32.27', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(133, 1, 173, '2025-04-29', '13.08', '119.41', '5.96', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(134, 1, 211, '2025-04-29', '23.16', '54.26', '15.01', '2025-04-29 13:55:41', '2025-04-29 13:55:41'),
(135, 1, 162, '2025-05-02', '83.32', '56.97', '53.08', '2025-05-02 14:27:45', '2025-05-02 14:27:45'),
(136, 1, 107, '2025-05-02', '5.91', '-2.96', '6.09', '2025-05-02 14:27:45', '2025-05-02 14:27:45'),
(137, 1, 142, '2025-05-02', '86.90', '144.38', '35.56', '2025-05-02 14:27:45', '2025-05-02 14:27:45'),
(138, 1, 168, '2025-05-02', '40.60', '91.76', '21.17', '2025-05-02 14:27:45', '2025-05-02 14:27:45'),
(139, 1, 169, '2025-05-02', '41.94', '36.53', '30.72', '2025-05-02 14:27:45', '2025-05-02 14:27:45'),
(140, 1, 171, '2025-05-02', '15.98', '50.42', '10.62', '2025-05-02 14:27:45', '2025-05-02 14:27:45'),
(141, 1, 166, '2025-05-02', '13.04', '-70.82', '44.68', '2025-05-02 14:27:45', '2025-05-02 14:27:45'),
(142, 1, 170, '2025-05-02', '36.30', '72.36', '21.06', '2025-05-02 14:27:45', '2025-05-02 14:27:45'),
(143, 1, 90, '2025-05-02', '21.79', '-48.40', '42.22', '2025-05-02 14:27:45', '2025-05-02 14:27:45'),
(144, 1, 94, '2025-05-02', '56.95', '97.89', '28.78', '2025-05-02 14:27:45', '2025-05-02 14:27:45'),
(145, 1, 139, '2025-05-02', '42.60', '32.79', '32.08', '2025-05-02 14:27:46', '2025-05-02 14:27:46'),
(146, 1, 173, '2025-05-02', '13.08', '116.15', '6.05', '2025-05-02 14:27:46', '2025-05-02 14:27:46'),
(147, 1, 211, '2025-05-02', '23.16', '60.24', '14.45', '2025-05-02 14:27:46', '2025-05-02 14:27:46'),
(148, 1, 162, '2025-05-06', '83.32', '55.91', '53.44', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(149, 1, 107, '2025-05-06', '5.91', '-4.69', '6.20', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(150, 1, 142, '2025-05-06', '86.47', '134.84', '36.82', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(151, 1, 168, '2025-05-06', '40.60', '96.69', '20.64', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(152, 1, 169, '2025-05-06', '41.94', '36.53', '30.72', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(153, 1, 171, '2025-05-06', '15.98', '53.16', '10.43', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(154, 1, 166, '2025-05-06', '13.04', '-69.87', '43.27', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(155, 1, 170, '2025-05-06', '36.30', '74.76', '20.77', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(156, 1, 90, '2025-05-06', '23.80', '-39.01', '39.03', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(157, 1, 94, '2025-05-06', '56.95', '96.12', '29.04', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(158, 1, 139, '2025-05-06', '42.60', '31.52', '32.39', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(159, 1, 173, '2025-05-06', '13.08', '120.52', '5.93', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(160, 1, 211, '2025-05-06', '23.16', '57.63', '14.69', '2025-05-06 16:43:52', '2025-05-06 16:43:52'),
(161, 1, 162, '2025-05-07', '83.32', '57.53', '52.89', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(162, 1, 107, '2025-05-07', '5.91', '-3.75', '6.14', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(163, 1, 142, '2025-05-07', '86.47', '142.00', '35.73', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(164, 1, 168, '2025-05-07', '40.60', '95.84', '20.73', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(165, 1, 169, '2025-05-07', '41.94', '35.34', '30.99', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(166, 1, 171, '2025-05-07', '15.98', '51.57', '10.54', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(167, 1, 166, '2025-05-07', '13.04', '-68.92', '41.95', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(168, 1, 170, '2025-05-07', '36.30', '77.06', '20.50', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(169, 1, 90, '2025-05-07', '23.80', '-39.41', '39.29', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(170, 1, 94, '2025-05-07', '56.95', '94.31', '29.31', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(171, 1, 139, '2025-05-07', '42.60', '30.92', '32.54', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(172, 1, 173, '2025-05-07', '13.08', '110.58', '6.21', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(173, 1, 211, '2025-05-07', '23.16', '58.27', '14.63', '2025-05-07 20:26:01', '2025-05-07 20:26:01'),
(174, 1, 162, '2025-05-08', '83.32', '57.23', '52.99', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(175, 1, 107, '2025-05-08', '5.91', '-3.75', '6.14', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(176, 1, 142, '2025-05-08', '86.47', '134.46', '36.88', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(177, 1, 168, '2025-05-08', '40.60', '92.04', '21.14', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(178, 1, 169, '2025-05-08', '41.94', '32.60', '31.63', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(179, 1, 171, '2025-05-08', '15.98', '49.16', '10.71', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(180, 1, 166, '2025-05-08', '13.04', '-69.49', '42.73', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(181, 1, 170, '2025-05-08', '36.30', '77.85', '20.41', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(182, 1, 90, '2025-05-08', '23.80', '-38.52', '38.72', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(183, 1, 94, '2025-05-08', '56.95', '92.09', '29.65', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(184, 1, 139, '2025-05-08', '42.60', '28.43', '33.17', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(185, 1, 173, '2025-05-08', '13.08', '106.59', '6.33', '2025-05-08 16:35:18', '2025-05-08 16:35:18'),
(186, 1, 211, '2025-05-08', '23.16', '55.61', '14.88', '2025-05-08 16:35:18', '2025-05-08 16:35:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_01_110352_create_stocks_table', 1),
(6, '2024_10_01_114606_modify_stocks_table_nullable_columns', 2),
(7, '2024_10_01_145047_create_user_stocks_table', 3),
(8, '2024_11_12_143823_create_historical_data_table', 4),
(9, '2024_11_12_171429_add_preco_atual_to_historical_data_table', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_investidor10` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stocks_codigo_unique` (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=212 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `stocks`
--

INSERT INTO `stocks` (`id`, `codigo`, `nome`, `logo_url`, `id_investidor10`, `created_at`, `updated_at`) VALUES
(143, 'PETZ3', 'PETZ        ON      NM', 'https://s3-symbol-logo.tradingview.com/petz--big.svg', NULL, NULL, '2024-10-18 10:55:49'),
(142, 'PRIO3', 'PETRORIO    ON      NM', 'https://s3-symbol-logo.tradingview.com/petrorio-on-nm--big.svg', '70', NULL, '2024-10-18 02:17:14'),
(141, 'RECV3', 'PETRORECSA  ON      NM', 'https://s3-symbol-logo.tradingview.com/petrorecsa-on-nm--big.svg', NULL, NULL, '2024-10-18 10:55:36'),
(140, 'PETR4', 'PETROBRAS   PN      N2', 'https://s3-symbol-logo.tradingview.com/brasileiro-petrobras--big.svg', '4', NULL, '2024-10-21 19:11:26'),
(139, 'PETR3', 'PETROBRAS   ON      N2', 'https://s3-symbol-logo.tradingview.com/brasileiro-petrobras--big.svg', '2', NULL, '2024-10-18 02:13:56'),
(138, 'PCAR3', 'P.ACUCAR,CBDON      NM', 'https://s3-symbol-logo.tradingview.com/cia-brasileira-distr-pao-de-acucar--big.svg', NULL, NULL, '2024-10-18 10:55:18'),
(137, 'MULT3', 'MULTIPLAN   ON      N2', 'https://s3-symbol-logo.tradingview.com/multiplan-on-n2--big.svg', NULL, NULL, '2024-10-18 10:55:09'),
(136, 'MRVE3', 'MRV         ON      NM', 'https://s3-symbol-logo.tradingview.com/mrv--big.svg', NULL, NULL, '2024-10-18 10:55:00'),
(135, 'BEEF3', 'MINERVA     ON      NM', 'https://s3-symbol-logo.tradingview.com/minerva-on-nm--big.svg', NULL, NULL, '2024-10-18 10:54:51'),
(134, 'MRFG3', 'MARFRIG     ON      NM', 'https://s3-symbol-logo.tradingview.com/marfrig-on-nm--big.svg', NULL, NULL, '2024-10-18 10:54:40'),
(133, 'MGLU3', 'MAGAZ LUIZA ON      NM', 'https://s3-symbol-logo.tradingview.com/magaz-luiza-on-nm--big.svg', NULL, NULL, '2024-10-18 10:52:58'),
(132, 'LWSA3', 'LWSA        ON      NM', 'https://s3-symbol-logo.tradingview.com/locaweb--big.svg', NULL, NULL, '2024-10-18 10:52:47'),
(131, 'LREN3', 'LOJAS RENNERON      NM', 'https://s3-symbol-logo.tradingview.com/lojas-renner--big.svg', NULL, NULL, '2024-10-18 10:52:20'),
(130, 'RENT3', 'LOCALIZA    ON      NM', 'https://s3-symbol-logo.tradingview.com/localiza--big.svg', NULL, NULL, '2024-10-18 10:51:57'),
(129, 'KLBN11', 'KLABIN S/A  UNT     N2', 'https://s3-symbol-logo.tradingview.com/klabin--big.svg', NULL, NULL, '2024-10-18 10:51:21'),
(128, 'JBSS3', 'JBS         ON      NM', 'https://s3-symbol-logo.tradingview.com/jbs-s-a--big.svg', NULL, NULL, '2024-10-18 10:51:07'),
(127, 'ITUB4', 'ITAUUNIBANCOPN      N1', 'https://s3-symbol-logo.tradingview.com/itau-unibanco--big.svg', NULL, NULL, '2024-10-18 10:50:57'),
(126, 'ITSA4', 'ITAUSA      PN      N1', 'https://s3-symbol-logo.tradingview.com/itausa--big.svg', NULL, NULL, '2024-10-18 10:50:48'),
(125, 'IRBR3', 'IRBBRASIL REON      NM', 'https://s3-symbol-logo.tradingview.com/irbbrasil-reon--big.svg', NULL, NULL, '2024-10-18 10:50:37'),
(124, 'IGTI11', 'IGUATEMI S.AUNT     N1', 'https://s3-symbol-logo.tradingview.com/iguatemi-saon-n1--big.svg', NULL, NULL, '2024-10-18 10:50:24'),
(123, 'HYPE3', 'HYPERA      ON      NM', 'https://s3-symbol-logo.tradingview.com/hypera--big.svg', NULL, NULL, '2024-10-18 10:50:13'),
(122, 'HAPV3', 'HAPVIDA     ON  ATZ NM', 'https://s3-symbol-logo.tradingview.com/hapvida--big.svg', NULL, NULL, '2024-10-18 10:50:03'),
(121, 'NTCO3', 'GRUPO NATURAON      NM', 'https://s3-symbol-logo.tradingview.com/natura-and-co--big.svg', NULL, NULL, '2024-10-18 10:49:46'),
(120, 'GOAU4', 'GERDAU MET  PN      N1', 'https://s3-symbol-logo.tradingview.com/gerdau--big.svg', NULL, NULL, '2024-10-18 10:49:36'),
(119, 'GGBR4', 'GERDAU      PN      N1', 'https://s3-symbol-logo.tradingview.com/gerdau--big.svg', NULL, NULL, '2024-10-18 10:49:13'),
(118, 'FLRY3', 'FLEURY      ON      NM', 'https://s3-symbol-logo.tradingview.com/fleury-on-nm--big.svg', NULL, NULL, '2024-10-18 10:49:01'),
(117, 'EZTC3', 'EZTEC       ON      NM', 'https://s3-symbol-logo.tradingview.com/eztec--big.svg', NULL, NULL, '2024-10-18 10:48:52'),
(116, 'EQTL3', 'EQUATORIAL  ON      NM', 'https://s3-symbol-logo.tradingview.com/equatorial--big.svg', NULL, NULL, '2024-10-18 10:48:41'),
(115, 'EGIE3', 'ENGIE BRASILON      NM', 'https://s3-symbol-logo.tradingview.com/engie-brasilon-nm--big.svg', NULL, NULL, '2024-10-18 10:48:29'),
(114, 'ENEV3', 'ENEVA       ON      NM', 'https://s3-symbol-logo.tradingview.com/eneva--big.svg', NULL, NULL, '2024-10-18 10:48:12'),
(113, 'ENGI11', 'ENERGISA    UNT     N2', 'https://s3-symbol-logo.tradingview.com/energisa-unt-n2--big.svg', NULL, NULL, '2024-10-18 10:47:58'),
(112, 'EMBR3', 'EMBRAER     ON      NM', 'https://s3-symbol-logo.tradingview.com/embraer--big.svg', '135', NULL, '2024-10-18 11:12:47'),
(111, 'ELET6', 'ELETROBRAS  PNB     N1', 'https://s3-symbol-logo.tradingview.com/centrais-eletr-bras-sa--big.svg', NULL, NULL, '2024-10-18 10:47:28'),
(110, 'ELET3', 'ELETROBRAS  ON      N1', 'https://s3-symbol-logo.tradingview.com/centrais-eletr-bras-sa--big.svg', NULL, NULL, '2024-10-18 10:47:17'),
(109, 'CYRE3', 'CYRELA REALTON      NM', 'https://s3-symbol-logo.tradingview.com/cyrela-realton-nm--big.svg', NULL, NULL, '2024-10-18 10:47:05'),
(108, 'CVCB3', 'CVC BRASIL  ON      NM', 'https://s3-symbol-logo.tradingview.com/cvc-brasil-on-nm--big.svg', NULL, NULL, '2024-10-18 10:46:55'),
(107, 'CMIN3', 'CSNMINERACAOON  EDJ N2', 'https://s3-symbol-logo.tradingview.com/csn-mineracao--big.svg', '576', NULL, '2024-10-18 10:46:41'),
(106, 'CPFE3', 'CPFL ENERGIAON      NM', 'https://s3-symbol-logo.tradingview.com/cpfl-energia--big.svg', NULL, NULL, '2024-10-18 10:46:28'),
(105, 'CSAN3', 'COSAN       ON      NM', 'https://s3-symbol-logo.tradingview.com/cosan--big.svg', NULL, NULL, '2024-10-18 10:46:17'),
(104, 'CPLE6', 'COPEL       PNB     N2', 'https://s3-symbol-logo.tradingview.com/cia-paranaense--big.svg', NULL, NULL, '2024-10-18 10:46:06'),
(103, 'COGN3', 'COGNA ON    ON      NM', 'https://s3-symbol-logo.tradingview.com/cogna--big.svg', NULL, NULL, '2024-10-18 10:45:14'),
(102, 'CMIG4', 'CEMIG       PN      N1', 'https://s3-symbol-logo.tradingview.com/cemig--big.svg', '47', NULL, '2025-04-28 16:51:23'),
(101, 'CCRO3', 'CCR SA      ON      NM', 'https://s3-symbol-logo.tradingview.com/ccr--big.svg', NULL, NULL, '2024-10-18 10:44:43'),
(100, 'CRFB3', 'CARREFOUR BRON      NM', 'https://s3-symbol-logo.tradingview.com/carrefour--big.svg', NULL, NULL, '2024-10-18 10:44:32'),
(99, 'CXSE3', 'CAIXA SEGURION      NM', 'https://s3-symbol-logo.tradingview.com/caixa-segurion--big.svg', NULL, NULL, '2024-10-18 10:44:20'),
(98, 'BPAC11', 'BTGP BANCO  UNT     N2', 'https://s3-symbol-logo.tradingview.com/btgp--big.svg', NULL, NULL, '2024-10-18 10:44:08'),
(97, 'BRFS3', 'BRF SA      ON      NM', 'https://s3-symbol-logo.tradingview.com/brf-sa--big.svg', NULL, NULL, '2024-10-18 10:43:57'),
(96, 'BRAV3', 'BRAVA       ON      NM', 'https://brapi.dev/favicon.svg', NULL, NULL, '2024-10-18 10:43:46'),
(95, 'BRKM5', 'BRASKEM     PNA     N1', 'https://s3-symbol-logo.tradingview.com/braskem--big.svg', NULL, NULL, '2024-10-18 10:43:35'),
(94, 'BBAS3', 'BRASIL      ON      NM', 'https://s3-symbol-logo.tradingview.com/banco-do-brasil--big.svg', '42', NULL, '2024-10-18 02:17:00'),
(93, 'BRAP4', 'BRADESPAR   PN      N1', 'https://s3-symbol-logo.tradingview.com/bradespar--big.svg', NULL, NULL, '2024-10-18 10:43:20'),
(92, 'BBDC4', 'BRADESCO    PN  EJ  N1', 'https://s3-symbol-logo.tradingview.com/bradesco--big.svg', '40', NULL, '2025-04-28 16:58:04'),
(91, 'BBDC3', 'BRADESCO    ON  EJ  N1', 'https://s3-symbol-logo.tradingview.com/bradesco--big.svg', '39', NULL, '2025-04-28 16:57:21'),
(90, 'BBSE3', 'BBSEGURIDADEON      NM', 'https://s3-symbol-logo.tradingview.com/banco-do-brasil--big.svg', '308', NULL, '2024-10-18 02:17:53'),
(89, 'B3SA3', 'B3          ON      NM', 'https://s3-symbol-logo.tradingview.com/b3-on-nm--big.svg', NULL, NULL, '2024-10-18 10:42:16'),
(88, 'AZZA3', 'AZZAS 2154  ON      NM', 'https://s3-symbol-logo.tradingview.com/arezzo--big.svg', NULL, NULL, '2024-10-18 10:42:27'),
(87, 'AZUL4', 'AZUL        PN      N2', 'https://s3-symbol-logo.tradingview.com/azul--big.svg', NULL, NULL, '2024-10-18 10:41:59'),
(86, 'AURE3', 'AUREN       ON      NM', 'https://brapi.dev/favicon.svg', NULL, NULL, '2024-10-18 02:21:36'),
(85, 'ASAI3', 'ASSAI       ON      NM', 'https://s3-symbol-logo.tradingview.com/assai-on-nm--big.svg', NULL, NULL, '2024-10-18 10:41:47'),
(84, 'ABEV3', 'AMBEV S/A   ON', 'https://s3-symbol-logo.tradingview.com/ambev--big.svg', '64', NULL, '2025-04-28 16:51:58'),
(83, 'ALPA4', 'ALPARGATAS  PN      N1', 'https://s3-symbol-logo.tradingview.com/alpargatas--big.svg', '227', NULL, '2025-04-28 16:53:06'),
(82, 'ALOS3', 'ALLOS       ON  ED  NM', 'https://brapi.dev/favicon.svg', '656', NULL, '2025-04-28 16:52:35'),
(144, 'RADL3', 'RAIADROGASILON  EDJ NM', 'https://s3-symbol-logo.tradingview.com/raiadrogasilon--big.svg', NULL, NULL, '2024-10-18 10:57:43'),
(145, 'RAIZ4', 'RAIZEN      PN      N2', 'https://s3-symbol-logo.tradingview.com/raizen--big.svg', '616', NULL, '2024-10-22 02:22:05'),
(146, 'RDOR3', 'REDE D OR   ON      NM', 'https://s3-symbol-logo.tradingview.com/rede-d-or--big.svg', NULL, NULL, '2024-10-18 10:58:11'),
(147, 'RAIL3', 'RUMO S.A.   ON      NM', 'https://s3-symbol-logo.tradingview.com/rumo-s-a--big.svg', NULL, NULL, '2024-10-18 10:58:21'),
(148, 'SBSP3', 'SABESP      ON      NM', 'https://s3-symbol-logo.tradingview.com/sabesp--big.svg', NULL, NULL, '2024-10-18 10:58:32'),
(149, 'SANB11', 'SANTANDER BRUNT', 'https://s3-symbol-logo.tradingview.com/santander--big.svg', NULL, NULL, '2024-10-18 10:58:41'),
(150, 'STBP3', 'SANTOS BRP  ON      NM', 'https://s3-symbol-logo.tradingview.com/santos-brp--big.svg', NULL, NULL, '2024-10-18 10:59:14'),
(151, 'SMTO3', 'SAO MARTINHOON      NM', 'https://s3-symbol-logo.tradingview.com/sao-martinhoon--big.svg', NULL, NULL, '2024-10-18 10:59:23'),
(152, 'CSNA3', 'SID NACIONALON', 'https://s3-symbol-logo.tradingview.com/companhia-siderurgica-nacional--big.svg', NULL, NULL, '2024-10-18 10:59:38'),
(153, 'SLCE3', 'SLC AGRICOLAON      NM', 'https://s3-symbol-logo.tradingview.com/slc-agricola--big.svg', NULL, NULL, '2024-10-18 10:59:50'),
(154, 'SUZB3', 'SUZANO S.A. ON      NM', 'https://s3-symbol-logo.tradingview.com/suzano--big.svg', NULL, NULL, '2024-10-18 10:59:59'),
(155, 'TAEE11', 'TAESA       UNT     N2', 'https://s3-symbol-logo.tradingview.com/taesa--big.svg', NULL, NULL, '2024-10-18 11:00:09'),
(156, 'VIVT3', 'TELEF BRASILON', 'https://s3-symbol-logo.tradingview.com/telefonica--big.svg', NULL, NULL, '2024-10-18 11:00:29'),
(157, 'TIMS3', 'TIM         ON      NM', 'https://s3-symbol-logo.tradingview.com/tim-participacoes--big.svg', NULL, NULL, '2024-10-18 11:00:39'),
(158, 'TOTS3', 'TOTVS       ON      NM', 'https://s3-symbol-logo.tradingview.com/totvs--big.svg', NULL, NULL, '2024-10-18 11:00:47'),
(159, 'TRPL4', 'TRAN PAULISTPN      N1', 'https://s3-symbol-logo.tradingview.com/tran-paulistpn--big.svg', NULL, NULL, '2024-10-18 11:00:55'),
(160, 'UGPA3', 'ULTRAPAR    ON      NM', 'https://s3-symbol-logo.tradingview.com/ultrapar-participacoes--big.svg', NULL, NULL, '2024-10-18 11:01:10'),
(161, 'USIM5', 'USIMINAS    PNA     N1', 'https://s3-symbol-logo.tradingview.com/usiminas-pna-n1--big.svg', NULL, NULL, '2024-10-18 11:01:18'),
(162, 'VALE3', 'VALE        ON      NM', 'https://s3-symbol-logo.tradingview.com/vale--big.svg', '18', NULL, '2024-10-18 02:17:28'),
(163, 'VAMO3', 'VAMOS       ON      NM', 'https://s3-symbol-logo.tradingview.com/vamos-on-nm--big.svg', NULL, NULL, '2024-10-18 11:01:49'),
(164, 'VBBR3', 'VIBRA       ON      NM', 'https://s3-symbol-logo.tradingview.com/vibra-on-nm--big.svg', NULL, NULL, '2024-10-18 11:01:57'),
(165, 'VIVA3', 'VIVARA S.A. ON      NM', 'https://s3-symbol-logo.tradingview.com/vivara-sa-on-nm--big.svg', NULL, NULL, '2024-10-18 11:02:05'),
(166, 'WEGE3', 'WEG         ON      NM', 'https://s3-symbol-logo.tradingview.com/weg--big.svg', '22', NULL, '2024-10-18 02:16:42'),
(167, 'YDUQ3', 'YDUQS PART  ON      NM', 'https://s3-symbol-logo.tradingview.com/yduqs-part-on-nm--big.svg', NULL, NULL, '2024-10-18 11:02:21'),
(168, 'CSMG3', 'COPASA      ON      NM', 'https://s3-symbol-logo.tradingview.com/copasa--big.svg', '262', '2024-10-16 18:08:05', '2024-10-18 02:19:57'),
(169, 'ITUB3', 'ITAUUNIBANCOON      N1', 'https://s3-symbol-logo.tradingview.com/itau-unibanco--big.svg', '43', '2024-10-18 00:37:32', '2024-10-18 02:17:47'),
(170, 'AGRO3', 'BRASILAGRO  ON      NM', 'https://s3-symbol-logo.tradingview.com/brasilagro--big.svg', '320', '2024-10-18 00:40:00', '2024-10-18 11:02:32'),
(171, 'ITSA3', 'ITAUSA      ON      N1', 'https://s3-symbol-logo.tradingview.com/itausa--big.svg', '1', '2024-10-18 00:44:04', '2024-10-18 02:20:07'),
(172, 'TAEE3', 'TAESA       ON      N2', 'https://s3-symbol-logo.tradingview.com/taesa--big.svg', '36', '2024-10-18 00:56:31', '2024-10-18 02:17:35'),
(173, 'SAPR3', 'SANEPAR     ON      N2', 'https://s3-symbol-logo.tradingview.com/sanepar--big.svg', '23', '2024-10-18 01:01:01', '2024-10-18 02:18:08'),
(174, 'BHIA3', 'CASAS BAHIA ON      NM', 'https://brapi.dev/favicon.svg', '655', '2024-10-18 02:24:56', '2025-04-28 16:56:20'),
(175, 'AMER3', 'AMERICANAS  ON      NM', 'https://s3-symbol-logo.tradingview.com/americanas--big.svg', '622', '2024-10-18 02:27:03', '2025-04-28 16:54:51'),
(176, 'DASA3', 'DASA        ON      NM', 'https://s3-symbol-logo.tradingview.com/dasa-on-nm--big.svg', NULL, '2024-10-18 10:42:38', '2024-10-18 10:42:38'),
(177, 'KLBN3', 'KLABIN S/A  ON      N2', 'https://s3-symbol-logo.tradingview.com/klabin--big.svg', NULL, '2024-10-18 10:51:34', '2024-10-18 10:51:34'),
(178, 'KLBN4', 'KLABIN S/A  PN      N2', 'https://s3-symbol-logo.tradingview.com/klabin--big.svg', NULL, '2024-10-18 10:51:45', '2024-10-18 10:51:45'),
(179, 'SANB3', 'SANTANDER BRON', 'https://s3-symbol-logo.tradingview.com/santander--big.svg', NULL, '2024-10-18 10:58:55', '2024-10-18 10:58:55'),
(180, 'SANB4', 'SANTANDER BRPN', 'https://s3-symbol-logo.tradingview.com/santander--big.svg', NULL, '2024-10-18 10:59:04', '2024-10-18 10:59:04'),
(181, 'TAEE4', 'TAESA       PN      N2', 'https://s3-symbol-logo.tradingview.com/taesa--big.svg', NULL, '2024-10-18 11:00:15', '2024-10-18 11:00:15'),
(182, 'TRPL3', 'TRAN PAULISTON      N1', 'https://s3-symbol-logo.tradingview.com/tran-paulistpn--big.svg', '73', '2024-10-18 11:01:00', '2024-10-18 11:17:35'),
(183, 'USIM3', 'USIMINAS    ON      N1', 'https://s3-symbol-logo.tradingview.com/usiminas-pna-n1--big.svg', NULL, '2024-10-18 11:01:24', '2024-10-18 11:01:24'),
(184, 'SMFT3', 'SMART FIT   ON      NM', 'https://s3-symbol-logo.tradingview.com/smart-fit-on-nm--big.svg', NULL, '2024-10-21 20:27:44', '2024-10-21 20:27:44'),
(185, 'GGPS3', 'GPS         ON      NM', 'https://s3-symbol-logo.tradingview.com/gps-on-nm--big.svg', NULL, '2024-10-21 20:28:04', '2024-10-21 20:28:04'),
(186, 'BPAN4', 'BANCO PAN   PN      N1', 'https://s3-symbol-logo.tradingview.com/banco-pan--big.svg', NULL, '2024-10-21 20:28:21', '2024-10-21 20:28:21'),
(187, 'CEEB3', 'COELBA      ON', 'https://s3-symbol-logo.tradingview.com/coelba-pna--big.svg', NULL, '2024-10-21 20:28:32', '2024-10-21 20:28:32'),
(188, 'TFCO4', 'TRACK FIELD PN      N2', 'https://s3-symbol-logo.tradingview.com/track-field-pn-n2--big.svg', NULL, '2024-10-21 20:29:31', '2024-10-21 20:29:31'),
(189, 'POMO4', 'MARCOPOLO   PN      N2', 'https://s3-symbol-logo.tradingview.com/marcopolo--big.svg', NULL, '2024-10-21 20:29:45', '2024-10-21 20:29:45'),
(190, 'BNBR3', 'NORD BRASIL ON', 'https://s3-symbol-logo.tradingview.com/nord-brasil-on--big.svg', NULL, '2024-10-21 20:29:58', '2024-10-21 20:29:58'),
(191, 'NGRD3', 'NEOGRID     ON      NM', 'https://s3-symbol-logo.tradingview.com/neogrid--big.svg', NULL, '2024-10-21 20:31:26', '2024-10-21 20:31:26'),
(192, 'POSI3', 'POSITIVO TECON      NM', 'https://s3-symbol-logo.tradingview.com/positivo-tecon--big.svg', NULL, '2024-10-21 20:31:50', '2024-10-21 20:31:50'),
(193, 'ARML3', 'ARMAC       ON      NM', 'https://s3-symbol-logo.tradingview.com/armac-on-ed-nm--big.svg', NULL, '2024-10-21 20:32:18', '2024-10-21 20:32:18'),
(194, 'SYNE3', 'SYN PROP TECON      NM', 'https://s3-symbol-logo.tradingview.com/syn-prop-tecon-nm--big.svg', '129', '2024-10-21 20:32:34', '2024-10-22 02:27:33'),
(195, 'BMEB4', 'MERCANTIL   PN      N1', 'https://s3-symbol-logo.tradingview.com/merc-brasil-pn-n1--big.svg', NULL, '2024-10-21 20:33:02', '2024-10-21 20:33:02'),
(196, 'AMBP3', 'AMBIPAR     ON      NM', 'https://s3-symbol-logo.tradingview.com/ambipar--big.svg', '352', '2024-10-21 20:33:21', '2025-04-28 16:54:15'),
(211, 'CMIG3', 'CEMIG       ON      N1', 'https://icons.brapi.dev/icons/CMIG3.svg', '46', '2025-04-28 14:51:14', '2025-04-28 14:57:29'),
(198, 'SOJA3', 'BOA SAFRA   ON      NM', 'https://s3-symbol-logo.tradingview.com/boa-safra-on-nm--big.svg', NULL, '2024-10-21 20:33:58', '2024-10-21 20:33:58'),
(199, 'WHRL4', 'WHIRLPOOL   PN', 'https://s3-symbol-logo.tradingview.com/whirlpool-on--big.svg', NULL, '2024-10-21 20:35:12', '2024-10-21 20:35:12'),
(200, 'CGRA4', 'GRAZZIOTIN  PN', 'https://brapi.dev/favicon.svg', NULL, '2024-10-21 20:35:26', '2024-10-21 20:35:26'),
(201, 'MEAL3', 'IMC S/A     ON      NM', 'https://s3-symbol-logo.tradingview.com/imc-s-a-on-nm--big.svg', NULL, '2024-10-21 20:35:39', '2024-10-21 20:35:39'),
(202, 'CEAB3', 'CEA MODAS   ON      NM', 'https://s3-symbol-logo.tradingview.com/cea-modas-on-nm--big.svg', NULL, '2024-10-21 20:35:59', '2024-10-21 20:35:59'),
(203, 'ANIM3', 'ANIMA       ON      NM', 'https://s3-symbol-logo.tradingview.com/anima--big.svg', NULL, '2024-10-21 20:38:58', '2024-10-21 20:38:58'),
(204, 'TEND3', 'TENDA       ON      NM', 'https://s3-symbol-logo.tradingview.com/tenda--big.svg', NULL, '2024-10-21 20:39:17', '2024-10-21 20:39:17'),
(205, 'PTNT4', 'PETTENATI   PN', 'https://brapi.dev/favicon.svg', NULL, '2024-10-21 20:39:32', '2024-10-21 20:39:32'),
(206, 'AMAR3', 'LOJAS MARISAON      NM', 'https://s3-symbol-logo.tradingview.com/lojas-marisaon-nm--big.svg', '175', '2024-10-21 20:39:59', '2025-04-28 16:53:49'),
(207, 'ENJU3', 'ENJOEI      ON      NM', 'https://brapi.dev/favicon.svg', NULL, '2024-10-21 20:40:12', '2024-10-21 20:40:12'),
(208, 'GFSA3', 'GAFISA      ON      NM', 'https://s3-symbol-logo.tradingview.com/gafisa--big.svg', NULL, '2024-10-21 20:40:26', '2024-10-21 20:40:26'),
(209, 'CSED3', 'CRUZEIRO EDUON      NM', 'https://s3-symbol-logo.tradingview.com/cruzeiro-eduon-nm--big.svg', NULL, '2024-10-21 20:40:37', '2024-10-21 20:40:37'),
(210, 'CEBR3', 'CEB         ON', 'https://brapi.dev/favicon.svg', '423', '2024-10-22 02:30:02', '2024-10-22 02:30:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Aurélio', 'aureliomachados@gmail.com', NULL, '$2y$12$Ja4LkZHHxaOc71yY2gM5WuZvBbj4s9xt9snnp5GQ91zF3ZfDxXteS', 'S5mEHCVy9rAg2e1iH8qVD7QTpI8Q3Et4iwEvXpYVdYk1dtj4KpprpSwAj9ZT', '2024-10-01 18:36:19', '2024-10-01 18:36:19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_stocks`
--

DROP TABLE IF EXISTS `user_stocks`;
CREATE TABLE IF NOT EXISTS `user_stocks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `stock_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_stocks_user_id_foreign` (`user_id`),
  KEY `user_stocks_stock_id_foreign` (`stock_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `user_stocks`
--

INSERT INTO `user_stocks` (`id`, `user_id`, `stock_id`, `created_at`, `updated_at`) VALUES
(18, 1, 162, NULL, NULL),
(22, 1, 107, NULL, NULL),
(19, 1, 142, NULL, NULL),
(30, 1, 168, NULL, NULL),
(31, 1, 169, NULL, NULL),
(33, 1, 171, NULL, NULL),
(27, 1, 166, NULL, NULL),
(32, 1, 170, NULL, NULL),
(34, 1, 90, NULL, NULL),
(35, 1, 94, NULL, NULL),
(36, 1, 139, NULL, NULL),
(37, 1, 173, NULL, NULL),
(50, 1, 211, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
