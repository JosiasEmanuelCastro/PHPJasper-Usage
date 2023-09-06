## Introduction
The implementation of JASPER in PHP is based on the use of the [PHPJasper](https://github.com/PHPJasper/phpjasper) library.

### Requirements
To ensure the proper functioning of this library, you need to have PHP 7.2 or a higher version installed. You can install it by running the following command using Composer:

```bash
composer require geekcom/phpjasper
```

Additionally, it's essential to have Java JDK 1.8 and the JasperStarter program installed. You can obtain JasperStarter from the following links: [SourceForge](https://sourceforge.net/projects/jasperstarter/) or [Official Site](https://jasperstarter.cenote.de/).

### Pages
This project contains two main pages: `pages/index.php` and `pages/compile.php`, which serve the following purposes:

1. **index.php**: Used for compiling a report. You need to provide the parameters entered in the application's parameter input field. Additionally, you can specify a database connection by checking the "Connect with database" checkbox.

2. **compile.php**: In the `reports` folder, you will find the reports. However, to create a report, you need a .jasper file. To obtain this file, you should use this compiler because if you attempt to create the .jasper file with Jasper Studio, you may encounter an error. Simply save the .jrxml file of the report in the `reports` folder. Then, using this compiler, provide the filename in the folder to obtain the final result.

### Database Connection
The database connection is configured through the `$options` parameter passed to the `PHPJasper` class. Here's an example:

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

It's essential to note that you should place the driver corresponding to the MySQL version used on the server within the JasperStarter installation folder under `/docs/jdbc`. For example, for MySQL v8.0.31, you would use the `mysql-connector-j-8.0.31.jar` driver, which can be found in `C:\Program Files (x86)\JasperStarter\docs\jdbc`.

### Error Handling
When an error occurs during compilation or report creation, the page will display the executed command. To get more details about the problem, it's recommended to run the same command in the console and debug any potential errors. Errors can arise due to the following situations:

- The .jasper file was not created using the provided compiler.
- You provide a parameter that doesn't exist in the report.
- The report contains an error in a formula.
- The requested font in the report doesn't exist.

When in a production environment, it's advisable to hide the command and only display an error message during report generation. Unfortunately, attempts were made to capture error details displayed in the console when running the command via PHP, but it was not successful. Therefore, the only way to view the error is by executing the command directly in the console.