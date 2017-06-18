<?php

namespace App\Helpers;

class Collaboration
{
    private $base_url = "https://chat.kadin-collab.com/api/";

    public static function login($client) {
        $json = "";
        try {            
            $response = $client->request('POST', 'v1/login', [
                    'headers' => [
                    ],
                    'json' => ['user' => 'admin', 'password' => '123qweasdzxc']
            ]);
            $json = json_decode($response->getBody(true), true);            
        } catch (RequestException $e) {
            $response = json_decode($e->getResponse()->getBody(true));
            $json = $response;
        }
        return $json;
    }

    public static function listUser($client, $authtoken, $userId) {        
        $json = "";
        try {            
            $response = $client->request('GET', 'v1/users.list', [
                'headers' => [
                    'X-Auth-Token' => $authtoken, 
                    'X-User-Id' => $userId
                ],
                'json' => []
            ]);
            $json = json_decode($response->getBody(true), true);            
        } catch (RequestException $e) {
            $response = json_decode($e->getResponse()->getBody(true));
            $json = $response;
        }
        return $json;
    }

    public static function logout($client, $authtoken, $userId) {
        $success = false;
        try {            
            $response = $client->request('GET', 'v1/logout', [
                'headers' => [
                    'X-Auth-Token' => $authtoken,
                    'X-User-Id' => $userId
                ],
                'json' => []
            ]);
            $json = json_decode($response->getBody(true), true);
            $success = $json['status'];
        } catch (RequestException $e) {
            $success = false;
        }
        return $success;
    }    

    public static function crtAccount($name, $username, $email, $password) {        
        $success = false;
        $_this = new Collaboration;
        $client = new \GuzzleHttp\Client(['base_uri' => $_this->base_url]);
        try {            
            $json = $_this->login($client);
            $authtoken = $json['data']['authToken'];
            $userId = $json['data']['userId'];            

            $userExist = false;
            $lusers = $_this->listUser($client, $authtoken, $userId);
            $users = $lusers['users'];
            foreach ($users as $key => $user) {             
                if ($user['username']==$username) {
                    $userExist = true;
                }
            }

            if (!$userExist) {            
                $response = $client->request('POST', 'v1/users.create', [
                        'headers' => [
                            'X-Auth-Token' => $authtoken, 
                            'X-User-Id' => $userId,
                            'Content-type' => 'application/json'
                        ],
                        'json' => ['name' => $name, 'email' => $email, 'password' => $password, 'username' => $username]
                ]);

                $usercrt = json_decode($response->getBody(true), true);
                // $success = $usercrt['success'];
                $success = $usercrt;
            }

            $_this->logout($client, $authtoken, $userId);
        } catch (RequestException $e) {
            $response = json_decode($e->getResponse()->getBody(true));
            $json = $response;
        }
        return $success;
    }

    public static function updtCAI($name, $email, $username, $ousername) {        
        $success = false;
        $_this = new Collaboration;
        $client = new \GuzzleHttp\Client(['base_uri' => $_this->base_url]);
        try {            
            $json = $_this->login($client);
            $authtoken = $json['data']['authToken'];
            $authId = $json['data']['userId'];            

            $userExist = false;
            $lusers = $_this->listUser($client, $authtoken, $authId);
            $users = $lusers['users'];
            $userId = '';
            foreach ($users as $key => $user) {             
                if ($user['username']==$ousername) {
                    $userExist = true;
                    $userId = $user['_id'];
                }
            }

            if ($userExist) {            
                $response = $client->request('POST', 'v1/user.update', [
                        'headers' => [
                            'X-Auth-Token' => $authtoken, 
                            'X-User-Id' => $authId,
                            'Content-type' => 'application/json'
                        ],                        
                        'json' => ['userId' => $userId, 'data' => ['name' => $name, 'email' => $email, 'username' => $username]]
                ]);

                $usercrt = json_decode($response->getBody(true), true);
                $success = $usercrt['success'];
            }

            $_this->logout($client, $authtoken, $authId);
        } catch (RequestException $e) {
            $response = json_decode($e->getResponse()->getBody(true));
            $json = $response;
        }
        return $success;
    }

