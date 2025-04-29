<?php

namespace app\controllers;

use Yii;
use app\models\Room;
use app\models\Booking;
use yii\web\Controller;

class RoomController extends Controller
{
    public function actionIndex()
    {
        $rooms = Room::find()->orderBy('id')->all();
        return $this->render('index', ['rooms' => $rooms]);
    }

    public function actionBooking($room_id)
    {
        $rooms = Room::find()->orderBy('id')->all();

        $selectedRoomId = $room_id;

        $newBooking = new Booking();
        $newBooking->room_id = $selectedRoomId;
        $newBooking->user_name = Yii::$app->user->identity->username;

        if ($newBooking->load(Yii::$app->request->post())){
            if (Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error', 'Нет доступа');
            } else {
                $newId = Booking::find()->max('id') + 1;
                $newBooking->id = $newId;
                $startTime = new \DateTime($newBooking->start_time);
                $newBooking->start_time = $startTime->format('Y-m-d H:i:s');
                $endTime = ($startTime->add(new \DateInterval('PT1H')))->format('Y-m-d H:i:s'); // TODO: combine time to add
                $newBooking->end_time = $endTime;
                if ($newBooking->save()) {
                    Yii::$app->session->setFlash('success', 'Комната успешно забронирована!');
                    return $this->refresh();
                }
            }
        }

        return $this->render('index', ['rooms' => $rooms,
            'selectedRoomId' => $selectedRoomId,
            'newBooking' => $newBooking]);
    }

}