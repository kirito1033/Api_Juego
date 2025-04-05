<?php

namespace App\Models;

use CodeIgniter\Model;

class JugadorModel extends Model
{
    protected $table            = 'jugadores';
    protected $primaryKey       = 'jugador_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jugador_name', 'jugador_password', 'roles_fk', 'jugador_status_fk', 'update_at'];

    protected bool $allowEmptyInserts = false;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    
}

