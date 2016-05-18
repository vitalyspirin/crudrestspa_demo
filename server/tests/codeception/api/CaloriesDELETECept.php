<?php 
$I = new ApiTester($scenario);
$I->wantTo('test DELETE /calories/{calories_id}');


$I->sendDELETE(URL . '/calories/30');

$I->seeResponseCodeIs(404);
$I->seeResponseIsJson();
$I->seeResponseContains('Not Found');
$I->seeResponseContains('Object not found');

$dateTime = new DateTime();
$I->sendPOST(URL . '/calories', [
    'calories_datetime'=>$dateTime->format('Y-m-d H:i:s'),
    'calories_text'=>'test powder',
    'calories_number'=>'100',
    'user_id'=>1,
    'user_accesstoken'=>'LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS'
]);
$I->seeResponseCodeIs(201);
$calories_id = json_decode($I->grabResponse())->calories_id;

$I->sendDELETE(URL . "/calories/$calories_id");

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token must be specified');


$I->sendDELETE(URL . "/calories/$calories_id?user_accesstoken=1");

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token is invalid');


$I->sendDELETE(URL . "/calories/$calories_id?user_accesstoken=7GFXdHAV3Yo7XpUIb3bmGp-PhNbLvy04");

$I->seeResponseCodeIs(403);
$I->seeResponseIsJson();
$I->seeResponseContains('Forbidden');
$I->seeResponseContains('Access denied');


$I->sendDELETE(URL . "/calories/$calories_id?user_accesstoken=LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS");

$I->seeResponseCodeIs(204);
