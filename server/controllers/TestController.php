<?php
namespace app\controllers;

use app\models\utils\FileWriter;
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

        if (!isset($_POST['run'])) {
            $result =  $this->render('server', ['codeCoverageUrl' => $codeCoverageUrl]);
        } else {
            FileWriter::overwriteCodeceptionBootstrapFile();
            FileWriter::overwriteApiSuiteYmlFile();

            $output = [];

            $command = __DIR__ . '/../vendor/bin/codecept';
            $result = exec($command . ' clean --config ../tests', $output, $return_var);

            $command .= ' run api --config ' . __DIR__ . '/../tests';

            if (isset($_POST['codeCoverage'])) {
                $command .= ' --coverage --coverage-html';
            }

            if (isset($_POST['debug'])) {
                $command .= ' --debug';
                $htmlFilePath = false;
            } else {
                $command .= ' --html';
                $htmlFilePath = __DIR__ . '/../tests/codeception/_output/report.html';
            }

            $result = exec($command, $output, $return_var);

            $result = $this->render('server', [
                'output' => $output,
                'return_var' => $return_var,
                'htmlFilePath' => $htmlFilePath,
                'codeCoverageUrl' => $codeCoverageUrl
            ]);
        }

        return $result;
    }


    public function actionReport()
    {
        return $this->renderFile(\Yii::getAlias('@app') . '/tests/codeception/_output/report.html');
    }


    public function actionManual()
    {
        return $this->render('manual');
    }


    public function actionE2e()
    {
        echo 'Not implemented yet.';
    }
}
