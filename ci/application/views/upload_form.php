<?php 
	require('system/helpers/form_helper.php');

	echo form_open('Drugs/search_for_drug', array('method'=>'get')); ?>
	<label for='searchQuery'>Enter a drug to search for: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>