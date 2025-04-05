<?php

namespace App\Controllers;

use App\Models\PowerModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class PowerController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $powerModel = new PowerModel();
        
        $powers = $powerModel->findAll();
        return $this->respond($powers);
    }

    public function create()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]|is_unique[POWERS.name]',
            'description' => 'permit_empty|max_length[255]',
            'percentage' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]'
        ];
        
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors(), 400);
        }
        
        $powerModel = new PowerModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'percentage' => $this->request->getPost('percentage')
        ];
        
        $powerModel->insert($data);
        return $this->respondCreated(['message' => 'Created Successfully']);
      
      
    }

    public function getId($id = null)
    {
        if (!$id) {
            return $this->fail("Power_id is required", 400);
        }

        $powerModel = new PowerModel();
        
        $powerModel = $powerModel->find($id);
        if (!$powerModel) {
            return $this->failNotFound("Power_id not found");
        }

        return $this->respond($powerModel);
    }

    public function update($id = null)
    {
        $powerModel = new PowerModel();
       
        try {
            $json = $this->request->getJSON(true); 
        } catch (\Exception $e) {
            return $this->fail("Invalid JSON input: " . $e->getMessage(), 400);
        }

     
        if (!$json || !isset($json['Power_id'])) {
            return $this->fail("Power_id is required", 400);
        }

        $existing = $powerModel->find($json['Power_id']);
        if (!$existing) {
            return $this->failNotFound("power type not found");
        }

        $data = [
            'name' => $json['name'] ?? $existing['name'],
            'description' => $json['description'] ?? $existing['description'],
            'percentage' => $json['percentage'] ?? $existing['percentage'],
            'update_at' => date('Y-m-d H:i:s')
        ];

        
        $powerModel->update($json['Power_id'], $data);

        return $this->respondUpdated(['message' => 'Updated successfully']);
    }

    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("Power_id is required", 400);
        }
    
        $powerModel = new PowerModel();
    
        $existing = $powerModel->find($id);
        if (!$existing) {
            return $this->failNotFound("Power type not found");
        }
    
        $powerModel->delete($id);
    
        return $this->respondDeleted(['message' => 'Poder eliminado correctamente']);
    }


}