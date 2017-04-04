
<html>
<head>
<title>Upload Form</title>
</head>
<body>
<code><?php echo $msg;?></code>


<code>
<?php if($upload_data != ''):?>
<?php var_dump($upload_data);?>

</code>
<img scr="<?php echo $upload_data['full_path'];?>">
<?php endif;

echo form_open('Drugs/do_upload'); ?>
	<label for='userfile'>Upload File:</label>
	<input type='file' name='userfile'>
	<input type='submit' name='submit' value='Upload'>
	</form> 
</body>
</html>