<?php

namespace App\Controllers;

use App\Models\RoleModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;


class RolController extends ResourceController
{

    use ResponseTrait;

    public function index()
    {
        $roleModel = new RoleModel();
        
        $rolModel = $roleModel->findAll();
        return $this->respond($rolModel);
    }

    public function create()
    {
        $rules = [
            'Roles_name' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[jugador_roles.Roles_name]',
                'label' => 'Rol Name'
            ],
            'Roles_description' => [
                'rules' => 'permit_empty|max_length[255]',
                'label' => 'Description'
            ]
        ];
        
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $roleModel = new RoleModel();
        $data = [
            'Roles_name'        => $this->request->getPost('Roles_name'),
            'Roles_description' => $this->request->getPost('Roles_description'),
          
        ];
        
        $roleModel->insert($data);
        return $this->respondCreated(['message' => 'Created Successfully']);
      
      
    }

    public function update($id = null)
    {
        $roleModel = new RoleModel();
       
        try {
            $json = $this->request->getJSON(true); 
        } catch (\Exception $e) {
            return $this->fail("Invalid JSON input: " . $e->getMessage(), 400);
        }

     
        if (!$json || !isset($json['Roles_id'])) {
            return $this->fail("Roles_id is required", 400);
        }

        $existing = $roleModel->find($json['Roles_id']);
        if (!$existing) {
            return $this->failNotFound("Roles type not found");
        }

        $data = [
            'Roles_name' => $json['Roles_name'] ?? $existing['Roles_name'],
            'Roles_description' => $json['Roles_description'] ?? $existing['Roles_description'],
            'update_at' => date('Y-m-d H:i:s')
        ];

        
        $roleModel->update($json['Roles_id'], $data);

        return $this->respondUpdated(['message' => 'Updated successfully']);
    }

    

    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("Roles_id is required", 400);
        }
    
        $roleModel = new RoleModel();
    
        $existing = $roleModel->find($id);
        if (!$existing) {
            return $this->failNotFound("jugador_roles type not found");
        }
    
        $roleModel->delete($id);
    
        return $this->respondDeleted(['message' => 'jugador_role eliminado correctamente']);
    }
 
}