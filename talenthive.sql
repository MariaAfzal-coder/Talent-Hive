-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 08:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `talenthive`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `project_id`, `company_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 40, 808, 'hello', '2024-11-20 12:40:28', '2024-11-20 12:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `phonenumber` varchar(20) DEFAULT NULL,
  `nationaltaxnumber` varchar(50) DEFAULT NULL,
  `location` mediumtext DEFAULT NULL,
  `technologies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`technologies`)),
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `phonenumber`, `nationaltaxnumber`, `location`, `technologies`, `profile_image`) VALUES
(808, 'Tera data', 'teradata@gmail.com', '$2y$10$nyBRdUP8F5W/ZhwF9zagVe44aFULVC7judzs8XQL9HjMmBwTxdQr6', '2024-11-20 03:43:42', '2024-11-20 08:24:38', '0355657775', '67667', 'Marvel Arcade, Executive Block Gulberg, greens, Islamabad, Islamabad Capital Territory 44000', '[\"HTML\\/CSS\",\"C++\",\"Java\",\"MySQL\",null,null,null,null]', 'downloads/vyEkTQ3dCMEr6YxTSKL2qlhTzBDX7ic6aD6BeGlv.png');

-- --------------------------------------------------------

--
-- Table structure for table `company_students_chat`
--

CREATE TABLE `company_students_chat` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_students_chat`
--

INSERT INTO `company_students_chat` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `updated_at`) VALUES
(228, 808, 20, 'hello', '2024-11-20 09:36:26', '2024-11-20 09:36:26'),
(229, 20, 808, 'hi', '2024-11-20 09:37:15', '2024-11-20 09:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `cvs`
--

CREATE TABLE `cvs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `profile` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `additional_info` text DEFAULT NULL,
  `education` text NOT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills`)),
  `languages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`languages`)),
  `work_experience` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cvs`
--

INSERT INTO `cvs` (`id`, `student_id`, `image`, `name`, `profile`, `phone`, `email`, `address`, `additional_info`, `education`, `skills`, `languages`, `work_experience`, `created_at`, `updated_at`) VALUES
(4, 20, 'cv_images/ZdkqoH38P0BeJBIJR5OIahBDRbFlPINLDwCaHYgC.jpg', 'Maria Afzal', 'Software Engineering student.\r\nI consider my self a responsible and orderly person .I\r\nhave some experience of my field throughout my\r\ninternship.\r\nI am looking forward for my first job experience.', '0311 5141460', 'mariaafzal2002@gmail.com', 'Islamabad', NULL, '(2007-2016)\r\nThe Educators\r\n(2017-2019)\r\nSir Syed Girls College Tipu Road\r\n(2021-2025)\r\nRiphah International University\r\nSoftware Engineering career, in progress.\r\nCurrently in 8th semester', '[\"Graphic Designing\",\"Java\\/Web development in html and php\",\"Documentation for constructing any software\"]', '[\"Java\",\"C++\",\"HTML\\/CSS\",\"PHP\",\"MySQL\"]', 'Internship at Digital Empowerment Network as a Frontend Developer\r\nInternship at Ezitech Institute as a Frontend Developer', '2024-11-20 08:16:54', '2024-11-20 08:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `session` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `incharge_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('In Progress','Completed') DEFAULT 'In Progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_project`
--

