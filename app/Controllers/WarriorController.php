<?php

namespace App\Controllers;

use App\Models\WarriorModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class WarriorController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $warriorModel = new WarriorModel();
        $warriors = $warriorModel->findAll();
        return $this->respond($warriors);
    }

    public function create()
    {
        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[warrior.name]',
                'label' => 'Warrior Name'
            ],
            'total_power' => [
                'rules' => 'required|integer',
                'label' => 'Total Power'
            ],
            'total_magic' => [
                'rules' => 'required|integer',
                'label' => 'Total Magic'
            ],
            'health' => [
                'rules' => 'required|integer',
                'label' => 'Health'
            ],
            'speed' => [
                'rules' => 'required|integer',
                'label' => 'Speed'
            ],
            'intelligence' => [
                'rules' => 'required|integer',
                'label' => 'Intelligence'
            ],
            'status' => [
                'rules' => 'required|in_list[active,injured,defeated]',
                'label' => 'Status'
            ],
            'type_id' => [
                'rules' => 'required|integer|is_not_unique[warrior_type.type_id]',
                'label' => 'Type ID'
            ],
            'race_id' => [
                'rules' => 'required|integer|is_not_unique[race.race_id]',
                'label' => 'Race ID'
            ]
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $warriorModel = new WarriorModel();
        $data = [
            'name'         => $this->request->getPost('name'),
            'total_power'  => $this->request->getPost('total_power'),
            'total_magic'  => $this->request->getPost('total_magic'),
            'health'       => $this->request->getPost('health'),
            'speed'        => $this->request->getPost('speed'),
            'intelligence' => $this->request->getPost('intelligence'),
            'status'       => $this->request->getPost('status'),
            'type_id'      => $this->request->getPost('type_id'),
            'race_id'      => $this->request->getPost('race_id'),
        ];

        $warriorModel->insert($data);
        return $this->respondCreated(['message' => 'Warrior registered successfully']);
    }


    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("Warrior_id is required", 400);
        }
    
        $warriorModel = new WarriorModel();
    
        $existing = $warriorModel->find($id);
        if (!$existing) {
            return $this->failNotFound("Warrior type not found");
        }
    
        $warriorModel->delete($id);
    
        return $this->respondDeleted(['message' => 'Guerro eliminado correctamente']);
    }


}
