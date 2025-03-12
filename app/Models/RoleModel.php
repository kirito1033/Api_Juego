<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table            = 'jugador_roles';
    protected $primaryKey       = 'Roles_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Roles_name', 'Roles_description' , 'update_at'];

    protected bool $allowEmptyInserts = false;

  
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

   
}
