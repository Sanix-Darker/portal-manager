-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 03, 2018 at 11:39 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET AUTOCOMMIT = 0;
-- START TRANSACTION;
-- SET time_zone = "+00:00";

--
-- Database: `_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID_ADMIN` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `NOM` varchar(50) NOT NULL,
  `NUMERO` varchar(50) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `ACCESS` varchar(100) NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL 
  -- PRIMARY KEY (`ID_ADMIN`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `adminission`
--

DROP TABLE IF EXISTS `adminission`;
CREATE TABLE IF NOT EXISTS `adminission` (
  `ID_ADMISSION` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `NOM` varchar(150) NOT NULL,
  `AGE` varchar(100) NOT NULL,
  `CLASSE_PRE` varchar(100) NOT NULL,
  `ECOLE_PRE` varchar(100) NOT NULL,
  `CLASSE_FUTUR` varchar(100) NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_ADMISSION`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `ancien_eleve`
--

DROP TABLE IF EXISTS `ancien_eleve`;
CREATE TABLE IF NOT EXISTS `ancien_eleve` (
  `ID_ANCIEN` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `NOM` varchar(150) NOT NULL,
  `DOMAINE` varchar(250) NOT NULL,
  `POSTE` varchar(255) NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_ANCIEN`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `argent`
--

DROP TABLE IF EXISTS `argent`;
CREATE TABLE IF NOT EXISTS `argent` (
  `ID_ARGENT` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `ID_ADMIN` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `SOMME` double NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL 
  -- PRIMARY KEY (`ID_ARGENT`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `bibliotheque`
--

DROP TABLE IF EXISTS `bibliotheque`;
CREATE TABLE IF NOT EXISTS `bibliotheque` (
  `ID_LIVRE` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `TITRE` varchar(200) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_LIVRE`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `centre`
--

DROP TABLE IF EXISTS `centre`;
CREATE TABLE IF NOT EXISTS `centre` (
  `ID_CENTRE` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `TITRE` varchar(200) NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_CENTRE`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `chiffres`
--

DROP TABLE IF EXISTS `chiffres`;
CREATE TABLE IF NOT EXISTS `chiffres` (
  `ID_CHIFFRE` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `TYPE` varchar(150) NOT NULL,
  `CHIFFRE` int(11) NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL 
  -- PRIMARY KEY (`ID_CHIFFRE`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `ID_COURS` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `ID_FORMATION` int(11) NOT NULL,
  `ID_FORMATEUR` int(11) NOT NULL,
  `SLIDES` varchar(200) NOT NULL,
  `SUPPORT` varchar(200) NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_COURS`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `ID_DEPARTEMENT` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `ID_CENTRE` int(11) NOT NULL,
  `TITRE` varchar(200) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_DEPARTEMENT`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `ID_ETUDIANT` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `NOM` varchar(150) NOT NULL,
  `PRENOM` varchar(150) NOT NULL,
  `NUMERO` varchar(150) NOT NULL,
  `CNI` varchar(150) NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_ETUDIANT`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `etudiant_formation`
--

DROP TABLE IF EXISTS `etudiant_formation`;
CREATE TABLE IF NOT EXISTS `etudiant_formation` (
  `ID_` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `ID_ETUDIANT` int(11) NOT NULL,
  `ID_FORMATION` int(11) NOT NULL,
  `STATUT` varchar(15) NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `ID_EVENEMENT` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `TITRE` varchar(200) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_EVENEMENT`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `formateur`
--

DROP TABLE IF EXISTS `formateur`;
CREATE TABLE IF NOT EXISTS `formateur` (
  `ID_FORMATEUR` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `ID_DEPARTEMENT` int(11) NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `NOM` varchar(100) NOT NULL,
  `PRENOM` varchar(100) NOT NULL,
  `NUMERO` varchar(100) NOT NULL,
  `CNI` int(11) NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_FORMATEUR`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `ID_FORMATION` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `ID_FORMATEUR` int(11) NOT NULL,
  `ID_DEPARTEMENT` int(11) NOT NULL,
  `TITRE` varchar(200) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL 
  -- PRIMARY KEY (`ID_FORMATION`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `ID_IMAGE` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `ID_ELEMENT` int(11) NOT NULL,
  `TYPE` varchar(150) NOT NULL,
  `IMAGE` varchar(255) NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_IMAGE`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

DROP TABLE IF EXISTS `infos`;
CREATE TABLE IF NOT EXISTS `infos` (
  `ID_INFO` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `TITRE` varchar(150) NOT NULL,
  `DESCRIPTION` longtext NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_INFO`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `ID_MESSAGE` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `NOM` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `NUMERO` varchar(100) NOT NULL,
  `SUJET` varchar(150) NOT NULL,
  `MESSAGE` varchar(200) NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL 
  -- PRIMARY KEY (`ID_MESSAGE`)
) 

-- --------------------------------------------------------

--
-- Table structure for table `temoinage_enseignant`
--

DROP TABLE IF EXISTS `temoinage_enseignant`;
CREATE TABLE IF NOT EXISTS `temoinage_enseignant` (
  `ID_ENSEIGNANT` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `NOM` varchar(200) NOT NULL,
  `POSTE` varchar(200) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DATE_AJOUT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
  -- PRIMARY KEY (`ID_ENSEIGNANT`)
)
