<?php

use yii\data\ArrayDataProvider;

echo '<h1>WebSupport API</h1><h2>User Data</h2>';

foreach ($userData as $user_key => $user_value) {
    print('<b>' . $user_key . '</b><br/>');
    var_dump($user_value);
    echo '<br/><br/>';
}

echo '<h2>Service Data</h2>';

foreach ($serviceData as $service_key => $service_value) {
    print('<h3>' . $service_key . '</h3>');
    foreach ($service_value as $service_value_key => $service_value_value) {
        print('<b>' . $service_value_key . '</b><br/>');
        var_dump($service_value_value);
        echo '<br/><br/>';
    }
    echo '<br/><br/>';
}

echo '<h2>Invoice Data</h2>';

foreach ($invoiceData as $invoice_key => $invoice_value) {
    print('<h3>' . $invoice_key . '</h3>');
    foreach ($invoice_value as $invoice_value_key => $invoice_value_value) {
        print('<b>' . $invoice_value_key . '</b><br/>');
        var_dump($invoice_value_value);
        echo '<br/><br/>';
    }
    echo '<br/><br/>';
}