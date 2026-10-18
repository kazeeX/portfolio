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
-- SQL to empty/clear the projects table:
-- =========================================================
-- DELETE FROM projects;

-- Verification query:
SELECT id, title, image_url, project_link, created_at FROM projects ORDER BY id ASC;
