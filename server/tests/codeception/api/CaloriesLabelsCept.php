<?php 
$I = new ApiTester($scenario);
$I->wantTo('test GET /calories/labels');
$I->sendGET(URL . '/calories/labels');

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('"calories_id":');
$I->seeResponseContains('"calories_text"');
