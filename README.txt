
------------------PARA COMENZAR A TRABAJAR-------------------------------
Para poder comenzar a trabajar con el proyecto se deberá ejecutar el siguiente comando para instalar los archivos que no se suben por el git.ignore
-> composer install


-------------------HISTORIAL DE INSTALACIONES-----------------------------

1.- composer require cs-fixer-shim  (Para que el codigo quede limpio, no es tan interesante pero con el comando "./vendor/bin/php-cs-fixer fix" corrige los errores de estilo en el codigo).

2.- composer require twig

3.- composer require debug

4.- composer require serializer (para pasar de JSON a objetos y de objetos a JSON)

5.- composer require asset-mapper (para organizar y mapear los archivos y los estilos // si no funciona en produccion revisar enlace marcado en edge) 
    //para hacer el mapeo php bin/console asset-map  

6.- composer require symfony/orm-pack y composer require --dev symfony/maker-bundle (para las bases de datos con doctrine)

7.- composer require doctrine/dbal (para poder conectar a una base de datos en sqlserver)

8.- composer require symfony/http-client (para poder usar las apis)

9.- composer require security (para usuarios)