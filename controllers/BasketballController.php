<?php

namespace app\controllers;

use app\models\Basketball;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class BasketballController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Basketball::find(),
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}