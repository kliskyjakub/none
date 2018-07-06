<?php

namespace app\models;

use GuzzleHttp\Client;
use Yii;
use app\models\DbUser;

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
        $dbUser = DbUser::find()->where(['id'=>$id])->one();
        if (empty($dbUser)) {
            return null;
        }
        return new self([
          'id' => $dbUser->id,
          'username' => $dbUser->username,
          'password' => $dbUser->password
        ]);
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
      if (empty($username)) {
          return null;
      }
      $dbUser = DbUser::find()->where(['username'=>$username])->one();
      if (empty($dbUser)) {
          return null;
      }
      return new self([
        'id' => $dbUser->id,
        'username' => $dbUser->username,
        'password' => $dbUser->password
      ]);
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
      $dbUser = self::findByUsername($username);
      if (empty($dbUser)) {
        //User does not exist
        return false;
      }
      if (Yii::$app->getSecurity()->validatePassword($password, $dbUser->password)) {
        // all good, logging user in
        return true;
      } else {
        // wrong password
        return false;
      }
    }
}
