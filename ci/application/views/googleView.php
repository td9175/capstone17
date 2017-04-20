<?php
//include_once("creds.php"); // Get $bucket
require APPPATH . 'config/autoload.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
//Create Bucket here 
// https://cloud.google.com/storage/docs/getting-started-console#create_a_bucket
$bucket = "https://console.cloud.google.com/storage/browser/capstone_receipts/?_ga=1.73457682.1245552135.1492667330&project=capstone-165021";


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