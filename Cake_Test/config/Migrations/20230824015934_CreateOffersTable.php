<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateOffersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('offers');
        $table->addColumn('offer_id', 'integer', [
            'null' => false,
        ]);
        $table->addPrimaryKey('id');
        $table->addColumn('name', 'string', [
            'null' => false,
        ]);
        $table->addColumn('anchor', 'string', [
            'null' => true,
        ]);
        $table->addColumn('requirements', 'string', [
            'null' => true,
        ]);
        $table->addColumn('offer_desc', 'string', [
            'null' => true,
        ]);
        $table->addColumn('ecpc', 'string', [
            'null' => true,
        ]);
        $table->addColumn('click_url', 'string', [
            'null' => true,
        ]);
        $table->addColumn('support_url', 'string', [
            'null' => true,
        ]);
        $table->addColumn('preview_url', 'string', [
            'null' => true,
        ]);
        $table->create();
    }
}
