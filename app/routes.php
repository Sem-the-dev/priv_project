<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

    // Define the GET /data route
    $app->get('/data', function (Request $request, Response $response) {
        // JSON file path
        $jsonFilePath = __DIR__ . '/../src/data.json';

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

            return $response->withHeader('Content-Type', 'application/json');
        } else {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'JSON file not found'
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    });
};






