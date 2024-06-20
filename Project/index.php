<?php
require 'helperFunctions.php';
$fileDir = "./Data/sample_1.csv";

$dataArray = [];
$income = 0;
$expenses = 0;
$netTotal = 0;

try {
    //attempt to open the file, throws an exception if it fails
    $file = fopen($fileDir, 'r');
    if (!$file) {
        throw new Exception("Unable to open file!");
    }

    //read the first line to skip it
    //throws an exception if it fails

    $firstLine = fgetcsv($file);
    if (!$firstLine) {
        throw new Exception("Unable to read the file!");
    }

    //read file content and calculate total

    while (($line = fgetcsv($file)) !== false) {
        $dataArray[] = $line;

        $formattedAmount = FormatTransaction($line[3]);

        if ($formattedAmount < 0) {
            $expenses += $formattedAmount;
        } else {
            $income += $formattedAmount;
        }

    }
    $netTotal = $income + $expenses;

    //close file
    fclose($file);
} catch (Exception $e) {
    echo $e->getMessage();
}

require 'ViewTransactions.html';
