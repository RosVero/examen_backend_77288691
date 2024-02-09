# BACKEND BIBLIOTECA


Backend corregido el cual expone los servicios a ser consumidos en el proyecto biblioteca


## Instrucciones

- Crear el archivo .env y copiar ahi la informacion de .env.example  
- composer update  
- Crear la base de datos "laravel" en mysql  
- php artisan key:generate  
- php artisan migrate  
- php artisan db:seed  
- php artisan serve  

#### se modificó el nombre del controlador PrestamosController por PrestamoController ademas de todas sus referencias, posterior a ello se adicionò informacion en cada uno de los controladores y se crearon las rutas correspondientes, generamos vendor con composer update