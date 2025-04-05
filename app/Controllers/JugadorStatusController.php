<?php

namespace App\Controllers;

use App\Models\JugadorStatusModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;


class JugadorStatusController extends ResourceController
{

    use ResponseTrait;

    public function index()
    {
        $jugadorstatusModel = new JugadorStatusModel();
        
        $jugadorstatus = $jugadorstatusModel->findAll();
        return $this->respond($jugadorstatus);
    }

    public function create()
    {
        $rules = [
            'Jugador_status_name' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[jugador_status.Jugador_status_name]',
                'label' => 'Jugador Name'
            ],
            'Jugador_status_description' => [
                'rules' => 'permit_empty|max_length[255]',
                'label' => 'Description'
            ]
        ];
        
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $jugadorstatusModel = new JugadorStatusModel();
        $data = [
            'Jugador_status_name'        => $this->request->getPost('Jugador_status_name'),
            'Jugador_status_description' => $this->request->getPost('Jugador_status_description'),
          
        ];
        
        $jugadorstatusModel->insert($data);
        return $this->respondCreated(['message' => 'Created Successfully']);
      
      
    }

    public function update($id = null)
    {
        $jugadorstatusModel = new JugadorStatusModel();
       
        try {
            $json = $this->request->getJSON(true); 
        } catch (\Exception $e) {
            return $this->fail("Invalid JSON input: " . $e->getMessage(), 400);
        }

     
        if (!$json || !isset($json['Jugador_status_id'])) {
            return $this->fail("Jugador_status_id is required", 400);
        }

        $existing = $jugadorstatusModel->find($json['Jugador_status_id']);
        if (!$existing) {
            return $this->failNotFound("Jugador_status type not found");
        }

        $data = [
            'Jugador_status_name' => $json['Jugador_status_name'] ?? $existing['Jugador_status_name'],
            'Jugador_status_description' => $json['Jugador_status_description'] ?? $existing['Jugador_status_description'],
            'update_at' => date('Y-m-d H:i:s')
        ];

        
        $jugadorstatusModel->update($json['Jugador_status_id'], $data);

        return $this->respondUpdated(['message' => 'Updated successfully']);
    }

    public function getId($id = null)
    {
        if (!$id) {
            return $this->fail("Jugador_status_id is required", 400);
        }

        $jugadorstatusModel = new JugadorStatusModel();
        
        $jugadorstatusModel = $jugadorstatusModel->find($id);
        if (!$jugadorstatusModel) {
            return $this->failNotFound("Jugador not found");
        }

        return $this->respond($jugadorstatusModel);
    }

    

    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("Jugador_status_id is required", 400);
        }
    
        $jugadorstatusModel = new JugadorStatusModel();
    
        $existing = $jugadorstatusModel->find($id);
        if (!$existing) {
            return $this->failNotFound("Jugador_Status type not found");
        }
    
        $jugadorstatusModel->delete($id);
    
        return $this->respondDeleted(['message' => 'Jugador_Status eliminado correctamente']);
    }
 
}