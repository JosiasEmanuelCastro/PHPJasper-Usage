<?php

require '../vendor/autoload.php';

function generateReport($param, $input, $connect_db) {


	$filename = 'report_'.time(); 
	$ext = '.pdf';
    $input = $_SERVER['DOCUMENT_ROOT'] . '/PHPJasper/reports/' . $input.'.jasper';  
    $output = $_SERVER['DOCUMENT_ROOT'] . '/PHPJasper/reports/' . $filename;

	if($connect_db){
		$options = [
			'format' => ['pdf'],
			'locale' => 'en',
			'params' =>  $param,
			'db_connection' => [
				'driver' 	=> 'mysql',
				'username' 	=> 'root',
				'password' 	=> '""',
				'host' 		=> '127.0.0.1',
				'database'	=> 'test',
				'port' 		=> '3306'
			]
			// 'db_connection' => [
			// 	'driver' => 'generic',
			// 	'host' => '127.0.0.1',
			// 	'port' => '1433',
			// 	'database' => 'DataBaseName',
			// 	'username' => 'UserName',
			// 	'password' => 'password',
			// 	'jdbc_driver' => 'com.microsoft.sqlserver.jdbc.SQLServerDriver',
			// 	'jdbc_url' => 'jdbc:sqlserver://127.0.0.1:1433;databaseName=Teste',
			// 	'jdbc_dir' => $jdbc_dir
			// ]
		];
	}else{
		$options = [
			'format' => ['pdf'],
			'locale' => 'en',
			'params' =>  $param,
		];
	}


	$jasper = new PHPJasper\PHPJasper;
	$jasper->process(
		$input,
		$output,
		$options
	)->execute();

	header('Content-Type: application/pdf');
	header('Content-Disposition: inline; filename="'.basename($output.$ext).'"');
	header('Content-Length: ' . filesize($output.$ext));

	readfile($output.$ext);
	unlink($output.$ext);

	flush();
}