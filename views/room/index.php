<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = "Доступные комнаты";
?>

<h1><?= $this->title ?></h1>

<div class="row">
    <div class="col-md-3">
        <ul>
        <?php foreach ($rooms as $room): ?>
            <p><a class="btn btn-outline-secondary"
                    href="<?= Url::to(['room/booking', 'room_id' => $room->id]) ?>">
                    комната № 
                    <?= Html::encode("{$room->room_number} ({$room->room_name})") ?> 
                    вместимость:
                    <?= $room->capacity ?>
                    &raquo;
            </a></p>
        <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-9">
        <?php if (isset($newBooking)): ?>

            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($newBooking, 'user_name')->textInput(['disabled' => true]) ?>
            <?= $form->field($newBooking, 'room_id')->textInput(['disabled' => true]) ?>
            <?php $newBooking->start_time = '2025-05-11 11:00:00' ?>
            <?= $form->field($newBooking, 'start_time') ?>
            <button type="submit" class="btn btn-primary">Бронь</button>
            <?php ActiveForm::end(); ?>

        <?php endif ?>
    </div>
</div>
