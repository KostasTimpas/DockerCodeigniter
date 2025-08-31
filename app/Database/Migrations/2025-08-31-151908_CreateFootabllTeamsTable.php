<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFootabllTeamsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => false,
                'auto_increment' => false, // Not auto increment
            ],
            'name'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'code'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'           => true,
            ],
            'country'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
            'founded'   => [
                'type'           => 'SMALLINT',
                'constraint'     => 4,
                'null'           => true,
            ],
            'national'  => [
                'type'           => 'BOOLEAN',
                'null'           => true,
                'default'        => false,
            ],
            'venue_id'  => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
            'league_id'  => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary key
        $this->forge->createTable('football_teams');
    }

    public function down()
    {
        $this->forge->dropTable('football_teams');
    }
}
