<?php
// https://developers.facebook.com/docs/graph-api/webhooks
// https://developers.facebook.com/ads/blog/post/2015/12/18/webhooks-for-lead-ads-tutorial/
// https://www.facebook.com/video.php?v=883648801749520
/*
    GET 
    parameters:
    hub.mode - The string "subscribe" is passed in this parameter
    hub.challenge - A random string
    hub.verify_token - The verify_token value you specified when you created the subscription    
    webhook.php?hub.mode=subscribe&hub.challenge=1563204991&hub.verify_token=192787373637639264027
    When your server receives one of these requests, it needs to:
    1) Verify the hub.verify_token matches the one you supplied when creating the subscription. This is a security check so that your server knows the request is being made by Facebook and relates to the subscription you just configured. This value is only passed on the initial API call to APP_ID/subscriptions.
    2) Render a response to the GET request that includes only the hub.challenge value. This confirms that this server is configured to accept callbacks, and is used for security verification on Facebook's side.
    Once a subscription is successfully created, Facebook will make an HTTP POST request to your callback URL every time that there are changes (to the chosen fields or edges).
    
    The request will have content type of application/json and the body will contain the following fields:...
*/

$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

if ($verify_token === 'abc123') {
  echo $challenge;
}

$input = json_decode(file_get_contents('php://input'), true);
error_log(print_r($input, true));

//$content = "some text here";
/*$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/borratzeko.txt","wb");
fwrite($fp,$input);
fclose($fp);*/