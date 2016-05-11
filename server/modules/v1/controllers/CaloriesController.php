<?php


namespace app\modules\v1\controllers;

use app\models\User;
use app\models\Calories;
use yii\rest\ActiveController;
use yii;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use yii\web\UnauthorizedHttpException;


class CaloriesController extends ActiveController
{
    public $modelClass = 'app\models\Calories';
    
    public function behaviors()
    {
      return ArrayHelper::merge(parent::behaviors(), [
          [
              'class' => 'yii\filters\ContentNegotiator',
              'formats' => [
                  'application/json' => Response::FORMAT_JSON,
              ],
          ],
      ]);
    }


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


        switch (Yii::$app->controller->action->id) {
            case 'view':
            case 'search':
            case 'user' :   if ($currentUser == null || (
                                $this->actionParams['id'] != $currentUser->user_id 
                                && $currentUser->user_role == User::REGULAR_USER) 
                            )
                            {
                                throw new ForbiddenHttpException();
                            }
        }

    }


    public function actionUser($id)
    {
        $this->checkAccess(Yii::$app->controller->action);
     
        $caloriesList = Calories::find()->
            where(['user_id' => $this->actionParams['id']])->
            orderBy('calories_datetime')->all();

        return $caloriesList;
    }


    public function actionLabels()
    {
        $calories = new Calories();
        $caloriesLabelList = $calories->attributeLabels();

        return $caloriesLabelList;
    }


    public function actionSearch($id)
    {
        $this->checkAccess(Yii::$app->controller->action);

        $params = Yii::$app->request->get();


        $condition = 'user_id=' . $this->actionParams['id'];
        
        if ( isset($params['fromDate']) && !empty($params['fromDate']) ) {
            $condition .= ' AND calories_datetime >= "' . $params['fromDate'] . '"';
        }
        
        if ( isset($params['toDate']) && !empty($params['toDate']) ) {
            $condition .= ' AND calories_datetime <= "' . $params['toDate'] . 
                ' 23:59:59"';
        }

        if ( !empty($params['fromTime']) ) {
            $condition .= ' AND TIME(calories_datetime) >= "' . $params['fromTime'] . 
                '"';
        }
        
        if ( !empty($params['toTime']) ) {
            $condition .= ' AND TIME(calories_datetime) <= "' . $params['toTime'] . 
                '"';
        }


        $caloriesList = Calories::find()->where($condition)->
            orderBy('calories_datetime')->all();


        return $caloriesList;

    }

}

