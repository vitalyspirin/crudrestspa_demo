<?php 
$I = new ApiTester($scenario);
$I->wantTo('test GET /users');
$I->sendGET(URL . '/users');

$I->seeResponseCodeIs(401);
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token');


$I->sendGET(URL . '/users', ['user_accesstoken' => '1']);

$I->seeResponseCodeIs(401);
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token');


$I->sendGET(URL . '/users', ['user_accesstoken' => 'PEp982aMnzjjTFqItf8ORva0J9LgWGBt']);

$I->seeResponseCodeIs(403);
$I->seeResponseContains('Forbidden');
$I->seeResponseContains('Access denied');


$I->sendGET(URL . '/users', ['user_accesstoken' => 'LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS']);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('[');
$I->seeResponseContains('"user_email":');
