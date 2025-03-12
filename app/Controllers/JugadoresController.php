<?php

namespace App\Controllers;

use App\Models\JugadorModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;


class JugadoresController extends ResourceController
{

    use ResponseTrait;

    public function index()
    {
        $jugadorModel = new JugadorModel();
        
        $jugadorModels = $jugadorModel->findAll();
        return $this->respond($jugadorModels);
    }

    public function create()
    {
        $rules = [
            'jugador_name' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[jugador_status.Jugador_status_name]',
                'label' => 'Jugador Name'
            ],
            'jugador_password' => [
                'rules' => 'permit_empty|max_length[255]',
                'label' => 'Description'
            ],
            'confirm_password' => [
                'rules' => 'matches[jugador_password]',
                'label' => 'Confirm Password'
            ]
        ];
        
        if ($this->validate($rules)) {
            $jugadorModel = new JugadorModel();
            $data = [
                'jugador_name' => $this->request->getVar('jugador_name'),
                'jugador_password' => password_hash($this->request->getVar('jugador_password'), PASSWORD_DEFAULT),
                'roles_fk'        => $this->request->getPost('roles_fk'),
                'jugador_status_fk' => $this->request->getPost('jugador_status_fk'),
            ];
            $jugadorModel->save($data);
            return $this->respond(['message' => 'Registered Successfully'], 200);
        } else {
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 409);
        }
      
    }

    public function update($id = null)
    {
        $jugadorModel = new JugadorModel();
       
        try {
            $json = $this->request->getJSON(true); 
        } catch (\Exception $e) {
            return $this->fail("Invalid JSON input: " . $e->getMessage(), 400);
        }

     
        if (!$json || !isset($json['jugador_id'])) {
            return $this->fail("jugador_id is required", 400);
        }

        $existing = $jugadorModel->find($json['jugador_id']);
        if (!$existing) {
            return $this->failNotFound("Jugadores type not found");
        }

        $data = [
            'jugador_name' => $json['jugador_name'] ?? $existing['jugador_name'],
            'jugador_password' => password_hash($this->request->getVar('jugador_password'), PASSWORD_DEFAULT),
            'roles_fk' => $json['roles_fk'] ?? $existing['roles_fk'],
            'jugador_status_fk' => $json['jugador_status_fk'] ?? $existing['jugador_status_fk'],
            'update_at' => date('Y-m-d H:i:s')
        ];

        
        $jugadorModel->update($json['jugador_id'], $data);

        return $this->respondUpdated(['message' => 'Updated successfully']);
    }

    

    public function delete($id = null)
    {
        if (!$id) {
            return $this->fail("jugador_id is required", 400);
        }
    
        $jugadorModel = new JugadorModel();
    
        $existing = $jugadorModel->find($id);
        if (!$existing) {
            return $this->failNotFound("jugador_id type not found");
        }
    
        $jugadorModel->delete($id);
    
        return $this->respondDeleted(['message' => 'jugador_id eliminado correctamente']);
    }
 
}