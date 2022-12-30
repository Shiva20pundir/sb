# Movie ticket booking portal
Movie ticket booking platform made in PHP
This is the platform for booking movie tickets. mainly only two programming languages used in this project. `PHP` is used for server-side programming and `MySql` for database management. this project has only two modules first one is Admin and the second one is User.

### Workflow of the project
- **Admin**
1. Admin Log in.
1. Admin adds movie details.
1. after that creating shows of the movie.
- **User**
1. Search for movies.
1. Check movie show's Availability.
1. Book the tickets(needs to log in. if user not logged in then user login.)
1. pay amount for the tickets.

For the payment process, [Stripe PHP Library](https://github.com/stripe/stripe-php) is used. for accessing `Stripe API`

1. go to the [Stripe PHP Library Github](https://github.com/stripe/stripe-php) page.
1. download the zip file.
1. extract into the project file. rename the folder to stripe e.g.(movie-ticket-booking-portal-in-PHP/stripe).
1. copy `require_once('stripe/init.php');` this line paste it into `book_ticket.inc.php` page.
you can able to do payments using credit and debit cards.

## Requirements
- `PHP` version above `7.0`.
- `Mysql` database.
