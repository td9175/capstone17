<?php 
	
	echo form_open('Ocr/getImage', array('method'=>'post')); ?>
	<html>
	<label for='searchQuery'>Enter a drug to search for: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>


	<hr>
	<a href='http://GoodRx.com'>Powered by GoodRx</a>
</html>