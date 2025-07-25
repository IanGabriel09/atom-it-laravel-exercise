Instructions:

1.) Use xampp to run a localhost server of apache and mysql
2.) Run composer install, and npm install after cloning.
4.) Use the DB connection credentials below for the env variable. (Input your db server credentials if you have one, preferrably mysql)
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=z_laravel_testdb
    DB_USERNAME=root
    DB_PASSWORD=

3.) Run 'php artisan migrate', and afterwards run the seeders below
    * php artisan db:seed --class="AdminSeeder"
    * php artisan db:seed --class="AuthorSeeder"
    * php artisan db:seed --class="PostSeeder" 

4.) Run php artisan key:generate
5.) Run php artisan serve
6.) Use this credentials to get past the auth system(You can also check the credentials in 'AdminSeeder' file on the database folder)
    username: 001
    pass: admin_123
