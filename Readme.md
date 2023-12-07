# Creación de un Pluguin para WordPress

## Descripción
Creamos el archivo **docker-compose.yml**
Aquí vamos a levantar un wordpress con una base de datos mysql
Para ello vamos a usar dos servicios, uno para la base de datos y otro para el wordpress
despues podremos usar php porque wordpress esta hecho en php

## PLUGIN
Bien con el servicio ya levantado y configurado, vamos a crear un **plugin** para wordpress

Para eso debemos entrar en esta ruta
```bash
cd /html/wp-content/plugins
```
Ahora vamos a crear una carpeta para nuestro plugin
```bash
mkdir nombreCarpetaPlugin
cd nombreCarpetaPlugin
```
Ahora vamos a crear un archivo **php** para nuestro plugin
```bash
touch nombreArchivoPlugin.php
```
Ahora vamos a editar el archivo **php** para nuestro plugin

Pero primero deemos establecer la conexión con la base de datos

Aquí un error muy comun sería conectarse con el usuario **wordpress** y la contraseña **wordpress** pero no es así, porque el usuario **wordpress** no tiene permisos para crear tablas en la base de datos, por lo tanto debemos conectarnos con el usuario **root** y la contraseña en este caso **somewordpress**

Vale, ahora si que vamos a configurar el archivo **PHP** para nuestro plugin

Hemos hecho una fución, para crear una tabla, otra para insertar caracteres y otra para hacer la consulta y subtitución de caracteres
