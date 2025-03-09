<?php

namespace App\Controllers;

use App\Models\WarriorTypeModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class WarriorTypeController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $warriorTypeModel = new WarriorTypeModel();
        
        $types = $warriorTypeModel->findAll();
        return $this->respond($types);
    }

    public function create()
    {
        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[WARRIOR_TYPE.name]',
                'label' => 'Warrior Name'
            ],
            'description' => [
                'rules' => 'permit_empty|max_length[255]',
                'label' => 'Description'
            ]
        ];
        
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $warriorTypeModel = new WarriorTypeModel();
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];
        
        $warriorTypeModel->insert($data);
        return $this->respondCreated(['message' => 'Registered Successfully']);
      
      
    }

    public function update($id = null)
    {
        $warriorTypeModel = new WarriorTypeModel();
       
        try {
            $json = $this->request->getJSON(true); 
        } catch (\Exception $e) {
            return $this->fail("Invalid JSON input: " . $e->getMessage(), 400);
        }

     
        if (!$json || !isset($json['type_id'])) {
            return $this->fail("type_id is required", 400);
        }

        $existing = $warriorTypeModel->find($json['type_id']);
        if (!$existing) {
            return $this->failNotFound("Warrior type not found");
        }

        $data = [
            'name' => $json['name'] ?? $existing['name'],
            'description' => $json['description'] ?? $existing['description']
        ];

        
        $warriorTypeModel->update($json['type_id'], $data);

        return $this->respondUpdated(['message' => 'Updated successfully']);
    }
    
    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("type_id is required", 400);
        }
    
        $warriorTypeModel = new WarriorTypeModel();
    
        $existing = $warriorTypeModel->find($id);
        if (!$existing) {
            return $this->failNotFound("Warrior type not found");
        }

        $warriorTypeModel->delete($id);
    
        return $this->respondDeleted(['message' => 'Tipo de guerrero eliminado correctamente']);
    }


}