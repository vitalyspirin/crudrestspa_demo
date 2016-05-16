<?php

namespace app\models\utils;


class FileWriter
{
    
    public static function overwriteSwaggerJson()
    {
        $fileFullName = \Yii::getAlias('@app') . '/modules/v1/swagger.json';
        $fileContent = file_get_contents($fileFullName);
        
        $host = \Yii::$app->request->serverName;
        $baseUrl = \Yii::$app->request->baseUrl;

        $newFileContent = preg_replace(
            '/"host".*/', "\"host\":\"$host\",", $fileContent);
        $newFileContent = preg_replace(
            '/"basePath".*/', "\"basePath\":\"$baseUrl/v1\",", $newFileContent);

        file_put_contents($fileFullName, $newFileContent);
    }
    
    
    public static function overwriteApiSuiteYmlFile()
    {
        $url = \Yii::$app->request->hostInfo;
        $url .= \Yii::$app->request->baseUrl;
    
        $fileFullName = \Yii::getAlias('@app') . '/tests/codeception/api.suite.yml';
        $fileContent = file_get_contents($fileFullName);

        $newFileContent = preg_replace('/url:.*/', "url: $url", $fileContent);
        file_put_contents($fileFullName, $newFileContent);
    }


    public static function overwriteCodeceptionBootstrapFile()
    {
        $url = \Yii::$app->request->hostInfo;
        $url .= \Yii::$app->request->baseUrl;
        
        $str = 
"<?php\n\n" .
"define('URL', '$url/v1');\n\n";/* .
"\Codeception\Configuration::config()['coverage']['c3_url'] =\n".
"    'http://localhost:8080/crudrestspa_demo/server/web';\n";*/
    
        $fileFullName = \Yii::getAlias('@app') . '/tests/codeception/api/_bootstrap.php';
        file_put_contents($fileFullName, $str);        
    }

}
