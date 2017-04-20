<?php
include_once("creds.php"); // Get $bucket
use google\appengine\api\cloud_storage\CloudStorageTools;

$options = [ 'gs_bucket_name' => $bucket ];
$upload_url = CloudStorageTools::createUploadUrl('/process.php', $options);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cloud Vision API PHP Example</title>
</head>
<body>
	<form action="<?php echo $upload_url ?>" method="post" enctype="multipart/form-data">
	Your Photo: <input type="file" name="photo" size="25" />
	<input type="submit" name="submit" value="Submit" />
</form>
</body>
</html>