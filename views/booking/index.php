<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

$this->title = 'Доступные комнаты';
?>

<div class="booking-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
    'dataProvider' => new ArrayDataProvider(['allModels' => $rooms]),
    'itemView' => function ($model) {
        $createUrl = Yii::$app->user->isGuest ? "" : Url::to(['booking/create', 'room_id' => $model->id]);
        return "<a class=\"btn btn-outline-primary w-50\" href={$createUrl}>".
        "комната № {$model->room_number} - {$model->room_name} (вместимость: {$model->capacity})</a>";
    },
    ]); ?>
</div>