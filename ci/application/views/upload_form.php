
<html>
<head>
<title>Upload Form</title>
</head>
<body>
<?php echo $error;
echo form_open('Drugs/do_upload', array('method'=>'post')); ?>
	<label for='searchQuery'>Upload File:</label>
	<input type='file' name='userfile'>
	<input type='submit' name='submit' value='Upload'>
	</form> 
</body>
</html>