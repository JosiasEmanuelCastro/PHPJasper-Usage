<!-- JASPER STUDIO -->
## Introducción
La implementación de JASPER php se basa en la utilización de la librería [PHPJasper](https://github.com/PHPJasper/phpjasper).

### Requisitos
Para que esta librería funcione correctamente, es necesario contar con PHP 7.2 o una versión superior. Para instalarla, puedes ejecutar el siguiente comando utilizando Composer:

```bash
composer require geekcom/phpjasper
```

Además, es fundamental tener instalado Java JDK 1.8 y el programa JasperStarter. Puedes obtener JasperStarter desde los siguientes enlaces: [SourceForge](https://sourceforge.net/projects/jasperstarter/) o [Sitio Oficial](https://jasperstarter.cenote.de/).

### Páginas
Este proyecto contiene dos páginas principales: `pages/index.php` y `pages/compile.php`, que cumplen las siguientes funciones:

1. **index.php**: Utilizado para compilar un informe. Se deben proporcionar los parámetros ingresados en el campo de entrada de parámetros de la aplicación. Además, puedes especificar una conexión a la base de datos si marcas la casilla "Conectar con base de datos".

2. **compile.php**: En la carpeta `reports`, encontrarás los informes. Sin embargo, para crear un informe, necesitas un archivo .jasper. Para obtener este archivo, debes utilizar este compilador, ya que si intentas crear el archivo .jasper con Jasper Studio, es probable que encuentres un error. Solo guarda el archivo .jrxml del informe en la carpeta `reports`, luego, utilizando este compilador, proporciona el nombre del archivo en la carpeta para obtener el resultado final.

### Conexión a la Base de Datos
La conexión a la base de datos se configura mediante el parámetro `$options` que se pasa a la clase `PHPJasper`. Aquí tienes un ejemplo:

```php
// ...
$options = [
    'format' => ['pdf'],
    'locale' => 'en',
    'params' =>  $param,
    'db_connection' => [
        'driver'    => 'mysql',
        'username'  => 'root',
        'password'  => '""',
        'host'      => '127.0.0.1',
        'database'  => 'test',
        'port'      => '3306'
    ]
];

$jasper = new PHPJasper;
$jasper->process(
    $input,
    $output,
    $options
)->execute();
```

Es importante notar que debes ubicar el driver correspondiente a la versión de MySQL utilizada en el servidor dentro de la carpeta de instalación de JasperStarter, en la ruta `/docs/jdbc`. Por ejemplo, para MySQL v8.0.31, se utiliza el driver `mysql-connector-j-8.0.31.jar`, que se encuentra en `C:\Program Files (x86)\JasperStarter\docs\jdbc`.

En el caso de sql server el driver `jtds-1.3.1.jar` se debe encontrar en la carpeta `C:\Program Files (x86)\JasperStarter\jdbc`.

### Manejo de Errores
Cuando ocurre un error durante la compilación o la creación del informe, la página mostrará el comando ejecutado. Para obtener más detalles sobre el problema, se recomienda ejecutar el mismo comando en la consola y depurar cualquier posible error. Los errores pueden surgir debido a las siguientes situaciones:

- El archivo .jasper no se creó utilizando el compilador proporcionado.
- Se proporciona un parámetro que no existe en el informe.
- El informe contiene un error en una fórmula.
- La fuente solicitada en el informe no existe.

Cuando se encuentra en producción, es recomendable ocultar el comando y mostrar únicamente un mensaje de error en la generación del informe. Lamentablemente, intentamos capturar los detalles de error que se muestran en la consola al ejecutar el comando a través de PHP, pero no fue posible. Por lo tanto, la única forma de ver el error es ejecutar el comando en la consola directamente.