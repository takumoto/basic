<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\BookingSearch;

$this->title = 'Бронирования';
?>
<div class="booking-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'room_id',
                'value' => 'room.room_name',
            ],
            'user_name',
            [
                'attribute' => 'start_time',
                'value' => function($model) {
                    return Yii::$app->formatter->asDatetime($model->start_time);
                },
            ],
            [
                'attribute' => 'end_time',
                'value' => function($model) {
                    return Yii::$app->formatter->asDatetime($model->end_time);
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}', // Оставляем только удаление
            ],
        ],
    ]); ?>
</div>