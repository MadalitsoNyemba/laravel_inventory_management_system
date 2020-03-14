# Inventory Management System
 This is an inventory management system written in laravel to keep track of products as well as the revenue made after sales.
 
## Getting Started
 These instructions will guide you to having the project running on your local machine.
 
### Installing
 Clone this repository to your desired folder
 ```
 Clone
 ```
Create a database in your MySql server
Import the sql dump into the created database
```
inventory_db.sql
```
Clear cache by running these commands in your project folder
```
php artisan cache:clear
php artisan config:cache
```
Run the server
```
php artisan serve
```
Make sure you register a user first as it will require you to login
```
http://127.0.0.1:8000/register
```
## Built with
*[AdminBSB template](https://github.com/gurayyarar/AdminBSBMaterialDesign) -  for UI

*[Laravel framework](https://laravel.com/)
