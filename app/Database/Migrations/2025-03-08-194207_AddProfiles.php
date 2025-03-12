<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfiles extends Migration 
{ 
    public function up() 
    { 
        $this->forge->addField([ 
            'profile_id' => [
                'type' => 'INT', 
                'constraint' => 11, 
                'unsigned' => true, 
                'auto_increment' => true
            ], 
            'profile_email' => [ 
                'type' => 'VARCHAR', 
                'constraint' => 255, 
                'unique' => true
            ], 
            'profile_name' => [ 
                'type' => 'VARCHAR', 
                'constraint' => 30
            ], 
            'profile_photo' => [ 
                'type' => 'VARCHAR', 
                'constraint' => 255, 
                'null' => true
            ], 
            'jugador_id_fk' => [ 
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

        $this->forge->addPrimaryKey('profile_id'); 
        $this->forge->addForeignKey('jugador_id_fk', 'jugadores', 'jugador_id', 'CASCADE', 'CASCADE', 'fk_jugador_profile'); 

        $this->forge->createTable('profiles'); 
    } 

    public function down() 
    { 
        $this->forge->dropTable('profiles'); 
    } 
}
