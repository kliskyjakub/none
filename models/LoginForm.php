<?php

namespace app\models;

use Yii;
use yii\base\Model;
use GuzzleHttp\Client;
use app\models\User;

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
        $user = new User;
        if($user->validatePassword($this->username,$this->password) !== true) {
            $this->addError($attribute, 'Incorrect username or password.');
        } else {
            return true;
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = new User();
            return Yii::$app->user->login($user->createUser($this->username,$this->password), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
}
