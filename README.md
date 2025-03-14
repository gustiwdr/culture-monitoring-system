# Culture Monitoring System

## Overview

The Culture Monitoring System is a mini application built using Laravel 8, PostgreSQL, and Docker. It allows for the submission, approval, monitoring, and reporting of company cultural activities such as team-building events, health sessions, and more. The system ensures that company culture activities are running as planned and provides analytics on employee engagement.

## Features

- **Culture Agent**: Submit and update cultural activities.
- **Division Head**: Review and approve activities submitted by Culture Agents.
- **Admin Culture Human Capital**: Final approval for activities.
- **Monitoring**: Track the status of activities (Scheduled, Done, Canceled).
- **Reporting**: Provide detailed reports on completed activities (attendees, summary, photos).

## Tech Stack

- **Backend**: Laravel 8
- **Database**: PostgreSQL
- **Containerization**: Docker

## Installation and Setup

### Prerequisites

- Docker and Docker Compose installed on your machine.

### Steps to Set Up the Application

1. **Clone the Repository**

   ```bash
   git clone https://github.com/gustiwdr/culture-monitoring-system.git
   cd culture-monitoring-system
   ```

2. **Set Up Docker Environment**
   Make sure Docker is running on your machine.

   1. Build and start the Docker containers:

      ```bash
      docker-compose up --build -d
      ```

   2. The `docker-compose.yml` file will set up the application with all required services, including the PostgreSQL database.

3. **Install Laravel Dependencies**
   After the Docker containers are up, enter the Laravel container:

   ```bash
   docker-compose exec backend_container bash
   ```

   Inside the container, run the following command to install Laravel dependencies:

   ```bash
   composer install
   ```

4. **Set Up Environment Variables**
   Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

   Open the `.env` file and configure the database connection:

   ```env
   DB_CONNECTION=pgsql
   DB_HOST=postgres
   DB_PORT=5432
   DB_DATABASE=culture_monitoring
   DB_USERNAME=postgres
   DB_PASSWORD=your-password
   ```

5. **Generate Application Key**
   Run the following command to generate the application key:

   ```bash
   php artisan key:generate
   ```

6. **Run Database Migrations and Seeding**
   To set up the database tables and seed initial data, run:

   ```bash
   php artisan migrate --seed
   ```

   Running `php artisan migrate --seed` will create default users and sample divisions for testing.

7. **Access the Application**
   Open your browser and visit `http://localhost` to access the application.

## Default User Credentials (After Seeding)

After running `php artisan migrate --seed`, you can use the following credentials to log in:

- **Admin HC**

  - Email: `admin@company.com`
  - Password: `password`

- **Division Head**

  - Email: `head1@company.com`
  - Password: `password`

- **Culture Agent**
  - Email: `agent1@company.com`
  - Password: `password`

## Role-Based Access

- **Culture Agent**: Can submit reports and view their own submissions.
- **Division Head**: Can review and approve reports from Culture Agents in the same division.
- **Admin HC**: Has full access to review and approve all reports.

## Additional Setup (If Needed)

If images or files are not displaying correctly, run:

```bash
php artisan storage:link
```

If you encounter caching issues, clear cache using:

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```
