<?php

require '../vendor/autoload.php';

function generateReport($param, $input, $connect_db) {

	$filename = 'report_'.time(); 
	$ext = '.pdf';
    $input = realpath('../reports') . '/' . $input.'.jasper';  
    $output = realpath('../reports') . '/' . $filename;

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

	return ;

	// echo json_encode($output);

	header('Content-Type: application/pdf');
	header('Content-Disposition: inline; filename="'.basename($output.$ext).'"');
	header('Content-Length: ' . filesize($output.$ext));

	readfile($output.$ext);
	unlink($output.$ext);

	flush();
}