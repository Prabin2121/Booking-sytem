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
) ;
INSERT INTO `appointments` (`appointment_id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`, `patient_name`, `patient_contact`) VALUES
(1, 1, 1, '2024-09-15', '09:00:00', 'John Doe', '555-1234'),
(2, 2, 2, '2024-09-15', '10:00:00', 'Jane Smith', '555-5678');

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'Hello, I am interested in your services.', '2024-09-12 09:06:50'),
(2, 'Jane Smith', 'jane.smith@example.com', 'Can you provide more information about your products?', '2024-09-12 09:06:50');


CREATE TABLE IF NOT EXISTS `doctors` (
  `doctor_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `contact_info` varchar(255) NOT NULL,
  PRIMARY KEY (`doctor_id`)
);


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


CREATE TABLE IF NOT EXISTS `patients` (
  `patient_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `medical_history` text,
  PRIMARY KEY (`patient_id`)
);

INSERT INTO `patients` (`patient_id`, `name`, `contact_info`, `medical_history`) VALUES
(1, 'John Doe', '555-1234', 'No significant medical history'),
(2, 'Jane Smith', '555-5678', 'Allergic to penicillin');
