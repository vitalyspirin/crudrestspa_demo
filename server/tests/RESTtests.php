<?php

    require_once(__DIR__ . '/../vendor/simpletest/autorun.php');
    require_once(__DIR__ . '/../vendor/simpletest/web_tester.php');

    require_once('APIURL.php');


    class RESTtests extends WebTestCase
    {
        protected $user_accesstoken;


        public function testUserLabels()
        {
            $url = APIURL::getUserLabelsUrl();

            $result = $this->get($url);
            $this->assertResponse(200);
            $resultArr = json_decode($result, true);

            $this->assertTrue(count($resultArr) > 0);
        }


        public function testLogin()
        {
            $url = APIURL::getUserUrl();

            $result = $this->post($url, [
                'user_email' => 'vitaly.spirin@gmail.com',
                'user_password' => 'vitaly'
                ]
            );
            $this->assertResponse(200);

            $resultObj = json_decode($result);

            $this->assertTrue(isset($resultObj->user_accesstoken));
            $this->user_accesstoken = $resultObj->user_accesstoken;
        }


        public function testUser()
        {
            $url = APIURL::getUserUrl();

            $result = $this->get($url);
            $this->assertResponse(401);

            $url = $url . '?user_accesstoken=' . $this->user_accesstoken;
            $result = $this->get($url);
            $this->assertResponse(200);

            $this->assertText('user_firstname');
            $resultObj = json_decode($result);
            $this->assertTrue(is_array($resultObj));
            $this->assertTrue(count($resultObj));
        }


        public function testCalories()
        {
            $url = APIURL::getCaloriesUrl(1);

            $result = $this->get($url);
            $this->assertResponse(401);

            $result = $this->get($url . '?user_accesstoken=' . $this->user_accesstoken);
            $this->assertResponse(200);

            $this->assertText('calories_id');
            $resultArr = json_decode($result);
            $this->assertTrue(is_array($resultArr));
        }
    }
