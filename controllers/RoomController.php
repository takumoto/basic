<?php

namespace app\controllers;

use app\models\Room;
use yii\data\Pagination;
use yii\web\Controller;

class RoomController extends Controller
{
    public function actionIndex()
    {
        $query = Room::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $rooms = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'rooms' => $rooms,
            'pagination' => $pagination
        ]);
    }
}