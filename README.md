# Meeting Room Booking System

The Meeting Room Booking System is a web-based application designed to facilitate the booking of meeting rooms for various events, meetings, or conferences. The system provides users with the ability to view available meeting rooms, make bookings, and manage existing bookings. Administrators have access to additional functionalities for managing meeting rooms, including adding, editing, and deleting rooms.

## Features

- **User Booking**: Users can view the availability of meeting rooms for specific dates and times, make bookings, and manage their existing bookings.
- **Admin Dashboard**: Administrators have access to a dashboard where they can manage meeting rooms, including adding, editing, and deleting rooms.
- **Authentication**: Basic authentication is implemented to differentiate between regular users and administrators.
- **Database Integration**: The system utilizes a MySQL database to store information about meeting rooms and bookings.

## Installation

To set up the Meeting Room Booking System on your local machine, follow these steps:

1. Clone the repository:

    ```bash
    git clone https://github.com/stha1122/MRBS.git
    ```

2. Import Database Schema:

    - Create a MySQL database named `meeting_room_booking`.
    - Import the provided SQL file `database_schema.sql` into the database.

3. Configure Database Connection:

    - Open the `db_connect.php` file located in the root directory.
    - Update the database connection parameters (hostname, username, password) if necessary.

4. Set up the Web Server:

    - Place the project files in the document root of your web server (e.g., `htdocs` directory in XAMPP).

5. Access the Application:

    - Open a web browser and navigate to the URL where the application is hosted (e.g., `http://localhost/MRBS`).

## Usage

### User Booking:

1. Navigate to the application's main page.
2. View available meeting rooms by selecting a date and time slot.
3. Book a room by following the prompts on the booking form.

### Admin Dashboard:

1. Access the admin dashboard by logging in with the provided credentials (username: admin, password: admin@123).
2. From the dashboard, administrators can:
   - Add new meeting rooms with their capacities.
   - Edit existing meeting room details, including capacity.
   - Delete meeting rooms.


## Technologies Used

- HTML
- CSS
- PHP
- MySQL

