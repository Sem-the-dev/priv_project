<?php

// Convert CSV to JSON
//function csvJson($inputFile, $outputFile) {
//    $data = array();
//    if (($handle = fopen($inputFile, "r")) !== FALSE) {
//        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
//            $data[] = $row;
//        }
//        fclose($handle);
//    }
//    file_put_contents($outputFile, json_encode($data, JSON_PRETTY_PRINT));
//    echo "CSV to JSON conversion completed. Output saved as $outputFile\n";
//}

// Convert CSV to JSON
function csvJson($inputFile, $outputFile) {
    $csvFile = fopen($inputFile, 'r');
    $headers = fgetcsv($csvFile);

    $data = array();
    while (($row = fgetcsv($csvFile)) !== false) {
        $data[] = array_combine($headers, $row);
    }
    fclose($csvFile);

    $json = json_encode($data, JSON_PRETTY_PRINT);

    $outputFile = 'output.json';
    file_put_contents($outputFile, $json);
    echo "CSV converted to JSON and saved as $outputFile\n";
}

// Convert CSV to XML
function csvXml($inputFile, $outputFile) {
    $xml = new SimpleXMLElement('<data></data>');
    if (($handle = fopen($inputFile, "r")) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $item = $xml->addChild('item');
            foreach ($row as $key => $value) {
                $item->addChild($key, $value);
            }
        }
        fclose($handle);
    }
    file_put_contents($outputFile, $xml->asXML());
    echo "CSV converted to XML and saved as $outputFile\n";
}

$inputFile = $argv[1];
$jsonOutputFile = 'output.json';
$xmlOutputFile = 'output.xml';

csvJson($inputFile, $jsonOutputFile);
csvXml($inputFile, $xmlOutputFile);

?>
