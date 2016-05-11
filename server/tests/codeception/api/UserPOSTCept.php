<?php 
$I = new ApiTester($scenario);
$I->wantTo('test POST /users');

$I->sendPOST(URL . '/users');

$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->seeResponseContains('Bad Request');
$I->seeResponseContains('user_firstname');



$I->sendPOST(URL . '/users', [
    "user_email"=> "vitaly.spirin@gmail.comm",
    "user_password"=> "vitaly"
]);

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('User email does not exist');



$I->sendPOST(URL . '/users', [
    "user_email"=> "vitaly.spirin@gmail.com",
    "user_password"=> "abc"
]);

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->seeResponseContains('Unauthorized');
$I->seeResponseContains('Wrong password');



$I->sendPOST(URL . '/users', [
    "user_email"=> "vitaly.spirin@gmail.com",
    "user_password"=> "vitaly"
]);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('user_email');
$I->seeResponseContains('"user_accesstoken":"PEp982aMnzjjTFqItf8ORva0J9LgWGBt"');



$I->sendPOST(URL . '/users', [
    "user_firstname"=> "Vitaly",
    "user_role"=> "user"
]);

$I->seeResponseCodeIs(422);
$I->seeResponseIsJson();
$I->seeResponseContains('Unprocessable entity');
$I->seeResponseContains('User Email cannot be blank');

