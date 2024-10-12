# DS Estate Web Application

DS Estate is a web application for short-term property rentals, offering features like user authentication, property viewing, booking, and listing creation. Built with HTML5, CSS3, JavaScript, and PHP, it utilizes a MySQL database and supports responsive design for desktop and mobile. Users can browse available properties, book them, and create their own listings. The application is designed for local setup using XAMPP and includes functionalities for future enhancements such as advanced search, reviews, and payment integration.

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
   cd WEB_ALLKA_ARNEST_e21004
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

```bash
WEB_ALLKA_ARNEST_e21004
├── DS_Estate_DB/
│ └── ds_estate.sql
├── DS_Estate_Website/
│ ├── css/
│ │ ├── booking.css
│ │ ├── footer.css
│ │ ├── form.css
│ │ ├── header.css
│ │ ├── home.css
│ │ ├── listing.css
│ │ └── profile.css
│ ├── img/
│ │ ├── IMG-6677f5d96c99a4.14060222.jpg
│ │ ├── IMG-6677f6cbbc7ea0.62206566.jpg
│ │ ├── IMG-6677f8d50a08c3.57701540.jpg
│ │ ├── IMG-6677f99193cc38.30249490.jpg
│ │ └── house1.jpg
│ ├── includes/
│ │ ├── booking.inc.php
│ │ ├── create-listing.inc.php
│ │ ├── dbh.inc.php
│ │ ├── functions.inc.php
│ │ ├── login.inc.php
│ │ ├── logout.inc.php
│ │ ├── profile.inc.php
│ │ ├── reservation.inc.php
│ │ ├── search.inc.php
│ │ └── signup.inc.php
│ ├── js/
│ │ └── pagination.js
│ ├── booking.php
│ ├── create-listing.php
│ ├── feed.php
│ ├── footer.php
│ ├── header.php
│ ├── index.php
│ ├── login.php
│ ├── profile.php
│ ├── reservation.php
│ ├── reservations.php
│ └── signup.php
├── README.md
└── documentation.docx
```

## Future Improvements

- **Enhanced Responsive Design**: Further optimize for different devices.
- **Search and Filter**: Implement filters for properties.
- **Review System**: Allow users to leave reviews and ratings for properties.
- **Payment Integration**: Integrate online payment systems like PayPal or Stripe.
- **Security Enhancements**: Implement HTTPS and stronger encryption methods.

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes. Ensure your code adheres to the project's coding standards and passes all tests.

## License

No license for this project.

## Contact

For any inquiries or issues, please contact [Arnest Allka] at [arisallkas@gmail.com].
