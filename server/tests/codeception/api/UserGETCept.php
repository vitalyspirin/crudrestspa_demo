<?php 
$I = new ApiTester($scenario);
$I->wantTo('test GET /users/{user_id}');
$I->sendGET(URL . '/users/1');

$I->seeResponseCodeIs(401);
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token');


$I->sendGET(URL . '/users/1', ['user_accesstoken'=>1]);

$I->seeResponseCodeIs(401);
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token');


$I->sendGET(URL . '/users/1', ['user_accesstoken'=>'7GFXdHAV3Yo7XpUIb3bmGp-PhNbLvy04']);

$I->seeResponseCodeIs(403);
$I->seeResponseContains('Forbidden');
$I->seeResponseContains('Access denied');


$I->sendGET(URL . '/users/30', ['user_accesstoken'=>'LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS']);

$I->seeResponseCodeIs(404);
$I->seeResponseIsJson();
$I->seeResponseContains('Not Found');
$I->seeResponseContains('Object not found');


$I->sendGET(URL . '/users/1', ['user_accesstoken'=>'LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS']);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->dontSeeResponseContains('[');
$I->seeResponseContains('"user_email":');
