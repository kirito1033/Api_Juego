<?php

namespace App\Controllers;

use App\Models\WarriorSpellsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class WarriorSpellsController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $warriorSpellsModel = new WarriorSpellsModel();
        $warriorSpells = $warriorSpellsModel->findAll();
        return $this->respond($warriorSpells);
    }

    public function create()
    {
        $rules = [
            'warrior_id' => [
                'rules' => 'required|integer|is_not_unique[warrior.warrior_id]',
                'label' => 'Warrior ID'
            ],
            'spell_id' => [
                'rules' => 'required|integer|is_not_unique[spells.spell_id]',
                'label' => 'Spell ID'
            ]
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $warriorSpellsModel = new WarriorSpellsModel();
        $data = [
            'warrior_id' => $this->request->getPost('warrior_id'),
            'spell_id'   => $this->request->getPost('spell_id')
        ];

        $warriorSpellsModel->insert($data);
        return $this->respondCreated(['message' => 'Spell assigned to warrior successfully']);
    }


    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("id is required", 400);
        }
    
        $warriorSpellsModel = new WarriorSpellsModel();
    
        $existing = $warriorSpellsModel->find($id);
        if (!$existing) {
            return $this->failNotFound("Warrior_Spells type not found");
        }
    
        $warriorSpellsModel->delete($id);
    
        return $this->respondDeleted(['message' => 'Guerrero_Hechizo eliminado correctamente']);
    }

}
