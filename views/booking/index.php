<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = "Забронированые комнаты";
?>

<h1><?= $this->title ?></h1>

<ul>
<?php foreach ($bookings as $booking): ?>
    <li>
        # <?= Html::encode("{$booking->room_id} ({$booking->user_name})") ?>:
        cap <?= $booking->room->capacity ?>
        name <?= $booking->room->room_name ?>
        time <?= $booking->start_time ?>
        <?= $booking->end_time ?>
        <?php if (Yii::$app->user->identity->username == "admin"): // TODO proper users and roles ?>
            <a class="btn btn-outline-secondary" 
                href="<?= \yii\helpers\Url::to(['booking/delete', 'room_id' => $booking->room_id]) ?>"
            >
                Удалить запись
            </a>
        <?php endif ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>