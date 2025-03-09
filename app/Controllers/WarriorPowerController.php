<?php

namespace App\Controllers;

use App\Models\WarriorPowerModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class WarriorPowerController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $warriorPowerModel = new WarriorPowerModel();
        $warriorPowers = $warriorPowerModel->findAll();
        return $this->respond($warriorPowers);
    }

    public function create()
    {
        $rules = [
            'warrior_id' => [
                'rules' => 'required|integer|is_not_unique[warrior.warrior_id]',
                'label' => 'Warrior ID'
            ],
            'power_id' => [
                'rules' => 'required|integer|is_not_unique[powers.power_id]',
                'label' => 'Power ID'
            ]
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $warriorPowerModel = new WarriorPowerModel();
        $data = [
            'warrior_id' => $this->request->getPost('warrior_id'),
            'power_id'   => $this->request->getPost('power_id')
        ];

        $warriorPowerModel->insert($data);
        return $this->respondCreated(['message' => 'Warrior power assigned successfully']);
    }
    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("id is required", 400);
        }
    
        $warriorPowerModel = new WarriorPowerModel();
    
        $existing = $warriorPowerModel->find($id);
        if (!$existing) {
            return $this->failNotFound("Warrior_Power type not found");
        }
    
        $warriorPowerModel->delete($id);
    
        return $this->respondDeleted(['message' => 'Guerrero_Poder eliminado correctamente']);
    }
}
