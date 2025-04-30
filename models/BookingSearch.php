<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Booking;

class BookingSearch extends Booking
{
    public function rules()
    {
        return [
            [['id', 'room_id'], 'integer'],
            [['user_name', 'start_time', 'end_time'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Booking::find()->joinWith('room');
        if (Yii::$app->user->identity->username !== "admin" ){
            $userName = Yii::$app->user->identity->username;
            $query = $query->where(['user_name' => $userName]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'user_name',
                    'start_time',
                    'end_time',
                    'room_id' => [
                        'asc' => ['room.room_name' => SORT_ASC],
                        'desc' => ['room.room_name' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'room_id' => $this->room_id,
        ]);

        $query->andFilterWhere(['ilike', 'user_name', $this->user_name]);

        if ($this->start_time) {
            $query->andFilterWhere(['>=', 'start_time', strtotime($this->start_time)]);
        }

        if ($this->end_time) {
            $query->andFilterWhere(['<=', 'end_time', strtotime($this->end_time)]);
        }

        return $dataProvider;
    }
}