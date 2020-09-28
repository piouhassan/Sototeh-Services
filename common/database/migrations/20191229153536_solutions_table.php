<?php

use Phinx\Migration\AbstractMigration;

class SolutionsTable extends AbstractMigration
{

    public function change()
    {
        $this->table('solutions')
            ->addColumn('title', 'string')
            ->addColumn('content', 'string')
            ->addColumn('s_sous-category_id', 'integer')
            ->addTimestamps()
            ->create();

    }
}
