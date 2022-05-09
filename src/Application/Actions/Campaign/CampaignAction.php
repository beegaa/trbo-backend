<?php

namespace App\Application\Actions\Campaign;

use App\Application\Actions\Action;
use App\Domain\Campaign\CampaignRespositoryInterface;
use Psr\Log\LoggerInterface;

abstract class CampaignAction extends Action
{
    protected CampaignRespositoryInterface $campaignRepository;

    public function __construct(LoggerInterface $logger, CampaignRespositoryInterface $campaignRepository)
    {
        parent::__construct($logger);
        $this->campaignRepository = $campaignRepository;
    }
}