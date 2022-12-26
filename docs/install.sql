-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Des 2022 pada 00.15
-- Versi server: 10.3.37-MariaDB-0ubuntu0.20.04.1
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `waska_crm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `phone_type` int(11) DEFAULT NULL,
  `phone_number` varchar(16) DEFAULT NULL,
  `billing_street` varchar(255) DEFAULT NULL,
  `billing_city` varchar(64) DEFAULT NULL,
  `billing_state` varchar(64) DEFAULT NULL,
  `billing_zip` varchar(16) DEFAULT NULL,
  `billing_country` varchar(128) DEFAULT NULL,
  `shipping_street` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(64) DEFAULT NULL,
  `shipping_state` varchar(64) DEFAULT NULL,
  `shipping_zip` varchar(16) DEFAULT NULL,
  `shipping_country` varchar(128) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `industry` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `assigned` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `enhancer` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `website`, `email`, `phone_type`, `phone_number`, `billing_street`, `billing_city`, `billing_state`, `billing_zip`, `billing_country`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `type`, `industry`, `description`, `assigned`, `role`, `enhancer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CupsDev', 'https://www.cupsdev.ca', 'supp@be.sharp2-example.ca', 2, '6786657343', '321 Dalton Ave', 'Kingston', 'K7K', '0C4', 'Canada', '321 Dalton Ave', 'Kingston', 'K7K', '0C4', 'Canada', 3, 43, 'Lorem ipsum dolor sit amet', 5, 2, 1, '2022-12-26 07:28:12', '2022-12-26 17:40:07', NULL),
(2, 'Mona Mary', 'http://www.mona.mary.uk', 'supp@be.sharp-example3.ca', 2, '454788154', 'Upper Merrion Street 21', 'Dublin', '', '', 'Ireland', 'Upper Merrion Street 21', 'Dublin', '', '', 'Ireland', NULL, NULL, '', 5, 2, 5, '2022-12-25 16:24:08', '2022-12-26 23:16:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `salutation` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `account` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `phone_type` int(11) DEFAULT NULL,
  `phone_number` varchar(16) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `state` varchar(64) DEFAULT NULL,
  `zip` varchar(16) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `assigned` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `enhancer` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contacts`
--

INSERT INTO `contacts` (`id`, `salutation`, `first_name`, `last_name`, `account`, `title`, `email`, `phone_type`, `phone_number`, `street`, `city`, `state`, `zip`, `country`, `description`, `assigned`, `role`, `enhancer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'Michael', 'Schwarzberger', 1, 'Manager', 'micha@puertodemo.com', 4, '123-979-070', '', '', '', '', 'Indonesia', 'Lorem ipsum dolor sit amet', 5, 2, 1, '2022-12-26 23:56:48', '2022-12-27 00:15:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` char(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(320) DEFAULT NULL,
  `gender` enum('M','F') NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `email`, `gender`, `role`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'suluh', '$2y$10$o4T/WTLuCjR2yNPtbiLag.x635chUMm5/BKM8nizoDGttOHw.R6.e', 'Suluh Sulistiawan', 'torch@secret.fyi', 'M', 0, 1, '2022-12-10 16:01:02', NULL, NULL),
(5, 'admin', '$2y$10$hJIhaRmPqY.o49FWXw0y8OvZr2vUMFFeVnITdtDiCJDeElsers1si', 'Admin Tok', 'adm0n@waskacrm.dev', 'M', 2, 1, '2022-12-25 12:48:39', '2022-12-25 23:49:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_enhancer_foreign` (`enhancer`),
  ADD KEY `accounts_assigned_foreign` (`assigned`);

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_account_foreign` (`account`),
  ADD KEY `contacts_assigned_foreign` (`assigned`),
  ADD KEY `contacts_enhancer_foreign` (`enhancer`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_assigned_foreign` FOREIGN KEY (`assigned`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_enhancer_foreign` FOREIGN KEY (`enhancer`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_account_foreign` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_assigned_foreign` FOREIGN KEY (`assigned`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_enhancer_foreign` FOREIGN KEY (`enhancer`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
