<?php

namespace app\controllers;

use Yii;
use app\models\Booking;
use app\models\BookingSearch;
use app\models\Room;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BookingController extends Controller
{
    public function actionIndex()
    {
        // Maybe move DataProvider here
        $rooms = Room::find()->all();
        return $this->render('index', [
            'rooms' => $rooms,
        ]);
    }
    
    public function actionCreate($room_id)
    {
        $room = Room::find()->where(['id' => $room_id])->one();

        $model = new Booking();
        $model->room_id = $room_id;
        $model->user_name = Yii::$app->user->identity->username;

        if ($model->load(Yii::$app->request->post())) {
            $newId = Booking::find()->max('id') + 1;
            $model->id = $newId;
            // Скорее всего что то криво но преобразую к формату базы данных
            $startTime = (new \DateTime($model->start_time))->format('Y-m-d H:i:s');
            $model->start_time = $startTime;
            $endTime = (new \DateTime($model->end_time))->format('Y-m-d H:i:s');
            $model->end_time = $endTime;
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Бронирование успешно');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'room' => $room
        ]);
    }

    public function actionManage()
    {
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $bookings = Booking::find()->all();
        if (Yii::$app->user->identity->username !== "admin" ){
            $userName = Yii::$app->user->identity->username;
            $bookings = Booking::find()->where(['user_name' => $userName])->all();
        }

        return $this->render('manage', [
            'bookings' => $bookings,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['manage']);
    }

    protected function findModel($id)
    {
        if (($model = Booking::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}