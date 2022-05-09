<?php

declare(strict_types=1);

use App\Application\Actions\Campaign\ActivateCampaignAction;
use App\Application\Actions\Campaign\ListCampaignsAction;
use App\Application\Actions\Campaign\ListCampaignTypesAction;
use App\Application\Actions\Campaign\SaveCampaignAction;
use App\Application\Actions\Campaign\ViewCampaignAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello to Trbo API!');
        return $response;
    });

    $app->group('/campaigns', function (Group $group) {
        $group->get('', ListCampaignsAction::class);
        $group->post('', SaveCampaignAction::class);
        $group->get('/types', ListCampaignTypesAction::class);
        $group->get('/activate/{id}/{active}', ActivateCampaignAction::class);
        $group->get('/{id}', ViewCampaignAction::class);
    });
};
