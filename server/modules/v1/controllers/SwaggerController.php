<?php


namespace app\modules\v1\controllers;

use yii\rest\Controller;
use yii;
use yii\web\Response;
use yii\helpers\ArrayHelper;


class SwaggerController extends Controller
{
    
    public function checkAccess($action, $model = null, $params = [])
    {
        if ( !isset($_REQUEST['user_accesstoken']) ) {
            throw new UnauthorizedHttpException(UserController::ACCESS_TOKEN_IS_MISSING);
        }
        
        $userAccessToken = $_REQUEST['user_accesstoken'];
        $currentUser = User::findOne(['user_accesstoken'=>$userAccessToken]);

        if ($currentUser == null ||
            ( ($model != null && $currentUser->user_id != $model->user_id) &&
            $currentUser->user_role != User::MANAGER_USER) 
        )
        {
            throw new ForbiddenHttpException(User::ACCESS_DENIED);
        }
        
        return;
    }

    
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
            ],
        ];
    }

    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }
    
    
    public function actionIndex()
    {
        $swaggerFile = file_get_contents(__DIR__ . '/../swagger.json');
        
        return $swaggerFile;
    }

    
}

