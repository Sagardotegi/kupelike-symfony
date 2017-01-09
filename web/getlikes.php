<?php
// https://developers.facebook.com/docs/graph-api/reference/v2.8/object/likes
include 'credentials.php';
//session_start();
//use Facebook\Facebook;
//require_once 'src/Facebook/autoload.php';
// include composer autoload
//require_once('../vendor/autoload.php');

//require_once 'src/Facebook/autoload.php';
//require_once __DIR__ . '/vendor/autoload.php';
//require_once('vendor/autoload.php');



require_once('../vendor/Facebook/src/Facebook/autoload.php');
$fb = new Facebook\Facebook([
  'app_id' => Credentials::$appId,
  'app_secret' => Credentials::$appSecret,
  'default_access_token' => Credentials::$appAccessToken, // optional  
  'default_graph_version' => 'v2.8'
]);
//$helper = $fb->getRedirectLoginHelper();

//S$fb->setDefaultAccessToken((string) $_SESSION['fb_access_token']);
try {
  // {object_id} 
  //      391578134319876 : Zubiri-Manteo
  //      391578134319876_954015738076110: One Zubiri-Manteo's post
  //      You can get de post ID From the 'embed' option of the post
  
  //$response = $fb->get('/391578134319876_954015738076110/likes');
  $response = $fb->get('/1704315726496042_1710432339217714/likes');
  
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