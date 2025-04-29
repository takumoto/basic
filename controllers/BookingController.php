<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use app\models\Booking;
use yii\db\ActiveQuery;

class BookingController extends Controller
{
    public function actionIndex()
    {
        $query = Booking::find();

        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query->count()
        ]);

        $bookings = $query
            ->orderBy('room_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'bookings' => $bookings,
            'pagination' => $pagination
        ]);
    }

    public function actionDelete($room_id) {
        $model = Booking::findOne(['room_id' => $room_id]);
        if ($model === null) {
            throw new NotFoundHttpException('Запись не найдена.');
        }
        // TODO proper users and roles
        $permission = false;
        if (Yii::$app->user->identity->username == "admin" ||
            $model->user_name === Yii::$app->user->identity->username) {
            $permission = true;
        }
        if ( $permission) {
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', 'Бронирование успешно удалено');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при удалении бронирования');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Нет доступа к этой записи');
        }
        return $this->actionIndex();
    }

}