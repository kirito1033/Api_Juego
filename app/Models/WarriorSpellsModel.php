<?php

namespace App\Models;

use CodeIgniter\Model;

class WarriorSpellsModel extends Model
{
    protected $table            = 'warrior_spells';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['warrior_id', 'spell_id'];

    protected bool $allowEmptyInserts = false;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
