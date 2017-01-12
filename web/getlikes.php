<?php
// https://developers.facebook.com/docs/graph-api/reference/v2.8/object/likes
include 'credentials.php';
session_start();
//use Facebook\Facebook;
//require_once 'src/Facebook/autoload.php';
// include composer autoload
//require_once('../vendor/autoload.php');

//require_once 'src/Facebook/autoload.php';
//require_once __DIR__ . '/vendor/autoload.php';
require_once('../vendor/autoload.php');
//require_once __DIR__ . '../vendor/autoload.php';

require_once('../vendor/php-graph-sdk-5.0.0/src/Facebook/autoload.php');

require_once('../vendor/Facebook/src/Facebook/autoload.php');

$fb = new Facebook\Facebook([
  'app_id' => Credentials::$appId,
  'app_secret' => Credentials::$appSecret,
  'default_access_token' => Credentials::$appAccessToken, // optional  
  //'default_access_token' => 'EAACEdEose0cBABkbuqu4jv5p1JEE0rlyBuRniSiEhB9ZCXJG1uENYheg3JjjRTmVgBciHvHgJ3lwkdWCedeh3FDZCSOwVYmSuDDSKF0g2HqI0ycjTSd2zYNLS8oooj3ZAqiNWaXJArHmaKnl8HcmqouQ1hN0aHLuJsciKyaXwZDZD',
  'default_graph_version' => 'v2.8'
]);



$helper = $fb->getRedirectLoginHelper();
//$fb->setDefaultAccessToken((string) $_SESSION['fb_access_token']);

//$helper = $fb->getRedirectLoginHelper();

//$fb->setDefaultAccessToken((string) $_SESSION['fb_access_token']);
//$request = $fb->request('POST','/1704315726496042_1710432339217714/likes');
try {
  /*$accessToken = $helper->getDefaultAccessToken();*/
  // {object_id} 
  //      391578134319876 : Zubiri-Manteo
  //      391578134319876_954015738076110: One Zubiri-Manteo's post
  //      You can get de post ID From the 'embed' option of the post
  
/*$request = new FacebookRequest(
  $session,
  'POST',
  '/1704315726496042_1710432339217714/likes'
);
$response = $request->execute();
$graphObject = $response->getGraphObject();*/
  
  //$response = $fb->api("/1704315726496042_1710432339217714/likes", 'post', array('access_token' => "EAACEdEose0cBAFvZB9UZAF8hEEurZApxUOVhGBBgZAkjFSZCz0NHkpvb3eimEE0ZAE1rrDIXOGuXZAOO8Gwty2h4ZA62ZBPc7qZAGlPGS3Aw8YR9J5eFZAXtD8lkZBLN7FJ3UdtJGXjSdim9QIMAnkytrRoxe9DxP5wn2KYdvanZB4x8zzQZDZD"));
  $response = $fb->post('/1704315726496042_1710432339217714/likes');
  
  //$response = $fb->getClient()->sendRequest($request);
  //$response = $fb->post('/1704315726496042/likes');
  //$response = $fb->api("/1704315726496042_1710432339217714/likes", 'post');
  
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
// https://github.com/facebook/php-graph-sdk/blob/master/src/Facebook/FacebookResponse.php
$body = $response->getBody();
echo $body;