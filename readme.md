# Katsana Test
1. Using [Laravel](https://laravel.com/docs/6.x) Framework Version 6.x
2. Using template [Bootstrap](https://getbootstrap.com/)


# Features
1. Katsana records
2. Katsana Export CSV
3. Katsana command import Json

# How to Use?
1. Clone Repository
2. install/update package composer
   <pre>composer install</pre>
3. Copy and replace file <b>.env.example</b> to <b>.env</b> and setting with your database
4. generate key
   <pre>php artisan key:generate</pre>
5. Migrate and seed table using
   <pre>php artisan migrate</pre>
6. Change APP_TIMEZONE according, default:
   <pre>Asia/Kuala_Lumpurl</pre>
7. Import example data from json, running artisan command:
   <pre>php artisan katsana:import</pre>
8. open `.env` in your root folder, 
   make sure where your enviroment running, 
   default `http://localhost:8000/`
9. When in local, run server using
      <pre>php artisan serve</pre>
10. Hopefully running well....^_^

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing
1. [Waviq Subhi](https://mastahcode.com/profile/waviq)
2. [Laravel documentation](http://laravel.com/docs/contributions).

## Questions

If have questions, email me on: waviq.subkhi@gmail.com

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).