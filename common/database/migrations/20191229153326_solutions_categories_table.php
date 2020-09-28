<?php

use Phinx\Migration\AbstractMigration;

class SolutionsCategoriesTable extends AbstractMigration
{
    public function change()
    {
        $this->table('s_categories')
            ->addColumn('title', 'string')
            ->addColumn('cover', 'string', ['default' => 'null'])
            ->addTimestamps()
            ->create();

    }
}
