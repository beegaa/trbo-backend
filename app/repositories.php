<?php

declare(strict_types=1);

use App\Domain\Campaign\CampaignRespositoryInterface;
use App\Infrastructure\Persistence\Eloquent\CampaignRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        CampaignRespositoryInterface::class => \DI\autowire(CampaignRepository::class),
    ]);
};
