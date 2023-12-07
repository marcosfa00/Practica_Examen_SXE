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