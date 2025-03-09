<?php

namespace App\Controllers;

use App\Models\SpellsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class SpellsController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $spellsModel = new SpellsModel();
        
        $spells = $spellsModel->findAll();
        return $this->respond($spells);
    }

    public function create()
    {
        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[SPELLS.name]',
                'label' => 'Spell Name'
            ],
            'description' => [
                'rules' => 'permit_empty|max_length[255]',
                'label' => 'Description'
            ],
            'percentage' => [
                'rules' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
                'label' => 'Percentage'
            ]
        ];
        
        
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $spellsModel = new SpellsModel();
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'percentage' => $this->request->getPost('percentage')
        ];
        
        $spellsModel->insert($data);
        return $this->respondCreated(['message' => 'Created Successfully']);
      
      
    }

    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("spell_id is required", 400);
        }
    
        $spellsModel = new SpellsModel();
    
        $existing = $spellsModel->find($id);
        if (!$existing) {
            return $this->failNotFound("Spell type not found");
        }
    
        $spellsModel->delete($id);
    
        return $this->respondDeleted(['message' => 'Hechizo eliminado correctamente']);
    }


}