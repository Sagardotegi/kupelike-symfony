<?php
session_start();
require_once('../../vendor/autoload.php');

$fb = new Facebook\Facebook([
  'app_id' => '765683296917544', // Replace {app-id} with your app id
  'app_secret' => '31ad4ff7d32353f15149a55b4b965596',
  //'default_graph_version' => 'v2.2',
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



//$birth = $userNode['birthday'];

/*var_dump(
    $userNode->getField('email'), $userNode['email']
);*/



//---------------------




try {
  //$accessToken = $helper->getAccessToken();
  
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

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('765683296917544'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

?>