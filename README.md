## CRUD 1
Este crud esta conectado con el modelo de Vet (veterinaria), hago uso del ORM de laravel para hacer las consultas a la BD,

## CRUD 2
Este crud esta conectado con el modelo de Pet (mascota), hago uso de SP que cree en las migraciones. <br>
los metodos para la consulta de los SP estan dentro dentro del modelo Pet.

## MIDDLEWARE
Se creo el middleware que require de un header token=api-key-laika para poder acceder a la API,

## PRUEBAS UNITARIAS
Se crearon 22 pruebas unitarias, la cuales busca probar las distintas respuestas de la API y sus requerimientos.

## EXCEPCIONES
Se crearon las excepciones para las consultas a la API.

## FRONT
Esta API se puede probar desde postman o desde un front creado con Vue.js para la consulta https://github.com/andsoler11/laika-prueba-front
