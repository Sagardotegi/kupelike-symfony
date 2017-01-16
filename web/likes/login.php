<?php
session_start();
require_once('../../vendor/autoload.php');

$fb = new Facebook\Facebook([
  'app_id' => '765683296917544',
  'app_secret' => '31ad4ff7d32353f15149a55b4b965596',
  'default_graph_version' => 'v2.8',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = [
'email',
'user_birthday',
'user_location',
'user_hometown'
];
$loginUrl = $helper->getLoginUrl('https://kupelike-oalba.c9users.io/web/likes/datos.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Like</a>';


?>