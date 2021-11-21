# Subscription APP test
## Configuration
Clone the app and run composer install then setup your environment file (.env)
```
composer install
```

### Run migration after setting up your database configuration in the .env
```
php artisan migrate
```
### Seed website data
```
php artisan db:seed WebsiteSeeder
```

Change the queue driver to database
```
QUEUE_DRIVER=database
```
### API ENDPOINTS

### Endpoint to subscribe to a website
```
/api/subscribe

Fields required:
website_id
email
```

### Endpoint to create new post
```
/api/create_post

Fields required:
website_id
title
description
```
