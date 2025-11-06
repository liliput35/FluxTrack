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
INSERT INTO incidents (description, location, reported_by, role_assigned_to, status, remarks, date, time)
VALUES
('Air Conditioner Malfunction', 'Meeting Room 2', 7, 'Engineering', 'Resolved', 'Compressor replaced', '2025-10-05', '13:10:00'),
('Lost Keycard', 'Reception', 8, 'Security', 'Unresolved', 'Verifying access logs', '2025-10-08', '08:30:00'),
('Dirty Windows', 'East Wing', 9, 'Housekeeping', 'Resolved', 'Windows cleaned thoroughly', '2025-10-10', '10:00:00'),
('Minor Fire Incident', 'Kitchen Area', 7, 'Operations', 'Resolved', 'Fire extinguished immediately', '2025-10-12', '12:30:00'),
('Broken Elevator Button', 'Elevator B', 9, 'Engineering', 'Resolved', 'Awaiting spare parts', '2025-10-15', '14:40:00');


INSERT INTO incident_status_updates 
(incident_id, updated_by, old_status, new_status, old_timestamp, updated_timestamp)
VALUES
-- Incident 1: Ongoing → Resolved
(1, 8, 'Ongoing', 'Resolved', '2025-10-05 10:45:00', '2025-10-05 13:10:00'),


-- Incident 3: Ongoing → Resolved
(3, 9, 'Ongoing', 'Resolved', '2025-10-10 09:30:00', '2025-10-10 10:00:00'),

-- Incident 4: Ongoing → Resolved
(4, 7, 'Ongoing', 'Resolved', '2025-10-12 12:15:00', '2025-10-12 12:30:00'),

-- Incident 5: Ongoing → Resolved
(5, 9, 'Ongoing', 'Resolved', '2025-10-15 14:20:00', '2025-10-15 14:40:00');