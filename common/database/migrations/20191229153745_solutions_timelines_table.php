<?php

use Phinx\Migration\AbstractMigration;

class SolutionsTimelinesTable extends AbstractMigration
{
    public function change()
    {
        $this->table('s_timelines')
            ->addColumn('title', 'string')
            ->addColumn('content', 'string')
            ->addColumn('cover', 'string', ['default' => 'null'])
            ->addColumn('s_sous-category_id', 'integer')
            ->addTimestamps()
            ->create();

    }
}
