-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 07, 2020 at 10:42 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weatherapp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_backend_users`
--

CREATE TABLE `m_backend_users` (
  `backend_user_id` int(10) NOT NULL,
  `backend_user_code` varchar(255) NOT NULL,
  `backend_user_name` varchar(255) NOT NULL,
  `backend_user_email` varchar(255) NOT NULL,
  `backend_user_role` smallint(6) NOT NULL,
  `backend_user_is_active` tinyint(1) DEFAULT 1,
  `backend_user_password` varchar(255) NOT NULL,
  `backend_user_last_login` datetime DEFAULT NULL,
  `backend_user_last_login_ip_address` varchar(255) DEFAULT NULL,
  `backend_user_created_by` varchar(255) NOT NULL,
  `backend_user_created_by_name` varchar(255) NOT NULL,
  `backend_user_changed_by` varchar(255) DEFAULT NULL,
  `backend_user_changed_by_name` varchar(255) DEFAULT NULL,
  `backend_user_created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `backend_user_changed_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_backend_users`
--

INSERT INTO `m_backend_users` 
(
  `backend_user_id`,
  `backend_user_code`,
  `backend_user_name`,
  `backend_user_email`,
  `backend_user_role`,
  `backend_user_is_active`,
  `backend_user_password`,
  `backend_user_last_login`,
  `backend_user_last_login_ip_address`,
  `backend_user_created_by`,
  `backend_user_created_by_name`,
  `backend_user_changed_by`,
  `backend_user_changed_by_name`,
  `backend_user_created_time`,
  `backend_user_changed_time`
) VALUES
(1, 'ADMIN1', 'James Admin', 'admin@mail.com', 2, 1, '$2y$12$gjo1AENGiBgE9YLVtpwpD.PRFO2/ljdv4/YuxSWy2eYTm.qY/AYBm', '2020-08-04 19:14:36', '::1', '123', 'Admin', NULL, NULL, '2020-07-10 00:01:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_users`
--

CREATE TABLE `m_users` (
  `user_id` int(10) NOT NULL,
  `user_code` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_role` smallint(6) NOT NULL,
  `user_is_active` tinyint(1) DEFAULT 1,
  `user_registration_timestamp` datetime DEFAULT NULL,
  `user_location_id` int(10) UNSIGNED NOT NULL,
  `user_last_login` datetime DEFAULT NULL,
  `user_last_login_ip_address` varchar(255) DEFAULT NULL,
  `user_created_by` varchar(255) NOT NULL,
  `user_created_by_name` varchar(255) NOT NULL,
  `user_changed_by` varchar(255) DEFAULT NULL,
  `user_changed_by_name` varchar(255) DEFAULT NULL,
  `user_created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user_changed_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_users`
--

INSERT INTO `m_users` 
(
  `user_id`,
  `user_code`,
  `user_name`,
  `user_email`,
  `user_role`,
  `user_is_active`,
  `user_registration_timestamp`,
  `user_location_id`,
  `user_last_login`,
  `user_last_login_ip_address`,
  `user_created_by`,
  `user_created_by_name`,
  `user_changed_by`,
  `user_changed_by_name`,
  `user_created_time`,
  `user_changed_time`
) VALUES
(1, 'USER1', 'James User', 'user1@mail.com', 1, 1, '2020-08-04 19:14:36', 1, '2020-08-04 19:14:36', '::1', '123', 'Admin', NULL, NULL, '2020-07-10 00:01:11', NULL),
(2, 'USER2', 'Sammy User', 'user2@mail.com', 1, 1, '2020-08-04 19:14:36', 2, '2020-08-04 19:14:36', '::1', '123', 'Admin', NULL, NULL, '2020-07-10 00:01:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_locations`
--

CREATE TABLE `m_locations` (
  `location_id` int(10) UNSIGNED NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `location_lat` varchar(255) NOT NULL,
  `location_long` varchar(255) NOT NULL,
  `location_is_active` tinyint(1) DEFAULT 1,
  `location_created_by` varchar(255) NOT NULL,
  `location_created_by_name` varchar(255) NOT NULL,
  `location_changed_by` varchar(255) DEFAULT NULL,
  `location_changed_by_name` varchar(255) DEFAULT NULL,
  `location_created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `location_changed_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_locations`
--

INSERT INTO `m_locations` 
(
  `location_id`,
  `location_name`,
  `location_lat`,
  `location_long`,
  `location_is_active`,
  `location_created_by`,
  `location_created_by_name`,
  `location_changed_by`,
  `location_changed_by_name`,
  `location_created_time`,
  `location_changed_time`
) VALUES
(1, 'Jakarta Utara', '-6.1554', '106.8927', 1, '123', 'Admin', NULL, NULL, '2020-08-17 01:02:43', NULL),
(2, 'Jakarta Timur', '-6.2250', '106.9004', 1, '123', 'Admin', NULL, NULL, '2020-08-17 01:02:43', NULL),
(3, 'Jakarta Barat', '-6.1674', '106.7637', 1, '123', 'Admin', NULL, NULL, '2020-08-17 01:02:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_weather_configs`
--

CREATE TABLE `m_weather_configs` (
  `weather_config_id` int(10) UNSIGNED NOT NULL,
  `weather_config_weather_key` varchar(255) NOT NULL,
  `weather_config_weather_account` varchar(255) NOT NULL,
  `weather_config_weather_password` varchar(255) NOT NULL,
  `weather_config_created_by` varchar(255) NOT NULL,
  `weather_config_created_by_name` varchar(255) NOT NULL,
  `weather_config_changed_by` varchar(255) DEFAULT NULL,
  `weather_config_changed_by_name` varchar(255) DEFAULT NULL,
  `weather_config_created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `weather_config_changed_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_weather_configs`
--

INSERT INTO `m_weather_configs` 
(
  `weather_config_id`,
  `weather_config_weather_key`,
  `weather_config_weather_account`,
  `weather_config_weather_password`,
  `weather_config_created_by`,
  `weather_config_created_by_name`,
  `weather_config_changed_by`,
  `weather_config_changed_by_name`,
  `weather_config_created_time`,
  `weather_config_changed_time`
) VALUES
(1, '12faec3381fd768d19faca216877f734', 'vovoba1041@acceptmail.net', 'weatherapp_test', '123', 'Admin', NULL, NULL, '2020-07-20 01:02:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_weather_logs`
--

CREATE TABLE `t_weather_logs` (
  `weather_log_id` int(10) UNSIGNED NOT NULL,
  `weather_log_code` varchar(255) NOT NULL,
  `weather_log_location_id` int(10) UNSIGNED NOT NULL,
  `weather_log_current` varchar(2000) NOT NULL,
  `weather_log_next_week` varchar(5000) NOT NULL,
  `weather_log_created_by` varchar(255) NOT NULL,
  `weather_log_created_by_name` varchar(255) NOT NULL,
  `weather_log_changed_by` varchar(255) DEFAULT NULL,
  `weather_log_changed_by_name` varchar(255) DEFAULT NULL,
  `weather_log_created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `weather_log_changed_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_weather_logs`
--

INSERT INTO `t_weather_logs` 
(
  `weather_log_id`,
  `weather_log_code`,
  `weather_log_location_id`,
  `weather_log_current`,
  `weather_log_next_week`,
  `weather_log_created_by`,
  `weather_log_created_by_name`,
  `weather_log_changed_by`,
  `weather_log_changed_by_name`,
  `weather_log_created_time`,
  `weather_log_changed_time`
) VALUES
(1, 'LOG-1-1', 1, '{"dt":1597343109,"sunrise":1597359624,"sunset":1597402476,"temp":296.66,"feels_like":300.15,"pressure":1010,"humidity":94,"dew_point":295.64,"uvi":11.66,"clouds":20,"visibility":5000,"wind_speed":2.1,"wind_deg":290,"weather":[{"id":721,"main":"Haze","description":"haze","icon":"50n"}]}', '[{"dt":1597377600,"sunrise":1597359624,"sunset":1597402476,"temp":{"day":303.52,"min":298.44,"max":306.14,"night":302.15,"eve":304.33,"morn":298.44},"feels_like":{"day":306.11,"night":304.72,"eve":304.81,"morn":302.58},"pressure":1011,"humidity":58,"dew_point":294.33,"wind_speed":2.39,"wind_deg":94,"weather":[{"id":501,"main":"Rain","description":"moderate rain","icon":"10d"}],"clouds":61,"pop":0.92,"rain":7.35,"uvi":11.66},{"dt":1597464000,"sunrise":1597446005,"sunset":1597488873,"temp":{"day":304.43,"min":300.8,"max":305.61,"night":302.1,"eve":304.54,"morn":300.8},"feels_like":{"day":305.9,"night":303.99,"eve":304.47,"morn":304.21},"pressure":1011,"humidity":53,"dew_point":293.94,"wind_speed":3.55,"wind_deg":78,"weather":[{"id":501,"main":"Rain","description":"moderate rain","icon":"10d"}],"clouds":0,"pop":1,"rain":3.67,"uvi":11.95},{"dt":1597550400,"sunrise":1597532385,"sunset":1597575270,"temp":{"day":304.51,"min":300.43,"max":306.2,"night":301.8,"eve":304.49,"morn":300.43},"feels_like":{"day":304.79,"night":303.75,"eve":304.41,"morn":301.93},"pressure":1012,"humidity":48,"dew_point":292.46,"wind_speed":4.23,"wind_deg":92,"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10d"}],"clouds":0,"pop":0.67,"rain":2.14,"uvi":11.69},{"dt":1597636800,"sunrise":1597618765,"sunset":1597661667,"temp":{"day":304.3,"min":300.22,"max":306.99,"night":302.18,"eve":304.92,"morn":300.28},"feels_like":{"day":307.27,"night":304.31,"eve":305.22,"morn":302.83},"pressure":1011,"humidity":51,"dew_point":293.13,"wind_speed":0.9,"wind_deg":118,"weather":[{"id":800,"main":"Clear","description":"clear sky","icon":"01d"}],"clouds":8,"pop":0.38,"uvi":12.01},{"dt":1597723200,"sunrise":1597705144,"sunset":1597748063,"temp":{"day":304.55,"min":300.86,"max":306.75,"night":302.2,"eve":305.06,"morn":300.86},"feels_like":{"day":307.86,"night":305.06,"eve":305.64,"morn":304.14},"pressure":1012,"humidity":51,"dew_point":293.28,"wind_speed":0.57,"wind_deg":120,"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10d"}],"clouds":4,"pop":0.38,"rain":0.26,"uvi":11.8},{"dt":1597809600,"sunrise":1597791522,"sunset":1597834458,"temp":{"day":304.33,"min":300.43,"max":306.29,"night":301.51,"eve":304.3,"morn":300.48},"feels_like":{"day":305.03,"night":303.82,"eve":303.56,"morn":302.12},"pressure":1010,"humidity":51,"dew_point":293.31,"wind_speed":4.16,"wind_deg":66,"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10d"}],"clouds":7,"pop":0.52,"rain":1.05,"uvi":12.19},{"dt":1597896000,"sunrise":1597877900,"sunset":1597920854,"temp":{"day":304.28,"min":300.34,"max":304.51,"night":301.57,"eve":304.01,"morn":300.34},"feels_like":{"day":305.53,"night":302.61,"eve":304.8,"morn":302.06},"pressure":1011,"humidity":55,"dew_point":294.3,"wind_speed":4.19,"wind_deg":81,"weather":[{"id":501,"main":"Rain","description":"moderate rain","icon":"10d"}],"clouds":7,"pop":0.91,"rain":10.39,"uvi":12.19},{"dt":1597982400,"sunrise":1597964277,"sunset":1598007248,"temp":{"day":304.08,"min":300.1,"max":306.28,"night":306.28,"eve":306.28,"morn":300.1},"feels_like":{"day":304.51,"night":306.22,"eve":306.22,"morn":301.5},"pressure":1012,"humidity":53,"dew_point":293.63,"wind_speed":4.81,"wind_deg":101,"weather":[{"id":802,"main":"Clouds","description":"scattered clouds","icon":"03d"}],"clouds":28,"pop":0.24,"uvi":12.6}]', '123', 'Admin', NULL, NULL, '2020-07-20 01:02:43', NULL),
(2, 'LOG-3-1', 3, '{"dt":1597343109,"sunrise":1597359624,"sunset":1597402476,"temp":296.66,"feels_like":300.15,"pressure":1010,"humidity":94,"dew_point":295.64,"uvi":11.66,"clouds":20,"visibility":5000,"wind_speed":2.1,"wind_deg":290,"weather":[{"id":721,"main":"Haze","description":"haze","icon":"50n"}]}', '[{"dt":1597377600,"sunrise":1597359624,"sunset":1597402476,"temp":{"day":303.52,"min":298.44,"max":306.14,"night":302.15,"eve":304.33,"morn":298.44},"feels_like":{"day":306.11,"night":304.72,"eve":304.81,"morn":302.58},"pressure":1011,"humidity":58,"dew_point":294.33,"wind_speed":2.39,"wind_deg":94,"weather":[{"id":501,"main":"Rain","description":"moderate rain","icon":"10d"}],"clouds":61,"pop":0.92,"rain":7.35,"uvi":11.66},{"dt":1597464000,"sunrise":1597446005,"sunset":1597488873,"temp":{"day":304.43,"min":300.8,"max":305.61,"night":302.1,"eve":304.54,"morn":300.8},"feels_like":{"day":305.9,"night":303.99,"eve":304.47,"morn":304.21},"pressure":1011,"humidity":53,"dew_point":293.94,"wind_speed":3.55,"wind_deg":78,"weather":[{"id":501,"main":"Rain","description":"moderate rain","icon":"10d"}],"clouds":0,"pop":1,"rain":3.67,"uvi":11.95},{"dt":1597550400,"sunrise":1597532385,"sunset":1597575270,"temp":{"day":304.51,"min":300.43,"max":306.2,"night":301.8,"eve":304.49,"morn":300.43},"feels_like":{"day":304.79,"night":303.75,"eve":304.41,"morn":301.93},"pressure":1012,"humidity":48,"dew_point":292.46,"wind_speed":4.23,"wind_deg":92,"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10d"}],"clouds":0,"pop":0.67,"rain":2.14,"uvi":11.69},{"dt":1597636800,"sunrise":1597618765,"sunset":1597661667,"temp":{"day":304.3,"min":300.22,"max":306.99,"night":302.18,"eve":304.92,"morn":300.28},"feels_like":{"day":307.27,"night":304.31,"eve":305.22,"morn":302.83},"pressure":1011,"humidity":51,"dew_point":293.13,"wind_speed":0.9,"wind_deg":118,"weather":[{"id":800,"main":"Clear","description":"clear sky","icon":"01d"}],"clouds":8,"pop":0.38,"uvi":12.01},{"dt":1597723200,"sunrise":1597705144,"sunset":1597748063,"temp":{"day":304.55,"min":300.86,"max":306.75,"night":302.2,"eve":305.06,"morn":300.86},"feels_like":{"day":307.86,"night":305.06,"eve":305.64,"morn":304.14},"pressure":1012,"humidity":51,"dew_point":293.28,"wind_speed":0.57,"wind_deg":120,"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10d"}],"clouds":4,"pop":0.38,"rain":0.26,"uvi":11.8},{"dt":1597809600,"sunrise":1597791522,"sunset":1597834458,"temp":{"day":304.33,"min":300.43,"max":306.29,"night":301.51,"eve":304.3,"morn":300.48},"feels_like":{"day":305.03,"night":303.82,"eve":303.56,"morn":302.12},"pressure":1010,"humidity":51,"dew_point":293.31,"wind_speed":4.16,"wind_deg":66,"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10d"}],"clouds":7,"pop":0.52,"rain":1.05,"uvi":12.19},{"dt":1597896000,"sunrise":1597877900,"sunset":1597920854,"temp":{"day":304.28,"min":300.34,"max":304.51,"night":301.57,"eve":304.01,"morn":300.34},"feels_like":{"day":305.53,"night":302.61,"eve":304.8,"morn":302.06},"pressure":1011,"humidity":55,"dew_point":294.3,"wind_speed":4.19,"wind_deg":81,"weather":[{"id":501,"main":"Rain","description":"moderate rain","icon":"10d"}],"clouds":7,"pop":0.91,"rain":10.39,"uvi":12.19},{"dt":1597982400,"sunrise":1597964277,"sunset":1598007248,"temp":{"day":304.08,"min":300.1,"max":306.28,"night":306.28,"eve":306.28,"morn":300.1},"feels_like":{"day":304.51,"night":306.22,"eve":306.22,"morn":301.5},"pressure":1012,"humidity":53,"dew_point":293.63,"wind_speed":4.81,"wind_deg":101,"weather":[{"id":802,"main":"Clouds","description":"scattered clouds","icon":"03d"}],"clouds":28,"pop":0.24,"uvi":12.6}]', '123', 'Admin', NULL, NULL, '2020-07-20 01:02:43', NULL),
(3, 'LOG-2-1', 2, '{"dt":1597343109,"sunrise":1597359624,"sunset":1597402476,"temp":296.66,"feels_like":300.15,"pressure":1010,"humidity":94,"dew_point":295.64,"uvi":11.66,"clouds":20,"visibility":5000,"wind_speed":2.1,"wind_deg":290,"weather":[{"id":721,"main":"Haze","description":"haze","icon":"50n"}]}', '[{"dt":1597377600,"sunrise":1597359624,"sunset":1597402476,"temp":{"day":303.52,"min":298.44,"max":306.14,"night":302.15,"eve":304.33,"morn":298.44},"feels_like":{"day":306.11,"night":304.72,"eve":304.81,"morn":302.58},"pressure":1011,"humidity":58,"dew_point":294.33,"wind_speed":2.39,"wind_deg":94,"weather":[{"id":501,"main":"Rain","description":"moderate rain","icon":"10d"}],"clouds":61,"pop":0.92,"rain":7.35,"uvi":11.66},{"dt":1597464000,"sunrise":1597446005,"sunset":1597488873,"temp":{"day":304.43,"min":300.8,"max":305.61,"night":302.1,"eve":304.54,"morn":300.8},"feels_like":{"day":305.9,"night":303.99,"eve":304.47,"morn":304.21},"pressure":1011,"humidity":53,"dew_point":293.94,"wind_speed":3.55,"wind_deg":78,"weather":[{"id":501,"main":"Rain","description":"moderate rain","icon":"10d"}],"clouds":0,"pop":1,"rain":3.67,"uvi":11.95},{"dt":1597550400,"sunrise":1597532385,"sunset":1597575270,"temp":{"day":304.51,"min":300.43,"max":306.2,"night":301.8,"eve":304.49,"morn":300.43},"feels_like":{"day":304.79,"night":303.75,"eve":304.41,"morn":301.93},"pressure":1012,"humidity":48,"dew_point":292.46,"wind_speed":4.23,"wind_deg":92,"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10d"}],"clouds":0,"pop":0.67,"rain":2.14,"uvi":11.69},{"dt":1597636800,"sunrise":1597618765,"sunset":1597661667,"temp":{"day":304.3,"min":300.22,"max":306.99,"night":302.18,"eve":304.92,"morn":300.28},"feels_like":{"day":307.27,"night":304.31,"eve":305.22,"morn":302.83},"pressure":1011,"humidity":51,"dew_point":293.13,"wind_speed":0.9,"wind_deg":118,"weather":[{"id":800,"main":"Clear","description":"clear sky","icon":"01d"}],"clouds":8,"pop":0.38,"uvi":12.01},{"dt":1597723200,"sunrise":1597705144,"sunset":1597748063,"temp":{"day":304.55,"min":300.86,"max":306.75,"night":302.2,"eve":305.06,"morn":300.86},"feels_like":{"day":307.86,"night":305.06,"eve":305.64,"morn":304.14},"pressure":1012,"humidity":51,"dew_point":293.28,"wind_speed":0.57,"wind_deg":120,"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10d"}],"clouds":4,"pop":0.38,"rain":0.26,"uvi":11.8},{"dt":1597809600,"sunrise":1597791522,"sunset":1597834458,"temp":{"day":304.33,"min":300.43,"max":306.29,"night":301.51,"eve":304.3,"morn":300.48},"feels_like":{"day":305.03,"night":303.82,"eve":303.56,"morn":302.12},"pressure":1010,"humidity":51,"dew_point":293.31,"wind_speed":4.16,"wind_deg":66,"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10d"}],"clouds":7,"pop":0.52,"rain":1.05,"uvi":12.19},{"dt":1597896000,"sunrise":1597877900,"sunset":1597920854,"temp":{"day":304.28,"min":300.34,"max":304.51,"night":301.57,"eve":304.01,"morn":300.34},"feels_like":{"day":305.53,"night":302.61,"eve":304.8,"morn":302.06},"pressure":1011,"humidity":55,"dew_point":294.3,"wind_speed":4.19,"wind_deg":81,"weather":[{"id":501,"main":"Rain","description":"moderate rain","icon":"10d"}],"clouds":7,"pop":0.91,"rain":10.39,"uvi":12.19},{"dt":1597982400,"sunrise":1597964277,"sunset":1598007248,"temp":{"day":304.08,"min":300.1,"max":306.28,"night":306.28,"eve":306.28,"morn":300.1},"feels_like":{"day":304.51,"night":306.22,"eve":306.22,"morn":301.5},"pressure":1012,"humidity":53,"dew_point":293.63,"wind_speed":4.81,"wind_deg":101,"weather":[{"id":802,"main":"Clouds","description":"scattered clouds","icon":"03d"}],"clouds":28,"pop":0.24,"uvi":12.6}]', '123', 'Admin', NULL, NULL, '2020-07-20 01:02:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_backend_users`
--
ALTER TABLE `m_backend_users`
  ADD PRIMARY KEY (`backend_user_id`);

--
-- Indexes for table `m_users`
--
ALTER TABLE `m_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `m_locations`
--
ALTER TABLE `m_locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `m_weather_configs`
--
ALTER TABLE `m_weather_configs`
  ADD PRIMARY KEY (`weather_config_id`);

--
-- Indexes for table `t_weather_logs`
--
ALTER TABLE `t_weather_logs`
  ADD PRIMARY KEY (`weather_log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_backend_users`
--
ALTER TABLE `m_backend_users`
  MODIFY `backend_user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_users`
--
ALTER TABLE `m_users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_locations`
--
ALTER TABLE `m_locations`
  MODIFY `location_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_weather_configs`
--
ALTER TABLE `m_weather_configs`
  MODIFY `weather_config_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_weather_logs`
--
ALTER TABLE `t_weather_logs`
  MODIFY `weather_log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;