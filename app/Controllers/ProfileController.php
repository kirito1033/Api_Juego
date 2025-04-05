<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;


class ProfileController extends ResourceController
{

    use ResponseTrait;

    public function index()
    {
        $profileModel = new ProfileModel();
        
        $profileModels = $profileModel->findAll();
        return $this->respond($profileModels);
    }

    public function create()
    {
        $rules = [
            'profile_email' => [
                'rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[profiles.profile_email]',
                'label' => 'Email'
            ],
            'profile_name' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[profiles.profile_name]',
                'label' => 'profile_name'
            ],
        ];
        
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $profileModel = new ProfileModel();
        $data = [
            'profile_email'=> $this->request->getPost('profile_email'),
            'profile_name' => $this->request->getPost('profile_name'),
            'profile_photo' => $this->request->getPost('profile_photo'),
            'jugador_id_fk' => $this->request->getPost('jugador_id_fk')
          
        ];
        
        $profileModel->insert($data);
        return $this->respondCreated(['message' => 'Created Successfully']);
      
      
    }

    public function getId($id = null)
    {
        if (!$id) {
            return $this->fail("profile_id is required", 400);
        }

        $profileModel = new ProfileModel();
        
        $profileModel = $profileModel->find($id);
        if (!$profileModel) {
            return $this->failNotFound("profile_id not found");
        }

        return $this->respond($profileModel);
    }

    public function update($id = null)
    {
        $profileModel = new ProfileModel();
       
        try {
            $json = $this->request->getJSON(true); 
        } catch (\Exception $e) {
            return $this->fail("Invalid JSON input: " . $e->getMessage(), 400);
        }

     
        if (!$json || !isset($json['profile_id'])) {
            return $this->fail("profile_id is required", 400);
        }

        $existing = $profileModel->find($json['profile_id']);
        if (!$existing) {
            return $this->failNotFound("profile type not found");
        }

        $data = [
            'profile_email' => $json['profile_email'] ?? $existing['profile_email'],
            'profile_name' => $json['profile_name'] ?? $existing['profile_name'],
            'profile_photo' => $json['profile_photo'] ?? $existing['profile_photo'],
            'jugador_id_fk' => $json['jugador_id_fk'] ?? $existing['jugador_id_fk'],
            'update_at' => date('Y-m-d H:i:s')
        ];

        
        $profileModel->update($json['profile_id'], $data);

        return $this->respondUpdated(['message' => 'Updated successfully']);
    }

    

    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("profile_id is required", 400);
        }
    
        $profileModel = new ProfileModel();
    
        $existing = $profileModel->find($id);
        if (!$existing) {
            return $this->failNotFound("profile type not found");
        }
    
        $profileModel->delete($id);
    
        return $this->respondDeleted(['message' => 'profile eliminado correctamente']);
    }
 
}