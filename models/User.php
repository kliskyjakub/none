<?php

namespace app\models;

use GuzzleHttp\Client;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        // return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        // return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($username,$password)
    {
        $client = new Client(['base_uri' => 'https://rest.websupport.sk/']);
        try {
            json_decode($client->request('GET','v1/user/', [
                'auth' => [$username,$password]
            ])->getBody()->getContents(), true);
            return true;
        } catch (\Exception $exception) {
            var_dump('OOPs');
        }
    }

    /**
     * Creates user using credentials from API
     */
    public function createUser($username,$password)
    {
        $this->id = json_encode($username);
        $this->username = $username;
        $this->password = $password;
        $this->authKey = rand();
        $this->accessToken = rand();
        return $this;
    }
}
