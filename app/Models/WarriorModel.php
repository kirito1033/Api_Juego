<?php

namespace App\Models;

use CodeIgniter\Model;

class WarriorModel extends Model
{
    protected $table            = 'warrior';
    protected $primaryKey       = 'warrior_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'name',
    'total_power',
    'total_magic',
    'health',
    'speed',
    'intelligence',
    'status',
    'type_id',
    'race_id'];

    protected bool $allowEmptyInserts = false;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
