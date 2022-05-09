<?php

namespace App\Application\Enum\Campaign;

use App\Application\Enum\Enum;

class CampaignType extends Enum
{
    const Standard = 1;
    const ABTest = 2;
    const MVTest = 3;
}
