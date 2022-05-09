<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignModel extends Model
{
    use HasFactory;

    protected $table = 'campaign';

    protected $primaryKey = 'campaign_id';

    protected $guarded = [];

    public $timestamps = false;
}