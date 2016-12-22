<?php
// https://developers.facebook.com/docs/graph-api/reference/v2.8/object/likes
include 'credentials.php';
// include composer autoload
require 'vendor/autoload.php';
$fb = new \Facebook\Facebook([
  'app_id' => Credentials::$appId,
  'app_secret' => Credentials::$appSecret,
  'default_access_token' => Credentials::$appAccessToken, // optional  
  'default_graph_version' => 'v2.8'
]);
try {
  // {object_id} 
  //      391578134319876 : Zubiri-Manteo
  //      391578134319876_954015738076110: One Zubiri-Manteo's post
  //      You can get de post ID From the 'embed' option of the post
  
  $response = $fb->get('/391578134319876_954015738076110/likes');
  
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