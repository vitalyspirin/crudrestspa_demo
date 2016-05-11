<?php

namespace app\models;

require_once(__DIR__ . '/../vendor/SimpleActiveRecord/src/SimpleActiveRecord.php');


class Calories extends \SimpleActiveRecord
{
    
    public function attributeLabels()
    {
        return [
            'calories_id' => 'Calories ID',
            'calories_datetime' => 'Date and time',
            'calories_text' => 'Description',
            'calories_number' => 'Number of Calories',
            'user_id' => 'User ID',
        ];
    }

}

