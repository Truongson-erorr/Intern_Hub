-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 04, 2025 lúc 02:17 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `internhub_tdmu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(5, 'Lập trình Web', 'Các công việc lập trình web frontend & backend', NULL, NULL),
(8, 'DevOps & Cloud', 'Triển khai hệ thống, CI/CD, AWS, Azure', NULL, NULL),
(10, 'Mobile App', 'Phát triển ứng dụng trên Android, iOS, Flutter', NULL, NULL),
(11, 'Database', 'Quản trị cơ sở dữ liệu, tối ưu SQL, MongoDB', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employers`
--

CREATE TABLE `employers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employers`
--

INSERT INTO `employers` (`id`, `name`, `email`, `password`, `phone`, `address`, `website`, `created_at`, `updated_at`) VALUES
(1, 'Công ty ABC Tech', 'contact@abctech.com', '', '0912345678', 'Hà Nội', 'https://abctech.com', NULL, NULL),
(2, 'Công ty XYZ Solutions', 'hr@xyzsolutions.vn', '', '0987654321', 'TP.HCM', 'https://xyzsolutions.vn', NULL, NULL),
(3, 'Công ty MobilePlus', 'info@mobileplus.vn', '', '0901122334', 'Đà Nẵng', 'https://mobileplus.vn', NULL, NULL),
(4, 'Công ty CloudWorks', 'support@cloudworks.vn', '', '0933445566', 'Hà Nội', 'https://cloudworks.vn', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `experience` int(11) DEFAULT 0,
  `candidate_requirements` text DEFAULT NULL,
  `income` text DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `work_location` varchar(255) DEFAULT NULL,
  `work_time` varchar(100) DEFAULT NULL,
  `application_method` text DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `degree_requirements` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `description`, `category_id`, `employer_id`, `location`, `salary`, `created_at`, `updated_at`, `experience`, `candidate_requirements`, `income`, `benefits`, `work_location`, `work_time`, `application_method`, `deadline`, `degree_requirements`) VALUES
