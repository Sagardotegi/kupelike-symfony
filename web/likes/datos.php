<?php
session_start();
require_once('../../vendor/autoload.php');

$fb = new Facebook\Facebook([
  'app_id' => '765683296917544',
  'app_secret' => '31ad4ff7d32353f15149a55b4b965596',
  'default_graph_version' => 'v2.8',
  ]);

$helper = $fb->getRedirectLoginHelper();

//------------------------


$accessToken = $helper->getAccessToken();
$_SESSION['fb_access_token']=$accessToken;
$fb->setDefaultAccessToken((string) $_SESSION['fb_access_token']);

$response = $fb->get('/me?locale=es_ES&fields=id,name,email,age_range,birthday,gender,hometown,location');
$userNode = $response->getGraphUser();


$fbid = $userNode->getProperty('id');
$fbname = $userNode->getProperty('name');
$fbemail = $userNode->getProperty('email');
$fbagerange = $userNode->getProperty('age_range');
$fbbirthday = $userNode->getProperty('birthday')->format('Y-m-d');
$fbgender = $userNode->getProperty('gender');
$fbhometown = $userNode->getProperty('hometown');
$fblocation = $userNode->getProperty('location');

//$userNode['id'];
//$userNode['name'];
//$userNode['email'];
//$userNode['age_range'];
//$userNode['birthday'];
//$userNode['gender'];
//$userNode['hometown'];
//$userNode['location'];

//------------------------




try {
  
  echo 'Facebook ID: '.$fbid.'<br>';
  echo 'Email: '.$fbemail.'<br>';
  echo 'Name: '.$fbname.'<br>';
  echo 'Age range: '.$fbagerange.'<br>';
  echo 'Birthday: '.$fbbirthday.'<br>';
  echo 'Gender: '.$fbgender.'<br>';
  echo 'Hometown: '.$fbhometown.'<br>';
  echo 'Actual town: '.$fblocation.'<br>';
  
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$_SESSION['fb_access_token'] = (string) $accessToken;

?>