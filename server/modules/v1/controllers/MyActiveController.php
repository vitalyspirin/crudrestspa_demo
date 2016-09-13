<?php

namespace app\modules\v1\controllers;

use yii\rest\ActiveController;

class MyActiveController extends ActiveController
{
    const ACCESS_TOKEN_IS_MISSING = 'Access token must be specified.';
    const ACCESS_TOKEN_IS_INVALID = 'Access token is invalid.';
}
