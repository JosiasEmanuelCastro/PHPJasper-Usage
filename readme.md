# JASPER PHP Implementation

La implementación de JASPER en PHP se basa en la utilización de la librería [PHPJasper](https://github.com/PHPJasper/phpjasper).

## Requisitos

Para utilizar esta librería, es necesario cumplir con los siguientes requisitos:

- PHP 7.2 o una versión superior. Puedes instalar la librería con Composer mediante el siguiente comando:

```bash
composer require geekcom/phpjasper
```
- Java JDK 1.8 instalado en tu sistema.

## Páginas Principales

Este proyecto consta de dos páginas principales:

1. **index.php**: Utilizada para compilar un informe. Debes proporcionar los parámetros requeridos en el campo de entrada de parámetros de la aplicación. Además, tienes la opción de especificar una conexión a la base de datos marcando la casilla "Conectar con base de datos".

2. **compile.php**: En la carpeta `reports`, encontrarás los informes. Sin embargo, para crear un informe, necesitas un archivo .jasper. Para obtener este archivo, debes utilizar este compilador, ya que si intentas crear el archivo .jasper con Jasper Studio, es probable que encuentres un error. Simplemente guarda el archivo .jrxml del informe en la carpeta `reports`, luego utiliza este compilador y proporciona el nombre del archivo en la carpeta para obtener el resultado final.

## Configuración de Conexión a la Base de Datos

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

Y este es un ejemplo utilizando SQL Server:

```php
// ...
$options = [
    'format' => ['pdf'],
    'locale' => 'en',
    'params' => [],
    'db_connection' => [
        'driver' => 'generic',
        'host' => '127.0.0.1',
        'port' => '1433',
        'database' => 'DataBaseName',
        'username' => 'UserName',
        'password' => 'password',
        'jdbc_driver' => 'com.microsoft.sqlserver.jdbc.SQLServerDriver',
        'jdbc_url' => 'jdbc:sqlserver://127.0.0.1:1433;databaseName=Teste',
        'jdbc_dir' => $jdbc_dir
    ]
];
$jasper = new PHPJasper;
$jasper->process(
    $input,
    $output,
    $options
)->execute();
```

Si estás utilizando SQL Server, es esencial que el driver `jtds-1.3.1.jar` se encuentre en la ruta de instalación de JasperStarter que utiliza PHPJasper, que es en `vendor\geekcom\phpjasper\bin\jasperstarter\jdbc`.

## Manejo de Errores
Cuando se produce un error durante la compilación o la creación del informe, la página mostrará el comando ejecutado. Para obtener más detalles sobre el problema, se recomienda ejecutar el mismo comando en la consola y depurar cualquier posible error. Los errores pueden surgir debido a varias situaciones, como la falta de un archivo .jasper, la inclusión de un parámetro inexistente, errores en fórmulas o fuentes inexistentes.

Desafortunadamente, la captura de detalles de error mostrados en la consola al ejecutar el comando a través de PHP no es posible, por lo que la única forma de ver el error es ejecutar el comando directamente en la consola.

Con el fin de realizar la depuración de los comandos generados por JasperStarter, se debe realizar la instalacion de JasperStarter como una aplicación independiente en el sistema. El archivo de instalación está disponible en la ruta `installers\jasperstarter-3.6.2-Setup.exe`, o puedes descargarlo directamente desde [SourceForge](https://sourceforge.net/projects/jasperstarter/).

Si estás utilizando MySQL asegúrate de colocar el controlador adecuado correspondiente a la versión de MySQL utilizada en el servidor en la carpeta de instalación de JasperStarter. Esto se encuentra en la siguiente ruta: `/docs/jdbc`. Por ejemplo, si estás utilizando MySQL v8.0.31, debes utilizar el controlador denominado `mysql-connector-j-8.0.31.jar`, que estará ubicado en `C:\Program Files (x86)\JasperStarter\docs\jdbc`.

Si estás utilizando SQL Server como tu sistema de gestión de bases de datos, verifica que el controlador denominado `jtds-1.3.1.jar` se encuentre en el directorio `C:\Program Files (x86)\JasperStarter\jdbc`. Esto es esencial para garantizar la conectividad adecuada y un funcionamiento sin problemas.