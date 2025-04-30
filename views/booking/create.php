<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Room;
use yii\jui\DateTimePicker;

$this->title = "Создать бронирование";
$roomDescritpion = "Комната: ". $room->room_name ." №".$room->room_number;
?>

<h1><?= Html::encode($this->title) ?></h1>
<div class="booking-form">
    <h2><?= Html::encode($roomDescritpion) ?></h2>
    <?php 
    $form = ActiveForm::begin();
    ?>
    
    <?= $form->field($model, 'user_name')->textInput(['disabled' => true]) ?>
    <?= $form->field($model, 'room_id')->textInput(['disabled' => true])->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'start_time')->input('datetime-local') ?>
    <?= $form->field($model, 'end_time')->input('datetime-local') ?>
    
    <div class="form-group">
        <?= Html::submitButton('Забронировать', ['class' => 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>