
<?php echo form_open('DrugSearch/search_for_drug'); ?>
	<label for='searchQuery'>Enter a drug to search: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>
	
	
<?php

if (isset($response)){
	print $response;
	print "\n";
	
	$dResponse = json_decode($response);
	
	print "Count: " . count($dResponse->candidates) . "\n";
	print "data: " . $dResponse->data . "\n";
	print "data->candidates: " . $dResponse->data->candidates . "\n";
	
	var_dump($candidates);
	
	//foreach ($candidates as $candidate){
	//	print "Candidate: " . $candidate . "\n";
	//}
	
}

?>