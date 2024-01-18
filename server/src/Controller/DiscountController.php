<?php

namespace App\Controller;

class DiscountController
{
    public function discount($request, $response, array $args)
    {
        // JSON file path
        $jsonFilePath = __DIR__ . '/../output.json';

        // Check if the JSON file exists
        if (file_exists($jsonFilePath)) {
            // Read JSON file content
            $jsonData = file_get_contents($jsonFilePath);
            $jsonData = rtrim($jsonData);

            // Decode JSON data
            $data = json_decode($jsonData, true);
            $param = $args['param'];

            if (is_numeric($param)) {
                $filteredHotels = array_filter($data, function ($hotel) use ($param) {
                    return $hotel['discount_percentage'] == $param;
                });

                $response->getBody()->write(json_encode([
                    'success' => true,
                    'discount_percentage' => $filteredHotels
                ]));

            }
    }
            return $response->withHeader('Content-Type', 'application/json');
        }

};