(1, 'Frontend Developer', 'Phát triển và tối ưu giao diện người dùng (UI) cho các ứng dụng web hiện đại, đảm bảo hiệu suất, khả năng phản hồi và trải nghiệm người dùng mượt mà. Phối hợp chặt chẽ với đội ngũ backend để tích hợp API, xử lý dữ liệu và triển khai các tính năng tương tác động. Thành thạo HTML, CSS, JavaScript (React, Vue hoặc Angular) là lợi thế lớn.', 5, 1, 'Hà Nội', '15-25 triệu', '2025-09-24 02:44:57', '2025-09-24 02:44:57', 2, '- Có kinh nghiệm với HTML, CSS, JavaScript và ReactJS\n- Biết sử dụng các công cụ quản lý phiên bản Git\n- Hiểu về responsive design và UX/UI cơ bản\n- Có khả năng làm việc nhóm và phối hợp với backend\n- Tư duy logic, giải quyết vấn đề tốt\n- Ưu tiên biết TypeScript hoặc VueJS', '15-25 triệu + thưởng theo hiệu suất', '- Môi trường làm việc thân thiện, năng động\n- Được đào tạo kỹ năng mới và phát triển nghề nghiệp\n- BHXH, BHYT đầy đủ\n- Nghỉ phép theo quy định nhà nước\n- Được cấp Macbook hoặc thiết bị làm việc hiện đại\n- Tham gia team building, sự kiện công ty', 'Hà Nội, quận Hoàn Kiếm', 'Full-time, 8h00 - 17h30', 'Nộp hồ sơ trực tuyến hoặc trực tiếp tại văn phòng', '2025-10-15', 'Tốt nghiệp Cao đẳng/Đại học chuyên ngành IT'),
(2, 'Backend Developer', 'Phát triển backend với Laravel', 5, 2, 'TP.HCM', '18-30 triệu', '2025-09-24 02:44:57', '2025-09-24 02:44:57', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Mobile App Developer', 'Phát triển ứng dụng Android/iOS', 10, 3, 'Đà Nẵng', '12-20 triệu', '2025-09-24 02:44:57', '2025-09-24 02:44:57', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Database Administrator', 'Quản lý cơ sở dữ liệu MySQL, MongoDB', 11, 4, 'Hà Nội', '15-28 triệu', '2025-09-24 02:44:57', '2025-09-24 02:44:57', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Fullstack Developer', 'Phát triển fullstack với Laravel + VueJS', 5, 1, 'Hà Nội', '20-35 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'DevOps Engineer', 'Triển khai CI/CD, quản lý server và cloud', 8, 4, 'Hà Nội', '18-30 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'iOS Developer', 'Phát triển ứng dụng iOS sử dụng Swift', 10, 3, 'Đà Nẵng', '15-25 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Android Developer', 'Phát triển ứng dụng Android sử dụng Kotlin', 10, 3, 'Đà Nẵng', '15-25 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Cloud Architect', 'Thiết kế kiến trúc hạ tầng cloud trên AWS/Azure', 8, 4, 'Hà Nội', '25-40 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Data Analyst', 'Phân tích dữ liệu, báo cáo với SQL & Python.\nBạn sẽ chịu trách nhiệm thu thập, xử lý và trực quan hóa dữ liệu nhằm hỗ trợ ra quyết định chiến lược cho doanh nghiệp.\nThành thạo SQL để truy xuất dữ liệu từ các hệ thống khác nhau, cùng kỹ năng Python (pandas, matplotlib) để làm sạch và phân tích chuyên sâu.\nƯu tiên ứng viên có khả năng sử dụng Power BI hoặc Tableau và tư duy phân tích logic, chi tiết.', 11, 2, 'TP.HCM', '12-22 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Database Developer', 'Phát triển và tối ưu database MySQL/MongoDB', 11, 1, 'Hà Nội', '15-28 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Backend Java Developer', 'Phát triển backend với Java Spring Boot', 5, 2, 'TP.HCM', '18-30 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `cv_path` varchar(255) NOT NULL,
  `introduction` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `user_id`, `cv_path`, `introduction`, `created_at`, `updated_at`) VALUES
(10, 1, 6, 'cvs/0NNvqyeu9sC4Q1WVc5KLKjHHBwt9dLWs9w8p8hoN.pdf', 'hi', '2025-11-03 18:01:21', '2025-11-03 18:01:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `role` enum('user','employer','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `phone`, `address`, `resume`, `role`, `created_at`, `updated_at`) VALUES
(4, 'Diệp Phương Anh', 'dpa@gmail.com', '$2y$12$RqZCc9bUjWBd.TdJwgx1w.3t04SDoD.eU6GO/EPcBMe/RJECj.I42', NULL, NULL, NULL, NULL, 'user', '2025-09-23 19:25:27', '2025-09-23 19:25:27'),
(6, 'Cao niên Trường Sơn', 'son@gmail.com', '$2y$12$ydSc9GQax/IlUUDhJhgT4eXNu9yaNqlGCRxXvOoBdzBuhm6tN6mUG', 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgzxAeW8J9uNlYPOp6_sspakIiVN14YMcPRxbo9c65TS_jFBtE5rkuCsqpMQUSvbsc4oKWb8NlFeF4WC6Q6kAelrzbXV9PrNE_C3Em4vi1X05cgVTi2uQ0YN7EFmLMvaMOyP9kXv_KQ2EY/s0/image.png', '0396197501', '97/25/10 tổ 21 khu 3', NULL, 'user', '2025-10-28 08:09:23', '2025-10-28 15:27:26');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jobs_category` (`category_id`),
  ADD KEY `fk_jobs_employer` (`employer_id`);

--
-- Chỉ mục cho bảng `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job` (`job_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `employers`
--
ALTER TABLE `employers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `fk_jobs_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_jobs_employer` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `fk_job` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
