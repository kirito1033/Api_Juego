<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSpells extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'spell_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'percentage' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);

        $this->forge->addKey('spell_id', true);
        $this->forge->createTable('SPELLS');
    }

    public function down()
    {
        $this->forge->dropTable('SPELLS');
    }
}
