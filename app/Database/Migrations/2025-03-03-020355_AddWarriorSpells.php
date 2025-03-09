<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWarriorSpells extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
              
            ],
            'warrior_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'spell_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null,
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null,
            ],
        ]);

        $this->forge->addKey('id', true); 
        $this->forge->addForeignKey('warrior_id', 'warrior', 'warrior_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('spell_id', 'spells', 'spell_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('warrior_spells');
    }

    public function down()
    {
        $this->forge->dropTable('warrior_spells', true);
    }
}