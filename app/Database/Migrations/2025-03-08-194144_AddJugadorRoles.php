<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJugadorRoles extends Migration 
{ 
    public function up() 
    { 
        $this->forge->addField([ 
            'Roles_id' => [
                'type' => 'INT', 
                'constraint' => 11, 
                'unsigned' => true, 
                'auto_increment' => true
            ], 
            'Roles_name' => [ 
                'type' => 'VARCHAR', 
                'constraint' => 30, 
                'unique' => true
            ], 
            'Roles_description' => [ 
                'type' => 'VARCHAR', 
                'constraint' => 300, 
                'null' => true 
            ], 
            'create_at' => [ 
                'type' => 'TIMESTAMP', 
                'null' => true 
            ], 
            'update_at' => [ 
                'type' => 'TIMESTAMP', 
                'null' => true 
            ] 
        ]); 

        $this->forge->addPrimaryKey('Roles_id'); 
        $this->forge->createTable('Jugador_roles'); 
    } 

    public function down() 
    { 
        $this->forge->dropTable('roles'); 
    } 
}
