<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Ws;
use Yii;
use app\models\WsForm;

class WsController extends Controller
{
    public function actionIndex()
    {
      $wsForm = new WsForm();
      if ($wsForm->load(Yii::$app->request->post()) && $wsForm->validate()) {
        $api = new Ws($wsForm->username,$wsForm->password);
        return $this->render('index',
          [
            'userData'=> $api->apiUserData($api->id),
            'serviceData'=> $api->apiServiceData($api->id),
            'invoiceData'=> $api->apiinvoiceData($api->id),
          ]);
      } else {
          return $this->render('login',['wsForm'=>$wsForm]);
      }
    }
}
