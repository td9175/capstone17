<?php 
	
	echo form_open('OCR/getImage', array('method'=>'get')); ?>
	<label for='searchQuery'>Select Image</label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>