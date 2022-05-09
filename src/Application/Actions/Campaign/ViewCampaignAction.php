<?php

declare(strict_types=1);

namespace App\Application\Actions\Campaign;

use Psr\Http\Message\ResponseInterface as Response;

class ViewCampaignAction extends CampaignAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $campaignId = (int) $this->resolveArg('id');
        $campaign = $this->campaignRepository->find($campaignId);

        $this->logger->info("Campaign was viewed.");

        return $this->respondWithData($campaign);
    }
}
