<?php

namespace App\Domain\Campaign;

use App\Application\Enum\Campaign\CampaignStatus;
use App\Application\Enum\Campaign\CampaignType;
use App\Domain\BaseModel;
use JsonSerializable;

class Campaign extends BaseModel implements JsonSerializable
{
    private ?int $id;

    private string $name;

    private int $typeId;

    private int $startTime;

    private int $endTime;

    private int $statusId;

    private string $_type = '';

    private string $_status = '';

    public function __construct(?int $id, string $name, int $typeId, int $startTime, int $endTime, int $statusId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->typeId = $typeId;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->statusId = $statusId;

        $this->setCampaignTypeText();
        $this->setCampaignStatusText();
    }

    private function setCampaignTypeText(): void
    {
        switch ($this->typeId) {
            case CampaignType::Standard:
                $this->_type = 'Standard';
                break;
            case CampaignType::ABTest:
                $this->_type = 'AB Test';
                break;
            case CampaignType::MVTest:
                $this->_type = 'MV Test';
                break;
            default:
                $this->_type = 'Indefined';
                break;
        }
    }

    private function setCampaignStatusText(): void
    {
        switch ($this->statusId) {
            case CampaignStatus::Deleted:
                $this->_status = 'Deleted';
                break;
            case CampaignStatus::Active:
                $this->_status = 'Active';
                break;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function getType(): string
    {
        return $this->_type;
    }

    public function getStartTimestamp(): int
    {
        return $this->startTime;
    }

    public function getStartTime(): string
    {
        return date('d.m.Y H:i:s', $this->startTime);
    }

    public function getEndTimestamp(): int
    {
        return $this->endTime;
    }

    public function getEndTime(): string
    {
        return date('d.m.Y H:i:s', $this->endTime);
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function getStatus(): string
    {
        return $this->_status;
    }


    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'campaign_id' => $this->getId(),
            'campaign_name' => $this->getName(),
            'campaign_type' => $this->getTypeId(),
            'campaign_type_text' => $this->getType(),
            'campaign_start_time' => $this->getStartTime(),
            'campaign_start_timestamp' => $this->getStartTimestamp(),
            'campaign_end_time' => $this->getEndTime(),
            'campaign_end_timestamp' => $this->getEndTimestamp(),
            'campaign_status_id' => $this->getStatusId(),
            'campaign_status_text' => $this->getStatus()
        ];
    }
}
