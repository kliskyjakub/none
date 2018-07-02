<?php

namespace app\models;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Ws
{
    protected $client;
    private $username;
    private $password;
    public $id;

    public function __construct($username,$password)
    {
        $this->client = new Client(['base_uri' => 'https://rest.websupport.sk/']);
        $this->username = $username;
        $this->password = $password;
        $this->id = json_decode($this->client->request('GET','v1/user/', [
            'auth' => [$this->username,$this->password]
        ])->getBody()->getContents(), true)['items'][0]['id'];
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
            ])->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return 'Something went wrong. Try again.';
        }
    }
    public function apiServiceData($id){
        try {
            return json_decode($this->client->request('GET','v1/user/'.$id.'/service', [
                'auth' => [$this->username,$this->password]
            ])->getBody()->getContents(), true)['items'];
        } catch (\Exception $exception) {
            return 'Something went wrong. Try again.';
        }
    }
    public function apiInvoiceData($id){
        try {
            return json_decode($this->client->request('GET','v1/user/'.$id.'/invoice', [
                'auth' => [$this->username,$this->password]
            ])->getBody()->getContents(), true)['items'];
        } catch (\Exception $exception) {
            return 'Something went wrong. Try again.';
        }
    }
}