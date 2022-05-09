<?php

declare(strict_types=1);

namespace App\Application\Actions\Campaign;

use Psr\Http\Message\ResponseInterface as Response;

class ListCampaignTypesAction extends CampaignAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $types = $this->campaignRepository->allTypes();

        $this->logger->info("Campaign type list was viewed.");

        return $this->respondWithData($types);
    }
}
