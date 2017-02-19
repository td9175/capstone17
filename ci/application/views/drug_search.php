
<?php echo form_open('DrugSearch/search_for_drug'); ?>
	<label for='searchQuery'>Enter a drug to search: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>
	
	
<?php

if (isset($response)){
	
	foreach ($response->data->candidates as $candidate){
		print "Candidate: " . $candidate . "<br>";
		echo "<a href='DrugSearch/price_comparison/$candidate' >$candidate</a>";
	}
	
}

if (isset($priceData)){
	var_dump($priceData);
}

?>

