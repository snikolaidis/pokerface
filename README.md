## About Pokerface

## Installation

- Run the following command to download the latest version from github:
```
git clone https://github.com/snikolaidis/pokerface
```
- Open a console window and cd in the project folder
- Create a new .env file:
```
cp .env.example .env
```
- Create an empty database for the application
- Modify the .env file by adding the database information
- Run the following commands to prepare the system:
```
composer install
npm install
php artisan key:generate
```
- Run the following commands to prepare the database:
```
php artisan migrate
php artisan db:seed
```
- Build the assets:
```
npm run dev
```
- Serve the application:
```
php artisan serve
```
- Enjoy the application [here](http://127.0.0.1:8000)!

## Testing

From the command line, run the following:
```
./vendor/bin/phpunit --testsuite Feature
```