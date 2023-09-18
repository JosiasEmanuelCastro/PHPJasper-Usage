# Implementación de PHP Jasper
La implementation de Jasper en PHP se basa en la utilización de la librería [PHPJasper](https://github.com/PHPJasper/phpjasper).

Se han realizado actualizaciones en el código fuente, por lo que se recomienda utilizar el código fuente de este repositorio ubicado en `/vendor/geekcom`. Las modificaciones realizadas incluyen la adición de drivers para MySQL 8 y SQL Server, así como la modificación del archivo `vendor\geekcom\phpjasper\src\PHPJasper.php` para gestionar e imprimir errores de manera más efectiva.

## Requisitos
Para aprovechar al máximo esta librería, es necesario cumplir con los siguientes requisitos:

- PHP 7.2 o una versión superior
- Java JDK 1.8

## Opcional
Para habilitar conexiones a bases de datos (MySQL, PostgreSQL, MSSQL), es necesario instalar el driver JTDS en la ruta `/vendor/geekcom/bin/jasperstarter/jdbc`. 

Para SQL Server, se debe utilizar el driver `jtds-1.3.1.jar`, y para MySQL 8, el archivo `mysql-connector-j-8.0.31-javadoc.jar`. Ambos archivos se encuentran en la carpeta `/installers` de este repositorio y también se han agregado a la carpeta `/vendor/geekcom/bin/jasperstarter/jdbc`.

## Uso de Jasper
Para utilizar la aplicación `jasper_generate_report`, es necesario seguir estos pasos:

1. **Parámetro `report_filename`**: Este parámetro debe contener el nombre del archivo sin la extensión. El archivo debe estar ubicado en la carpeta `vendor/geekcom/phpjasper/reports` dentro de la librería externa `composer`.

2. **Parámetro `params`**: Debe ser un string en formato JSON que contiene los parámetros necesarios para la generación del informe. Por ejemplo: `{"myString": "text"}`. Asegúrate de proporcionar los parámetros requeridos para el informe en el formato adecuado.

3. **Conexión a la base de datos**: Utiliza la variable `connect_db` para indicar si se requiere una conexión a la base de datos. Esta variable debe contener un valor booleano (`true` o `false`) para determinar si la aplicación debe establecer una conexión a la base de datos.

A continuación, se muestra un ejemplo en PHP que ilustra cómo se pueden utilizar estos parámetros:

```php
[report_filename] = {file_name};
[params] = {params};
[connect_db] = {connect_db};
sc_redir('jasper_generate_report');
```

## Manejo de Errores
Los errores generados durante la ejecución del comando `jasperstarter` se imprimen en pantalla. Si se desea visualizar el comando ejecutado, se puede utilizar el método `printOutput()` de la clase PHPJasper de la siguiente manera:

```php
$jasper = new PHPJasper\PHPJasper;
$jasper->process(
    $input,
    $output,
    $options
)->printOutput();
```