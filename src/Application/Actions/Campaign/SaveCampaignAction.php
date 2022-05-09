<?php

declare(strict_types=1);

namespace App\Application\Actions\Campaign;

use App\Application\Enum\Campaign\CampaignStatus;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class SaveCampaignAction extends CampaignAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $formData = $this->getFormData();

        if ($this->validate($formData) == false) {
            throw new Exception('Invalid data');
        }

        $formData['campaign_start_time'] = date('Y-m-d', strtotime($formData['campaign_start_time']));
        $formData['campaign_end_time'] = date('Y-m-d', strtotime($formData['campaign_end_time']));
        $formData['campaign_status_id'] = CampaignStatus::Active;

        $model = $this->campaignRepository->createOrUpdate($formData, 'campaign_id');

        $this->logger->info("Campaign was saved.");

        return $this->respondWithData($model);
    }

    private function validate(array $attributes): bool
    {
        if (
            trim(($attributes['campaign_name'] ?? '')) == '' ||
            trim(($attributes['campaign_start_time'] ?? '')) == '' ||
            trim(($attributes['campaign_end_time'] ?? '')) == '' ||
            ($attributes['campaign_type'] ?? 0) <= 0
        )
            return false;

        if (date('Y-m-d', strtotime($attributes['campaign_start_time'])) > date('Y-m-d', strtotime($attributes['campaign_end_time'])))
            return false;

        return true;
    }
}
