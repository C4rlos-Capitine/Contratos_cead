-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 16, 2024 at 04:37 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contratos4`
--

-- --------------------------------------------------------

--
-- Table structure for table `ano_contratos`
--

DROP TABLE IF EXISTS `ano_contratos`;
CREATE TABLE IF NOT EXISTS `ano_contratos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ano_contrato` year NOT NULL,
  `estagio_in_ano_contrato` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ano_contratos`
--

INSERT INTO `ano_contratos` (`id`, `ano_contrato`, `estagio_in_ano_contrato`, `created_at`, `updated_at`) VALUES
(1, '2024', 1, '2024-07-13 12:17:33', '2024-07-13 12:17:33'),
(2, '2025', 1, '2024-07-13 12:17:37', '2024-07-13 12:17:37'),
(3, '2026', 1, '2024-07-14 12:39:12', '2024-07-14 12:39:12'),
(4, '2027', 1, '2024-07-15 11:22:00', '2024-07-15 11:22:00'),
(5, '2028', 1, '2024-08-20 17:45:00', '2024-08-20 17:45:00'),
(6, '2029', 1, '2024-08-20 18:03:32', '2024-08-20 18:03:32'),
(7, '2030', 1, '2024-09-01 13:09:43', '2024-09-01 13:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `area_cientificas`
--

DROP TABLE IF EXISTS `area_cientificas`;
CREATE TABLE IF NOT EXISTS `area_cientificas` (
  `cod_area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designacao_area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cod_area`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `area_cientificas`
--

INSERT INTO `area_cientificas` (`cod_area`, `designacao_area`, `created_at`, `updated_at`) VALUES
('INF', 'Informática', '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
('MAT', 'Matemática', '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
('FIS', 'Fisica', '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
('CPG', 'Componente de Formação Geral', NULL, NULL),
('CFP', 'Pedagogia', NULL, NULL),
('PsiCoG', 'Psicologia', NULL, NULL),
('ELETR', 'Electónica', NULL, NULL),
('TELECOM', 'Telecomunicações', NULL, NULL),
('PORT', 'Português', NULL, NULL),
('INGL', 'Ingleês', NULL, NULL),
('FIL', 'Filosofia', NULL, NULL),
('FIS-DD', 'Didatica de Fisica', NULL, NULL),
('MAT-DD', 'Didatica de Matemática', NULL, NULL),
('ANTR', 'Antropologia Cultural', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `area_docente`
--

DROP TABLE IF EXISTS `area_docente`;
CREATE TABLE IF NOT EXISTS `area_docente` (
  `id_docente` int NOT NULL,
  `id_area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_docente`,`id_area`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `area_docente`
--

INSERT INTO `area_docente` (`id_docente`, `id_area`, `created_at`, `updated_at`) VALUES
(69, 'INF', '2024-09-01 11:36:14', '2024-09-01 11:36:14'),
(70, 'INF', '2024-09-01 11:39:36', '2024-09-01 11:39:36'),
(75, 'MAT', '2024-09-01 13:59:50', '2024-09-01 13:59:50'),
(75, 'MAT-DD', '2024-09-01 14:00:04', '2024-09-01 14:00:04'),
(76, 'FIS-DD', '2024-09-01 14:02:42', '2024-09-01 14:02:42'),
(77, 'INGL', '2024-09-01 14:14:21', '2024-09-01 14:14:21'),
(77, 'PORT', '2024-09-01 14:14:39', '2024-09-01 14:14:39'),
(78, 'CFP', '2024-09-02 07:26:56', '2024-09-02 07:26:56'),
(78, 'PsiCoG', '2024-09-02 07:27:09', '2024-09-02 07:27:09'),
(78, 'FIL', '2024-09-02 07:27:25', '2024-09-02 07:27:25'),
(78, 'ANTR', '2024-09-02 07:27:35', '2024-09-02 07:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_cat_disciplina` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `designacao_categoria` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cat_disciplina`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_cat_disciplina`, `designacao_categoria`, `created_at`, `updated_at`) VALUES
(1, 'Tronco Comum', '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
(2, 'Específica', '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
(3, 'Laboratórial', '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
(4, 'Tema Tranvesal', '2024-07-13 10:35:16', '2024-07-13 10:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `centro_curso_centro`
--

DROP TABLE IF EXISTS `centro_curso_centro`;
CREATE TABLE IF NOT EXISTS `centro_curso_centro` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `centro_recursos`
--

DROP TABLE IF EXISTS `centro_recursos`;
CREATE TABLE IF NOT EXISTS `centro_recursos` (
  `id_centro` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_centro` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_centro`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centro_recursos`
--

INSERT INTO `centro_recursos` (`id_centro`, `nome_centro`, `created_at`, `updated_at`) VALUES
(1, 'Lhanguene', '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
(2, 'Namaancha', '2024-07-13 10:35:16', '2024-07-13 10:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `contratos`
--

DROP TABLE IF EXISTS `contratos`;
CREATE TABLE IF NOT EXISTS `contratos` (
  `id_docente_in_contrato` int NOT NULL,
  `id_tipo_contrato_in_contrato` int NOT NULL,
  `ano_contrato` year NOT NULL,
  `carga_horaria` int NOT NULL,
  `remuneracao` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_docente_in_contrato`,`ano_contrato`,`id_tipo_contrato_in_contrato`),
  KEY `contratos_id_tipo_contrato_in_contrato_foreign` (`id_tipo_contrato_in_contrato`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contratos`
--

INSERT INTO `contratos` (`id_docente_in_contrato`, `id_tipo_contrato_in_contrato`, `ano_contrato`, `carga_horaria`, `remuneracao`, `created_at`, `updated_at`) VALUES
(78, 1, '2030', 31, 24800, '2024-09-02 07:40:14', '2024-09-02 07:40:14'),
(1, 1, '2024', 440, 440000, '2024-09-02 07:46:43', '2024-09-02 07:46:43'),
(3, 1, '2024', 410, 410000, '2024-09-02 07:47:12', '2024-09-02 07:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `contrato_laboratorios`
--

DROP TABLE IF EXISTS `contrato_laboratorios`;
CREATE TABLE IF NOT EXISTS `contrato_laboratorios` (
  `id_tecnico` int NOT NULL,
  `codigo_disciplina` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_curso` int NOT NULL,
  `ano_contrato` year NOT NULL,
  `remuneracao_hora` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tecnico`,`ano_contrato`,`codigo_disciplina`),
  KEY `contrato_laboratorios_id_curso_foreign` (`id_curso`),
  KEY `contrato_laboratorios_codigo_disciplina_foreign` (`codigo_disciplina`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `designacao_curso` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sigla_curso` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_faculdade_in_curso` int NOT NULL,
  `id_docente_dir_curso` int DEFAULT NULL,
  `id_centro_in_curso` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `cursos_id_centro_in_curso_foreign` (`id_centro_in_curso`),
  KEY `cursos_id_faculdade_in_curso_foreign` (`id_faculdade_in_curso`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id_curso`, `designacao_curso`, `sigla_curso`, `id_faculdade_in_curso`, `id_docente_dir_curso`, `id_centro_in_curso`, `created_at`, `updated_at`) VALUES
(1, 'Informática', 'INF', 1, NULL, 1, '2024-07-13 10:53:45', '2024-07-13 10:53:45'),
(2, 'Fisica', 'FIS', 2, NULL, 1, '2024-07-13 10:54:09', '2024-07-13 10:54:09'),
(3, 'Matematica', 'MAT', 2, NULL, 1, '2024-07-13 10:54:24', '2024-07-13 10:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `curso_centro_recurso`
--

DROP TABLE IF EXISTS `curso_centro_recurso`;
CREATE TABLE IF NOT EXISTS `curso_centro_recurso` (
  `id_centro` int NOT NULL,
  `id_curso` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_centro`,`id_curso`),
  KEY `curso_centro_recurso_id_curso_foreign` (`id_curso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disciplinas`
--

DROP TABLE IF EXISTS `disciplinas`;
CREATE TABLE IF NOT EXISTS `disciplinas` (
  `codigo_disciplina` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_curso_in_disciplina` int NOT NULL,
  `nome_disciplina` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano` int NOT NULL,
  `semestre` int NOT NULL,
  `sigla_disciplina` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cat_disciplina` int NOT NULL,
  `cod_area_in_disciplina` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `horas_contacto` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`codigo_disciplina`),
  KEY `disciplinas_cod_area_in_disciplina_foreign` (`cod_area_in_disciplina`),
  KEY `disciplinas_id_curso_in_disciplina_foreign` (`id_curso_in_disciplina`),
  KEY `disciplinas_id_cat_disciplina_foreign` (`id_cat_disciplina`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disciplinas`
--

INSERT INTO `disciplinas` (`codigo_disciplina`, `id_curso_in_disciplina`, `nome_disciplina`, `ano`, `semestre`, `sigla_disciplina`, `id_cat_disciplina`, `cod_area_in_disciplina`, `horas_contacto`, `created_at`, `updated_at`) VALUES
('MATAL', 3, 'Algebra Linear 1', 1, 1, 'AL1', 2, 'MAT', 31, '2024-07-13 11:39:45', '2024-07-13 11:39:45'),
('MATCI', 3, 'Cálculo Infinitesimal', 1, 1, 'CI', 2, 'MAT', 31, '2024-07-13 11:42:08', '2024-07-13 11:42:08'),
('MATLTC', 3, 'Lógica e Teoria dos Conjuntos', 1, 1, 'LTC', 2, 'MAT', 31, '2024-07-13 11:43:05', '2024-07-13 11:43:05'),
('MATTIC', 3, 'TIC\'s', 1, 1, 'TIC', 1, 'INF', 18, '2024-07-13 11:44:35', '2024-07-13 11:44:35'),
('MATFP', 3, 'Fundamentos de Pedagogia', 1, 1, 'FP', 1, 'CFP', 18, '2024-07-13 11:45:46', '2024-07-13 11:45:46'),
('MATPsiG', 3, 'Psicologia Geral', 1, 1, 'PG', 1, 'PsiCoG', 31, '2024-07-13 11:49:11', '2024-07-13 11:49:11'),
('MATCIR', 3, 'Cálculo Integral em R', 1, 2, 'CI-R', 1, 'MAT', 38, '2024-07-13 11:50:43', '2024-07-13 11:50:43'),
('MATAL2', 3, 'Algebra Linear 2', 1, 2, 'AL2', 2, 'MAT', 38, '2024-07-13 11:51:28', '2024-07-13 11:51:28'),
('INFTIC', 1, 'TIC\'s', 1, 1, 'TIC', 2, 'INF', 18, '2024-07-13 11:53:02', '2024-07-13 11:53:02'),
('INFAP', 1, 'Algoritmização e Programação', 1, 1, 'AP', 2, 'INF', 44, '2024-07-13 11:53:57', '2024-07-13 11:53:57'),
('INFALGA', 1, 'Algebra Linear e Geometria Analitica', 1, 1, 'ALGA', 2, 'MAT', 25, '2024-07-13 11:54:53', '2024-07-13 11:54:53'),
('INFAM', 1, 'Análise Matemática', 1, 1, 'AM', 2, 'MAT', 6, '2024-07-13 11:55:33', '2024-07-13 11:55:33'),
('INFMEU', 1, 'Metodos de Estudos Universitários', 1, 1, 'MEU', 1, 'CPG', 18, '2024-07-13 11:56:32', '2024-07-13 11:56:32'),
('MATMEU', 3, 'Metodos de Estudos Universitários', 1, 1, 'MEU', 1, 'CPG', 18, '2024-07-13 11:57:28', '2024-07-13 11:57:28'),
('INFPOO', 1, 'Programação Orientada a Objectos', 1, 1, 'POO', 2, 'INF', 44, '2024-07-13 11:59:36', '2024-07-13 11:59:36'),
('INFEB', 1, 'Electrónica Básica', 1, 1, 'EB', 1, 'ELETR', 25, '2024-07-13 12:02:13', '2024-07-13 12:02:13'),
('INFFTC', 1, 'Fundamentos de Telecomunicações', 1, 2, 'FTC', 2, 'TELECOM', 31, '2024-07-13 12:03:15', '2024-07-13 12:03:15'),
('INFEDA', 1, 'Estruturas de Dados e Algoritmos', 1, 2, 'EDA', 2, 'INF', 38, '2024-07-13 12:04:08', '2024-07-13 12:04:08'),
('INFPDM', 1, 'Programação para dispositivos Móveis', 2, 1, 'PDM', 2, 'INF', 44, '2024-07-13 12:05:42', '2024-07-13 12:05:42'),
('INFRC', 1, 'Redes de Computadores', 2, 1, 'RC', 2, 'INF', 38, '2024-07-13 12:06:22', '2024-07-13 12:06:22'),
('INFRM', 1, 'Redes Móveis', 2, 1, 'RM', 2, 'TELECOM', 38, '2024-07-13 12:07:08', '2024-07-13 12:07:08'),
('FISTIC', 2, 'TIC\'s', 1, 1, 'TIC', 1, 'INF', 18, '2024-07-13 12:08:22', '2024-07-13 12:08:22'),
('FISMEU', 2, 'Metodos de Estudos Universitários', 1, 1, 'MEU', 1, 'CPG', 18, '2024-07-13 12:09:43', '2024-07-13 12:09:43'),
('FISFP', 2, 'Fundamentos de Pedagogia', 1, 1, 'FP', 1, 'CFP', 25, '2024-07-13 12:11:03', '2024-07-13 12:11:03'),
('FISMC', 2, 'Mecânica Classica', 1, 1, 'MC', 2, 'FIS', 38, '2024-07-13 12:11:54', '2024-07-13 12:11:54'),
('FISLABMC', 2, 'Laboratório de Mecânica Classica', 1, 1, 'LBMC', 2, 'FIS', 38, '2024-07-13 12:12:45', '2024-07-13 12:12:45'),
('FISMF1', 2, 'Matematica para Fisicos 1', 1, 1, 'MF1', 2, 'MAT', 38, '2024-07-13 12:13:35', '2024-07-13 12:13:35'),
('FISMF2', 2, 'Mátematica para fisicos 2', 1, 2, 'MF2', 2, 'MAT', 38, '2024-07-13 12:14:26', '2024-07-13 12:14:26'),
('INFSO', 1, 'Sistemas Operativos', 2, 2, 'SO', 2, 'INF', 31, '2024-07-13 12:23:37', '2024-07-13 12:23:37'),
('INFAC', 1, 'Arquitectura de Computadores', 1, 2, 'AC', 2, 'INF', 31, '2024-07-13 12:24:24', '2024-07-13 12:24:24'),
('MATPPG', 3, 'Práticas Pedagógicas Gerais', 1, 2, 'PPG', 1, 'CFP', 25, '2024-07-18 14:09:51', '2024-07-18 14:09:51'),
('MATDG', 3, 'Didatica Geral', 1, 2, 'DG', 1, 'CFP', 25, '2024-07-18 14:10:57', '2024-07-18 14:10:57'),
('MATFF', 3, 'Fundamentos de Filosofia', 1, 2, 'FF', 1, 'FIL', 18, '2024-08-10 13:53:39', '2024-08-10 13:53:39'),
('MAT_INGL', 3, 'Inglês', 2, 1, 'INGL', 1, 'INGL', 25, '2024-07-18 14:16:25', '2024-07-18 14:16:25'),
('INFTRP', 1, 'Tecnologias de redes e Protocolos', 2, 2, 'TRP', 2, 'INF', 25, '2024-08-10 12:00:27', '2024-08-10 12:00:27'),
('INFGRS', 1, 'Gestão de Redes e Serviços', 3, 1, 'GRS', 2, 'INF', 38, '2024-08-10 12:01:31', '2024-08-10 12:01:31'),
('INFRA', 1, 'Redes IP Avançadas', 3, 2, 'RA', 2, 'TELECOM', 25, '2024-08-10 12:02:56', '2024-08-10 12:02:56'),
('INFDW', 1, 'Design Web', 2, 1, 'DW', 2, 'INF', 38, '2024-08-10 12:03:41', '2024-08-10 12:03:41'),
('INFFBD', 1, 'Fundamentos de Base de Dados', 1, 2, 'FB', 2, 'INF', 44, '2024-08-10 12:05:07', '2024-08-10 12:05:07'),
('INFBDA', 1, 'Base de Dados Avançada', 2, 1, 'BDA', 2, 'INF', 44, '2024-08-10 12:06:03', '2024-08-10 12:06:03'),
('INFES1', 1, 'Engenharia de Software 1', 2, 1, 'ES1', 2, 'INF', 31, '2024-08-10 12:06:57', '2024-08-10 12:06:57'),
('INFES2', 1, 'Engenharia de Software 2', 2, 2, 'ES2', 2, 'INF', 31, '2024-08-10 12:07:36', '2024-08-10 12:07:36'),
('FISDG', 2, 'Didatica Geral', 1, 2, 'DG', 1, 'CFP', 31, '2024-08-10 12:26:44', '2024-08-10 12:26:44'),
('FISPPG', 2, 'Práticas Pedagógicas Gerais', 1, 2, 'PPG', 1, 'CFP', 31, '2024-08-10 12:27:43', '2024-08-10 12:27:43'),
('FISTTCM', 2, 'Termodinamica e Teoria Cinética Molecular', 1, 2, 'TTCM', 2, 'FIS', 38, '2024-08-10 12:29:22', '2024-08-10 12:29:22'),
('FISLTTCM', 2, 'Laboratório de Termodinamica e Teoria Cinética Molecular', 1, 2, 'LTTCM', 2, 'FIS', 31, '2024-08-10 12:30:37', '2024-08-10 12:30:37'),
('FISFF', 2, 'Fundamentos de Filosofia', 1, 2, 'FF', 1, 'FIL', 25, '2024-08-10 12:33:19', '2024-08-10 12:33:19'),
('FISDF1', 2, 'Didatica de Fisica 1', 2, 1, 'DF1', 2, 'FIS-DD', 18, '2024-08-10 12:38:57', '2024-08-10 12:38:57'),
('FISEM', 2, 'Electricidade e Magnetismo', 2, 1, 'EM', 2, 'FIS', 25, '2024-08-10 12:39:55', '2024-08-10 12:39:55'),
('FISLEM', 2, 'Laboratório de Electricidade e Magnetismo', 2, 1, 'LEM', 2, 'FIS', 25, '2024-08-10 12:40:44', '2024-08-10 12:40:44'),
('FISFMO', 2, 'Fundamentos de Metereologia e Oceanografia', 2, 1, 'FMO', 2, 'FIS', 31, '2024-08-10 12:42:41', '2024-08-10 12:42:41'),
('FISING', 2, 'Inglês', 2, 1, 'ING', 1, 'INGL', 18, '2024-08-10 12:43:34', '2024-08-10 12:43:34'),
('FISPPDF1', 2, 'Práticas Pedagógicas de Didatica de Fisica 1', 2, 1, 'PPDF1', 2, 'FIS-DD', 25, '2024-08-10 12:44:52', '2024-08-10 12:44:52'),
('FISANTR', 2, 'Antropologia Cultural', 2, 2, 'ANTR', 1, 'ANTR', 18, '2024-08-10 12:50:48', '2024-08-10 12:50:48'),
('FISPA', 2, 'Psicologia de Aprendizagem', 2, 2, 'PA', 1, 'PsiCoG', 25, '2024-08-10 12:51:37', '2024-08-10 12:51:37'),
('FISMT', 2, 'Mecânica Teórica', 2, 2, 'MT', 2, 'FIS', 31, '2024-08-10 12:52:22', '2024-08-10 12:52:22'),
('FISNEE', 2, 'Necessidades Educativas Especiais', 2, 2, 'NEE', 1, 'CFP', 25, '2024-08-10 12:53:32', '2024-08-10 12:53:32'),
('FIS-OOO', 2, 'Oscilações, Ondas e Optica', 2, 2, 'OOO', 2, 'FIS', 25, '2024-08-10 12:54:46', '2024-08-10 12:54:46'),
('FIS-LOOO', 2, 'Laboratório de Oscilações, Ondas e Optica', 2, 2, 'LOOO', 2, 'FIS', 31, '2024-08-10 12:55:38', '2024-08-10 12:55:38'),
('MATGE 1', 3, 'Geometria Euclidiana 1', 1, 2, 'GE1', 2, 'MAT', 31, '2024-08-10 13:54:37', '2024-08-10 13:54:37'),
('MAT-CDRN', 3, 'Cálculo Diferencial em Rn', 2, 1, 'CDRN', 2, 'MAT', 31, '2024-08-10 13:56:00', '2024-08-10 13:56:00'),
('MAT-CIRN', 3, 'Calculo Integral em RN', 2, 2, 'CIRN', 2, 'MAT', 31, '2024-08-10 13:56:39', '2024-08-10 13:56:39'),
('MATANTR', 3, 'Antropologia Cultural', 2, 2, 'ANTR', 1, 'ANTR', 31, '2024-08-10 13:58:16', '2024-08-10 13:58:16'),
('MATPA', 3, 'Psicologia de Aprendizagem', 2, 2, 'PA', 1, 'PsiCoG', 25, '2024-08-10 13:59:21', '2024-08-10 13:59:21'),
('MATNEE', 3, 'Necessidades educativas Especiais', 2, 2, 'NEE', 1, 'CFP', 38, '2024-08-10 14:00:17', '2024-08-10 14:00:17'),
('MATGD', 3, 'Geometria Descritiva', 2, 2, 'GD', 2, 'MAT', 31, '2024-08-10 14:01:08', '2024-08-10 14:01:08'),
('MATTN', 3, 'Teoria de Números', 2, 2, 'TN', 2, 'MAT', 38, '2024-08-10 14:01:43', '2024-08-10 14:01:43'),
('MATINGL', 3, 'Englês', 2, 1, 'ING', 1, 'INGL', 31, '2024-08-10 14:02:29', '2024-08-10 14:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `docentes`
--

DROP TABLE IF EXISTS `docentes`;
CREATE TABLE IF NOT EXISTS `docentes` (
  `id_docente` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_docente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apelido_docente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nacionalidade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nuit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_nivel` int NOT NULL,
  `genero` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_faculdade_in_docente` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_docente`),
  UNIQUE KEY `docentes_email_unique` (`email`),
  KEY `docentes_id_nivel_foreign` (`id_nivel`),
  KEY `docentes_id_faculdade_in_docente_foreign` (`id_faculdade_in_docente`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `docentes`
--

INSERT INTO `docentes` (`id_docente`, `nome_docente`, `apelido_docente`, `nacionalidade`, `bi`, `nuit`, `id_nivel`, `genero`, `id_faculdade_in_docente`, `id_user`, `email`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'Vadinacio Paulo', 'Martins', 'Moçambicano', '112148457545s', '11444577', 2, 'masculino', 1, NULL, 'valdo@gmail.com', NULL, '2024-07-13 11:07:43', '2024-07-13 11:07:43'),
(2, 'Ricardo Januário', 'Uainda', 'Moçambicano', '112148457245s', '11434577', 2, 'masculino', 1, NULL, 'ricardo@gmail.com', NULL, '2024-07-13 11:10:23', '2024-07-13 11:10:23'),
(3, 'Aurélio Armando Ribeiro', 'Pires', 'Moçambicano', '113148457245s', '11934577', 2, 'masculino', 1, NULL, 'ribas@gmail.com', NULL, '2024-07-13 11:13:38', '2024-07-13 11:13:38'),
(4, 'Claudia Ivete', 'Jovo', 'Moçambicano', '411111111111s', '55444584', 2, 'masculino', 1, NULL, 'cjovo@gmail.com', NULL, '2024-07-13 11:15:18', '2024-07-13 11:15:18'),
(5, 'Elisio', 'Tivane', 'Moçambicano', '115488845444s', '98845421', 3, 'masculino', 2, NULL, 'elisio@gmail.com', NULL, '2024-07-13 11:16:29', '2024-07-13 11:16:29'),
(6, 'Salomão', 'Munguambe', 'Moçambicano', '112554885245s', '11445415', 1, 'masculino', 2, NULL, 'sa@gmal.com', NULL, '2024-07-13 11:17:17', '2024-07-13 11:17:17'),
(7, 'Amandio', 'António', 'Moçambicano', '115458848845q', '11121254', 2, 'masculino', 2, NULL, 'amandio@gmail.com', NULL, '2024-07-13 11:20:50', '2024-07-13 11:20:50'),
(8, 'Jó', 'Capace', 'Moçambicano', '154888454545s', '12548875', 3, 'masculino', 2, NULL, 'jo@gmail.com', NULL, '2024-07-13 11:21:35', '2024-07-13 11:21:35'),
(9, 'Arsénio José', 'Mindú', 'Moçambicano', '158414444547s', '21214488', 3, 'masculino', 2, NULL, 'arsenio@gmil.com', NULL, '2024-07-13 11:22:49', '2024-07-13 11:22:49'),
(10, 'Maria Lúcia', 'Fernando', 'Moçambicano', '125445845545q', '85445821', 2, 'masculino', 2, NULL, 'maria@gmail.com', NULL, '2024-07-13 11:23:54', '2024-07-13 11:23:54'),
(11, 'Adriano', 'Niquice', 'Moçambicano', '121100012547s', '14541268', 2, 'masculino', 2, NULL, 'adri@gmail.com', NULL, '2024-07-13 11:24:52', '2024-07-13 11:24:52'),
(12, 'Alberto Antonio', 'Uamusse', 'Moçambicano', '101110104444s', '44588454', 3, 'masculino', 2, NULL, 'alb@gmail.com', NULL, '2024-07-13 11:25:49', '2024-07-13 11:25:49'),
(13, 'Lúcio Francisco', 'Afo', 'Moçambicano', '101187841115q', '11558168', 2, 'masculino', 2, NULL, 'lu@gmail.com', NULL, '2024-07-13 11:26:49', '2024-07-13 11:26:49'),
(14, 'Armando Elisio', 'Maxlhaieie', 'Moçambicano', '125458441212s', '99881154', 1, 'masculino', 1, NULL, 'maxa@gmail.com', NULL, '2024-07-13 12:16:57', '2024-07-13 12:16:57'),
(15, 'Ezar Esau', 'Nharrelunga', 'Moçambicano', '112548454545s', '12589565', 2, 'masculino', 2, NULL, 'ezar@gmail.com', NULL, '2024-07-13 12:20:30', '2024-07-13 12:20:30'),
(16, 'Uranio Stafane', 'Mahanjane', 'Moçambicano', '141101114544s', '88954145', 3, 'masculino', 1, NULL, 'uranio@gmail.com', NULL, '2024-07-13 12:21:33', '2024-07-13 12:21:33'),
(17, 'Ambrósio Patricio', 'Vumo', 'Moçambicano', '101112544574s', '22358421', 2, 'masculino', 1, NULL, 'vumo@gmail.com', NULL, '2024-07-13 12:22:18', '2024-07-13 12:22:18'),
(18, 'José', 'Flores', 'Moçambicano', '100112545455s', '12154865', 2, 'masculino', 2, NULL, 'joseflores@gmail.com', NULL, '2024-07-18 13:54:33', '2024-07-18 13:54:33'),
(19, 'Júlio', 'Gonçalves', 'Moçambicano', '110615225411s', '98752125', 1, 'masculino', 2, NULL, 'jgncalves@gmail.com', NULL, '2024-07-18 13:55:51', '2024-07-18 13:55:51'),
(20, 'Felizardo', 'Raite', 'Moçambicano', '110112544542q', '58725215', 2, 'masculino', 3, NULL, 'felizardo@gmail.com', NULL, '2024-07-18 13:56:53', '2024-07-18 13:56:53'),
(21, 'Domingos', 'Uchavo', 'Moçambicano', '210011255444d', '45112548', 2, 'masculino', 2, NULL, 'domingos@gmail.com', NULL, '2024-07-18 13:58:44', '2024-07-18 13:58:44'),
(22, 'Celso', 'Mateus', 'Moçambicano', '110111445521s', '55411254', 2, 'masculino', 2, NULL, 'celso@gmail.com', NULL, '2024-07-18 13:59:38', '2024-07-18 13:59:38'),
(23, 'Eugenio Albeto', 'Macumbe', 'Moçambicano', '110112255412s', '54668421', 2, 'masculino', 1, NULL, 'emacumbe@gmail.com', NULL, '2024-07-18 14:00:21', '2024-07-18 14:00:21'),
(24, 'Margarida Lazaro', 'Simão', 'Moçambicano', '112554488452p', '99545112', 2, 'Femenino', 2, NULL, 'magui@gmail.com', NULL, '2024-07-18 14:01:31', '2024-07-18 14:01:31'),
(25, 'Xavier', 'Bila', 'Moçambicano', '101101154584s', '12441144', 1, 'masculino', 1, NULL, 'xavi@gmail.com', NULL, '2024-07-18 14:02:17', '2024-07-18 14:02:17'),
(26, 'Mateus', 'Honwana', 'Moçambicano', '111255545844s', '25445841', 2, 'masculino', 3, NULL, 'mateus@gmail.com', NULL, '2024-07-18 14:20:25', '2024-07-18 14:20:25'),
(27, 'Faizal Eduardo', 'Licumba', 'Moçambicano', '554488877844s', '22554588', 1, 'masculino', 1, NULL, 'faizal@gmail.com', NULL, '2024-08-10 10:12:31', '2024-08-10 10:12:31'),
(28, 'Xavier', 'Bila', 'Moçambicano', '554488877244s', '22754588', 1, 'masculino', 1, NULL, 'xavierl@gmail.com', NULL, '2024-08-10 10:12:59', '2024-08-10 10:12:59'),
(29, 'Veloso', 'Dava', 'Moçambicano', '444444444444q', '22554484', 2, 'masculino', 2, NULL, 'veloso@gmail.com', NULL, '2024-08-10 10:20:58', '2024-08-10 10:20:58'),
(30, 'Nádia Yolanda', 'Dos Santos', 'Moçambicano', '887777777777p', '55445584', 2, 'femenino', 2, NULL, 'nadia@gmail.com', NULL, '2024-08-10 13:03:17', '2024-08-10 13:03:17'),
(31, 'Alberto Felisberto', 'Cupane', 'Moçambicano', '887777877777p', '55419584', 2, 'masculino', 2, NULL, 'alberto.felisberto@gmail.com', NULL, '2024-08-10 13:04:10', '2024-08-10 13:04:10'),
(32, 'Agostinho Barreto', 'Coeteze', 'Moçambicano', '554455445444s', '55544584', 2, 'masculino', 2, NULL, 'agostinho.barreto@gmail.com', NULL, '2024-08-10 13:07:47', '2024-08-10 13:07:47'),
(33, 'Luísa Franciaco', 'Almeida', 'Moçambicano', '554455445445s', '22254545', 3, 'femenino', 2, NULL, 'luisa@gmail.com', NULL, '2024-08-10 13:10:43', '2024-08-10 13:10:43'),
(34, 'Elena Stepanova', 'Munguane', 'Moçambicano', '154455445445s', '12254545', 2, 'femenino', 2, NULL, 'elena@gmail.com', NULL, '2024-08-10 13:11:23', '2024-08-10 13:11:23'),
(35, 'Herieta', 'Massango', 'Moçambicano', '154455449445s', '12294545', 2, 'femenino', 2, NULL, 'Herieta@gmail.com', NULL, '2024-08-10 13:12:33', '2024-08-10 13:12:33'),
(36, 'Dércia', 'Chilengue', 'Moçambicano', '154455449945s', '92294545', 2, 'femenino', 2, NULL, 'dercia.chilengue@gmail.com', NULL, '2024-08-10 13:13:36', '2024-08-10 13:13:36'),
(37, 'Sara', 'Mondlane', 'Moçambicano', '154455449945q', '92294548', 2, 'femenino', 2, NULL, 'sara.mondkane@gmail.com', NULL, '2024-08-10 13:14:22', '2024-08-10 13:14:22'),
(38, 'Ecelina', 'Nhantumbo', 'Moçambicano', '154465449945q', '92694548', 2, 'femenino', 2, NULL, 'ecelina@gmail.com', NULL, '2024-08-10 13:15:03', '2024-08-10 13:15:03'),
(39, 'Alfredo', 'Ramigio', 'Moçambicano', '333465449945q', '33694548', 2, 'femenino', 3, NULL, 'alfredo@gmail.com', NULL, '2024-08-10 13:16:13', '2024-08-10 13:16:13'),
(40, 'Rosa', 'Muchine', 'Moçambicano', '333465449945s', '33694599', 2, 'femenino', 3, NULL, 'rmuchine@gmail.com', NULL, '2024-08-10 13:16:52', '2024-08-10 13:16:52'),
(41, 'Amós', 'Veremachi', 'Moçambicano', '333555449945s', '33698899', 2, 'masculino', 3, NULL, 'veremachi@gmail.com', NULL, '2024-08-10 13:17:41', '2024-08-10 13:17:41'),
(42, 'Lúcia Suzete', 'Simbine', 'Moçambicano', '844545841254s', '12545821', 1, 'femenino', 2, NULL, 'suzete@gmail.com', NULL, '2024-08-10 13:19:31', '2024-08-10 13:19:31'),
(43, 'Jair', 'Tomás', 'Moçambicano', '544777447444s', '22545887', 1, 'masculino', 2, NULL, 'jair@gmail.com', NULL, '2024-08-10 14:03:47', '2024-08-10 14:03:47'),
(44, 'Virgilio', 'Mabueca', 'Moçambicano', '544777447444q', '22545889', 1, 'masculino', 2, NULL, 'vmabueca@gmail.com', NULL, '2024-08-10 14:04:30', '2024-08-10 14:04:30'),
(45, 'Alexandrina', 'Uache', 'Moçambicano', '544777447440s', '12545889', 1, 'femenino', 2, NULL, 'auache@gmail.com', NULL, '2024-08-10 14:05:19', '2024-08-10 14:05:19'),
(46, 'Leonardo', 'Simão', 'Moçambicano', '445587775445s', '55445871', 2, 'masculino', 2, NULL, 'leo@gmail.com', NULL, '2024-08-10 14:11:05', '2024-08-10 14:11:05'),
(47, 'Atanásio Faustino', 'Matsimbe', 'Moçambicano', '554778845455s', '55448874', 2, 'masculino', 2, NULL, 'atanasio@gmail.com', NULL, '2024-08-10 14:13:52', '2024-08-10 14:13:52'),
(48, 'Nelson', 'Mugabe', 'Moçambicano', '111144554458s', '55487891', 2, 'masculino', 2, NULL, 'nelson@gmail.com', NULL, '2024-08-11 14:16:28', '2024-08-11 14:16:28'),
(69, 'Geraldo Carlos', 'Nhadumbuque', 'Moçambicano', '554885454885s', '66578898', 2, 'masculino', 1, NULL, 'gerard@gmail.com', NULL, '2024-09-01 11:35:58', '2024-09-01 11:35:58'),
(70, 'Arlete Maria', 'Ferrão', 'Moçambicano', '554885454845s', '66578838', 3, 'femenino', 1, NULL, 'arlete2@gmail.com', NULL, '2024-09-01 11:39:31', '2024-09-01 11:39:31'),
(74, 'Nelio Jorge', 'Quibe', 'Moçambicano', '885544875545s', '12358214', 1, 'masculino', 2, NULL, 'nelioquibe@gmail.com', NULL, '2024-09-01 13:57:20', '2024-09-01 13:57:20'),
(75, 'Jaime de Leite', 'Zandamela', 'Moçambicano', '445548000000x', '44558845', 1, 'masculino', 2, NULL, 'deleite@gmail.com', NULL, '2024-09-01 13:59:44', '2024-09-01 13:59:44'),
(76, 'Edilson', 'Mangue', 'Moçambicano', '445548000000q', '49558845', 1, 'masculino', 2, NULL, 'mangue@gmail.com', NULL, '2024-09-01 14:02:33', '2024-09-01 14:02:33'),
(77, 'Agostinho', 'Ngonga', 'Moçambicano', '855468845545s', '88887445', 1, 'masculino', 1, NULL, 'agostinho@gmail.com', NULL, '2024-09-01 14:14:14', '2024-09-01 14:14:14'),
(78, 'Francisco Romao', 'Chavana', 'Moçambicano', '123456789012E', '12345678', 1, 'masculino', 3, NULL, 'xchavana@gmail.com', NULL, '2024-09-02 07:26:49', '2024-09-02 07:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `estagio_contratos`
--

DROP TABLE IF EXISTS `estagio_contratos`;
CREATE TABLE IF NOT EXISTS `estagio_contratos` (
  `id_estagio` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etapa` int NOT NULL,
  `descricao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_estagio`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estagio_contratos`
--

INSERT INTO `estagio_contratos` (`id_estagio`, `created_at`, `updated_at`, `etapa`, `descricao`) VALUES
(1, '2024-07-13 10:35:16', '2024-07-13 10:35:16', 0, 'Sem contrato ou disciplinas alocada'),
(2, '2024-07-13 10:35:16', '2024-07-13 10:35:16', 1, 'Fase de alocação de disciplinas'),
(3, '2024-07-13 10:35:16', '2024-07-13 10:35:16', 2, 'Fase de assinatura dos contratos'),
(4, '2024-07-13 10:35:16', '2024-07-13 10:35:16', 3, 'Contratos na Direção dos RHs'),
(5, '2024-07-13 10:35:16', '2024-07-13 10:35:16', 4, 'Contratos no tribunal administrativo'),
(6, '2024-07-13 10:35:16', '2024-07-13 10:35:16', 6, 'Processo finalizado');

-- --------------------------------------------------------

--
-- Table structure for table `faculdades`
--

DROP TABLE IF EXISTS `faculdades`;
CREATE TABLE IF NOT EXISTS `faculdades` (
  `id_faculdade` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_faculdade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sigla_faculdade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_faculdade`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculdades`
--

INSERT INTO `faculdades` (`id_faculdade`, `nome_faculdade`, `sigla_faculdade`, `created_at`, `updated_at`) VALUES
(1, 'Faculdade de Engenharia e Tecnologia', 'FET', '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
(2, 'Faculdade de Ciências Naturais e Matemática', 'FCNM', '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
(3, 'Faculdade de Ciências Sociais e Filosofia', 'FCSF', '2024-07-13 10:35:16', '2024-07-13 10:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `lecionado_ems`
--

DROP TABLE IF EXISTS `lecionado_ems`;
CREATE TABLE IF NOT EXISTS `lecionado_ems` (
  `id_curso` int NOT NULL,
  `codigo_disciplina` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano` int NOT NULL,
  `semestre` int NOT NULL,
  `horas_contacto` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_curso`,`codigo_disciplina`),
  KEY `lecionado_ems_codigo_disciplina_foreign` (`codigo_disciplina`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lecionas`
--

DROP TABLE IF EXISTS `lecionas`;
CREATE TABLE IF NOT EXISTS `lecionas` (
  `id_docente_in_leciona` int NOT NULL,
  `id_curso_in_leciona` int NOT NULL,
  `codigo_disciplina_in_leciona` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano_contrato` year NOT NULL,
  `id_tipo_contrato_in_leciona` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cod_area_in_leciona` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_docente_in_leciona`,`id_curso_in_leciona`,`codigo_disciplina_in_leciona`,`ano_contrato`),
  KEY `lecionas_id_tipo_contrato_in_leciona_foreign` (`id_tipo_contrato_in_leciona`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lecionas`
--

INSERT INTO `lecionas` (`id_docente_in_leciona`, `id_curso_in_leciona`, `codigo_disciplina_in_leciona`, `ano_contrato`, `id_tipo_contrato_in_leciona`, `created_at`, `updated_at`, `cod_area_in_leciona`) VALUES
(27, 1, 'INFTIC', '2024', 1, '2024-08-10 11:55:42', '2024-08-10 11:55:42', 'INF'),
(2, 1, 'INFAP', '2024', 1, '2024-08-10 11:56:00', '2024-08-10 11:56:00', 'INF'),
(8, 1, 'INFALGA', '2024', 1, '2024-08-10 11:56:15', '2024-08-10 11:56:15', 'MAT'),
(5, 1, 'INFAM', '2024', 1, '2024-08-10 11:56:32', '2024-08-10 11:56:32', 'MAT'),
(14, 1, 'INFMEU', '2024', 1, '2024-08-10 11:56:53', '2024-08-10 11:56:53', 'CPG'),
(4, 1, 'INFPOO', '2024', 1, '2024-08-10 11:57:05', '2024-08-10 11:57:05', 'INF'),
(16, 1, 'INFEB', '2024', 1, '2024-08-10 11:57:15', '2024-08-10 11:57:15', 'ELETR'),
(16, 1, 'INFFTC', '2024', 1, '2024-08-10 11:57:23', '2024-08-10 11:57:23', 'TELECOM'),
(4, 1, 'INFEDA', '2024', 1, '2024-08-10 11:57:41', '2024-08-10 11:57:41', 'INF'),
(1, 1, 'INFPDM', '2024', 1, '2024-08-10 11:57:51', '2024-08-10 11:57:51', 'INF'),
(17, 1, 'INFRC', '2024', 1, '2024-08-10 11:58:03', '2024-08-10 11:58:03', 'INF'),
(17, 1, 'INFRM', '2024', 1, '2024-08-10 11:58:19', '2024-08-10 11:58:19', 'TELECOM'),
(3, 1, 'INFSO', '2024', 1, '2024-08-10 11:58:26', '2024-08-10 11:58:26', 'INF'),
(27, 1, 'INFAC', '2024', 1, '2024-08-10 11:58:39', '2024-08-10 11:58:39', 'INF'),
(3, 1, 'INFTRP', '2024', 1, '2024-08-10 12:07:58', '2024-08-10 12:07:58', 'INF'),
(25, 1, 'INFGRS', '2024', 1, '2024-08-10 12:08:07', '2024-08-10 12:08:07', 'INF'),
(17, 1, 'INFRA', '2024', 1, '2024-08-10 12:08:14', '2024-08-10 12:08:14', 'TELECOM'),
(2, 1, 'INFDW', '2024', 1, '2024-08-10 12:08:20', '2024-08-10 12:08:20', 'INF'),
(23, 1, 'INFFBD', '2024', 1, '2024-08-10 12:10:01', '2024-08-10 12:10:01', 'INF'),
(23, 1, 'INFBDA', '2024', 1, '2024-08-10 12:10:08', '2024-08-10 12:10:08', 'INF'),
(14, 1, 'INFES1', '2024', 1, '2024-08-10 12:10:26', '2024-08-10 12:10:26', 'INF'),
(14, 1, 'INFES2', '2024', 1, '2024-08-10 12:10:37', '2024-08-10 12:10:37', 'INF'),
(27, 1, 'INFTIC', '2025', 1, '2024-08-10 12:11:22', '2024-08-10 12:11:22', 'INF'),
(1, 1, 'INFAP', '2025', 1, '2024-08-10 12:11:37', '2024-08-10 12:11:37', 'INF'),
(8, 1, 'INFALGA', '2025', 1, '2024-08-10 12:11:47', '2024-08-10 12:11:47', 'MAT'),
(5, 1, 'INFAM', '2025', 1, '2024-08-10 12:11:52', '2024-08-10 12:11:52', 'MAT'),
(14, 1, 'INFMEU', '2025', 1, '2024-08-10 12:14:36', '2024-08-10 12:14:36', 'CPG'),
(2, 1, 'INFPOO', '2025', 1, '2024-08-10 12:14:55', '2024-08-10 12:14:55', 'INF'),
(16, 1, 'INFEB', '2025', 1, '2024-08-10 12:15:00', '2024-08-10 12:15:00', 'ELETR'),
(16, 1, 'INFFTC', '2025', 1, '2024-08-10 12:15:06', '2024-08-10 12:15:06', 'TELECOM'),
(4, 1, 'INFEDA', '2025', 1, '2024-08-10 12:15:24', '2024-08-10 12:15:24', 'INF'),
(1, 1, 'INFPDM', '2025', 1, '2024-08-10 12:15:31', '2024-08-10 12:15:31', 'INF'),
(27, 1, 'INFRC', '2025', 1, '2024-08-10 12:15:46', '2024-08-10 12:15:46', 'INF'),
(17, 1, 'INFRM', '2025', 1, '2024-08-10 12:15:56', '2024-08-10 12:15:56', 'TELECOM'),
(3, 1, 'INFSO', '2025', 1, '2024-08-10 12:16:04', '2024-08-10 12:16:04', 'INF'),
(3, 1, 'INFAC', '2025', 1, '2024-08-10 12:16:13', '2024-08-10 12:16:13', 'INF'),
(3, 1, 'INFTRP', '2025', 1, '2024-08-10 12:16:23', '2024-08-10 12:16:23', 'INF'),
(25, 1, 'INFGRS', '2025', 1, '2024-08-10 12:16:31', '2024-08-10 12:16:31', 'INF'),
(17, 1, 'INFRA', '2025', 1, '2024-08-10 12:16:38', '2024-08-10 12:16:38', 'TELECOM'),
(2, 1, 'INFDW', '2025', 1, '2024-08-10 12:16:44', '2024-08-10 12:16:44', 'INF'),
(23, 1, 'INFFBD', '2025', 1, '2024-08-10 12:16:50', '2024-08-10 12:16:50', 'INF'),
(23, 1, 'INFBDA', '2025', 1, '2024-08-10 12:16:56', '2024-08-10 12:16:56', 'INF'),
(14, 1, 'INFES1', '2025', 1, '2024-08-10 12:17:05', '2024-08-10 12:17:05', 'INF'),
(4, 1, 'INFES2', '2025', 1, '2024-08-10 12:17:19', '2024-08-10 12:17:19', 'INF'),
(27, 1, 'INFTIC', '2026', 1, '2024-08-10 12:17:51', '2024-08-10 12:17:51', 'INF'),
(1, 1, 'INFAP', '2026', 1, '2024-08-10 12:17:58', '2024-08-10 12:17:58', 'INF'),
(8, 1, 'INFALGA', '2026', 1, '2024-08-10 12:18:04', '2024-08-10 12:18:04', 'MAT'),
(12, 1, 'INFAM', '2026', 1, '2024-08-10 12:18:25', '2024-08-10 12:18:25', 'MAT'),
(14, 1, 'INFMEU', '2026', 1, '2024-08-10 12:18:38', '2024-08-10 12:18:38', 'CPG'),
(4, 1, 'INFPOO', '2026', 1, '2024-08-10 12:18:49', '2024-08-10 12:18:49', 'INF'),
(16, 1, 'INFEB', '2026', 1, '2024-08-10 12:18:56', '2024-08-10 12:18:56', 'ELETR'),
(16, 1, 'INFFTC', '2026', 1, '2024-08-10 12:19:06', '2024-08-10 12:19:06', 'TELECOM'),
(14, 1, 'INFEDA', '2026', 1, '2024-08-10 12:19:19', '2024-08-10 12:19:19', 'INF'),
(1, 1, 'INFPDM', '2026', 1, '2024-08-10 12:19:27', '2024-08-10 12:19:27', 'INF'),
(27, 1, 'INFRC', '2026', 1, '2024-08-10 12:19:37', '2024-08-10 12:19:37', 'INF'),
(17, 1, 'INFRM', '2026', 1, '2024-08-10 12:19:46', '2024-08-10 12:19:46', 'TELECOM'),
(3, 1, 'INFSO', '2026', 1, '2024-08-10 12:19:52', '2024-08-10 12:19:52', 'INF'),
(3, 1, 'INFAC', '2026', 1, '2024-08-10 12:19:58', '2024-08-10 12:19:58', 'INF'),
(3, 1, 'INFTRP', '2026', 1, '2024-08-10 12:20:04', '2024-08-10 12:20:04', 'INF'),
(25, 1, 'INFGRS', '2026', 1, '2024-08-10 12:20:31', '2024-08-10 12:20:31', 'INF'),
(17, 1, 'INFRA', '2026', 1, '2024-08-10 12:20:37', '2024-08-10 12:20:37', 'TELECOM'),
(2, 1, 'INFDW', '2026', 1, '2024-08-10 12:20:46', '2024-08-10 12:20:46', 'INF'),
(23, 1, 'INFFBD', '2026', 1, '2024-08-10 12:20:53', '2024-08-10 12:20:53', 'INF'),
(23, 1, 'INFBDA', '2026', 1, '2024-08-10 12:20:58', '2024-08-10 12:20:58', 'INF'),
(14, 1, 'INFES1', '2026', 1, '2024-08-10 12:21:10', '2024-08-10 12:21:10', 'INF'),
(4, 1, 'INFES2', '2026', 1, '2024-08-10 12:21:18', '2024-08-10 12:21:18', 'INF'),
(15, 2, 'FISTIC', '2024', 1, '2024-08-10 13:20:31', '2024-08-10 13:20:31', 'INF'),
(30, 2, 'FISMEU', '2024', 1, '2024-08-10 13:20:40', '2024-08-10 13:20:40', 'CPG'),
(11, 2, 'FISFP', '2024', 1, '2024-08-10 13:21:00', '2024-08-10 13:21:00', 'CFP'),
(9, 2, 'FISMC', '2024', 1, '2024-08-10 13:21:14', '2024-08-10 13:21:14', 'FIS'),
(10, 2, 'FISLABMC', '2024', 1, '2024-08-10 13:21:28', '2024-08-10 13:21:28', 'FIS'),
(8, 2, 'FISMF1', '2024', 1, '2024-08-10 13:21:34', '2024-08-10 13:21:34', 'MAT'),
(8, 2, 'FISMF2', '2024', 1, '2024-08-10 13:21:42', '2024-08-10 13:21:42', 'MAT'),
(37, 2, 'FISDG', '2024', 1, '2024-08-10 13:22:30', '2024-08-10 13:22:30', 'CFP'),
(38, 2, 'FISPPG', '2024', 1, '2024-08-10 13:22:44', '2024-08-10 13:22:44', 'CFP'),
(29, 2, 'FISTTCM', '2024', 1, '2024-08-10 13:22:55', '2024-08-10 13:22:55', 'FIS'),
(10, 2, 'FISLTTCM', '2024', 1, '2024-08-10 13:23:08', '2024-08-10 13:23:08', 'FIS'),
(36, 2, 'FISFF', '2024', 1, '2024-08-10 13:23:24', '2024-08-10 13:23:24', 'FIL'),
(32, 2, 'FISDF1', '2024', 1, '2024-08-10 13:23:55', '2024-08-10 13:23:55', 'FIS-DD'),
(35, 2, 'FISEM', '2024', 1, '2024-08-10 13:24:06', '2024-08-10 13:24:06', 'FIS'),
(34, 2, 'FISLEM', '2024', 1, '2024-08-10 13:24:19', '2024-08-10 13:24:19', 'FIS'),
(9, 2, 'FISFMO', '2024', 1, '2024-08-10 13:24:31', '2024-08-10 13:24:31', 'FIS'),
(33, 2, 'FISING', '2024', 1, '2024-08-10 13:24:41', '2024-08-10 13:24:41', 'INGL'),
(32, 2, 'FISPPDF1', '2024', 1, '2024-08-10 13:24:59', '2024-08-10 13:24:59', 'FIS-DD'),
(40, 2, 'FISPA', '2024', 1, '2024-08-10 13:25:37', '2024-08-10 13:25:37', 'PsiCoG'),
(41, 2, 'FISMT', '2024', 1, '2024-08-10 13:26:08', '2024-08-10 13:26:08', 'FIS'),
(39, 2, 'FISANTR', '2024', 1, '2024-08-10 13:27:23', '2024-08-10 13:27:23', 'ANTR'),
(42, 2, 'FISNEE', '2024', 1, '2024-08-10 13:27:56', '2024-08-10 13:27:56', 'CFP'),
(7, 2, 'FIS-OOO', '2024', 1, '2024-08-10 13:28:07', '2024-08-10 13:28:07', 'FIS'),
(34, 2, 'FIS-LOOO', '2024', 1, '2024-08-10 13:29:10', '2024-08-10 13:29:10', 'FIS'),
(15, 2, 'FISTIC', '2025', 1, '2024-08-10 13:29:42', '2024-08-10 13:29:42', 'INF'),
(30, 2, 'FISMEU', '2025', 1, '2024-08-10 13:29:58', '2024-08-10 13:29:58', 'CPG'),
(11, 2, 'FISFP', '2025', 1, '2024-08-10 13:30:17', '2024-08-10 13:30:17', 'CFP'),
(9, 2, 'FISMC', '2025', 1, '2024-08-10 13:30:30', '2024-08-10 13:30:30', 'FIS'),
(10, 2, 'FISLABMC', '2025', 1, '2024-08-10 13:30:44', '2024-08-10 13:30:44', 'FIS'),
(8, 2, 'FISMF1', '2025', 1, '2024-08-10 13:30:50', '2024-08-10 13:30:50', 'MAT'),
(8, 2, 'FISMF2', '2025', 1, '2024-08-10 13:30:56', '2024-08-10 13:30:56', 'MAT'),
(9, 2, 'FIS-OOO', '2025', 1, '2024-08-10 13:31:41', '2024-08-10 13:31:41', 'FIS'),
(34, 2, 'FIS-LOOO', '2025', 1, '2024-08-10 13:31:55', '2024-08-10 13:31:55', 'FIS'),
(34, 2, 'FISLEM', '2025', 1, '2024-08-10 13:32:16', '2024-08-10 13:32:16', 'FIS'),
(9, 2, 'FISFMO', '2025', 1, '2024-08-10 13:32:40', '2024-08-10 13:32:40', 'FIS'),
(35, 2, 'FISEM', '2025', 1, '2024-08-10 13:33:00', '2024-08-10 13:33:00', 'FIS'),
(33, 2, 'FISING', '2025', 1, '2024-08-10 13:33:22', '2024-08-10 13:33:22', 'INGL'),
(32, 2, 'FISPPG', '2025', 1, '2024-08-10 13:33:49', '2024-08-10 13:33:49', 'CFP'),
(32, 2, 'FISDF1', '2025', 1, '2024-08-10 13:34:09', '2024-08-10 13:34:09', 'FIS-DD'),
(29, 2, 'FISTTCM', '2025', 1, '2024-08-10 13:34:57', '2024-08-10 13:34:57', 'FIS'),
(10, 2, 'FISLTTCM', '2025', 1, '2024-08-10 13:35:12', '2024-08-10 13:35:12', 'FIS'),
(36, 2, 'FISFF', '2025', 1, '2024-08-10 13:35:25', '2024-08-10 13:35:25', 'FIL'),
(32, 2, 'FISPPDF1', '2025', 1, '2024-08-10 13:35:55', '2024-08-10 13:35:55', 'FIS-DD'),
(39, 2, 'FISANTR', '2025', 1, '2024-08-10 13:37:06', '2024-08-10 13:37:06', 'ANTR'),
(41, 2, 'FISMT', '2025', 1, '2024-08-10 13:37:27', '2024-08-10 13:37:27', 'FIS'),
(42, 2, 'FISNEE', '2025', 1, '2024-08-10 13:37:37', '2024-08-10 13:37:37', 'CFP'),
(40, 2, 'FISPA', '2025', 1, '2024-08-10 13:37:50', '2024-08-10 13:37:50', 'PsiCoG'),
(37, 2, 'FISDG', '2025', 1, '2024-08-10 13:38:09', '2024-08-10 13:38:09', 'CFP'),
(15, 2, 'FISTIC', '2026', 1, '2024-08-10 13:38:33', '2024-08-10 13:38:33', 'INF'),
(30, 2, 'FISMEU', '2026', 1, '2024-08-10 13:38:48', '2024-08-10 13:38:48', 'CPG'),
(11, 2, 'FISFP', '2026', 1, '2024-08-10 13:38:58', '2024-08-10 13:38:58', 'CFP'),
(9, 2, 'FISMC', '2026', 1, '2024-08-10 13:39:09', '2024-08-10 13:39:09', 'FIS'),
(10, 2, 'FISLABMC', '2026', 1, '2024-08-10 13:39:28', '2024-08-10 13:39:28', 'FIS'),
(12, 2, 'FISMF1', '2026', 1, '2024-08-10 13:39:44', '2024-08-10 13:39:44', 'MAT'),
(12, 2, 'FISMF2', '2026', 1, '2024-08-10 13:39:57', '2024-08-10 13:39:57', 'MAT'),
(32, 2, 'FISPPG', '2026', 1, '2024-08-10 13:41:57', '2024-08-10 13:41:57', 'CFP'),
(32, 2, 'FISDG', '2026', 1, '2024-08-10 13:43:04', '2024-08-10 13:43:04', 'CFP'),
(33, 2, 'FISING', '2026', 1, '2024-08-10 13:43:19', '2024-08-10 13:43:19', 'INGL'),
(32, 2, 'FISPPDF1', '2026', 1, '2024-08-10 13:43:34', '2024-08-10 13:43:34', 'FIS-DD'),
(34, 2, 'FISLEM', '2026', 1, '2024-08-10 13:43:54', '2024-08-10 13:43:54', 'FIS'),
(9, 2, 'FISFMO', '2026', 1, '2024-08-10 13:44:08', '2024-08-10 13:44:08', 'FIS'),
(35, 2, 'FISEM', '2026', 1, '2024-08-10 13:44:19', '2024-08-10 13:44:19', 'FIS'),
(32, 2, 'FISDF1', '2026', 1, '2024-08-10 13:44:46', '2024-08-10 13:44:46', 'FIS-DD'),
(39, 2, 'FISANTR', '2026', 1, '2024-08-10 13:45:37', '2024-08-10 13:45:37', 'ANTR'),
(40, 2, 'FISPA', '2026', 1, '2024-08-10 13:45:53', '2024-08-10 13:45:53', 'PsiCoG'),
(42, 2, 'FISNEE', '2026', 1, '2024-08-10 13:46:11', '2024-08-10 13:46:11', 'CFP'),
(7, 2, 'FIS-OOO', '2026', 1, '2024-08-10 13:46:27', '2024-08-10 13:46:27', 'FIS'),
(34, 2, 'FIS-LOOO', '2026', 1, '2024-08-10 13:46:38', '2024-08-10 13:46:38', 'FIS'),
(36, 2, 'FISFF', '2026', 1, '2024-08-10 13:46:50', '2024-08-10 13:46:50', 'FIL'),
(10, 2, 'FISLTTCM', '2026', 1, '2024-08-10 13:47:04', '2024-08-10 13:47:04', 'FIS'),
(29, 2, 'FISTTCM', '2026', 1, '2024-08-10 13:47:12', '2024-08-10 13:47:12', 'FIS'),
(41, 2, 'FISMT', '2026', 1, '2024-08-10 13:47:33', '2024-08-10 13:47:33', 'FIS'),
(13, 3, 'MATAL', '2024', 1, '2024-08-10 14:05:46', '2024-08-10 14:05:46', 'MAT'),
(12, 3, 'MATCI', '2024', 1, '2024-08-10 14:06:10', '2024-08-10 14:06:10', 'MAT'),
(19, 3, 'MATLTC', '2024', 1, '2024-08-10 14:06:22', '2024-08-10 14:06:22', 'MAT'),
(9, 3, 'MATTIC', '2024', 1, '2024-08-10 14:06:33', '2024-08-10 14:06:33', 'INF'),
(18, 3, 'MATFP', '2024', 1, '2024-08-10 14:06:42', '2024-08-10 14:06:42', 'CFP'),
(18, 3, 'MATPsiG', '2024', 1, '2024-08-10 14:06:54', '2024-08-10 14:06:54', 'PsiCoG'),
(6, 3, 'MATCIR', '2024', 1, '2024-08-10 14:07:20', '2024-08-10 14:07:20', 'MAT'),
(33, 3, 'MATAL2', '2024', 1, '2024-08-10 14:07:28', '2024-08-10 14:07:28', 'MAT'),
(5, 3, 'MATMEU', '2024', 1, '2024-08-10 14:07:47', '2024-08-10 14:07:47', 'CPG'),
(18, 3, 'MATPPG', '2024', 1, '2024-08-10 14:08:40', '2024-08-10 14:08:40', 'CFP'),
(18, 3, 'MATDG', '2024', 1, '2024-08-10 14:08:47', '2024-08-10 14:08:47', 'CFP'),
(36, 3, 'MATFF', '2024', 1, '2024-08-10 14:08:59', '2024-08-10 14:08:59', 'FIL'),
(33, 3, 'MAT_INGL', '2024', 1, '2024-08-10 14:09:49', '2024-08-10 14:09:49', 'INGL'),
(46, 3, 'MATGE 1', '2024', 1, '2024-08-10 14:11:23', '2024-08-10 14:11:23', 'MAT'),
(12, 3, 'MAT-CDRN', '2024', 1, '2024-08-10 14:11:35', '2024-08-10 14:11:35', 'MAT'),
(6, 3, 'MAT-CIRN', '2024', 1, '2024-08-10 14:11:42', '2024-08-10 14:11:42', 'MAT'),
(36, 3, 'MATANTR', '2024', 1, '2024-08-10 14:12:03', '2024-08-10 14:12:03', 'ANTR'),
(40, 3, 'MATPA', '2024', 1, '2024-08-10 14:12:27', '2024-08-10 14:12:27', 'PsiCoG'),
(40, 3, 'MATNEE', '2024', 1, '2024-08-10 14:12:44', '2024-08-10 14:12:44', 'CFP'),
(47, 3, 'MATGD', '2024', 1, '2024-08-10 14:14:12', '2024-08-10 14:14:12', 'MAT'),
(45, 3, 'MATTN', '2024', 1, '2024-08-10 14:14:26', '2024-08-10 14:14:26', 'MAT'),
(39, 3, 'MATINGL', '2024', 1, '2024-08-10 14:14:42', '2024-08-10 14:14:42', 'INGL'),
(13, 3, 'MATAL', '2025', 1, '2024-08-10 14:15:10', '2024-08-10 14:15:10', 'MAT'),
(12, 3, 'MATCI', '2025', 1, '2024-08-10 14:15:26', '2024-08-10 14:15:26', 'MAT'),
(9, 3, 'MATLTC', '2025', 1, '2024-08-10 14:15:40', '2024-08-10 14:15:40', 'MAT'),
(19, 3, 'MATTIC', '2025', 1, '2024-08-10 14:16:11', '2024-08-10 14:16:11', 'INF'),
(18, 3, 'MATFP', '2025', 1, '2024-08-10 14:16:21', '2024-08-10 14:16:21', 'CFP'),
(40, 3, 'MATPsiG', '2025', 1, '2024-08-10 14:17:15', '2024-08-10 14:17:15', 'PsiCoG'),
(6, 3, 'MATCIR', '2025', 1, '2024-08-10 14:17:22', '2024-08-10 14:17:22', 'MAT'),
(13, 3, 'MATAL2', '2025', 1, '2024-08-10 14:17:28', '2024-08-10 14:17:28', 'MAT'),
(5, 3, 'MATMEU', '2025', 1, '2024-08-10 14:17:55', '2024-08-10 14:17:55', 'CPG'),
(18, 3, 'MATPPG', '2025', 1, '2024-08-10 14:18:08', '2024-08-10 14:18:08', 'CFP'),
(18, 3, 'MATDG', '2025', 1, '2024-08-10 14:18:18', '2024-08-10 14:18:18', 'CFP'),
(36, 3, 'MATFF', '2025', 1, '2024-08-10 14:18:35', '2024-08-10 14:18:35', 'FIL'),
(39, 3, 'MAT_INGL', '2025', 1, '2024-08-10 14:18:46', '2024-08-10 14:18:46', 'INGL'),
(46, 3, 'MATGE 1', '2025', 1, '2024-08-10 14:18:59', '2024-08-10 14:18:59', 'MAT'),
(5, 3, 'MAT-CDRN', '2025', 1, '2024-08-10 14:19:10', '2024-08-10 14:19:10', 'MAT'),
(6, 3, 'MAT-CIRN', '2025', 1, '2024-08-10 14:19:17', '2024-08-10 14:19:17', 'MAT'),
(39, 3, 'MATANTR', '2025', 1, '2024-08-10 14:19:34', '2024-08-10 14:19:34', 'ANTR'),
(40, 3, 'MATPA', '2025', 1, '2024-08-10 14:19:46', '2024-08-10 14:19:46', 'PsiCoG'),
(40, 3, 'MATNEE', '2025', 1, '2024-08-10 14:20:34', '2024-08-10 14:20:34', 'CFP'),
(47, 3, 'MATGD', '2025', 1, '2024-08-10 14:20:50', '2024-08-10 14:20:50', 'MAT'),
(13, 3, 'MATTN', '2025', 1, '2024-08-10 14:20:58', '2024-08-10 14:20:58', 'MAT'),
(20, 3, 'MATINGL', '2025', 1, '2024-08-10 14:21:08', '2024-08-10 14:21:08', 'INGL'),
(6, 3, 'MATAL', '2026', 1, '2024-08-10 14:21:30', '2024-08-10 14:21:30', 'MAT'),
(5, 3, 'MATCI', '2026', 1, '2024-08-10 14:21:38', '2024-08-10 14:21:38', 'MAT'),
(19, 3, 'MATLTC', '2026', 1, '2024-08-10 14:21:54', '2024-08-10 14:21:54', 'MAT'),
(9, 3, 'MATTIC', '2026', 1, '2024-08-10 14:22:02', '2024-08-10 14:22:02', 'INF'),
(18, 3, 'MATFP', '2026', 1, '2024-08-10 14:22:11', '2024-08-10 14:22:11', 'CFP'),
(40, 3, 'MATPsiG', '2026', 1, '2024-08-10 14:22:29', '2024-08-10 14:22:29', 'PsiCoG'),
(12, 3, 'MATCIR', '2026', 1, '2024-08-10 14:22:35', '2024-08-10 14:22:35', 'MAT'),
(13, 3, 'MATAL2', '2026', 1, '2024-08-10 14:22:45', '2024-08-10 14:22:45', 'MAT'),
(5, 3, 'MATMEU', '2026', 1, '2024-08-10 14:22:54', '2024-08-10 14:22:54', 'CPG'),
(18, 3, 'MATPPG', '2026', 1, '2024-08-10 14:23:14', '2024-08-10 14:23:14', 'CFP'),
(44, 3, 'MATDG', '2026', 1, '2024-08-10 14:23:31', '2024-08-10 14:23:31', 'CFP'),
(36, 3, 'MATFF', '2026', 1, '2024-08-10 14:23:43', '2024-08-10 14:23:43', 'FIL'),
(20, 3, 'MAT_INGL', '2026', 1, '2024-08-10 14:23:48', '2024-08-10 14:23:48', 'INGL'),
(47, 3, 'MATGE 1', '2026', 1, '2024-08-10 14:23:59', '2024-08-10 14:23:59', 'MAT'),
(12, 3, 'MAT-CDRN', '2026', 1, '2024-08-10 14:24:25', '2024-08-10 14:24:25', 'MAT'),
(6, 3, 'MAT-CIRN', '2026', 1, '2024-08-10 14:24:31', '2024-08-10 14:24:31', 'MAT'),
(36, 3, 'MATANTR', '2026', 1, '2024-08-10 14:24:55', '2024-08-10 14:24:55', 'ANTR'),
(40, 3, 'MATPA', '2026', 1, '2024-08-10 14:25:05', '2024-08-10 14:25:05', 'PsiCoG'),
(18, 3, 'MATNEE', '2026', 1, '2024-08-10 14:25:13', '2024-08-10 14:25:13', 'CFP'),
(47, 3, 'MATGD', '2026', 1, '2024-08-10 14:25:21', '2024-08-10 14:25:21', 'MAT'),
(46, 3, 'MATTN', '2026', 1, '2024-08-10 14:25:29', '2024-08-10 14:25:29', 'MAT'),
(20, 3, 'MATINGL', '2026', 1, '2024-08-10 14:25:36', '2024-08-10 14:25:36', 'INGL'),
(14, 1, 'INFTIC', '2027', 1, '2024-08-11 13:56:04', '2024-08-11 13:56:04', 'INF'),
(1, 1, 'INFAP', '2027', 1, '2024-08-11 13:56:10', '2024-08-11 13:56:10', 'INF'),
(6, 1, 'INFALGA', '2027', 1, '2024-08-11 13:56:30', '2024-08-11 13:56:30', 'MAT'),
(8, 1, 'INFAM', '2027', 1, '2024-08-11 13:56:38', '2024-08-11 13:56:38', 'MAT'),
(14, 1, 'INFMEU', '2027', 1, '2024-08-11 13:56:58', '2024-08-11 13:56:58', 'CPG'),
(2, 1, 'INFPOO', '2027', 1, '2024-08-11 13:57:08', '2024-08-11 13:57:08', 'INF'),
(16, 1, 'INFEB', '2027', 1, '2024-08-11 13:57:16', '2024-08-11 13:57:16', 'ELETR'),
(17, 1, 'INFFTC', '2027', 1, '2024-08-11 13:57:24', '2024-08-11 13:57:24', 'TELECOM'),
(14, 1, 'INFEDA', '2027', 1, '2024-08-11 13:57:40', '2024-08-11 13:57:40', 'INF'),
(2, 1, 'INFPDM', '2027', 1, '2024-08-11 13:57:53', '2024-08-11 13:57:53', 'INF'),
(27, 1, 'INFRC', '2027', 1, '2024-08-11 13:58:03', '2024-08-11 13:58:03', 'INF'),
(25, 1, 'INFRM', '2027', 1, '2024-08-11 13:58:10', '2024-08-11 13:58:10', 'TELECOM'),
(3, 1, 'INFSO', '2027', 1, '2024-08-11 13:58:18', '2024-08-11 13:58:18', 'INF'),
(27, 1, 'INFAC', '2027', 1, '2024-08-11 13:58:26', '2024-08-11 13:58:26', 'INF'),
(17, 1, 'INFTRP', '2027', 1, '2024-08-11 13:58:48', '2024-08-11 13:58:48', 'INF'),
(27, 1, 'INFGRS', '2027', 1, '2024-08-11 13:58:58', '2024-08-11 13:58:58', 'INF'),
(25, 1, 'INFRA', '2027', 1, '2024-08-11 13:59:07', '2024-08-11 13:59:07', 'TELECOM'),
(2, 1, 'INFDW', '2027', 1, '2024-08-11 13:59:15', '2024-08-11 13:59:15', 'INF'),
(23, 1, 'INFFBD', '2027', 1, '2024-08-11 13:59:28', '2024-08-11 13:59:28', 'INF'),
(23, 1, 'INFBDA', '2027', 1, '2024-08-11 13:59:37', '2024-08-11 13:59:37', 'INF'),
(4, 1, 'INFES1', '2027', 1, '2024-08-11 13:59:44', '2024-08-11 13:59:44', 'INF'),
(4, 1, 'INFES2', '2027', 1, '2024-08-11 13:59:50', '2024-08-11 13:59:50', 'INF'),
(27, 2, 'FISTIC', '2027', 1, '2024-08-11 14:00:08', '2024-08-11 14:00:08', 'INF'),
(15, 2, 'FISMEU', '2027', 1, '2024-08-11 14:03:00', '2024-08-11 14:03:00', 'CPG'),
(15, 2, 'FISFP', '2027', 1, '2024-08-11 14:04:01', '2024-08-11 14:04:01', 'CFP'),
(29, 2, 'FISMC', '2027', 1, '2024-08-11 14:04:19', '2024-08-11 14:04:19', 'FIS'),
(15, 2, 'FISLABMC', '2027', 1, '2024-08-11 14:04:55', '2024-08-11 14:04:55', 'FIS'),
(12, 2, 'FISMF1', '2027', 1, '2024-08-11 14:05:05', '2024-08-11 14:05:05', 'MAT'),
(12, 2, 'FISMF2', '2027', 1, '2024-08-11 14:05:21', '2024-08-11 14:05:21', 'MAT'),
(11, 2, 'FISDG', '2027', 1, '2024-08-11 14:05:53', '2024-08-11 14:05:53', 'CFP'),
(40, 2, 'FISPPG', '2027', 1, '2024-08-11 14:06:02', '2024-08-11 14:06:02', 'CFP'),
(15, 2, 'FISLTTCM', '2027', 1, '2024-08-11 14:06:59', '2024-08-11 14:06:59', 'FIS'),
(15, 2, 'FISTTCM', '2027', 1, '2024-08-11 14:07:10', '2024-08-11 14:07:10', 'FIS'),
(36, 2, 'FISFF', '2027', 1, '2024-08-11 14:07:18', '2024-08-11 14:07:18', 'FIL'),
(32, 2, 'FISDF1', '2027', 1, '2024-08-11 14:07:53', '2024-08-11 14:07:53', 'FIS-DD'),
(9, 2, 'FISEM', '2027', 1, '2024-08-11 14:08:16', '2024-08-11 14:08:16', 'FIS'),
(9, 2, 'FISLEM', '2027', 1, '2024-08-11 14:08:29', '2024-08-11 14:08:29', 'FIS'),
(35, 2, 'FISFMO', '2027', 1, '2024-08-11 14:08:37', '2024-08-11 14:08:37', 'FIS'),
(20, 2, 'FISING', '2027', 1, '2024-08-11 14:08:42', '2024-08-11 14:08:42', 'INGL'),
(32, 2, 'FISPPDF1', '2027', 1, '2024-08-11 14:08:55', '2024-08-11 14:08:55', 'FIS-DD'),
(39, 2, 'FISANTR', '2027', 1, '2024-08-11 14:09:23', '2024-08-11 14:09:23', 'ANTR'),
(40, 2, 'FISPA', '2027', 1, '2024-08-11 14:09:38', '2024-08-11 14:09:38', 'PsiCoG'),
(41, 2, 'FISMT', '2027', 1, '2024-08-11 14:09:59', '2024-08-11 14:09:59', 'FIS'),
(42, 2, 'FISNEE', '2027', 1, '2024-08-11 14:10:17', '2024-08-11 14:10:17', 'CFP'),
(35, 2, 'FIS-OOO', '2027', 1, '2024-08-11 14:10:27', '2024-08-11 14:10:27', 'FIS'),
(42, 2, 'FIS-LOOO', '2027', 1, '2024-08-11 14:10:34', '2024-08-11 14:10:34', 'FIS'),
(6, 3, 'MATAL', '2027', 1, '2024-08-11 14:10:47', '2024-08-11 14:10:47', 'MAT'),
(5, 3, 'MATCI', '2027', 1, '2024-08-11 14:10:56', '2024-08-11 14:10:56', 'MAT'),
(22, 3, 'MATLTC', '2027', 1, '2024-08-11 14:11:49', '2024-08-11 14:11:49', 'MAT'),
(18, 3, 'MATTIC', '2027', 1, '2024-08-11 14:12:02', '2024-08-11 14:12:02', 'INF'),
(18, 3, 'MATFP', '2027', 1, '2024-08-11 14:12:30', '2024-08-11 14:12:30', 'CFP'),
(40, 3, 'MATPsiG', '2027', 1, '2024-08-11 14:13:09', '2024-08-11 14:13:09', 'PsiCoG'),
(5, 3, 'MATCIR', '2027', 1, '2024-08-11 14:13:20', '2024-08-11 14:13:20', 'MAT'),
(22, 3, 'MATAL2', '2027', 1, '2024-08-11 14:13:28', '2024-08-11 14:13:28', 'MAT'),
(46, 3, 'MATMEU', '2027', 1, '2024-08-11 14:13:45', '2024-08-11 14:13:45', 'CPG'),
(5, 3, 'MATPPG', '2027', 1, '2024-08-11 14:14:14', '2024-08-11 14:14:14', 'CFP'),
(44, 3, 'MATDG', '2027', 1, '2024-08-11 14:14:32', '2024-08-11 14:14:32', 'CFP'),
(36, 3, 'MATFF', '2027', 1, '2024-08-11 14:14:47', '2024-08-11 14:14:47', 'FIL'),
(20, 3, 'MAT_INGL', '2027', 1, '2024-08-11 14:14:52', '2024-08-11 14:14:52', 'INGL'),
(46, 3, 'MATGE 1', '2027', 1, '2024-08-11 14:15:02', '2024-08-11 14:15:02', 'MAT'),
(47, 3, 'MAT-CDRN', '2027', 1, '2024-08-11 14:15:17', '2024-08-11 14:15:17', 'MAT'),
(47, 3, 'MAT-CIRN', '2027', 1, '2024-08-11 14:15:25', '2024-08-11 14:15:25', 'MAT'),
(48, 3, 'MATANTR', '2027', 1, '2024-08-11 14:17:01', '2024-08-11 14:17:01', 'ANTR'),
(44, 3, 'MATPA', '2027', 1, '2024-08-11 14:17:39', '2024-08-11 14:17:39', 'PsiCoG'),
(44, 3, 'MATNEE', '2027', 1, '2024-08-11 14:17:46', '2024-08-11 14:17:46', 'CFP'),
(47, 3, 'MATGD', '2027', 1, '2024-08-11 14:17:58', '2024-08-11 14:17:58', 'MAT'),
(13, 3, 'MATTN', '2027', 1, '2024-08-11 14:18:34', '2024-08-11 14:18:34', 'MAT'),
(20, 3, 'MATINGL', '2027', 1, '2024-08-11 14:18:39', '2024-08-11 14:18:39', 'INGL'),
(27, 1, 'INFTIC', '2028', 1, '2024-08-20 17:45:26', '2024-08-20 17:45:26', 'INF'),
(1, 1, 'INFAP', '2028', 1, '2024-08-20 17:45:31', '2024-08-20 17:45:31', 'INF'),
(5, 1, 'INFALGA', '2028', 1, '2024-08-20 17:45:44', '2024-08-20 17:45:44', 'MAT'),
(5, 1, 'INFAM', '2028', 1, '2024-08-20 17:45:50', '2024-08-20 17:45:50', 'MAT'),
(14, 1, 'INFMEU', '2028', 1, '2024-08-20 17:46:07', '2024-08-20 17:46:07', 'CPG'),
(4, 1, 'INFPOO', '2028', 1, '2024-08-20 17:46:17', '2024-08-20 17:46:17', 'INF'),
(16, 1, 'INFEB', '2028', 1, '2024-08-20 17:46:31', '2024-08-20 17:46:31', 'ELETR'),
(16, 1, 'INFFTC', '2028', 1, '2024-08-20 17:46:41', '2024-08-20 17:46:41', 'TELECOM'),
(4, 1, 'INFEDA', '2028', 1, '2024-08-20 17:46:54', '2024-08-20 17:46:54', 'INF'),
(1, 1, 'INFPDM', '2028', 1, '2024-08-20 17:46:59', '2024-08-20 17:46:59', 'INF'),
(17, 1, 'INFRC', '2028', 1, '2024-08-20 17:47:17', '2024-08-20 17:47:17', 'INF'),
(25, 1, 'INFRM', '2028', 1, '2024-08-20 17:47:25', '2024-08-20 17:47:25', 'TELECOM'),
(3, 1, 'INFSO', '2028', 1, '2024-08-20 17:47:30', '2024-08-20 17:47:30', 'INF'),
(3, 1, 'INFAC', '2028', 1, '2024-08-20 17:47:35', '2024-08-20 17:47:35', 'INF'),
(3, 1, 'INFTRP', '2028', 1, '2024-08-20 17:47:42', '2024-08-20 17:47:42', 'INF'),
(27, 1, 'INFGRS', '2028', 1, '2024-08-20 17:47:51', '2024-08-20 17:47:51', 'INF'),
(17, 1, 'INFRA', '2028', 1, '2024-08-20 17:48:00', '2024-08-20 17:48:00', 'TELECOM'),
(2, 1, 'INFDW', '2028', 1, '2024-08-20 17:48:08', '2024-08-20 17:48:08', 'INF'),
(23, 1, 'INFFBD', '2028', 1, '2024-08-20 17:48:17', '2024-08-20 17:48:17', 'INF'),
(23, 1, 'INFBDA', '2028', 1, '2024-08-20 17:48:23', '2024-08-20 17:48:23', 'INF'),
(14, 1, 'INFES1', '2028', 1, '2024-08-20 17:48:32', '2024-08-20 17:48:32', 'INF'),
(14, 1, 'INFES2', '2028', 1, '2024-08-20 17:48:39', '2024-08-20 17:48:39', 'INF'),
(9, 2, 'FISTIC', '2028', 1, '2024-08-20 17:48:49', '2024-08-20 17:48:49', 'INF'),
(9, 2, 'FISMEU', '2028', 1, '2024-08-20 17:49:06', '2024-08-20 17:49:06', 'CPG'),
(43, 2, 'FISFP', '2028', 1, '2024-08-20 17:49:52', '2024-08-20 17:49:52', 'CFP'),
(9, 2, 'FISMC', '2028', 1, '2024-08-20 17:50:56', '2024-08-20 17:50:56', 'FIS'),
(10, 2, 'FISLABMC', '2028', 1, '2024-08-20 17:51:15', '2024-08-20 17:51:15', 'FIS'),
(8, 2, 'FISMF1', '2028', 1, '2024-08-20 17:51:21', '2024-08-20 17:51:21', 'MAT'),
(8, 2, 'FISMF2', '2028', 1, '2024-08-20 17:51:26', '2024-08-20 17:51:26', 'MAT'),
(32, 2, 'FISDG', '2028', 1, '2024-08-20 17:51:42', '2024-08-20 17:51:42', 'CFP'),
(32, 2, 'FISPPG', '2028', 1, '2024-08-20 17:51:54', '2024-08-20 17:51:54', 'CFP'),
(29, 2, 'FISTTCM', '2028', 1, '2024-08-20 17:52:13', '2024-08-20 17:52:13', 'FIS'),
(10, 2, 'FISLTTCM', '2028', 1, '2024-08-20 17:52:26', '2024-08-20 17:52:26', 'FIS'),
(36, 2, 'FISFF', '2028', 1, '2024-08-20 17:52:36', '2024-08-20 17:52:36', 'FIL'),
(32, 2, 'FISDF1', '2028', 1, '2024-08-20 17:53:05', '2024-08-20 17:53:05', 'FIS-DD'),
(35, 2, 'FISEM', '2028', 1, '2024-08-20 17:53:15', '2024-08-20 17:53:15', 'FIS'),
(34, 2, 'FISLEM', '2028', 1, '2024-08-20 17:53:25', '2024-08-20 17:53:25', 'FIS'),
(35, 2, 'FISFMO', '2028', 1, '2024-08-20 17:53:49', '2024-08-20 17:53:49', 'FIS'),
(20, 2, 'FISING', '2028', 1, '2024-08-20 17:53:59', '2024-08-20 17:53:59', 'INGL'),
(32, 2, 'FISPPDF1', '2028', 1, '2024-08-20 17:54:12', '2024-08-20 17:54:12', 'FIS-DD'),
(39, 2, 'FISANTR', '2028', 1, '2024-08-20 17:54:38', '2024-08-20 17:54:38', 'ANTR'),
(40, 2, 'FISPA', '2028', 1, '2024-08-20 17:54:48', '2024-08-20 17:54:48', 'PsiCoG'),
(41, 2, 'FISMT', '2028', 1, '2024-08-20 17:55:00', '2024-08-20 17:55:00', 'FIS'),
(42, 2, 'FISNEE', '2028', 1, '2024-08-20 17:55:21', '2024-08-20 17:55:21', 'CFP'),
(7, 2, 'FIS-OOO', '2028', 1, '2024-08-20 17:55:30', '2024-08-20 17:55:30', 'FIS'),
(34, 2, 'FIS-LOOO', '2028', 1, '2024-08-20 17:55:40', '2024-08-20 17:55:40', 'FIS'),
(13, 3, 'MATAL', '2028', 1, '2024-08-20 17:56:03', '2024-08-20 17:56:03', 'MAT'),
(6, 3, 'MATCI', '2028', 1, '2024-08-20 17:56:10', '2024-08-20 17:56:10', 'MAT'),
(19, 3, 'MATLTC', '2028', 1, '2024-08-20 17:56:35', '2024-08-20 17:56:35', 'MAT'),
(19, 3, 'MATTIC', '2028', 1, '2024-08-20 17:56:38', '2024-08-20 17:56:38', 'INF'),
(18, 3, 'MATFP', '2028', 1, '2024-08-20 17:57:04', '2024-08-20 17:57:04', 'CFP'),
(40, 3, 'MATPsiG', '2028', 1, '2024-08-20 17:57:41', '2024-08-20 17:57:41', 'PsiCoG'),
(6, 3, 'MATCIR', '2028', 1, '2024-08-20 17:57:49', '2024-08-20 17:57:49', 'MAT'),
(13, 3, 'MATAL2', '2028', 1, '2024-08-20 17:58:01', '2024-08-20 17:58:01', 'MAT'),
(5, 3, 'MATMEU', '2028', 1, '2024-08-20 17:58:14', '2024-08-20 17:58:14', 'CPG'),
(43, 3, 'MATPPG', '2028', 1, '2024-08-20 17:58:34', '2024-08-20 17:58:34', 'CFP'),
(44, 3, 'MATDG', '2028', 1, '2024-08-20 17:58:45', '2024-08-20 17:58:45', 'CFP'),
(36, 3, 'MATFF', '2028', 1, '2024-08-20 17:58:58', '2024-08-20 17:58:58', 'FIL'),
(20, 3, 'MAT_INGL', '2028', 1, '2024-08-20 17:59:05', '2024-08-20 17:59:05', 'INGL'),
(46, 3, 'MATGE 1', '2028', 1, '2024-08-20 17:59:14', '2024-08-20 17:59:14', 'MAT'),
(6, 3, 'MAT-CDRN', '2028', 1, '2024-08-20 17:59:22', '2024-08-20 17:59:22', 'MAT'),
(12, 3, 'MAT-CIRN', '2028', 1, '2024-08-20 17:59:30', '2024-08-20 17:59:30', 'MAT'),
(39, 3, 'MATANTR', '2028', 1, '2024-08-20 17:59:46', '2024-08-20 17:59:46', 'ANTR'),
(40, 3, 'MATPA', '2028', 1, '2024-08-20 17:59:55', '2024-08-20 17:59:55', 'PsiCoG'),
(40, 3, 'MATNEE', '2028', 1, '2024-08-20 18:00:01', '2024-08-20 18:00:01', 'CFP'),
(47, 3, 'MATGD', '2028', 1, '2024-08-20 18:00:13', '2024-08-20 18:00:13', 'MAT'),
(45, 3, 'MATTN', '2028', 1, '2024-08-20 18:00:50', '2024-08-20 18:00:50', 'MAT'),
(20, 3, 'MATINGL', '2028', 1, '2024-08-20 18:01:03', '2024-08-20 18:01:03', 'INGL'),
(27, 1, 'INFTIC', '2029', 1, '2024-08-20 18:04:02', '2024-08-20 18:04:02', 'INF'),
(1, 1, 'INFAP', '2029', 1, '2024-08-20 18:04:07', '2024-08-20 18:04:07', 'INF'),
(5, 1, 'INFALGA', '2029', 1, '2024-08-20 18:04:13', '2024-08-20 18:04:13', 'MAT'),
(5, 1, 'INFAM', '2029', 1, '2024-08-20 18:04:19', '2024-08-20 18:04:19', 'MAT'),
(14, 1, 'INFMEU', '2029', 1, '2024-08-20 18:04:30', '2024-08-20 18:04:30', 'CPG'),
(4, 1, 'INFPOO', '2029', 1, '2024-08-20 18:04:38', '2024-08-20 18:04:38', 'INF'),
(16, 1, 'INFEB', '2029', 1, '2024-08-20 18:04:44', '2024-08-20 18:04:44', 'ELETR'),
(16, 1, 'INFFTC', '2029', 1, '2024-08-20 18:04:49', '2024-08-20 18:04:49', 'TELECOM'),
(4, 1, 'INFEDA', '2029', 1, '2024-08-20 18:04:58', '2024-08-20 18:04:58', 'INF'),
(1, 1, 'INFPDM', '2029', 1, '2024-08-20 18:05:03', '2024-08-20 18:05:03', 'INF'),
(27, 1, 'INFRC', '2029', 1, '2024-08-20 18:05:16', '2024-08-20 18:05:16', 'INF'),
(17, 1, 'INFRM', '2029', 1, '2024-08-20 18:05:28', '2024-08-20 18:05:28', 'TELECOM'),
(3, 1, 'INFSO', '2029', 1, '2024-08-20 18:05:34', '2024-08-20 18:05:34', 'INF'),
(3, 1, 'INFAC', '2029', 1, '2024-08-20 18:05:40', '2024-08-20 18:05:40', 'INF'),
(27, 1, 'INFTRP', '2029', 1, '2024-08-20 18:05:54', '2024-08-20 18:05:54', 'INF'),
(27, 1, 'INFGRS', '2029', 1, '2024-08-20 18:06:04', '2024-08-20 18:06:04', 'INF'),
(17, 1, 'INFRA', '2029', 1, '2024-08-20 18:06:22', '2024-08-20 18:06:22', 'TELECOM'),
(2, 1, 'INFDW', '2029', 1, '2024-08-20 18:06:28', '2024-08-20 18:06:28', 'INF'),
(23, 1, 'INFFBD', '2029', 1, '2024-08-20 18:06:41', '2024-08-20 18:06:41', 'INF'),
(23, 1, 'INFBDA', '2029', 1, '2024-08-20 18:06:53', '2024-08-20 18:06:53', 'INF'),
(14, 1, 'INFES1', '2029', 1, '2024-08-20 18:07:00', '2024-08-20 18:07:00', 'INF'),
(14, 1, 'INFES2', '2029', 1, '2024-08-20 18:07:16', '2024-08-20 18:07:16', 'INF'),
(9, 2, 'FISTIC', '2029', 1, '2024-08-20 18:07:27', '2024-08-20 18:07:27', 'INF'),
(30, 2, 'FISMEU', '2029', 1, '2024-08-20 18:08:06', '2024-08-20 18:08:06', 'CPG'),
(11, 2, 'FISFP', '2029', 1, '2024-08-20 18:08:25', '2024-08-20 18:08:25', 'CFP'),
(9, 2, 'FISMC', '2029', 1, '2024-08-20 18:08:34', '2024-08-20 18:08:34', 'FIS'),
(10, 2, 'FISLABMC', '2029', 1, '2024-08-20 18:08:47', '2024-08-20 18:08:47', 'FIS'),
(8, 2, 'FISMF1', '2029', 1, '2024-08-20 18:08:52', '2024-08-20 18:08:52', 'MAT'),
(8, 2, 'FISMF2', '2029', 1, '2024-08-20 18:08:57', '2024-08-20 18:08:57', 'MAT'),
(32, 2, 'FISDG', '2029', 1, '2024-08-20 18:09:21', '2024-08-20 18:09:21', 'CFP'),
(32, 2, 'FISPPG', '2029', 1, '2024-08-20 18:09:31', '2024-08-20 18:09:31', 'CFP'),
(29, 2, 'FISTTCM', '2029', 1, '2024-08-20 18:09:55', '2024-08-20 18:09:55', 'FIS'),
(10, 2, 'FISLTTCM', '2029', 1, '2024-08-20 18:10:07', '2024-08-20 18:10:07', 'FIS'),
(36, 2, 'FISFF', '2029', 1, '2024-08-20 18:10:21', '2024-08-20 18:10:21', 'FIL'),
(32, 2, 'FISDF1', '2029', 1, '2024-08-20 18:11:10', '2024-08-20 18:11:10', 'FIS-DD'),
(35, 2, 'FISEM', '2029', 1, '2024-08-20 18:11:16', '2024-08-20 18:11:16', 'FIS'),
(34, 2, 'FISLEM', '2029', 1, '2024-08-20 18:11:26', '2024-08-20 18:11:26', 'FIS'),
(9, 2, 'FISFMO', '2029', 1, '2024-08-20 18:11:48', '2024-08-20 18:11:48', 'FIS'),
(20, 2, 'FISING', '2029', 1, '2024-08-20 18:11:56', '2024-08-20 18:11:56', 'INGL'),
(31, 2, 'FISANTR', '2029', 1, '2024-08-20 18:12:10', '2024-08-20 18:12:10', 'ANTR'),
(41, 2, 'FISMT', '2029', 1, '2024-08-20 18:13:34', '2024-08-20 18:13:34', 'FIS'),
(42, 2, 'FISNEE', '2029', 1, '2024-08-20 18:13:52', '2024-08-20 18:13:52', 'CFP'),
(7, 2, 'FIS-OOO', '2029', 1, '2024-08-20 18:14:01', '2024-08-20 18:14:01', 'FIS'),
(31, 2, 'FISPPDF1', '2029', 1, '2024-08-20 18:14:17', '2024-08-20 18:14:17', 'FIS-DD'),
(40, 2, 'FISPA', '2029', 1, '2024-08-20 18:14:29', '2024-08-20 18:14:29', 'PsiCoG'),
(34, 2, 'FIS-LOOO', '2029', 1, '2024-08-20 18:14:46', '2024-08-20 18:14:46', 'FIS'),
(13, 3, 'MATAL', '2029', 1, '2024-08-20 18:15:04', '2024-08-20 18:15:04', 'MAT'),
(6, 3, 'MATCI', '2029', 1, '2024-08-20 18:15:13', '2024-08-20 18:15:13', 'MAT'),
(19, 3, 'MATLTC', '2029', 1, '2024-08-20 18:15:31', '2024-08-20 18:15:31', 'MAT'),
(18, 3, 'MATTIC', '2029', 1, '2024-08-20 18:15:49', '2024-08-20 18:15:49', 'INF'),
(18, 3, 'MATFP', '2029', 1, '2024-08-20 18:16:00', '2024-08-20 18:16:00', 'CFP'),
(40, 3, 'MATPsiG', '2029', 1, '2024-08-20 18:16:30', '2024-08-20 18:16:30', 'PsiCoG'),
(6, 3, 'MATCIR', '2029', 1, '2024-08-20 18:16:37', '2024-08-20 18:16:37', 'MAT'),
(13, 3, 'MATAL2', '2029', 1, '2024-08-20 18:16:45', '2024-08-20 18:16:45', 'MAT'),
(5, 3, 'MATMEU', '2029', 1, '2024-08-20 18:16:56', '2024-08-20 18:16:56', 'CPG'),
(43, 3, 'MATPPG', '2029', 1, '2024-08-20 18:17:28', '2024-08-20 18:17:28', 'CFP'),
(44, 3, 'MATDG', '2029', 1, '2024-08-20 18:17:38', '2024-08-20 18:17:38', 'CFP'),
(36, 3, 'MATFF', '2029', 1, '2024-08-20 18:17:49', '2024-08-20 18:17:49', 'FIL'),
(20, 3, 'MAT_INGL', '2029', 1, '2024-08-20 18:17:56', '2024-08-20 18:17:56', 'INGL'),
(46, 3, 'MATGE 1', '2029', 1, '2024-08-20 18:18:05', '2024-08-20 18:18:05', 'MAT'),
(6, 3, 'MAT-CDRN', '2029', 1, '2024-08-20 18:18:15', '2024-08-20 18:18:15', 'MAT'),
(6, 3, 'MAT-CIRN', '2029', 1, '2024-08-20 18:18:22', '2024-08-20 18:18:22', 'MAT'),
(39, 3, 'MATANTR', '2029', 1, '2024-08-20 18:18:37', '2024-08-20 18:18:37', 'ANTR'),
(40, 3, 'MATPA', '2029', 1, '2024-08-20 18:18:46', '2024-08-20 18:18:46', 'PsiCoG'),
(18, 3, 'MATNEE', '2029', 1, '2024-08-20 18:18:56', '2024-08-20 18:18:56', 'CFP'),
(47, 3, 'MATGD', '2029', 1, '2024-08-20 18:19:07', '2024-08-20 18:19:07', 'MAT'),
(45, 3, 'MATTN', '2029', 1, '2024-08-20 18:19:28', '2024-08-20 18:19:28', 'MAT'),
(20, 3, 'MATINGL', '2029', 1, '2024-08-20 18:19:45', '2024-08-20 18:19:45', 'INGL'),
(78, 3, 'MATPsiG', '2030', 1, '2024-09-02 07:31:53', '2024-09-02 07:31:53', 'PsiCoG');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_25_120120_create_cursos_table', 1),
(6, '2023_08_25_120732_create_disciplinas_table', 1),
(7, '2023_08_25_121043_create_categorias_table', 1),
(8, '2023_08_25_121459_create_nivels_table', 1),
(9, '2023_08_25_121529_create_docentes_table', 1),
(10, '2023_08_25_123050_create_lecionado_ems_table', 1),
(11, '2023_09_05_165058_create_faculdades_table', 1),
(12, '2023_09_13_195759_create_contratos_table', 1),
(13, '2023_10_05_135915_create_lecionas_table', 1),
(14, '2023_10_14_155525_create_representantes_table', 1),
(15, '2023_10_14_160159_create_tipo_contratos_table', 1),
(16, '2024_02_10_100627_create_estagio_contratos', 1),
(17, '2024_02_25_174800_create_ano_contratos_table', 1),
(18, '2024_07_09_103357_create_centro_recurso', 1),
(19, '2024_07_09_133700_create_centro_curso_centro', 1),
(20, '2024_07_09_133822_create_curso_centro_recurso', 1),
(21, '2024_07_10_113931_create_contrato_laboratorio', 1),
(22, '2024_07_12_095139_create_area_cientificas_table', 1),
(23, '2024_07_12_095457_create_area_docente', 1),
(24, '2024_07_14_141239_add_cod_area_in_leciona_to_lecionas_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nivels`
--

DROP TABLE IF EXISTS `nivels`;
CREATE TABLE IF NOT EXISTS `nivels` (
  `id_nivel` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `designacao_nivel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remuneracao_hora` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_nivel`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nivels`
--

INSERT INTO `nivels` (`id_nivel`, `designacao_nivel`, `remuneracao_hora`, `created_at`, `updated_at`) VALUES
(1, 'Licenciado', 800, '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
(2, 'Mestrado', 1000, '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
(3, 'Doutorado', 1200, '2024-07-13 10:35:16', '2024-07-13 10:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `representantes`
--

DROP TABLE IF EXISTS `representantes`;
CREATE TABLE IF NOT EXISTS `representantes` (
  `id_representante` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_representante` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apelido_representante` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero_representante` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_nivel_contrantante` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_representante`),
  KEY `representantes_id_nivel_contrantante_foreign` (`id_nivel_contrantante`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `representantes`
--

INSERT INTO `representantes` (`id_representante`, `nome_representante`, `apelido_representante`, `genero_representante`, `id_nivel_contrantante`, `created_at`, `updated_at`) VALUES
(1, 'Marisa Guião', 'de Mendonça', 'Femenino', 3, '2024-07-13 10:35:16', '2024-07-13 10:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_contratos`
--

DROP TABLE IF EXISTS `tipo_contratos`;
CREATE TABLE IF NOT EXISTS `tipo_contratos` (
  `id_tipo_contrato` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `designacao_tipo_contrato` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_contrato`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipo_contratos`
--

INSERT INTO `tipo_contratos` (`id_tipo_contrato`, `designacao_tipo_contrato`, `created_at`, `updated_at`) VALUES
(1, 'disciplinas normais', '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
(2, 'disciplinas laboratórias', '2024-07-13 10:35:16', '2024-07-13 10:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_user` int NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `tipo_user`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '01.abcd.2020', 'carlos2@example.com', NULL, '$2y$10$ZCVUS0NKC/HYjMg8xlLCuu/xYGWAAHcgH7dRUn3PtwHrhJYqawdvu', 1, 'vhGo01i5p2UuHuZyrTJH7PtbILiRUqdy4J195uxCJ2HLv9vFxy5L9CIH9SHf', '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
(6, 'Aurélio Armando Ribeiro', 'ribas@gmail.com', NULL, '$2y$10$GCeumlZmxK4H3BqBHcHWPesT0quC6bPCv3OH2Z4NYZoui3gDdMiPq', 2, NULL, '2024-07-13 11:13:38', '2024-07-13 11:13:38'),
(3, 'Mariza Guião', 'mariza@gmail.com', NULL, '$2y$10$beUYb82BZ81ELAJIsPpJLOPxjVE9UGgvZsEn9CExMvEIQ6TBWvw1O', 3, NULL, '2024-07-13 10:35:16', '2024-07-13 10:35:16'),
(4, 'Vadinacio Paulo', 'valdo@gmail.com', NULL, '$2y$10$sIZM9tJk.6IUsNwfP2Sg2eVr7w6bgTh0JmguPtYZF60qfFiMmnY0G', 2, NULL, '2024-07-13 11:07:43', '2024-07-13 11:07:43'),
(5, 'Ricardo Januário', 'ricardo@gmail.com', NULL, '$2y$10$k8IAvFyZ/e.hOYmIo5kIG.p7ZH8quPewf9r5c5pneD2wflvQY6j7.', 2, NULL, '2024-07-13 11:10:23', '2024-07-13 11:10:23'),
(7, 'Claudia Ivete', 'cjovo@gmail.com', NULL, '$2y$10$FCzheCVF.Hgtao.WCRMBgOMC1aF/7H6ORGEtlvYuDUyF9AjJa.2bm', 2, NULL, '2024-07-13 11:15:18', '2024-07-13 11:15:18'),
(8, 'Elisio', 'elisio@gmail.com', NULL, '$2y$10$9W16VIpprCWE5INH1zuSeORRivmkzZD9dY5tYX3jzx4m5MrSvW0j.', 2, NULL, '2024-07-13 11:16:29', '2024-07-13 11:16:29'),
(9, 'Salomão', 'sa@gmal.com', NULL, '$2y$10$qWAbmRCgbWyxvzlyHaRy9.IrJfXdYZi.X4LrKytmWVprQcQkZfRie', 2, NULL, '2024-07-13 11:17:17', '2024-07-13 11:17:17'),
(10, 'Amandio', 'amandio@gmail.com', NULL, '$2y$10$ics5SUf8/4D348LrEbuskexaqcoBx7hXBXVCKL.RMTr8gBd9M.gmS', 2, NULL, '2024-07-13 11:20:50', '2024-07-13 11:20:50'),
(11, 'Jó', 'jo@gmail.com', NULL, '$2y$10$2be2n3h05jH0LFig5L295uc8H4ew1Tts622CyOpVQnLKHu32ooHg2', 2, NULL, '2024-07-13 11:21:35', '2024-07-13 11:21:35'),
(12, 'Arsénio José', 'arsenio@gmil.com', NULL, '$2y$10$u5Ycg0Dwbu7C48s1b2L/velFx40C8WkvzR0Zh.A.B4xzYtsHuECb6', 2, NULL, '2024-07-13 11:22:49', '2024-07-13 11:22:49'),
(13, 'Maria', 'maria@gmail.com', NULL, '$2y$10$d4kyTn8XohjEt3rXxgu7R.O1IugU/TS72IAR/mg0Qt3OBK0sQjVwu', 2, NULL, '2024-07-13 11:23:54', '2024-07-13 11:23:54'),
(14, 'Adriano', 'adri@gmail.com', NULL, '$2y$10$R9vecX6d7PeIs4dYZojiFOoeww41XPvLhNWf2vMhVItpcfCvrenSG', 2, NULL, '2024-07-13 11:24:52', '2024-07-13 11:24:52'),
(15, 'Alberto Antonio', 'alb@gmail.com', NULL, '$2y$10$jeQa96IdGgbPNYGh6Zt.h.xVfOJEPV/Wo0qGjr2Kji4qiX7h9peni', 2, NULL, '2024-07-13 11:25:49', '2024-07-13 11:25:49'),
(16, 'Lúcio Francisco', 'lu@gmail.com', NULL, '$2y$10$mJ3V.c1df8CAnJlyQklMnOIUq4hZ1q/yX1YKeirgfNQONi55cvJR2', 2, NULL, '2024-07-13 11:26:49', '2024-07-13 11:26:49'),
(17, 'Armando Elisio', 'maxa@gmail.com', NULL, '$2y$10$NeIzlFWVrdKwNNhMb4llh.76WbF3XTyHdnIrwJgGVBd5GOG9Xi3nC', 2, NULL, '2024-07-13 12:16:57', '2024-07-13 12:16:57'),
(18, 'Ezar Esau', 'ezar@gmail.com', NULL, '$2y$10$Djj3MtaoXNPGkAzEhstCkOIJGy0daxUp6XMXLca1dhZc3799sQ3fS', 2, NULL, '2024-07-13 12:20:30', '2024-07-13 12:20:30'),
(19, 'Uranio Stafane', 'uranio@gmail.com', NULL, '$2y$10$8Idw6N/ntorZ167riyT1J.I1DKVWrXWIHNerRMF2tHnFxhYuPwyzS', 2, NULL, '2024-07-13 12:21:33', '2024-07-13 12:21:33'),
(20, 'Ambrósio Patricio', 'vumo@gmail.com', NULL, '$2y$10$ldOkT9/HKyMGqNRz0D.WF.I.yOj/QAaZXhTB44xBoex7kYCFJSSxq', 2, NULL, '2024-07-13 12:22:18', '2024-07-13 12:22:18'),
(21, 'José', 'joseflores@gmail.com', NULL, '$2y$10$279y9Q9a9GQjVAiWQJamiOahUA.OgT9MeWHOkjGzfK/rqHvb8Vhba', 2, NULL, '2024-07-18 13:54:33', '2024-07-18 13:54:33'),
(22, 'Júlio', 'jgncalves@gmail.com', NULL, '$2y$10$7LTEDr2YhxZ8LKhH7L6cwuc39UPbLq1eJg6ZkXtQF9LFbddJL74CW', 2, NULL, '2024-07-18 13:55:51', '2024-07-18 13:55:51'),
(23, 'Felizardo', 'felizardo@gmail.com', NULL, '$2y$10$jvnA2TaYBIasLsMQlAfZLOusgJXitx685VY/1F0uCEsxfWpH6B/im', 2, NULL, '2024-07-18 13:56:53', '2024-07-18 13:56:53'),
(24, 'Domingos', 'domingos@gmail.com', NULL, '$2y$10$kXyYzSZtvXOSeVIfMIVzv.Cos/TRYe/twHmasnfUWC9iei0xNKTRW', 2, NULL, '2024-07-18 13:58:44', '2024-07-18 13:58:44'),
(25, 'Celso', 'celso@gmail.com', NULL, '$2y$10$UJvAN73vGvol7K7d4Lbd4OSJPki0X0T/yiGhS/xDMI0XnWmcGxdDu', 2, NULL, '2024-07-18 13:59:38', '2024-07-18 13:59:38'),
(26, 'Eugenio Albeto', 'emacumbe@gmail.com', NULL, '$2y$10$1agknk6Yh0VkgnHSHv9bR.30a4TtuKcPiD8DFio4wTxEseZDliFX6', 2, NULL, '2024-07-18 14:00:21', '2024-07-18 14:00:21'),
(27, 'Margarida Lazaro', 'magui@gmail.com', NULL, '$2y$10$LhqZMA9nc52ThPxoMbmGleEVrXcQNTMfemWDfgT3wfjPQkSG6GK1W', 2, NULL, '2024-07-18 14:01:31', '2024-07-18 14:01:31'),
(28, 'Xavier', 'xavi@gmail.com', NULL, '$2y$10$y4uF8aL3SyCttNMRWXM/Y.9WSdNK30MwtZaBFCTvXn2S.36t0EBW2', 2, NULL, '2024-07-18 14:02:17', '2024-07-18 14:02:17'),
(29, 'Mateus', 'mateus@gmail.com', NULL, '$2y$10$.VsDV70m.yGrrcUmNipFnO7AJi0rzolMe/BVqDisrlzikSfgoXiI6', 2, NULL, '2024-07-18 14:20:25', '2024-07-18 14:20:25'),
(30, 'Faizal Eduardo', 'faizal@gmail.com', NULL, '$2y$10$dvABWGnV8Bn8hmqYXy62sekpvWXYqOSdMnY9.jmU4WHEwV0hpk746', 2, NULL, '2024-08-10 10:12:31', '2024-08-10 10:12:31'),
(31, 'Xavier', 'xavierl@gmail.com', NULL, '$2y$10$HqRkEn5nXjZ./buU6j581OAJzxkPufshL45FHECNxwX6Jng5j64Xu', 2, NULL, '2024-08-10 10:12:59', '2024-08-10 10:12:59'),
(32, 'Veloso', 'veloso@gmail.com', NULL, '$2y$10$/mXXMyeKPVx2M1gEIlzwU.Q.vwS7ZsuHoOble/BG.JKr0MR.80jZ.', 2, NULL, '2024-08-10 10:20:58', '2024-08-10 10:20:58'),
(33, 'Nádia Yolanda', 'nadia@gmail.com', NULL, '$2y$10$kYiT5BobjxeNK.2YJNeoGuzUFQJ4.KU3M.U7lkaFFznLh8SxU43jK', 2, NULL, '2024-08-10 13:03:17', '2024-08-10 13:03:17'),
(34, 'Alberto Felisberto', 'alberto.felisberto@gmail.com', NULL, '$2y$10$NUrExpyqiyOLNR3ap/FeceyQJRCCjERfbXW8wcJ1w.JI3Ii3jBi1S', 2, NULL, '2024-08-10 13:04:10', '2024-08-10 13:04:10'),
(35, 'Agostinho Barreto', 'agostinho.barreto@gmail.com', NULL, '$2y$10$6voIuZiPQu.PccrnxG4zZ./Jk3jhejGeHr8IEaQfU9VJwIY09OPD.', 2, NULL, '2024-08-10 13:07:47', '2024-08-10 13:07:47'),
(36, 'Luísa Franciaco', 'luisa@gmail.com', NULL, '$2y$10$c.xH18AYtOOWqLioVQaS9u.0L8NXmN1CmazYQ9Dj.d0m7sHDFbrO.', 2, NULL, '2024-08-10 13:10:43', '2024-08-10 13:10:43'),
(37, 'Elena Stepanova', 'elena@gmail.com', NULL, '$2y$10$/ATiTft8CW8CvQTEFmtQpu0wbLx59X5R3okNc/0fHaDbFLZZyuI/S', 2, NULL, '2024-08-10 13:11:23', '2024-08-10 13:11:23'),
(38, 'Herieta', 'Herieta@gmail.com', NULL, '$2y$10$ZYyCqTAzaSnHwzWLa4GoA.gSX1UgYIid8JRlcmUXu/Nl3NEXoUEv6', 2, NULL, '2024-08-10 13:12:33', '2024-08-10 13:12:33'),
(39, 'Dércia', 'dercia.chilengue@gmail.com', NULL, '$2y$10$J65Hzk2TXZ0tNqsDVD3UAO.MmEqoYkvUjENKnnghZpDS10683gRcm', 2, NULL, '2024-08-10 13:13:36', '2024-08-10 13:13:36'),
(40, 'Sara', 'sara.mondkane@gmail.com', NULL, '$2y$10$8aDXaZq6SJnsWJMbQZWLYugBZ7W.eww4NRYNuNJmNbhkoa2rEigf.', 2, NULL, '2024-08-10 13:14:22', '2024-08-10 13:14:22'),
(41, 'Ecelina', 'ecelina@gmail.com', NULL, '$2y$10$8iu0PK5B0LxofRHGDfFyU.rV.euX9IwSfzCkrBsUF8D.pC05T.LS.', 2, NULL, '2024-08-10 13:15:03', '2024-08-10 13:15:03'),
(42, 'Alfredo', 'alfredo@gmail.com', NULL, '$2y$10$5ISZN71WuP8qWkgvI.IRpO8wRhZjPnJGnPqxCmO4i4O5zJt3SPnGC', 2, NULL, '2024-08-10 13:16:13', '2024-08-10 13:16:13'),
(43, 'Rosa', 'rmuchine@gmail.com', NULL, '$2y$10$fNGezmGO2eWz0okvytXvv.nE4LE76stMuodUzfz.1FE2prft7PICi', 2, NULL, '2024-08-10 13:16:52', '2024-08-10 13:16:52'),
(44, 'Amós', 'veremachi@gmail.com', NULL, '$2y$10$llUq4k8rSsMHD4aRPDHnhOiNOja6bTcx8zNINYN72f3FNNCyrabam', 2, NULL, '2024-08-10 13:17:41', '2024-08-10 13:17:41'),
(45, 'Lúcia Suzete', 'suzete@gmail.com', NULL, '$2y$10$KOMcR2dP1m1ZyeBhSG2owex4nbi8a5qj9NShNTWnsJiu8iIuUbMJO', 2, NULL, '2024-08-10 13:19:31', '2024-08-10 13:19:31'),
(46, 'Jair', 'jair@gmail.com', NULL, '$2y$10$M7OkYDxpfWHyVTRcXLzjt.9Ay5adtgyKq9pxTa60jWNVi4Echoc7G', 2, NULL, '2024-08-10 14:03:47', '2024-08-10 14:03:47'),
(47, 'Virgilio', 'vmabueca@gmail.com', NULL, '$2y$10$Vankmk0Gxpsc.elQBdRZReCqu0MgVE04ZLKuL0LNPV6yA5LyaLPci', 2, NULL, '2024-08-10 14:04:30', '2024-08-10 14:04:30'),
(48, 'Alexandrina', 'auache@gmail.com', NULL, '$2y$10$wXrXoalvsJgp7g8W4B3WFeAxVznNANuGXAgxajDLrBhkA7mzc3R26', 2, NULL, '2024-08-10 14:05:19', '2024-08-10 14:05:19'),
(49, 'Leonardo', 'leo@gmail.com', NULL, '$2y$10$WnmyQ6NRdEBn1V8w21/mhOgTJ6WUH.yf/Zme7WbhlWG/3Kp2zQpR2', 2, NULL, '2024-08-10 14:11:05', '2024-08-10 14:11:05'),
(50, 'Atanásio Faustino', 'atanasio@gmail.com', NULL, '$2y$10$nuLCgMo.2BG1tZZXZykB/e6mFotR/nGdacieQ2LRWCtYv7G69Opoa', 2, NULL, '2024-08-10 14:13:52', '2024-08-10 14:13:52'),
(51, 'Nelson', 'nelson@gmail.com', NULL, '$2y$10$hSfzW3U2jDZViOBnGBKI/.eA8iPJhmuAweDWNDU5LwSb3z8rGZaNy', 2, NULL, '2024-08-11 14:16:28', '2024-08-11 14:16:28'),
(52, 'Arlete Ferrão', 'avilankulo@gmail.com', NULL, '$2y$10$Jywn7MXobsOrmjebc7R/iuqcX4jRBs9q.MgsLmiuj7o8AmKGJXWXu', 2, NULL, '2024-08-31 12:17:44', '2024-08-31 12:17:44'),
(53, 'Cassimo', 'neura@gmail.com', NULL, '$2y$10$XcRHkEq/e2krvWeLBS9C6.lj6XDQA61IWFSwElC3K00MY4jBOzTYu', 2, NULL, '2024-08-31 12:21:56', '2024-08-31 12:21:56'),
(54, 'Cassimo', 'neura2@gmail.com', NULL, '$2y$10$tpdUJ.rQKaAronaVyGi9B.8ULxjfx4TJk6.Svl76ZP9oeenhhRWjO', 2, NULL, '2024-08-31 12:27:45', '2024-08-31 12:27:45'),
(55, 'Cassimo', 'neura3@gmail.com', NULL, '$2y$10$6eBIFEHJ1QJJgCNdX1eEP.fJSi7394b.t.tVyvMd50U/lAetvs/0G', 2, NULL, '2024-08-31 12:31:10', '2024-08-31 12:31:10'),
(56, 'Cassimo', 'neura4@gmail.com', NULL, '$2y$10$VyuGtLTL5hzABTCDZCj1aekedylXhkSc7N808zx/9XdNZf21Y2zmq', 2, NULL, '2024-08-31 12:32:56', '2024-08-31 12:32:56'),
(57, 'Cassimo', 'neura5@gmail.com', NULL, '$2y$10$Br.Z2K.dmup6NeS/0XnS..eXbU6jVI7e1xKIzzoxve6JqB2e6nO2a', 2, NULL, '2024-08-31 12:37:36', '2024-08-31 12:37:36'),
(58, 'Cassimo', 'neura6@gmail.com', NULL, '$2y$10$FHe5kvXaAX8WCf9ftaMPPeJ4vKwtvk/b/wyaAkPX2DBXN5NwXoxbu', 2, NULL, '2024-08-31 12:40:04', '2024-08-31 12:40:04'),
(59, 'Carlos', 'capitine@gmail.com', NULL, '$2y$10$kBrKuO/.5iZg.S6swGOYbu2Ng5dhBoRPsh/ILvbS1Tt.xseCzxlNG', 2, NULL, '2024-08-31 12:41:45', '2024-08-31 12:41:45'),
(60, 'David', 'david@gmail.com', NULL, '$2y$10$JAEWUiJb5EyL0/SB27pFhu0X869XyszbfBI0wWzt8jN4Ng0OsbXxa', 2, NULL, '2024-08-31 13:03:50', '2024-08-31 13:03:50'),
(61, 'David', 'david2@gmail.com', NULL, '$2y$10$WGZotTc2rySelg0Y6LlGb.cjjDrq48EybhWQ.sdtdntRk5WiF1nMe', 2, NULL, '2024-08-31 13:09:47', '2024-08-31 13:09:47'),
(62, 'David', 'david@outlook.com', NULL, '$2y$10$J6sbSw2.XKTybgf6NgJLaeBv0.nsuxV43zL4iBcIuVWqk09p5W/vK', 2, NULL, '2024-08-31 13:13:57', '2024-08-31 13:13:57'),
(63, 'David', 'malan@gmail.com', NULL, '$2y$10$LyDBn4ATsRhWg03BUa2fzeazoNJYXEdoe3prL/nF0T3varoifSUNC', 2, NULL, '2024-08-31 13:23:02', '2024-08-31 13:23:02'),
(64, 'David', 'malan2@gmail.com', NULL, '$2y$10$dJndWAp906m.xnr1TUjZj.Ugit8b8VkKa2YGAPJVEs8K13mwZSJ8u', 2, NULL, '2024-08-31 13:38:48', '2024-08-31 13:38:48'),
(65, 'Emanuel', 'emanuel@gmail.com', NULL, '$2y$10$KHvHysXpNgpUmKrwi0ex2el/xyIDJyD/w7wKnQFm/qqAdaqxdO8jq', 2, NULL, '2024-08-31 13:56:40', '2024-08-31 13:56:40'),
(66, 'Emanuel', 'emanuel2@gmail.com', NULL, '$2y$10$rHeSF3s.LRMRil.6PbipzOxibLCI22b.D9TFJju0hq6GZgY9pge6O', 2, NULL, '2024-08-31 14:02:15', '2024-08-31 14:02:15'),
(67, 'Saquina', 'saquinha@gmail.com', NULL, '$2y$10$G/MpU0BGVTyTrkrosxj05u9SRXEK1VynaFH2HW.sJ7EEUNDyiq61.', 2, NULL, '2024-08-31 14:04:47', '2024-08-31 14:04:47'),
(68, 'Saquina', 'quina@gmail.com', NULL, '$2y$10$MqsXPd7aVhmcKDfsJSNSkuBxUIa28btDH1859/cX766/xSrZYPqzK', 2, NULL, '2024-08-31 14:12:11', '2024-08-31 14:12:11'),
(69, 'Arlete Maria', 'arlete@gmail.com', NULL, '$2y$10$VSooqETR/5ZFKkYInWyAveFZHRCc8aGUt1Q4bjKMg4SmtrpEyGLYW', 2, NULL, '2024-09-01 11:13:35', '2024-09-01 11:13:35'),
(70, 'Geraldo Carlos', 'geraldo@gmail.com', NULL, '$2y$10$iKrlKPb/YPvpqhnHr7RIj.iX4IgbqU1QCAR1yTQbsVXnF7xhAmfDS', 2, NULL, '2024-09-01 11:18:35', '2024-09-01 11:18:35'),
(71, 'Geraldo', 'geraldo2@gmail.com', NULL, '$2y$10$XCHce3ORKJfln307IPndzu4A3SVotg.SVU/mwOfqQ40Xw6TB4C4Zu', 2, NULL, '2024-09-01 11:32:14', '2024-09-01 11:32:14'),
(72, 'Geraldo Carlos', 'gerard@gmail.com', NULL, '$2y$10$fx/rp0rTcRJCaxwL20GVLO0DF/MvqtsC2vkn7Bn0GGxl7okAx/6Iu', 2, NULL, '2024-09-01 11:35:58', '2024-09-01 11:35:58'),
(73, 'Arlete Maria', 'arlete2@gmail.com', NULL, '$2y$10$shmCp.v9ChTCrUWngajA9.oQardbHHJrhObdObVhNPykOI/wacRO6', 2, NULL, '2024-09-01 11:39:31', '2024-09-01 11:39:31'),
(74, 'Nelio Jorge', 'nelio@gmail.com', NULL, '$2y$10$aeHKcwMs5wKnJFLeaw4X3uJHo93XDJSifh9tDYtBQvroMqBNinyrm', 2, NULL, '2024-09-01 13:45:51', '2024-09-01 13:45:51'),
(75, 'Jaime De Leite', 'jaime@gmail.com', NULL, '$2y$10$sBQVTtirfPSH.csyya/kV.tCvIJFEiBolWJXHbCenXMpbdmPUgF.C', 2, NULL, '2024-09-01 13:49:11', '2024-09-01 13:49:11'),
(76, 'Edilson', 'edy@gmail.com', NULL, '$2y$10$KNvELiPG6w9OEKguGKKQ9e9Sy8Oy3lKsqQUBc8cZUWhNrQKymYRw2', 2, NULL, '2024-09-01 13:52:48', '2024-09-01 13:52:48'),
(77, 'Nelio Jorge', 'nelioquibe@gmail.com', NULL, '$2y$10$AxGcvB5.P8yniAu5zG.gXO.di2V7vvQnmP9TDph4SatgTL5D5x5/G', 2, NULL, '2024-09-01 13:57:20', '2024-09-01 13:57:20'),
(78, 'Jaime de Leite', 'deleite@gmail.com', NULL, '$2y$10$l4yT/egRlOj67EUA/sc2Xex912WTULVeq61OnpQMxkkUQ7/RVClKu', 2, NULL, '2024-09-01 13:59:44', '2024-09-01 13:59:44'),
(79, 'Edilson', 'mangue@gmail.com', NULL, '$2y$10$uOFiPY02r0T.DeVY4GXLMe1VaKY7bhnRJs1.jZrBmVqol5JWFjWwi', 2, NULL, '2024-09-01 14:02:33', '2024-09-01 14:02:33'),
(80, 'Agostinho', 'agostinho@gmail.com', NULL, '$2y$10$V.mJpW2RiN0tDu08mecuPeD8T3NlnlGZHhWsvTtnY0Ld.XBinhdAS', 2, NULL, '2024-09-01 14:14:14', '2024-09-01 14:14:14'),
(81, 'Francisco Romao', 'xchavana@gmail.com', NULL, '$2y$10$a75uAaNGT.Asf2lkE2Druup59HNcuGWPej7TRPSOhSkY8aLsmtl4.', 2, NULL, '2024-09-02 07:26:49', '2024-09-02 07:26:49');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
