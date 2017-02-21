![logo](web/img/logo.png)

- [Descripción](#description)
- [Instalación](#install)
- [Documentación](#doc)
- [Entorno desarrollo](#dev)
- [Entorno producción](#prod)
- [API](#api)

# <a name="description"></a> Descripción

&nbsp;La fama de las sidrerías en el País Vasco siempre ha sido divulgada mediante el boca a oreja. Este es un proceso largo y lento que no siempre da resultados, por lo que muchas sidrerías sufren dificultades al darse a conocer.  A ello se suma la dificultad de encontrar muchas de estar sidrerías, ya que la mayoría están situadas en lugares recónditos a las afueras de pequeños pueblos.
<br>&nbsp;Una vez en la sidrería, no hay manera de saber cuales son las kupelas (barricas) que más han gustado sin probarlas individualmente.
<br>&nbsp;Tras probar las diferentes sidras y tener una opinión (ya sea positiva o negativa) de ellas, en caso de querer comprar botellas de una kupela en concreto, es necesario pasarse de vez en cuando por la sidrería para preguntar si esa kupela ya ha sido embotellada.
<br>&nbsp;KupeLike es un proyecto para ofrecer todas las facilidades posibles tanto a las sidrerías como a los clientes de las mismas. La aplicación web mostrará un listado, fácilmente accesible, de todas las sidrerías junto a sus respectivas kupelas.  Al acceder a la aplicación web, ésta detectará la localización del usuario y en caso de que éste se encuentre en una sidrería, abrirá automáticamente la página de la misma. En caso contrario será dirigido a la página principal de la aplicación. Como su propio nombre indica (Kupela = Barrica, Like = Gustar), el objetivo principal es el de ofrecer al cliente la posibilidad de votar por aquellas kupelas que más le hayan gustado y ver el nivel de satisfacción del resto de clientes sobre dichas kupelas. La información ofrecida por los clientes, será mostrada tanto en la aplicación web como en unos dispositivos electrónicos conectados vía WiFi que estarán situados en cada una de las kupelas de cada sidrería registrada en nuestra aplicación. Estos dispositivos mostrarán en tiempo real la cantidad de votos de los que dispone la kupela en la que estará situada.
<br>&nbsp;Mediante un sistema de alertas añadido, el cliente tendrá la opción de indicar que desea recibir un aviso al email cuando la kupela que le ha gustado sea embotellada. De esta manera, el sidrero podrá enviar fácilmente dicho aviso a todos los clientes que así lo deseen.
<br>&nbsp;La aplicación también mostrará un mapa donde se mostrarán todas las sidrerías registradas en la aplicación y un mapa interactivo por cada una de ellas, el cual mostrará el recorrido necesario para llegar a la misma. En caso de que el cliente esté accediendo mediante un dispositivo móvil, la aplicación le abrirá el navegador del teléfono con la sidrería como destino.
<br>&nbsp;Por si todo esto no fuera suficiente, también se facilitará la información de contacto de las sidrerías tales como la dirección, el email y el teléfono.

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

# <a name="api"></a> API

 El proyecto conta de una apli para obtener los likes de cada kupela, otra api para añadir likes a la kupela y otra api para obtener los datos de una sidrería.
 
 https://kupelike.herokuapp.com/es/api/get-likes/<id de la kupela>
 https://kupelike.herokuapp.com/es/api/add-like/<id de la kupela>
 https://kupelike.herokuapp.com/es/api/get-sidreria/<id de la sidrería>