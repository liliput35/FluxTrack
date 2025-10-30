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
('Air Conditioner Malfunction', 'Meeting Room 2', 7, 'Engineering', 'Resolved', 'Compressor replaced', '2025-09-05', '10:15:00'),
('Lost Keycard', 'Reception', 8, 'Security', 'Ongoing', 'Verifying access logs', '2025-09-08', '08:30:00'),
('Dirty Windows', 'East Wing', 9, 'Housekeeping', 'Resolved', 'Windows cleaned thoroughly', '2025-09-10', '09:45:00'),
('Minor Fire Incident', 'Kitchen Area', 7, 'Operations', 'Resolved', 'Fire extinguished immediately', '2025-09-12', '12:10:00'),
('Broken Elevator Button', 'Elevator B', 9, 'Engineering', 'Unresolved', 'Awaiting spare parts', '2025-09-15', '14:20:00');


-- Insert updates related to the incident
INSERT INTO incident_updates (updated_by, incident_id, updateText, status, timestamp)
VALUES
(8, 1, 'Technician assigned for inspection', 'Ongoing', '2025-09-05 10:45:00'),
(8, 1, 'Compressor replaced and cooling restored', 'Resolved', '2025-09-05 13:10:00'),

(7, 2, 'Reported keycard missing, CCTV review started', 'Ongoing', '2025-09-08 09:00:00'),

(9, 3, 'Cleaning team dispatched to East Wing', 'Ongoing', '2025-09-10 09:30:00'),
(9, 3, 'All windows cleaned and inspected', 'Resolved', '2025-09-10 10:00:00'),

(7, 4, 'Fire reported in kitchen area, extinguishers deployed', 'Ongoing', '2025-09-12 12:15:00'),
(7, 4, 'Fire completely extinguished, safety verified', 'Resolved', '2025-09-12 12:30:00'),

(9, 5, 'Button damage assessed, awaiting part delivery', 'Unresolved', '2025-09-15 14:40:00');