# WEB_ALLKA_ARNEST_e21004

# DS Estate Web Application

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [Folder Structure](#folder-structure)
- [Future Improvements](#future-improvements)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Introduction

DS Estate is a web application designed for short-term property rentals. The application allows users to view available properties, register and log in, book properties, and create listings. This project is built using HTML5, CSS3, JavaScript, and PHP without the use of additional frameworks.

## Features

- **User Authentication**: Register and log in with unique username and email.
- **Property Feed**: View available properties with details such as photos, title, area, number of rooms, and price per night.
- **Booking System**: Book properties for specific dates and calculate final payment with a random discount.
- **Create Listings**: Users can create and manage their property listings.
- **Responsive Design**: Optimized for both desktop and mobile devices.

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL

## Installation

To set up the project locally, follow these steps:

1. Clone the repository to htdocs of the xampp directory:

   ```bash
   git clone https://github.com/arnest-allka/WEB_ALLKA_ARNEST_e21004.git
   cd ds-estate
   ```

2. Start a local XAMPP server:

   Open the XAMPP Control Panel and start the Apache server and MySQL server.

3. Open your browser and navigate to `localhost/WEB_ALLKA_ARNEST_e21004/DS_Estate_Website`.

## Database Setup

1. Navigate to localhost/phpmyadmin and create a database named `ds_estate`.

2. Import the database schema by using the database file ds_estate.sql in the DS_Estate_DB directory.

## Usage

### User Registration and Login

- Navigate to the Login/Register page.
- Use the registration form to create a new account.
- Log in with your username and password.

### Viewing and Booking Properties

- Visit the Feed page to see all available properties.
- Click on a property to view details and book it.
- Only logged-in users can book properties.

### Creating Listings

- Navigate to the Create Listing page after logging in.
- Fill in the property details and submit to create a new listing.

## Folder Structure
