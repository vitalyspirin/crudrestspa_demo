<?php
namespace app\controllers;

use Yii;
//use yii\filters\AccessControl;
use yii\web\Controller;
//use yii\filters\VerbFilter;
//use app\models\LoginForm;
//use app\models\ContactForm;

//use app\models\User;

//require __DIR__ . '/../tests/RESTtests.php';



class TestController extends Controller
{
    public $enableCsrfValidation = false;
    
    public function actionDatabase()
    {
        $sqlFile = file_get_contents(__DIR__ . '/../models/sql/schema.sql');
        $command = Yii::$app->db->createCommand($sqlFile);

        $result = $command->execute();

        return $this->render('database');
    }


    public function actionServer()
    {
        $codeCoverageUrl = Yii::$app->request->hostInfo;
        $codeCoverageUrl .= Yii::$app->request->baseUrl;
        $codeCoverageUrl .= '/../tests/codeception/_output/coverage';

        if ( !isset($_POST['run']) ) {
            $result =  $this->render('server', ["codeCoverageUrl"=>$codeCoverageUrl]);
        } else {
            $this->overwriteCodeceptionBootstrapFile();

            $output = [];

            $command = __DIR__ . "/../vendor/bin/codecept";
            $result = exec($command . ' clean --config ../tests', $output, $return_var);

            $command .= " run api --config ../tests";

            if ( isset($_POST['codeCoverage']) ) {
                $command .= " --coverage --coverage-html";
            }
            
            if ( isset($_POST['debug']) ) {
                $command .= " --debug";
                $htmlFilePath = false;
            } else {
                $command .= " --html";
                $htmlFilePath = __DIR__ . '/../tests/codeception/_output/report.html';
            }
            
            $result = exec($command, $output, $return_var);

            $result = $this->render('server', [
                "output"=>$output, 
                "return_var"=>$return_var,
                "htmlFilePath"=>$htmlFilePath,
                "codeCoverageUrl"=>$codeCoverageUrl
            ]);

        }

//echo '<pre>';var_dump($output); var_dump($return_var); exit;
        
        return $result;
        //return $this->renderFile(__DIR__ . '/../tests/codeception/_output/report.html');
    }
    

    public function actionReport()
    {
        return $this->renderFile(__DIR__ . '/../tests/codeception/_output/report.html');
    }
    
    public function actionManual()
    {
        return $this->render('manual');
    }
    
    
    protected function overwriteCodeceptionBootstrapFile()
    {
        $url = Yii::$app->request->hostInfo;
        $url .= Yii::$app->request->baseUrl;
        $str = "<?php define('URL', '$url/v1');";
        $fileFullName = __DIR__ . '/../tests/codeception/api/_bootstrap.php';
        file_put_contents($fileFullName, $str);        
    }


    public function actionE2e()
    {
        echo 'Not implemented yet.';
    }
    
    
}
