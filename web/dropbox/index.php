<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Dropbox Uploader Demo</title>
    </head>

<style>
h1{}
body{font-family:arial;font-size:13px;}
.box{
background:none repeat scroll 0 0 #F6F6F6;
border:1px solid #C3C3C3;
margin-left:100px;
margin-top:50px;
width:860px;
}
.message{
background-color:#FFFFE0;
border:1px solid #E6DB55;
margin:30px 0 16px 8px;
padding:12px;
width:774px;
}
</style>
<body>
<?php
if ($_POST) {
    require 'DropboxUploader.php';


    try {
        // Rename uploaded file to reflect original name
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK)
            throw new Exception('File was not successfully uploaded from your computer.');

        $tmpDir = uniqid('/tmp/DropboxUploader-');
        if (!mkdir($tmpDir))
            throw new Exception('Cannot create temporary directory!');

        if ($_FILES['file']['name'] === "")
            throw new Exception('File name not supplied by the browser.');

        $tmpFile = $tmpDir.'/'.str_replace("/\0", '_', $_FILES['file']['name']);
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $tmpFile))
            throw new Exception('Cannot rename uploaded file!');

        // Enter your Dropbox account credentials here
		$uploader = new DropboxUploader('kupelikeproject@gmail.com', 'Abcd_1234');
        $uploader->upload($tmpFile, $_POST['dest']);

        echo '<span style="color: green;font-weight:bold;margin-left:393px;">File successfully uploaded to my Dropbox!</span>';
    } catch(Exception $e) {
        echo '<span style="color: red;font-weight:bold;margin-left:393px;">Error: ' . htmlspecialchars($e->getMessage()) . '</span>';
    }

    // Clean up
    if (isset($tmpFile) && file_exists($tmpFile))
        unlink($tmpFile);

    if (isset($tmpDir) && file_exists($tmpDir))
        rmdir($tmpDir);
}
?>
<div class="box" align="center">
		<h1>Dropbox Uploader Demo<br>
		<br>
		&nbsp;</h1>
		<form method="POST" enctype="multipart/form-data">
		<input type="file" name="file" /><br><br>
		<input type="submit" value="Upload the file to my Dropbox!" />
		<input style="display:none" type="text" name="dest" value="uploads" />

</div>




</body>
</html>
