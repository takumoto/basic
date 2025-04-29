<?php
use yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$this->title = "Доступные комнаты";
?>

<h1><?= $this->title ?></h1>

<ul>
<?php foreach ($rooms as $room): ?>
    <p><a class="btn btn-outline-secondary"
            href="<?= Yii::$app->user->isGuest ?
            "" : Url::to(['booking/create', 'room_id' => $room->id]) ?>"
        >
            комната № 
            <?= Html::encode("{$room->room_number} ({$room->room_name})") ?> 
            вместимость:
            <?= $room->capacity ?>
            &raquo;
    </a></p>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>