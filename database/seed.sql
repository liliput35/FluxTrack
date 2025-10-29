/*
    INSERT SAMPLE DATA TO DB
*/
USE fluxtrack_db;

-- Insert sample users
INSERT INTO `users` (`user_id`, `name`, `role`, `username`, `password`) VALUES
(7, 'Julian Mapa', 'Admin', 'sirmapa', '$2y$10$cYtbDgiOo/iCUKFro3Um8ujHar/mmRaVTHsHWag4rIYImUw3uk80C'),
(8, 'Lorenz Ciocon', 'Security', 'lorenz', '$2y$10$mZOf0frhbgdrctsz7nAWIORLzsUhvVSa1bnqhBjOxzvfZ925LAv3u'),
(9, 'Mia Chua', 'Housekeeping', 'mia', '$2y$10$1ZTV3OU6WFlhG6QOpCHDmu9O70ikkImGWPfx.M2Ap/cOUFCncwuX.');

-- Insert a sample incident
INSERT INTO incidents (description, location, reported_by, assigned_to, role_assigned_to, status, remarks, date, time)
VALUES
('Equipment Failure', 'Main Stage', 7, 8, 'Security', 'Ongoing', 'Sound system failure', '2025-10-08', '17:30:00');

-- Insert updates related to the incident
INSERT INTO incident_updates (updated_by, incident_id, updateText, status)
VALUES
(8, 1, 'Equipment inspected; replacement in progress', 'Ongoing'),
(8, 1, 'Equipment fixed and verified working', 'Resolved');
