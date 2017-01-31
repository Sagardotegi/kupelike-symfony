![logo](web/img/logo.png)

- [Instalación](#install)
- [Documentación](#doc)
- [Entorno desarrollo](#dev)
- [Entorno producción](#prod)

# <a name="install"></a> Instalación

Primero clonamos el repositorio en nuestra máquina:
```
git clone https://github.com/Sagardotegi/kupelike-symfony.git
```

Después ejecutamos:

```
composer install
```
Ésto nos instalará los paquetes de Symfony que hacen falta para nuestra aplicación, los cuales están definidos en el archivo `composer.json`.

Nos pedirá configurar la base de datos, lo haremos con nuestros datos de MySQL. 

### Crear las tablas en nuestra base de datos

Debemos ejecutar el siguiente comando:

```
php bin/console doctrine:schema:update
```

Existen también dos parámetros opcionales en este comando:

```
#Nos muestra la consulta SQL que podremos utilizar directamente en nuestra BD
php bin/console doctrine:schema:update --dump-sql

#Fuerza la actualización automática de la BD.
php bin/console doctrine:schema:update --force 
```

<<<<<<< HEAD
<<<<<<< HEAD
Nos pedirá configurar la base de datos, lo haremos con nuestros datos del MySQL que tengamos instalado en nuestra máquina.
=======
Nos pedirá configurar la base de datos, lo haremos con nuestros datos del MySQL que tengamos instalado en nuestra máquina. 

El archivo SQL de la base de datos creada hasta el momento se encuentra en la carpeta compartida de **DRIVE**
>>>>>>> f81bfbe21cbd0f5724feca50db805f7cc0fab4a6
=======
Hay que tener siempre en cuenta que **NO ES RECOMENDABLE** utilizar estos comandos en un entorno de producción, en ese caso es mejor ejecutar un `--dump-sql` y actualizar nuestra BD manualmente.

# <a name="doc"></a> Documentación

La documentación de la aplicación se encuentra en el siguiente enlace:

https://drive.google.com/open?id=1gUv1bgvK19tk7V1D2WhkFNlRwadqjHFe-jdtmSTGbFE

# <a name="dev"></a> Modo desarrollo

```
https://[tu-dominio]/web/app_dev.php
```

# <a name="prod"></a> Modo producción

Para acceder al modo producción, primero debemos limpiar la caché desde el servidor donde tenemos la aplicación en producción:

```
php bin/console cache:clear -e prod
```

Accedemos a través de la ruta:

```
https://[tu-dominio]/web/
```
>>>>>>> 09598654c674ad6a12c124f6a08407a25b5c77de
