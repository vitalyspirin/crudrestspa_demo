<?php 
$I = new ApiTester($scenario);
$I->wantTo('test GET /user/roles');
$I->sendGET(URL . '/user/roles');

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('user');
$I->seeResponseContains('manager');
