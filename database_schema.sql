CREATE TABLE meeting_rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_id VARCHAR(50) NOT NULL,
    capacity INT NOT NULL,
    INDEX (room_id) 
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_id VARCHAR(50) NOT NULL, 
    booking_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    CONSTRAINT fk_room_id FOREIGN KEY (room_id) REFERENCES meeting_rooms(room_id)
);
