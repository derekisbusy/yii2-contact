<?php

use yii\widgets\DetailView;

$gridColumn = [
    ['attribute' => 'id', 'visible' => false],
    'assigned_to',
    'contact_reason_id',
    'name',
    'email:email',
    'phone',
    'body:ntext',
    'url:ntext',
    'referrer:ntext',
];
echo DetailView::widget([
    'model' => $model,
    'attributes' => $gridColumn
]); 