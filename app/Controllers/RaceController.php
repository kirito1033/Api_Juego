<?php

namespace App\Controllers;

use App\Models\RaceModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class RaceController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $raceModel = new RaceModel();
        
        $races = $raceModel->findAll();
        return $this->respond($races);
    }

    public function create()
    {
        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[RACE.name]',
                'label' => 'Race Name'
            ],
            'description' => [
                'rules' => 'permit_empty|max_length[255]',
                'label' => 'Description'
            ]
        ];
        
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $raceModel = new RaceModel();
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];
        
        $raceModel->insert($data);
        return $this->respondCreated(['message' => 'Created Successfully']);
      
      
    }

    public function getId($id = null)
    {
        if (!$id) {
            return $this->fail("race_id is required", 400);
        }

        $raceModel = new RaceModel();
        
        $raceModel = $raceModel->find($id);
        if (!$raceModel) {
            return $this->failNotFound("race_id not found");
        }

        return $this->respond($raceModel);
    }

    public function update($id = null)
    {
        $raceModel = new RaceModel();
       
        try {
            $json = $this->request->getJSON(true); 
        } catch (\Exception $e) {
            return $this->fail("Invalid JSON input: " . $e->getMessage(), 400);
        }

     
        if (!$json || !isset($json['race_id'])) {
            return $this->fail("race_id is required", 400);
        }

        $existing = $raceModel->find($json['race_id']);
        if (!$existing) {
            return $this->failNotFound("Race not found");
        }

        $data = [
            'name' => $json['name'] ?? $existing['name'],
            'description' => $json['description'] ?? $existing['description']
        ];

        
        $raceModel->update($json['race_id'], $data);

        return $this->respondUpdated(['message' => 'Updated successfully']);
    }
    

    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("race_id is required", 400);
        }
    
        $raceModel = new RaceModel();
    
        $existing = $raceModel->find($id);
        if (!$existing) {
            return $this->failNotFound("Race type not found");
        }
    
        $raceModel->delete($id);
    
        return $this->respondDeleted(['message' => 'Raza eliminado correctamente']);
    }


}