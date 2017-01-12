<?php

require_once('../../vendor/autoload.php');
require_once('../../vendor/Facebook/src/Facebook/autoload.php');
session_start();
$fb = new Facebook\Facebook([
  'app_id' => '765683296917544',
  'app_secret' => '31ad4ff7d32353f15149a55b4b965596',
  'default_graph_version' => 'v2.8',
  ]);

$fb->setDefaultAccessToken((string) $_SESSION['fb_access_token']);
$response = $fb->get('/me?locale=es_ES&fields=name,email');
$userNode = $response->getGraphUser();

$email = $userNode['email'];
echo '<script language="javascript">alert("Recibiras un aviso al email '.$email.' cuando la kupela 1 sea embotellada.");</script>';
// insertar el email en la base de datos




//header("Location: ./index.php");

?>