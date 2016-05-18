<?php 

$I = new ApiTester($scenario);
$I->wantTo('test GET /calories/{calories_id}');
$I->sendGET(URL . '/calories/1');

$I->seeResponseCodeIs(401);
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token');


$I->sendGET(URL . '/calories/1', ['user_accesstoken'=>1]);

$I->seeResponseCodeIs(401);
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token');


$I->sendGET(URL . '/calories/1', ['user_accesstoken'=>'7GFXdHAV3Yo7XpUIb3bmGp-PhNbLvy04']);

$I->seeResponseCodeIs(403);
$I->seeResponseContains('Forbidden');
$I->seeResponseContains('Access denied');


$I->sendGET(URL . '/calories/1', ['user_accesstoken'=>'PEp982aMnzjjTFqItf8ORva0J9LgWGBt']);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->dontSeeResponseContains('[');
$I->seeResponseContains('"calories_id":');
$I->seeResponseContains('"calories_text":');


$I->sendGET(URL . '/calories/2', ['user_accesstoken'=>'PEp982aMnzjjTFqItf8ORva0J9LgWGBt']);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->dontSeeResponseContains('[');
$I->seeResponseContains('"calories_id":');
$I->seeResponseContains('"calories_text":');
