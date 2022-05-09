<?php

declare(strict_types=1);

namespace App\Application\Actions\Campaign;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ActivateCampaignAction extends CampaignAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $campaignId = (int) $this->resolveArg('id');
        $active = (bool) $this->resolveArg('active');

        $activated = $this->campaignRepository->activate($campaignId, $active);

        if ($activated == false) {
            throw new Exception('Activation/deactivation failed');
        }

        $this->logger->info("Campaign was viewed.");

        return $this->respondWithData();
    }
}
