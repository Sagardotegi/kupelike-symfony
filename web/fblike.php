<?php

require_once('../vendor/autoload.php');
//require_once('../vendor/Facebook/src/Facebook/autoload.php');
//use Facebook\FacebookRequest;
session_start();
$fb = new Facebook\Facebook([
  'app_id' => '765683296917544', // Replace {app-id} with your app id
  'app_secret' => '31ad4ff7d32353f15149a55b4b965596',
  'default_graph_version' => 'v2.8',
  ]);

$helper = $fb->getRedirectLoginHelper();

$request = new Facebook\FacebookRequest(
  $session,
  'POST',
  '/me/og.likes',
  'https://www.facebook.com/kupelike/photos/a.1709568489304099.1073741827.1704315726496042/1710432339217714/?type=3'
);
$response = $request->execute();
$graphObject = $response->getGraphObject();

/*$request->getFacebook()->api("/".$id."/likes", 'post');
$response = $request->execute();
$graphObject = $response->getGraphObject();*/