<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\DbUser;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
    public $username;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            [['username'], 'validateIdentity'],
        ];
    }

    /**
     * Check if the username is unoque in the database
     * @return bool whether the username is unique
     */
    public function validateIdentity($attribute, $params)
    {
      if(User::findByUsername($this->username)) {
          $this->addError($attribute, 'Username already taken');
      } else {
          return true;
      }
    }

    /**
     * Signs up a user using the provided username and password.
     * @return bool whether the user is signed up successfully
     */
    public function signup()
    {
        if ($this->validate()) {
          $user = User::findByUsername($this->username);
          if (empty($user)) {
            // Username is unique. Sign up successful
            $dbUser = new DbUser([
              'username' => $this->username,
              'password' => Yii::$app->getSecurity()->generatePasswordHash($this->password)
            ]);
            $dbUser->save();
            return true;
          }
          return false;
        }
        return false;
    }
}
