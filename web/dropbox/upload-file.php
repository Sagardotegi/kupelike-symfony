<?php

# Include the Dropbox SDK libraries
//require_once "dropbox-sdk/Dropbox/autoload.php";
require_once('../../vendor/autoload.php');
//$foto = $_POST['foto'];
use \Dropbox as dbx;

$appInfo = dbx\AppInfo::loadFromJsonFile("dropboxauth.json");
$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");

$authorizeUrl = $webAuth->start();

$target_dir = "./";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$foto = basename( $_FILES["foto"]["name"]);

if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["foto"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    
    
    

echo "1. Go to: " . $authorizeUrl . "\n";
echo "2. Click \"Allow\" (you might have to log in first).\n";
echo "3. Copy the authorization code.\n";
$authCode = \trim(\readline("Enter the authorization code here: "));

list($accessToken, $dropboxUserId) = $webAuth->finish("n79XiDkx98AAAAAAAAAAH7mFttdnsxVnt4eqplOP5c4");
print "Access Token: " . $accessToken . "\n";

$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
$accountInfo = $dbxClient->getAccountInfo();

print_r($accountInfo);
$foto2 = "/".$foto;
$f = fopen($foto, "rb");
$result = $dbxClient->uploadFile($foto2, dbx\WriteMode::add(), $f);
fclose($f);
print_r($result);

/*$folderMetadata = $dbxClient->getMetadataWithChildren("/");
print_r($folderMetadata);

$f = fopen("elorrabi.jpg", "w+b");
$fileMetadata = $dbxClient->getFile("/elorrabi.jpg", $f);
fclose($f);
print_r($fileMetadata);*/