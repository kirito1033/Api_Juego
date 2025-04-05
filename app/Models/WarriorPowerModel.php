<?php

namespace App\Models;

use CodeIgniter\Model;

class WarriorPowerModel extends Model
{
    protected $table            = 'warrior_powers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['warrior_id', 'power_id'];

    protected bool $allowEmptyInserts = false;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
