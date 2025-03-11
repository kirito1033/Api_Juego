<?php

namespace App\Models;

use CodeIgniter\Model;

class JugadorStatusModel extends Model
{
    protected $table            = 'jugador_status';
    protected $primaryKey       = 'Jugador_status_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Jugador_status_name', 'Jugador_status_description', 'update_at'];

    protected bool $allowEmptyInserts = false;
    
   
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


}
