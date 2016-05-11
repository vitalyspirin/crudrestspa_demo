<?php


namespace app\modules\v1\controllers;

use app\models\User;
use yii\rest\ActiveController;
use yii;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\UnprocessableEntityHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\UnauthorizedHttpException;
use yii\web\BadRequestHttpException;


class UserController extends ActiveController
{
    const ACCESS_TOKEN_IS_MISSING = 'Access token must be specified.';
    const ACCESS_TOKEN_IS_INVALID = 'Access token is invalid.';
    
    public $modelClass = 'app\models\User';

    
    public function checkAccess($action, $model = null, $params = [])
    {
        if ( !isset($_REQUEST['user_accesstoken']) ) {
            throw new UnauthorizedHttpException(UserController::ACCESS_TOKEN_IS_MISSING);
        }
        
        $userAccessToken = $_REQUEST['user_accesstoken'];
        $currentUser = User::findOne(['user_accesstoken'=>$userAccessToken]);

        if ($currentUser == null) {
            throw new UnauthorizedHttpException(UserController::ACCESS_TOKEN_IS_INVALID);
        }

        if  ( 
            ($model == null && $currentUser->user_role != User::MANAGER_USER) || 
            ( $model != null && $currentUser->user_id != $model->user_id &&
                $currentUser->user_role != User::MANAGER_USER)
        )
        {
            throw new ForbiddenHttpException(User::ACCESS_DENIED);
        }
        
        return;
    }

    
    public function behaviors()
    {
      return ArrayHelper::merge(parent::behaviors(), [
          [
              'class' => 'yii\filters\ContentNegotiator',
              //'only' => ['view', 'index'],  // in a controller
              // if in a module, use the following IDs for user actions
              // 'only' => ['user/view', 'user/index']
              'formats' => [
                  'application/json' => Response::FORMAT_JSON,
              ],
          ],
      ]);
    }
    
    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }
    
    
    public function actionCreate()
    {
        $user = new User();

        $params = Yii::$app->request->post();

        $user->setAttributes($params);
        if (!isset($params['user_password'])) {
            if ( !isset($params['user_firstname']) ){
                throw new BadRequestHttpException("'user_firstname' is not defined");
            } else {
                $params['user_password'] = $params['user_firstname'];
            }
        }
        $user = $user->signin( $params['user_password'] );

        $userAttributeList = $user->getAttributes();
        unset($userAttributeList['user_passwordhash']);

        return $userAttributeList;
    }


    public function actionLabels()
    {
        $user = new User();
        $userLabelList = $user->attributeLabels();

        return $userLabelList;
    }


    public function actionRoles()
    {
        $user = new User();
        $userRoleList = $user->getEnumValues()['user_role'];

        return $userRoleList;
    }
    
}

