<?php
/**
 *
 */

namespace app\models;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Ws
{
    protected $client;
    private $username;
    private $password;

    public function __construct($username,$password)
    {
        $this->client = new Client(['base_uri' => 'https://rest.websupport.sk/']);
        $this->username = $username;
        $this->password = $password;
    }

    public function apiUser(){
        try {
            return json_decode($this->client->request('GET','v1/user/', [
                'auth' => [$this->username,$this->password]
            ])->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return 'Something went wrong. Try again.';
        }
    }

    public function apiUserData($id){
        try {
            return json_decode($this->client->request('GET','v1/user/'.$id, [
                'auth' => [$this->username,$this->password]
            ])->getBody()->getContents());
        } catch (\Exception $exception) {
            return 'Something went wrong. Try again.';
        }
    }
}