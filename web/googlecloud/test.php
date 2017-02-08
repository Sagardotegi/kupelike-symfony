<?php
require_once('../../vendor/autoload.php');

# Imports the Google Cloud client library
/*use Google\Cloud\Storage\StorageClient;

# Your Google Cloud Platform project ID
$projectId = 'kupelike-156707';

# Instantiates a client
$storage = new StorageClient([
    'projectId' => $projectId
]);

# The name for the new bucket
$bucketName = 'sagardotegis';

# Creates the new bucket
$bucket = $storage->createBucket($bucketName);

echo 'Bucket ' . $bucket->name() . ' created.';*/
use Google\Cloud\Storage\StorageClient;

$storage = new StorageClient([
    'projectId' => 'kupelike-156707'
]);

$bucket = $storage->bucket('my_bucket');

// Upload a file to the bucket.
$bucket->upload(
    fopen('/data/file.txt', 'r')
);

// Download and store an object from the bucket locally.
$object = $bucket->object('file_backup.txt');
$object->downloadToFile('/data/file_backup.txt');



?>