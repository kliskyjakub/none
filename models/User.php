<?php

namespace app\models;

use GuzzleHttp\Client;
use Yii;

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
        if (empty($id)) {
            return null;
        }
  
        $decodedId = base64_decode($id);
        if ($decodedId === false) {
            throw new InvalidCallException('ID is invalid');
        }
  
        $ids = explode('{', $decodedId);
        if ($ids === false) {
            throw new InvalidCallException('ID is malformated');
        }
  
        $user = new User();
        $user->id = $id;
        $user->username = $ids[0];
        $user->password = $ids[1];
        $user->authKey = $ids[2];
        $user->accessToken = $ids[3];
        return $user;
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
        return base64_encode($this->username.'{'.$this->password.'{'.$this->authKey.'{'.$this->accessToken);
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
            return 'Something went wrong. Try again.';
        }
    }

    /**
     * Creates user using credentials from API
     */
    public function createUser($username,$password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->authKey = Yii::$app->security->generateRandomString();
        $this->accessToken = Yii::$app->security->generateRandomString();
        $this->id = base64_encode($username.'{'.$password.'{'.$this->authKey.'{'.$this->accessToken);
        return $this;
    }
}
