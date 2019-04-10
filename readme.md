<h1 align="center">Alexandria Library Management System</p>

## About 

Alexandria is a simple exercise repo. 
Future functionality may be added soon. 
At the moment it's got:

- An authentication system (The one that Laravel includes by default)
- CRUD operations for books.
- Sort books
- Filter books by title
- A borrowing system
- Fancy UI using [materializecss](https://materializecss.com/)

## Prerequisites

You need composer and npm to install this repository

## Installation

Clone the repo and run:

```
composer install
cp .env.example .env
```

Configure in your .env file your database connection.
Now you need to run

```
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
```
And you should be all set up.

You can deploy the site however you want, but the easiest way is by running:

```
php artisan serve
```

Now you just need to go to [localhost:8000](http://localhost:8000/) and voilá

## License

You can do whatever you want with this software. [MIT license](http://opensource.org/licenses/MIT).
