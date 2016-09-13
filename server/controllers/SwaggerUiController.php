<?php

namespace app\controllers;

use app\models\utils\FileWriter;
use yii\web\Controller;

class SwaggerUiController extends Controller
{
    public function actionIndex()
    {
        FileWriter::overwriteSwaggerJson();

        return $this->render('index');
    }
}
