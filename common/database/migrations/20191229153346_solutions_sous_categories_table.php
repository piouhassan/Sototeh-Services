<?php

use Phinx\Migration\AbstractMigration;

class SolutionsSousCategoriesTable extends AbstractMigration
{

    public function change()
    {
        $this->table('s_sous-categories')
            ->addColumn('title', 'string')
            ->addColumn('cover', 'string', ['default' => 'null'])
            ->addColumn('s_category_id', 'integer')
            ->addTimestamps()
            ->create();

    }
}
