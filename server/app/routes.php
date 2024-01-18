<?php

declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\ServerRequestInterface;
use App\Controller\DataController;
use App\Controller\HotelController;
use App\Controller\DiscountController;

return function (App $app) {

    // Get all data
    $app->get('/data', [DataController::class, 'data']);

    // Get hotel
    $app->get('/hotel/{param}', [HotelController::class, 'hotel']);

    // Get discount percentage
    $app->get('/discount/{param}', [DiscountController::class, 'discount']);

};