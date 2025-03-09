<?php

namespace App\Controllers;

use App\Controllers\BaseControllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Firebase\JWT\JWT;


require '../vendor/autoload.php'; 


class Login extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

         $user = $userModel->where('email', $email)->first();

        if (is_null($user)) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }

         $pwd_verify = password_verify($password, $user['password']);

         if (!$pwd_verify) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }

         $key = getenv('JWT_SECRET');
         $iat = time(); // current timestamp value
         $exp = $iat + 3600; // token expiration (1 hour)

        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, // Time the JWT was issued
            "exp" => $exp, // Expiration time
            "email" => $user['email'],
        );

         $token = JWT::encode($payload, $key, 'HS256');

        $response = [
            'message' => 'Login Successful',
            'token' => $token
        ];

        return $this->respond($response, 200);
    }
}
