# Solipet

Solipet is an e-commerce web application for pet products, built with Laravel and Blade. It allows users to browse, search, and purchase a variety of pet supplies, food, treats, and accessories. The platform supports user authentication, cart management, order checkout, and admin inventory management.

## Features
- User registration, login, and password reset
- Browse products by pet type (cat, dog, small pet)
- Product search and detailed item pages
- Shopping cart with quantity management
- Checkout with shipping or store pickup options
- Payment methods: Cash on Delivery, GCash
- User profile and shipping address management
- Admin dashboard for managing products, orders, and payments
- Responsive design for desktop and mobile

## Setup Instructions

### Prerequisites
- PHP >= 8.0
- Composer
- Node.js & npm
- MySQL or compatible database

### Installation
1. **Clone the repository:**
   ```bash
   git clone <https://github.com/Monocerum/solipet>
   cd solipet
   ```
2. **Install PHP dependencies:**
   ```bash
   composer install
   ```
3. **Install JavaScript dependencies:**
   ```bash
   npm install
   ```
4. **Copy and configure environment file:**
   ```bash
   cp .env.example .env
   # Edit .env to set your database and mail credentials
   ```
5. **Generate application key:**
   ```bash
   php artisan key:generate
   ```
6. **Run migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```
7. **Build frontend assets:**
   ```bash
   npm run build
   ```
8. **Start the development server:**
   ```bash
   php artisan serve
   ```

## Usage Notes
- Access the site at `http://localhost:8000` after running the server.
- Register a new user or log in with seeded credentials.
- Admin features are accessible to users with the `is_admin` flag set in the database.
- Product images are stored in `public/assets/products/`.
- For GCash payments, enter a valid number (no real transaction is processed in dev mode).

## Project Structure
- `app/Http/Controllers/` - Application controllers
- `app/Models/` - Eloquent models
- `resources/views/` - Blade templates
- `routes/web.php` - Web routes
- `public/assets/` - Static assets and product images
- `database/migrations/` - Database schema
- `database/seeders/` - Seed data

## License
This project is for educational purposes. Contact the author for production use.
