<?php

declare(strict_types=1);

namespace App\Application\Actions\Campaign;

use Psr\Http\Message\ResponseInterface as Response;

class ListCampaignsAction extends CampaignAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $campaigns = $this->campaignRepository->all();

        $this->logger->info("Campaign list was viewed.");

        return $this->respondWithData($campaigns);
    }
}
