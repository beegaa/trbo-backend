<?php

namespace Trbo;

use Phoenix\Migration\AbstractMigration;

final class CreateCampaignTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('campaign', false)
            ->addColumn('campaign_id', 'integer', ['autoincrement' => true, 'null' => false])
            ->addColumn('campaign_name', 'string', ['length' => 50])
            ->addColumn('campaign_type', 'tinyinteger')
            ->addColumn('campaign_start_time', 'timestamp')
            ->addColumn('campaign_end_time', 'timestamp')
            ->addColumn('campaign_status_id', 'tinyinteger')
            ->addPrimary('campaign_id')
            ->create();
    }

    protected function down(): void
    {
        $this->table('campaign')
            ->drop();
    }
}
