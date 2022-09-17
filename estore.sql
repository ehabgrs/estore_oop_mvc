-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2022 at 03:08 PM
-- Server version: 8.0.30-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estore`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_clients`
--

CREATE TABLE `app_clients` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `app_clients`
--

INSERT INTO `app_clients` (`id`, `name`, `phone_number`, `email`, `address`) VALUES
(1, 'ehab', '123456', 'h@h.com', 'hofuf ahsa');

-- --------------------------------------------------------

--
-- Table structure for table `app_expenses_categories`
--

CREATE TABLE `app_expenses_categories` (
  `id` tinyint UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `fixed_payment` decimal(7,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `app_expenses_daily_lists`
--

CREATE TABLE `app_expenses_daily_lists` (
  `id` int UNSIGNED NOT NULL,
  `expense_id` tinyint UNSIGNED NOT NULL,
  `payment` decimal(7,2) NOT NULL,
  `created` datetime NOT NULL,
  `user_id` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `app_notifications`
--

CREATE TABLE `app_notifications` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` varchar(255) NOT NULL,
  `type` tinyint NOT NULL,
  `created` date NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `seen` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `app_products`
--

CREATE TABLE `app_products` (
  `id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  `quantity` smallint UNSIGNED NOT NULL,
  `purchase_price` decimal(6,2) NOT NULL,
  `sell_price` decimal(6,2) NOT NULL,
  `vat` enum('0','15') DEFAULT NULL,
  `barcode` varchar(30) DEFAULT NULL,
  `gtn_code` varchar(70) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `app_products`
--

INSERT INTO `app_products` (`id`, `category_id`, `name`, `image`, `quantity`, `purchase_price`, `sell_price`, `vat`, `barcode`, `gtn_code`) VALUES
(6, 19, 'new product', 'p_a2f3lmpwzyq_yesqxmcq4m0_04_05_22.jpg', 5, '10.00', '25.50', '', '54545454', '34545455454');

-- --------------------------------------------------------

--
-- Table structure for table `app_products_categories`
--

CREATE TABLE `app_products_categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `app_products_categories`
--

INSERT INTO `app_products_categories` (`id`, `name`, `image`) VALUES
(19, 'general category', 'mje3nje3mtvf_mtaymtq4njcw_04_05_22.jpg'),
(20, 'hair color', 'bxutmda2oc5_qcgckmnkkmt_04_05_22.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `app_purchases_invoices`
--

CREATE TABLE `app_purchases_invoices` (
  `id` int UNSIGNED NOT NULL,
  `supplier_id` int UNSIGNED NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `created` date NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `app_purchases_invoices_details`
--

CREATE TABLE `app_purchases_invoices_details` (
  `id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `quantity` smallint UNSIGNED NOT NULL,
  `bonus` smallint UNSIGNED DEFAULT NULL,
  `purchase_price` decimal(7,2) NOT NULL,
  `sell_price` decimal(7,0) NOT NULL,
  `invoice_id` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `app_purchases_invoices_receipts`
--

CREATE TABLE `app_purchases_invoices_receipts` (
  `id` int UNSIGNED NOT NULL,
  `invoice_id` int UNSIGNED NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `payment_amount` decimal(8,2) NOT NULL,
  `payment_literally` varchar(60) NOT NULL,
  `bank_name` varchar(30) DEFAULT NULL,
  `bank_account_number` varchar(30) DEFAULT NULL,
  `check_number` varchar(30) DEFAULT NULL,
  `transfer_to` varchar(30) DEFAULT NULL,
  `created` date NOT NULL,
  `user_id` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `app_sales_invoices`
--

CREATE TABLE `app_sales_invoices` (
  `id` int UNSIGNED NOT NULL,
  `client_id` int UNSIGNED DEFAULT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `created` date NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `app_sales_invoices_details`
--

CREATE TABLE `app_sales_invoices_details` (
  `id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `quantity` smallint NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `invoice_id` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `app_sales_invoices_receipts`
--

CREATE TABLE `app_sales_invoices_receipts` (
  `id` int UNSIGNED NOT NULL,
  `invoice_id` int UNSIGNED NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `payment_amount` decimal(8,2) NOT NULL,
  `payment_literally` varchar(60) NOT NULL,
  `bank_name` varchar(30) DEFAULT NULL,
  `bank_account_number` varchar(30) DEFAULT NULL,
  `check_number` varchar(30) DEFAULT NULL,
  `transfer_to` varchar(30) DEFAULT NULL,
  `created` date NOT NULL,
  `user_id` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `app_suppliers`
--

CREATE TABLE `app_suppliers` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `app_suppliers`
--

INSERT INTO `app_suppliers` (`id`, `name`, `phone_number`, `email`, `address`) VALUES
(2, 'General supplier', '', '', ''),
(3, 'Main store', '0125864855', 'h@h.com', 'Saudi arabia');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` char(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `subscription_date` date NOT NULL,
  `last_login` datetime NOT NULL,
  `group_id` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `username`, `password`, `email`, `phone_number`, `subscription_date`, `last_login`, `group_id`, `status`) VALUES
(13, 'admin', '$2y$10$83Le7T.fgpuJb/h51fUGuuDl30a8mPScZJJPK87LOjr3zTyD0TUm2', 'e@e.com', '12345679', '2022-05-01', '2022-09-17 14:46:42', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_users_groups`
--

CREATE TABLE `app_users_groups` (
  `id` tinyint UNSIGNED NOT NULL,
  `group_name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `app_users_groups`
--

INSERT INTO `app_users_groups` (`id`, `group_name`) VALUES
(13, 'HR'),
(12, 'Accountant'),
(11, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `app_users_groups_privileges`
--

CREATE TABLE `app_users_groups_privileges` (
  `id` tinyint UNSIGNED NOT NULL,
  `group_id` tinyint UNSIGNED NOT NULL,
  `privilege_id` tinyint UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `app_users_groups_privileges`
--

INSERT INTO `app_users_groups_privileges` (`id`, `group_id`, `privilege_id`) VALUES
(14, 12, 10),
(6, 11, 8),
(5, 11, 5),
(11, 11, 10),
(9, 12, 8),
(12, 11, 11),
(13, 11, 12),
(15, 13, 5),
(16, 13, 11),
(17, 11, 13),
(18, 11, 14),
(19, 11, 15),
(20, 11, 16),
(21, 11, 17),
(26, 11, 18),
(23, 11, 19),
(24, 11, 20),
(25, 11, 21),
(27, 11, 24);

-- --------------------------------------------------------

--
-- Table structure for table `app_users_privileges`
--

CREATE TABLE `app_users_privileges` (
  `id` tinyint UNSIGNED NOT NULL,
  `privilege_url` varchar(30) NOT NULL,
  `privilege_title` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `app_users_privileges`
--

INSERT INTO `app_users_privileges` (`id`, `privilege_url`, `privilege_title`) VALUES
(5, '/users/create', 'Create a new user'),
(8, '/suppliers/create', 'Create suppliers'),
(10, '/clients/create', 'Create a client'),
(11, '/users/edit', 'Edit users'),
(12, '/users/delete', 'Delete users'),
(13, '/users/default', 'Users list'),
(14, '/usersprivileges/create', 'Add privilege'),
(15, '/usersprivileges/default', 'Show privileges'),
(16, '/usersprivileges/edit', 'Edit privileges'),
(17, '/usersprivileges/delete', 'Privileges delete'),
(18, '/usersgroups/default', 'Show users groups'),
(19, '/usersgroups/create', 'Create users groups'),
(20, '/usersgroups/edit', 'Edit users groups'),
(21, '/usersgroups/delete', 'Delete users groups'),
(24, '/reports/default', 'Reports'),
(25, '/clients/default', 'Clients'),
(26, '/suppliers/default', 'Suppliers');

-- --------------------------------------------------------

--
-- Table structure for table `app_users_profiles`
--

CREATE TABLE `app_users_profiles` (
  `id` int UNSIGNED NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `image` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `app_users_profiles`
--

INSERT INTO `app_users_profiles` (`id`, `first_name`, `last_name`, `address`, `dob`, `image`) VALUES
(13, 'ehab', 'gaber', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_clients`
--
ALTER TABLE `app_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_expenses_categories`
--
ALTER TABLE `app_expenses_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_expenses_daily_lists`
--
ALTER TABLE `app_expenses_daily_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_id` (`expense_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `app_notifications`
--
ALTER TABLE `app_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `app_products`
--
ALTER TABLE `app_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `app_products_categories`
--
ALTER TABLE `app_products_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_purchases_invoices`
--
ALTER TABLE `app_purchases_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `app_purchases_invoices_details`
--
ALTER TABLE `app_purchases_invoices_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `app_purchases_invoices_receipts`
--
ALTER TABLE `app_purchases_invoices_receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `app_sales_invoices`
--
ALTER TABLE `app_sales_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `app_sales_invoices_details`
--
ALTER TABLE `app_sales_invoices_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `app_sales_invoices_receipts`
--
ALTER TABLE `app_sales_invoices_receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `app_suppliers`
--
ALTER TABLE `app_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `app_users_groups`
--
ALTER TABLE `app_users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_users_groups_privileges`
--
ALTER TABLE `app_users_groups_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `privilege_id` (`privilege_id`);

--
-- Indexes for table `app_users_privileges`
--
ALTER TABLE `app_users_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_users_profiles`
--
ALTER TABLE `app_users_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_clients`
--
ALTER TABLE `app_clients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_expenses_categories`
--
ALTER TABLE `app_expenses_categories`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_expenses_daily_lists`
--
ALTER TABLE `app_expenses_daily_lists`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_notifications`
--
ALTER TABLE `app_notifications`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_products`
--
ALTER TABLE `app_products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `app_products_categories`
--
ALTER TABLE `app_products_categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `app_purchases_invoices`
--
ALTER TABLE `app_purchases_invoices`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_purchases_invoices_details`
--
ALTER TABLE `app_purchases_invoices_details`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_purchases_invoices_receipts`
--
ALTER TABLE `app_purchases_invoices_receipts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_sales_invoices`
--
ALTER TABLE `app_sales_invoices`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_sales_invoices_details`
--
ALTER TABLE `app_sales_invoices_details`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_sales_invoices_receipts`
--
ALTER TABLE `app_sales_invoices_receipts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_suppliers`
--
ALTER TABLE `app_suppliers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `app_users_groups`
--
ALTER TABLE `app_users_groups`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `app_users_groups_privileges`
--
ALTER TABLE `app_users_groups_privileges`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `app_users_privileges`
--
ALTER TABLE `app_users_privileges`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `app_users_profiles`
--
ALTER TABLE `app_users_profiles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
