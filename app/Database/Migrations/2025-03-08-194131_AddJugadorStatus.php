<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJugadorStatus extends Migration 
{ 
    public function up() 
    { 
        $this->forge->addField([ 
            'Jugador_status_id' => [
                'type' => 'INT', 
                'constraint' => 11, 
                'unsigned' => true, 
                'auto_increment' => true
            ], 
            'Jugador_status_name' => [ 
                'type' => 'VARCHAR', 
                'constraint' => 30, 
                'unique' => true
            ], 
            'Jugador_status_description' => [ 
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

        $this->forge->addPrimaryKey('Jugador_status_id'); 
        $this->forge->createTable('Jugador_status'); 
    } 

    public function down() 
    { 
        $this->forge->dropTable('Jugador_status'); 
    } 
}

