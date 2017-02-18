
<?php echo form_open('drugsearch/search_for_drug'); ?>
	<label for='searchQuery'>Enter drug name to search: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>
	
	
<?php

if (isset($response)){
	print $response;
	print "\n Hello World!";
}

?>