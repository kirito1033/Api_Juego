<?php

namespace App\Controllers;

use App\Controllers\BaseControllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

require '../vendor/autoload.php'; 

class User extends BaseController
{

    use ResponseTrait;
    public function index()
    {

        $users = new UserModel;
        return $this->respond(['users' => $users->findAll()], 200);
    }
}