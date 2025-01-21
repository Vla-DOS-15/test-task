<?php

namespace app\models;

use yii\db\ActiveRecord;

class Agent extends ActiveRecord
{
    public static function tableName()
    {
        return 'agents';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }
}
