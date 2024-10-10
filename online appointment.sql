-- phpMyAdmin SQL Dump
-- version 5.2.0
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 12, 2024 at 09:48 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `online appointment`

-- Drop the appointments table if it exists
DROP TABLE IF EXISTS `appointments`;

-- Create the appointments table with the required fields
CREATE TABLE IF NOT EXISTS `appointments` (
  `appointment_id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int DEFAULT NULL,
  `doctor_id` int DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `patient_contact` varchar(255) NOT NULL,
  PRIMARY KEY (`appointment_id`),
  UNIQUE KEY `appointment_unique` (`appointment_date`, `appointment_time`, `doctor_id`),
  KEY `patient_id` (`patient_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insert sample data into the appointments table
INSERT INTO `appointments` (`appointment_id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`, `patient_name`, `patient_contact`) VALUES
(1, 1, 1, '2024-09-15', '09:00:00', 'John Doe', '555-1234'),
(2, 2, 2, '2024-09-15', '10:00:00', 'Jane Smith', '555-5678');

-- Drop the contacts table if it exists
DROP TABLE IF EXISTS `contacts`;

-- Create the contacts table
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insert sample data into the contacts table
INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'Hello, I am interested in your services.', '2024-09-12 09:06:50'),
(2, 'Jane Smith', 'jane.smith@example.com', 'Can you provide more information about your products?', '2024-09-12 09:06:50');

-- Drop the doctors table if it exists
DROP TABLE IF EXISTS `doctors`;

-- Create the doctors table
CREATE TABLE IF NOT EXISTS `doctors` (
  `doctor_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `contact_info` varchar(255) NOT NULL,
  PRIMARY KEY (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insert sample data into the doctors table
INSERT INTO `doctors` (`doctor_id`, `name`, `specialty`, `contact_info`) VALUES
(1, 'Dr. Alice Brown', 'Pediatrician', '555-8765'),
(2, 'Dr. Bob Johnson', 'Dermatologist', '555-4321'),
(3, 'Dr. Sid Gupta', 'Cardiologist', '555-8765'),
(4, 'Dr. Gautam Bhandari', 'Dermatologist', '555-4321'),
(5, 'Dr. Prabin Gautam', 'Dentist', '555-4321'),
(6, 'Dr. Ram Singh', 'Pediatrician', '555-8765'),
(7, 'Dr. Pritam Poudel', 'Dermatologist', '555-4321'),
(8, 'Dr. Alice Reddy', 'Surgeon', '555-4321'),
(9, 'Dr. Bob Raid', 'Surgeon', '555-8765'),
(10, 'Dr. Ram Setu', 'Dermatologist', '555-4321');

-- Drop the patients table if it exists
DROP TABLE IF EXISTS `patients`;

-- Create the patients table
CREATE TABLE IF NOT EXISTS `patients` (
  `patient_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `medical_history` text,
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insert sample data into the patients table
INSERT INTO `patients` (`patient_id`, `name`, `contact_info`, `medical_history`) VALUES
(1, 'John Doe', '555-1234', 'No significant medical history'),
(2, 'Jane Smith', '555-5678', 'Allergic to penicillin');

COMMIT;
