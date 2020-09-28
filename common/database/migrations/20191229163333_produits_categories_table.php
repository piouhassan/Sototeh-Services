<?php

use Phinx\Migration\AbstractMigration;

class ProduitsCategoriesTable extends AbstractMigration
{

    public function change()
    {
        $this->table('p_categories')
            ->addColumn('title', 'string')
            ->addColumn('cover', 'string', ['default' => 'null'])
            ->addTimestamps()
            ->create();

    }
}
