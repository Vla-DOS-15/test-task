<?php
namespace app\models;

use yii\base\Model;

class ReportFilter extends Model
{
    public $start_date;
    public $end_date;

    public function rules()
    {
        return [
            [['start_date', 'end_date'], 'safe'],
            [['start_date', 'end_date'], 'date', 'format' => 'php:Y-m-d'],
            [['start_date', 'end_date'], 'validateDateRange']
        ];
    }

    public function validateDateRange($attribute, $params)
    {
        if (empty($this->start_date) || empty($this->end_date)) {
            return;
        }

        if (strtotime($this->start_date) > strtotime($this->end_date)) {
            $this->addError($attribute, 'Дата початку не може бути пізнішою за дату завершення.');
        }
    }
}
