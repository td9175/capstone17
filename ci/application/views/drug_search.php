
<?php echo form_open('DrugSearch/search_for_drug'); ?>
	<label for='searchQuery'>Enter a drug to search: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>
	
	<a href='http://GoodRx.com'>Powered by GoodRx</a>
	
<?php

if (isset($response)){
	
	foreach ($response->data->candidates as $candidate){
		echo "<a href='price_comparison/$candidate' >$candidate</a><br>";
	}
	
}

if (isset($priceData)){
	var_dump($priceData);
}

?>

