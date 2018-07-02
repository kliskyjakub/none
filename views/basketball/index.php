<?php

use yii\grid\GridView;

echo '<h1>Basketball Match Box Score</h1>This basketball match is not real. Data are fictional to demonstrate how to work with DB.<br/><br/><br/>';

//$dataProvider = new ActiveDataProvider([
//    'query' => $data,
//]);
//

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name','position','kit_number','team','started','played','minutes','points','rebounds','assists','steals','blocks','turnovers','fouls','dunks',
        [
            'class' => \yii\grid\ActionColumn::class
        ]
    ]
]);