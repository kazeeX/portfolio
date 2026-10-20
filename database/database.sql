-- =========================================================
-- Portfolio Database Schema (PostgreSQL)
-- Database Name: portfolio_db
-- Owner / Developer: Dhaffa Almuhar Dwi Setiawan
-- =========================================================

-- Optional: Create Database (run if database does not exist)
-- In psql, run:
-- CREATE DATABASE portfolio_db;
-- \c portfolio_db;

-- Drop table if it exists
DROP TABLE IF EXISTS projects;

-- Create the projects table
CREATE TABLE projects (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(500),
    project_link VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- Create the contact_messages table
-- (dipakai form kontak sejak versi database -- tanpa ini,
--  orang yang clone repo akan kena error
--  relation contact_messages does not exist)
-- Sengaja TANPA drop: tabel ini menampung pesan pengunjung,
-- jangan sampai terhapus kalau schema dijalankan ulang.
-- =========================================================
CREATE TABLE IF NOT EXISTS contact_messages (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- SQL to empty/clear the projects table:
-- =========================================================
-- DELETE FROM projects;

-- Verification query:
SELECT id, title, image_url, project_link, created_at FROM projects ORDER BY id ASC;
