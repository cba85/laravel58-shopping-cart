# Laravel Shopping Cart

A simple Laravel e-commerce website.

## Features

- Users
- Products
- Product stock management
- Cart
- Checkout
- Stripe payment

## Install

Update values with your information in `.env` file:

```bash
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_shopping_cart
DB_USERNAME=root
DB_PASSWORD=

...

# Stripe API
STRIPE_PUBLIC_KEY=
STRIPE_SECRET_KEY=
```

Then launch the following commands:

```bash
$ php artisan migrate # Create database schema
$ php artisan db:seed # Add test products in database
$ npm run build # Compile project assets
```