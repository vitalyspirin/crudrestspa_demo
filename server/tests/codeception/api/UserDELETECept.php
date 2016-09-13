<?php 
$I = new ApiTester($scenario);
$I->wantTo('test DELETE /users/{user_id}');


$I->sendDELETE(URL . '/users/30');

$I->seeResponseCodeIs(404);
$I->seeResponseIsJson();
$I->seeResponseContains('Not Found');
$I->seeResponseContains('Object not found');


$I->sendPOST(URL . '/users', [
    'user_email' => 'testuser' . time() . '@gmail.com',
    'user_firstname' => 'Test',
    'user_lastname' => 'Test',
//    'user_password'=>'test'
]);
$I->seeResponseCodeIs(200);
$userId = json_decode($I->grabResponse())->user_id;

$I->sendDELETE(URL . "/users/$userId");

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token must be specified');


$I->sendDELETE(URL . "/users/$userId?user_accesstoken=1");

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token is invalid');


$I->sendDELETE(URL . "/users/$userId?user_accesstoken=PEp982aMnzjjTFqItf8ORva0J9LgWGBt");

$I->seeResponseCodeIs(403);
$I->seeResponseIsJson();
$I->seeResponseContains('Forbidden');
$I->seeResponseContains('Access denied');


$I->sendDELETE(URL . "/users/$userId?user_accesstoken=LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS");

$I->seeResponseCodeIs(204);
