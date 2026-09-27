-- ==========================================================
-- Database Schema: Biodata Mahasiswa
-- Tugas 2 - Proyek Mini: CRUD Read & Create (CodeIgniter 4)
-- Universitas Muhammadiyah Mataram (UMMAT)
-- ==========================================================

CREATE DATABASE IF NOT EXISTS `db_biodata_kampus` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_biodata_kampus`;

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nim` VARCHAR(20) NOT NULL UNIQUE,
  `nama` VARCHAR(100) NOT NULL,
  `jenis_kelamin` ENUM('Laki-laki', 'Perempuan') NOT NULL,
  `prodi` VARCHAR(50) NOT NULL,
  `alamat` TEXT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample Seed Data untuk pengujian fitur Read
INSERT INTO `mahasiswa` (`nim`, `nama`, `jenis_kelamin`, `prodi`, `alamat`) VALUES
('202401001', 'Muhammad Naufal Daffa', 'Laki-laki', 'Teknik Informatika', 'Mataram, Nusa Tenggara Barat'),
('202401002', 'Siti Rahmawati', 'Perempuan', 'Teknik Informatika', 'Lombok Barat, Nusa Tenggara Barat'),
('202401003', 'Ahmad Fadillah', 'Laki-laki', 'Sistem Informasi', 'Lombok Timur, Nusa Tenggara Barat');
