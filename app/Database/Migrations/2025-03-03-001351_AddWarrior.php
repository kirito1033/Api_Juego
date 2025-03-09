<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWarrior extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'warrior_id'   => [
                'type'           => 'INT',
                'constraint'     => 10,
                'auto_increment' => true,
                'unsigned'       => true
            ],
            'name'         => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
            'total_power'  => ['type' => 'INT', 'default' => 0],
            'total_magic'  => ['type' => 'INT', 'default' => 0],
            'health'       => ['type' => 'INT', 'unsigned' => true, 'null' => false],
            'speed'        => ['type' => 'INT', 'unsigned' => true, 'null' => false],
            'intelligence' => ['type' => 'INT', 'unsigned' => true, 'null' => false],
            'status'       => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => false], 
            'type_id'      => ['type' => 'INT', 'unsigned' => true, 'null' => false],
            'race_id'      => ['type' => 'INT', 'unsigned' => true, 'null' => false], 
            'created_at'   => ['type' => 'TIMESTAMP', 'null' => true],
            'updated_at'   => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('warrior_id', true);
        $this->forge->addForeignKey('type_id', 'warrior_type', 'type_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('race_id', 'race', 'race_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('warrior');
    }

    public function down()
    {
        $this->forge->dropTable('warrior');
    }
}
