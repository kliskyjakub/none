<?php

namespace app\models;

use Yii;
use yii\base\Model;
use GuzzleHttp\Client;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // username password is validated by validatePassword()
            [['username','password'], 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        $client = new Client(['base_uri' => 'https://rest.websupport.sk/']);
        try {
            json_decode($client->request('GET','v1/user/', [
                'auth' => [$this->username,$this->password]
            ])->getBody()->getContents(), true);
            return true;
        } catch (\Exception $exception) {
            $this->addError($attribute, 'Incorrect username or password.');
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->createUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Creates user using credentials from API
     */
    public function createUser()
    {
        $user = new User();
        $user->id = 1;
        $user->username = $this->username;
        $user->password = $this->password;
        $user->authKey = json_encode($this->username.'.'.$this->password);
        $user->accessToken = json_encode($this->username.'.'.$this->password);
        return $user;
    }
}
