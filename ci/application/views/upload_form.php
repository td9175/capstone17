
<html>
<head>
<title>Upload Form</title>
</head>
<body>
<code><?php echo $msg;?></code>
<?php 
echo form_open('Drugs/do_upload'); ?>
	<label for='userfile'>Upload File:</label>
	<input type='file' name='userfile'>
	<input type='submit' name='submit' value='Upload'>
	</form> 
</body>
</html>