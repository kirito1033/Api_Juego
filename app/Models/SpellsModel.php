<?php

namespace App\Models;

use CodeIgniter\Model;

class SpellsModel extends Model
{
    protected $table            = 'spells';
    protected $primaryKey       = 'spell_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description', 'percentage'];

    protected bool $allowEmptyInserts = false;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
