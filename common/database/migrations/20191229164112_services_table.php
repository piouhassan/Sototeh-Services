<?php

use Phinx\Migration\AbstractMigration;

class ServicesTable extends AbstractMigration
{
    public function change()
    {
        $this->table('services')
            ->addColumn('name', 'string')
            ->addColumn('content', 'string')
            ->addColumn('cover', 'string', ['default' => 'null'])
            ->addColumn('se_category_id', 'integer')
            ->addTimestamps()
            ->create();

    }
}
