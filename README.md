# StayInn.com

StayInn.com is a hotel booking app built using a combination of PHP, MySQL, JavaScript, and Bootstrap. The project demonstrates the implementation of CRUD operations and object-oriented programming concepts.

## Installation

No external library installation is necessary as the Bootstrap library is included through a CDN link. The project comes with a SQL database file named stayinn.sql located in the Db folder. This database includes dummy data that allows you to test the project as both a customer and a staff member with access to the StayInn.com admin CMS. The user information is provided later in this README file.

```bash
To access StayInn.com, follow these steps:

1. Ensure you have cross-platform web server software installed on your machine, such as XAMPP or MAMP.

2. Import the stayinn.sql database into MySQL using the PHPMyAdmin Console.

3. Move the project to your htdocs folder.

You should now be able to access the StayInn.com project in your browser through localhost.
```

## Project Flow

```bash
Upon visiting the website, the user will be directed to the Hotels page.
To access the rest of the websites functionality, the user must first sign in.
If the user clicks on the "explore more" button, a popover will appear asking the user to sign up or log in.

The user can then follow the links to sign up or log in. 
The sign-up form will add a new user to the SQL database, while the login page will redirect the user back to the Hotels page.

From the Hotels page, the user can navigate to the hotel view page to calculate the total cost
of a booking and make a reservation. After confirming the booking,
the user will be directed to the booking successful page, where they can download the invoice, view their bookings, or return to the Hotels page.

The user also has access to their profile page, where they can update their account information.
There is a separate bookings page where the user can view and cancel their bookings.

The SQL database includes three dummy users and some bookings (both completed and canceled).

The user information is as follows:

User 1: admin / PW: admin
User 2: user / PW: user
User 3: customer / PW: customer

```

## Backend CMS
```bash
The CMS has three pages:

1. Users Page
2. Bookings Page
3. Hotels Page
In the backend, a user can view the app data in tabular form and make use of sort and search functions. Additionally,
they have the option to add a new hotel to the database, and if the user is signed in as an admin they can also add new users to the database.

```

## Languages used

The following languages are used in this project:

PHP
MySQL Queries
HTML
CSS
Bootstrap


## License

[MIT](https://choosealicense.com/licenses/mit/)