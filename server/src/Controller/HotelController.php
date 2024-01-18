<?php

namespace App\Controller;

class HotelController
{
    public function hotel($request, $response, array $args)
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

            $foundHotel = null;

            foreach ($data as $hotel) {
                if ($hotel['name'] === $param) {
                    $foundHotel = $hotel;
                    break;
                }
            }
        }
        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => $foundHotel
        ]));

        return $response->withHeader('Content-Type', 'application/json');

    }
};