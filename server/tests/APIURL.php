<?php

class APIURL
{
    protected static function getBaseUrl()
    {
        $baseUrl = \Yii::$app->request->hostInfo . \Yii::$app->request->BaseUrl
            . '/v1/';

        return $baseUrl;
    }


    public static function getUserLabelsUrl()
    {
        return self::getBaseUrl() . 'user/labels';
    }


    public static function getUserUrl()
    {
        return self::getBaseUrl() . 'users';
    }


    public static function getCaloriesUrl($user_id)
    {
        return self::getBaseUrl() . 'calories/user/' . $user_id;
    }
}
