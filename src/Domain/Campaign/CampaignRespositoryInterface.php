<?php

namespace App\Domain\Campaign;

use App\Domain\BaseRepositoryInterface;

interface CampaignRespositoryInterface extends BaseRepositoryInterface
{
    public function allTypes(): array;

    public function activate(int $id, bool $active): bool;
}
