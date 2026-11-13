-- CAT2 database schema (PostgreSQL)
-- Run as the postgres superuser:  sudo -u postgres psql -f schema.sql
-- (or paste the blocks manually inside  sudo -u postgres psql )

-- 1. database + app login role
CREATE DATABASE "CAT2";
CREATE USER cat2user WITH PASSWORD 'StrongPass123';
GRANT ALL PRIVILEGES ON DATABASE "CAT2" TO cat2user;

-- 2. switch into CAT2 and let the app user use the schema
\c "CAT2"
GRANT ALL ON SCHEMA public TO cat2user;

-- 3. users table (signup / login)
CREATE TABLE users (
    id         SERIAL PRIMARY KEY,
    fullname   VARCHAR(100) NOT NULL,
    email      VARCHAR(100) UNIQUE NOT NULL,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. feedback table (the extra form)
CREATE TABLE feedback (
    id         SERIAL PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL,
    subject    VARCHAR(150),
    message    TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. let the app user read/write both tables
GRANT ALL PRIVILEGES ON ALL TABLES    IN SCHEMA public TO cat2user;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO cat2user;
