<?php

namespace app\models;

use Yii;
use yii\base\Model;
use GuzzleHttp\Client;

/**
 * WsForm is the model behind the ws form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class WsForm extends Model
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
      try {
          $client = new Client(['base_uri' => 'https://rest.websupport.sk/']);
          return json_decode($client->request('GET','v1/user/', [
              'auth' => [$this->username,$this->password]
          ])->getBody()->getContents(), true);
      } catch (\Exception $exception) {
          $this->addError($attribute, 'Incorrect username or password.');
      }
    }
}
