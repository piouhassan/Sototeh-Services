<?php

use Phinx\Migration\AbstractMigration;

class ServicesCategoriesTable extends AbstractMigration
{
    public function change()
    {
        $this->table('se_categories')
            ->addColumn('title', 'string')
            ->addColumn('cover', 'string', ['default' => 'null'])
            ->addTimestamps()
            ->create();
    }
}
