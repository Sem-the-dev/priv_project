<?php

namespace App\Controller;

class DataController
{
    public function data($request, $response)
    {
        // JSON file path
        $jsonFilePath = __DIR__ . '/../output.json';

        // Check if the JSON file exists
        if (file_exists($jsonFilePath)) {
            // Read JSON file content
            $jsonData = file_get_contents($jsonFilePath);

            // Decode JSON data
            $data = json_decode($jsonData, true);
            $response->getBody()->write(json_encode([
                'success' => true,
                'data' => $data
            ]));

        }

        return $response->withHeader('Content-Type', 'application/json');

    }
}