<?php

error_reporting(-1);
ini_set('display_errors', 1);

// for c3 (CodeCeption code coverage) =>
define('C3_CODECOVERAGE_ERROR_LOG_FILE', '/../runtime/logs/c3_error.log'); //Optional (if not set the default c3 output dir will be used)
require_once __DIR__ . '/../../../.composer/vendor/codeception/codeception/autoload.php';
include __DIR__ . '/../tests/c3.php';

if ( strpos($_SERVER['REQUEST_URI'], 'c3/report/clear') !== false ) exit;

//define('MY_APP_STARTED', true);
// for c3 (CodeCeption code coverage) <=

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
