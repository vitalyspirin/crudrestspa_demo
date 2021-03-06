<?php 

$I = new ApiTester($scenario);
$I->wantTo('test GET /calories/user/{user_id}/search');
$I->sendGET(URL . '/calories/user/1/search');

$I->seeResponseCodeIs(401);
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token must be specified');


$I->sendGET(URL . '/calories/user/1/search', ['user_accesstoken' => 1]);

$I->seeResponseCodeIs(401);
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token is invalid');


$I->sendGET(URL . '/calories/user/1/search', ['user_accesstoken' => '7GFXdHAV3Yo7XpUIb3bmGp-PhNbLvy04']);

$I->seeResponseCodeIs(403);
$I->seeResponseContains('Forbidden');
$I->seeResponseContains('Access denied');


$I->sendGET(URL . '/calories/user/1/search', ['user_accesstoken' => 'PEp982aMnzjjTFqItf8ORva0J9LgWGBt']);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->SeeResponseContains('[');
$I->seeResponseContains('"calories_id":1');
$I->seeResponseContains('"calories_text":');
$I->dontseeResponseContains('"calories_id":6');



$I->sendGET(URL . '/calories/user/1/search', [
    'user_accesstoken' => 'PEp982aMnzjjTFqItf8ORva0J9LgWGBt',
    'fromDate' => '2016-04-06',
    'toDate' => '2016-04-06',
    'fromTime' => '09:00',
    'toTime' => '21:00'
]);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->SeeResponseContains('[');
$I->seeResponseContains('"calories_id":1');
$I->seeResponseContains('"calories_text":');
$I->seeResponseContains('"calories_id":2');
$I->seeResponseContains('"calories_id":3');
$I->dontseeResponseContains('"calories_id":4');
$I->dontseeResponseContains('"calories_id":5');
$I->dontseeResponseContains('"calories_id":6');


$I->sendGET(URL . '/calories/user/3/search', ['user_accesstoken' => '7GFXdHAV3Yo7XpUIb3bmGp-PhNbLvy04']);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->SeeResponseContains('[');
$I->seeResponseContains('"calories_id":6');
$I->seeResponseContains('"calories_text":');
$I->dontseeResponseContains('"calories_id":1');
$I->dontseeResponseContains('"calories_id":2');
