<?php 
	
	


	echo form_open('Drugs/do_upload', array('method'=>'post')); ?>
	<label for='userfile'>Upload File:</label>
	<input type='file' name='userfile'>
	<input type='submit' name='submit' value='Upload'>
	</form>