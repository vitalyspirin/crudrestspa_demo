<?php 

$I = new ApiTester($scenario);
$I->wantTo('test POST /calories');

$I->sendPOST(URL . '/calories');

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token must be specified');



$I->sendPOST(URL . '/calories', ['user_accesstoken' => 1]);

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Access token is invalid');



$I->sendPOST(URL . '/calories', [
    'calories_number' => '100',
    'user_id' => 1,
    'user_accesstoken' => 'LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS'
]);

$I->seeResponseCodeIs(422);
$I->seeResponseIsJson();
$I->seeResponseContains('Date and time cannot be blank.');
$I->seeResponseContains('Description cannot be blank.');
