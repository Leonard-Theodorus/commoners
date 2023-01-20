<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Latin_small_letter_reversed_C_with_dot.svg/643px-Latin_small_letter_reversed_C_with_dot.svg.png" width="400"></a></p>



## About Commoners

Commoners as the name suggests it's a platform where commoners look for opportunity to work for small and medium enterprises in Indonesia.

- Simple, as a jobseeker you can apply with simplicity and ease
- As the enterprise, it's very simple to setup your account, and start posting job vacancy
- Eye-catching design provides functional and aesthethical application.

Commoners is the best platform to bridge small and medium enterprise and it's future employees.

## Downloading Commoners

- Make sure you have downloaded [Composer](https://getcomposer.org), and any MySQL engine. Both are the integral part of the application.
- Composer will be used to execute laravel artisan commands, since this projet is based on laravel.
- [XAMPP](https://www.apachefriends.org/download.html) is preferred.
- Create a database named "commoners" in your MySQL engine.
- Once all has been set. Download and unzip this project.
- Rename the .envexample file into .env
- And rename the database name into "commoners"
- Type in FILESYSTEM_DRIVER = public in the .env file you just renamed.
- Migrate the database and it's seeders with "php artisan migrate:fresh --seed" command.
- Finally, type in "php artisan serve" and commoners is ready to use.

If you don't feel like reading, all of the steps above are available in the [manual guide](https://drive.google.com/file/d/1W5MqeyC1fC88UbnB0rCUptByctq_oPfe/view?usp=share_link)
