<?php
require '../vendor/autoload.php';
require '../functions/generate_file_tree.php';

use PHPJasper\PHPJasper;

// Check if a parameter was submitted via POST
if (isset($_POST['param'])) {
    $param = $_POST['param'];

    $input = $_SERVER['DOCUMENT_ROOT'] . '/test/reports/' . $param . '.jrxml';

    $jasper = new PHPJasper;

    try {
        // Compile the JRXML file
        $jasper->compile($input)->execute();
        $successMessage = 'Compilation successful!';
    } catch (\Exception $e) {
        $error = 'Error: ' . $e->getMessage();
    }
}

// Specify the destination folder
$destinationFolder = $_SERVER['DOCUMENT_ROOT'] . '/test/reports/';
$fileTree = generateFileTree($destinationFolder);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
    <title>Jasper Report Compiler and File Tree</title>
    <style>
        ul {
            list-style: none;
        }

        ul ul {
            padding-left: 20px;
        }

        strong {
            color: #0070f3;
        }
    </style>
</head>
<body class="bg-gray-200 py-10">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-md shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Compile Jasper Report</h1>
        <?php if (!empty($error)): ?>
            <div class="mb-4 text-red-500">
                <?php echo $error; ?>
            </div>
        <?php elseif (!empty($successMessage)): ?>
            <div class="mb-4 text-green-500">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="mb-4">
                <label for="param" class="block text-gray-700">JRXML filename (without extension):</label>
                <input type="text" id="param" name="param" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none">Compile</button>
            </div>
        </form>
    </div>
    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold mb-4">File Tree</h2>
        <?php echo $fileTree; ?>
    </div>

    <div class="max-w-3xl mx-auto mt-8">
        <a href="./index.php" class="text-blue-500">Go to the report generator</a>
    </div>
</body>
</html>
