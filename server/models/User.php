<?php

namespace app\models;

use Yii;
use yii\web\UnauthorizedHttpException;
use yii\web\UnprocessableEntityHttpException;


require_once(__DIR__ . '/../vendor/SimpleActiveRecord/src/SimpleActiveRecord.php');


class User extends \SimpleActiveRecord
{
    const USER_EMAIL_DOESNOT_EXIST = 'User email does not exist.';
    const WRONG_PASSWORD = 'Wrong password';
    const ACCESS_DENIED = "Access denied. You don't have permissions!";
    const REGULAR_USER = 'user';
    const MANAGER_USER = 'manager';
    const DAILY_EXPECTED_CALORIES = 2500;
    
    
    public function rules()
    {
        $rules = parent::rules();

        return $rules;
    }

 
    public function signin($password)
    {
        if ( empty($this->user_firstname) && empty($this->user_role) )
        {
            $user = $this->loginExistingUser($password);
        } else {
            $user = $this->createNewUser($password);
        }
        
        return $user;
    }
    
    
    protected function loginExistingUser($password)
    {
        $user = User::findOne( ['user_email'=>$this->user_email] );
        
        if (empty($user)) {
            throw new UnauthorizedHttpException(
                json_encode([self::USER_EMAIL_DOESNOT_EXIST]) );
        }
        
        if (!Yii::$app->getSecurity()->validatePassword($password, $user->user_passwordhash)) {
            throw new UnauthorizedHttpException( json_encode([self::WRONG_PASSWORD]) );
        }

        return $user;
    }


    protected function createNewUser($password)
    {
        $this->fillPasswordHash($password);
        $this->createAccessToken();

        $result = $this->save();
        
        if (!$result) {
            throw new UnprocessableEntityHttpException( json_encode($this->getFirstErrors()) );
        }

        return $this;
    }
    
    
    protected function fillPasswordHash($password)
    {
        $this->user_passwordhash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    
    protected function createAccessToken()
    {
        $this->user_accesstoken = Yii::$app->getSecurity()->generateRandomString();
    }


}
