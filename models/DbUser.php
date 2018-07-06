<?php

namespace app\models;

use yii\db\ActiveRecord;

class DbUser extends ActiveRecord
{
    public static function tableName()
    {
        return '{{users}}';
    }
}
