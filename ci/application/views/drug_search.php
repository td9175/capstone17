
<?php echo form_open('DrugSearch/search_for_drug'); ?>
	<label for='searchQuery'>Enter a drug to search for: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>
	
	
<?php

if (isset($response)){
	print $response;
	print "\n";
	
	$candidates = json_decode($response);
	
	var_dump($candidates);
	
	//foreach ($candidates as $candidate){
	//	print "Candidate: " . $candidate . "\n";
	//}
	
}

?>