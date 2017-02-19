
<?php echo form_open('Drugs/search_for_drug'); ?>
	<label for='searchQuery'>Enter a drug to search for: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>

<?php

if (isset($searchData)){
	
	foreach ($searchData->data->candidates as $candidate){
		echo "<a href='price_comparison/$candidate' >$candidate</a><br>";
	}
	
}

if (isset($priceData)){
	var_dump($priceData);
}

?>
	<hr>
	<a href='http://GoodRx.com'>Powered by GoodRx</a>
	


