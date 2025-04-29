<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\validators\DateValidator;

class Booking extends ActiveRecord
{
    public static function tableName()
    {
        return 'booking';
    }

    public function rules()
    {
        return [
            [['room_id', 'user_name', 'start_time', 'end_time'], 'required'],
            [['room_id'], 'integer'],
            [['start_time', 'end_time'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            ['end_time', 'compare', 'compareAttribute' => 'start_time', 'operator' => '>'],
            ['room_id', 'exist', 'targetClass' => Room::class, 'targetAttribute' => 'id'],
            // ['room_id', 'checkAvailability'],
        ];
    }

    public function getRoom()
    {
        return $this->hasOne(Room::class, ['id' => 'room_id']);
    }
   /* public function checkAvailability($attribute, $params)
    {
        $exists = self::find()
            ->where(['room_id' => $this->room_id])
            ->andWhere(['or',
                ['and', ['<', 'start_time', $this->end_time], ['>', 'end_time', $this->start_time]],
                ['and', ['<=', 'start_time', $this->start_time], ['>=', 'end_time', $this->end_time]]
            ])
            ->exists();

        if ($exists) {
            $this->addError($attribute, 'This room is already booked for the selected time period.');
        }
    }*/
/*
    public function getRoom()
    {
        return $this->hasOne(Room::class, ['id' => 'room_id']);
    }
    */

}