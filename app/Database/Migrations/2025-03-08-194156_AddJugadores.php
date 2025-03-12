<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJugadores extends Migration 
{ 
    public function up() 
    { 
        $this->forge->addField([ 
            'jugador_id' => [
                'type' => 'INT', 
                'constraint' => 11, 
                'unsigned' => true, 
                'auto_increment' => true
            ], 
            'jugador_name' => [ 
                'type' => 'VARCHAR', 
                'constraint' => 255, 
                'unique' => true
            ], 
            'jugador_password' => [ 
                'type' => 'VARCHAR', 
                'constraint' => 255
            ], 
            'roles_fk' => [ 
                'type' => 'INT', 
                'constraint' => 11, 
                'unsigned' => true, 
                'null' => true
            ], 
            'jugador_status_fk' => [ 
                'type' => 'INT', 
                'constraint' => 11, 
                'unsigned' => true, 
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

        $this->forge->addPrimaryKey('jugador_id'); 
        $this->forge->addForeignKey('jugador_status_fk', 'jugador_status', 'Jugador_status_id', 'CASCADE', 'SET NULL', 'fk_jugador_status'); 
        $this->forge->addForeignKey('roles_fk', 'jugador_roles', 'Roles_id', 'CASCADE', 'SET NULL', 'fk_jugador_role'); 
        $this->forge->createTable('jugadores'); 
      
    } 

    public function down() 
    { 
        $this->forge->dropTable('jugadores'); 
    } 
}
