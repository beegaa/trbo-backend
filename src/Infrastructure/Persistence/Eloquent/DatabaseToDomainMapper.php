<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Application\Enum\CampaignType;
use App\Domain\Campaign\Campaign;
use App\Infrastructure\Persistence\Eloquent\Models\CampaignModel;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\AutoMapperInterface;

trait DatabaseToDomainMapper
{
    private static ?AutoMapper $config = null;

    private function __construct()
    {
    }

    private static function initConfig(): AutoMapper
    {
        $config = new AutoMapperConfig();

        $config->registerMapping(CampaignModel::class, Campaign::class)
            ->beConstructedUsing(function (CampaignModel $source, AutoMapperInterface $mapper): Campaign {
                return new Campaign(
                    $source->campaign_id,
                    $source->campaign_name,
                    $source->campaign_type,
                    strtotime($source->campaign_start_time),
                    strtotime($source->campaign_end_time),
                    $source->campaign_status_id
                );
            });
        $config->registerMapping(Campaign::class, CampaignModel::class)
            ->forMember('campaign_id', function (Campaign $source) {
                return $source->getId();
            })
            ->forMember('campaign_name', function (Campaign $source) {
                return $source->getName();
            })
            ->forMember('campaign_type', function (Campaign $source) {
                return $source->getTypeId();
            })
            ->forMember('campaign_start_time', function (Campaign $source) {
                return $source->getStartTime();
            })
            ->forMember('campaign_end_time', function (Campaign $source) {
                return $source->getEndTime();
            })
            ->forMember('campaign_status_id', function (Campaign $source) {
                return $source->getStatusId();
            });

        return new AutoMapper($config);
    }

    public function getAutoMapperInstance(): AutoMapper
    {
        if (self::$config == null) {
            self::$config = self::initConfig();
        }
        return self::$config;
    }
}
