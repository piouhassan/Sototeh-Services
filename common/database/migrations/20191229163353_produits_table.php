<?php

use Phinx\Migration\AbstractMigration;

class ProduitsTable extends AbstractMigration
{

    public function change()
    {
        $this->table('products')
            ->addColumn('name', 'string')
            ->addColumn('content', 'string')
            ->addColumn('cover', 'string', ['default' => 'null'])
            ->addColumn('p_sous-category_id', 'integer')
            ->addTimestamps()
            ->create();

    }
}
