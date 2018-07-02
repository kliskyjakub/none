<?php

namespace app\models;

use yii\db\ActiveRecord;

class Basketball extends ActiveRecord
{
    public static function tableName()
    {
        return '{{box_score}}';
    }
}