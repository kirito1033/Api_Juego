<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWarriorType extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'type_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
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
        
        $this->forge->addKey('type_id', true);
        $this->forge->createTable('WARRIOR_TYPE');
    }

    public function down()
    {
        $this->forge->dropTable('WARRIOR_TYPE');
    }
}