<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;


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
            $this->overwriteApiSuiteYmlFile();

            $output = [];

            $command = __DIR__ . "/../vendor/bin/codecept";
            $result = exec($command . ' clean --config ../tests', $output, $return_var);

            $command .= ' run api --config ' . __DIR__ . '/../tests';

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
//var_dump($command);exit;
            $result = $this->render('server', [
                "output"=>$output, 
                "return_var"=>$return_var,
                "htmlFilePath"=>$htmlFilePath,
                "codeCoverageUrl"=>$codeCoverageUrl
            ]);

        }
        
        return $result;
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
        
        $str = 
"<?php\n\n" .
"define('URL', '$url/v1');\n\n";/* .
"\Codeception\Configuration::config()['coverage']['c3_url'] =\n".
"    'http://localhost:8080/crudrestspa_demo/server/web';\n";*/
    
        $fileFullName = __DIR__ . '/../tests/codeception/api/_bootstrap.php';
        file_put_contents($fileFullName, $str);        
    }


    protected function overwriteApiSuiteYmlFile()
    {
        $url = Yii::$app->request->hostInfo;
        $url .= Yii::$app->request->baseUrl;
    
        $fileFullName = __DIR__ . '/../tests/codeception/api.suite.yml';
        $fileContent = file_get_contents($fileFullName);

        $newFileContent = preg_replace('/url:.*/', "url: $url", $fileContent);
        file_put_contents($fileFullName, $newFileContent);
    }


    public function actionE2e()
    {
        echo 'Not implemented yet.';
    }
    
    
}
