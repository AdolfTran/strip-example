# Strip-example
Example for using stripe

## Installation
1. Run `php artisan migrate`
2. Run `php artisan db:seeder`
3. Copy file .env.example to .env
4. Go to: https://dashboard.stripe.com/account/apikeys 
 - Copy `Publishable key` and paste to `STRIPE_KEY` in file .env
 - Copy `Secret key` and paste to `STRIPE_SECRET` in file .env
 5. Go to your site and test. The value for test:
 - Name on Card: Visa
 - Card Number: 4242 4242 4242 4242

## License
MIT License
