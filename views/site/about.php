<?php
/** @var yii\web\View $this **/
/** @var app\models\MeetingRoom $meetingRooms**/

$this->title = 'Бронирование переговорок';
?>

<h1><?= $this->title ?></h1>

<table>
    <tr>
        <th>Название</th>
        <th>Вместимость</th>
        <th>Действия</th>
    </tr>
    
<?php foreach ($meetingRooms as $room): ?>
<tr>
    <td><?= $room->name ?></td>
    <td><?= $room->capacity ?></td>
    <td><a href="<?= \yii\helpers\Url::to(['booking/book', 'id' => $room->id]) ?>">Забронировать</a></td>
</tr>
<?php endforeach; ?>
</table>
