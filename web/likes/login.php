<?php
session_start();
require_once('../../vendor/autoload.php');
require_once('../../vendor/Facebook/src/Facebook/autoload.php');
$fb = new Facebook\Facebook([
  'app_id' => '765683296917544', // Replace {app-id} with your app id
  'app_secret' => '31ad4ff7d32353f15149a55b4b965596',
  'default_graph_version' => 'v2.8',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://kupelike-oalba.c9users.io/web/likes/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

?>