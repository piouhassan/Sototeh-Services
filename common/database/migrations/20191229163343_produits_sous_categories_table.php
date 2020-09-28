<?php

use Phinx\Migration\AbstractMigration;

class ProduitsSousCategoriesTable extends AbstractMigration
{
    public function change()
    {
        $this->table('p_sous-categories')
            ->addColumn('title', 'string')
            ->addColumn('cover', 'string', ['default' => 'null'])
            ->addColumn('p_category_id', 'integer')
            ->addTimestamps()
            ->create();

    }
}
