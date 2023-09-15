
# Products API Project

The project consists of three models and one pivot table. Models: User, Role, Product; Pivot table: role_user
Two types of administrators are defined (admin and editor). This was done only to open the option to update roles in the future, although we will only use admin in the project. Admin is created through the Custom command described in the text below, and the goal is to create a user and assign roles to him by running the command in a few steps. APIs are secured using Laravel Sanctum and RoleMiddleware for different roles. CRUD operations are implemented using the repository pattern.
API Resource was used to transform the response data and Custom Form Request was used to validate the data.
The project is partially covered by feature tests, just to see how other tests could be written on the basis of the defined ones


## Installation

Install.: 
XAMPP (https://www.apachefriends.org/), 
Composer (https://getcomposer.org/download/), 
Git Bash (https://git-scm.com/downloads) 

Create MySQL database in phpMyAdmin then open your CLI and run these commands one by one:

```bash
  git clone <repo>

  composer install

  cp .env.example .env 
  
  (put your db credentials inside .env)

  php artisan key:generate

  php artisan migrate --seed

  php artisan serve


```
    
## Running PHPUnit Tests

To run tests, run the following command

```bash
  php artisan test

  or

  ./vendor/bin/phpunit
```
## Running Postman Tests

Refresh and seed database running the following command:

```bash
  php artisan migrate:fresh --seed
```

Create admin user (There is a select role option just to show possibilites of selection through the command handling process. Choose admin role pressing just Enter or type 0 and press Enter. Password must contain min 8 characters):

```bash
  php artisan users:create
```

Download Postman from https://www.postman.com/ then install and import file from:

```bash
  ./z-postman-json (folder is in the root of the project)
```

Go to <b>Login user</b> collection and login with email and password you set using command php artisan users:create (Put email and password in the body section.) After you're logged in you will get Bearer token in response. Copy that token and set inside <b>Authorization - Bearer Token</b> section for these collections: <b>Store product</b>, <b>Update product</b>, <b>Delete product</b> because only logged in user as admin has an access to those APIs. You don't need a token for collections <b>Get products</b> and <b>Get product</b>. They are public APIs.

## Notice

I approached the creation of the project using Repository Pattern, Middleware, API versioning, ... In any case, It would take more time but the project could be done by applying some additional approaches like: Custom Exceptions and Error Handlers, Services, Traits, Enums, Docker containers (PHP, Composer, Nginx, PostgreSQL), Permissions etc. 