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

Nos pedirá configurar la base de datos, lo haremos con nuestros datos del MySQL que tengamos instalado en nuestra máquina.

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
