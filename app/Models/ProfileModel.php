<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table            = 'profiles';
    protected $primaryKey       = 'profile_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['profile_email','profile_name','profile_photo','jugador_id_fk', 'update_at'];

    protected bool $allowEmptyInserts = false;
 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
