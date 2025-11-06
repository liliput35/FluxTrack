/*
    MAIN DB STRUCTURE
*/

DROP DATABASE IF EXISTS fluxtrack_db;

CREATE DATABASE IF NOT EXISTS fluxtrack_db;
USE fluxtrack_db;

-- USERS TABLE
CREATE TABLE users (
  user_id INT(10) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  role VARCHAR(255) NOT NULL,
  username VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- INCIDENTS TABLE
CREATE TABLE incidents (
  incident_id INT(10) AUTO_INCREMENT PRIMARY KEY,
  description VARCHAR(255) NOT NULL,
  location VARCHAR(255) NOT NULL,
  reported_by INT(10),
  role_assigned_to VARCHAR(255),
  status VARCHAR(255) DEFAULT 'Ongoing',
  remarks VARCHAR(255),
  date DATE,
  time TIME,
  FOREIGN KEY (reported_by) REFERENCES users(user_id) ON DELETE SET NULL
);

-- INCIDENT UPDATES TABLE
CREATE TABLE incident_status_updates (
  id INT(10) AUTO_INCREMENT PRIMARY KEY,
  incident_id INT(10) NOT NULL,
  updated_by INT(10),
  old_status VARCHAR(255) NOT NULL,
  new_status VARCHAR(255) NOT NULL,
  old_timestamp DATETIME NOT NULL,
  updated_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (updated_by) REFERENCES users(user_id) ON DELETE SET NULL,
  FOREIGN KEY (incident_id) REFERENCES incidents(incident_id) ON DELETE CASCADE
);