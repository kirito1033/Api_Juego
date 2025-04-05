<?php

namespace App\Models;

use CodeIgniter\Model;

class RaceModel extends Model
{
    protected $table            = 'race';
    protected $primaryKey       = 'race_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description'];

    protected bool $allowEmptyInserts = false;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
