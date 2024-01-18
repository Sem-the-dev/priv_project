<?php

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
    $json = rtrim($json);

    $outputFile = 'output.json';
    file_put_contents($outputFile, $json);
    echo "CSV converted to JSON and saved as $outputFile\n";
}

// Convert CSV to XML
function csvXml($inputFile, $outputFile) {
    $csvFile = fopen($inputFile, 'r');
    $headers = fgetcsv($csvFile);

    // Create a new dom document with pretty formatting
    $xml = new DomDocument();
    $xml->formatOutput = true;

    // Add a root node to the document
    $root = $xml->createElement('rows');
    $root = $xml->appendChild($root);

    while (($row = fgetcsv($csvFile)) !== FALSE)
    {
        $container = $xml->createElement('row');
        foreach($headers as $i => $header)
        {
            $child = $xml->createElement(trim($header));
            $child = $container->appendChild($child);
            $value = $xml->createTextNode($row[$i]);
            $value = $child->appendChild($value);
        }

        $root->appendChild($container);
    }

    $xml->save($outputFile);
    echo "CSV converted to XML and saved as $outputFile\n";
}

$inputFile = $argv[1];
$jsonOutputFile = 'output.json';
$xmlOutputFile = 'output.xml';

csvJson($inputFile, $jsonOutputFile);
csvXml($inputFile, $xmlOutputFile);

?>
