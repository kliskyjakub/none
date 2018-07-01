<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\widgets\DetailView;
echo '<h1>WebSupport API</h1><h2>User Data</h2>';

echo DetailView::widget([
    'model' => $userData,
    'attributes' => [
        'id',
        'login',
        'parentID',
        'active',
        'createTime',
        'group',
        'email',
        'phone',
        'sknicHandle',
        'contactPerson',
        'resellerToken',
        'credit',
        'verifyUrl'
    ]]);

echo '<h4>Billing</h4>';
$billingDataProvider = new ArrayDataProvider([
    'allModels' => $userData['billing'],
]);
echo GridView::widget([
    'dataProvider' => $billingDataProvider,
]);

echo '<h4>Market</h4>';
echo DetailView::widget([
    'model' => $userData['market']
]);

echo '<h2>Service Data</h2>';

$serviceDataProvider = new ArrayDataProvider([
    'allModels' => $serviceData,
]);
echo GridView::widget([
    'dataProvider' => $serviceDataProvider,
]);

echo '<h2>Invoice Data</h2>';

$invoiceDataProvider = new ArrayDataProvider([
    'allModels' => $invoiceData,
]);
echo GridView::widget([
    'dataProvider' => $invoiceDataProvider,
]);