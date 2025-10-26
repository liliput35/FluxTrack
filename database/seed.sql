/*
    INSERT SAMPLE DATA TO DB
*/
USE fluxtrack_db;

-- Insert sample users
INSERT INTO users (name, role, username, password)
VALUES
('Maria Santos', 'Housekeeping', 'maria', '1234'),
('John Cruz', 'Security', 'john', '1234'),
('Ana Mendoza', 'Admin', 'ana', '1234');

-- Insert a sample incident
INSERT INTO incidents (description, location, reported_by, assigned_to, role_assigned_to, status, remarks, date, time)
VALUES
('Equipment Failure', 'Main Stage', 1, 2, 'Security', 'Ongoing', 'Sound system failure', '2025-10-08', '17:30:00');

-- Insert updates related to the incident
INSERT INTO incident_updates (updated_by, incident_id, updateText, status)
VALUES
(2, 1, 'Equipment inspected; replacement in progress', 'Ongoing'),
(2, 1, 'Equipment fixed and verified working', 'Resolved');
