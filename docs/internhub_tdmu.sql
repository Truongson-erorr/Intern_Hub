-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 03, 2025 lúc 11:55 AM
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
(5, 'Web', 'Các công việc lập trình web frontend & backend', NULL, NULL),
(8, 'Cloud', 'Triển khai hệ thống, CI/CD, AWS, Azure', NULL, NULL),
(10, 'Mobile', 'Phát triển ứng dụng trên Android, iOS, Flutter', NULL, NULL),
(11, 'Database', 'Quản trị cơ sở dữ liệu, tối ưu SQL, MongoDB', NULL, NULL),
(13, 'Data', 'Phân tích dữ liệu, Machine Learning, AI', '2025-12-03 10:16:51', '2025-12-03 10:16:51'),
(14, 'Cyber', 'Bảo mật hệ thống, pentest, an ninh mạng', '2025-12-03 10:16:51', '2025-12-03 10:16:51'),
(15, 'UI/UX ', 'Thiết kế giao diện, trải nghiệm người dùng', '2025-12-03 10:16:51', '2025-12-03 10:16:51'),
(16, 'Game ', 'Lập trình game Unity, Unreal Engine', '2025-12-03 10:16:51', '2025-12-03 10:16:51'),
(17, 'Testing', 'Kiểm thử phần mềm, QA/QC', '2025-12-03 10:16:51', '2025-12-03 10:16:51'),
(18, 'Blockchain', 'Công nghệ chuỗi khối, Smart Contract', '2025-12-03 10:16:51', '2025-12-03 10:16:51'),
(19, 'iot', 'Thiết bị thông minh, cảm biến, hệ thống IoT', '2025-12-03 10:16:51', '2025-12-03 10:16:51'),
(20, 'AI', 'Triển khai mô hình AI, LLM, hệ thống thông minh', '2025-12-03 10:16:51', '2025-12-03 10:16:51');

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
(2, 'Backend Developer', 'Xây dựng, phát triển và tối ưu hệ thống backend bằng Laravel, đảm bảo cấu trúc code sạch, dễ bảo trì và hiệu năng cao. Thiết kế cơ sở dữ liệu, xây dựng API RESTful, triển khai logic nghiệp vụ và quản lý luồng dữ liệu giữa frontend và server. Thực hiện phân quyền, xác thực, bảo mật hệ thống và tối ưu truy vấn SQL. Phối hợp chặt chẽ với đội frontend để tích hợp API và phát triển các tính năng mới. Đảm bảo hệ thống hoạt động ổn định, có khả năng mở rộng và đáp ứng lượng truy cập lớn. Có kinh nghiệm với Laravel ORM, Queue, Scheduler, Middleware, Event-Listener và tối ưu hiệu suất PHP là lợi thế.\n', 5, 2, 'TP.HCM', '18-30 triệu', '2025-09-24 02:44:57', '2025-09-24 02:44:57', 3, '- Thành thạo PHP và framework Laravel (ORM Eloquent, Migration, Middleware, Event-Listener, Queue)\n- Hiểu vững kiến trúc MVC, RESTful API và mô hình Microservices là lợi thế\n- Có kinh nghiệm thiết kế và tối ưu cơ sở dữ liệu MySQL hoặc PostgreSQL\n- Biết sử dụng Git (branching workflow), hiểu CI/CD cơ bản\n- Nắm vững kỹ thuật bảo mật backend: authentication, authorization, CSRF, XSS, SQL Injection\n- Có khả năng làm việc với Redis, Queue worker hoặc Scheduler\n- Ưu tiên có kinh nghiệm triển khai hệ thống lên VPS, Docker hoặc cloud (AWS, GCP)\n- Tư duy logic tốt, cẩn thận, biết debug và tối ưu hiệu suất ứng dụng\n- Kỹ năng làm việc nhóm, giao tiếp tốt và chủ động trong công việc\n', '18-30 triệu tùy kinh nghiệm + thưởng dự án và thưởng hiệu suất\n', '- Môi trường làm việc trẻ, chuyên nghiệp, sử dụng công nghệ mới\n- Tham gia phát triển các hệ thống có lượng người dùng lớn\n- Lộ trình thăng tiến rõ ràng theo cấp bậc Backend Engineer\n- Thưởng lương tháng 13, thưởng dự án và các khoản thưởng khác\n- Bảo hiểm đầy đủ theo quy định, phụ cấp gửi xe và ăn trưa\n- Được hỗ trợ tham gia khóa học, chứng chỉ Laravel/PHP/AWS\n- Du lịch, team building và hoạt động nội bộ định kỳ\n', 'TP.HCM, Quận 1\n', 'Full-time, 9:00 – 18:00 (Thứ 2 – Thứ 6)\n', 'Gửi CV qua email HR hoặc nộp trực tiếp qua website tuyển dụng của công ty\n', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học các ngành CNTT, Khoa học máy tính hoặc liên quan\n'),
(3, 'Mobile App Developer', 'Phát triển ứng dụng di động trên nền tảng Android và iOS, sử dụng Flutter hoặc native (Kotlin/Swift). Thiết kế giao diện, tối ưu trải nghiệm người dùng và hiệu năng ứng dụng. Phối hợp với backend để tích hợp API, xử lý dữ liệu và triển khai các tính năng tương tác. Đảm bảo ứng dụng hoạt động ổn định trên nhiều thiết bị và phiên bản OS. Thực hiện kiểm thử, debug, bảo trì và cập nhật ứng dụng định kỳ.\n', 10, 3, 'TP.HCM', '12-20 triệu', '2025-09-24 02:44:57', '2025-09-24 02:44:57', 1, '- Thành thạo Flutter hoặc Kotlin/Swift (tùy nền tảng)\n- Kinh nghiệm tích hợp RESTful API, JSON, Firebase\n- Hiểu cơ bản về quản lý trạng thái (State Management) và architecture pattern (MVC, MVVM, BLoC)\n- Biết Git, version control và CI/CD cơ bản\n- Tư duy logic, giải quyết vấn đề tốt, chăm chút trải nghiệm người dùng\n- Ưu tiên có kinh nghiệm triển khai ứng dụng lên App Store/Google Play\n- Kỹ năng làm việc nhóm và giao tiếp tốt\n', '12-20 triệu tùy kinh nghiệm + thưởng dự án\n', '- Môi trường làm việc năng động, công nghệ hiện đại\n- Tham gia dự án mobile app đa lĩnh vực\n- Lương tháng 13, thưởng dự án, review lương định kỳ\n- BHXH, BHYT đầy đủ, phụ cấp ăn trưa, gửi xe\n- Được hỗ trợ học tập Flutter/Native và các khóa nâng cao\n- Team building, du lịch công ty hàng năm\n', 'TP.HCM, Quận 7\n', 'Full-time, 9:00 – 18:00 (Thứ 2 – Thứ 6)\n', 'Gửi CV qua email HR hoặc nộp trực tiếp tại văn phòng\n', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học các ngành CNTT, Khoa học máy tính hoặc liên quan\n'),
(4, 'Database Administrator', 'Quản trị, vận hành và tối ưu cơ sở dữ liệu doanh nghiệp, bao gồm MySQL, PostgreSQL, MongoDB hoặc Oracle. Thực hiện backup, restore, migration dữ liệu, tối ưu truy vấn, quản lý phân quyền và bảo mật dữ liệu. Hỗ trợ đội phát triển backend trong việc thiết kế cơ sở dữ liệu, tối ưu performance và khắc phục sự cố. Giám sát hiệu năng hệ thống, đề xuất cải tiến và đảm bảo cơ sở dữ liệu hoạt động ổn định, đáng tin cậy.\n', 11, 4, 'Hà Nội', '15-28 triệu', '2025-09-24 02:44:57', '2025-09-24 02:44:57', 3, '- Thành thạo MySQL, PostgreSQL hoặc MongoDB, có kinh nghiệm tối ưu truy vấn\n- Hiểu rõ các khái niệm backup, restore, replication, clustering\n- Kinh nghiệm với Linux/Unix và scripting (Shell, Python) để tự động hóa tác vụ\n- Biết phân quyền, bảo mật dữ liệu và quản lý người dùng\n- Kinh nghiệm giám sát hiệu năng DB (Monitoring, Query optimization)\n- Kỹ năng troubleshooting, giải quyết sự cố và bảo trì hệ thống\n- Ưu tiên có chứng chỉ DBA (Oracle, Microsoft SQL, MySQL)\n- Tư duy logic, cẩn thận, làm việc nhóm tốt\n', '18-28 triệu tùy kinh nghiệm + thưởng dự án / hiệu suất\n', '- Môi trường làm việc chuyên nghiệp, hệ thống database lớn\n- Tham gia các dự án enterprise, fintech, e-commerce\n- Lương tháng 13, review lương định kỳ, thưởng dự án\n- BHXH, BHYT đầy đủ, phụ cấp ăn trưa, gửi xe\n- Được hỗ trợ học chứng chỉ DBA và các khóa nâng cao\n- Team building, du lịch công ty hàng năm\n', 'Hà Nội, Quận Hoàn Kiếm\n', 'Full-time, 8:30 – 17:30 (Thứ 2 – Thứ 6)\n', 'Gửi CV qua email HR hoặc nộp trực tiếp tại văn phòng\n', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học các ngành CNTT, Khoa học máy tính hoặc liên quan\n'),
(5, 'Fullstack Developer', 'Phát triển cả frontend và backend cho các ứng dụng web. Xây dựng API, xử lý dữ liệu, tối ưu hiệu suất và đảm bảo trải nghiệm người dùng mượt mà. Thiết kế cơ sở dữ liệu, triển khai logic nghiệp vụ và phối hợp chặt chẽ với đội frontend/backend để tích hợp các tính năng. Thực hiện kiểm thử, debug, bảo trì và cập nhật ứng dụng định kỳ. Áp dụng các framework hiện đại như Laravel/NodeJS cho backend và React/Vue cho frontend.\n', 5, 1, 'TP.HCM', '20-35 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 3, '- Thành thạo ít nhất một backend framework (Laravel, NodeJS, Django)\n- Biết React hoặc VueJS ở frontend\n- Hiểu về REST API, cơ sở dữ liệu SQL/NoSQL\n- Có kinh nghiệm với Git, Docker và CI/CD cơ bản\n- Kỹ năng bảo mật backend và tối ưu hiệu suất ứng dụng\n- Khả năng giải quyết vấn đề độc lập, tư duy logic tốt\n- Kỹ năng làm việc nhóm, phối hợp với frontend, QA và DevOps\n- Ưu tiên có kinh nghiệm triển khai hệ thống trên cloud (AWS, GCP)\n', '20-40 triệu tùy kinh nghiệm + thưởng dự án và hiệu suất\n', '- Môi trường làm việc năng động, sử dụng công nghệ hiện đại\n- Tham gia dự án đa lĩnh vực, exposure nhiều công nghệ\n- Lương tháng 13, thưởng dự án, review lương định kỳ\n- BHXH, BHYT đầy đủ, phụ cấp ăn trưa, gửi xe\n- Được hỗ trợ học tập nâng cao kỹ năng frontend/backend và cloud\n- Team building, du lịch công ty định kỳ\n', 'TP.HCM, Quận 1\n', 'Full-time, 8:30 – 17:30 (Thứ 2 – Thứ 6)\n', 'Gửi CV qua email HR hoặc nộp trực tiếp qua website tuyển dụng\n', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học các ngành CNTT, Khoa học máy tính hoặc liên quan\n'),
(6, 'DevOps Engineer', 'Thiết kế, triển khai và quản lý hạ tầng hệ thống, đảm bảo CI/CD, deploy tự động, giám sát và vận hành các ứng dụng. Quản lý cloud (AWS, Azure, GCP), containerization (Docker, Kubernetes) và tự động hóa các quy trình triển khai. Phối hợp với đội phát triển để tối ưu pipeline, kiểm soát version, backup và recovery. Giám sát hiệu suất hệ thống, xử lý sự cố, đảm bảo uptime và bảo mật.\n', 8, 4, 'TP.HCM', '18-30 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 2, '- Thành thạo Linux/Unix, scripting (Bash, Python)\n- Kinh nghiệm với CI/CD pipeline, Docker, Kubernetes\n- Quản lý cloud (AWS, Azure hoặc GCP), deploy và scaling ứng dụng\n- Hiểu về version control (Git), configuration management (Ansible, Terraform)\n- Kỹ năng giám sát hệ thống (Prometheus, Grafana, ELK stack)\n- Khả năng giải quyết sự cố, tối ưu hiệu năng hệ thống\n- Tư duy logic, cẩn thận, làm việc nhóm tốt\n- Ưu tiên có chứng chỉ DevOps hoặc cloud (AWS Certified, Azure DevOps)\n', '18-30 triệu tùy kinh nghiệm + thưởng dự án / hiệu suất\n', '- Môi trường làm việc chuyên nghiệp, công nghệ hiện đại\n- Tham gia dự án cloud, hạ tầng hệ thống quy mô lớn\n- Lương tháng 13, thưởng dự án, review lương định kỳ\n- BHXH, BHYT đầy đủ, phụ cấp ăn trưa và gửi xe\n- Hỗ trợ học chứng chỉ DevOps và cloud nâng cao\n- Team building, du lịch công ty hàng năm\n', 'TP.HCM, Quận 7\n', 'Full-time, 9:00 – 18:00 (Thứ 2 – Thứ 6)\n', 'Gửi CV qua email HR hoặc nộp trực tiếp tại văn phòng\n', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học các ngành CNTT, Khoa học máy tính hoặc liên quan\n'),
(7, 'iOS Developer', 'Phát triển ứng dụng iOS trên nền tảng Swift và Objective-C, xây dựng giao diện người dùng, tích hợp API từ backend, tối ưu hiệu năng và đảm bảo trải nghiệm mượt mà cho người dùng. Tham gia thiết kế, triển khai, kiểm thử và bảo trì ứng dụng. Phối hợp với đội mobile và backend để đảm bảo tính năng hoạt động ổn định trên nhiều phiên bản iOS và thiết bị khác nhau.\n', 10, 3, 'TP.HCM', '15-25 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 2, '- Thành thạo Swift, Objective-C và iOS SDK\n- Kinh nghiệm xây dựng RESTful API, JSON parsing, Core Data\n- Hiểu về MVC, MVVM, Design Patterns trong iOS\n- Biết sử dụng Git và làm việc với CI/CD cho iOS\n- Kinh nghiệm triển khai ứng dụng lên App Store\n- Tư duy logic, giải quyết vấn đề tốt, chăm chút trải nghiệm người dùng\n- Kỹ năng làm việc nhóm và giao tiếp tốt\n- Ưu tiên có kinh nghiệm với SwiftUI hoặc Combine\n', '18-35 triệu tùy kinh nghiệm + thưởng dự án\n', '- Môi trường làm việc chuyên nghiệp, sử dụng công nghệ hiện đại\n- Tham gia phát triển các dự án ứng dụng đa lĩnh vực\n- Lương tháng 13, thưởng dự án, review định kỳ\n- BHXH, BHYT đầy đủ, phụ cấp ăn trưa và gửi xe\n- Hỗ trợ học tập nâng cao kỹ năng Swift, iOS SDK và UI/UX\n- Team building, du lịch công ty hàng năm\n', 'TP.HCM, Quận 1\n', 'Full-time, 9:00 – 18:00 (Thứ 2 – Thứ 6)\n', 'Gửi CV qua email HR hoặc nộp trực tiếp tại văn phòng\n', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học các ngành CNTT, Khoa học máy tính hoặc liên quan\n'),
(8, 'Android Developer', 'Phát triển ứng dụng Android sử dụng Kotlin hoặc Java, xây dựng giao diện, tích hợp API từ backend và tối ưu hiệu năng ứng dụng. Tham gia thiết kế, triển khai, kiểm thử và bảo trì ứng dụng. Đảm bảo ứng dụng hoạt động ổn định trên nhiều phiên bản Android và thiết bị khác nhau, phối hợp chặt chẽ với đội mobile và backend để triển khai các tính năng mới.\n', 10, 3, 'TP.HCM', '18-25 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 2, '- Thành thạo Kotlin và/hoặc Java, Android SDK\n- Kinh nghiệm làm việc với RESTful API, JSON parsing, Room/SQLite\n- Hiểu về MVC, MVVM, Design Patterns trong Android\n- Biết sử dụng Git và CI/CD cho Android\n- Kinh nghiệm triển khai ứng dụng lên Google Play Store\n- Tư duy logic, giải quyết vấn đề tốt, chăm chút trải nghiệm người dùng\n- Kỹ năng làm việc nhóm, phối hợp với QA, backend\n- Ưu tiên có kinh nghiệm với Jetpack Compose hoặc RxJava\n', '18-25 triệu tùy kinh nghiệm + thưởng dự án\n', '- Môi trường làm việc chuyên nghiệp, công nghệ hiện đại\n- Tham gia phát triển dự án đa lĩnh vực\n- Lương tháng 13, thưởng dự án, review lương định kỳ\n- BHXH, BHYT đầy đủ, phụ cấp ăn trưa và gửi xe\n- Hỗ trợ học tập nâng cao kỹ năng Android, Kotlin, Jetpack Compose\n- Team building, du lịch công ty hàng năm\n', 'TP.HCM, Quận 2', 'Full-time, 9:00 – 18:00 (Thứ 2 – Thứ 6)\n', 'Gửi CV qua email HR hoặc nộp trực tiếp tại văn phòng\n', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học các ngành CNTT, Khoa học máy tính hoặc liên quan\n'),
(9, 'Cloud Architect', 'Thiết kế, triển khai và quản lý kiến trúc hạ tầng cloud trên AWS, Azure hoặc GCP. Đảm bảo hệ thống có khả năng mở rộng, an toàn, hiệu suất cao và sẵn sàng phục vụ doanh nghiệp. Phối hợp với các đội phát triển, DevOps và bảo mật để triển khai giải pháp cloud toàn diện. Tham gia xây dựng chiến lược cloud, giám sát hiệu suất, tối ưu chi phí và đảm bảo tính liên tục của hệ thống.\n', 8, 4, 'TP.HCM', '35-60 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 5, '- Thành thạo các nền tảng cloud (AWS, Azure hoặc GCP)\n- Kinh nghiệm thiết kế kiến trúc hệ thống, network, security và storage trên cloud\n- Hiểu CI/CD, containerization (Docker, Kubernetes), microservices\n- Biết sử dụng các công cụ giám sát và quản lý cloud (CloudWatch, Stackdriver, Azure Monitor)\n- Kỹ năng scripting/automation (Python, Bash)\n- Khả năng phân tích, giải quyết vấn đề, tư duy kiến trúc tốt\n- Có chứng chỉ cloud (AWS Solutions Architect, Azure Solutions Architect, GCP Professional Cloud Architect) là lợi thế\n- Kỹ năng giao tiếp, làm việc nhóm và quản lý dự án\n', '35-60 triệu tùy kinh nghiệm + thưởng dự án / hiệu suất\n', '- Môi trường làm việc chuyên nghiệp, công nghệ hiện đại\n- Tham gia các dự án cloud quy mô lớn, đa quốc gia\n- Lương tháng 13, thưởng dự án, review định kỳ\n- BHXH, BHYT đầy đủ, phụ cấp ăn trưa và gửi xe\n- Hỗ trợ học chứng chỉ cloud nâng cao\n- Team building, du lịch công ty định kỳ\n', 'TP.HCM, Quận 4', 'Full-time, 9:00 – 18:00 (Thứ 2 – Thứ 6)\n', 'Gửi CV qua email HR hoặc nộp trực tiếp tại văn phòng\n', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học các ngành CNTT, Khoa học máy tính hoặc liên quan\n'),
(10, 'Data Analyst', 'Phân tích dữ liệu, báo cáo với SQL & Python.\nBạn sẽ chịu trách nhiệm thu thập, xử lý và trực quan hóa dữ liệu nhằm hỗ trợ ra quyết định chiến lược cho doanh nghiệp.\nThành thạo SQL để truy xuất dữ liệu từ các hệ thống khác nhau, cùng kỹ năng Python (pandas, matplotlib) để làm sạch và phân tích chuyên sâu.\nƯu tiên ứng viên có khả năng sử dụng Power BI hoặc Tableau và tư duy phân tích logic, chi tiết.', 11, 2, 'TP.HCM', '12-22 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 1, 'Có kinh nghiệm với SQL, Excel và Python (pandas, numpy)\n\nBiết sử dụng công cụ quản lý phiên bản (Git) và làm việc với notebook (Jupyter/Colab)\n\nHiểu về trực quan hóa dữ liệu và dashboard (Tableau, Power BI hoặc matplotlib/seaborn)\n\nKinh nghiệm làm sạch dữ liệu, ETL và xử lý dữ liệu lớn cơ bản\n\nCó khả năng làm việc nhóm và phối hợp với backend/DevOps để lấy dữ liệu hoặc triển khai báo cáo\n\nTư duy thống kê, logic và khả năng phân tích, giải quyết vấn đề tốt\n\nƯu tiên biết R hoặc kiến thức cơ bản về machine learning (scikit-learn, mô hình hồi quy, clustering)', '12-22 triệu + thưởng theo hiệu suất', '- Môi trường làm việc thân thiện, năng động\n- Được đào tạo kỹ năng mới và phát triển nghề nghiệp\n- BHXH, BHYT đầy đủ\n- Nghỉ phép theo quy định nhà nước\n- Được cấp Macbook hoặc thiết bị làm việc hiện đại\n- Tham gia team building, sự kiện công ty', 'TP.HCM, Quận 1', 'Full-time, 9h00 - 18h00', 'Gửi CV qua email HR hoặc qua website tuyển dụng', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học các ngành CNTT, Toán, Thống kê hoặc liên quan'),
(11, 'Database Developer', 'Thiết kế, phát triển và tối ưu các cơ sở dữ liệu cho ứng dụng web và mobile. Xây dựng stored procedures, triggers, views, tối ưu truy vấn SQL và đảm bảo dữ liệu hoạt động ổn định, chính xác. Phối hợp với đội backend để tích hợp dữ liệu, tham gia triển khai database schema và backup/recovery. Thực hiện kiểm thử, debug và bảo trì cơ sở dữ liệu, đảm bảo hiệu suất và bảo mật hệ thống.\n', 11, 1, 'Hà Nội', '15-28 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 3, '- Thành thạo SQL, MySQL, PostgreSQL hoặc MS SQL Server\n- Kinh nghiệm viết stored procedures, triggers, views, index và tối ưu truy vấn\n- Hiểu về normalization, database design, ERD, schema modeling\n- Biết Git, CI/CD cơ bản và các công cụ quản lý phiên bản\n- Kinh nghiệm backup, restore và bảo mật dữ liệu\n- Kỹ năng troubleshooting, phân tích hiệu suất database\n- Tư duy logic, cẩn thận, làm việc nhóm tốt\n- Ưu tiên có kinh nghiệm với NoSQL (MongoDB, Redis) hoặc Data Warehousing\n', '15-28 triệu tùy kinh nghiệm + thưởng dự án\n', '- Môi trường làm việc chuyên nghiệp, công nghệ hiện đại\n- Tham gia dự án quản lý dữ liệu lớn, đa lĩnh vực\n- Lương tháng 13, thưởng dự án, review định kỳ\n- BHXH, BHYT đầy đủ, phụ cấp ăn trưa và gửi xe\n- Hỗ trợ học tập nâng cao kỹ năng database và tối ưu SQL\n- Team building, du lịch công ty hàng năm\n', 'Hà Nội, Quận Cầu Giấy\n', 'Full-time, 8:30 – 17:30 (Thứ 2 – Thứ 6)\n', 'Gửi CV qua email HR hoặc nộp trực tiếp tại văn phòng\n', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học các ngành CNTT, Toán, Thống kê hoặc liên quan'),
(12, 'Backend Java Developer', 'Phát triển backend sử dụng Java, Spring Boot hoặc các framework Java khác, xây dựng API RESTful, xử lý dữ liệu và logic nghiệp vụ. Tham gia thiết kế cơ sở dữ liệu, tối ưu truy vấn và phối hợp chặt chẽ với frontend để tích hợp các tính năng. Thực hiện kiểm thử, debug, bảo trì và triển khai ứng dụng trên môi trường production. Đảm bảo backend hoạt động ổn định, hiệu suất cao, an toàn và có khả năng mở rộng.\n', 5, 2, 'TP.HCM', '18-30 triệu', '2025-09-24 02:45:31', '2025-09-24 02:45:31', 3, '- Thành thạo Java, Spring Boot, Hibernate/JPA\n- Kinh nghiệm xây dựng RESTful API và microservices\n- Hiểu về SQL/NoSQL (MySQL, PostgreSQL, MongoDB)\n- Biết Git, CI/CD, Docker và containerization cơ bản\n- Kỹ năng bảo mật backend, authentication, authorization\n- Khả năng phân tích, debug, tối ưu hiệu suất ứng dụng\n- Tư duy logic, cẩn thận, làm việc nhóm tốt\n- Ưu tiên có kinh nghiệm cloud deployment (AWS, GCP)\n', '18-30 triệu tùy kinh nghiệm + thưởng dự án/hiệu suất\n', '- Môi trường làm việc chuyên nghiệp, công nghệ hiện đại\n- Tham gia dự án đa lĩnh vực với backend phức tạp\n- Lương tháng 13, thưởng dự án, review lương định kỳ\n- BHXH, BHYT đầy đủ, phụ cấp ăn trưa và gửi xe\n- Hỗ trợ học tập nâng cao Java, Spring Boot và Cloud\n- Team building, du lịch công ty hàng năm\n', 'TP.HCM, Quận 10', 'Full-time, 8:30 – 17:30 (Thứ 2 – Thứ 6)\n', 'Gửi CV qua email HR hoặc nộp trực tiếp tại văn phòng\n', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học các ngành CNTT, Toán, Thống kê hoặc liên quan'),
(101, 'Frontend Developer', 'Phát triển giao diện web, tối ưu trải nghiệm người dùng, phối hợp với backend.', 5, 1, 'Hà Nội', '15-25 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Thành thạo HTML, CSS, JavaScript, React hoặc Vue\n- Kỹ năng responsive design\n- Kỹ năng làm việc nhóm', '15-25 triệu + thưởng', '- BHXH, BHYT đầy đủ\n- Team building, đào tạo kỹ năng', 'Hà Nội, Quận Cầu Giấy', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp Cao đẳng/Đại học IT'),
(102, 'Backend Developer (Laravel)', 'Phát triển backend, xây dựng API, tối ưu dữ liệu và logic nghiệp vụ.', 5, 1, 'TP.HCM', '20-35 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 3, '- Thành thạo PHP, Laravel\n- Biết MySQL, PostgreSQL\n- Git, CI/CD cơ bản', '20-35 triệu + thưởng dự án', '- Lương tháng 13, BHXH, BHYT\n- Được học tập nâng cao', 'TP.HCM, Quận 1', 'Full-time', 'Nộp CV trực tuyến', '2025-12-31', 'Tốt nghiệp IT hoặc liên quan'),
(103, 'Full Stack Developer', 'Phát triển frontend và backend, xây dựng hệ thống toàn diện.', 5, 1, 'TP.HCM', '25-40 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 3, '- PHP/Laravel hoặc NodeJS\n- React/Vue frontend\n- SQL/NoSQL', '25-40 triệu + thưởng', '- BHXH, BHYT, phụ cấp ăn trưa\n- Team building, học tập công nghệ mới', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV qua website', '2025-12-31', 'Tốt nghiệp IT hoặc liên quan'),
(104, 'DevOps Engineer', 'Triển khai hạ tầng, CI/CD, container, cloud, giám sát hệ thống.', 8, 1, 'TP.HCM', '30-50 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 3, '- Linux/Unix\n- Docker, Kubernetes\n- Cloud AWS/Azure/GCP', '30-50 triệu + thưởng', '- Lương tháng 13, BHXH, BHYT\n- Hỗ trợ chứng chỉ DevOps', 'TP.HCM, Quận 7', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT hoặc liên quan'),
(105, 'Mobile App Developer', 'Phát triển ứng dụng di động Android/iOS/Flutter.', 10, 1, 'TP.HCM', '18-35 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Flutter hoặc Kotlin/Swift\n- RESTful API\n- UI/UX cơ bản', '18-35 triệu + thưởng', '- BHXH, BHYT, ăn trưa\n- Học tập nâng cao Flutter/Native', 'TP.HCM, Quận 7', 'Full-time', 'Nộp CV trực tuyến', '2025-12-31', 'Tốt nghiệp IT hoặc liên quan'),
(106, 'Database Administrator', 'Quản trị, backup, restore, tối ưu cơ sở dữ liệu.', 11, 1, 'Hà Nội', '20-35 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 3, '- MySQL, PostgreSQL, MongoDB\n- Backup/Restore\n- Bảo mật dữ liệu', '20-35 triệu + thưởng', '- Lương tháng 13, BHXH, BHYT\n- Hỗ trợ chứng chỉ DBA', 'Hà Nội, Quận Cầu Giấy', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT hoặc liên quan'),
(107, 'Data Analyst', 'Phân tích dữ liệu, báo cáo, trực quan hóa dữ liệu.', 13, 1, 'TP.HCM', '12-22 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 1, '- SQL, Excel, Python\n- Tableau, Power BI\n- Kỹ năng phân tích', '12-22 triệu + thưởng', '- Lộ trình thăng tiến\n- Hỗ trợ học chứng chỉ Data', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp CNTT, Toán, Thống kê'),
(108, 'Machine Learning Engineer', 'Xây dựng mô hình ML, AI, LLM, xử lý dữ liệu lớn.', 13, 1, 'TP.HCM', '25-45 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Python, TensorFlow, PyTorch\n- ML/AI models\n- Data preprocessing', '25-45 triệu + thưởng', '- Học tập nâng cao ML\n- Team building', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV qua website', '2025-12-31', 'Tốt nghiệp CNTT, Toán, AI'),
(109, 'Cybersecurity Specialist', 'Bảo mật hệ thống, kiểm thử xâm nhập, giám sát an ninh mạng.', 14, 1, 'Hà Nội', '20-40 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Kiểm thử xâm nhập, pentest\n- Firewall, IDS/IPS\n- Bảo mật ứng dụng', '20-40 triệu + thưởng', '- BHXH, BHYT\n- Chứng chỉ Security', 'Hà Nội, Quận Hoàn Kiếm', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT, An ninh mạng'),
(110, 'UI/UX Designer', 'Thiết kế giao diện và trải nghiệm người dùng.', 15, 1, 'TP.HCM', '15-30 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Figma, Sketch, Adobe XD\n- Wireframe, Prototype\n- Thấu hiểu UX', '15-30 triệu + thưởng', '- Môi trường sáng tạo\n- Team building', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp Thiết kế hoặc IT'),
(111, 'Game Developer', 'Lập trình game Unity, Unreal Engine.', 16, 1, 'Hà Nội', '18-35 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Unity, C# hoặc Unreal, C++\n- Thiết kế gameplay, physics\n- Kiểm thử game', '18-35 triệu + thưởng', '- Team building, đào tạo\n- BHXH, BHYT', 'Hà Nội, Quận Cầu Giấy', 'Full-time', 'Gửi CV trực tuyến', '2025-12-31', 'Tốt nghiệp IT, Game Design'),
(112, 'Software Tester', 'Kiểm thử phần mềm, QA/QC.', 17, 1, 'TP.HCM', '12-25 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 1, '- Manual Testing\n- Automation Testing (Selenium, Cypress)\n- Viết test case', '12-25 triệu + thưởng', '- Được đào tạo QA\n- Team building', 'TP.HCM, Quận 7', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT hoặc liên quan'),
(113, 'Blockchain Developer', 'Phát triển Smart Contract, ứng dụng blockchain.', 18, 1, 'TP.HCM', '20-40 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Solidity, Ethereum\n- Smart Contract\n- Kiểm thử và deploy blockchain', '20-40 triệu + thưởng', '- Team building, học tập nâng cao', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV qua website', '2025-12-31', 'Tốt nghiệp IT, Blockchain'),
(114, 'IoT Developer', 'Phát triển thiết bị IoT, cảm biến, kết nối và thu thập dữ liệu.', 19, 1, 'Hà Nội', '18-35 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Embedded C/C++\n- Raspberry Pi, Arduino\n- Giao thức IoT, MQTT', '18-35 triệu + thưởng', '- BHXH, BHYT\n- Được học IoT nâng cao', 'Hà Nội, Quận Thanh Xuân', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT, Điện tử'),
(115, 'AI Engineer', 'Triển khai mô hình AI, LLM, hệ thống thông minh.', 20, 1, 'TP.HCM', '25-45 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Python, TensorFlow, PyTorch\n- Machine Learning, Deep Learning\n- Data preprocessing, model deployment', '25-45 triệu + thưởng', '- Học tập nâng cao AI, team building', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp CNTT, AI, Toán hoặc liên quan'),
(301, 'Data Analyst', 'Phân tích dữ liệu, trực quan hóa dữ liệu, xây dựng báo cáo phục vụ quyết định kinh doanh.', 13, 1, 'TP.HCM', '12-22 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 1, '- SQL, Excel, Python\n- Tableau, Power BI\n- Kỹ năng phân tích dữ liệu', '12-22 triệu + thưởng', '- Hỗ trợ học chứng chỉ Data\n- BHXH, BHYT đầy đủ', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp CNTT, Toán, Thống kê'),
(302, 'Machine Learning Engineer', 'Xây dựng và triển khai mô hình ML, Deep Learning.', 13, 1, 'TP.HCM', '25-45 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Python, TensorFlow, PyTorch\n- Data preprocessing\n- Triển khai ML models', '25-45 triệu + thưởng', '- Học tập nâng cao ML/AI\n- Team building', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV qua website', '2025-12-31', 'Tốt nghiệp CNTT, AI, Toán'),
(303, 'Data Scientist', 'Phân tích dữ liệu lớn, khai thác insight, xây dựng mô hình dự báo.', 13, 1, 'Hà Nội', '30-50 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 3, '- Python, R, SQL\n- Machine Learning, Statistics\n- Data visualization', '30-50 triệu + thưởng', '- Được học tập nâng cao\n- BHXH, BHYT', 'Hà Nội, Quận Cầu Giấy', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp CNTT, Toán, Thống kê'),
(304, 'Cybersecurity Specialist', 'Bảo mật hệ thống, kiểm thử xâm nhập, giám sát an ninh mạng.', 14, 1, 'Hà Nội', '20-40 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Pentest, firewall, IDS/IPS\n- Bảo mật ứng dụng\n- Security monitoring', '20-40 triệu + thưởng', '- BHXH, BHYT\n- Hỗ trợ chứng chỉ Security', 'Hà Nội, Quận Hoàn Kiếm', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT, An ninh mạng'),
(305, 'Ethical Hacker', 'Thực hiện kiểm thử xâm nhập để phát hiện lỗ hổng bảo mật.', 14, 1, 'TP.HCM', '25-45 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Kali Linux, Metasploit\n- Pentest web/app\n- Kỹ năng phân tích', '25-45 triệu + thưởng', '- Được học tập nâng cao\n- Team building', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV trực tuyến', '2025-12-31', 'Tốt nghiệp IT, An ninh mạng'),
(306, 'Security Analyst', 'Giám sát hệ thống, phân tích các sự cố bảo mật.', 14, 1, 'Hà Nội', '20-35 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 1, '- Log analysis, SIEM\n- Incident response\n- Vulnerability assessment', '20-35 triệu + thưởng', '- BHXH, BHYT\n- Hỗ trợ chứng chỉ Security', 'Hà Nội, Quận Thanh Xuân', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT, An ninh mạng'),
(307, 'UI Designer', 'Thiết kế giao diện web/mobile, tạo wireframe và prototype.', 15, 1, 'TP.HCM', '15-30 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Figma, Sketch, Adobe XD\n- Wireframe, Prototype\n- Thấu hiểu UX', '15-30 triệu + thưởng', '- Môi trường sáng tạo\n- Team building', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp Thiết kế hoặc IT'),
(308, 'UX Designer', 'Thiết kế trải nghiệm người dùng, cải thiện usability và flow.', 15, 1, 'Hà Nội', '18-35 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Nghiên cứu UX\n- Usability testing\n- Wireframe, Prototype', '18-35 triệu + thưởng', '- Team building, học tập nâng cao', 'Hà Nội, Quận Cầu Giấy', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp Thiết kế, IT hoặc liên quan'),
(309, 'Product Designer', 'Thiết kế sản phẩm số, đảm bảo giao diện và trải nghiệm người dùng tốt.', 15, 1, 'TP.HCM', '20-38 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 3, '- Figma, UX research\n- UI prototyping\n- Collaboration với dev', '20-38 triệu + thưởng', '- BHXH, BHYT\n- Team building', 'TP.HCM, Quận 7', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp Thiết kế, IT'),
(310, 'Unity Developer', 'Phát triển game 2D/3D với Unity, C#.', 16, 1, 'Hà Nội', '18-35 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Unity, C#\n- Game mechanics\n- Debug, optimize', '18-35 triệu + thưởng', '- Team building, BHXH\n- Đào tạo nâng cao', 'Hà Nội, Quận Cầu Giấy', 'Full-time', 'Gửi CV trực tuyến', '2025-12-31', 'Tốt nghiệp IT, Game Design'),
(311, 'Unreal Engine Developer', 'Phát triển game với Unreal Engine, C++.', 16, 1, 'TP.HCM', '20-38 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Unreal Engine, C++\n- Gameplay, physics\n- Optimization', '20-38 triệu + thưởng', '- Team building, học tập nâng cao', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT, Game Design'),
(312, 'Game Designer', 'Thiết kế gameplay, level, storytelling cho game.', 16, 1, 'Hà Nội', '15-28 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 1, '- Game mechanics\n- Level design\n- Collaboration với dev và artists', '15-28 triệu + thưởng', '- Team building\n- BHXH, BHYT', 'Hà Nội, Quận Thanh Xuân', 'Full-time', 'Gửi CV trực tuyến', '2025-12-31', 'Tốt nghiệp Game Design, IT hoặc liên quan'),
(313, 'Manual Tester', 'Thực hiện kiểm thử thủ công, viết test case và báo cáo lỗi.', 17, 1, 'TP.HCM', '12-22 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 1, '- Manual testing\n- Viết test case\n- Báo cáo bug', '12-22 triệu + thưởng', '- Được đào tạo QA\n- Team building', 'TP.HCM, Quận 7', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT hoặc liên quan'),
(314, 'Automation Tester', 'Thiết kế và chạy automation tests (Selenium, Cypress).', 17, 1, 'Hà Nội', '18-32 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Selenium, Cypress\n- Script automation\n- Kiểm thử regression', '18-32 triệu + thưởng', '- BHXH, BHYT\n- Học tập nâng cao QA', 'Hà Nội, Quận Cầu Giấy', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT hoặc liên quan'),
(315, 'Blockchain Developer', 'Phát triển Smart Contract, ứng dụng blockchain.', 18, 1, 'TP.HCM', '20-40 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Solidity, Ethereum\n- Smart Contract development\n- Kiểm thử và deploy blockchain', '20-40 triệu + thưởng', '- Team building, học tập nâng cao', 'TP.HCM, Quận 1', 'Full-time', 'Gửi CV qua website', '2025-12-31', 'Tốt nghiệp IT, Blockchain'),
(316, 'Smart Contract Engineer', 'Thiết kế và triển khai các Smart Contract cho dApp.', 18, 1, 'Hà Nội', '22-42 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Solidity, Ethereum, Binance Smart Chain\n- Security auditing\n- Deploy và testing', '22-42 triệu + thưởng', '- Team building\n- BHXH, BHYT', 'Hà Nội, Quận Cầu Giấy', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT, Blockchain'),
(317, 'IoT Developer', 'Thiết kế và phát triển hệ thống IoT, cảm biến và kết nối thiết bị thông minh.', 19, 1, 'Hà Nội', '18-35 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Embedded C/C++\n- Raspberry Pi, Arduino\n- Giao thức IoT, MQTT', '18-35 triệu + thưởng', '- BHXH, BHYT\n- Học IoT nâng cao', 'Hà Nội, Quận Thanh Xuân', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT, Điện tử'),
(318, 'IoT Engineer', 'Phát triển ứng dụng IoT, kết nối cloud và phân tích dữ liệu cảm biến.', 19, 1, 'TP.HCM', '20-38 triệu', '2025-12-03 03:00:00', '2025-12-03 03:00:00', 2, '- Cloud IoT, MQTT, REST API\n- Phân tích dữ liệu cảm biến\n- Embedded programming', '20-38 triệu + thưởng', '- Team building, đào tạo\n- BHXH, BHYT', 'TP.HCM, Quận 7', 'Full-time', 'Gửi CV qua email', '2025-12-31', 'Tốt nghiệp IT, Điện tử');

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
(17, 1, 6, 'cvs/MSLqraHHVMANJaulaLmAxJXGiPncts41XMnaQCuy.pdf', 'hi', '2025-11-05 00:26:12', '2025-11-05 00:26:12'),
(18, 1, 6, 'cvs/1ayiWJxYLuMeFWVHC3iMiBw7TEtotGxWIllvgM4X.pdf', 'hi', '2025-11-14 20:11:35', '2025-11-14 20:11:35');

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
-- Cấu trúc bảng cho bảng `saved_jobs`
--

CREATE TABLE `saved_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `saved_jobs`
--

INSERT INTO `saved_jobs` (`id`, `user_id`, `job_id`, `created_at`, `updated_at`) VALUES
(13, 6, 1, '2025-11-05 00:16:24', '2025-11-05 00:16:24');

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
  `desired_position` varchar(100) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `role` enum('user','employer','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `phone`, `address`, `resume`, `desired_position`, `industry`, `role`, `created_at`, `updated_at`) VALUES
(4, 'Mai Thanh An', 'dpa@gmail.com', '$2y$12$RqZCc9bUjWBd.TdJwgx1w.3t04SDoD.eU6GO/EPcBMe/RJECj.I42', NULL, NULL, NULL, NULL, NULL, NULL, 'employer', '2025-09-23 19:25:27', '2025-11-17 14:26:00'),
(6, 'Cao niên Trường Sơn', 'son@gmail.com', '$2y$12$ydSc9GQax/IlUUDhJhgT4eXNu9yaNqlGCRxXvOoBdzBuhm6tN6mUG', 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgzxAeW8J9uNlYPOp6_sspakIiVN14YMcPRxbo9c65TS_jFBtE5rkuCsqpMQUSvbsc4oKWb8NlFeF4WC6Q6kAelrzbXV9PrNE_C3Em4vi1X05cgVTi2uQ0YN7EFmLMvaMOyP9kXv_KQ2EY/s0/image.png', '0396197501', '97/25/10 tổ 21 khu 3', NULL, NULL, 'Database', 'user', '2025-10-28 08:09:23', '2025-11-09 08:18:17'),
(7, 'Trần Hà Linh', 'admin@gmail.com', '$2y$12$.xTZkuiF5ovZbLuipFdcquPHPlCLpOptETweguOjq5vWaqq7GqcUe', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '2025-11-17 07:21:22', '2025-11-17 14:26:11'),
(8, 'CaoNien TruongSon', 'truongsonvipro1@gmail.com', '$2y$12$gFvRzAUfiaNM/CmLp8ejr.OPVxAJSI2sZT.sSyrXCcPA1nq9PrNAi', NULL, NULL, NULL, NULL, NULL, 'AI', 'user', '2025-11-17 07:52:59', '2025-12-03 03:54:43');

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
-- Chỉ mục cho bảng `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `employers`
--
ALTER TABLE `employers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT cho bảng `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `saved_jobs`
--
ALTER TABLE `saved_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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

--
-- Các ràng buộc cho bảng `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD CONSTRAINT `saved_jobs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saved_jobs_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
