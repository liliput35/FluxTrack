/*MORE SAMPLE INCIDENTS*/


-- Existing 5 incidents already inserted above
-- Add 15 more to make a total of 20
USE fluxtrack_db;



INSERT INTO incidents (description, location, reported_by, role_assigned_to, status, remarks, date, time)
VALUES
('Equipment Failure', 'Main Stage', 7, 'Engineering', 'Resolved', 'Sound system failure', '2025-11-08', '17:30:00'), 
('Medical Emergency', 'Gate 2', 7,'Security', 'Ongoing', 'First aid team on standby', '2025-11-08', '17:30:00'), 
('Lost Item', 'Food Court', 7, 'Security', 'Unresolved', 'Item never found', '2025-11-08', '17:30:00'), 
('Crowd Disturbance', 'Main Hall', 7, 'Operations', 'Ongoing', 'Operations Investigating', '2025-11-08', '17:30:00'), 
('Slip and Fall', 'Restroom Area', 7, 'Housekeeping', 'Resolved', 'Mopped wet floor', '2025-11-08', '17:30:00');


INSERT INTO incidents (description, location, reported_by, role_assigned_to, status, remarks, date, time)
VALUES
('Broken Light Fixture', 'Hallway B', 9, 'Engineering', 'Resolved', 'Replaced broken bulb', '2025-11-09', '09:45:00'),
('Suspicious Package', 'Parking Lot', 8, 'Security', 'Ongoing', 'Area cordoned off for inspection', '2025-11-09', '10:10:00'),
('Water Leak', 'Restroom 2F', 9, 'Engineering', 'Resolved', 'Pipe repaired successfully', '2025-11-09', '10:30:00'),
('Trash Overflow', 'Cafeteria', 9, 'Housekeeping', 'Ongoing', 'Extra bins requested', '2025-11-09', '11:00:00'),
('Unauthorized Entry', 'Gate 4', 8, 'Security', 'Resolved', 'Intruder escorted out', '2025-11-09', '11:25:00'),

('Power Fluctuation', 'Admin Office', 7, 'Engineering', 'Unresolved', 'Further testing required', '2025-11-10', '13:15:00'),
('Broken Chair', 'Conference Room', 9, 'Housekeeping', 'Resolved', 'Replaced with new unit', '2025-11-10', '13:40:00'),
('Spilled Coffee', 'Pantry', 9, 'Housekeeping', 'Resolved', 'Cleaned and sanitized', '2025-11-10', '14:00:00'),
('Fire Alarm Triggered', 'Warehouse', 8, 'Operations', 'Ongoing', 'Investigating cause of false alarm', '2025-11-10', '14:30:00'),
('Blocked Exit', 'Emergency Stairs', 8, 'Operations', 'Resolved', 'Cleared obstruction', '2025-11-10', '15:00:00'),

('Equipment Missing', 'Maintenance Room', 7, 'Security', 'Unresolved', 'Investigation ongoing', '2025-11-11', '08:00:00'),
('Wet Floor', 'Lobby Entrance', 9, 'Housekeeping', 'Resolved', 'Placed caution sign and dried area', '2025-11-11', '08:20:00'),
('Data Connection Lost', 'CCTV Room', 7, 'Engineering', 'Ongoing', 'Checking network switch', '2025-11-11', '09:00:00'),
('Noise Complaint', 'Dormitory Wing', 8, 'Operations', 'Resolved', 'Residents warned', '2025-11-11', '09:45:00'),
('Broken Door Lock', 'Restroom 3F', 9, 'Engineering', 'Resolved', 'Lock replaced', '2025-11-11', '10:10:00');
