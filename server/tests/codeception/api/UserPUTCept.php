<?php 
$I = new ApiTester($scenario);
$I->wantTo('test PUT /users/{user_id}');

$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendPUT(URL . '/users/3');

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token');


$I->sendPUT(URL . '/users/3?user_accesstoken=1');

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token is invalid');


$I->sendPUT(URL . '/users/3?user_accesstoken=PEp982aMnzjjTFqItf8ORva0J9LgWGBt');

$I->seeResponseCodeIs(403);
$I->seeResponseIsJson();
$I->seeResponseContains('Forbidden');
$I->seeResponseContains('Access denied');


$I->sendPUT(URL . '/users/30?user_accesstoken=LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS', [
    'user_expectedcalories'=>"test rice"
]);

$I->seeResponseCodeIs(404);
$I->seeResponseIsJson();
$I->seeResponseContains('Not Found');



$I->sendPUT(URL . '/users/3?user_accesstoken=LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS', [
    'user_expectedcalories'=>"test rice"
]);

$I->seeResponseCodeIs(422);
$I->seeResponseIsJson();
$I->seeResponseContains('must be a number');


$user_expectedcalories = time() % 1000;
$I->sendPUT(URL . '/users/3?user_accesstoken=LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS', [
    'user_expectedcalories'=>$user_expectedcalories
]);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('"user_expectedcalories":' . $user_expectedcalories);

$user_expectedcalories += 1;
$I->sendPUT(URL . '/users/3?user_accesstoken=7GFXdHAV3Yo7XpUIb3bmGp-PhNbLvy04', [
    'user_expectedcalories'=>$user_expectedcalories
]);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('"user_expectedcalories":' . $user_expectedcalories);
