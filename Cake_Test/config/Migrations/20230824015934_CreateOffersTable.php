<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateOffersTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('offers');
        $table->addColumn('offer_id', 'integer', [
            'null' => true,
        ]);
        $table->addColumn('name', 'string', [
            'null' => true,
        ]);
        $table->addColumn('anchor', 'string', [
            'null' => true,
        ]);
        $table->addColumn('requirements', 'text', [
            'null' => true,
        ]);
        $table->addColumn('offer_desc', 'text', [
            'null' => true,
        ]);
        $table->addColumn('ecpc', 'string', [
            'null' => true,
        ]);
        $table->addColumn('click_url', 'text', [
            'null' => true,
        ]);
        $table->addColumn('support_url', 'text', [
            'null' => true,
        ]);
        $table->addColumn('preview_url', 'text', [
            'null' => true,
        ]);
        $table->addPrimaryKey('id');
        $table->create();
    }
}
