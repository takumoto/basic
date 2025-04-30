<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Room extends ActiveRecord
{
    public static function tableName()
    {
        return 'room';
    }

    public function getBookings()
    {
        return $this->hasMany(Booking::class, ['room_id' => 'id']);
    }
    public function rules()
    {
        return [
            [['room_number', 'room_name', 'capacity'], 'required'],
            ['room_name', 'string', 'max' => 50],
            ['room_number', 'integer'],
            ['capacity', 'integer']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_number' => 'Номер комнаты',
            'room_name' => 'Название комнаты',
            'capacity' => 'Вместимость',
        ];
    }
    public static function getRoomsList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'room_name');
    }
}