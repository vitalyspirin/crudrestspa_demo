<?php 

$I = new ApiTester($scenario);
$I->wantTo('test PUT /calories/{calories_id}');


$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendPUT(URL . '/calories/30');

$I->seeResponseCodeIs(404);
$I->seeResponseIsJson();
$I->seeResponseContains('Not Found');
$I->seeResponseContains('Object not found');



$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendPUT(URL . '/calories/1');

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token');


$I->sendPUT(URL . '/calories/1?user_accesstoken=1');

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token is invalid');


$I->sendPUT(URL . '/calories/1?user_accesstoken=7GFXdHAV3Yo7XpUIb3bmGp-PhNbLvy04');

$I->seeResponseCodeIs(403);
$I->seeResponseIsJson();
$I->seeResponseContains('Forbidden');
$I->seeResponseContains('Access denied');


$I->sendPUT(URL . '/calories/1?user_accesstoken=PEp982aMnzjjTFqItf8ORva0J9LgWGBt', [
    'calories_number' => 'test rice'
]);

$I->seeResponseCodeIs(422);
$I->seeResponseIsJson();
$I->seeResponseContains('must be a number');


$calories_number = time() % 1000;
$I->sendPUT(URL . '/calories/1?user_accesstoken=PEp982aMnzjjTFqItf8ORva0J9LgWGBt', [
    'calories_number' => $calories_number
]);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('"calories_number":' . $calories_number);

$calories_number += 1;
$I->sendPUT(URL . '/calories/1?user_accesstoken=PEp982aMnzjjTFqItf8ORva0J9LgWGBt', [
    'calories_number' => $calories_number
]);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('"calories_number":' . $calories_number);
