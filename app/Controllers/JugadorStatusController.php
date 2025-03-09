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

    

    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("Jugador_status_id is required", 400);
        }
    
        $jugadorstatusModel = new JugadorStatusModel();
    
        $existing = $jugadorstatusModel->find($id);
        if (!$existing) {
            return $this->failNotFound("Race type not found");
        }
    
        $jugadorstatusModel->delete($id);
    
        return $this->respondDeleted(['message' => 'Raza eliminado correctamente']);
    }
 
}