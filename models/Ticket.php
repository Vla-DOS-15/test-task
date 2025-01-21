<?php
namespace app\models;

use yii\db\ActiveRecord;

class Ticket extends ActiveRecord
{
    public static function tableName()
    {
        return 'tickets';
    }

    public function rules()
    {
        return [
            [['agent_id', 'category_id', 'status', 'created_at'], 'required'],
            [['agent_id', 'category_id'], 'integer'],
            [['status'], 'in', 'range' => ['Нова', 'В роботі', 'Вирішена']],
            [['description'], 'string'],
            [['created_at', 'resolved_at'], 'safe'],
        ];
    }

    public function getAgent()
    {
        return $this->hasOne(Agent::class, ['id' => 'agent_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
