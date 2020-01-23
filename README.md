## About Pokerface


## Install

### Configuration
- Run the following command to download the latest version from github:
```
git clone  https://github.com/snikolaidis/pokerface
```
- Run the following commands to prepare the system:
```
composer install
npm install
php artisan key:generate
```
- Create an empty database for the application
- Modify the .env file by adding the database information
- Run the following commands to prepare the database:
```
php artisan migrate
php artisan db:seed
```

## Run