CREATE TABLE `event_project` (
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incharges`
--

CREATE TABLE `incharges` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `phone` varchar(20) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incharges`
--

INSERT INTO `incharges` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `phone`, `profile_image`) VALUES
(5, 'Tazzaina Malik', 'Tazzainamalik@gmail.com', '$2y$10$RZ4ONb5QWhCDH0vT5xM68.VTUVHKCoZUI480lII7DGgmc.BNM51fG', '2024-11-20 08:32:34', '2024-11-20 08:33:35', '030295355776', 'profile_images/WNRuu9ePZgdT8J6WpIcvuqoA5jnU1XBsN1JMPiZt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `interview_schedules`
--

CREATE TABLE `interview_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('hired','not_hired','interview_inprocess') NOT NULL DEFAULT 'interview_inprocess'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview_schedules`
--

INSERT INTO `interview_schedules` (`id`, `company_id`, `student_id`, `date`, `time`, `venue`, `created_at`, `updated_at`, `status`) VALUES
(62, 808, 20, '2024-11-25', '22:29:00', 'A212', '2024-11-20 09:31:29', '2024-11-20 13:34:55', 'hired');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ending_date` date NOT NULL,
  `abstract` text NOT NULL,
  `student_id` int(10) DEFAULT NULL,
  `languages` text NOT NULL,
  `supervised_by` varchar(255) NOT NULL,
  `video_url` varchar(2550) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `progress` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `status`, `image`, `ending_date`, `abstract`, `student_id`, `languages`, `supervised_by`, `video_url`, `created_at`, `updated_at`, `progress`) VALUES
(40, 'Talent Hive', 'In Progress', 'project_images/FkvlypvWXqZaEwJChJ7Sj9WXLQM2iBUJWeACGk4P.jpg', '2024-11-21', 'Talent Hive is a centralized platform which offers automation to the Open House \r\nManagement System that will revolutionize the way educational institutions organize and \r\nmanage their Open House event. The system complements a wide array of needs of five \r\nkey stakeholders. These include the Incharge, Students, Tech Companies, Supervisors and \r\nGuests. There is a broader range of opportunities offered by the system to these \r\nstakeholders', NULL, '[\"HTML\\/CSS\",\"JavaScript\",\"PHP\",\"Laravel\",\"MySQL\"]', '4', 'project_videos/OHHjcBGs0EFulzHZxwhI6SiTTAZCuy5giZ0mFEzj.mp4', '2024-11-20 08:06:18', '2024-11-20 08:40:43', 90),
(43, 'klkvf', 'Completed', 'project_images/U1FqlwTyUicobqjgPIIZQHb1Ynu82oCdEeajl0cw.png', '2024-11-21', 'kll', NULL, '[\"Node.js\"]', '4', 'project_videos/Jm9IjDTn0kJVaIxecYPhIUtBbOFpHCgTu4TOlJB5.mp4', '2024-11-20 13:40:08', '2024-11-20 13:40:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`id`, `project_id`, `student_id`, `created_at`, `updated_at`) VALUES
(35, 40, 21, '2024-11-20 13:06:18', '2024-11-20 13:06:18'),
(36, 40, 22, '2024-11-20 13:06:18', '2024-11-20 13:06:18'),
(37, 40, 20, '2024-11-20 13:06:18', '2024-11-20 13:06:18'),
(41, 43, 23, '2024-11-20 18:40:08', '2024-11-20 18:40:08'),
(42, 43, 25, '2024-11-20 18:40:08', '2024-11-20 18:40:08'),
(43, 43, 24, '2024-11-20 18:40:08', '2024-11-20 18:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sapid` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `phone` varchar(15) DEFAULT NULL,
  `cgpa` decimal(3,2) DEFAULT NULL,
  `sdp` varchar(50) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `certification_status` enum('not_awarded','awarded') DEFAULT 'not_awarded',
  `certification_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `sapid`, `created_at`, `updated_at`, `phone`, `cgpa`, `sdp`, `department`, `profile_image`, `certification_status`, `certification_image`) VALUES
(3, 'Nawal', 'student@gmail.com', '$2y$10$wghpl2pCLqssVTUsvHcVgeqR9iUHimoIY8y0WqKEvF2LyCOgRzlm2', '29220', '2024-10-04 17:30:16', '2024-11-20 02:17:20', '64634', 2.60, 'Part-1', 'Software Engineering', 'downloads/HnniTKTjIDKolOfB1r1LL8iAzKZ975Kj4XocmrGM.png', 'awarded', '/assets/images/sdp1.png'),
(20, 'Maria Afzal', 'mariaafzal2002@gmail.com', '$2y$10$I66wELAwuNSbrSsNr/LoTechqzehQz7TEkil75pC5Z03OSVMAbjvi', '28010', '2024-11-20 01:27:44', '2024-11-20 11:33:31', '0311 5141460', 3.40, 'Part-2', 'Software Engineering', 'downloads/8RVSZJWo6FWJNWLfUJG6dgqngjRdFpqsj0aEnKgv.png', 'not_awarded', NULL),
(21, 'Nawal khan', 'khannawal900@gmail.com', '$2y$10$SyUfo3OHSEIExYajxXwbneTKjoJ6HJ.V4nIZ.JVpiHzyNzsmWNyr.', '27704', '2024-11-20 02:50:17', '2024-11-20 04:01:21', '03265704727', 3.50, 'Part-2', 'Software Engineering', 'downloads/KRhjgw6H98IZpvlY9UpNADMKMvG9YknIPxGfggFH.jpg', 'not_awarded', NULL),
(22, 'Syeda Waiza Batool', 'syedwaizabatool@gmail.com', '$2y$10$wpmnSB3lurild2p3U1aViO/XYczXR7JudNChpQdRs97P0wwOxFduy', '28592', '2024-11-20 02:50:58', '2024-11-20 04:00:14', '03029535577', 3.90, 'Part-2', 'Software Engineering', 'downloads/Q4juR5sIj7siM8a0lhFzJxnrDO4wGyTNM1TfDU3V.jpg', 'not_awarded', NULL),
(23, 'Kinza', 'kinza@gmail.com', '$2y$10$vodkzc0emffvwpRoDq2YtuzMSBZdKrOmIr/lC1k5Vh1iyoeMb9Gxe', '1234', '2024-11-20 11:04:39', '2024-11-20 11:05:34', '676767676', 3.20, 'Part-2', 'Software Engineering', 'downloads/aW6sd6cfZ5geH7jl2YrLdplBMCWTgTziWg3VFssh.jpg', 'not_awarded', NULL),
(24, 'Hamna', 'hamna@gmail.com', '$2y$10$scBW/ItD9h15A6.b5uFRZus9cN1TFLj4c8SjyWxvwq2pykuh9DEkm', '87879', '2024-11-20 11:06:30', '2024-11-20 11:07:42', '98787486578', 3.20, 'Part-2', 'Software Engineering', 'downloads/NHV7nA3ydrdztVMCv7Ya1jdFKRAGFF8TCTnPvFbc.jpg', 'not_awarded', NULL),
(25, 'Laiba', 'laiba@gmail.com', '$2y$10$TgA7VOeuieDZ0jKxLj9WNOZbRzGDDkWfyjuRoqvks8BEYv87eigvC', '65676', '2024-11-20 11:11:34', '2024-11-20 11:12:27', '7657646514', 2.00, 'Part-2', 'Software Engineering', 'downloads/fcSxg3eW8a2ihieJEkfQ3x0VXbLq3hnBm0eRK7Ch.jpg', 'not_awarded', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_events_attendance`
--

CREATE TABLE `students_events_attendance` (
  `id` int(11) NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `incharge_id` int(10) UNSIGNED NOT NULL,
  `status` enum('Present','Absent') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `biography` text DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `additional_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `education` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`education`)),
  `experience` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`experience`)),
  `awards_courses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`awards_courses`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `biography`, `phone_number`, `profile_image`, `additional_details`, `education`, `experience`, `awards_courses`) VALUES
(4, 'Mehwish javed', 'mehwishjaved@gmail.com', '$2y$10$SNB1D9y6jJ3vx792LAahluDKdQsgtz1rabbKYD8IkBqFTHzkOMkn6', '2024-11-20 03:19:44', '2024-11-20 03:36:29', 'Ms. Mehwish Javed is a dedicated lecturer in Software Engineering at Riphah International University, with a passion for teaching and research. With a background in computer science and extensive experience in software development, Ms. Mehwish Javed brings both theoretical knowledge and practical expertise to the classroom. Their research interests include software architecture, agile development methodologies, and machine learning. Committed to fostering student success, Ms. Mehwish Javed strives to inspire the next generation of software engineers through engaging coursework, hands-on projects, and mentorship.', '03015815453', 'profile_images/oko2Apmy4aJH4acZdHlqDrTabcvhQvi7PQBezWqQ.png', NULL, '[{\"degree\":\"MS Software Engineering\",\"year\":\"2019\",\"university\":\"COMSATS University\"},{\"degree\":\"BS Software Engineering\",\"year\":\"2015\",\"university\":\"Riphah International University\"}]', '[{\"post_hold\":\"Junior Lecturer\",\"from_year\":\"2021\",\"to_year\":\"2022\"},{\"post_hold\":\"Lecturer\",\"from_year\":\"2022\",\"to_year\":\"2024\"}]', '[{\"title\":\"Software Engineering\",\"year\":\"2016\",\"organization\":\"Coursera\"},{\"title\":\"IEEE\",\"year\":\"2018\",\"organization\":\"IEEE\"},{\"title\":\"Research Excellence\",\"year\":\"2022\",\"organization\":\"Riphah International University\"}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `company_students_chat`
--
ALTER TABLE `company_students_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvs`
--
ALTER TABLE `cvs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cvs_student` (`student_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incharge_id` (`incharge_id`);

--
-- Indexes for table `event_project`
--
ALTER TABLE `event_project`
  ADD PRIMARY KEY (`event_id`,`project_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `incharges`
--
ALTER TABLE `incharges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `interview_schedules`
--
ALTER TABLE `interview_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_project` (`project_id`),
  ADD KEY `fk_student` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `sapid` (`sapid`);

--
-- Indexes for table `students_events_attendance`
--
ALTER TABLE `students_events_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `incharge_id` (`incharge_id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=809;

--
-- AUTO_INCREMENT for table `company_students_chat`
--
ALTER TABLE `company_students_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `cvs`
--
ALTER TABLE `cvs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `incharges`
--
ALTER TABLE `incharges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `interview_schedules`
--
ALTER TABLE `interview_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `project_members`
--
ALTER TABLE `project_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `students_events_attendance`
--
ALTER TABLE `students_events_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cvs`
--
ALTER TABLE `cvs`
  ADD CONSTRAINT `fk_cvs_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`incharge_id`) REFERENCES `incharges` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_project`
--
ALTER TABLE `event_project`
  ADD CONSTRAINT `event_project_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_project_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `fk_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students_events_attendance`
--
ALTER TABLE `students_events_attendance`
  ADD CONSTRAINT `students_events_attendance_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_events_attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_events_attendance_ibfk_3` FOREIGN KEY (`incharge_id`) REFERENCES `incharges` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
