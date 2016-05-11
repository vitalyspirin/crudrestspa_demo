<?php 

$I = new ApiTester($scenario);
$I->wantTo('test GET /user/labels');
$I->sendGET(URL . '/user/labels');

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('"user_email":');
$I->seeResponseContains('"User Email"');
