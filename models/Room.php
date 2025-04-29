<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

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
            [['room_name', 'capacity'], 'required'],
            ['room_name', 'string', 'max' => 50],
            ['capacity', 'integer']
        ];
    }
}