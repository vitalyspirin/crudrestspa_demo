<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\utils\FileWriter;


class SwaggerUiController extends Controller
{
    
    public function actionIndex()
    {
        FileWriter::overwriteSwaggerJson();
        
        return $this->render('index');
    }

}
