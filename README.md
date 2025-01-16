# E-Commerce Application

This is a feature-rich e-commerce application built with Laravel 9, featuring PayPal integration, database configuration, and email setup.

## Features

- User authentication and authorization.
- Product management (CRUD operations).
- Cart and checkout functionality.
- Payment integration with PayPal.
- Order management.
- Email notifications for order confirmation.

---

## Installation

### Prerequisites

- PHP >= 8.0
- Composer
- MySQL database
- Laravel 9

### Steps

1. **Clone the repository**

   ```bash
   git clone https://github.com/sadaqatali41/laravel-e-commerce.git
   cd <repository-folder>
   ```

2. **Install dependencies**

   ```bash
   composer install
   ```

3. **Environment setup**

   Copy the `.env.example` file and rename it to `.env`.

   ```bash
   cp .env.example .env
   ```

4. **Generate the application key**

   ```bash
   php artisan key:generate
   ```

5. **Database configuration**

   Update the `.env` file with your database credentials:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

6. **Run migrations**

   Migrate the database schema:

   ```bash
   php artisan migrate
   ```

7. **Email configuration**

   Update the `.env` file with your email credentials:

   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=your_mail_username
   MAIL_PASSWORD=your_mail_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=example@example.com
   MAIL_FROM_NAME="Your App Name"
   ```

8. **Seed the database (optional)**

   If you want to populate the database with sample data:

   ```bash
   php artisan db:seed
   ```

9. **Start the development server**

   ```bash
   php artisan serve
   ```

   Open your browser and navigate to `http://127.0.0.1:8000`.

---

## PayPal Integration

### Setup

1. Obtain your PayPal API credentials (client ID and secret) by creating an app in the [PayPal Developer Dashboard](https://developer.paypal.com/).

2. Update the `.env` file with your PayPal credentials:

   ```env
   PAYPAL_CLIENT_ID=your_paypal_client_id
   PAYPAL_CLIENT_SECRET=your_paypal_client_secret
   PAYPAL_MODE=sandbox # Use 'live' for production
   ```

3. Ensure that the PayPal integration is properly linked in your checkout process.

### Testing

- Use the PayPal sandbox credentials to test transactions in a development environment.

---

## Troubleshooting

If you encounter any issues:

- Check the Laravel log files in `storage/logs`.
- Verify your `.env` file for correct configuration.
- Ensure that all dependencies are installed properly.

---

## Contribution

Feel free to submit issues or pull requests. For major changes, please open an issue first to discuss what you would like to change.

---