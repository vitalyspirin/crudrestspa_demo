<?php

namespace app\modules\v1;

/**
 * v1 module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        \Yii::$app->user->enableSession = false; // added by Vitaly

error_reporting(-1);
ini_set('display_errors', 1);

    }
}
