<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT; 

class UserController {

    public function login(Request $request, Response $response, array $args) {
        $data = $request->getParsedBody();
        var_dump($data);
        $login = $data['login'] ?? "";
        $password = $data['password'] ?? "";

        if(!$login == "bapt" || !$password == "toto") {
            $response->getBody()->write(json_encode([
                "success" => false,
            ]));
            return $response->withHeader("Content-Type", "application/json");
        }

        $issuedAt = time();

        $payload = [
            "user" => [
                "id" => 1,
            ],
            "iat" => $issuedAt,
            "exp" => $issuedAt + 60,
        ];

        $token_jwt = JWT::encode($payload, $_ENV['JWT_SECRET'], "HS256");

        $response->getBody()->write(json_encode([
            "success" => true,
        ]));
        
        return $response
        ->withHeader("Authorization", $token_jwt)
        ->withHeader("Content-Type", "application/json");
    }

    public function register(Request $request, Response $response, array $args) {
        $data = $request->getParsedBody();
        $userData = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'adress' => $data['adress'],
            'zipcode' => $data['zipcode'],
            'city' => $data['city'],
            'gender' => $data['gender'],
            'mail' => $data['mail'],
            'password' => $data['password'],
            'login' => $data['login'],
            'country' => $data['country'],
            'phone' => $data['phone'],
        ];
        $response->getBody()->write(json_encode($userData));
        return $response->withHeader("Content-Type", "application/json");
    }
}