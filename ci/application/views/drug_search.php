
<?php echo form_open('DrugSearch/search_for_drug'); ?>
	<label for='searchQuery'>Enter a drug to search: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>
	
	
<?php

if (isset($response)){
	print $response;
	print "\n";
	
	$response = json_decode($response);

	
	foreach ($response->data->candidates as $candidate){
		print "Candidate: " . $candidate . "<br>";
	}
	
}

?>