<?php 
	
	


	echo form_open('Upload/do_upload', array('method'=>'post')); ?>
	<label for='searchQuery'>Upload File:</label>
	<input type='file' name='userfile'>
	<input type='submit' name='submit' value='Upload'>
	</form>