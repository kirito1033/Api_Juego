<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRace extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'race_id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true,
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
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);

        $this->forge->addKey('race_id', true);
        $this->forge->createTable('RACE');
    }

    public function down()
    {
        $this->forge->dropTable('RACE');
    }
}
