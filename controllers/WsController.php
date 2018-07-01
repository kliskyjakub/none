<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Ws;
use Yii;

class WsController extends Controller
{
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            $this->redirect('/site/login');
        } else {
            $api = new Ws(Yii::$app->user->identity->username,Yii::$app->user->identity->password);
            return $this->render('index',
                [
                    'userData'=> $api->apiUserData($api->id),
                    'serviceData'=> $api->apiServiceData($api->id),
                    'invoiceData'=> $api->apiinvoiceData($api->id),
                ]);
        }
    }
}