    public static function updtCYP($password, $ousername) {        
        $success = false;
        $_this = new Collaboration;
        $client = new \GuzzleHttp\Client(['base_uri' => $_this->base_url]);

        try {            
            $json = $_this->login($client);
            $authtoken = $json['data']['authToken'];
            $authId = $json['data']['userId'];            

            $userExist = false;
            $lusers = $_this->listUser($client, $authtoken, $authId);
            $users = $lusers['users'];
            $userId = '';
            foreach ($users as $key => $user) {             
                if ($user['username']==$ousername) {
                    $userExist = true;
                    $userId = $user['_id'];
                }
            }

            if ($userExist) {            
                $response = $client->request('POST', 'v1/user.update', [
                        'headers' => [
                            'X-Auth-Token' => $authtoken, 
                            'X-User-Id' => $authId,
                            'Content-type' => 'application/json'
                        ],                        
                        'json' => ['userId' => $userId, 'data' => ['password' => $password]]
                ]);

                $usercrt = json_decode($response->getBody(true), true);
                $success = $usercrt['success'];
            }

            $_this->logout($client, $authtoken, $authId);
        } catch (RequestException $e) {
            $response = json_decode($e->getResponse()->getBody(true));
            $json = $response;
        }
        return $success;
    }

    public static function deleteAccount($username) {
        $success = false;
        $_this = new Collaboration;
        $client = new \GuzzleHttp\Client(['base_uri' => $_this->base_url]);

        try {            
            $json = $_this->login($client);
            $authtoken = $json['data']['authToken'];
            $authId = $json['data']['userId'];            

            $userExist = false;
            $lusers = $_this->listUser($client, $authtoken, $authId);
            $users = $lusers['users'];
            $userId = '';
            foreach ($users as $key => $user) {             
                if ($user['username']==$username) {
                    $userExist = true;
                    $userId = $user['_id'];
                }
            }

            if ($userExist) {            
                $response = $client->request('POST', 'v1/users.delete', [
                        'headers' => [
                            'X-Auth-Token' => $authtoken, 
                            'X-User-Id' => $authId,
                            'Content-type' => 'application/json'
                        ],                        
                        'json' => ['userId' => $userId]
                ]);

                $dltjson = json_decode($response->getBody(true), true);
                $success = $dltjson['success'];
            }

            $_this->logout($client, $authtoken, $authId);
        } catch (RequestException $e) {
            $response = json_decode($e->getResponse()->getBody(true));
            $json = $response;
        }
        return $success;
    }

    public static function deleteAccbyEmail($email) {
        $success = false;
        $_this = new Collaboration;
        $client = new \GuzzleHttp\Client(['base_uri' => $_this->base_url]);

        try {
            $json = $_this->login($client);
            $authtoken = $json['data']['authToken'];
            $authId = $json['data']['userId'];

            $userExist = false;
            $lusers = $_this->listUser($client, $authtoken, $authId);
            $users = $lusers['users'];
            $userId = '';            
            foreach ($users as $key => $user) {
                $uemail = $user['emails'][0]['address'];
                if ($uemail==$email) {
                    $userExist = true;
                    $userId = $user['_id'];                    
                } else {
                    $userExist = false;                    
                }
            }

            if ($userExist) {            
                $response = $client->request('POST', 'v1/users.update', [
                        'headers' => [
                            'X-Auth-Token' => $authtoken, 
                            'X-User-Id' => $authId,
                            'Content-type' => 'application/json'
                        ],                        
                        'json' => ['userId' => $userId]
                ]);

                $dltjson = json_decode($response->getBody(true), true);
                $success = $dltjson['success'];
            }

            $_this->logout($client, $authtoken, $authId);
        } catch (RequestException $e) {
            $response = json_decode($e->getResponse()->getBody(true));
            $json = $response;
            $success = $json;            
        }
        return $success;
    }

}
