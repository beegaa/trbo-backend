<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Application\Enum\Campaign\CampaignStatus;
use App\Application\Enum\Campaign\CampaignType;
use App\Domain\Campaign\Campaign;
use App\Domain\Campaign\CampaignRespositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\CampaignModel;

class CampaignRepository extends BaseRepository implements CampaignRespositoryInterface
{
    public function __construct(CampaignModel $model)
    {
        parent::__construct($model, Campaign::class);
    }

    public function allTypes(): array
    {
        return CampaignType::toArray();
    }

    public function activate(int $id, bool $active): bool
    {
        $campaign = $this->model->find($id);

        if ($campaign == null) {
            return false;
        }

        $campaign->update(['campaign_status_id' => $active ? CampaignStatus::Active : CampaignStatus::Deleted]);
        
        return true;
    }
}