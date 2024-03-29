# SimpleShop

SimpleShop is a Laravel-based e-commerce platform designed for basic shopping functionality. This project showcases a streamlined approach to e-commerce, with features including user and product management, a shopping cart, likes system, and file upload capabilities.

## Features

- **User Authentication:** Supports registration, login/logout, and profile management using Laravel Breeze.
- **Product Management:** Allows listing of products with pagination, viewing product details, and upload capabilities for product images, including optional categorization.
- **Shopping Cart:** Enables adding and removing products from the cart and provides a simplified checkout process.
- **Likes System:** Offers the ability for users to 'like' products and displays a count of likes.
- **File Upload:** Supports uploading and optimizing images for products, improving the user experience and site performance.

## Getting Started

### Prerequisites

Ensure you have the following installed:

- PHP >= 7.3
- Composer
- Laravel
- A supported database (Project uses PostgreSQL)

### Installation

1. Clone the repository:

`git clone https://github.com/andishmandsaadi/simple-shop-laravel`

2. Navigate to the project directory:

`cd SimpleShop`

3. Install dependencies:

`composer install`

4. Copy `.env.example` to `.env` and configure your environment variables, including database settings:

`cp .env.example .env`

5. Generate an application key:

`php artisan key:generate`

6. Run migrations to create the database schema:

`php artisan migrate`

7. (Optional) Seed the database with initial data:

`php artisan db:seed`

8. Start the Laravel development server:

`php artisan serve`

9. Visit `http://localhost:8000` in your web browser to see the application in action.

## Usage

After installation, you can register as a new user to explore the user-specific features such as liking products and managing the shopping cart. To view and manage products, you need to be logged in.
