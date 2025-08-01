<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticleCategoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'article_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'category_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
        ]);
        
        $this->forge->addKey(['article_id', 'category_id'], true);
        
        $this->forge->addForeignKey('article_id', 'articles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('article_category');
    }

    public function down()
    {
        $this->forge->dropTable('article_category');
    }
}
